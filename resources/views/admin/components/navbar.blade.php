<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <div class="d-flex justify-content-center">
                        <img alt="image" class="rounded-circle"
                            src="{{ asset(Auth::user()->photo ? 'storage/users/' . Auth::user()->photo : 'assets/admin/pp.png') }}"
                            style="max-width: 48px;" />
                    </div>
                </div>
                <div class="logo-element">
                    <img alt="image" class="rounded-circle"
                        src="{{ asset(Auth::user()->photo ? 'storage/users/' . Auth::user()->photo : 'assets/admin/pp.png') }}"
                        style="max-width: 28px;" />
                </div>
            </li>

            {{-- Navigations Starts --}}


            {{-- Dashboard --}}
            <li class="{{ Route::currentRouteName() === 'admin.dashboard' ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-th-large"></i>
                    <span class="nav-label">Dashboards</span>
                </a>
            </li>

            {{-- Users --}}
            <li class="{{ request()->segment(2) === 'users' ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span
                        class="nav-label">Users</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ Route::currentRouteName() === 'admin.user.create' ? 'active' : '' }}">
                        <a href="{{ route('admin.user.create') }}">Add New User</a>
                    </li>
                    <li
                        class="{{ Route::currentRouteName() === 'admin.users' || Route::currentRouteName() === 'admin.assign' ? 'active' : '' }}">
                        <a href="{{ route('admin.users') }}">Manage Users</a>
                    </li>
                </ul>
            </li>

            {{-- Classrooms --}}
            {{-- <li class="{{ request()->segment(2) === 'class-rooms' ? 'active' : '' }}">
                <a href="{{ route('admin.classrooms') }}"><i class="fa fa-id-badge" aria-hidden="true"></i>
                    <span class="nav-label">Classrooms</span>
                </a>
            </li> --}}

            {{-- Courses --}}
            <li class="{{ request()->segment(2) === 'course' ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="fa fa-book" aria-hidden="true"></i> <span
                        class="nav-label">Course</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ Route::currentRouteName() === 'admin.course.category' ? 'active' : '' }}">
                        <a href="{{ route('admin.course.category') }}">Categories</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'admin.courses' ? 'active' : '' }}">
                        <a href="{{ route('admin.courses') }}">Courses</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'admin.units' ? 'active' : '' }}">
                        <a href="{{ route('admin.units') }}">Units</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'admin.course.steps' ? 'active' : '' }}">
                        <a href="{{ route('admin.course.steps') }}">Steps</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'admin.share.resource' ? 'active' : '' }}">
                        <a href="{{ route('admin.share.resource') }}">Share Resources</a>
                    </li>
                </ul>
            </li>


            {{-- Assesment --}}
            @php
                $assesment = \App\Models\Assesment::where('status', 'pending')->sum('status');
            @endphp
            <li class="{{ Route::currentRouteName() === 'admin.assesments' ? 'active' : '' }}">
                <a href="{{ route('admin.assesments') }}"><i class="fa fa-magic"></i>
                    <span class="nav-label">Assesment</span>&nbsp;
                    @if ($assesment > 0)
                        <span class="label label-info float-right">{{ $assesment }}</span>
                    @endif
                </a>
            </li>


            {{-- Announcements --}}
            <li class="{{ request()->segment(2) === 'announcements' ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="fa fa-bullhorn" aria-hidden="true"></i> <span
                        class="nav-label">Announcement</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ Route::currentRouteName() === 'admin.events' ? 'active' : '' }}">
                        <a href="{{ route('admin.events') }}">Event Calendar</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'admin.announcement.post' ? 'active' : '' }}">
                        <a href="{{ route('admin.announcement.post') }}">Post Announcement</a>
                    </li>
                    <li class="{{ Route::currentRouteName() === 'admin.announcement' ? 'active' : '' }}">
                        <a href="{{ route('admin.announcement') }}">All Announcements</a>
                    </li>
                </ul>
            </li>


            {{-- Settings --}}
            <li class="{{ request()->segment(2) === 'settings' ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="fa fa-cog" aria-hidden="true"></i> <span
                        class="nav-label">Settings</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ Route::currentRouteName() === 'admin.profile' ? 'active' : '' }}">
                        <a href="{{ route('admin.profile') }}">Profile</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
