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
                    <div class="mt-1">
                        @if (Auth::user()->user_type == 'student')
                            <a href="{{route('course', $unit->course->id)}}" class="btn btn-light btn-rounded mr-2">Return Back</a>
                        @endif

                        @if (Auth::user()->user_type == 'teacher')
                            <a href="{{route('teacher.course', $unit->course->id)}}" class="btn btn-light btn-rounded mr-2">Return Back</a>
                        @endif

                        <a href="javascript:void(0)" class="btn btn-outline-light btn-rounded mr-2">Assessment Quiz</a>

                    </div>
                </div>
            </div>
        </div>

        <!-- HEADING -->
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <h1 class="mb-2">1. Wireframe</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#"><i class="material-icons">folder_open</i> Build a Rails 5 application from Scratch</a></li>
                        </ol>
                    </nav>
                </div>
                <div>
                    <a href=""
                        class="btn btn-outline-success">Mark as complete <i class="material-icons ml-2">check</i></a>
                    <a href=""
                        class="btn btn-light ml-3"><i class="material-icons">chevron_left</i> Prev</a>
                    <a href=""
                        class="btn btn-light">Next <i class="material-icons">chevron_right</i></a>
                </div>
            </div>
        </div>
        <!-- END -->

        <div class="container-fluid page__container">

            <div class="alert alert-soft-success d-flex align-items-center card-margin"
                    role="alert">
                <i class="material-icons mr-3">star</i>
                <div class="text-body"><strong>Congratulations.</strong> You have completed 9 of 10 lessons. </div>
            </div>

            <div class="row">
                <div class="col-md-4 order-12">
                    <div class="card">
                        <ul class="list-group list-lessons">
                            <li class="list-group-item d-flex align-items-center active">
                                <div class="avatar avatar-sm mr-3">
                                    <span class="avatar-title rounded-circle bg-primary">1</span>
                                </div>
                                <div>
                                    <a href="#">Wireframe</a>
                                    <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                                </div>
                                <div class="ml-auto d-flex align-items-center">
                                    <span class="badge badge-success mr-2"><i class="material-icons icon-16pt">check_circle</i></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">

                    <div class="mb-3"><strong class="text-dark-gray">DESCRIPTION</strong></div>
                    <p>
                        {{$unit->progress}}
                    </p>
                    <div class="my-2">
                        <span class="badge badge-pill badge-secondary">RUBY</span>
                        <span class="badge badge-pill badge-secondary">RAILS</span>
                        <span class="badge badge-pill badge-secondary">WIREFRAME</span>
                    </div>
                    <div class="card py-2 px-3 my-4">
                        <div class=" d-flex justify-content-between align-items-center">

                            <a href="profile.html"
                                class="flex d-flex align-items-center text-body text-underline-0">
                                <span class="avatar avatar-sm mr-2">
                                    <img src="assets/images/avatar/demi.png"
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
                                    class="btn btn-facebook btn-rounded-social">
                                    <svg width="14px"
                                            style="fill: currentColor;"
                                            role="img"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                        <title>Facebook icon</title>
                                        <path d="M22.676 0H1.324C.593 0 0 .593 0 1.324v21.352C0 23.408.593 24 1.324 24h11.494v-9.294H9.689v-3.621h3.129V8.41c0-3.099 1.894-4.785 4.659-4.785 1.325 0 2.464.097 2.796.141v3.24h-1.921c-1.5 0-1.792.721-1.792 1.771v2.311h3.584l-.465 3.63H16.56V24h6.115c.733 0 1.325-.592 1.325-1.324V1.324C24 .593 23.408 0 22.676 0" />
                                    </svg>
                                </a>
                                <a href=""
                                    class="btn btn-twitter btn-rounded-social">
                                    <svg width="14px"
                                            style="fill: currentColor;"
                                            role="img"
                                            viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                        <title>Twitter icon</title>
                                        <path d="M23.954 4.569c-.885.389-1.83.654-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.959-3.127 1.184-.896-.959-2.173-1.559-3.591-1.559-2.717 0-4.92 2.203-4.92 4.917 0 .39.045.765.127 1.124C7.691 8.094 4.066 6.13 1.64 3.161c-.427.722-.666 1.561-.666 2.475 0 1.71.87 3.213 2.188 4.096-.807-.026-1.566-.248-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-1.68 1.319-3.809 2.105-6.102 2.105-.39 0-.779-.023-1.17-.067 2.189 1.394 4.768 2.209 7.557 2.209 9.054 0 13.999-7.496 13.999-13.986 0-.209 0-.42-.015-.63.961-.689 1.8-1.56 2.46-2.548l-.047-.02z" />
                                    </svg>
                                </a>
                                <a href=""
                                    class="btn btn-secondary btn-rounded-social">
                                    <i class="material-icons">mail</i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <!-- COMMENTS -->
                    <h4 class="mt-4">Comments</h4>

                    <div class="input-group input-group-merge mb-4">
                        <textarea class="form-control form-control-appended"
                                    required=""
                                    placeholder="Type message"
                                    rows="4"
                                    style="resize: none"></textarea>
                        <div class="input-group-append">
                            <div class="input-group-text pr-2">
                                <button class="btn btn-flush"
                                        type="button"><i class="material-icons">tag_faces</i></button>
                            </div>
                            <div class="input-group-text pl-0">
                                <div class="custom-file custom-file-naked d-flex"
                                        style="width: 24px">
                                    <input type="file"
                                            class="custom-file-input"
                                            id="customFile">
                                    <label class="custom-file-label"
                                            style="color: inherit;"
                                            for="customFile">
                                        <i class="material-icons">attach_file</i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-3 border-bottom">
                        <div class="d-flex mb-1">
                            <div class="avatar avatar-sm mr-3">
                                <img src="assets/images/256_daniel-gaffey-1060698-unsplash.jpg"
                                        alt="Avatar"
                                        class="avatar-img rounded-circle">
                            </div>
                            <div class="flex">
                                <div class="d-flex align-items-center mb-1">
                                    <strong class="text-15pt">Sherri J. Cardenas</strong>
                                    <small class="ml-2 text-muted">3 days ago</small>
                                </div>
                                <div>
                                    <p>Thanks for contributing to the release of FREE Admin Vision - PRO Admin Dashboard Theme <a href="">https://www.frontted.com/themes/admin-vision...</a> 🔥</p>
                                    <p><a href="">#themeforest</a> <a href="">#EnvatoMarket</a></p>
                                </div>

                                <div class="d-flex align-items-center">
                                    <a href=""
                                        class="text-muted d-flex align-items-center decoration-0"><i class="material-icons mr-1"
                                            style="font-size: inherit;">favorite_border</i> 38</a>
                                    <a href=""
                                        class="text-muted d-flex align-items-center decoration-0 ml-3"><i class="material-icons mr-1"
                                            style="font-size: inherit;">thumb_up</i> 71</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-3 border-bottom">
                        <div class="d-flex mb-1">
                            <div class="avatar avatar-sm mr-3">
                                <img src="assets/images/256_rsz_1andy-lee-642320-unsplash.jpg"
                                        alt="Avatar"
                                        class="avatar-img rounded-circle">
                            </div>
                            <div class="flex">
                                <div class="d-flex align-items-center mb-1">
                                    <strong class="text-15pt">Jenell D. Matney</strong>
                                    <small class="ml-2 text-muted">4 days ago</small>
                                </div>
                                <div>
                                    <p>Rails 5 Bootstrap 4 Boilerplate Admin Dashboard on <a href="">https://t.co/Wh7jE0yz4t</a> 😉
                                </div>

                                <div class="d-flex align-items-center">
                                    <a href=""
                                        class="text-muted d-flex align-items-center decoration-0"><i class="material-icons mr-1"
                                            style="font-size: inherit;">favorite_border</i> 156</a>
                                    <a href=""
                                        class="text-muted d-flex align-items-center decoration-0 ml-3"><i class="material-icons mr-1"
                                            style="font-size: inherit;">thumb_up</i> 351</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- END COMMENTS -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
