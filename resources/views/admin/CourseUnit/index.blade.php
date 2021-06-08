@extends('admin.layouts.app')

@section('title', 'Course Units')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/summernote/summernote-bs4.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}"/>
@endpush

@section('content')
    <div class="container-fluid" id="content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>All Core Units</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="units">
                        <thead>
                            <tr class="text-center">
                                <th width="5%" class="text-left"><input type="checkbox" id="select-all"></th>
                                <th width="10%">Unit Type</th>
                                <th width="10%">Unit Code</th>
                                <th width="50%">Unit</th>
                                <th width="15%">Course</th>
                                <th width="10%">Created At</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('assets/admin/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>
    @include('admin.courseUnit.scripts')
@endpush
