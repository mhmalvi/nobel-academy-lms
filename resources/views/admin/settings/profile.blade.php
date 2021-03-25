@extends('admin.layouts.app')

@section('title', 'User Profile')

@push('css')
    @include('admin.components.style')
    @include('admin.settings.style')
@endpush

@section('content')
    <div class="wrapper wrapper-content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.userProfileUpdate')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="avatar-upload">
                                    <div class="avatar-edit" data-toggle="tooltip" data-placement="top" title="Upload Image">
                                        <input type='file' id="imageUpload" name="file" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('{{asset((Auth::user()->photo)? 'storage/users/'.Auth::user()->photo : 'assets/admin/pp.png')}}');">
                                        </div>
                                    </div>
                                </div>
                                @error('file')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
            
                                <div class="alert alert-info my-2">
                                    <small>Image dimension: 300 x 300 pixel | Max Size: 1 MB</small>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-head">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="tab-content profile-tab" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                <div class="row form-group">
                                                    <div class="col-md-6">
                                                        <label>User Name</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" name="username" class="form-control" value="{{Auth::user()->name}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label>Email</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <div class="d-flex justify-content-center pt-4">
                            <input type="submit" class="btn btn-outline btn-primary" name="btnAddMore" value="Edit Profile"/>
                        </div>
                    </form>  
                </div>
            </div>        
        </div>
    </div>
@endsection

@push('js')
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
