@extends('admin.layouts.app')

@section('title', 'Course Unit Steps')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}"/>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Create New Step</h5>
                </div>

                <div class="ibox-content">
                    <form action="{{ route('admin.course.step') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="step_name">Step Name</label>
                            <input type="text" name="step_name" id="step_name" class="form-control" placeholder="Name of the step..." value="{{old('step_name')}}"/>
                            @error('step_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descriptions">Descriptions</label>
                            <textarea name="descriptions" id="descriptions" class="form-control" rows="10">{{old('descriptions')}}</textarea>
                            @error('descriptions')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="files">Upload File</label>
                            <input type="file" id="files" class="form-control" name="files" value="Upload" multiple/>
                            @error('files')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="ibox ">
                <div class="ibox-content" id="ibox-content">
                    <div class="sk-spinner sk-spinner-pulse"></div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="steps">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%" class="text-left">
                                        <input type="checkbox" id="select-all">
                                    </th>
                                    <th width="70%">Step</th>
                                    <th width="25%">Created at</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('assets/admin/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>
    @include('admin.CourseUnitStep.scripts')
@endpush
