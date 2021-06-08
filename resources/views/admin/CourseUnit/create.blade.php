<link rel="stylesheet" href="{{asset('assets/admin/css/plugins/summernote/summernote-bs4.css')}}"/>

<div class="container animated fadeIn">
    <div class="ibox">
        <div class="ibox-title">
            <h5>Create New Unit</h5>
        </div>

        <div class="ibox-content">
            <form action="{{route('admin.course.unit')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row form-group">
                    <div class="col-md-3">
                        <label for="code">Code <small class="text-danger">*</small></label>
                        <input type="text" name="unit_code" class="form-control" placeholder="Short code of the unit..."/>
                        @error('unit_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="type">Type <small class="text-danger">*</small></label>
                        <select name="unit_type" class="form-control">
                            <option value selected disabled>Select a type of the unit</option>
                            <option value="core" {{(old('unit_type') == 'core') ? 'selected' : ''}}>Core Unit</option>
                            <option value="elective" {{(old('unit_type') == 'elective') ? 'selected' : ''}}>Elective Unit</option>
                        </select>
                        @error('unit_type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="course">Course <small class="text-danger">*</small></label>
                        <select name="course" class="form-control">
                            <option value selected disabled>Select a course for the unit</option>
                            @forelse ($courses as $item)
                                <option value="{{$item->id}}" {{(old('course') == $item->id) ? 'selected' : ''}}>{{$item->course_name}}</option>
                            @empty
                                
                            @endforelse
                        </select>
                        @error('course')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Title <small class="text-danger">*</small></label>
                    <input type="text" name="unit_name" class="form-control" placeholder="Title of the unit..." value="{{old('unit_name')}}"/>
                    @error('unit_name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="des">Descriptions</label>
                    <textarea name="descriptions" class="form-control" id="des">{{old('descriptions')}}</textarea>
                    @error('descriptions')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="title">Unit's Files (.pdf/.docx/.ppt)</label>
                    <input type="file" name="files[]" class="form-control" multiple/>
                    @error('files[]')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div> --}}

                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
                <a href="{{route('admin.units')}}" class="btn btn-outline btn-default"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;Cancel</a>
            </form>
        </div>
    </div>
</div>

<script src="{{asset('assets/admin/js/plugins/summernote/summernote-bs4.js')}}"></script>
<script>
    $(document).ready(function(){
        $('#des').summernote({
            height: 500,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
            placeholder: 'Descriptions about the unit...',
            disableResizeEditor: true
        });
   });
</script>
