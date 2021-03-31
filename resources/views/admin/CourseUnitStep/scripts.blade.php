<script>
    $(document).ready(function(){
        var steps =$('#steps').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {
                    text: '<i class="fa fa-pencil-square-o text-info" aria-hidden="true">&nbsp;Edit Unit</i>',
                    action: function ( e, dt, node, config ) {
                        edit('get-step','.steps:checked');
                    }
                },
                {
                    text: '<i class="fa fa-trash-o text-danger" aria-hidden="true">&nbsp;Delete Unit</i>',
                    action: function ( e, dt, node, config ) {
                        remove('remove/steps','.steps:checked');
                    }
                },
                {extend: 'pdf', title: 'ExampleFile'},
                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');
                        $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
                    }
                }
            ],
            ajax: {
                url: 'get-steps',
                dataSrc: 'data'
                },
            columns: [
                { data: null, defaultContent: '' },
                { data: "Step" },
                { data: "Created"},
            ],
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    return '<input type="checkbox" class="steps" name="id[]" value="' + $('<div/>').text(data.Id).html() + '">';
                }
            }],
            order: [[1, 'asc']]
        });


        /*
        ***Check - Uncheck -all
        */
        $('#select-all').on('click', function(){
            // Get all rows with search applied
            var rows = steps.rows({ 'search': 'applied' }).nodes();

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
                    dataType: 'json',
                    success: function(res){
                        if(res.status == 200){
                            $("#id").val(res.data.Id);
                            $('#step_name').val(res.data.Step);
                            $('#descriptions').val(res.data.Details);
                            $('input[type="checkbox"]').prop('checked', false);
                        }
                        else{
                            toastr.warning(res.data.message);
                        }
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
                                steps.ajax.reload();
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