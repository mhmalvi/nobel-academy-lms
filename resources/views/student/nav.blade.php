@php
$enrollment = auth()
    ->user()
    ->student->enrollment->first();
@endphp
<div class="sidebar-heading pt-3">
    {{-- <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">description</i> --}}
    My Course
</div>
<li
    class="sidebar-menu-item {{ request()->segment(3) === 'unit' || request()->segment(3) === 'step' ? 'active open' : '' }}">
    <a class="sidebar-menu-button" data-toggle="collapse" href="#course_menu">
        <span class="sidebar-menu-text" style="line-height: 25px;">
            {{ __($enrollment->course->course_code) }} - {{ __($enrollment->course->course_name) }}
        </span>
        <span class="ml-auto sidebar-menu-toggle-icon"></span>
    </a>

    <ul class="sidebar-submenu collapse" id="course_menu">
        {{-- Core Menu --}}
        <li class="sidebar-menu-item">
            <a class="sidebar-menu-button" data-toggle="{{ !is_null($enrollment->core_units) ? 'collapse' : '' }}"
                href="#core_units">
                <span class="sidebar-menu-text">Core Units</span>
                @if (!is_null($enrollment->core_units))
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                @endif
            </a>
            <ul class="sidebar-submenu collapse" id="core_units">
                @forelse ($enrollment->course->units->where('unit_type', 'core') as $item)
                    <li class="sidebar-menu-item {{ request()->segment(2) == $item->id ? 'active' : '' }}">
                        <a class="sidebar-menu-button" href="
                            @if (!is_null($enrollment->core_units) && in_array($item->unit_code,
                            $enrollment->core_units)) {{ route('unit', $item->id) }}
                        @else
                            {{ 'javascript:void(0)' }} @endif
                            ">
                            <span class="sidebar-menu-text">{{ $item->unit_code }}</span>
                            @if (!is_null($enrollment->core_units) && in_array($item->unit_code, $enrollment->core_units))
                                &nbsp;<span class="material-icons text-success"
                                    style="font-size: 14px;">check_circle</span>
                            @endif
                        </a>
                    </li>

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
            <a class="sidebar-menu-button" data-toggle="{{ !is_null($enrollment->elective_units) ? 'collapse' : '' }}"
                href="#elective_units">
                <span class="sidebar-menu-text">Elective Units</span>
                @if (!is_null($enrollment->elective_units))
                    <span class="ml-auto sidebar-menu-toggle-icon"></span>
                @endif
            </a>
            <ul class="sidebar-submenu collapse" id="elective_units">
                @forelse ($enrollment->course->units->where('unit_type', 'elective') as $item)
                    @if (!is_null($enrollment->elective_units) && in_array($item->unit_code, $enrollment->elective_units))
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="{{ route('unit', $item->id) }}">
                                <span class="sidebar-menu-text">{{ $item->unit_code }}</span>
                            </a>
                        </li>
                    @else
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="javascript:void(0)">
                                <span class="sidebar-menu-text">No Unit Found!</span>
                            </a>
                        </li>
                        @php
                            break;
                        @endphp
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
