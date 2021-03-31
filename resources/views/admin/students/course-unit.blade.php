@extends('admin.layouts.app')

@section('title', 'Assign Unit')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}"/>
@endpush

@section('content')
    <div class="container-fluid">
        <h1><strong>Student Name:</strong>&nbsp;{{$enrollment->student->first_name}}&nbsp;{{$enrollment->student->last_name}}</h1>
        <h4><strong>Course:</strong>&nbsp;{{$enrollment->course->course_name}}</h4>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Core Units</h5>
                    </div>
                    <div class="ibox-content">
                        <form action="{{route('admin.assign', $enrollment->id)}}" method="post">
                            @csrf
                            <input type="hidden" name="unit" value="core"/>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        @isset($core)
                                            @forelse ($core as $item)
                                                <tr>
                                                    <td width="10%">
                                                        <input type="hidden" name="steps[]" value="1">
                                                        <input type="checkbox" 
                                                        class="i-checks" 
                                                        name="units[]" 
                                                        value="{{$item->unit_code}}" 
                                                        {{(!is_null($enrollment->core_units) && in_array($item->unit_code, $enrollment->core_units)) ? 'checked' : ''}}
                                                        />
                                                    </td>
                                                    <td width="90%">{{$item->unit_code}} - {{$item->unit_name}}</td>
                                                </tr>
                                            @empty
                                                <p class="text-center">No data found!</p>
                                            @endforelse
                                        @endisset
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Elective Units</h5>
                    </div>
                    <div class="ibox-content">
                        <form action="" method="post">
                            @csrf
                            <input type="hidden" name="unit" value="elective"/>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        @isset($elective)
                                            @forelse ($elective as $item)
                                                <tr>
                                                    <td width="10%">
                                                        <input 
                                                        type="checkbox" 
                                                        class="i-checks" 
                                                        name="units[]" 
                                                        value="{{$item->unit_code}}"
                                                        {{(!is_null($enrollment->elective_units) && in_array($item->unit_code, $enrollment->elective_units)) ? 'checked' : ''}}
                                                        />
                                                    </td>
                                                    <td width="90%">{{$item->unit_code}} - {{$item->unit_name}}</td>
                                                </tr>
                                            @empty
                                                <p class="text-center">No data found!</p>
                                            @endforelse
                                        @endisset
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- iCheck -->
    <script src="{{asset('assets/admin/js/plugins/iCheck/icheck.min.js')}}"></script>
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

    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endpush
