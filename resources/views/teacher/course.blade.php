@extends('layouts.app')

@section('title', $course->course_code)
@section('nav', $course->course_code)
@section('heading', $course->course_name)

@push('css')
    <link type="text/css" href="{{asset('assets/vendor/select2/select2.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex flex-column">
                    <img src="{{asset('storage/courses/'.$course->course_thumbnail)}}" class="img-fluid" alt="Responsive image">
                </div>


                <div class="card mt-5">
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="Step">Unit</label>
                                <select name="step" id="unit" class="form-control">
                                    <option value disabled selected>Select course unit</option>
                                    <optgroup label = "Core Units">
                                        @forelse ($course->units as $item)
                                            @if($item->unit_type == 'core')
                                                <option value="">{{$item->unit_name}}</option>
                                            @endif
                                        @empty
                                            <option>No item found!</option>
                                        @endforelse
                                    </optgroup>
                                    <optgroup label = "Elective Units">
                                        @forelse ($course->units as $item)
                                            @if($item->unit_type == 'elective')
                                                <option value="">{{$item->unit_name}}</option>
                                            @endif
                                        @empty
                                            <option>No item found!</option>
                                        @endforelse
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Step">Step</label>
                                <select name="step" id="step" class="form-control">
                                    <option value disabled selected>Select step</option>
                                    @forelse ($steps as $item)
                                        <option value="{{$item->id}}">{{$item->step_name}}</option>
                                    @empty
                                        <option>No item found!</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="files">Files</label>
                                <input type="file" name="files" class="form-control" multiple/>
                            </div>

                            <button type="submit" class="btn btn-outline-dark">Save</button>
                        </form>
                    </div>
                </div>


                @if (!is_null($course->descriptions))
                    <div class="page__heading">
                        <div class="mb-3">
                            <strong class="text-dark-gray">COURSE OVERVIEW</strong>
                        </div>
                        <div>
                            @php
                                echo $course->descriptions
                            @endphp
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-4">
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
                                        <a href="{{route('teacher.unit', $item->id)}}">{{$item->unit_code}} - {{$item->unit_name}}</a>
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
                                        <a href="{{route('teacher.unit', $item->id)}}">{{$item->unit_code}} - {{$item->unit_name}}</a>
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
@push('js')
    <!-- Select2 -->
    <script src="{{asset('assets/vendor/select2/select2.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $("#unit").select2();
            $("#step").select2();
        })
    </script>
@endpush
