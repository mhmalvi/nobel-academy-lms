@extends('admin.layouts.app')

@section('title', 'Enroll Student')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/select2/select2.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}"/>
    @include('admin.components.style')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('admin.course.enrollment')}}" method="post" role="form">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-3">
                            <label for="student_id">Student</label>
                            <select name="student_id" class="form-control" id="std">
                                <option value selected disabled>Select a student to enroll</option>
                                @forelse ($students as $item)
                                    <option value = {{$item->id}}>{{$item->first_name}}&nbsp;{{$item->last_name}}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @error('student_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-5">
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
                        <div class="col-md-3">
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
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary my-4"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Enroll</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- List Enroll --}}
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>List of enrollments</h5>
                    </div>

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="core">
                                <thead>
                                    <tr class="text-center">
                                        <th width="5%"><input type="checkbox"></th>
                                        <th width="20%">Student Name</th>
                                        <th width="30%">Course Name</th>
                                        <th width="20%">Instructor</th>
                                        <th width="15%">Enrolled By</th>
                                        <th width="15%">Enrolled At</th>
                                    </tr>
                                </thead>
        
                                <tbody style="font-size: 10px;">
                                    @php
                                        $i = 1;
                                    @endphp
                                    @forelse ($enrollments as $item)
                                        @php
                                            $date = date("M d, Y", strtotime($item->created_at));
                                        @endphp
        
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td>
                                                <a href="{{route('admin.assign', $item->student->id)}}">
                                                    {{$item->student->first_name}}&nbsp;{{$item->student->last_name}}
                                                </a>
                                            </td>
                                            <td>{{$item->course->course_code}}&nbsp;-&nbsp;{{$item->course->course_name}}</td>
                                            <td>{{$item->teacher->first_name}}&nbsp;{{$item->teacher->last_name}}</td>
                                            <td>{{$item->user->name}}</td>
                                            <td>{{$date}}</td>
                                        </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('assets/admin/js/plugins/select2/select2.full.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $("#std").select2({
                placeholder: "Select a student to enroll",
                allowClear: true
            });

            $("#crs").select2({
                placeholder: "Select a course",
                allowClear: true
            });

            $("#tch").select2({
                placeholder: "Select an instructor to assign",
                allowClear: true
            });
        })
    </script>


    <script src="{{asset('assets/admin/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $('#core').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},
                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                        }
                    }
                ],
                columnDefs: [
                    { orderable: false, targets: 0 }
                ],
                order: [[1, 'asc']]
            });
        });
    </script>
@endpush
