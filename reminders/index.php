
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
                <table class="table table-hover table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="20%">
                        <col width="25%">
                        <col width="30%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date Created</th>
                        <th>Email</th>
                        <th>Mesage</th>
                        <th>Due time</th>
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
                        <td class=""><?php echo date("Y-m-d H:i",strtotime($row['created_at'])) ?></td>
                        <td><?php echo ucwords($row['email']) ?></td>
                        <td><?php echo ucwords($row['message']) ?></td>
                        <td class="truncate-1"><?php echo $row['due_date'] ?></td>
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
<script>
    $(document).ready(function(){
        $('#create_new').click(function () {
            uni_modal("Add New Reminder", "reminders/manage_reminders.php?pid=<?= isset($id) ? $id : '' ?>", 'mid-large')
        })
        $('.edit_data').click(function(){
            uni_modal("Update Reminder Details","reminders/manage_doctor.php?id="+$(this).attr('data-id'))
        })

        $('.delete_data').click(function(){
            _conf("Are you sure to delete this Reminder permanently?","delete_doctor",[$(this).attr('data-id')])
        })

        $('.table td, .table th').addClass('py-1 px-2 align-middle')
        $('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 4 }
            ],
        });
    })
    function delete_doctor($id){
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