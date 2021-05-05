@extends('layouts.app')

@push('css')
    <!-- FullCalendar -->
    <link type="text/css" href="{{ asset('assets/vendor/fullcalendar/fullcalendar.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-end">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Event Calendar</li>
                    </ol>
                </nav>
                <h1 class="m-0">Calendar</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid page__container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-body">
                    <div id="calendar" data-toggle="fullcalendar"></div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div>
@endsection

@push('js')
    <!-- jQuery UI (for draggable) -->
    <script src="{{ asset('assets/vendor/jquery-ui.min.js') }}"></script>

    <!-- Moment.js -->
    <script src="{{ asset('assets/vendor/moment.min.js') }}"></script>

    <!-- FullCalendar -->
    <script src="{{ asset('assets/vendor/fullcalendar/fullcalendar.min.js') }}"></script>
    {{-- <script src="{{asset('assets/js/fullcalendar.js')}}"></script> --}}

    <script>
        $('[data-toggle="fullcalendar"]').each(function() {
            var element = $(this);
            var options = {
                themeSystem: 'bootstrap4',
                slotDuration: '00:15:00',
                minTime: '08:00:00',
                maxTime: '19:00:00',
                defaultView: 'month',
                handleWindowResize: true,
                height: $(window).height() - 200,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: '',
                editable: true,
                droppable: true,
                eventLimit: true,
                selectable: true,
            };
            element.fullCalendar(options);
        });

    </script>
@endpush
