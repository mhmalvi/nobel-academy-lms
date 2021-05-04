@extends('admin.layouts.app')

@section('title', 'Courses')

    @push('css')
        <link href="{{ asset('assets/admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    @endpush

@section('content')
    <div class="container-fluid" id="content">
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.course.add') }}" class="btn btn-primary">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Add New Course
            </a>
        </div>
        <div class="ibox">
            <div class="ibox-content" id="ibox-content">
                <div class="sk-spinner sk-spinner-pulse"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="courses">
                        <thead>
                            <tr class="text-center">
                                <th width="5%" class="text-left"><input type="checkbox" id="select-all"></th>
                                <th width="20%">Course Code</th>
                                <th width="40%">Course Name</th>
                                <th wisth="20%">Created at</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/admin/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    @include('admin.course.scripts')
@endpush
