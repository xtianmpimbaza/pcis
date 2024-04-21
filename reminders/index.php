
<div class="card card-outline card-teal rounded-0 shadow">
    <div class="card-header">
        <h3 class="card-title">List of Reminders</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Add New Reminder</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="container-fluid">
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Mesage</th>
                        <th>Due time</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT * from `reminders` where status = 1 order by `id` desc ");
                    while($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i++; ?></td>
                        <td><?php echo ucwords($row['email']) ?></td>
                        <td><?php echo ucwords($row['message']) ?></td>
                        <td class=""><?php echo $row['due_date'] ?></td>
                        <td class=""><?php echo date("Y-m-d H:i",strtotime($row['created_at'])) ?></td>
                        <td align="center">
                            <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                Action
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item view_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View User</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade rounded-0" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered rounded-0" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header rounded-0">
                <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body rounded-0">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $('#create_new').click(function () {
            uni_modal("Add New Reminder", "reminders/manage_reminders.php?pid=<?= isset($id) ? $id : '' ?>", 'mid-large')
        })

        $('.delete_data').click(function(){
            _conf("Are you sure to delete this Reminder permanently?","delete_reminder",[$(this).attr('data-id')])
        })
    })


    function delete_reminder($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_reminder",
            method:"POST",
            data:{id: $id},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occured.",'error');
                end_loader();
            },
            success:function(resp){
                if(typeof resp== 'object' && resp.status == 'success'){
                    location.reload();
                }else{
                    alert_toast("An error occured.",'error');
                    end_loader();
                }
            }
        })
    }
</script>