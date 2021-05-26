@extends('admin.layouts.app')

@section('title', 'Manage Announcements')

@push('css')
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}"/>
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>List of Announcements</h5>
                    </div>
        
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="notice">
                                <thead>
                                    <tr class="text-center">
                                        <th width="10%"><input type="checkbox"></th>
                                        <th width="70%">Title</th>
                                        <th width="20%">Creaated At</th>
                                    </tr>
                                </thead>
        
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @forelse ($notices as $item)
                                        @php
                                            $date = date("M d, Y", strtotime($item->created_at));
                                        @endphp
        
                                        <tr class="text-center">
                                            <td><input type="checkbox"></td>
                                            <td>{{$item->subject}}</td>
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
            $('#notice').DataTable({
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
