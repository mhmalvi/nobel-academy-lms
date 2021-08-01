@extends('layouts.app')

@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-end">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Announcement</li>
                    </ol>
                </nav>
                <h1 class="m-0">Announcement</h1>
            </div>
        </div>
    </div>

    <div class="container-fluid page__container">
        <div class="card">
            @if (!is_null($notice->thumbnail))
                <img src="{{ asset('storage/notices/' . $notice->thumbnail) }}" class="card-img-top" alt="post img">
            @else
                <img src="{{ asset('assets/1.jpg') }}" class="card-img-top" alt="post img">
            @endif
            <div class="card-body">
                <h2>{{ $notice->subject }}</h2>
                <p class="card-text">
                    {!! $notice->text !!}
                </p>
            </div>
        </div>
    </div>
@endsection
