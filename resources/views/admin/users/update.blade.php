@extends('admin.layouts.app')

@section('title', 'Update User Info')

@section('content')
    <div class="container">
        <form action="{{ route('admin.user.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>User Account</h4>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="first_name">User Name <small class="text-danger">*</small></label>
                                <input type="text" name="name" class="form-control" placeholder="John Doe"
                                    value="{{ $user->name }}" />
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="first_name">Email Address <small class="text-danger">*</small></label>
                                <input type="email" name="email" class="form-control" placeholder="example@email.com"
                                    value="{{ $user->email }}" />
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="first_name">Password <small class="text-danger">*</small></label>
                                <input type="password" name="password" class="form-control" placeholder="password123" />
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="first_name">Confirm Password <small class="text-danger">*</small></label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="password123" />
                            </div>
                            <div class="form-group">
                                <label for="user_type">User Type</label>
                                <select name="user_type" class="form-control" id="user_type">
                                    <option value selected disabled>Select a user type</option>
                                    <option value="staff" {{ $user->user_type === 'Staff' ? 'selected' : '' }}>Staff
                                    </option>
                                    <option value="student" {{ $user->user_type === 'Student' ? 'selected' : '' }}>Student
                                    </option>
                                    <option value="teacher" {{ $user->user_type === 'Teacher' ? 'selected' : '' }}>Teacher
                                    </option>
                                </select>
                                @error('user_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group d-none" id="crs">
                                <label for="course_id">Course</label>
                                <select name="course_id" class="form-control">
                                    <option value selected disabled>Select a course</option>
                                    @forelse (\App\Models\Course::all() as $item)
                                        <option value={{ $item->id }}>{{ $item->course_code }} -
                                            {{ $item->course_name }}</option>
                                    @empty

                                    @endforelse
                                </select>
                                @error('course_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group d-none" id="cls">
                                <label for="class_id">Class</label>
                                <select name="class_id" class="form-control">
                                    <option value selected disabled>Select a class room</option>
                                    @forelse (\App\Models\Classroom::all() as $item)
                                        <option value={{ $item->id }}>{{ $item->name }} - {{ $item->section }}
                                        </option>
                                    @empty

                                    @endforelse
                                </select>
                                @error('course_id')
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
                        <div class="col-md-4">
                            <h4>User Information</h4>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="fName">First Name <small class="text-danger">*</small></label>
                                <input type="text" name="fName" class="form-control" placeholder="Enter first name here..."
                                    value="{{ old('fName') }}" />
                                @error('fName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lName">Last Name <small class="text-danger">*</small></label>
                                <input type="text" name="lName" class="form-control" placeholder="Enter last name here..."
                                    value="{{ old('lName') }}" />
                                @error('lName')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone <small class="text-danger">*</small></label>
                                <input type="text" name="phone" class="form-control" placeholder="+00 000 000 000"
                                    value="{{ old('phone') }}" />
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address <small class="text-danger">*</small></label>
                                <textarea name="address" rows="3" class="form-control"
                                    style="resize: none;">{{ old('address') }}</textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="avatar">User Image</label>
                                <input type="file" name="avatar" id="avatar" class="form-control">
                                @error('avatar')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"
                    aria-hidden="true"></i>&nbsp;Save</button>
        </form>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $("#user_type").on("change", function() {
                var val = $(this).val();
                switch (val) {
                    case "staff":
                        $("#crs").addClass('d-none');
                        $("#cls").addClass('d-none');
                        break;

                    case "teacher":
                        $("#crs").removeClass('d-none').hide().slideDown('slow');
                        $("#cls").addClass('d-none');
                        break;

                    case "student":
                        $("#crs").removeClass('d-none').hide().slideDown('slow');
                        $("#cls").removeClass('d-none').hide().slideDown('slow');
                        break;
                    default:
                        $("#crs").addClass('d-none');
                        $("#cls").addClass('d-none');
                        break;
                }
            });
        });
    </script>
@endpush
