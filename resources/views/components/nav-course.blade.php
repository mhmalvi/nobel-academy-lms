@if (Auth::user()->user_type == 'student')
    @php
        $enrollment = auth()->user()->student->enrollment->first();
    @endphp
    <li class="sidebar-menu-item {{(request()->segment(1) === 'course' || request()->segment(1) === 'unit') ? 'active open' : ''}}">
        <a class="sidebar-menu-button" data-toggle="collapse" href="#course_menu">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">description</i>
            <span class="sidebar-menu-text">{{__($enrollment->course->course_code)}}</span>
            <span class="ml-auto sidebar-menu-toggle-icon"></span>
        </a>
        
        <ul class="sidebar-submenu collapse" id="course_menu">
            {{-- Core Menu --}}
            <li class="sidebar-menu-item {{(request()->segment(1) === 'unit') ? 'active open' : ''}}">
                <a class="sidebar-menu-button" data-toggle="collapse" href="#core_units">
                    <span class="sidebar-menu-text">Core Units</span>
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                </a>
                <ul class="sidebar-submenu collapse" id="core_units">
                    @forelse ($enrollment->course->units->where('unit_type', 'core') as $item)
                        @if (in_array($item->unit_code, $enrollment->core_units))
                            <li class="sidebar-menu-item {{(request()->segment(2) == $item->id) ? 'active' : ''}}">
                                <a class="sidebar-menu-button" href="{{route('unit', $item->id)}}">
                                    <span class="sidebar-menu-text">{{$item->unit_code}}</span>
                                </a>
                            </li>
                        @endif
                    @empty
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="javascript:void(0)">
                                <span class="sidebar-menu-text">No Unit Found!</span>
                            </a>
                        </li>
                    @endforelse
                </ul>
            </li>

            {{-- Elective Menu --}}
            <li class="sidebar-menu-item">
                <a class="sidebar-menu-button" data-toggle="collapse" href="#elective_units">
                    <span class="sidebar-menu-text">Elective Units</span>
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                </a>
                <ul class="sidebar-submenu collapse" id="elective_units">
                    @php
                        $enrollment = auth()->user()->student->enrollment->first();
                    @endphp
                    @forelse ($enrollment->course->units->where('unit_type', 'elective') as $item)
                        @if (in_array($item->unit_code, $enrollment->core_units))
                            <li class="sidebar-menu-item">
                                <a class="sidebar-menu-button" href="{{route('unit', $item->id)}}">
                                    <span class="sidebar-menu-text">{{$item->unit_code}}</span>
                                </a>
                            </li>
                        @endif
                    @empty
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="javascript:void(0)">
                                <span class="sidebar-menu-text">No Unit Found!</span>
                            </a>
                        </li>
                    @endforelse
                </ul>
            </li>
        </ul>
    </li>
{{-- @elseif(Auth::user()->user_type == 'teacher')
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
            <span class="sidebar-menu-text">{{__('My Course(s)')}}</span>
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
    @endif --}}
@endif