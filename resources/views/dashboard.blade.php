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
                @if (auth()->user()->user_type == 'Student')
                    @include('student.analytics')
                @endif
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
                                                src="{{ asset('storage/notices/' . $item->thumbnail) }}" alt="post image">
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
