<div class="card card-outline card-teal rounded-0 shadow">
    <div class="card-header">
        <h3 class="card-title">Reports</h3>
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT * from `reminders` where status = 1 order by `id` desc ");
                    while ($row = $qry->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class=""><?php echo date("Y-m-d H:i", strtotime($row['created_at'])) ?></td>
                            <td><?php echo ucwords($row['email']) ?></td>
                            <td><?php echo ucwords($row['message']) ?></td>
                            <td class="truncate-1"><?php echo $row['due_date'] ?></td>

                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#create_new').click(function () {
            uni_modal("Add New Reminder", "reminders/manage_reminders.php?pid=<?= isset($id) ? $id : '' ?>", 'mid-large')
        })

        $('.delete_data').click(function () {
            _conf("Are you sure to delete this Reminder permanently?", "delete_reminder", [$(this).attr('data-id')])
        })
    })


    function delete_reminder($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_reminder",
            method: "POST",
            data: {id: $id},
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function (resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>