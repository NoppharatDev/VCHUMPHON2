<?php

require_once('Database.Class.php');

class OrderPackage extends Database {

    public $first_name;
    public $last_name;
    public $phone;
    public $email;
    public $province;
    public $zipcode;
    public $travel_date;
    public $adult;
    public $child;
    public $comment;
    // Query
    public $status = 1;
    public $discount = 0;
    public $duration;
    public $adult_price;
    public $child_price;
    public $pkg_id;

    
    public function setDefaultVal() {
        $this->first_name = "";
        $this->last_name = "";
        $this->phone = "";
        $this->email = "";
        $this->province = "";
        $this->zipcode = "";
        $this->travel_date = "";
        $this->adult = "";
        $this->child = "";
        $this->comment = "";
    }

    // 
    public function setDataOrderPackage() {
        $this->first_name = $_POST["first_name"];
        $this->last_name = $_POST["last_name"];
        $this->phone = $_POST["phone"];
        $this->email = $_POST["email"];
        $this->province = $_POST["province"];
        $this->zipcode = $_POST["zipcode"];
        $this->travel_date = $_POST["travel_date"];
        $this->adult = $_POST["adult"];
        $this->child = $_POST["child"];
        $this->comment = $_POST["comment"];
    }


    // ฟังชั่นเพิ่มรายการจองแพคเกจท่องเที่ยว (OrderPackage)
    public function addOrderPackage($id) {
        $this->setDataOrderPackage();
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM packages WHERE pkg_id = ? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $sumPeople = ($_POST["adult"] + $_POST["child"]);
            $sumPrice = (($_POST["adult"] * $row['pkg_adult_price']) + ($_POST["child"] * $row['pkg_child_price']));
            if($sumPeople >= $row['pkg_promo_start_reduce']) {
                if($row['pkg_promo_unit'] == 1) {
                    $this->discount = ($sumPrice * $row["pkg_promo_quantity"] / 100);
                } else if($row['pkg_promo_unit'] == 2) {
                    $this->discount = $row["pkg_promo_quantity"];
                } else {
                    $this->discount = 0;
                }
            }
            $this->duration = $row["pkg_duration"];
            $this->adult_price = $row["pkg_adult_price"];
            $this->child_price = $row["pkg_child_price"];
            $this->pkg_id = $row["pkg_id"];
        } else {
            echo "ไม่พบ";
        }
        /*echo "ส่วนลด (บาท) : {$this->discount} <br>
        สถานะ : {$this->status} <br>
        จำนวนผู้ใหญ่ : {$this->adult} <br>
        ราคาผู้ใหญ่ : {$this->adult_price} <br>
        จำนวนเด็ก : {$this->child} <br>
        ราคาเด็ก : {$this->child_price} <br>
        ชื่อ {$this->first_name} {$this->last_name} <br>
        โทร. : {$this->phone} <br>
        เมล : {$this->email} <br>
        จังหวัด : {$this->province} <br>
        zipcode : {$this->zipcode} <br>
        travel_date : {$this->travel_date} <br>
        comment : {$this->comment} <br>
        pkg_id : {$this->pkg_id} <br>";*/
        $stmt = $conn->prepare("INSERT INTO order_packages (opkg_discount, opkg_duration, opkg_status, opkg_adult, opkg_adult_price, opkg_child, opkg_child_price, opkg_name, opkg_phone, opkg_email, opkg_province, opkg_zipcode, opkg_travel_date, opkg_comment, customer_id, pkg_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssssssss", $this->discount, $this->duration, $this->status, $this->adult, $this->adult_price, $this->child, $this->child_price, $name, $this->phone, $this->email, $this->province, $this->zipcode, $this->travel_date, $this->comment, $cust_id, $this->pkg_id);
        $name = "{$this->first_name} {$this->last_name}";
        $cust_id = $_SESSION["cust_id"];
        
        if($stmt->execute()) {
            $this->setDefaultVal();
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'สำเร็จ!',
                        text: 'จองสำเร็จ',
                        confirmButtonText: 'ยืนยัน'
                    })
                  </script>";
                    $stmt = $conn->prepare("SELECT opkg_id FROM order_packages ORDER BY opkg_created DESC LIMIT 1");
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $getID;
                    if($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $getID = $row["opkg_id"];
                    }
            echo "<script>window.location.assign(\"/my_packages/{$getID}\")</script>";
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'ไม่สำเร็จ!',
                        text: 'จองไม่สำเร็จ',
                        confirmButtonText: 'ยืนยัน'
                    })
                  </script>";
            die ('prepare() failed: ' . $conn->error);
        }
    }

    // ฟังชั่นเรียกใช้ข้อมูลรายการสินค้าจากฐานข้อมูล
    public function queryOrderPkg() {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM order_packages WHERE customer_id = ? ORDER BY opkg_created DESC");
        $stmt->bind_param("i", $cust_id);
        $cust_id = $_SESSION["cust_id"];
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    //
    public function setOrderPkgByID($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM order_packages WHERE opkg_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $this->name = $row["opkg_name"];
        $this->phone = $row["opkg_phone"];
        $this->email = $row["opkg_email"];
        $this->province = $row["opkg_province"];
        $this->zipcode = $row["opkg_zipcode"];
        $this->travel_date = $row["opkg_travel_date"];
        $this->adult = $row["opkg_adult"];
        $this->child = $row["opkg_child"];
        $this->adult_price = $row["opkg_adult_price"];
        $this->child_price = $row["opkg_child_price"];
        $this->discount = $row["opkg_discount"];
        $this->comment = $row["opkg_comment"];
    }

    public function getPkgName($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM packages WHERE pkg_id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["pkg_name"];
        } else {
            return $id;
        }
    }

    // 
    public function getIDByPkgID($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT pkg_id FROM order_packages WHERE opkg_id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["pkg_id"];
        } else {
            return $id;
        }
    }

    //
    public function getLinkImgPkg($id) {
        return "/img_view/pkg/{$id}/0.3";
    }

    // ฟังชั่นแปลงตัวเลขเป็น ZEROFILL
    public function zerofill($variable, $zerofill){
        return str_pad($variable, $zerofill, '0', STR_PAD_LEFT); // 
    }

    //
    public function dateThai($strDate, $dt) {
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
        if($dt == 'dd-mm-yy h:i') {
            return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute น.";
        } else {
            return "$strDay $strMonthThai $strYear";
        }
    }

}

?>