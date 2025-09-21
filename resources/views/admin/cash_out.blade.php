@extends('layouts.main')
@section('title', 'Envoi fonds')

@section('body')
    <x-sidebar />
    <x-nav />

    <div class="mdb-page-content page-intro bg-white">
        <div class="container py-3 ">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="d-flex justify-content-between mt-5 mb-3">
                        <h3 class="font-weight-bold">TRANSFERT DES FONDS (<span nb></span>)</h3>
                        <div class="">
                            <select id="status" class="form-control form-control-sm">
                                <option value="">Tous</option>
                                <option>EN ATTENTE</option>
                                <option>TRAITÉE</option>
                                <option>REJETÉE</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <x-error />
                    <div class="table-responsive">
                        <table tdata class="table table-hover font-weight-bold table-striped">
                            <thead class="table-dark">
                                <th></th>
                                <th></th>
                                <th>TRANS. ID</th>
                                <th>MARCHAND</th>
                                <th>SOLDE</th>
                                <th class="text-center">ENVOI A</th>
                                <th class="text-center">MONTANT</th>
                                <th class="text-center">DATE D'ENVOI</th>
                                <th class="text-center">STATUS</th>
                                <th class="text-nowrap">NOTE VALIDATION</th>
                                <th class="text-right">DATE</th>
                                <th class="text-right">My Ref</th>
                                <th></th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />

    <div class="modal fade" id="mdlinfo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark font-weight-bold">Validation de la transaction</h5>
                    <i class="fa fa-times text-muted fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
                </div>
                <form id="f-val" action="#">
                    <div class="modal-body">
                        <div class="bg-white rounded shadow-lg p-5">
                            <h5 class="font-weight-bold">Montant : <span datamontant></span> </h5>
                            <h5 class="font-weight-bold">Au : <span datanumero></span> </h5>
                            <hr>
                            <div class="mb-4">
                                <input type="hidden" name="id">
                                <label for="st">Status</label>
                                <select id="st" class='form-control' name="status">
                                    <option>TRAITÉE</option>
                                    <option>REJETÉE</option>
                                </select>
                            </div>
                            <div class="form-outline mb-4">
                                <textarea name='note_validation' class="form-control" id="textAreaExample" rows="4"></textarea>
                                <label class="form-label" for="textAreaExample">Note de validation</label>
                            </div>
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-seconday btn-sm" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-dark btn-sm">
                            <i class="fa fa-save"></i>
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js-code')
    @include('files.datatable-js')

    <script>
        $(function() {
            var tdata = $('[tdata]');
            var sel = $('#status');
            sel.change(function() {
                dtObj.ajax.reload();
            });

            var dtObj = new DataTable('[tdata]', {
                dom: 'Bfrtip',
                buttons: [
                    'pageLength', 'excel', 'pdf', 'print'
                ],
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                processing: false,
                serverSide: true,
                ajax: {
                    url: "{{ route('cashout.index', ['datatable' => '']) }}",
                    beforeSend: function() {
                        $('[tdata]').closest('div').LoadingOverlay("show", {
                            maxSize: 50
                        });
                    },
                    complete: function() {
                        $('[tdata]').closest('div').LoadingOverlay("hide");
                    },
                    error: function(resp) {
                        $('[onerror]').slideDown();
                    },
                    data: function(d) {
                        d.status = sel.val();
                    },
                },

                order: [
                    [0, "desc"]
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'img',
                        name: 'img',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'trans_id',
                        name: 'trans_id',
                        class: 'text-center'
                    },
                    {
                        data: 'business_name',
                        name: 'business_name',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'solde',
                        name: 'solde',
                        searchable: false,
                        orderable: false,
                        class: 'text-center text-nowrap'
                    },
                    {
                        data: 'au_numero',
                        name: 'au_numero',
                        class: 'text-center',
                    },
                    {
                        data: 'montant',
                        name: 'montant',
                        class: 'text-nowrap',
                    }, {
                        data: 'date_denvoi',
                        name: 'date_denvoi',
                        class: 'text-nowrap',
                    },
                    {
                        data: 'status',
                        name: 'status',
                        class: 'text-nowrap',
                    },
                    {
                        data: 'note_validation',
                        name: 'note_validation',
                    },
                    {
                        data: 'date',
                        name: 'date',
                        class: 'text-nowrap',
                    },
                    {
                        data: 'myref',
                        name: 'myref',
                        class: 'text-right'
                    }, {
                        data: 'action',
                        name: 'action',
                        searchable: false,
                        orderable: false,
                    },
                ]
            }).on('xhr.dt', function(e, settings, data, xhr) {
                $('span[nb]').html(data.recordsTotal);
            }).on('draw.dt', function() {
                $('[binfo]').off('click').click(function() {
                    var id = this.value;
                    var form = $('#f-val');
                    var btn = $(this);
                    $('[name=id]', form).val(id);
                    $('[datamontant]', form).html(btn.attr('datamontant'));
                    $('[datanumero]', form).html(btn.attr('datanumero'));
                    const modal = new mdb.Modal($('#mdlinfo')[0]);
                    modal.show();
                })
            });

            $('#f-val').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form).attr('disabled', true);
                var iclass = btn.find('i').attr('class');
                btn.find('i').removeClass()
                    .addClass('spinner-border spinner-border-sm');
                var data = form.serialize();
                rep = $('#rep', form);
                rep.slideUp();
                var id = $('[name=id]', form).val();

                $.ajax({
                    url: '{{ route('cashout.update', '') }}/' + id,
                    type: 'PUT',
                    data: data,
                    timeout: 20000,
                    success: function(res) {
                        if (res.success == true) {
                            rep.html(res.message).removeClass().addClass(
                                    'alert alert-success')
                                .slideDown();
                            form[0].reset();
                            dtObj.ajax.reload();
                            setTimeout(() => {
                                $('[data-dismiss="modal"]', form).click();
                            }, 3000);
                        } else {
                            var m = res.message + '<br>';
                            m += res.data?.errors_msg?.join('<br>') ?? '';
                            rep.removeClass().addClass('alert alert-danger').html(m)
                                .slideDown();
                        }
                    },
                    error: function(resp) {
                        var mess = resp.responseJSON?.message ??
                            "Une erreur s'est produite, merci de réessayer";
                        rep.removeClass().addClass('alert alert-danger').html(mess)
                            .slideDown();
                    }

                }).always(function(s) {
                    btn.attr('disabled', false).find('i').removeClass().addClass(iclass);
                });

            })
        })
    </script>
@endsection
