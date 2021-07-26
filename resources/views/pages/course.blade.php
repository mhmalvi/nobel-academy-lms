@extends('layouts.app')

@section('title', $course->course_name)

@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="hero-banner bg-primary-dark d-flex flex-row align-items-center py-3">
            <div class="container-fluid page__container">
                <div class="d-flex flex-column">
                    <div>
                        <div class="badge badge-primary">{{ $course->course_code }}</div>
                    </div>
                    <h1 class="text-white mb-0">{{ $course->course_name }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
