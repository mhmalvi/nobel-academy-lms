@extends('layouts.app')

@section('title', 'My Profile')

    @push('css')
        <!-- Dropzone -->
        <link type="text/css" href="{{ asset('assets/css/vendor-dropzone.css') }}" rel="stylesheet">
        <link type="text/css" href="{{ asset('assets/css/vendor-dropzone.rtl.css') }}" rel="stylesheet">
    @endpush

@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-end">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profile</li>
                    </ol>
                </nav>
                <h1 class="m-0">My Profile</h1>
            </div>
        </div>
    </div>
    <div class="container page__container">
        <form action="{{ route('edit.profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card card-form">
                <basic-info name="{{ auth()->user()->name }}" fname="{{ auth()->user()->info->firstname }}"
                    lname="{{ auth()->user()->info->lastname }}" email="{{ auth()->user()->email }}"
                    phone="{{ auth()->user()->info->phone }}" address="{{ auth()->user()->info->address }}">
                </basic-info>
            </div>

            <div class="card card-form">
                <password-reset></password-reset>
            </div>


            <div class="card card-form">
                <input type="hidden" name="image" id="image">
                <div class="row no-gutters">
                    <div class="col-lg-4 card-body">
                        <p><strong class="headings-color">Profile Settings</strong></p>
                        <p class="text-muted">Update your public profile with relevant and meaningful information.</p>
                    </div>
                    <div class="col-lg-8 card-form__body card-body">
                        <div class="form-group">
                            <label for="avatar">Image</label>
                            <input style="width: 470px;" type="file" class="form-control" name="avatar" id="avatar" />
                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <!-- Dropzone -->
    <script src="{{ asset('assets/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
@endpush
