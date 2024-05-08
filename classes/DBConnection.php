<?php
//if(!defined('DB_SERVER')){
//    require_once("../initialize.php");
//}

$host = DB_SERVER;
$username = DB_USERNAME;
$password = DB_PASSWORD;
$dbname = DB_NAME;


$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//
//class DBConnection{
//
//    private $host = DB_SERVER;
//    private $username = DB_USERNAME;
//    private $password = DB_PASSWORD;
//    private $database = DB_NAME;
//
//    public $conn;
//
//    public function __construct(){
//
//        if (!isset($this->conn)) {
//
//            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
//
//            if (!$this->conn) {
//                echo 'Cannot connect to database server';
//                exit;
//            }
//        }
//
//    }
//    public function __destruct(){
//        $this->conn->close();
//    }
//}
?>