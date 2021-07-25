<div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-left sidebar-p-t ps ps--active-y sidebar-dark bg-dark" data-perfect-scrollbar>
            <div class="sidebar-heading">Menu</div>
            <ul class="sidebar-menu">
                <li
                    class="sidebar-menu-item {{ Route::currentRouteName() == 'dashboard' || Route::currentRouteName() == 'index' ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('dashboard') }}">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
                        <span class="sidebar-menu-text">Dashboard</span>
                    </a>
                </li>

                {{-- Profile --}}
                <li class="sidebar-menu-item {{ Route::currentRouteName() == 'edit.profile' ? 'active' : '' }}">
                    <a class="sidebar-menu-button" href="{{ route('edit.profile') }}">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">assignment_ind</i>
                        <span class="sidebar-menu-text">My Profile</span>
                    </a>
                </li>

                @if (Auth::user()->user_type == 'Student')
                    @include('student.nav')
                @elseif(Auth::user()->user_type == 'Teacher')
                    @include('teacher.nav')
                @endif
            </ul>
        </div>
    </div>
</div>
