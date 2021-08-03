@if (auth()->user()->classroomOfTeacher)
    <li class="sidebar-menu-item {{ request()->segment(1) == 'meetings' ? 'active' : '' }}">
        <a class="sidebar-menu-button" href="{{ route('meeting') }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">voice_chat</i>
            <span class="sidebar-menu-text">Meetings</span>
        </a>
    </li>
@endif

@if (auth()->user()->classroomOfTeacher)
    <li class="sidebar-menu-item {{ request()->segment(1) == 'classroom' ? 'active' : '' }}">
        <a class="sidebar-menu-button" href="{{ route('classrooms') }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">class</i>
            <span class="sidebar-menu-text">Classrooms</span>
        </a>
    </li>
@endif

{{-- @if (count(auth()->user()->teacher) > 0)
    <div class="sidebar-heading pt-3">
        Courses
    </div>
    @forelse (auth()->user()->teacher as $item)
        <li class="sidebar-menu-item {{ request()->segment(2) === 'resources' ? 'active' : '' }}">
            <a class="sidebar-menu-button" href="{{ route('courses', $item->course_code) }}">
                <span class="sidebar-menu-text" style="line-height: 25px;">{{ $item->course() }}</span>
            </a>
        </li>
    @empty
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" href="javascript:void(0)">
                <span class="sidebar-menu-text">{{ __('No course found!') }}</span>
            </a>
        </li>
    @endforelse
@endif --}}
