@extends('layouts.app')

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
        </div>
    </div>
    <!-- END -->

    <div class="container-fluid page__container">
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
                        <li class="list-group-item d-flex align-items-center">
                            <div class="avatar avatar-sm mr-3">
                                <span class="avatar-title rounded-circle bg-secondary">2</span>
                            </div>
                            <div>
                                <a href="#">Design with Sketch</a>
                                <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                            </div>

                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="avatar avatar-sm mr-3">
                                <span class="avatar-title rounded-circle bg-secondary">3</span>
                            </div>
                            <div>
                                <a href="#">Build static HTML/CSS with Bootstrap 4</a>
                                <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="avatar avatar-sm mr-3">
                                <span class="avatar-title rounded-circle bg-secondary">4</span>
                            </div>
                            <div>
                                <a href="#">Rails New Application</a>
                                <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="avatar avatar-sm mr-3">
                                <span class="avatar-title rounded-circle bg-secondary">5</span>
                            </div>
                            <div>
                                <a href="#">Github and push your first commit.</a>
                                <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="avatar avatar-sm mr-3">
                                <span class="avatar-title rounded-circle bg-secondary">6</span>
                            </div>
                            <div>
                                <a href="#">Add Bootstrap 4 to Rails</a>
                                <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="avatar avatar-sm mr-3">
                                <span class="avatar-title rounded-circle bg-secondary">7</span>
                            </div>
                            <div>
                                <a href="#">Include Designed SASS assets</a>
                                <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="avatar avatar-sm mr-3">
                                <span class="avatar-title rounded-circle bg-secondary">8</span>
                            </div>
                            <div>
                                <a href="#">Basics of Routing</a>
                                <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center">
                            <div class="avatar avatar-sm mr-3">
                                <span class="avatar-title rounded-circle bg-secondary">9</span>
                            </div>
                            <div>
                                <a href="#">Postgres Database</a>
                                <div class="text-muted"><i class="material-icons icon-16pt icon-light">watch_later</i> 1:42</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-8">

                <div class="mb-3"><strong class="text-dark-gray">DESCRIPTION</strong></div>
                <p>
                    This course is for Rails newbies and anyone looking to get a solid foundation. 
                    It’s designed to teach you everything you need to start building web applications in Rails right away. 
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident, deserunt illum ab id temporibus aut 
                    magni similique repellendus et consequuntur.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
