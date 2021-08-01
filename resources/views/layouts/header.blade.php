<div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
    <div class="mdk-header__content">
        <div class="navbar navbar-expand-sm navbar-main pr-0 navbar-light bg-white border-bottom mdk-header--fixed"
            id="navbar" data-primary>
            <div class="container-fluid p-0">
                <!-- Navbar toggler -->
                <button class="navbar-toggler navbar-toggler-right d-block d-lg-none" type="button"
                    data-toggle="sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Brand -->
                <a href="" class="navbar-brand py-2 ">
                    <img class="navbar-brand-icon" src="{{ asset('assets/logo.png') }}" width="120" alt="NTA">
                </a>

                <ul class="nav navbar-nav d-none d-sm-flex border-left navbar-height align-items-center">
                    <li class="nav-item dropdown">
                        <a href="#account_menu" class="nav-link dropdown-toggle" data-toggle="dropdown"
                            data-caret="false">
                            <span class="mr-1 d-flex-inline">
                                <span class="text-light">{{ __(Auth::user()->name) }}</span>
                            </span>
                            <img src="{{ asset('storage/users/' . auth()->user()->photo) }}" class="rounded-circle"
                                width="32" alt="{{ __(Auth::user()->name) }}">
                        </a>
                        <div id="account_menu" class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="javascript:void(0)"
                                onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                <i class="material-icons">exit_to_app</i> Logout
                            </a>
                            <form action="{{ route('logout') }}" method="post" id="logoutForm">@csrf</form>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
