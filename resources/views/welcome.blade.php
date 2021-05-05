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
