<?php
require_once '../config.php';

//class Login extends DBConnection
//{
//    private $settings;

//    public function __construct()
//    {
//        global $_settings;
//        $this->settings = $_settings;
//
//        parent::__construct();
//        ini_set('display_error', 1);
//    }
//
//    public function __destruct()
//    {
//        parent::__destruct();
//    }

function index()
{
    echo "<h1>Access Denied</h1> <a href='" . base_url . "'>Go Back.</a>";
}

function login()
{
    global $conn;
    extract($_POST);

    $stmt = $conn->prepare("SELECT * from users where username = ? and password = ? ");
    $pw = md5($password);
    $stmt->bind_param('ss', $username, $pw);
    $stmt->execute();
    $qry = $stmt->get_result();

    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        if ($res['status'] != 1) {
            return json_encode(array('status' => 'notverified'));
        }
        foreach ($res as $k => $v) {
            if (!is_numeric($k) && $k != 'password') {
                set_userdata($k, $v);
            }
        }
        set_userdata('login_type', 1);
        return json_encode(array('status' => 'success'));
    } else {
        return json_encode(array('status' => 'incorrect', 'error' => $conn->error));
    }
}

function logout()
{
    if (sess_des()) {
        redirect('login.php');
    }
}

function client_login()
{
    global $conn;
    extract($_POST);

    $stmt = $conn->prepare("SELECT *,concat(lastname,', ',firstname,' ',middlename) as fullname from client_list where email = ? and `password` = ? ");
    $pw = md5($password);
    $stmt->bind_param('ss', $email, $pw);
    $stmt->execute();
    $qry = $stmt->get_result();
    if ($conn->error) {
        $resp['status'] = 'failed';
        $resp['msg'] = "An error occurred while fetching data. Error:" . $conn->error;
    } else {
        if ($qry->num_rows > 0) {
            $res = $qry->fetch_array();
            if ($res['status'] == 1) {
                foreach ($res as $k => $v) {
                    set_userdata($k, $v);
                }
                set_userdata('login_type', 2);
                $resp['status'] = 'success';
            } else {
                $resp['status'] = 'failed';
                $resp['msg'] = "Your Account is not verified yet.";
            }

        } else {
            $resp['status'] = 'failed';
            $resp['msg'] = "Invalid email or password.";
        }
    }
    return json_encode($resp);
}

function client_logout()
{
    if (sess_des()) {
        redirect('./login.php');
    }
}

//}

$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
//$auth = new Login();
switch ($action) {
    case 'login':
        echo login();
        break;
    case 'logout':
        echo logout();
        break;
    case 'client_login':
        echo client_login();
        break;
    case 'client_logout':
        echo client_logout();
        break;
    default:
        echo index();
        break;
}

