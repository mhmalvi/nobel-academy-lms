@extends('layouts.app')

@section('title', 'Unit')

@section('content')
    <div class="mdk-drawer-layout__content page">

        <div class="hero-banner bg-primary-dark d-flex flex-row align-items-center" style="height:250px;">
            <div class="container-fluid page__container">
                <div class="d-flex flex-column">
                    <div>
                        <div class="badge badge-primary">{{$unit->unit_code}}</div>
                    </div>
                    <h1 class="text-white mb-0">{{$unit->unit_name}}</h1>
                    <p class="lead text-white">{{$unit->course->course_name}}</p>
                </div>
            </div>
        </div>

        <div class="container-fluid page__container">
            <div class="pt-3">
                <div class="alert alert-soft-success d-flex align-items-center card-margin" role="alert">
                    <i class="material-icons mr-3">star</i>
                    <div class="text-body"><strong>Congratulations.</strong> You have completed {{$unit->progress->complete_step}} of 5 lessons. </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    {{--  --}}
                    <div class="card py-2 px-3 mb-4">
                        <div class=" d-flex justify-content-between align-items-center">
                            <a href="profile.html"
                                class="flex d-flex align-items-center text-body text-underline-0">
                                <span class="avatar avatar-sm mr-2">
                                    <img src="{{asset('assets/images/avatar/demi.png')}}"
                                            alt="avatar"
                                            class="avatar-img rounded-circle">
                                </span>
                                <span class="flex d-flex flex-column">
                                    <strong>Adrian Demian</strong>
                                    <small class="text-muted text-uppercase">AUTHOR</small>
                                </span>
                            </a>
                            <div>
                                <a href=""
                                    class="btn btn-secondary btn-rounded-social">
                                    <i class="material-icons">mail</i>
                                </a>
                            </div>
                        </div>
                    </div>


                    {{--  --}}
                    <div class="card">
                        <ul class="list-group list-lessons">
                            @php
                                $i = 1;
                            @endphp
                            @forelse ($steps as $step)
                                <li class="list-group-item d-flex align-items-center {{($unit->progress->complete_step >= $step->id) ? 'active' : ''}}">
                                    <div class="avatar avatar-sm mr-3">
                                        <span class="avatar-title rounded-circle {{($unit->progress->complete_step >= $step->id) ? 'bg-primary' : ''}}">{{$i++}}</span>
                                    </div>
                                    <div>
                                        <a href="{{
                                            ($unit->progress->current_step >= $step->id) ? 
                                                route('step', ["unitId" => $unit->id, "stepId" => $step->id]) : 
                                                'javascript:void(0)'
                                            }}">
                                            {{$step->step_name}}
                                        </a>
                                    </div>
                                    @if ($unit->progress->complete_step >= $step->id)
                                        <div class="ml-auto d-flex align-items-center">
                                            <span class="text-success mr-2">
                                                <i class="material-icons icon-16pt">check_circle</i>
                                            </span>
                                        </div>
                                    @endif
                                </li>
                            @empty
                                <li class="list-group-item d-flex align-items-center">
                                    <div class="avatar avatar-sm mr-3">
                                        <span class="avatar-title rounded-circle">!</span>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)">No Item Found!</a>
                                    </div>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>


                {{--  --}}
                <div class="col-md-8">
                    @if (isset($getStep))
                        <div id="card-body">
                            <!-- HEADING -->
                            <div class="d-flex align-items-center">
                                <div class="flex">
                                    <h1 class="mb-2">{{$getStep->step_name}}</h1>
                                </div>
                                <div>
                                    @if ($unit->progress->current_step == 5 && $unit->progress->current_step == $getStep->id)
                                        <form action="{{route('complete.step', ['unitId' => $unit->id, 'id' => $getStep->id])}}" method="post" id="assesment">
                                            @csrf
                                        </form>
                                        <button type="button" class="btn btn-outline-info" onclick="event.preventDefault(); document.getElementById('assesment').submit()">
                                            Request for assesment <i class="material-icons ml-2">check</i>
                                        </button>
                                    @endif

                                    @if ($unit->progress->current_step < 5 && $unit->progress->current_step == $getStep->id)
                                        <form action="{{route('complete.step', ['unitId' => $unit->id, 'id' => $getStep->id])}}" method="post" id="complete">
                                            @csrf
                                        </form>
                                        <button type="button" class="btn btn-outline-success" onclick="event.preventDefault(); document.getElementById('complete').submit()">
                                            Mark as complete <i class="material-icons ml-2">check</i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <!-- END -->
                            <div class="my-4">
                                <strong class="text-dark-gray">DESCRIPTION</strong>
                                <br>
                                <p class="text-justify">
                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, 
                                    necessitatibus consequatur asperiores consectetur, ea corrupti sapiente dolorum quibusdam accusamus eveniet ad maxime temporibus? 
                                    Magni laudantium quod repudiandae et consequuntur exercitationem.
                                </p>
                            </div>
                            <div class="card">
                                @if (count($getStep->files) > 0)
                                    <ul class="list-group list-lessons">
                                        @forelse ($getStep->files as $item)
                                            <li class="list-group-item d-flex">
                                                <a href="{{route('download.unitFile', $item->file_name)}}">
                                                    @if ($item->file_ext == 'pdf')
                                                        <i class="fa fa-file-pdf pr-2"></i>
                                                    @elseif($item->file_ext == 'docx')
                                                        <i class="fa fa-file-word pr-2"></i>
                                                    @elseif($item->file_ext == 'xlxs')
                                                        <i class="fa fa-file-excel pr-2"></i>
                                                    @elseif($item->file_ext == 'ppt')
                                                        <i class="fa fa-file-powerpoint pr-2"></i>
                                                    @endif
                                                    {{$item->file_name}}
                                                </a>
                                                <div class="ml-auto d-flex align-items-center">
                                                    <span class="text-muted">
                                                        <i class="material-icons icon-16pt icon-light">file_download</i>
                                                    </span>
                                                </div>
                                            </li>
                                        @empty
                                        <li class="list-group-item d-flex">
                                            No File Found!
                                        </li>
                                        @endforelse
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @else
                        <div id="card-body">
                            <!-- HEADING -->
                            <div class="d-flex align-items-center">
                                <div class="flex">
                                    <h1 class="mb-2">Unit Overview</h1>
                                </div>
                            </div>
                            <!-- END -->
                            <div class="my-4">
                                <strong class="text-dark-gray">DESCRIPTION</strong>
                                <br>
                                <p class="text-justify">
                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, 
                                    necessitatibus consequatur asperiores consectetur, ea corrupti sapiente dolorum quibusdam accusamus eveniet ad maxime temporibus? 
                                    Magni laudantium quod repudiandae et consequuntur exercitationem.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
