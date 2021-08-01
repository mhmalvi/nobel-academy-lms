@extends('layouts.app')

@section('title', 'My Profile')

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


            <profile-picture></profile-picture>
        </form>
    </div>
@endsection
