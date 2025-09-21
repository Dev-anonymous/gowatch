@extends('layouts.main')
@section('title', 'Feedback')

@section('body')
    <x-sidebar />
    <x-nav />

    <div class="mdb-page-content page-intro bg-white">
        <div class="container py-3 ">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="d-flex justify-content-between mt-5 mb-3">
                        <h3 class="font-weight-bold">FEEDBACKS (<span nb></span>)</h3>
                        <div class="">
                            <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#mdladd">
                                <i class="fa fa-envelope mr-1"></i>
                                Emails
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <x-error />
                    <div class="table-responsive">
                        <table tdata class="table table-sm table-condensed table-hover table-striped">
                            <thead class="table-dark">
                                <th></th>
                                <th>UTILISATEUR</th>
                                <th>CONTACT</th>
                                <th>SUJET</th>
                                <th>MESSAGE</th>
                                <th class="text-right">DATE</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
    <div class="modal fade" id="mdladd" tabindex="-1" aria-labelledby="mdladdLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark font-weight-bold" id="exampleModalLabel">Envoi mails</h5>
                    <i class="fa fa-times text-muted fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
                </div>
                <form class="was-validated" id="f-mail" action="#">
                    <div class="modal-body">
                        <div class="bg-white rounded shadow-lg p-5">
                            <div class="form-outline mb-4">
                                <input id="form1Example1" required name="email" type="text" class="form-control" />
                                <label class="form-label" for="form1Example1">A</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input id="form1Example1" required name="objet" class="form-control" />
                                <label class="form-label" for="form1Example1">Object</label>
                            </div>
                            <div class="form-outline mb-4">
                                <textarea name="mail" id="" class="form-control" rows="10" required></textarea>
                                <label class="form-label" for="form1Example1">Mail</label>
                            </div>
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-seconday btn-sm" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-dark btn-sm">
                            <i class="fa fa-save"></i>
                            Envoyer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js-code')
    @include('files.datatable-js')
    <script src="{{ asset('js/swal/swal.all.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('js/swal/swal/swal.min.css') }}">
    <script>
        $(function() {
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
                    url: "{{ route('feedback.index', ['datatable' => '']) }}",
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
                    }
                },
                order: [
                    [0, "desc"]
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'nom',
                        name: 'nom'
                    },
                    {
                        data: 'contact',
                        name: 'contact',
                    },
                    {
                        data: 'sujet',
                        name: 'sujet',
                    },
                    {
                        data: 'message',
                        name: 'message',
                    },
                    {
                        data: 'date',
                        name: 'date',
                        class: 'text-right'
                    }
                ]
            })).on('xhr.dt',
                function(e, settings, data, xhr) {
                    $('span[nb]').html(data.recordsTotal);
                });
        })


        $('#f-mail').submit(function() {
            event.preventDefault();
            var form = $(this);
            var btn = $(':submit', form).attr('disabled', true);
            var iclass = btn.find('i').attr('class');
            btn.find('i').removeClass()
                .addClass('spinner-border spinner-border-sm');
            var data = form.serialize();
            data += "&phone=" + encodeURIComponent('+243' + $('#phone').val());
            rep = $('#rep', form);
            rep.slideUp();
            $.ajax({
                url: '{{ route('sendmail') }}',
                type: 'POST',
                data: data,
                timeout: 20000,
                success: function(res) {
                    if (res.success == true) {
                        rep.html(res.message).removeClass().addClass('alert alert-success')
                            .slideDown();
                        form[0].reset();
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
                    rep.removeClass().addClass('alert alert-danger').html(mess).slideDown();
                }

            }).always(function(s) {
                btn.attr('disabled', false).find('i').removeClass().addClass(iclass);
            });
        })
    </script>
@endsection
