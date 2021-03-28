@extends('admin.layouts.app')

@section('title', 'Course Files')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}"/>
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('admin.unit.files')}}" method="post" enctype="multipart/form-data" role="form">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label for="file">Choose Unit Type</label>
                            <select name="unit_type" id="unit_type" class="form-control">
                                <option value selected disabled>Choose the unit type</option>
                                <option value="core">Core Unit</option>
                                <option value="elective">Elective Unit</option>
                            </select>
                            @error('unit_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="file">Choose Unit</label>
                            <select name="unit" id="unit" class="form-control">
                                <option value selected disabled>Choose the unit</option>
                                @forelse ($units as $item)
                                    <option value={{$item->id}}>{{$item->unit_name}}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @error('unit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="file">Choose Step</label>
                            <select name="step" id="unit" class="form-control">
                                <option value selected disabled>Choose the unit</option>
                                @forelse ($steps as $item)
                                    <option value={{$item->id}}>{{$item->step_name}}</option>
                                @empty
                                    
                                @endforelse
                            </select>
                            @error('unit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="file">Choose file(s) to upload</label>
                            <input type="file" name="files[]" class="form-control" multiple/>
                            @error('files')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary my-4"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
                    </div>
                </form>
            </div>
        </div>

        {{--  --}}
        <div class="ibox">
            <div class="ibox-title">
                <h5>Data</h5>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="files">
                        <thead>
                            <tr class="text-center">
                                <th width="5%"><input type="checkbox"></th>
                                <th width="10%">Unit Code</th>
                                <th width="35%">File Name</th>
                                <th width="15%">Uploaded By</th>
                                <th width="15%">Approved By</th>
                                <th width="10%">Created At</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @forelse ($files as $item)
                                @php
                                    $date = date("M d, Y", strtotime($item->created_at));
                                @endphp

                                <tr class="text-center">
                                    <td><input type="checkbox"></td>
                                    <td>{{$item->unit->unit_code}}</td>
                                    <td class="text-left">{{$item->file_name}}</td>
                                    <td>{{$item->actionuser->name}}</td>
                                    <td>{{$item->approvedby->name}}</td>
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
    <script src="{{asset('assets/admin/js/plugins/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/dataTables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $("#unit_type").on("change", function(){
                var name = $(this).val();

                $.ajax({
                    url: "{{route('admin.get.unit')}}",
                    method: "POST",
                    data: {name: name},
                    success: function(data){
                        var option = "<option value selected disabled>Choose the unit</option>";
                        data.data.map((res) => {
                            option += `<option value = "${res.id}">${res.unit_code} - ${res.unit_name}</option>`;
                        })

                        $("#unit").html(option);
                    }
                })
            })
        })
    </script>

    <script>
        $(document).ready(function(){
            $('#files').DataTable({
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
