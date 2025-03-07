<?php
require_once('../config.php');
//if (isset($_GET['id'])) {
//    $qry = $conn->query("SELECT * FROM `patient_list` where 1");
//    if ($qry->num_rows > 0) {
//        $res = $qry->fetch_array();
//        foreach ($res as $k => $v) {
//            if (!is_numeric($k))
//                $$k = $v;
//        }
//    }
//}
?>

<div class="container-fluid">
    <form action="" id="reminders-form">
<!--        <input type="hidden" name="id" value="--><?php //echo isset($id) ? $id : '' ?><!--">-->
<!--        <input type="hidden" name="patient_id" value="--><?php //echo isset($_GET['pid']) ? $_GET['pid'] : '' ?><!--">-->

        <div class="row">
            <div class="form-group container">
                <label for="room_id" class="control-label">Mother/Patient's email</label>
                <input type="email" name="email" class="form-control form-control_border" required>
            </div>
        </div>
         <div class="row">
            <div class="form-group container">
                <label for="room_id" class="control-label">Message</label>
                <input type="text" name="message" class="form-control form-control_border" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-6">
                <label for="date_admitted" class="control-label">Due Date</label>
                <input type="datetime-local" name="due_date" id="due_date"
                       class="form-control form-control-border" required>
            </div>
        </div>

        <div class="row">
            <div class="form-group container text-right">
                <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Save" required>
                <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Cancel</button>
            </div>
        </div>

</div>
</form>
</div>
<script>
    $(function () {
        $('#uni_modal').on('shown.bs.modal', function () {
            console.log('test')
            $(".select2").select2({
                placeholder: "Please Select Here",
                width: '100%',
                dropdownParent: $('#uni_modal')
            })
        })
        $('#uni_modal #reminders-form').submit(function (e) {
            e.preventDefault();

            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
            el.addClass("pop-msg alert")
            el.hide()
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_reminders",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log('Error: ', err)
                    alert_toast("An error occured", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (resp.status === 'success') {
                        location.reload();
                    } else if (!!resp.msg) {
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        console.log(resp);
                        _this.prepend(el)
                    } else {
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop: 0}, 'fast')
                    end_loader();
                }
            })
        })
    })
</script>