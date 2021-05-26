@extends('admin.layouts.app')

@push('css')
<link href="{{asset('assets/admin/datetimepicker/build/jquery.datetimepicker.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="container">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Assesment Requests</h5>
            </div>
            <div class="ibox-content">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Unit Code</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($assesments as $item)
                            <tr>
                                <td></td>
                                <td>{{$item->student->first_name}} {{$item->student->last_name}}</td>
                                <td>{{$item->unit->unit_code}}</td>
                                <td width="10%">
                                    <select class="status" data-id="{{$item->id}}">
                                        <option value="pending" {{($item->status === 'pending') ? 'selected' : ''}}>Pending</option>
                                        <option value="approved" {{($item->status === 'approved') ? 'selected' : ''}}>Approved</option>
                                        <option value="reject" {{($item->status === 'reject') ? 'selected' : ''}}>Reject</option>
                                    </select>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="4">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <h4 class="modal-title">Make Assesment Schedule</h4>
                    <small class="font-bold">Choose preferd date and time to take the assesment exam</small>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="text" id="demo" class="form-control" placeholder="Choose date and time"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary save">Save</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Clock picker -->
    <script src="{{asset('assets/admin/datetimepicker/build/jquery.datetimepicker.full.min.js')}}"></script>
    <script>
        $(document).ready(function(){

            
            $('#demo').datetimepicker({
                format:'Y-m-d H:m:s',
            });

            $(".status").on("change", function() {
                var id = $(this).data('id');
                var status = $(this).val();
                var dateTime = null;

                function request(status) {

                    var assesmentStatus = status;

                    $.ajax({
                        url: "{!! route('admin.assesments') !!}",
                        method: "POST",
                        data: {assesment : id, status:  assesmentStatus, schedule: dateTime},
                        dataType: "json",
                        statusCode: {
                            200: function(res) {
                                toastr.success(res.status);
                            },
                            503: function(res) {
                                toastr.warning(res.status);
                            }
                        },
                        success: function(res) {
                            $("#myModal").modal('hide');
                        }
                    });
                }

                if(status === 'approved'){
                    $("#myModal").modal('show');

                    $(".save").on("click", function(e){
                        e.preventDefault();
                        var dateTime = $("#demo").val();

                        request(status);
                    })
                }else{
                    request(status);
                }
            });
        })
    </script>
@endpush
