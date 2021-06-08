@extends('admin.layouts.app')

@section('title', 'Enroll Student')

@push('css')
    @include('admin.components.style')
@endpush

@section('content')
    <div class="container">
        <form action="{{route('admin.student.edit', $student->id)}}" method="post">
            @csrf
            @method('put')

            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-4">
                            <h4>Account Information</h4>
                            <small>
                                Student's account related information
                            </small>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="first_name">User Name <small class="text-danger">*</small></label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe" value="{{$student->user->name}}"/>
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="first_name">Email Address <small class="text-danger">*</small></label>
                                <input type="email" name="email" class="form-control" placeholder="example@email.com" value="{{$student->user->email}}"/>
                                @error('email')
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
                        <div class="col-lg-4">
                            <h4>Personal Information</h4>
                            <small>
                                Student's personal information
                            </small>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="fName">First Name <small class="text-danger">*</small></label>
                                <input type="text" name="fName" class="form-control" placeholder="Enter first name here..." value="{{$student->first_name}}"/>
                                @error('fName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="lName">Last Name <small class="text-danger">*</small></label>
                                <input type="text" name="lName" class="form-control" placeholder="Enter last name here..." value="{{$student->last_name}}"/>
                                @error('lName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone <small class="text-danger">*</small></label>
                                <input type="text" name="phone" class="form-control" placeholder="+00 000 000 000" value="{{$student->phone}}"/>
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="mobile">Mobile</label>
                                <input type="text" name="mobile" class="form-control" placeholder="+00 000 000 000" value="{{$student->mobile}}"/>
                                @error('mobile')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Address <small class="text-danger">*</small></label>
                                <textarea name="address" rows="3" class="form-control" style="resize: none;">{{$student->address_one}}</textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address_op">Address (optional)</label>
                                <textarea name="address_op" rows="3" class="form-control" style="resize: none;">{{$student->address_two}}</textarea>
                                @error('address_op')
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
                        <div class="col-lg-4">
                            <h4>Course Information</h4>
                            <small>
                                Student's course related information
                            </small>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="course_id">Course</label>
                                <select name="course_id" class="form-control" id="crs">
                                    <option value selected disabled>Select a course</option>
                                    @forelse ($courses as $item)
                                        <option value = {{$item->id}} {{($item->id == $student->enrollment->course_id) ? 'selected' : ''}}>{{$item->course_code}} - {{$item->course_name}}</option>
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
                                        <option value = {{$item->id}} {{($item->id == $student->enrollment->teacher_id) ? 'selected' : ''}}>{{$item->first_name}}&nbsp;{{$item->last_name}}</option>
                                    @empty
                                        
                                    @endforelse
                                </select>
                                @error('tutor_id')
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
                        <div class="col-lg-4">
                            <h4>Update Profile Picture</h4>
                        </div>
                        <div class="col-lg-4">
                            <div id="img"></div>
                        </div>
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-outline-primary">Save</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="{{ asset('assets/admin/js/plugins/spartan/spartan-multi-image-picker.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#img").spartanMultiImagePicker({
                fieldName: 'image',
                maxCount: 1,
            });
        });
    </script>
@endpush
