@extends('admin.layouts.app')

@section('title', 'Course Category')

    @push('css')
        <link href="{{ asset('assets/admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    @endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <form action="{{ route('admin.course.category') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <input type="text" name="code" id="code" class="form-control"
                            placeholder="Short code of the category..." value="{{ old('code') }}" />
                        @error('code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" name="category_name" id="category_name" class="form-control"
                            placeholder="Title of the category..." value="{{ old('category_name') }}" />
                        @error('category_name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <textarea name="descriptions" id="descriptions" class="form-control" placeholder="Description"
                            rows="5">{{ old('descriptions') }}</textarea>
                        @error('descriptions')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"
                            aria-hidden="true"></i>&nbsp;Save</button>
                </form>
            </div>
            <div class="col-md-8">
                <div class="ibox ">
                    <div class="ibox-content" id="ibox-content">
                        <div class="sk-spinner sk-spinner-pulse"></div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="categories">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%" class="text-left">
                                            <input type="checkbox" id="select-all">
                                        </th>
                                        <th width="20%">Category Code</th>
                                        <th width="50%">Category</th>
                                        <th width="15%">Created at</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/admin/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    @include('admin.categories.scripts')
@endpush
