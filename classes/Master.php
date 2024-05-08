<?php
require_once('../config.php');


function save_message()
{
    global $conn;
    extract($_POST);
    $data = "";
    foreach ($_POST as $k => $v) {
        if (!in_array($k, array('id'))) {
            if (!is_numeric($v))
                $v = $conn->real_escape_string($v);
            if (!empty($data)) $data .= ",";
            $data .= " `{$k}`='{$v}' ";
        }
    }
    if (empty($id)) {
        $sql = "INSERT INTO `message_list` set {$data} ";
    } else {
        $sql = "UPDATE `message_list` set {$data} where id = '{$id}' ";
    }

    $save = $conn->query($sql);
    if ($save) {
        $rid = !empty($id) ? $id : $conn->insert_id;
        $resp['status'] = 'success';
        if (empty($id))
            $resp['msg'] = "Your message has successfully sent.";
        else
            $resp['msg'] = "Message details has been updated successfully.";
    } else {
        $resp['status'] = 'failed';
        $resp['msg'] = "An error occured.";
        $resp['err'] = $conn->error . "[{$sql}]";
    }
    if ($resp['status'] == 'success' && !empty($id))
        set_flashdata('success', $resp['msg']);
    if ($resp['status'] == 'success' && empty($id))
        set_flashdata('pop_msg', $resp['msg']);
    return json_encode($resp);
}

function delete_message()
{
    global $conn;
    extract($_POST);
    $del = $conn->query("DELETE FROM `message_list` where id = '{$id}'");
    if ($del) {
        $resp['status'] = 'success';
        set_flashdata('success', "Message has been deleted successfully.");

    } else {
        $resp['status'] = 'failed';
        $resp['error'] = $conn->error;
    }
    return json_encode($resp);

}

function save_doctor()
{
    global $conn;
    extract($_POST);
    $data = "";
    foreach ($_POST as $k => $v) {
        if (!in_array($k, array('id'))) {
            if (!is_numeric($v))
                $v = $conn->real_escape_string($v);
            if (!empty($data)) $data .= ",";
            $data .= " `{$k}`='{$v}' ";
        }
    }
    if (empty($id)) {
        $sql = "INSERT INTO `doctor_list` set {$data} ";
    } else {
        $sql = "UPDATE `doctor_list` set {$data} where id = '{$id}' ";
    }
    $check = $conn->query("SELECT * FROM `doctor_list` where `fullname` ='{$fullname}' and delete_flag = 0 " . ($id > 0 ? " and id != '{$id}' " : ""))->num_rows;
    if ($check > 0) {
        $resp['status'] = 'failed';
        $resp['msg'] = "Doctor already exists.";
    } else {
        $save = $conn->query($sql);
        if ($save) {
            $rid = !empty($id) ? $id : $conn->insert_id;
            $resp['status'] = 'success';
            if (empty($id))
                $resp['msg'] = "Doctor Details has successfully added.";
            else
                $resp['msg'] = "Doctor Details has been updated successfully.";
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "An error occured.";
            $resp['err'] = $conn->error . "[{$sql}]";
        }
        if ($resp['status'] == 'success')
            set_flashdata('success', $resp['msg']);
    }
    return json_encode($resp);
}

function delete_doctor()
{
    global $conn;
    extract($_POST);
    $del = $conn->query("UPDATE `doctor_list` set delete_flag = 1 where id = '{$id}'");
    if ($del) {
        $resp['status'] = 'success';
        set_flashdata('success', "Doctor Details has been deleted successfully.");

    } else {
        $resp['status'] = 'failed';
        $resp['error'] = $conn->error;
    }
    return json_encode($resp);
}

function save_room_type()
{
    global $conn;
    extract($_POST);
    $data = "";
    foreach ($_POST as $k => $v) {
        if (!in_array($k, array('id'))) {
            if (!is_numeric($v))
                $v = $conn->real_escape_string($v);
            if (!empty($data)) $data .= ",";
            $data .= " `{$k}`='{$v}' ";
        }
    }
    if (empty($id)) {
        $sql = "INSERT INTO `room_type_list` set {$data} ";
    } else {
        $sql = "UPDATE `room_type_list` set {$data} where id = '{$id}' ";
    }
    $check = $conn->query("SELECT * FROM `room_type_list` where `room` ='{$room}' and delete_flag = 0 " . ($id > 0 ? " and id != '{$id}' " : ""))->num_rows;
    if ($check > 0) {
        $resp['status'] = 'failed';
        $resp['msg'] = "Room Type already exists.";
    } else {
        $save = $conn->query($sql);
        if ($save) {
            $rid = !empty($id) ? $id : $conn->insert_id;
            $resp['status'] = 'success';
            if (empty($id))
                $resp['msg'] = "Room Type Details has successfully added.";
            else
                $resp['msg'] = "Room Type Details has been updated successfully.";
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "An error occured.";
            $resp['err'] = $conn->error . "[{$sql}]";
        }
        if ($resp['status'] == 'success')
            set_flashdata('success', $resp['msg']);
    }
    return json_encode($resp);
}

function delete_room_type()
{
    global $conn;
    extract($_POST);
    $del = $conn->query("UPDATE `room_type_list` set delete_flag = 1 where id = '{$id}'");
    if ($del) {
        $resp['status'] = 'success';
        set_flashdata('success', "Room Type Details has been deleted successfully.");

    } else {
        $resp['status'] = 'failed';
        $resp['error'] = $conn->error;
    }
    return json_encode($resp);
}

function delete_reminder()
{
    global $conn;
    extract($_POST);
    $del = $conn->query("DELETE FROM reminders WHERE id = '{$id}'");
    if ($del) {
        $resp['status'] = 'success';
        set_flashdata('success', "Reminder has been deleted successfully.");
    } else {
        $resp['status'] = 'failed';
        $resp['error'] = $conn->error;
    }
    return json_encode($resp);
}

function save_room()
{
    global $conn;
    extract($_POST);
    $data = "";
    foreach ($_POST as $k => $v) {
        if (!in_array($k, array('id'))) {
            if (!is_numeric($v))
                $v = $conn->real_escape_string($v);
            if (!empty($data)) $data .= ",";
            $data .= " `{$k}`='{$v}' ";
        }
    }
    if (empty($id)) {
        $sql = "INSERT INTO `room_list` set {$data} ";
    } else {
        $sql = "UPDATE `room_list` set {$data} where id = '{$id}' ";
    }
    $check = $conn->query("SELECT * FROM `room_list` where `name` ='{$name}' and delete_flag = 0 " . ($id > 0 ? " and id != '{$id}' " : ""))->num_rows;
    if ($check > 0) {
        $resp['status'] = 'failed';
        $resp['msg'] = "Room already exists.";
    } else {
        $save = $conn->query($sql);
        if ($save) {
            $rid = !empty($id) ? $id : $conn->insert_id;
            $resp['status'] = 'success';
            if (empty($id))
                $resp['msg'] = "Room Details has successfully added.";
            else
                $resp['msg'] = "Room Details has been updated successfully.";
        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "An error occured.";
            $resp['err'] = $conn->error . "[{$sql}]";
        }
        if ($resp['status'] == 'success')
            set_flashdata('success', $resp['msg']);
    }
    return json_encode($resp);
}

function delete_room()
{
    global $conn;
    extract($_POST);
    $del = $conn->query("UPDATE `room_list` set delete_flag = 1 where id = '{$id}'");
    if ($del) {
        $resp['status'] = 'success';
        set_flashdata('success', "Room Details has been deleted successfully.");

    } else {
        $resp['status'] = 'failed';
        $resp['error'] = $conn->error;
    }
    return json_encode($resp);
}

function save_mother()
{
    global $conn;
    if (empty($_POST['id'])) {
        $prefix = "MOM" . (date('Ym'));
        $code = sprintf("%'.04d", 1);
        while (true) {
            $check = $conn->query("SELECT * FROM `patient_list` where code = '{$prefix}{$code}'")->num_rows;
            if ($check > 0) {
                $code = sprintf("%'.04d", ceil($code) + 1);
            } else {
                break;
            }
        }
        $_POST['code'] = $prefix . $code;
    }
    $_POST['fullname'] = strtoupper($_POST['lastname'] . (!empty($_POST['suffix']) ? ' ' . $_POST['suffix'] : '') . ' ' . $_POST['firstname'] . (!empty($_POST['middlename']) ? ' ' . $_POST['middlename'] : ''));
    global $conn;
    extract($_POST);
    $data = "";
    foreach ($_POST as $k => $v) {
        if (in_array($k, array('fullname', 'email', 'phone', 'code', 'status', 'delete_flag'))) {
            if (!is_numeric($v))
                $v = $conn->real_escape_string($v);
            if (!empty($data)) $data .= ",";
            $data .= " `{$k}`='{$v}' ";
        }
    }
    if (empty($id)) {
        $sql = "INSERT INTO `patient_list` set {$data} ";
    } else {
        $sql = "UPDATE `patient_list` set {$data} where id = '{$id}' ";
    }
    $save = $conn->query($sql);
    if ($save) {
        $pid = !empty($id) ? $id : $conn->insert_id;
        $resp['pid'] = $pid;
        $resp['status'] = 'success';
        if (empty($id))
            $resp['msg'] = "Mothers Details has successfully added.";
        else
            $resp['msg'] = "Mothers Details has been updated successfully.";
        $data = "";
        foreach ($_POST as $k => $v) {
            if (!in_array($k, array('id', 'fullname', 'code', 'status', 'delete_flag'))) {
                if (!is_numeric($v))
                    $v = $conn->real_escape_string($v);
                if (!empty($data)) $data .= ",";
                $data .= " ('{$pid}', '{$k}', '{$v}') ";
            }
        }
        // echo $data;exit;
        if (!empty($data)) {
            $conn->query("DELETE FROM `patient_details` where patient_id = '{$pid}'");
            $sql2 = "INSERT INTO `patient_details` (`patient_id`, `meta_field`, `meta_value`) VALUES {$data}";
            $save2 = $conn->query($sql2);
            if (!$sql2) {
                $resp['status'] = 'failed';
                $resp['msg'] = "An error occured. Error: " . $conn->error;
                $resp['err'] = $conn->error . "[{$sql}]";
            }
        }
    } else {
        $resp['status'] = 'failed';
        $resp['msg'] = "An error occured.";
        $resp['err'] = $conn->error . "[{$sql}]";
    }
    if ($resp['status'] == 'success')
        set_flashdata('success', $resp['msg']);
    return json_encode($resp);
}

function delete_mother()
{
    global $conn;
    extract($_POST);
    $del = $conn->query("UPDATE `patient_list` set delete_flag = 1 where id = '{$id}'");
    if ($del) {
        $resp['status'] = 'success';
        set_flashdata('success', "mother Details has been deleted successfully.");

    } else {
        $resp['status'] = 'failed';
        $resp['error'] = $conn->error;
    }
    return json_encode($resp);
}

function save_mother_history()
{
    global $conn;
    extract($_POST);
    $data = "";
    foreach ($_POST as $k => $v) {
        if (!in_array($k, array('id'))) {
            if (!is_numeric($v))
                $v = $conn->real_escape_string($v);
            if (!empty($data)) $data .= ",";
            $data .= " `{$k}`='{$v}' ";
        }
    }
    if (empty($id)) {
        $sql = "INSERT INTO `patient_history` set {$data} ";
    } else {
        $sql = "UPDATE `patient_history` set {$data} where id = '{$id}' ";
    }

    $save = $conn->query($sql);
    if ($save) {
        $rid = !empty($id) ? $id : $conn->insert_id;
        $resp['status'] = 'success';
        if (empty($id))
            $resp['msg'] = "Mother Record Details has successfully added.";
        else
            $resp['msg'] = "Mother Record Details has been updated successfully.";
    } else {
        $resp['status'] = 'failed';
        $resp['msg'] = "An error occured.";
        $resp['err'] = $conn->error . "[{$sql}]";
    }
    if ($resp['status'] == 'success')
        set_flashdata('success', $resp['msg']);
    return json_encode($resp);
}

function delete_mother_history()
{
    global $conn;
    extract($_POST);
    $del = $conn->query("DELETE FROM `patient_history` where id = '{$id}'");
    if ($del) {
        $resp['status'] = 'success';
        set_flashdata('success', "Mother Record Details has been deleted successfully.");

    } else {
        $resp['status'] = 'failed';
        $resp['error'] = $conn->error;
    }
    return json_encode($resp);
}

function save_mother_admission()
{
    if (empty($_POST['date_discharged'])) {
        $_POST['date_discharged'] = NULL;
        $_POST['status'] = 0;
    } else {
        $_POST['status'] = 1;
    }

    global $conn;
    extract($_POST);

    $data = "";
    foreach ($_POST as $k => $v) {
        if (!in_array($k, array('id'))) {
            if (!is_numeric($v))
                $v = $conn->real_escape_string($v);
            if (!empty($data)) $data .= ",";
            $data .= " `{$k}`='{$v}' ";
        }
    }

    if (empty($id)) {
        $sql = "INSERT INTO `admission_history` set {$data} ";
    } else {
        $sql = "UPDATE `admission_history` set {$data} where id = '{$id}' ";
    }

    $save = $conn->query($sql);
    if ($save) {
        $rid = !empty($id) ? $id : $conn->insert_id;
        $resp['status'] = 'success';
        if (empty($id))
            $resp['msg'] = "Mother Admission Record has successfully added.";
        else
            $resp['msg'] = "Mother Admission Record has been updated successfully.";
    } else {
        $resp['status'] = 'failed';
        $resp['msg'] = "An error occured.";
        $resp['err'] = $conn->error . "[{$sql}]";
    }
    if ($resp['status'] == 'success')
        set_flashdata('success', $resp['msg']);
    return json_encode($resp);
}


function save_reminder()
{
    global $conn;
    extract($_POST);
    $data = "";

    // extract form data make sql string to be inserted
    foreach ($_POST as $k => $v) {
        if (!in_array($k, array('id'))) {
            if (!is_numeric($v))
                $v = $conn->real_escape_string($v);
            if (!empty($data)) $data .= ",";
            $data .= " `{$k}`='{$v}' ";
        }
    }

    if (empty($id)) {
        $sql = "INSERT INTO `reminders` set {$data} ";
    } else {
        $sql = "UPDATE `reminders` set {$data} where id = '{$id}' ";
    }

    $save = $conn->query($sql);
    if ($save) {
        $rid = !empty($id) ? $id : $conn->insert_id;
        $resp['status'] = 'success';
        if (empty($id))
            $resp['msg'] = "Mother Admission Record has successfully added.";
        else
            $resp['msg'] = "Mother Admission Record has been updated successfully.";
    } else {
        $resp['status'] = 'failed';
        $resp['msg'] = "An error occured.";
        $resp['err'] = $conn->error . "[{$sql}]";
    }
    if ($resp['status'] == 'success')
        set_flashdata('success', $resp['msg']);
    return json_encode($resp);
}

function delete_mother_admission()
{
    global $conn;
    extract($_POST);
    $del = $conn->query("DELETE FROM `admission_history` where id = '{$id}'");
    if ($del) {
        $resp['status'] = 'success';
        set_flashdata('success', "Mother Admission Record has been deleted successfully.");

    } else {
        $resp['status'] = 'failed';
        $resp['error'] = $conn->error;
    }
    return json_encode($resp);
}

//}

//$Master = new Master();

$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);

//$sysset = new SystemSettings();

switch ($action) {
    case 'save_room_type':
        echo save_room_type();
        break;
    case 'delete_room_type':
        echo delete_room_type();
        break;
    case 'save_room':
        echo save_room();
        break;
    case 'delete_room':
        echo delete_room();
        break;
    case 'save_message':
        echo save_message();
        break;
    case 'delete_message':
        echo delete_message();
        break;
    case 'save_doctor':
        echo save_doctor();
        break;
    case 'delete_doctor':
        echo delete_doctor();
        break;
    case 'delete_reminder':
        echo delete_reminder();
        break;
    case 'save_mother':
        echo save_mother();
        break;
    case 'delete_mother':
        echo delete_mother();
        break;
    case 'save_mother_history':
        echo save_mother_history();
        break;
    case 'delete_mother_history':
        echo delete_mother_history();
        break;
    case 'save_mother_admission':
        echo save_mother_admission();
        break;
    case 'save_reminders':
        echo save_reminder();
        break;
    case 'delete_mother_admission':
        echo delete_mother_admission();
        break;
    default:
//         echo $sysset->index();
        break;
}