@extends('layouts.app')

@section('title', $course->course_code)
@section('nav', $course->course_code)
@section('heading', $course->course_name)

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
                            <h5 class="mb-0">Course Informations</h5>
                        </li>
                    </ul>
                </div>


                {{-- units --}}
                <div id="accordion">
                    <div class="card">
                      <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer;">
                        <h5 class="mb-0">
                            <strong class="text-dark">Core Units</strong>
                        </h5>
                      </div>
                  
                      <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body p-0">
                            <ul class="list-group list-lessons">
                                @forelse ($course->units->where('unit_type', 'core') as $item)
                                    <li class="list-group-item d-flex border-0">
                                        <a href="{{route('core', $item->id)}}">{{$item->unit_code}} - {{$item->unit_name}}</a>
                                    </li>
                                @empty
                                    <li class="list-group-item d-flex border-0">
                                        <a href="">No item found!</a>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="cursor: pointer;">
                        <h5 class="mb-0">
                            <strong class="text-dark">Elective Units</strong>
                        </h5>
                      </div>
                  
                      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body p-0">
                            <ul class="list-group list-lessons">
                                @forelse ($course->units->where('unit_type', 'elective') as $item)
                                    <li class="list-group-item d-flex border-0">
                                        <a href="{{route('elective', $item->id)}}">{{$item->unit_code}} - {{$item->unit_name}}</a>
                                    </li>
                                @empty
                                    <li class="list-group-item d-flex border-0">
                                        <a href="">No item found!</a>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection
