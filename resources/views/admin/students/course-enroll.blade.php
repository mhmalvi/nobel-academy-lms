@extends('admin.layouts.app')

@section('title', 'List Enroll Student')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}"/>
    @include('admin.components.style')
@endpush

@section('content')
    <div class="container-fluid">
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
