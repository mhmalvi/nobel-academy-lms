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
                        <th>Course</th>
                        <th>Unit Code</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($assesments as $item)
                            <tr>
                                <td></td>
                                <td>{{$item->student_id}}</td>
                                <td>{{$item->course_id}}</td>
                                <td>{{$item->unit_id}}</td>
                                <td>
                                    <select class="status" data-id="{{$item->id}}">
                                        <option value="pending" {{($item->status === 'pending') ? 'selected' : ''}}>Pending</option>
                                        <option value="approve" {{($item->status === 'approve') ? 'selected' : ''}}>Approve</option>
                                        <option value="reject" {{($item->status === 'reject') ? 'selected' : ''}}>Reject</option>
                                    </select>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Launch demo modal
    </button>
        </div>
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Modal title</h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="text" id="demo" class="form-control"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
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
                inline:true,
            });

            $(".status").on("change", function() {
                var id = $(this).data('id');
                var status = $(this).val();

                console.log(status);
            })
        })
    </script>
@endpush
