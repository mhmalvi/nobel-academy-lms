@extends('layouts.app')

@section('title', 'User Profile')
@section('nav', 'edit profile')
@section('heading', 'Edit Account')

@push('css')
    <!-- Dropzone -->
    <link type="text/css" href="{{asset('assets/css/vendor-dropzone.css')}}" rel="stylesheet">
    <link type="text/css"href="{{asset('assets/css/vendor-dropzone.rtl.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="container page__container">
        <form action="{{route('edit.profile')}}" method="post">
            @csrf
            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col-lg-4 card-body">
                        <p><strong class="headings-color">Basic Information</strong></p>
                        <p class="text-muted">Edit your account details and settings.</p>
                    </div>
                    <div class="col-lg-8 card-form__body card-body">
                        @if (Auth::user()->user_type == 'teacher')
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fname">First name</label>
                                        <input id="fname" name="fname" type="text" class="form-control" placeholder="First name" value="{{Auth::user()->teacher->first_name}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="lname">Last name</label>
                                        <input id="lname" name="lname" type="text" class="form-control" placeholder="Last name" value="{{Auth::user()->teacher->last_name}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input id="phone" name="phone" type="text" class="form-control" placeholder="Phone number" value="{{Auth::user()->teacher->phone}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input id="mobile" name="mobile" type="text" class="form-control" placeholder="Mobile number" value="{{Auth::user()->teacher->mobile}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="desc">Present Address</label>
                                <textarea id="desc" name="prAddress" rows="4" class="form-control" placeholder="Present Address ..." style="resize: none;">{{Auth::user()->teacher->address_one}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="desc">Peramnent Address</label>
                                <textarea id="desc" name="peAddress" rows="4" class="form-control" placeholder="Permanent Address ..." style="resize: none;">{{Auth::user()->teacher->address_two}}</textarea>
                            </div>
                        @endif

                        @if (Auth::user()->user_type == 'student')
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fname">First name</label>
                                        <input id="fname" name="fname" type="text" class="form-control" placeholder="First name" value="{{Auth::user()->student->first_name}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="lname">Last name</label>
                                        <input id="lname" type="text" class="form-control" placeholder="Last name" value="Demian">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input id="phone" name="phone" type="text" class="form-control" placeholder="Phone number" value="{{Auth::user()->student->phone}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="mobile">Mobile Number</label>
                                        <input id="mobile" name="mobile" type="text" class="form-control" placeholder="Mobile number" value="{{Auth::user()->student->mobile}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="desc">Present Address</label>
                                <textarea id="desc" rows="4" class="form-control" placeholder="Present Address ..." style="resize: none;">{{Auth::user()->student->address_one}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="desc">Peramnent Address</label>
                                <textarea id="desc" rows="4" class="form-control" placeholder="Permanent Address ..." style="resize: none;">{{Auth::user()->student->address_two}}</textarea>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card card-form">
                <div class="row no-gutters">
                    <div class="col-lg-4 card-body">
                        <p><strong class="headings-color">Update Your Password</strong></p>
                        <p class="text-muted">Change your password.</p>
                    </div>
                    <div class="col-lg-8 card-form__body card-body">
                        <div class="form-group">
                            <label for="opass">Old Password</label>
                            <input style="width: 470px;" id="opass" type="password" class="form-control" placeholder="Old password"/>
                        </div>
                        <div class="form-group">
                            <label for="npass">New Password</label>
                            <input style="width: 470px;" id="npass" type="password" class="form-control" placeholder="New password"/>
                            <small class="invalid-feedback">The new password must not be empty.</small>
                        </div>
                        <div class="form-group">
                            <label for="cpass">Confirm Password</label>
                            <input style="width: 470px;" id="cpass" type="password" class="form-control" placeholder="Confirm password"/>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card card-form">
                <input type="hidden" name="image" id="image">
                <div class="row no-gutters">
                    <div class="col-lg-4 card-body">
                        <p><strong class="headings-color">Profile Settings</strong></p>
                        <p class="text-muted">Update your public profile with relevant and meaningful information.</p>
                    </div>
                    <div class="col-lg-8 card-form__body card-body">
                        <div class="form-group">
                            <label>Avatar</label>
                            <div class="dz-clickable media align-items-center" 
                            data-toggle="dropzone" 
                            data-dropzone-url="api/upload-profile-picture" 
                            data-dropzone-clickable=".dz-clickable" 
                            data-dropzone-files='["{{(!is_null(auth()->user()->photo)) ? asset('storage/users/'.auth()->user()->photo) : 'assets/images/account-add-photo.svg'}}"]'>
                                <div class="dz-preview dz-file-preview dz-clickable mr-3">
                                    <div class="avatar" style="width: 80px; height: 80px;">
                                        <img src="{{(!is_null(auth()->user()->photo)) ? asset('storage/users/'.auth()->user()->photo) : 'assets/images/account-add-photo.svg'}}" 
                                        class="avatar-img rounded" alt="..." 
                                        data-dz-thumbnail>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <button type="button" class="btn btn-sm btn-primary dz-clickable">Choose photo</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user">User Name</label>
                            <input style="width: 470px;" id="user" name="user" type="text" class="form-control" placeholder="User name" value="{{Auth::user()->name}}">
                        </div>
                        <div class="form-group">
                            <label for="lname">Email</label>
                            <input style="width: 470px;" id="email" name="email" type="email" class="form-control" placeholder="Email address" value="{{Auth::user()->email}}"/>
                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <!-- Dropzone -->
    <script src="{{asset('assets/vendor/dropzone.min.js')}}"></script>
    <script src="{{asset('assets/js/dropzone.js')}}"></script>
@endpush
