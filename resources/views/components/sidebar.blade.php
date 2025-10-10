<div id="app-sidebar" class="sidenav bg-white" data-color="dark" data-mode="side" data-hidden="false"
    data-scroll-container="#scrollContainer">
    <div class="mt-4">
        <div id="header-content" class="pl-3 d-flex justify-content-center">
            {{-- <img src="{{ asset('img/logo2.png') }}" alt="" class="mb-3" height="70px" width="130px" /> --}}
        </div>
        <hr class="mb-0" />
    </div>
    <div id="scrollContainer">
        <ul class="sidenav-menu">
            @if (auth()->user()->user_role == 'admin')
                {{-- <li class="sidenav-item">
                    <a class="sidenav-link" link href="{{ route('admin.web.index') }}">
                        <i class="fas fa-gauge pr-3"></i>Dashboard</a>
                </li> --}}
                <li class="sidenav-item">
                    <a class="sidenav-link" link href="{{ route('admin.remote_control') }}">
                        <i class="fas fa-right-left pr-3"></i>
                        Controle à distance
                    </a>
                </li>
                {{-- <li class="sidenav-item">
                    <a class="sidenav-link">
                        <i class="fa-solid fa-money-bill-trend-up pr-3"></i>
                        Envoi fonds</a>
                    <ul class="sidenav-collapse">
                        <li class="sidenav-item">
                            <a class="sidenav-link" link href="{{ route('admin.web.cashout') }}">
                                <i class="fa-solid fa-money-check-dollar p-1"></i>
                                Demandes de transfert
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidenav-item">
                    <a class="sidenav-link">
                        <i class="fas fa-users-gear pr-3"></i>
                        Clients
                    </a>
                    <ul class="sidenav-collapse">
                        <li class="sidenav-item">
                            <a class="sidenav-link" link href="{{ route('admin.web.merchent') }}">
                                <i class="fa-solid fa-users-between-lines pr-1"></i>
                                Comptes clients
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidenav-item">
                    <a class="sidenav-link">
                        <i class="fa-solid fa-cogs pr-3"></i>
                        Paramètres</a>
                    <ul class="sidenav-collapse">
                        <li class="sidenav-item">
                            <a class="sidenav-link" link href="{{ route('admin.web.bank') }}">
                                <i class="fa-solid fa-building p-1"></i>
                                Banques
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidenav-item">
                    <a class="sidenav-link">
                        <i class="fas fa-bars-progress pr-3"></i>
                        Autres
                    </a>
                    <ul class="sidenav-collapse">
                        <li class="sidenav-item">
                            <a class="sidenav-link" link href="{{ route('admin.web.feedback') }}">
                                <i class="fas fa-rss pr-1"></i>
                                Feedback
                            </a>
                        </li>
                    </ul>
                </li> --}}
            @endif
            @if (auth()->user()->user_role == 'client')
                <li class="sidenav-item">
                    <a class="sidenav-link" link href="{{ route('user.web.index') }}">
                        <i class="fas fa-right-left pr-3"></i>
                        Controle à distance
                    </a>
                </li>
            @endif
        </ul>
    </div>
    {{-- <div class="text-center" style="height: 100px;">
                <hr class="mb-4 mt-0" />
                <p>MDBootstrap.com</p>
            </div> --}}
</div>
<script type="text/javascript">
    (function() {

        document.ready(function() {
            console.log('r');
        })

        const sidenav = document.getElementById('app-sidebar');
        const instance = mdb.Sidenav.getInstance(sidenav);

        let innerWidth = null;

        const setMode = (e) => {
            if (window.innerWidth === innerWidth) {
                return;
            }

            innerWidth = window.innerWidth;

            if (window.innerWidth < 660) {
                instance.changeMode('over');
                instance.hide();
            } else {
                instance.changeMode('side');
                instance.show();
            }
        };

        // setMode();
        // window.addEventListener('resize', setMode);
    })
</script>
