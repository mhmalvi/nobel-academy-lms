@extends('admin.layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Total Students</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">
                            {{ $totalStd }}
                        </h1>

                        <div class="pt-3">
                            <a href="{{ route('admin.students') }}">
                                <i class="fa fa-list"></i>
                                Students List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Total Instructors</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">
                            {{ $totalTch }}
                        </h1>

                        <div class="pt-3">
                            <a href="{{ route('admin.instructors') }}">
                                <i class="fa fa-list"></i>
                                Instructors List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Total Course</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">
                            {{ $totalCrs }}
                        </h1>
                        <div class="pt-3">
                            <a href="{{ route('admin.courses') }}">
                                <i class="fa fa-list"></i>
                                Courses List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Total Course Units</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">
                            {{ $totalUnits }}
                        </h1>

                        <div class="pt-3">
                            <a href="{{ route('admin.units') }}">
                                <i class="fa fa-list"></i>
                                Course Units List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('admin.classrooms.index')
    </div>
@endsection
