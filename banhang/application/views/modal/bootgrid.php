<html>
<head>
    <title>jQuery Bootgrid - Server Side Processing in Codeigniter</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.3.1/jquery.bootgrid.js"></script>  
</head>
<body>
    <div class="container box">
        <h3 align="center">jQuery Bootgrid - Server Side Processing in Codeigniter</h3><br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-10">
                        <h3 class="panel-title">Employee List</h3>
                    </div>
                    <div class="col-md-2" align="right">
                        <button type="button" id="add_button" data-toggle="modal" data-target="#employeeModal" class="btn btn-info btn-xs">Addff</button>
                    </div>
                </div>
                
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="employee_data" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th data-column-id="book_id">book_id</th>
                                <th data-column-id="book_name">book_name</th>
                                <th data-column-id="description">description</th>
                                <th data-column-id="price">price</th>
                                <th data-column-id="img">img</th>
                                <th data-column-id="pub_id">pub_id</th>
                                <th data-column-id="cat_id">cat_id</th>
                                <th data-column-id="commands" data-formatter="commands" data-sortable="false">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
       </div>
    </div>
</body>
</html>

<div id="employeeModal" class="modal fade">
    <div class="modal-dialog">
        <form method="post" id="employee_form">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Employee</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>book_id</label>
                        <input type="text" name="book_id" id="book_id" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>book_name</label>
                        <textarea name="book_name" id="book_name" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>description</label>
                        <input type="text" name="description" id="description" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>price</label>
                        <input type="text" name="price" id="price" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>img</label>
                        <input type="text" name="img" id="img" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>pub_id</label>
                      
                        <select name="pub_id" id="pub_id" class="form-control">
                            <option value="gk">gk</option>
                            <option value="gks">gks</option>
                        </select>
 
                    </div>
                    <div class="form-group">
                        <label>cat_id</label>
                        <input type="text" name="cat_id" id="cat_id" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="employee_book_id" id="employee_book_id" />
                    <input type="hidden" name="operation" id="operation" value="Add" />
                    <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript" language="javascript" >
$(document).ready(function(){
    
    var employeeTable = $('#employee_data').bootgrid({
        ajax:true,
        rowSelect: true,
        post:function()
        {
            return{
                book_id:"b0df282a-0d67-40e5-8558-c9e93b7befed"
            }
        },
        url:"<?php echo base_url(); ?>Modal/bootgrid/fetch_data",
        formatters:{
            "commands":function(column, row)
            {
                return "<button type='button' class='btn btn-warning btn-xs update' data-row-book_id='"+row.id_product+"'>Edit</button>" + "&nbsp; <button type='button' class='btn btn-danger btn-xs delete' data-row-book_id='"+row.id_product+"'>Delete</button>";
            }
        }
    });

    $('#add_button').click(function(){
        $('#employee_form')[0].reset();
        $('.modal-title').text("Add Employee");
        $('#action').val("Add");
        $('#operation').val("Add");
    });

    $(document).on('submit', '#employee_form', function(event){
        event.preventDefault();
        var book_id = $('#book_id').val();
        var book_name = $('#book_name').val();
        var description = $('#description').val();
        var price = $('#price').val();
        var img = $('#img').val();
        var pub_id = $('#pub_id').val();
        var cat_id = $('#cat_id').val();
        var form_data = $(this).serialize();
        if(book_id != '' && book_name != '' &&  description != '' &&  price != '' && img != '' && pub_id != '' && cat_id != '')
        {
            $.ajax({
                url:"<?php echo base_url(); ?>Modal/bootgrid/action",
                method:"POST",
                data:form_data,
                success:function(data)
                {
                    alert(data);
                    $('#employee_form')[0].reset();
                    $('#employeeModal').modal('hide');
                    $('#employee_data').bootgrid('reload');
                }
            });
        }
        else
        {
            alert("All Fields are Required");
        }
    });

    $(document).on("loaded.rs.jquery.bootgrid", function(){
        employeeTable.find('.update').on('click', function(event){
            var book_id = $(this).data('row-book_id');
            $.ajax({
                url:"<?php echo base_url(); ?>Modal/bootgrid/fetch_single_data",
                method:"POST",
                data:{book_id:id_product},
                dataType:"json",
                success:function(data)
                {
                    $('#employeeModal').modal('show');
                    $('#book_id').val(data.id_product);
                    $('#book_name').val(data.name);
                    $('#description').val(data.content);
                    $('#price').val(data.price);
                    $('#img').val(data.image_link);
                    $('#pub_id').val(data.pub_id);
                    $('#cat_id').val(data.id_catalog);
                    $('.modal-title').text("Edit Employee Details");
                    $('#employee_book_id').val(id_product);
                    $('#action').val('Edit');
                    $('#operation').val('Edit');
                }
            });
        });

        employeeTable.find('.delete').on('click', function(event){
            if(confirm("Are you sure you want to delete this?"))
            {
                var book_id = $(this).data('row-book_id');
                $.ajax({
                    url:"<?php echo base_url(); ?>Modal/bootgrid/delete_data",
                    method:"POST",
                    data:{book_id:id_product},
                    success:function(data)
                    {
                        alert(data);
                        $('#employee_data').bootgrid('reload');
                    }
                });
            }
            else
            {
                return false;
            }
        });
    });
    
});
</script>
