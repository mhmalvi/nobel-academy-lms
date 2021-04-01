@extends('layouts.app')

@section('content')
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex flex-column">
                    <img src="{{asset('storage/courses/'.$course->course_thumbnail)}}" class="img-fluid" alt="Responsive image">
                </div>

                @if (!is_null($course->descriptions))
                    <div class="page__heading">
                        <div class="mb-3"><strong class="text-dark-gray">COURSE OVERVIEW</strong></div>
                        <div>
                            @php
                                echo $course->descriptions
                            @endphp
                        </div>
                    </div>
                @else
                    
                @endif
            </div>
            <div class="col-md-4">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-light">
                            <a href=""
                               class="flex d-flex align-items-center text-body text-underline-0">
                                <span class="avatar mr-3">
                                    <img src="{{asset('storage/users/'.$enrollment->teacher->user->photo)}}" alt="{{$enrollment->teacher->first_name}}" class="avatar-img rounded-circle">
                                </span>
                                <span class="flex d-flex flex-column">
                                    <strong>{{$enrollment->teacher->first_name}}&nbsp;{{$enrollment->teacher->last_name}}</strong>
                                    <small class="text-muted text-uppercase">Instructor</small>
                                </span>
                            </a>
                        </li>

                        <li class="list-group-item">
                            <span class="material-icons">email</span>
                            <strong>Email:</strong> {{$enrollment->teacher->user->email}}
                        </li>
                    </ul>
                </div>


                {{-- units --}}
                <div id="accordion">
                    @if (!is_null($enrollment->core_units))
                        <div class="card">
                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer;">
                                <h5 class="mb-0">
                                    <strong class="text-dark">Core Units</strong>
                                </h5>
                            </div>
                    
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body p-0">
                                    <ul class="list-group list-lessons" style="border-top-left-radius: 0%; border-top-right-radius: 0%;">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @forelse ($enrollment->course->units->where('unit_type', 'core') as $item)
                                            @if (in_array($item->unit_code, $enrollment->core_units))
                                                <li class="list-group-item d-flex align-items-center active">
                                                    <div class="avatar avatar-sm mr-3">
                                                        <span class="avatar-title rounded-circle bg-primary">{{$i++}}</span>
                                                    </div>
                                                    <div>
                                                        <a href="{{route('core', $item->id)}}">{{$item->unit_name}}</a>
                                                        <div class="text-muted"><span class="material-icons icon-16pt icon-light">book</span> {{$item->unit_code}}</div>
                                                    </div>
                                                    <div class="ml-auto d-flex align-items-center">
                                                        <span class="badge badge-success mr-2"><i class="material-icons icon-16pt">check_circle</i></span>
                                                    </div>
                                                </li>
                                            @endif
                                        @empty
                                            <li class="list-group-item d-flex border-0">
                                                <a href="javascript:void(0)">No item found!</a>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (!is_null($enrollment->elective_units))
                        <div class="card">
                            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="cursor: pointer;">
                                <h5 class="mb-0">
                                    <strong class="text-dark">Elective Units</strong>
                                </h5>
                            </div>
                        
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body p-0">
                                    <ul class="list-group list-lessons">
                                        @forelse ($enrollment->course->units->where('unit_type', 'elective') as $item)
                                            @if (in_array($item->unit_code, unserialize($enrollment->elective_units)))
                                                <li class="list-group-item d-flex border-0">
                                                    <a href="{{route('elective', $item->id)}}">{{$item->unit_code}} - {{$item->unit_name}}</a>
                                                </li>
                                            @endif
                                        @empty
                                            <li class="list-group-item d-flex border-0">
                                                <a href="javascript:void(0)">No item found!</a>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
