@extends('admin.layouts.app')

@section('title', 'Create Classroom')

@section('content')
    <div class="animated fadeIn">
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>
                    Create Classroom
                </h2>
            </div>
            <div class="col-lg-2">

            </div>
        </div>
        <div class="container py-3">
            <div class="ibox">
                <form action="{{route('admin.classroom.create')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="ibox-title">
                        <div class="thumbnail">
                            <label class="thumbnail-lbl" for="thumbnail">
                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                                <p class="pt-4">Select a thumbnail (1080 x 250 pixel) for classroom</p>
                            </label>
                            <input type="file" name="thumbnail" id="thumbnail">
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="name" id="title" class="form-control" placeholder="Class title" value="{{old('title')}}">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="section">Section</label>
                            <input type="text" name="section" id="section" class="form-control" placeholder="Section" value="{{old('section')}}">
                            @error('section')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="course">Assign Course</label>
                            <select name="course" id="course" class="form-control">
                                <option value disabled selected>Select course</option>
                                @forelse (\App\Models\Course::all() as $item)
                                    <option value="{{$item->id}}" {{old('course') === $item->id ? 'selected' : ''}}>{{$item->course()}}</option>
                                @empty
                                    <option>
                                        No course published yet
                                    </option>
                                @endforelse
                            </select>
                            @error('course')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="teacher">Assign Teacher</label>
                            <select name="teacher" id="teacher" class="form-control">
                                <option value disabled selected>Select teacher</option>
                                @forelse (\App\Models\User::with('info')->where('user_type', 'Teacher')->get() as $item)
                                    <option value="{{$item->id}}" {{old('teacher') === $item->id ? 'selected' : ''}}>{{$item->info->getUserFullName()}}</option>
                                @empty
                                    <option>
                                        No teacher found
                                    </option>
                                @endforelse
                            </select>
                            @error('teacher')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mt-4 mx-auto">
                            <button type="submit" class="btn btn-outline-primary">Create New Class</button>
                            <button type="reset" class="btn btn-outline-secondary">Clear</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
