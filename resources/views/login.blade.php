@extends('layouts.main')
@section('title', 'Connexion')

@section('body')
    <x-nav-app />

    <div id="intro" class="bg-image">
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
                                <a href="#" acmpt class=""><i>Ou créer un compte</i></a>
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
                                <a href="#" alog class=""><i>Ou se connecter</i></a>
                            </div>
                        </form>
                    </div>
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
