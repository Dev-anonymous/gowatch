@extends('layouts.main')
@section('title', 'Connexion')

@section('body')
    <x-nav-app />

    <div id="intro">
        <div class="mask">
            <div class="container d-flex align-items-center h-100">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-5 col-md-6">
                        <form class="shadow-5-strong p-5" id="f-log" style="border-radius: 20px">
                            <div class="text-center">
                                <h5 class="mb-5 font-weight-bold ">Connexion | {{ config('app.name') }}</h5>
                            </div>
                            <div class="form-outline mb-4">
                                <input id="form1Example1" required name="login" type="email" class="form-control" />
                                <label class="form-label " for="form1Example1">Email</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" required name="password" id="form1Example2" class="form-control" />
                                <label class="form-label " for="form1Example2">Mot de passe</label>
                            </div>
                            <div id="rep">
                            </div>
                            <div class="row mb-4">
                                <div class="col d-flex justify-content-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            id="form1Example3" />
                                        <label class="form-check-label " for="form1Example3">
                                            Rester connecté
                                        </label>
                                    </div>
                                </div>
                                <div class="col text-center">
                                    <a href="{{ route('recoveryview') }}" mdpforget class=""><i>Mot de passe
                                            oublié</i></a>
                                </div>
                            </div>
                            <button type="submit" class="btn app-btn btn-rounded btn-block">
                                <i class="fa fa-unlock"></i>
                                Se connecter
                            </button>
                            <div class="col text-center mt-3">
                                <a href="#" acmpt class=""><i>Créer un compte</i></a>
                            </div>
                        </form>
                        <form class="shadow-5-strong p-5" id="f-cmpt" style=" display: none; border-radius: 20px;">
                            <div class="text-center">
                                <h5 class="mb-5 font-weight-bold ">Création compte | {{ config('app.name') }}</h5>
                            </div>
                            <div class="form-outline mb-4">
                                <input name="name" required maxlength="30" class="form-control" />
                                <label class="form-label ">Votre nom</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input name="email" required type="email" class="form-control" />
                                <label class="form-label ">Email</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" name="password" required class="form-control" />
                                <label class="form-label ">Mot de passe</label>
                            </div>
                            <div class="mb-4">
                                <div class="col d-flex justify-content-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" required id="form1Example311" />
                                        <button type="button" data-toggle="modal" data-target="#mdlterm"
                                            class="btn-sm btn btn-link">
                                            J'accepte les termes et conditions
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <small class="text-danger">
                                    <i class="fa fa-info-circle"></i> Un email de confirmation sera envoyé à votre email
                                </small>
                            </div>
                            <div id="rep"></div>
                            <button type="submit" class="btn app-btn btn-rounded btn-block">
                                <i class="fa fa-user-alt"></i>
                                Créer le compte
                            </button>
                            <div class="col text-center mt-3">
                                <a href="#" alog class=""><i>Se connecter</i></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlterm" tabindex="-1" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-dark font-weight-bold">Termes et conditions </h4>
                </div>
                <div class="modal-body" style="max-height: 60vh; overflow:auto;">
                    <h1 class="text-dark">Conditions Générales d'Utilisation (CGU)</h1> <br>

                    <h2>1. Objet de l'application</h2>
                    <p>
                        L'application <strong>{{ config('app.name') }}</strong> est conçue pour aider les <strong>parents ou
                            tuteurs légaux</strong> à surveiller les activités numériques de leurs enfants mineurs à des
                        fins de sécurité et de protection.
                    </p>
                    <p>
                        Les fonctionnalités incluent notamment :
                    </p>
                    <ul>
                        <li>Suivi de la localisation GPS</li>
                        <li>Consultation des messages envoyés ou reçus</li>
                        <li>Historique de navigation</li>
                        <li>Suivi de l’activité sur certaines applications (ex. WhatsApp)</li>
                    </ul>
                    <h2>2. Utilisation légale et éthique</h2>
                    <p>
                        L'utilisateur s'engage à utiliser l'application <strong>uniquement dans un cadre légal</strong>.
                        Toute installation sur un appareil ne vous appartenant pas est strictement interdite.
                    </p>
                    <p>
                        L'utilisateur atteste être <strong>parent, tuteur légal, ou propriétaire légitime</strong> de
                        l'appareil surveillé.
                    </p>

                    <h2>3. Décharge de responsabilité</h2>
                    <p class="text-danger">
                        Le développeur et l’équipe de <strong>{{ config('app.name') }}</strong> déclinent <strong>toute
                            responsabilité</strong> en cas d’utilisation abusive, illégale ou non autorisée de
                        l’application.
                    </p>
                    <p class="text-danger">
                        L’utilisateur est seul responsable de s’assurer que l’utilisation de l’application est conforme aux
                        <strong>lois locales</strong> en vigueur.
                    </p>
                    <p>
                        Toute utilisation à des fins de harcèlement, d’espionnage ou de surveillance illégale est
                        <strong>strictement interdite</strong> et <strong>engage la responsabilité de
                            l’utilisateur</strong>.
                    </p>

                    <h2>4. Protection des données</h2>
                    <p>
                        L'application peut collecter certaines données (géolocalisation, messages, historique) pour fournir
                        les services attendus. Aucune donnée n'est vendue ou partagée à des tiers à des fins commerciales.
                    </p>
                    <p>
                        L'utilisateur est responsable de la sécurité des données collectées via son compte, et de
                        l’information de la personne surveillée si la loi locale l'exige.
                    </p>

                    <h2>5. Accès et sécurité</h2>
                    <p>
                        L'accès à l'application peut nécessiter la création d'un compte. L'utilisateur est responsable de la
                        confidentialité de ses identifiants et de toute activité liée à son compte.
                    </p>

                    <h2>6. Modifications des conditions</h2>
                    <p>
                        Nous nous réservons le droit de modifier les présentes conditions à tout moment. L’utilisation
                        continue de l’application après modification vaut acceptation des nouvelles conditions.
                    </p>

                    <h2>7. Contact</h2>
                    <p>
                        Pour toute question concernant ces conditions :
                    </p>
                    <ul>
                        <li>Email : <a href="mailto:go@gooomart.com">go@gooomart.com</a></li>
                        <li>Site web : <a href="{{ asset('') }}">{{ asset('') }}</a></li>
                    </ul>
                    <p><strong>En utilisant l'application, vous confirmez avoir lu, compris et accepté les présentes
                            conditions générales d'utilisation.</strong></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn app-btn btn-sm btn-rounded" data-dismiss="modal">Ok J'ai
                        compris</button>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
@endsection

@section('js-code')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            }
        });

        $('#f-log').submit(function() {
            event.preventDefault();
            var form = $(this);
            var btn = $(':submit', form).attr('disabled', true)
            btn.find('i').removeClass()
                .addClass('spinner-border spinner-border-sm');
            var data = form.serialize();
            var r = new URL(location.href).searchParams.get('r');
            if (r) {
                data = data + '&r=' + encodeURIComponent(r)
            }
            var rep = $('#rep', form);
            rep.slideUp();
            $.ajax({
                url: '{{ route('login.web') }}',
                type: 'post',
                data: data,
                timeout: 20000,
                success: function(res) {
                    if (res.success == true) {
                        rep.html(res.message).removeClass().addClass('alert alert-success')
                            .slideDown();
                        localStorage.setItem('_token', res.data.token);
                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    } else {
                        btn.attr('disabled', false).find('i').removeClass(
                                'spinner-border spinner-border-sm')
                            .addClass('fa fa-unlock');
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
                    btn.attr('disabled', false).find('i').removeClass().addClass(
                        'fa fa-unlock');
                }
            });
        });

        $('#f-cmpt').submit(function() {
            event.preventDefault();
            var form = $(this);
            var btn = $(':submit', form).attr('disabled', true)
            btn.find('i').removeClass()
                .addClass('spinner-border spinner-border-sm');
            var data = form.serialize();
            var rep = $('#rep', form);
            rep.slideUp();
            $.ajax({
                url: '{{ route('newuser.web') }}',
                type: 'post',
                data: data,
                timeout: 20000,
                success: function(res) {
                    if (res.success == true) {
                        rep.html(res.message).removeClass().addClass('alert alert-success')
                            .slideDown();
                        form[0].reset();
                        setTimeout(() => {
                            location.reload();
                        }, 5000);
                    } else {
                        btn.attr('disabled', false).find('i').removeClass(
                                'spinner-border spinner-border-sm')
                            .addClass('fa fa-unlock');
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
                    btn.attr('disabled', false).find('i').removeClass().addClass(
                        'fa fa-unlock');
                }
            });
        });

        $('[acmpt]').click(function() {
            event.preventDefault();
            $('#f-log').stop().hide();
            $('#f-cmpt').stop().slideDown();
        });
        $('[alog]').click(function() {
            event.preventDefault();
            $('#f-cmpt').stop().hide();
            $('#f-log').stop().slideDown();
        });

        @isset($token)
            localStorage.setItem('_token', '{{ $token }}');
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        @endisset
    </script>
@endsection
