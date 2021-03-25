@extends('admin.layouts.app')

@section('title', 'Course Units')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/summernote/summernote-bs4.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}"/>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="ibox">
            <div class="ibox-title">
                <h5>All Core Units</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="core">
                        <thead>
                            <tr class="text-center">
                                <th width="5%"><input type="checkbox"></th>
                                <th width="10%">Unit Type</th>
                                <th width="10%">Unit Code</th>
                                <th width="50%">Unit</th>
                                <th width="15%">Course</th>
                                <th width="10%">Created At</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @forelse ($units as $item)
                                @php
                                    $date = date("M d, Y", strtotime($item->created_at));
                                @endphp

                                <tr class="text-center">
                                    <td><input type="checkbox"></td>
                                    <td>{{$item->unit_type}}</td>
                                    <td>{{$item->unit_code}}</td>
                                    <td>{{$item->unit_name}}</td>
                                    <td>{{$item->course->course_name}}</td>
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
                order: [[3, 'asc']]
            });

        });
    </script>
@endpush
