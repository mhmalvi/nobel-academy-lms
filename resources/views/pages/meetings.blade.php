@extends('layouts.app')

@section('title', 'Meetings')

    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endpush

@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-end">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Zoom Meetings</li>
                    </ol>
                </nav>
                <h1 class="m-0">Meetings</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid page__container">
        <div class="card card-form">
            <div class="row no-gutters">
                <div class="col-lg-4 card-body">
                    <p><strong class="headings-color">Create a meeting</strong></p>
                    <p class="text-muted"></p>
                </div>
                <div class="col-lg-8 card-form__body card-body">
                    <form action="{{ route('create.meeting') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="topic">Meeting Topic</label>
                            <input type="text" class="form-control" id="topic" name="topic"
                                placeholder="Type you meeting topic here ..">
                        </div>
                        <div class="form-group">
                            <label for="datetime">Date</label>
                            <input id="dateTime" type="text" class="form-control"
                                placeholder="Schedule your meeting date & time .." name="datetime" data-toggle="flatpickr"
                                value="today">
                        </div>
                        <button type="submit" class="btn btn-primary">Create Meeting</button>
                    </form>
                </div>
            </div>
        </div>

        @forelse ($list as $item)
            <div class="card p-4">
                <div class="row">
                    <div class="col-md-2 d-flex flex-column justify-content-center align-items-center">
                        <div class="text-primary">
                            <!-- LOGO -->
                            <i class="material-icons" style="font-size: 5rem;">voice_chat</i>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="stories-card__title flex">
                            <h5 class="card-title m-0">{{ $item['topic'] }}</h5>
                        </div>

                        <div class="my-3">
                            <p class="text-muted">
                                <strong>Join Link: </strong>{{ $item['join_url'] }}
                            </p>
                            <p class="text-muted">
                                <strong>Password: </strong>{{ $item['password'] }}
                            </p>
                            <p class="text-muted">
                                <strong>Scheduled At: </strong>{{ $item['schedule'] }}
                            </p>
                        </div>

                        <div class="mt-3">
                            <a href="{{ $item['start_url'] }}" target="_blank" class="btn btn-outline-dark mr-2">Start The
                                Meeting</a>
                            <button type="button" class="btn btn-danger mr-2"
                                onclick="document.getElementById('delete_{{ $item['meeting_id'] }}').submit()">Delete</button>
                            <form action="{{ route('remove.meeting', $item['meeting_id']) }}" method="post"
                                id="delete_{{ $item['meeting_id'] }}">
                                @csrf
                                @method('delete')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty

        @endforelse
    </div>
@endsection
@push('js')
    <script src="https://polygit.org/components/webcomponentsjs/webcomponents-lite.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ asset('assets/js/flatpickr.js') }}"></script>
@endpush
