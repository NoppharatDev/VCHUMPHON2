<?php

class Database {
    
    public $host = "localhost";            // ที่อยู่โฮสต์
    public $username = "root";             // ชื่อผู้ใช้
    public $password = "";                 // รหัสผ่าน
    public $db = "system_management";      // ชื่อฐานข้อมูล

    public function connect() { 
        $conn = new mysqli($this->host, $this->username, $this->password, $this->db);
        $conn->set_charset("utf8");
        if($conn->connect_error) {
            return die("Connection failed : " . $conn->connect_error);
        } else {
            return $conn;
        }
    }
}

?>