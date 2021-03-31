<script>
    $(document).ready(function(){
        var units =$('#units').DataTable({
            pageLength: 25,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {
                    text: '<i class="fa fa-plus-circle text-success" aria-hidden="true">&nbsp;New Unit</i>',
                    action: function ( e, dt, node, config ) {
                        addUnit("{{route('admin.course.unit')}}");
                    }
                },
                {
                    text: '<i class="fa fa-pencil-square-o text-info" aria-hidden="true">&nbsp;Edit Unit</i>',
                    action: function ( e, dt, node, config ) {
                        edit('get-unit','.units:checked');
                    }
                },
                {
                    text: '<i class="fa fa-trash-o text-danger" aria-hidden="true">&nbsp;Delete Unit</i>',
                    action: function ( e, dt, node, config ) {
                        remove('remove/unit','.units:checked');
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
                url: 'all-units',
                dataSrc: 'data'
                },
            columns: [
                { data: null, defaultContent: '' },
                { data: "Type" },
                { data: "Code"},
                { data: "Unit"},
                { data: "Course"},
                { data: "Created"},
            ],
            columnDefs: [{
                'targets': 0,
                'searchable': false,
                'orderable': false,
                'className': 'dt-body-center',
                'render': function (data, type, full, meta){
                    return '<input type="checkbox" class="units" name="id[]" value="' + $('<div/>').text(data.Id).html() + '">';
                }
            }],
            order: [[3, 'asc']]
        });



        /*
        ***Check - Uncheck
        */
        $('#select-all').on('click', function(){
            // Get all rows with search applied
            var rows = units.rows({ 'search': 'applied' }).nodes();

            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });



        // Add Unit
        function addUnit(url) {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(res){
                    $("#content").html(res);
                },
                error: function (e) {
                    alert(e);
                }
            })
        }



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
                                units.ajax.reload();
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