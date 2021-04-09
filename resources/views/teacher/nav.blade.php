@if (count(auth()->user()->teacher->courses) == '1')
    <li class="sidebar-menu-item {{(request()->segment(1) === 'course') ? 'active' : ''}}">
        @php
            $param = auth()->user()->teacher->courses->first()->course->id; 
        @endphp
        <a class="sidebar-menu-button" href="{{route('teacher.course', $param)}}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">subtitles</i>
            <span class="sidebar-menu-text">{{__('My Course')}}</span>
        </a>
    </li>
@else
    <li class="sidebar-menu-item {{(request()->segment(1) === 'course') ? 'active open' : ''}}">
        <a class="sidebar-menu-button" data-toggle="collapse" href="#dashboards_menu">
        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">subtitles</i>
        <span class="sidebar-menu-text">{{__('My Courses')}}</span>
            <span class="ml-auto sidebar-menu-toggle-icon"></span>
        </a>
        <ul class="sidebar-submenu collapse show" id="dashboards_menu">
            @forelse (auth()->user()->teacher->courses as $item)
                <li class="sidebar-menu-item {{(request()->segment(2) === $item->course->id) ? 'active' : ''}}">
                    <a class="sidebar-menu-button" href="{{route('teacher.course', $item->course->id)}}">
                        <span class="sidebar-menu-text">{{$item->course->course_code}}</span>
                    </a>
                </li>
            @empty
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="javascript:void(0)">
                        <span class="sidebar-menu-text">{{__('No course found!')}}</span>
                    </a>
                </li>
            @endforelse
        </ul>
    </li>
@endif

<li class="sidebar-menu-item {{(request()->segment(2) === 'resources') ? 'active' : ''}}">
    <a class="sidebar-menu-button" href="{{route('share.resource')}}">
        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">backup</i>
        <span class="sidebar-menu-text">{{__('Share Resource')}}</span>
    </a>
</li>
