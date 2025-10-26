 <html lang="en">

 <head>
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="format-detection" content="telephone=no">
     <meta name="apple-mobile-web-app-capable" content="yes">
     <title>Accueil - {{ config('app.name') }} </title>
     <link rel='shortcut icon' type='image/x-icon' href="{{ asset('img/icon.png') }}" />

     <x-meta />

     <link rel="stylesheet" href="{{ asset('css/fontawesome-6.4.2/css/all.css') }}">
     <link rel="stylesheet" href="{{ asset('css/bs4.min.css') }}" />
     <link rel="stylesheet" href="{{ asset('css/mdb4.min.css') }}" />
     <style>
         html,
         body,
         header,
         .intro-2 {
             height: 100%;
         }

         @media (max-width: 740px) {

             html,
             body,
             header,
             .intro-2 {
                 height: 900px;
             }
         }

         @media (min-width: 800px) and (max-width: 850px) {

             html,
             body,
             header,
             .intro-2 {
                 height: 900px;
             }
         }

         .creative-lp .rgba-gradient .mask {
             background: rgba(33, 33, 33, 0.8);
         }
     </style>
 </head>

 <body class="creative-lp">
     <x-loader />
     <x-nav-app />
     <div class="pt-5"></div>
     <div class="pt-5"></div>
     {{-- <header>
          <section class="view intro-2" style="background-image: url('{{ asset('img/d.png') }}');">
             <div class="mask">
                 <div class="container h-100 d-flex justify-content-center align-items-center">
                     <div class="row flex-center pt-5 mt-3">
                         <div class="col-md-12 col-lg-6 text-center text-md-left text-white">
                             <div class="dark-grey-text p-3 mt-5"
                                 style="background: rgba(0,0,0,.25); border-radius: 10px">
                                 <h1 class="display-4 mt-5 font-weight-bold wow fadeIn" data-wow-delay="0.3s">
                                     <strong class="text-white">
                                         {{ config('app.name') }}
                                     </strong>
                                     <strong style="font-size: 10px"
                                         class="text-dark bg-warning rounded-pill p-1">Powered By Gooomart</strong>
                                 </h1>
                                 <hr class="hr-light wow fadeIn" data-wow-delay="0.3s">
                                 <h5 class="text-white wow fadeIn font-weight-bold" data-wow-delay="0.3s">
                                     Nous travaillons durement pour vous faciliter et sécuriser vos paiements en ligne.
                                     Maximiser vos chiffres d'affaires en optant pour les paiements électroniques grâce
                                     à
                                     {{ config('app.name') }} ! c'est

                                 </h5>
                                 <br>
                                 <a href="#contact" id="a-contact"
                                     class="btn btn-white rounded-lg font-weight-bold ml-lg-0 wow fadeIn"
                                     data-wow-delay="0.3s">Contact</a>
                                 <a href="{{ route('app.login') }}"
                                     class="btn btn-dark rounded-lg font-weight-bold wow fadeIn"
                                     data-wow-delay="0.3s">Commencer
                                 </a>
                             </div>
                         </div>

                         <div class="col-md-12 col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                             <img src="{{ asset('img/1.png') }}" alt="" class="img-fluid">
                         </div>
                     </div>
                 </div>
             </div>
         </section>
     </header> --}}
     <main>
         <div class="container">
             <section id="features" class="pb-4">
                 <h3 class="text-center title my-5 font-weight-bold wow fadeInRight" data-wow-delay="0.2s">
                     <strong class="text-dark"><span style="color:#00C853;">{{ config('app.name') }}</span> est une
                         Solution Android gratuite de surveillance à distance avec plusieurs fonctionnalités
                     </strong>
                 </h3>
                 {{-- <p class="text-center w-responsive mx-auto my-5 text-dark font-weight-bold wow fadeIn"
                     data-wow-delay="0.2s">
                     Vous avez opté pour les paiements électroniques ? {{ config('app.name') }} vous offre la
                     possibilité de recevoir les paiements sur votre plateforme.
                 </p> --}}
                 <div class="row features-small wow fadeInUp text-dark" data-wow-delay="0.4s">
                     <div class="col-md-4 col-sm-6">
                         <div class="row mb-3">
                             <div class="col-2">
                                 <i class="fas fa-map-marker-alt fa-2x"></i>
                             </div>
                             <div class="col-10 mb-2">
                                 <h5 class="font-weight-bold text-dark ">Suivi GPS</h5>
                                 <p>
                                     Permet de localiser l'appareil en temps réel à l’aide de sa position GPS, avec la
                                     possibilité d’afficher l’historique des déplacements.
                                 </p>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                         <div class="row">
                             <div class="col-2">
                                 <i class="fas fa-phone-flip fa-2x text-warning"></i>
                             </div>
                             <div class="col-10 mb-2">
                                 <h5 class="font-weight-bold text-dark">Appels</h5>
                                 <p class="text-dark">
                                     Offre la possibilité de voir l'historique des appels téléphoniques: manqués,
                                     entrants, sortants.
                                 </p>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                         <div class="row mb-3">
                             <div class="col-2">
                                 <i class="fas fa-bell fa-2x text-primary"></i>
                             </div>
                             <div class="col-10 mb-2">
                                 <h5 class="font-weight-bold text-dark">Accès aux notifications
                                 </h5>
                                 <p class="text-dark">
                                     Permet de consulter toutes les notifications reçues par l’appareil, y compris
                                     celles des messages, réseaux sociaux, appels, et autres applications.
                                 </p>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                         <div class="row mb-3">
                             <div class="col-2">
                                 <i class="fas fa-keyboard text-success fa-2x"></i>
                             </div>
                             <div class="col-10 mb-2">
                                 <h5 class="font-weight-bold text-dark"> Key logger</h5>
                                 <p class="text-dark">
                                     Possibilité d'enregistrer toutes les frappes clavier effectuées sur l’appareil,
                                     permettant de
                                     surveiller les messages tapés, les recherches et les identifiants saisis.
                                 </p>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                         <div class="row mb-3">
                             <div class="col-2">
                                 <i class="fas fa-contact-book fa-2x text-info"></i>
                             </div>
                             <div class="col-10 mb-2">
                                 <h5 class="font-weight-bold text-dark">Lecture des contacts</h5>
                                 <p class="text-dark">
                                     Possibilité d'accèder à la liste des contacts enregistrés sur l’appareil, y compris
                                     noms, numéros
                                     de téléphone et adresses e-mail.
                                 </p>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                         <div class="row">
                             <div class="col-2">
                                 <i class="fa fa-wifi fa-2x text-danger"></i>
                             </div>
                             <div class="col-10 mb-2">
                                 <h5 class="font-weight-bold text-dark"> Prendre photo/vidéo/audio à distance</h5>
                                 <p class="text-dark">
                                     Possibilité d'ctiver à distance la caméra ou le micro de l’appareil pour capturer
                                     des images,
                                     vidéos ou enregistrements audio sans que l’utilisateur ne s’en rende compte.
                                 </p>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4 col-sm-6">
                         <div class="row">
                             <div class="col-2">
                                 <i class="fa fa-microphone-alt fa-2x text-danger"></i>
                             </div>
                             <div class="col-10 mb-2">
                                 <h5 class="font-weight-bold text-dark"> Enregistrements d'appel</h5>
                                 <p class="text-dark">
                                     Permet d’enregistrer tous les appels téléphoniques, WhatsApp et Telegram.
                                 </p>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-12">
                         <div class="my-3">
                             <div class="w-100 text-center py-3 text-center">
                                 <a onclick="location.assign('{{ asset('app.apk') }}')"
                                     class="btn btn-sm app-btn btn-rounded">
                                     <i class="fa fa-download"></i> Télécharger l'application Android
                                 </a>
                             </div>
                         </div>
                     </div>
                 </div>
             </section>
         </div>
         <div class="container text-dark wow fadeIn">
             <h2>{{ config('app.name') }} : l’application de contrôle parental (Android)</h2>
             <p>
                 L’application <b class="text-danger">Android</b> a été conçue dans le but de fournir aux parents un
                 outil efficace et discret pour
                 assurer la sécurité de leurs enfants, tant dans leur usage quotidien du smartphone que dans
                 leurs déplacements. Elle s’adresse aux parents soucieux de prévenir les risques liés aux
                 nouvelles technologies, tout en favorisant un encadrement responsable et bienveillant.
             </p>

             <p>Grâce à un ensemble de fonctionnalités avancées, les parents peuvent :</p>
             <ul>
                 <li><strong>Localiser l'enfant :</strong> Suivre en temps réel la position géographique de leur
                     enfant à l’aide du GPS, avec accès à l’historique des déplacements.</li>
                 <li><strong>Prise de photo, vidéo ou audio à distance :</strong> Activer à distance la caméra
                     ou le microphone de l’appareil pour capturer des contenus en cas de situation préoccupante.
                 </li>
                 <li><strong>Lecture des contacts :</strong> Consulter les contacts enregistrés afin de
                     surveiller les interactions sociales et repérer d’éventuelles personnes non autorisées.
                 </li>
                 <li><strong>Accéder aux notifications :</strong> Accéder aux notifications reçues (messages,
                     réseaux sociaux, applications) pour mieux comprendre l’activité numérique de l’enfant.</li>
                 <li><strong>Acceéder au Keylogger :</strong> Utiliser un journal des frappes clavier pour
                     détecter les signes de harcèlement, de cyberintimidation ou de comportements à risque.</li>
                 <li><strong>Surveiller des appels :</strong> Surveiller les appels téléphoniques entrants et
                     sortants, avec possibilité d’enregistrement si nécessaire.</li>
             </ul>
             <p>
                 Toutes ces fonctionnalités sont proposées dans un cadre strictement légal et destiné à un usage
                 parental, dans le respect de la vie privée de l’enfant, avec pour objectif principal sa
                 <strong>protection</strong>, son <strong>accompagnement numérique</strong> et le
                 <strong>renforcement du dialogue familial</strong>.
             </p>
         </div>
         <div class="container text-dark py-5" id="money">
             <h3 class="text-center title mt-5 mb-3 font-weight-bold wow fadeInLeft" data-wow-delay="0.2s">
                 <strong class="text-dark">
                     <i class="fa fa-hand-holding-dollar"></i> Gagner de l'argent grâce à <span
                         style="color:#00C853;">{{ config('app.name') }}</span> : 🎉 Programme de parrainage
                 </strong>
             </h3>
             <div class="wow fadeInRight">
                 <h2>Recommandez l’application à d’autres parents et gagnez de l’argent !</h2>
                 <p>
                     C’est simple : 👉 Chaque fois qu’un parent s’inscrit avec votre code et paie un premier abonnement,
                     <b class="font-weight-bold">vous recevez 50% du montant payé.</b>
                 </p>
                 <p>
                     Exemple :
                     Votre filleul <b class="font-weight-bold">paie 10 USD → vous gagnez 5 USD</b> <br>
                     Paiement confirmé = récompense immédiate <br>
                 </p>
                 <p class="font-weight-bold">📲 Comment ça marche :</p>
                 <ul>
                     <li><i class="fa fa-check-circle text-success"></i> Connectez-vous et copiez votre code de
                         parrainage depuis le panel</li>
                     <li><i class="fa fa-check-circle text-success"></i> Partagez-le avec d’autres parents</li>
                     <li><i class="fa fa-check-circle text-success"></i> Suivez vos gains dans votre tableau de bord
                     </li>
                     <li><i class="fa fa-check-circle text-success"></i> Plus vous parrainez, plus vous gagnez. Aidez
                         d’autres familles à protéger leurs enfants tout en
                         profitant d’un bonus bien mérité.</li>
                 </ul>
                 <div class="w-100 text-center py-3">
                    <a href="{{ route('app.login') }}" class="btn btn-md btn-rounded mb-5">
                        <i class="fa fa-user"></i> Commencer
                    </a>
                </div>
             </div>
         </div>
         {{-- <div class="streak streak-photo streak-long-2 rgba-gradient"
             style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/Things/full%20page/img%20%287%29.jpg');">
             <div class="flex-center mask">
                 <div class="container">
                     <div class="row text-center">
                         <div class="col-md-4 mb-2">
                             <h1 class="white-text mb-1 font-weight-bold">+500</h1>
                             <p class="white-text font-weight-bold">Transactions traitées</p>
                         </div>
                         <div class="col-md-4 mb-2">
                             <h1 class="white-text mb-1 font-weight-bold">+1200</h1>
                             <p class="white-text font-weight-bold">Requêtes API</p>
                         </div>
                         <div class="col-md-4 mb-2">
                             <h1 class="white-text mb-1 font-weight-bold">+15</h1>
                             <p class="white-text font-weight-bold">Marchands</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div> --}}
         <div class="container shadow-lg wow fadeInUp">
             <section id="contact" class="mb-5 ">
                 <h3 class="text-center mt-5 py-3 dark-grey-text font-weight-bold wow fadeIn" data-wow-delay="0.2s">
                     <strong><i class="fa fa-money-bill"></i> Tarification</strong>
                 </h3>
                 <h4 class="text-center">Créer <b>gratuitement</b> votre compte et profitez d'une période d'essaie de
                     <strong class="text-danger">14 jours full acces</strong>
                 </h4>
                 <div class="row wow fadeIn p-5" data-wow-delay="0.4s">
                     <div class="col-md-4">
                         <div class="card shadow-lg mb-2"
                             style="background: #ccc; border-radius: 20px; min-height: 350px;">
                             <div class="card-header">
                                 <b><i class="fa fa-check-circle"></i> PLAN GRATUIT : 0 USD</b>
                             </div>
                             <div class="card-body" style="font-size: 14px">
                                 <p>Avec le PLAN GRATUIT vous avez : </p>
                                 <ul class="list-unstyled">
                                     <li> <i class="fa fa-check-circle text-success"></i> 2 Actions quotidiennes</li>
                                     <li> <i class="fa fa-check-circle text-success"></i> Accès aux 5 premières
                                         notifications</li>
                                     <li> <i class="fa fa-check-circle text-success"></i> Accès à l'historique de 2
                                         premiers appels</li>
                                     <li> <i class="fa fa-check-circle text-success"></i> Accès à l'historique de
                                         localisation de 08h jusqu'à 12h</li>
                                     <li> <i class="fa fa-check-circle text-success"></i> Accès au Key logger de 08h à
                                         12h</li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="card shadow-lg mb-2"
                             style="background: #57c280; border-radius: 20px; min-height: 350px;">
                             <div class="card-header">
                                 <b><i class="fa fa-check-to-slot"></i> PLAN BASIC : 10 USD/Mois</b>
                             </div>
                             <div class="card-body" style="font-size: 14px">
                                 <p>Avec le PLAN BASIC vous avez : </p>
                                 <ul class="list-unstyled">
                                     <li> <i class="fa fa-check-circle"></i> 30 Actions quotidiennes</li>
                                     <li> <i class="fa fa-check-circle"></i> Accès aux 50 premières
                                         notifications
                                     </li>
                                     <li> <i class="fa fa-check-circle"></i> Accès à l'historique de 10
                                         premiers appels
                                     </li>
                                     <li>
                                         <i class="fa fa-check-circle"></i> Accès aux 5 premiers enregistrements
                                         d'appels : téléphoniques, Whatsapp & Telegram
                                     </li>
                                     <li> <i class="fa fa-check-circle"></i> Accès à l'historique de
                                         localisation de 00h jusqu'à 12h
                                     </li>
                                     <li>
                                         <i class="fa fa-check-circle"></i> Accès au Key logger de 00h à
                                         12h
                                     </li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="card shadow-lg mb-2"
                             style="background: #6fd1e2; border-radius: 20px; min-height: 350px;">
                             <div class="card-header">
                                 <b><i class="fa fa-crown"></i> PLAN PREMIUM : 15 USD/Mois</b>
                             </div>
                             <div class="card-body" style="font-size: 14px">
                                 <p>Avec le PLAN PREMIUM vous avez : </p>
                                 <p class="font-weight-bold mb-1">
                                     Un accès quotidien
                                     <b class="text-danger">ILLIMITÉ</b> à toutes les fonctionnalités !
                                 </p>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="w-100 text-center py-3">
                     <a href="{{ route('app.login') }}" class="btn btn-md app-btn btn-rounded mb-5">
                         <i class="fa fa-user"></i> Commencer
                     </a>
                 </div>
             </section>
         </div>
         <div class="container wow fadeInRight" id="contact">
             <section id="contact" class="mb-5 ">
                 <h3 class="text-center text-dark mt-5 pt-3 dark-grey-text font-weight-bold">
                     <strong>Nous contacter</strong>
                 </h3>
                 <div class="row p-5">
                     <div class="col-md-8 col-lg-9">
                         <form action="#" id="f-cont">
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="md-form md-outline mb-4">
                                         <input type="text" id="nom" required name="name"
                                             class="form-control" />
                                         <label for="nom">Nom</label>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="md-form md-outline mb-4">
                                         <input id="femail" required name="email" type="email"
                                             class="form-control" />
                                         <label for="femail">Email</label>
                                     </div>
                                 </div>
                                 <div class="col-md-6">
                                     <div class="md-form md-outline mb-4">
                                         <input id="phone" type="text" name="phone" required
                                             class="form-control" />
                                         <label for="phone">Telephone</label>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="md-form md-outline mb-4">
                                         <input required id="fsub" type="text" name="subject"
                                             class="form-control" />
                                         <label for="fsub">Sujet</label>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                                 <div class="col-md-12">
                                     <div class="md-form md-outline mb-4">
                                         <textarea name="message" id="fmess" required class="form-control"></textarea>
                                         <label for="fmess">Message</label>
                                     </div>
                                 </div>
                             </div>
                             <div id="rep"></div>
                             <div class="text-center text-md-left mb-5 mt-4">
                                 <button type="submit" class="btn app-btn btn-sm btn-rounded font-weight-bold">
                                     <i class="fas fa-envelope"></i> Envoyer
                                 </button>
                             </div>
                         </form>
                     </div>
                     <div class="col-md-4 col-lg-3">
                         <ul class="text-center list-unstyled float-md-right">
                             <li>
                                 <i class="fas fa-map-marker-alt fa-2x text-dark"></i>
                                 <p class="text-muted font-weight-bold">Lubumbashi, HK, DRC</p>
                             </li>
                             <li>
                                 <i class="fas fa-phone fa-2x text-dark"></i>
                                 <p class="text-muted font-weight-bold">
                                     <a target="_blank" class="text-muted font-weight-bold"
                                         href="https://wa.me/243906789959">
                                         +243906789959
                                     </a>
                                 </p>
                             </li>
                             <li>
                                 <i class="fas fa-envelope fa-2x text-dark"></i>
                                 <p>
                                     <a class="text-muted font-weight-bold" href="mailto:go@gooomart.com">
                                         go@gooomart.com
                                     </a>
                                 </p>
                             </li>
                         </ul>
                     </div>
                 </div>
             </section>
         </div>
     </main>

     <footer class="text-center text-md-left pt-3" style="background: #00C853 !important;color: white;">
         <div class="container mt-5 mb-4 text-center text-md-left wow fadeIn" data-wow-delay="0.3s">
             <div class="row mt-3">
                 <div class="col-md-4 mb-4">
                     <h6 class="spacing font-weight-bold">
                         <strong>
                             {{ config('app.name') }}
                         </strong>
                     </h6>
                     <hr class="pink accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                     <p>
                         {{ config('app.name') }} est une application conçue pour aider les parents à garder un œil sur
                         l’activité
                         numérique de leurs enfants, en toute simplicité.
                         Grâce à ses fonctionnalités de suivi avancées (localisation GPS, messages, activités web,
                         applications comme WhatsApp…), GoWatch offre une vision claire et en temps réel pour assurer la
                         sécurité numérique des mineurs.
                     </p>
                 </div>
                 <div class="col-md-4 mb-4">
                     <h6 class="spacing font-weight-bold">
                         <strong>Contact</strong>
                     </h6>
                     <hr class="pink accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                     <p>
                         <a target="_blank" class="text-white font-weight-bold" href="https://wa.me/243906789959">
                             <i class="fa fa-phone-flip"></i>
                             Contact : +243906789959
                         </a>
                     </p>
                     <p>
                         <a class="text-white font-weight-bold">
                             <i class="fa fa-map-marker"></i>
                             Lubumbashi, HK, DRC
                         </a>
                     </p>
                 </div>
                 <div class="col-md-4 mb-4">
                     <h6 class="spacing font-weight-bold">
                         <strong>Liens</strong>
                     </h6>
                     <hr class="pink accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                     <p>
                         <a target="_blank" class="text-white font-weight-bold"
                             href="https://www.gooomart.com?source=gowatch">
                             Gooomart
                         </a>
                     </p>
                     <p>
                         <a target="_blank" class="text-white font-weight-bold"
                             href="https://www.gopay.gooomart.com?source=gowatch">
                             GoPAY
                         </a>
                     </p>
                     <p>
                         <a target="_blank" class="text-white font-weight-bold"
                             href="https://www.zbot.gooomart.com?source=gowatch">
                             Zbot
                         </a>
                     </p>
                     <p>
                         <a target="_blank" class="text-white font-weight-bold"
                             href="https://www.control.gooomart.com?source=gowatch">
                             Control
                         </a>
                     </p>
                 </div>
             </div>
         </div>

         <div class="footer-copyright py-3 text-center" style="background: #43A047 !important;">
             <div class="container-fluid">
                 <b style="font-size: 12px" class="mr-3">&copy; {{ date('Y') }} {{ config('app.name') }},
                     Powered
                     by
                     <a href="https://www.gooomart.com?source=gowatch" class="text-dark" target="_blank">Gooomart</a>
                 </b>
                 |
                 <b style="font-size: 12px" class="ml-3">
                     <a target="_blank" class="text-dark font-weight-bold" href="https://wa.me/243906789959">
                         <i class="fa fa-phone"></i>
                         Contact : +243906789959
                     </a>
                 </b>
             </div>
         </div>

     </footer>

     <script type="text/javascript" src="{{ asset('js/jq.min.js') }}"></script>
     <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
     <script type="text/javascript" src="{{ asset('js/bs4.min.js') }}"></script>
     <script type="text/javascript" src="{{ asset('js/mdb4.min.js') }}"></script>

     <script>
         new WOW().init();
         $(window).on('load', function() {
             $('.loader').fadeOut();
         });
     </script>
     <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
     <script>
         $('#a-contact').click(function() {
             event.preventDefault();
             $('html, body').animate({
                 scrollTop: $('#contact').offset().top - 100
             }, 1000);
         })
         $(function() {
             $('#phone').mask('000000000000');

             $('#f-cont').submit(function() {
                 event.preventDefault();
                 var form = $(this);
                 var btn = $(':submit', form).attr('disabled', true);
                 var iclass = btn.find('i').attr('class');
                 btn.find('i').removeClass()
                     .addClass('spinner-border spinner-border-sm');
                 var data = form.serialize();
                 data += "&phone=" + $('#phone').val();
                 rep = $('#rep', form);
                 rep.slideUp();
                 $.ajax({
                     url: '{{ route('feedback.index') }}',
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
             });
         })
     </script>

 </body>

 </html>
