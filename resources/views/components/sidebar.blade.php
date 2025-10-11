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
                <li class="sidenav-item">
                    <a class="sidenav-link">
                        <i class="fas fa-file pr-3"></i>
                        Logs
                    </a>
                    <ul class="sidenav-collapse">
                        <li class="sidenav-item">
                            <a class="sidenav-link" link href="{{ route('admin.web.applog') }}">
                                <i class="fas fa-bugs pr-1"></i>
                                App logs
                            </a>
                        </li>
                    </ul>
                </li>
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
</div>
<script type="text/javascript">
    (function() {
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
