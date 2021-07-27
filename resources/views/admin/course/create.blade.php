@extends('admin.layouts.app')

@section('title', 'Create new course')

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/summernote/summernote-bs4.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/select2/select2.min.css') }}" />
        @include('admin.course.styles')
    @endpush

@section('content')
    <div class="animated fadeIn">
        <div class="container">
            <form action="{{ route('admin.course.add') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="code">Course Code <small class="text-danger">*</small></label>
                                    <input type="text" name="course_code" class="form-control"
                                        placeholder="Short code of the course..." value="{{ old('course_code') }}"
                                        required />
                                    @error('course_code')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">Couse Title <small class="text-danger">*</small></label>
                                    <input type="text" name="course_name" class="form-control" placeholder="Course title..."
                                        value="{{ old('course_name') }}" required />
                                    @error('course_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="type">Course Category</label>
                                    <select name="category" class="form-control">
                                        <option value selected disabled>Select a category of the course</option>
                                        @forelse (\App\Models\CourseCategory::all() as $item)
                                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                        @empty

                                        @endforelse
                                    </select>
                                    @error('category')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="type">Total Units <small class="text-danger">*</small></label>
                                    <input type="text" name="units" class="form-control" placeholder="Total course units..."
                                        value="{{ old('units') }}" />
                                    @error('units')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Thumbnail ( .png | .jpg | .jpeg ) <small
                                            class="text-danger">*</small></label>
                                    <div class="avatar-upload">
                                        <div class="avatar-edit" data-toggle="tooltip" data-placement="top"
                                            title="Upload Image">
                                            <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg"
                                                required />
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview"
                                                style="background-image: url({{ asset('assets/admin/thumb.png') }});">
                                            </div>
                                        </div>
                                    </div>
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-content">
                        <div class="form-group">
                            <label for="des">Descriptions</label>
                            <textarea name="descriptions" class="form-control"
                                id="des">{{ old('descriptions') }}</textarea>
                            @error('descriptions')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="py-2 d-flex justify-content-center">
                    <img src="" alt="" class="" id="image-preview" />
                </div>

                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"
                        aria-hidden="true"></i>&nbsp;Save</button>
                <a href="{{ route('admin.courses') }}" class="btn btn-secondary"><i
                        class="fa fa-times"></i>&nbsp;Cancel</a>

            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/admin/js/plugins/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#tutors").select2({
                placeholder: 'Select course instructor(s)'
            });

            $('#des').summernote({
                height: 500,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],
                placeholder: 'Descriptions about the course...',
                disableResizeEditor: true
            });
        })
    </script>
    @include('admin.course.scripts')
@endpush
