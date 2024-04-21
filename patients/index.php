<?php if ($_settings->chk_flashdata('success')): ?>
    <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
    </script>
<?php endif; ?>

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Mothers</h3>
        <div class="card-tools">
            <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"><span
                        class="fas fa-plus"></span> Add New Mother</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">

            <table id="example" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Mother Name</th>
                    <th>Email</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $qry = $conn->query("SELECT * from `patient_list` where delete_flag = 0 order by fullname asc ");
                while ($row = $qry->fetch_assoc()):
                    ?>
                    <tr>
                        <td class=""><?php echo $i++; ?></td>
                        <td><?php echo($row['code']) ?></td>
                        <td><?php echo ucwords($row['fullname']) ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                        <td align="center">
                            <button type="button"
                                    class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon"
                                    data-toggle="dropdown">
                                Action
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item edit_data"
                                   href="./?page=patients/view_patient&id=<?= $row['id'] ?>"><span
                                            class="fa fa-eye text-dark"></span> View Records</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item edit_data" href="javascript:void(0)"
                                   data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-dark"></span>
                                    Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" href="javascript:void(0)"
                                   data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span>
                                    Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>

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
                <!--                <button type="button" class="btn btn-primary btn-flat" id='submit'-->
                <!--                        onclick="$('#uni_modal form').submit()">Save-->
                <!--                </button>-->
                <!--                <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Cancel</button>-->
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $('.delete_data').click(function () {
            _conf("Are you sure to delete this user permanently?", "delete_patient", [$(this).attr('data-id')])
        })
        $('#create_new').click(function () {
            uni_modal("Add New Mother Details", "patients/manage_patient.php", 'mid-large')

        })
        $('.edit_data').click(function () {
            uni_modal("Update patient Details", "patients/manage_patient.php?id=" + $(this).attr('data-id'), 'mid-large')
        })

        $('.table td,.table th').addClass('py-1 px-2 align-middle')
        // $('.table').dataTable();
        $('.table').DataTable({
            buttons: [
                {
                    extend: 'copy',
                    text: 'Copy to clipboard'
                },
                'excel',
                'pdf'
            ]
        });
        // $('.table').DataTable( {
        //     dom: 'Bfrtip',
        //     buttons: [
        //         'print'
        //     ]
        // } );
    })

    function delete_patient($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_patient",
            method: "POST",
            data: {id: $id},
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function (resp) {
                if (typeof resp == 'object' && resp.status === 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>