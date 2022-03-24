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
    public $evidence;
    public $pkg_id;
    public $admin_id;
    public $admin_promptpay;
    public $admin_promptpay_name;

    // ฟังชั่นเรียกใช้ข้อมูลจากฐานข้อมูล Order Package ทั้งหมด
    public function querySumOrderPackageDate() {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT opkg_travel_date, (SUM(opkg_adult) + SUM(opkg_child)) AS sum_people FROM order_packages GROUP BY opkg_travel_date");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    
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
            
            //** Send Line */
            $stmt = $conn->prepare("SELECT opkg_id FROM order_packages ORDER BY opkg_id DESC LIMIT 1");
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $opkg_id = $row['opkg_id'];

            date_default_timezone_set("Asia/Bangkok");
            $date_now = date("d/m/Y H:i น.");
            $message = "\n***การจองแพคเกจท่องเที่ยวใหม่***\nหมายเลขการจอง #PKG{$this->zerofill($opkg_id, 6)}TH \nจองเมื่อ {$date_now}\n\n";
            $message .= "ชื่อ-นามสกุล : {$name}\n";
            $message .= "เบอร์โทรศัพท์ : {$this->phone}\n";
            $message .= "อีเมล : {$this->email}\n";
            $message .= "จังหวัด : {$this->province} ({$this->zipcode})\n";
            $message .= "วันที่เริ่มท่องเที่ยว : {$this->travel_date}\n";
            $message .= "ระยะเวลา : {$this->duration}\n";
            $message .= "ผู้ใหญ่ : {$this->adult} คน\n";
            $message .= "เด็ก : {$this->child} คน\n";
            $sum_people = ($this->adult + $this->child);
            $message .= "รวม : {$sum_people} คน\n";
            $sum_price = (($this->adult_price * $this->adult) + ($this->child_price * $this->child));
            $message .= "ราคารวม : {$sum_price} บาท\n";
            $message .= "ส่วนลด : {$this->discount} บาท\n";
            $end_price = ($sum_price - $this->discount);
            $message .= "ราคารวมหลังใช้ส่วนลด : {$end_price} บาท\n";
            $paynow_price = ($end_price * 0.5);
            $message .= "ต้องจ่ายตอนนี้ : {$paynow_price} บาท\n";
            $message .= "จ่ายก่อนเช็คอิน : {$paynow_price} บาท\n";
            $message .= "หมายเหตุ : {$this->comment}\n\n";
            $message .= "**จองผ่านหน้าเว็บไซต์**";
            $stmt = $conn->prepare("SELECT admin_token FROM admins WHERE admin_id = (SELECT admin_id FROM packages WHERE pkg_id = ?) LIMIT 1");
            $stmt->bind_param("i", $this->pkg_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            // echo $row['admin_token'];
            $lineToken = $row['admin_token'];
            if($lineToken != NULL) { $this->sendLineNotify($lineToken, $message); }
            //** Send Line */

            
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
                    $getID = "";
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

    // ฟังชั่นอัพโหลดข้อมูลหลักฐานการชำระเงิน
    public function uploadEvidence($id) {
        if(!empty($_FILES["file"]["name"])) {
            $file_size = ($_FILES["file"]["size"] / 1024);
            if($file_size > 512) {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'อัพโหลดไฟล์ไม่สำเร็จ!',
                            text: 'ขนาดไฟล์ใหญ่เกินกว่า 500 KB',
                            confirmButtonText: 'ยืนยัน'
                        })
                      </script>";
            } else {
                $size = 1;
                if($file_size <= 102.4) { $size = 1; }
                else if($file_size > 102.4 && $file_size < 204.8) { $size = 8; }
                else if($file_size > 204.8 && $file_size < 307.2) { $size = 7; }
                else if($file_size > 307.2 && $file_size < 409.6) { $size = 6; }
                else if($file_size > 409.6 && $file_size < 512) { $size = 5; }
                $img_str = $this->toBinary($_FILES["file"]);
                $size_og = (mb_strlen($img_str, '8bit') / 1024);
                $img_str_new = $this->resize($_FILES["file"], 400);
                $size_new = (mb_strlen($img_str_new, '8bit') / 1024);
                //echo "OG : {$size_og}<br> NEW : {$size_new}";
                //echo "ใช้ไฟล์นี้ได้";
                $conn = $this->connect();
                $stmt = $conn->prepare("UPDATE order_packages SET opkg_evidence = ? WHERE opkg_id = ?");
                $stmt->bind_param("si", $evidence_file, $id);
                $evidence_file = $img_str_new;
                if($stmt->execute()) {
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ!',
                                text: 'อัพโหลดหลักฐานการชำระเงินเรียบร้อย',
                                confirmButtonText: 'ยืนยัน'
                            })
                          </script>";
                    // echo "<script>window.location.assign(\"/my_packages/{$getID}\")</script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สำเร็จ!',
                                text: 'ไม่สามารถอัพโหลดหลักฐานการชำระเงินได้ โปรดลองใหม่อีกครั้ง',
                                confirmButtonText: 'ยืนยัน'
                            })
                          </script>";
                    die ('prepare() failed: ' . $conn->error);
                }
            }
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
        $stmt = $conn->prepare("SELECT * FROM order_packages NATURAL JOIN packages NATURAL JOIN admins WHERE opkg_id = ?");
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
        $this->evidence = $row["opkg_evidence"];
        $this->status = $row["opkg_status"];
        $this->admin_id = $row["admin_id"];
        $this->admin_promptpay = $row["admin_promptpay"];
        $this->admin_promptpay_name = $row["admin_name"];
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

    public function toBinary($file) {
        if(!empty($file['tmp_name'])) {
            return file_get_contents($file['tmp_name']);
        } else {
            return false;
        }
        /*$fp = fopen($file["tmp_name"], "r");
        $ReadBinary = fread($fp, filesize($file["tmp_name"]));
        fclose($fp);
        return $FileData = addslashes($ReadBinary);*/
        //$imageProperties = getimageSize($_FILES['GRAD_PHOTO']['tmp_name']);
    }

    public function resize($imageFile, $widthIn = 100) {
        $images = $imageFile["tmp_name"];
        $filename = $imageFile['name'];
        $type = pathinfo($filename, PATHINFO_EXTENSION);
		$new_images = "resize.tmp";
		// copy($imageFile["tmp_name"],"MyResize/".$imageFile["name"]);
		$width = $widthIn; ## Fix Width & Heigh (Autu caculate)
		$size = GetimageSize($images);
		$height = round($width*$size[1]/$size[0]);
        if($type == 'jpg' || $type == 'jpeg') { $images_orig = ImageCreateFromJPEG($images); }
		else if($type == 'png') { $images_orig = ImageCreateFromPNG($images); }
		$photoX = ImagesX($images_orig);
		$photoY = ImagesY($images_orig);
		$images_fin = ImageCreateTrueColor($width, $height);
		ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
		ImageJPEG($images_fin, "MyResize/".$new_images);
        ImageDestroy($images_orig);
        ImageDestroy($images_fin);
        $data = file_get_contents("MyResize/".$new_images);
        return $data;
        //echo 'data:image/jpg;base64,' . base64_encode($data);
    }

    // /// // / / / // / 
    public function sendLineNotify($sToken, $sMessage) {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        date_default_timezone_set("Asia/Bangkok");

        $chOne = curl_init(); 
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt( $chOne, CURLOPT_POST, 1); 
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec( $chOne ); 

        //Result error 
        if(curl_error($chOne)) { 
            echo 'error:' . curl_error($chOne); 
        } else { 
            $result_ = json_decode($result, true); 
            // echo "status : ".$result_['status']; echo "message : ". $result_['message'];
        } 
        curl_close( $chOne );
    }

}

?>