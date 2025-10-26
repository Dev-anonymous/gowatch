@extends('layouts.main')
@section('title', 'Parrainage & Filleuls')

@section('body')
    <x-sidebar />
    <x-nav />

    <div class="mdb-page-content page-intro">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mt-5" style="line-height: 25px">
                    <div class="card mt-5 mb-3 shadow-lg">
                        <div class="card-body">
                            <h3 class="font-weight-bold text-nowrap">Balance</h3>
                            <div class="row d-flex justify-content-center p-0 m-0">
                                @php
                                    $tab = [];
                                @endphp
                                @foreach ($balance as $el)
                                    @php
                                        $tab[$el->currency] = v($el->amount);
                                    @endphp
                                    <div class="col-md-3 m-0 p-0">
                                        <div class="{{ $el->amount ? 'text-success' : 'text-muted' }}">
                                            <b>{{ $el->currency }}</b> <br>
                                            <span style="font-size: 40px"
                                                class="font-weight-bold">{{ v($el->amount) }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="w-100 text-right">
                                <button class="btn btn-sm app-btn btn-rounded" bretire data="{{ json_encode($tab) }}">
                                    <i class="fa fa-hand-holding-dollar"></i>
                                    Retirer mon argent
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mt-5 mb-3 shadow-md">
                        <div class="card-body">
                            <h4 class="font-weight-bold"><i class="fa fa-child-dress"></i> Parrainage</h4>
                            <p class="text-danger">
                                <b>Tout commence ici !</b> partagez votre lien de parrainage et maximisez vos chances de
                                gagner de l’argent à chaque abonnement par vos filleuls.
                            </p>
                            <p class="text-danger">
                                A chaque fois qu’une personne crée un compte grâce votre lien de parrainage, elle devient
                                votre filleul, et une fois elle souscrit à un abonnement par exemple de 10 USD, vous gagnez
                                50%, c’est-à-dire 5 USD
                            </p>
                            @php
                                $link = slink();
                            @endphp
                            <b>Mon lien de parrainage</b>
                            <p>
                                <a href="{{ $link }}" target="_blank">
                                    <i class="fa fa-link"></i> {{ $link }}
                                </a>
                            </p>
                            <small class="text-danger" cres></small>
                            <div class="w-100">
                                <button class="btn btn-sm btn-rounded m-1 text-danger" link="{{ $link }}" bcopy>
                                    <i class="fa fa-clipboard"></i> Copier
                                </button>
                                <a class="btn btn-sm btn-rounded m-1 text-success" link="{{ $link }}" bwhat>
                                    <i class="fa fa-check-circle"></i> Partager sur whatsapp
                                </a>
                                <a class="btn btn-sm btn-rounded m-1 text-info" link="{{ $link }}" bface>
                                    <i class="fa fa-check-circle"></i> Partager sur facebook
                                </a>
                            </div>
                            @if ($father)
                                <p class="mt-5 text-primary">
                                    <i class="fa fa-exclamation-circle"></i>
                                    Vous avez créé votre compte grâce au lien de parrainage de <b>{{ $father->name }}.</b>
                                </p>
                            @endif
                        </div>
                        <hr>
                        <div class="card-header">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <h4 class="font-weight-bold text-nowrap"> <i class="fa fa-children"></i> Mes filleuls
                                </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table tdata class="table table-sm table-condensed table-hover table-striped"
                                    style="width: 100%">
                                    <thead>
                                        <th></th>
                                        <th>Nom</th>
                                        <th>Date création</th>
                                        <th>Type Abonnement</th>
                                        <th>Date Abonnement</th>
                                        <th>Montant Gagné</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $k => $el)
                                            @php
                                                $sp = $el->sponsorpays()->first();
                                                $m = 0;
                                                if ($sp) {
                                                    $m = v($sp->amount, $sp->currency);
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td class="text-nowrap">{{ $el->name }}</td>
                                                <td class="text-nowrap">{{ $el->created_at?->format('d-m-Y H:i:s') }}</td>
                                                <td class="text-nowrap">{{ @$sp->type ?? '-' }}</td>
                                                <td class="text-nowrap">{{ @$sp->date?->format('d-m-Y H:i:s') ?? '-' }}
                                                </td>
                                                <td class="text-nowrap">{{ $m ? $m : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card mt-5 mb-3 shadow-md">
                        <div class="card-header">
                            <div class="d-flex flex-wrap justify-content-between align-items-center">
                                <h4 class="font-weight-bold text-nowrap"> <i class="fa fa-hand-holding-dollar"></i> Mes
                                    retrait de fonds
                                </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table tdata class="table table-sm table-condensed table-hover table-striped"
                                    style="width: 100%">
                                    <thead>
                                        <th></th>
                                        <th>Montant</th>
                                        <th>Vers</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraws as $k => $el)
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td class="text-nowrap">{{ v($el->amount, $el->currency) }}</td>
                                                <td class="text-nowrap">{{ $el->number }}</td>
                                                <td class="text-nowrap">{{ $el->date?->format('d-m-Y H:i:s') }}</td>
                                                <td class="text-nowrap">
                                                    {!! $el->status
                                                        ? "<span class='badge bg-success' style='width:130px'><i class='fa fa-check-circle'></i> ARGENT ENVOYÉ </span>"
                                                        : "<span class='badge bg-warning' style='width:130px'><i class='fa fa-spinner fa-spin'></i> EN ATTENTE </span>" !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <x-footer />

    <div class="modal fade" id="mdlretire" tabindex="-1" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark font-weight-bold">Retrait de fonds</h5>
                    <i class="fa fa-times text-muted fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
                </div>
                <div class="modal-body">
                    <form action="#" f-pay2>
                        <div class="my-3">
                            <div class="text-center">
                                <b class="mr-2">Vous pouvez envoyer votre argent vers</b>
                            </div>
                            <div class="d-flex justify-content-center mb-5">
                                <a class="m-1">
                                    <img class="img-thumbnail shadow-lg" src="{{ asset('img/payment-method/airtel.png') }}"
                                        width="100px" height="50px" alt="" />
                                </a>
                                <a class="m-1">
                                    <img class="img-thumbnail shadow-lg"
                                        src="{{ asset('img/payment-method/vodacom.png') }}" width="100px" height="50px"
                                        alt="" />
                                </a>
                                <a class="m-1">
                                    <img class="img-thumbnail shadow-lg" src="{{ asset('img/payment-method/orange.png') }}"
                                        width="100px" height="50px" alt="" />
                                </a>
                                <a class="m-1">
                                    <img class="img-thumbnail shadow-lg"
                                        src="{{ asset('img/payment-method/afrimoney.png') }}" width="100px"
                                        height="50px" alt="" />
                                </a>
                            </div>
                        </div>
                        <div class="form-outline mb-3">
                            <input id="paymt" readonly class="form-control" value="0" />
                            <label class="form-label" for="paymt">Je compte retirer la somme de </label>
                        </div>
                        <div class="form-group mb-3">
                            <select name="devise" class="form-control">
                                <option>CDF</option>
                                <option>USD</option>
                            </select>
                        </div>
                        <div class="form-outline mb-4 input-group flex-nowrap">
                            <span class="input-group-text" id="addon-wrapping">+243</span>
                            <input required class="form-control" required pattern="[0-9.]+" minlength="9"
                                maxlength="9" name="phone" />
                            <label class="form-label">A ce numéro</label>
                        </div>
                        <div class="mt-3 mb-3">
                            <div id="rep"></div>
                        </div>
                        <button class="btn btn-sm app-btn btn-block btn-rounded" type="submit">
                            <span></span>
                            Retirer
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white btn-rounded btn-sm" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js-code')
    @include('files.datatable-js')

    <script>
        $(function() {
            new DataTable('[tdata]', {
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                columnDefs: [{
                        targets: 0,
                        width: '1%'
                    },
                    {
                        targets: 2,
                        width: '1%'
                    },
                ],
            });

            var mdl = $('#mdlretire');
            var sel = $('[name="devise"]', mdl);
            var btn = $('[bretire]');
            sel.change(function() {
                setbal();
            });

            function setbal() {
                var data = JSON.parse(btn.attr('data'));
                var cdf = data['CDF'];
                var usd = data['USD'];
                var v = sel.val();
                if (v == 'CDF') {
                    $('#paymt', mdl).val(cdf);
                } else if (v == 'USD') {
                    $('#paymt', mdl).val(usd);
                }
            }

            btn.click(function() {
                setbal();
                new mdb.Modal(mdl[0]).show();
            });


            $('[f-pay2]').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form);
                var rep = $('#rep', form);
                rep.html('').removeClass();
                var data = form.serialize();

                btn.attr('disabled', true).find('span').removeClass().addClass(
                    'spinner-border spinner-border-sm');
                $.ajax({
                    url: '{{ route('withdraw') }}',
                    type: 'post',
                    data: data,
                    success: function(res) {
                        if (res.success) {
                            rep.html(res.message).removeClass();
                            rep.addClass('alert alert-success');
                            btn.attr('disabled', true);
                            setTimeout(() => {
                                location.reload();
                            }, 5000);
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

            $('[bcopy]').click(function() {
                var btn = $(this);
                btn.attr('disabled', true);
                var i = btn.find('i');
                var cl = i.attr('class');
                i.removeClass();
                i.addClass('fa fa-check-circle');
                var link = btn.attr('link');
                try {
                    navigator.clipboard.writeText(link);
                    $('[cres]').html("Le lien de parrainage a été copié dans votre press-papier !");
                } catch (error) {
                    $('[cres]').html("Erreur de la copie du lien");
                }
                setTimeout(() => {
                    i.removeClass();
                    i.addClass(cl);
                    btn.attr('disabled', false);
                    $('[cres]').html('');
                }, 5000);
            });

            $('[bwhat]').click(function() {
                var link = $(this).attr('link');
                link = encodeURIComponent(link);
                var wu = `https://api.whatsapp.com/send?text=${link}`;
                location.assign(wu);
            });
            $('[bface]').click(function() {
                var link = $(this).attr('link');
                link = encodeURIComponent(link);
                var fbu = `https://www.facebook.com/sharer/sharer.php?u=${link}`;
                window.open(fbu, "_blank");
            });
        });
    </script>
@endsection
