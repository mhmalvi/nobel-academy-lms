@extends('layouts.app')

@section('content')

    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-end">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="row card-group-row">
            <div class="col-xl-3 col-md-6 card-group-row__col">
                <div class="card card-group-row__card card-body flex-row align-items-center">
                    <div class="position-relative mr-2">
                        <div class="text-center fullbleed d-flex align-items-center justify-content-center flex-column z-0">
                            <h4 class="text-danger mb-0">
                                @php
                                    $lastStep = $lastProgress->complete_step == 0 ? 1 : $lastProgress->complete_step;
                                    $complete = count($progress) * $lastStep;
                                    $total = ($complete / ($course->course_units * 5)) * 100;
                                @endphp

                                {{ number_format((float) $total, 2, '.', '') }}%
                            </h4>
                            <small class="text-uppercase">Progress</small>
                        </div>
                        <canvas width="90" height="90" class="position-relative z-1" data-toggle="progress-chart"
                            data-progress-chart-value="{{ number_format((float) $total, 2, '.', '') }}"
                            data-progress-chart-color="danger" data-progress-chart-tone="300"></canvas>
                    </div>
                    <!-- <div><i class="material-icons icon-muted icon-40pt mr-3">gps_fixed</i></div> -->
                    <div class="flex">
                        <div class="text-amount">Total {{ $course->course_units }}</div>
                        <div class="text-muted mt-1">Course Units</div>
                        <!-- <div class="text-stats text-success">31.5% <i class="material-icons">arrow_upward</i></div> -->
                    </div>
                </div>
            </div>
            {{-- <div class="col-xl-3 col-md-6 card-group-row__col">
                <div class="card card-group-row__card card-body flex-row align-items-center">
                    <div class="position-relative mr-2">
                        <div class="text-center fullbleed d-flex align-items-center justify-content-center flex-column z-0">
                            <h3 class="text-success mb-0">68%</h3>
                            <small class="text-uppercase">Month</small>
                        </div>
                        <canvas width="90" height="90" class="position-relative z-1" data-toggle="progress-chart"
                            data-progress-chart-value="68" data-progress-chart-color="success"
                            data-progress-chart-tone="400"></canvas>
                    </div>
                    <!-- <div><i class="material-icons icon-muted icon-40pt mr-3">monetization_on</i></div> -->
                    <div class="flex">
                        <div class="text-amount">&dollar;6,670</div>
                        <div class="text-muted mt-1">Sales for June</div>
                        <!-- <div class="text-stats text-success">51.5% <i class="material-icons">arrow_upward</i></div> -->
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 card-group-row__col">
                <div class="card card-group-row__card card-body flex-row align-items-center">
                    <div><i class="material-icons text-primary icon-48pt mr-2">account_circle</i></div>
                    <div class="flex">
                        <div class="text-amount">87%</div>
                        <div class="text-muted mt-1">Sign-Up Percentage</div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 card-group-row__col">
                <div class="card card-group-row__card card-body flex-row align-items-center">
                    <div><i class="material-icons text-success icon-48pt mr-2">check_circle</i></div>
                    <div class="flex">
                        <div class="h4 mb-0">Network Stats</div>
                        <div class="text-muted mt-1">All systems working!</div>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <img src="{{ asset('assets/images/posts/thought-catalog-214785.jpg') }}" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><a href="" class="headings-color">UI Design &amp; Code</a></h5>
                        <p class="card-text">

                        </p>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4 class="card-header__title">
                            <span class="material-icons">announcement</span>&nbsp;
                            Announcements
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-soft-light d-flex align-items-center" role="alert">
                            <i class="material-icons mr-3">info</i>
                            <div class="text-body">
                                <a href="" class="text-dark" style="text-decoration: none;">
                                    Material icons are delightful, beautifully crafted symbols for common actions and items.
                                </a>
                                <span class="badge badge-pill badge-primary">date</span>
                            </div>
                        </div>
                        <div class="alert alert-soft-light d-flex align-items-center" role="alert">
                            <i class="material-icons mr-3">info</i>
                            <div class="text-body">
                                <a href="" class="text-dark" style="text-decoration: none;">
                                    Material icons are delightful, beautifully crafted symbols for common actions and items.
                                </a>
                                <span class="badge badge-pill badge-primary">New</span>
                            </div>
                        </div>
                        <div class="alert alert-soft-light d-flex align-items-center" role="alert">
                            <i class="material-icons mr-3">info</i>
                            <div class="text-body">
                                <a href="" class="text-dark" style="text-decoration: none;">
                                    Material icons are delightful, beautifully crafted symbols for common actions and items.
                                </a>
                                <span class="badge badge-pill badge-primary">New</span>
                            </div>
                        </div>
                        <div class="alert alert-soft-light d-flex align-items-center" role="alert">
                            <i class="material-icons mr-3">info</i>
                            <div class="text-body">
                                <a href="" class="text-dark" style="text-decoration: none;">
                                    Material icons are delightful, beautifully crafted symbols for common actions and items.
                                </a>
                                <span class="badge badge-pill badge-primary">New</span>
                            </div>
                        </div>
                        <div class="alert alert-soft-light d-flex align-items-center" role="alert">
                            <i class="material-icons mr-3">info</i>
                            <div class="text-body">
                                <a href="" class="text-dark" style="text-decoration: none;">
                                    Material icons are delightful, beautifully crafted symbols for common actions and items.
                                </a>
                                <span class="badge badge-pill badge-primary">New</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center border-0">
                        <a href="#">
                            <span class="text-muted">View All</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <!-- Chart.js -->
    <script src="{{ asset('assets/vendor/Chart.min.js') }}"></script>

    <!-- App Charts JS -->
    <script src="{{ asset('assets/js/charts.js') }}"></script>
    <script src="{{ asset('assets/js/progress-charts.js') }}"></script>

    <!-- Chart Samples -->
    <script src="{{ asset('assets/js/page.analytics.js') }}"></script>

    <!-- Vector Maps -->
    <script src="{{ asset('assets/vendor/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/js/vector-maps.js') }}"></script>
@endpush
