<script>
    $(document).ready(function(){

        var categories = $('#categories').DataTable({
            responsive: true,
            processing: true,
            serverSide: false,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {
                    text: '<i class="fa fa-pencil-square-o text-info" aria-hidden="true"></i>',
                    action: function ( e, dt, node, config ) {
                        edit('get/category','.categories:checked');
                    }
                },
                {
                    text: '<i class="fa fa-trash-o text-danger" aria-hidden="true"></i>',
                    action: function ( e, dt, node, config ) {
                        remove('remove/categories','.categories:checked');
                    }
                },
                {
                    extend: 'pdf', 
                    text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i>', 
                    title: 'QuadQue'
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
                {extend: 'csv',  title: 'QuadQue'}
            ],
            ajax: {
                url: 'all/categories',
                dataSrc: 'data'
                },
            columns: [
                { data: null, defaultContent: '' },
                { data: "Code" },
                { data: "Name"},
                { data: "Created"},
            ],
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    return '<input type="checkbox" class="categories" name="id[]" value="' + $('<div/>').text(data.Id).html() + '">';
                }
            }],
            order: [[2, 'asc']]
        });


        /*
        ***Check - Uncheck
        */
        $('#select-all').on('click', function(){
            // Get all rows with search applied
            var rows = categories.rows({ 'search': 'applied' }).nodes();

            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });


        /*
        * Update
        */
        function edit(url, checkbox){
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
                            $('#category_code').val(res.data.Code);
                            $('#category_name').val(res.data.Name);
                            $('#category_name').trigger('focus', true);
                            $('#description').val(res.data.Details);
                            $('input[type="checkbox"]').prop('checked', false);
                        }
                        else{
                            toastr.warning(res.data.message);
                        }
                    }
                })
            }else{
                alert("Cannot edit more then row data at a time!");
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
                            if(res.status == 404){
                                toastr.warning(res.data.message);
                            }
                            if(res.status == 200){
                                categories.ajax.reload();
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