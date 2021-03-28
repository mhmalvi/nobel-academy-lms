@extends('admin.layouts.app')

@section('title', 'Enroll Student')

@push('css')
    @include('admin.components.style')
@endpush

@section('content')
    <div class="container-xl">
        <form action="{{route('admin.student.enrollment')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-3">
                    <div class="avatar-upload">
                        <div class="avatar-edit" data-toggle="tooltip" data-placement="top" title="Upload Image">
                            <input type='file' id="imageUpload" name="avatar" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url({{asset('assets/admin/pp.png')}});">
                            </div>
                        </div>
                    </div>
                    @error('avatar')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                    <div class="alert alert-info my-2">
                        <small>Image dimension: 300 x 300 pixel | Max Size: 1 MB</small>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>User Account</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="first_name">User Name <small class="text-danger">*</small></label>
                                    <input type="text" name="name" class="form-control" placeholder="John Doe" value="{{old('name')}}"/>
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="first_name">Email Address <small class="text-danger">*</small></label>
                                    <input type="email" name="email" class="form-control" placeholder="example@email.com" value="{{old('email')}}"/>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label for="first_name">Password <small class="text-danger">*</small></label>
                                    <input type="password" name="password" class="form-control" placeholder="password123"/>
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="first_name">Confirm Password <small class="text-danger">*</small></label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="password123"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Course Enroll</h5>
                        </div>
        
                        <div class="ibox-content">
                            <div class="form-group">
                                <label for="course_id">Course</label>
                                <select name="course_id" class="form-control" id="crs">
                                    <option value selected disabled>Select a course</option>
                                    @forelse ($courses as $item)
                                        <option value = {{$item->id}}>{{$item->course_code}} - {{$item->course_name}}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                                @error('course_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tutor_id">Instructor</label>
                                <select name="tutor_id" class="form-control" id="tch">
                                    <option value selected disabled>Select an instructor to assign</option>
                                    @forelse ($teachers as $item)
                                        <option value = {{$item->id}}>{{$item->first_name}}&nbsp;{{$item->last_name}}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                                @error('tutor_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Student Information</h5>
                        </div>
        
                        <div class="ibox-content">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="fName">First Name <small class="text-danger">*</small></label>
                                    <input type="text" name="fName" class="form-control" placeholder="Enter first name here..." value="{{old('fName')}}"/>
                                    @error('fName')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="lName">Last Name <small class="text-danger">*</small></label>
                                    <input type="text" name="lName" class="form-control" placeholder="Enter last name here..." value="{{old('lName')}}"/>
                                    @error('lName')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="phone">Phone <small class="text-danger">*</small></label>
                                    <input type="text" name="phone" class="form-control" placeholder="+00 000 000 000" value="{{old('phone')}}"/>
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" placeholder="+00 000 000 000" value="{{old('mobile')}}"/>
                                    @error('mobile')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="address">Address <small class="text-danger">*</small></label>
                                    <textarea name="address" rows="3" class="form-control" style="resize: none;">{{old('address')}}</textarea>
                                    @error('address')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="address_op">Address (optional)</label>
                                    <textarea name="address_op" rows="3" class="form-control" style="resize: none;">{{old('address_op')}}</textarea>
                                    @error('address_op')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>

                </div>
            </div>
        </form>
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
