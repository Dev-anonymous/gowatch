@extends('layouts.main')
@section('title', 'Paiements')

@section('body')
    <x-sidebar />
    <x-nav />

    <div class="mdb-page-content page-intro bg-white">
        <div class="container py-3 ">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="d-flex justify-content-between mt-5 mb-3">
                        <h6 class="font-weight-bold"> TRANSACTIONS (<span nb></span>)</h6>
                        <div class="">
                            <button class="btn btn-danger btn-sm mr-2" style="text-transform: none" data-toggle="modal"
                                data-target="#mdlqr">
                                <i class="fa fa-qrcode mr-1"></i>
                                PAIEMENT PAR QrCODE
                            </button>
                            <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#mdladd">
                                <i class="fa fa-hand-holding-dollar mr-1"></i>
                                ACCEPTER UN PAIEMENT
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="row mb-2">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <div class="row no-gutters">
                                <div class="col">
                                    <div class="">
                                        @php
                                            $d2 = now();
                                            $d1 = now()->subDays(7);
                                        @endphp
                                        <span>Date</span>
                                        <input name="date" type="text" class="form-control form-control-sm"
                                            id="date" value="{{ "{$d1->format('Y-m-d')} to {$d2->format('Y-m-d')}" }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow-lg mb-2" style="border-radius: 10px">
                        <div class="card-body font-weight-bold">
                            <div class="d-flex justify-content-end px-md-1">
                                <div style="line-height: 1.1">
                                    <p class="mb-0 fa-2x" solde></p>
                                    <p class="mb-0 font-italic text-right">Total</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <x-error />
                    <div class="table-responsive">
                        <table tdata class="table table-sm table-condensed table-hover table-striped font-weight-bold"
                            style="width: 100%">
                            <thead class="table-dark">
                                <th></th>
                                <th></th>
                                <th>TRANS. ID</th>
                                <th>MONTANT</th>
                                <th>NUMERO</th>
                                <th>SOURCE</th>
                                <th class="text-right">DATE</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mdladd" tabindex="-1" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark font-weight-bold">Accepter un paiement</h5>
                    <i class="fa fa-times text-muted fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
                </div>
                <form class="f-val" action="#">
                    <input type="hidden" name="paytype" value="marchand-epay">
                    <input type="hidden" name="users_id" value="{{ auth()->user()->id }}">
                    <div class="modal-body">
                        <div class="bg-white rounded shadow-lg p-5">
                            <p>
                                Saisissez le montant et le numéro du client qui veut effectuer la transaction.
                            </p>
                            <hr>
                            <div class="form-outline mb-3 input-group flex-nowrap">
                                <input required type="number" step="0.01" name="amount"
                                    class="form-control form-control-sm" />
                                <label class="form-label" for="form1Example1">Montant à payer</label>
                                <span class="input-group-text" id="addon-wrapping">
                                    <select class='form-control form-control-sm' name="devise">
                                        <option>CDF</option>
                                        <option>USD</option>
                                    </select>
                                </span>
                            </div>
                            <div class="form-outline mb-4 input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">+243</span>
                                <input required class="form-control phone" />
                                <label class="form-label" for="form1Example1">Numéro</label>
                            </div>
                            <div class="form-outline mb-2 input-group flex-nowrap">
                                <input name="myref" class="form-control" />
                                <label class="form-label" for="form1Example1">Réference (optionnel), Ex : ref001</label>
                            </div>
                            <button type="button" btngen class="btn btn-rounded btn-sm mb-3">
                                <i class="fa fa-lightbulb"></i>
                                Générer
                            </button>
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-seconday btn-sm" id="btnclose"
                            data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-seconday btn-sm" id="btncancel"
                            style="display: none">Annuler</button>
                        <button type="submit" class="btn btn-dark btn-sm">
                            <i class="fa fa-money-bill-transfer"></i>
                            Initier la transaction
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mdlqr" tabindex="-1" data-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark font-weight-bold">Accepter un paiement via QrCODE</h5>
                    <i class="fa fa-times text-muted fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
                </div>
                <form id="f-qr" action="#">
                    <div class="modal-body">
                        <div class="bg-white rounded shadow-lg p-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        Saisissez le montant et le numéro du client qui veut effectuer la transaction.
                                    </p>
                                    <hr>
                                    <div class="form-outline mb-3 input-group flex-nowrap">
                                        <input required type="number" step="0.01" name="amount"
                                            class="form-control form-control-sm" />
                                        <label class="form-label" for="form1Example1">Montant à payer</label>
                                        <span class="input-group-text" id="addon-wrapping">
                                            <select class='form-control form-control-sm' name="devise">
                                                <option>CDF</option>
                                                <option>USD</option>
                                            </select>
                                        </span>
                                    </div>
                                    <div class="form-outline mb-4 input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping">+243</span>
                                        <input class="form-control phone" />
                                        <label class="form-label" for="form1Example1">Numéro (optionnel)</label>
                                    </div>
                                    <div class="form-outline mb-2 input-group flex-nowrap">
                                        <input name="myref" class="form-control" />
                                        <label class="form-label" for="form1Example1">Réference (optionnel), Ex :
                                            ref001</label>
                                    </div>
                                    <button type="button" btngen class="btn btn-rounded btn-sm mb-3">
                                        <i class="fa fa-lightbulb"></i>
                                        Générer
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <div divqr style="display: none">
                                        <div id="payqrcode"
                                            style=" display: flex; justify-content: center;  align-items: center; ">
                                        </div>
                                        <div class="text-center">
                                            <p class="mt-3 font-weight-bold">
                                                Le client doit scanner ce QrCode pour payer.
                                            </p>
                                            <button type="button" class="btn btn-sm btn-rounded my-2" bdownload>
                                                <i class="fa fa-download"></i>
                                                Télécharger
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-seconday btn-sm" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-dark btn-sm">
                            <i class="fa fa-qrcode"></i>
                            Generer le QRCODE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-footer />
@endsection

@section('js-code')
    @include('files.datatable-js')
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('js/swal/swal.all.min.js') }}"></script>
    <script src="{{ asset('vendor/qrcode/qrcode.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/swal/swal/swal.min.css') }}">

    @include('files.flatpickr')
    @include('files.select')

    @php
        $logourl = '';
        $logo = auth()->user()->user->logo;
        if ($logo) {
            $logourl = asset('storage/' . $logo);
        } else {
            $logourl = asset('img/logo.png');
        }
    @endphp

    <script>
        $(function() {
            flatpickr("#date", {
                mode: "range",
                maxDate: "today",
                locale: {
                    firstDayOfWeek: 1
                }
            });
            $('.select2').select2();
            var seldate = $('[name=date]');
            seldate.change(function() {
                datatableOb.ajax.reload(null, false);
            });

            $('[btngen]').click(function() {
                var id = Math.random().toString().split('0.').join('');
                var i = $('[name="myref"]');
                i.val('myref-' + id);
                var d = i.closest('.form-outline');
                d.each(function(e, i) {
                    new mdb.Input(i).update();
                });
            });

            $('.phone').mask('000000000');

            var fval = $('.f-val');
            canxhr = true;
            xhr = [];
            var callback = function() {
                var x = $.ajax({
                    url: '{{ route('pay.index') }}',
                    data: {
                        myref: REF,
                        users_id: '{{ auth()->user()->id }}'
                    },
                }).always(function(res) {
                    var trans = res.transaction;
                    var status = trans?.status;
                    if (status === 'success') {
                        datatableOb.ajax.reload(null, true);
                        var form = fval;
                        var btn = $(':submit', form).attr('disabled', false);
                        btn.html(
                            '<i class="fa fa-money-bill-transfer"></i> Initier la transaction'
                        );
                        btn.removeClass('btn-danger').addClass('btn-dark');
                        rep = $('#rep', form);
                        rep.html(res.message).removeClass();
                        rep.addClass('alert alert-success');
                        rep.slideDown();
                        Swal.fire(
                            'TRANSACTION EFFECTUEE !',
                            res.message, 'success'
                        ).then((result) => {
                            if (result.isConfirmed) {
                                //
                            }
                        })
                        canxhr = false;
                        $('#btncancel').hide();
                        $('#btnclose').show();
                    } else if (status === 'failed') {
                        var form = fval;
                        var btn = $(':submit', form).attr('disabled', false);
                        btn.html(
                            '<i class="fa fa-money-bill-transfer"></i> Initier la transaction'
                        );
                        btn.removeClass('btn-danger').addClass('btn-dark');
                        var rep = $('#rep', form);
                        rep.html(res.message).removeClass();
                        rep.addClass('alert alert-danger');
                        $(xhr).each(function(i, e) {
                            e.abort();
                        });
                        Swal.fire(
                            'TRANSACTION ECHOUEE !',
                            "Le client a peut-être saisi un mauvais Pin ou son solde est insuffisant. Merci de réessayer.",
                            'error'
                        );
                        canxhr = false;
                        $('#btncancel').hide();
                        $('#btnclose').show();
                    }
                    if (canxhr) {
                        setTimeout(() => {
                            callback();
                        }, 3000);
                    }
                });
                xhr.push(x);
            }
            $('#btncancel').click(function() {
                canxhr = false;
                $(this).hide();
                $('#btnclose').show();
                var form = fval;
                var btn = $(':submit', form).attr('disabled', false);
                btn.html(
                    '<i class="fa fa-money-bill-transfer"></i> Initier la transaction'
                );
                btn.removeClass('btn-danger').addClass('btn-dark');
                var rep = $('#rep', form);
                rep.html(
                    "Paiement annulé. Si le client recoit un message push à son téléphone, <b>QU'IL NE LE VALIDE PAS.</b>"
                ).removeClass();
                rep.addClass('alert alert-warning');
                $(xhr).each(function(i, e) {
                    e.abort();
                });
            });

            fval.off('submit').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form).attr('disabled', true);
                var bhtml = btn.html();
                var iclass = btn.find('i').attr('class');
                btn.find('i').removeClass()
                    .addClass('spinner-border spinner-border-sm');
                var data = form.serialize();
                data += "&telephone=" + encodeURIComponent('+243' + $('.phone', form).val());
                rep = $('#rep', form);
                rep.slideUp();
                canxhr = true;
                $.ajax({
                    url: '{{ route('pay.store') }}',
                    type: 'POST',
                    data: data,
                    timeout: 30000,
                    success: function(res) {
                        if (res.success == true) {
                            var l =
                                '<b class="text-danger">Transaction initialisée, demandez au client de saisir son code mobile money à son téléphone pour confirmer la transaction.</b>'
                            rep.html(l).removeClass();
                            rep.addClass('alert alert-success');
                            rep.slideDown();
                            btn.html(
                                '<i class="spinner-border spinner-border-sm"></i> En attente de validation ...'
                            );
                            btn.attr('disabled', true).removeClass('btn-dark').addClass(
                                'btn-danger');
                            REF = res.data.myref;
                            $('#btnclose').hide();
                            $('#btncancel').show();
                            callback();

                        } else {
                            var m = (res.message + ' ' + res.data?.errors_msg?.join('<br>')) ??
                                '';
                            rep.removeClass().addClass('alert alert-danger').html(m)
                                .slideDown();
                            btn.attr('disabled', false).find('i').removeClass().addClass(
                                iclass);
                        }
                    },
                    error: function(resp) {
                        var mess = resp.responseJSON?.message ??
                            "Une erreur s'est produite, merci de réessayer";
                        rep.removeClass().addClass('alert alert-danger').html(mess)
                            .slideDown();
                        btn.attr('disabled', false).find('i').removeClass().addClass(iclass);
                    }

                });
            });

            var showloader = true;

            var datatableOb = (new DataTable('[tdata]', {
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
                    url: "{{ route('transaction.index', ['datatable' => '']) }}",
                    beforeSend: function() {
                        if (!showloader) return;
                        $('[tdata]').closest('div').LoadingOverlay("show", {
                            maxSize: 50
                        });
                    },
                    data: function(data) {
                        data.date = seldate.val();
                    },
                    complete: function() {
                        $('[tdata]').closest('div').LoadingOverlay("hide");
                    },
                    error: function(resp) {
                        $('[onerror]').slideDown();
                    },
                    dataSrc: function(json) {
                        $('[solde]').html(json.tot.join(' | '));
                        return json.data;
                    }

                },
                order: [
                    [0, "desc"]
                ],
                columnDefs: [{
                        targets: 0,
                        width: '1%'
                    },
                    {
                        targets: 1,
                        width: '1%'
                    },
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
                        name: 'trans_id'
                    },
                    {
                        data: 'montant',
                        name: 'montant',
                        class: 'text-nowrap'
                    },
                    {
                        data: 'numero',
                        name: 'numero',
                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'source',
                        name: 'source',
                    },
                    {
                        data: 'date',
                        name: 'date',
                        class: 'text-right'
                    },
                ]
            })).on('xhr.dt',
                function(e, settings, data, xhr) {
                    $('span[nb]').html(data.recordsTotal);
                });


            let isRequestInProgress = false;

            function reloadDataTable() {
                return new Promise((resolve, reject) => {
                    datatableOb.ajax.reload(function(json) {
                        resolve(json);
                    }, false);
                });
            }
            setInterval(async () => {
                if (isRequestInProgress) return;
                isRequestInProgress = true;
                showloader = false;
                try {
                    const json = await reloadDataTable();
                } catch (error) {}
                showloader = true;
                isRequestInProgress = false;
            }, 5000);

            const qrCode = new QRCodeStyling({
                width: 250,
                height: 250,
                type: "png",
                data: "",
                image: "{{ $logourl }}",
                dotsOptions: {
                    // color: "#4267b2",
                    type: "rounded"
                },
                // backgroundOptions: {
                //     color: "#e9ebee",
                // },
                imageOptions: {
                    crossOrigin: "anonymous",
                    margin: 5
                }
            });

            qrCode.append(document.getElementById("payqrcode"));

            $('[bdownload]').click(function() {
                qrCode.download({
                    name: "qrcode",
                    extension: "png"
                });
            })

            $('#f-qr').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form).attr('disabled', true);
                var bhtml = btn.html();
                var iclass = btn.find('i').attr('class');
                btn.find('i').removeClass()
                    .addClass('spinner-border spinner-border-sm');
                var data = form.serialize();
                var tel = $('.phone', form).val();
                if (tel.length > 5) {
                    data += "&telephone=" + encodeURIComponent('+243' + tel);
                }
                rep = $('#rep', form);
                rep.slideUp();
                $.ajax({
                    url: '{{ route('qrcode.store') }}',
                    type: 'POST',
                    data: data,
                    timeout: 30000,
                    success: function(res) {
                        if (res.success == true) {
                            btn.find('i').removeClass();
                            rep.html(res.message).removeClass();
                            rep.addClass('alert alert-success');
                            rep.slideDown();
                            btn.attr('disabled', false);
                            qrCode.update({
                                data: res.data.link
                            });
                            $('[divqr]').fadeIn();

                            setTimeout(() => {
                                rep.slideUp();
                            }, 3000);

                        } else {
                            var m = (res.message + ' ' + res.data?.errors_msg?.join('<br>')) ??
                                '';
                            rep.removeClass().addClass('alert alert-danger').html(m)
                                .slideDown();
                            btn.attr('disabled', false).find('i').removeClass().addClass(
                                iclass);
                        }
                    },
                    error: function(resp) {
                        var mess = resp.responseJSON?.message ??
                            "Une erreur s'est produite, merci de réessayer";
                        rep.removeClass().addClass('alert alert-danger').html(mess)
                            .slideDown();
                        btn.attr('disabled', false).find('i').removeClass().addClass(iclass);
                    }
                });
            });

        })
    </script>
@endsection
