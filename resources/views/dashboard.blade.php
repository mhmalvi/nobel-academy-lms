@extends('layouts.app')

@section('title', 'Dashboard')

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
            <div class="col-xl-8">
                @if (auth()->user()->user_type == 'Student')
                    @include('student.quick-access')
                @endif
                {{-- Calendar --}}
                @include('calendar')
            </div>
            <div class="col-xl-4">
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
                    <div class="flex">
                        <div class="text-amount">Total {{ $course->course_units }}</div>
                        <div class="text-muted mt-1">Course Units</div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-white d-flex align-items-center justify-content-between">
                        <h4 class="card-header__title mb-0">
                            <span class="material-icons">announcement</span>&nbsp;
                            Announcements
                        </h4>
                    </div>
                    <div class="card-body py-2">
                        @forelse ($notices as $item)
                            <div class="row">
                                <div class="col-lg-12 py-2">
                                    <div
                                        class="d-flex flex-column flex-xl-row align-items-center text-center text-xl-left align-items-xl-start">
                                        <a href="{{ route('notice', $item->id) }}">
                                            <img class="img-fluid img-lg-150 rounded mr-xl-3 mb-3 mb-xl-0"
                                                src="{{ asset('storage/announcements/' . $item->thumbnail) }}"
                                                alt="post image">
                                        </a>
                                        <div class="flex">
                                            <p class="mb-0 text-justify">
                                                <a href="{{ route('notice', $item->id) }}"
                                                    class="headings-color">{{ $item->subject }}</a>
                                            </p>
                                            <p class="text-muted mb-2">
                                                <small>{{ $item->created_at }}</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-center py-3">No announcements posted</p>
                        @endforelse
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
