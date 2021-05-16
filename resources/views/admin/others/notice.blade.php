@extends('admin.layouts.app')

@section('title', 'Post Announcement')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/summernote/summernote-bs4.css')}}"/>
    @include('admin.others.styles')
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto">
                <form action="{{route('admin.announcement.post')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="Subject of the announcement" value="{{old('subject')}}"/>
                                @error('subject')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="subject">Descriptions</label>
                                <textarea name="descriptions" id="desc">{{old('desc')}}</textarea>
                                @error('descriptions')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p>Upload Thumbnail</p>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit" data-toggle="tooltip" data-placement="top" title="Upload Image">
                                                <input type='file' id="imageUpload" name="file" accept=".png, .jpg, .jpeg" />
                                                <label for="imageUpload"></label>
                                            </div>
                                            <div class="avatar-preview">
                                                <div id="imagePreview" style="background-image: url({{asset('assets/admin/thumb.png')}});">
                                                </div>
                                            </div>
                                        </div>
                                        @error('file')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('assets/admin/js/plugins/summernote/summernote-bs4.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#desc').summernote({
                height: 600,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                ],
                placeholder: 'Descriptions about the unit...',
                disableResizeEditor: true
            });
       });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
@endpush
