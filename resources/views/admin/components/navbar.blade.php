<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <div class="d-flex justify-content-center">
                        <img alt="image" class="rounded-circle" src="{{asset((Auth::user()->photo)? 'storage/users/'.Auth::user()->photo : 'assets/admin/pp.png')}}" style="max-width: 48px;"/>
                    </div>
                </div>
                <div class="logo-element">
                    <img alt="image" class="rounded-circle" src="{{asset((Auth::user()->photo)? 'storage/users/'.Auth::user()->photo : 'assets/admin/pp.png')}}" style="max-width: 28px;"/>
                </div>
            </li>

            {{-- Navigations Starts --}}

            
            {{-- Dashboard --}}
            <li class="{{(Route::currentRouteName() === 'admin.dashboard') ? 'active' : ""}}">
                <a href="{{route('admin.dashboard')}}"><i class="fa fa-th-large"></i>
                    <span class="nav-label">Dashboards</span>
                </a>
            </li>


            {{-- Instructor --}}
            <li class="{{(request()->segment(2) === 'instructors') ? 'active' : ''}}">
                <a href="javascript:void(0)"><i class="fa fa-commenting" aria-hidden="true"></i></i><span class="nav-label">Instructor</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{(Route::currentRouteName() === 'admin.instructor.add') ? 'active' : ''}}">
                        <a href="{{route('admin.instructor.add')}}">Add New</a>
                    </li>
                    <li class="{{(Route::currentRouteName() === 'admin.instructors') ? 'active' : ''}}">
                        <a href="{{route('admin.instructors')}}">Manage Instructors</a>
                    </li>
                </ul>
            </li>


            {{-- Student --}}
            <li class="{{(request()->segment(2) === 'students') ? 'active' : ''}}">
                <a href="javascript:void(0)"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span class="nav-label">Student</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{(Route::currentRouteName() === 'admin.student.enrollment') ? 'active' : ''}}">
                        <a href="{{route('admin.student.enrollment')}}">Enrollment</a>
                    </li>
                    <li class="{{(Route::currentRouteName() === 'admin.course.enrollment') ? 'active' : ''}}">
                        <a href="{{route('admin.course.enrollment')}}">Course Enroll</a>
                    </li>
                    <li class="{{(Route::currentRouteName() === 'admin.students') ? 'active' : ''}}">
                        <a href="{{route('admin.students')}}">Manage Students</a>
                    </li>
                </ul>
            </li>


            {{-- Courses --}}
            <li class="{{(request()->segment(2) === 'course') ? 'active' : ''}}">
                <a href="javascript:void(0)"><i class="fa fa-book" aria-hidden="true"></i> <span class="nav-label">Course</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{(Route::currentRouteName() === 'admin.course.category') ? 'active' : ''}}">
                        <a href="{{route('admin.course.category')}}">Category</a>
                    </li>
                    <li class="{{(Route::currentRouteName() === 'admin.courses') ? 'active' : ''}}">
                        <a href="{{route('admin.courses')}}">Courses</a>
                    </li>
                    <li class="{{(Route::currentRouteName() === 'admin.course.add') ? 'active' : ''}}">
                        <a href="{{route('admin.course.add')}}">Add Course</a>
                    </li>
                    <li class="{{(Route::currentRouteName() === 'admin.units') ? 'active' : ''}}">
                        <a href="{{route('admin.units')}}">Units</a>
                    </li>
                    <li class="{{(Route::currentRouteName() === 'admin.course.unit') ? 'active' : ''}}">
                        <a href="{{route('admin.course.unit')}}">Add Unit</a>
                    </li>
                </ul>
            </li>

            {{-- Manage Files --}}
            <li class="{{(request()->segment(2) === 'files') ? 'active' : ''}}">
                <a href="javascript:void(0)"><i class="fa fa-files-o" aria-hidden="true"></i><span class="nav-label">Resources</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{(Route::currentRouteName() === 'admin.unit.files') ? 'active' : ''}}">
                        <a href="{{route('admin.unit.files')}}">Unit</a>
                    </li>
                </ul>
            </li>


            {{-- Announcements --}}
            <li class="{{(request()->segment(2) === 'announcement') ? 'active' : ''}}">
                <a href="javascript:void(0)"><i class="fa fa-bullhorn" aria-hidden="true"></i> <span class="nav-label">Announcement</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="">
                        <a href="{{route('admin.events')}}">Event Calendar</a>
                    </li>
                    <li class="{{(Route::currentRouteName() === 'admin.announcement.post') ? 'active' : ''}}">
                        <a href="{{route('admin.announcement.post')}}">Post Announcement</a>
                    </li>
                    <li class="{{(Route::currentRouteName() === 'admin.announcement') ? 'active' : ''}}">
                        <a href="{{route('admin.announcement')}}">All Announcements</a>
                    </li>
                </ul>
            </li>


            {{-- Settings --}}
            <li class="{{(request()->segment(2) === 'settings') ? 'active' : ''}}">
                <a href="javascript:void(0)"><i class="fa fa-cog" aria-hidden="true"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{(Route::currentRouteName() === 'admin.profile') ? 'active' : ''}}">
                        <a href="{{route('admin.profile')}}">Profile</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
