<link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/summernote/summernote-bs4.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/admin/css/plugins/select2/select2.min.css') }}" />
@include('admin.course.styles')

<div class="animated fadeIn">
    <div class="container">
        <form action="{{ route('admin.course.update', $course->id) }}" method="post" enctype="multipart/form-data"
            id="courseUpdateForm">
            @csrf
            @method('put')

            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="code">Course Code <small class="text-danger">*</small></label>
                                <input type="text" name="course_code" class="form-control"
                                    placeholder="Short code of the course..."
                                    value="{{ $course->course_code ? $course->course_code : old('course_code') }}"
                                    required />
                                @error('course_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="title">Couse Title <small class="text-danger">*</small></label>
                                <input type="text" name="course_name" class="form-control" placeholder="Course title..."
                                    value="{{ $course->course_name ? $course->course_name : old('course_name') }}"
                                    autofocus required />
                                @error('course_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="type">Course Category</label>
                                <select name="category" class="form-control">
                                    <option value selected disabled>Select a category of the course</option>
                                    @forelse (\App\Models\CourseCategory::all() as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $course->course_category_id ? 'selected' : '' }}>
                                            {{ $item->category_name }}
                                        </option>
                                    @empty

                                    @endforelse
                                </select>
                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="instructor">Instructor(s)</label>
                                <select name="tutor_id[]" class="form-control" id="tutors" multiple>
                                    @forelse (\App\Models\User::where('user_type', 'teacher') as $item)
                                        <option value={{ $item->id }}>
                                            {{ $item->first_name }}&nbsp;{{ $item->last_name }}
                                        </option>
                                    @empty

                                    @endforelse
                                </select>
                                @error('tutor_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="type">Total Units <small class="text-danger">*</small></label>
                                <input type="text" name="units" class="form-control" placeholder="Total course units..."
                                    value="{{ $course->course_units ? $course->course_units : old('units') }}" />
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
                                        <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview"
                                            style="background-image: url({{ $course->course_thumbnail ? asset('storage/courses/' . $course->course_thumbnail) : asset('assets/admin/thumb.png') }});">
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
                        <textarea name="descriptions" class="form-control" id="des">
                                {{ $course->descriptions ? $course->descriptions : old('descriptions') }}
                            </textarea>
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
