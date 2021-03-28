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
                    <div class="text-body"><strong>Congratulations.</strong> You have completed 3 of 5 lessons. </div>
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
                            {{-- @php
                                $i = 1;
                            @endphp
                            @forelse ($steps as $step)
                                <li class="list-group-item d-flex align-items-center 
                                {{(!is_null($unit->progress->steps) && in_array($step->id, $unit->progress->steps)) ? 'active' : ''}}"
                                >
                                    <div class="avatar avatar-sm mr-3 {{
                                    (!is_null($unit->progress->steps) && count($unit->progress->steps) > 2) ? 
                                    'text-primary' : ''
                                    }}">
                                        <span class="avatar-title rounded-circle">{{$i++}}</span>
                                    </div>
                                    <div>
                                        <a 
                                            href="{{
                                            (!is_null($unit->progress->steps) && in_array($step->id, $unit->progress->steps)) ? 
                                            route('step',$step->id) : 
                                            'javascript:void(0)'
                                            }}"  
                                        >
                                            {{$step->step_name}}
                                        </a>
                                    </div>
                                    @if (!is_null($unit->progress->steps) && count($unit->progress->steps) > 2)
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
                            @endforelse --}}
                        </ul>
                    </div>
                </div>


                {{--  --}}
                <div class="col-md-8">
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

                            <p class="text-justify">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, 
                                necessitatibus consequatur asperiores consectetur, ea corrupti sapiente dolorum quibusdam accusamus eveniet ad maxime temporibus? 
                                Magni laudantium quod repudiandae et consequuntur exercitationem.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $(".getStep").on("click", function(){
                let url = $(this).data('url');
                
                $.ajax({
                    url: url,
                    method: "GET",
                    beforeSend: function () {
                        $("#card-body").addClass('is-loading is-loading-lg');
                    },
                    complete: function () {
                        $("#card-body").removeClass('is-loading is-loading-lg');
                    },
                    success: function (res) {
                        $("#card-body").html(res);
                    }
                })
            })
        })
    </script>
@endpush
