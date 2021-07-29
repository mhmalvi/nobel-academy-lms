@extends('layouts.app')

@section('title', 'Classrooms')

@section('content')
    <div class="container-fluid page__heading-container">
        <div class="page__heading d-flex align-items-end">
            <div class="flex">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                    class="material-icons icon-20pt">home</i></a></li>
                        <li class="breadcrumb-item active" aria-current="page">All Classrooms</li>
                    </ol>
                </nav>
                <h1 class="m-0">Classrooms</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid page__container">
        @forelse (auth()->user()->classroomOfTeacher->chunk(4) as $items)
            <div class="row">
                @foreach ($items as $item)
                    <div class="col-md-3">
                        <div class="card card__course">
                            <div
                                class="card-header card-header-large card-header-dark bg-dark d-flex justify-content-center">
                                <a class="card-header__title  justify-content-center align-self-center d-flex flex-column"
                                    href="#">
                                    <span class="course__subtitle">{{ $item->name }}</span>
                                    <span class="course__title">Section: {{ $item->section }}</span>
                                </a>
                            </div>
                            <div class="p-3">
                                <div class="mb-2">
                                    <h6>{{ $item->course->course() }}</h6>
                                </div>
                                <div class="d-flex align-items-center">
                                    <strong class="h4 m-0">
                                        <i class="material-icons">school</i>&nbsp;
                                        {{ \App\Models\User::where('classroom_id', $item->id)->count() }}
                                    </strong>
                                    <a href="{{ route('class', $item->uuid) }}"
                                        class="text-primary ml-auto text-decoration-none">
                                        Enter&nbsp;
                                        <i class="material-icons">trending_flat</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @empty
            <p class="text-center">No classroom assigned yet</p>
        @endforelse
    </div>
@endsection
