<?php
//agar error tidak muncul saat digunakan user, menurut saya error message idealnya di store di file log
error_reporting(0);

class DbConn
{
    private $server,  $username, $password, $dbname;
    public $conn;

    function __construct() {
        $this->server = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->dbname = 'simplerestdb';
        $this->conn = mysqli_connect($this->server, $this->username, $this->password, $this->dbname);
    }

    public function connectNow() {
        try {
            if(!$this->conn) {
                http_response_code(500);
                throw new Exception('Unable to connect DB');
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(array('status'=>500,'message'=>$e->getMessage(),'data'=>array()));
        }
    }
}