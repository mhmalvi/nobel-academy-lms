@extends('admin.layouts.app')

@section('title', 'Courses')

@push('css')
    <link href="{{asset('assets/admin/css/plugins/dataTables/datatables.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid" id="content">
        <div class="ibox">
            <div class="ibox-content" id="ibox-content">
                <div class="sk-spinner sk-spinner-pulse"></div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="courses">
                        <thead>
                            <tr class="text-center">
                                <th width="5%" class="text-left"><input type="checkbox" id="select-all"></th>
                                <th width="20%">Course Code</th>
                                <th width="40%">Course Name</th>
                                <th wisth="20%">Created at</th>
                            </tr>
                        </thead>
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
            var courses = $('#courses').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {
                        text: '<i class="fa fa-pencil-square-o text-info" aria-hidden="true"></i>',
                        action: function ( e, dt, node, config ) {
                            edit('course/get-course','.categories:checked');
                        }
                    },
                    {
                        text: '<i class="fa fa-trash-o text-danger" aria-hidden="true"></i>',
                        action: function ( e, dt, node, config ) {
                            remove('course/remove','.categories:checked');
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i>',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
    
                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                        }
                    },
                    {
                        extend: 'pdf', 
                        text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>', 
                        title: 'QuadQue'
                    },
                    {extend: 'csv'},
                ],
    
                ajax: {
                    url: 'course/all-courses',
                    dataSrc: 'data'
                    },
                columns: [
                    { data: null, defaultContent: '' },
                    { data: "Code" },
                    { data: "Course"},
                    { data: "Created"},
                ],
                columnDefs: [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta){
                        return '<input type="checkbox" class="categories" name="id[]" value="' + $('<div/>').text(data.UniqueId).html() + '">';
                    }
                }],
                order: [[2, 'asc']]
            });



            /*
            ***Check - Uncheck
            */
            $('#select-all').on('click', function(){
                // Get all rows with search applied
                var rows = courses.rows({ 'search': 'applied' }).nodes();

                // Check/uncheck checkboxes for all rows in the table
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });


            
            /*
            *Edit
            */
            function edit(url, checkbox) {
                var id = [];

                $(checkbox).each(function(){
                    id.push($(this).val());
                })

                if(id.length == 1){
                    $.ajax({
                        url: url,
                        method: 'GET',
                        data: {id:$(checkbox).val()},
                        success: function(res){
                            $("#content").html(res);
                        }
                    })
                }else{
                    alert("Cannot edit more then data at a time!");
                }
            }
    
    
    
            /*
            ***Remove
            */
            function remove(url, checkbox){
                var id = [];
                if(confirm("Are you sure to delete? This cannot be undo")){
                    $(checkbox).each(function(){
                        id.push($(this).val());
                    })
    
                    if(id.length > 0){
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            data: {id:id},
                            dataType: 'json',
                            success: function(res){
                                if(res.data.status == 404){
                                    toastr.warning(res.data.message);
                                }else{   
                                    courses.ajax.reload();
                                    toastr.success('Data Successfully Deleted');
                                    $('input[type="checkbox"]').prop('checked', false);
                                }
                            }
                        })
                    }else{
                        alert("Please select atleast one data to delete");
                    }
                }
            }
        });
    </script>
@endpush

