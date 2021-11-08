<?php

require_once('Database.Class.php');

class Blog extends Database {

    public $id;
    public $name;
    public $detail;
    public $detail_short;
    public $img;
    public $view;
    public $status;
    public $created;
    public $updated;
    public $adminID;

    // ฟังชั่นเรียกใช้ข้อมูลจากฐานข้อมูล Blogs ทั้งหมด
    public function queryBlogs() {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM blogs WHERE blog_status = 1 ORDER BY blog_id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    // ฟังชั่นเซ็ตค่าข้อมูล Blogs
    public function setBlogByID($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM blogs WHERE blog_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $this->id = $row["blog_id"];
        $this->name = $row["blog_name"];
        $this->detail = $row["blog_detail"];
        $this->detail_short = $row["blog_detail_short"];
        $this->img = $row["blog_img"];
        $this->view = $row["blog_view"];
        $this->status = $row["blog_status"];
        $this->created = $row["blog_created"];
        $this->updated = $row["blog_updated"];
        $this->adminID = $row["admin_id"];
    }

    //
    public function dateThai($strDate) {
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDays= date("N",strtotime($strDate));
        $strDay= date("j",strtotime($strDate));
        $strHour= date("H",strtotime($strDate));
        $strMinute= date("i",strtotime($strDate)); 
        $strSeconds= date("s",strtotime($strDate));
        $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strDaysCut = Array("","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์","อาทิตย์");
        $strMonthThai = $strMonthCut[$strMonth];
        $strDaysThai = $strDaysCut[$strDays];
        return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute น.";
    }

}

?>