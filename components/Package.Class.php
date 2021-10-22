<?php

require_once('Database.Class.php');

class Package extends Database {

    public $arrType = array('product' => 3, 'food' => 1, 'coffee' => 2); // ตั้งค่า Type ID

    public $id;
    public $name;
    public $duration;
    public $adult_max;
    public $adult_price;
    public $child_max;
    public $child_price;
    public $detail;
    public $start_reduce;
    public $quantity;
    public $unit;
    public $slide1_name = NULL;
    public $slide1_img = NULL;
    public $slide1_detail = NULL;
    public $slide2_name = NULL;
    public $slide2_img = NULL;
    public $slide2_detail = NULL;
    public $slide3_name = NULL;
    public $slide3_img = NULL;
    public $slide3_detail = NULL;
    public $img = NULL;
    public $default_img = "https://s.isanook.com/tr/0/rp/r/w728/ya0xa0m1w0/aHR0cHM6Ly9zLmlzYW5vb2suY29tL3RyLzAvdWQvMjgzLzE0MTc0MTUvYWhyMGNobTZseTl6bG1senl3NXZiMnN1eTI5dGxfOS5qcGc=.jpg";

    // ฟังชั่นแปลงไฟล์ภาพเป็น binary
    public function toBinary($file) {
        if(!empty($file['tmp_name'])) {
            return file_get_contents($file['tmp_name']);
        } else {
            return NULL;
        }
    }

    // ฟังชั่นรีเซ็ตค่าทั้งหมด
    public function setDefaultVal() {
        $this->id = NULL;
        $this->name = NULL;
        $this->duration = NULL;
        $this->adult_max = NULL;
        $this->adult_price = NULL;
        $this->child_max = NULL;
        $this->child_price = NULL;
        $this->detail = NULL;
        $this->start_reduce = NULL;
        $this->quantity = NULL;
        $this->unit = NULL;
        $this->slide1_name = NULL;
        $this->slide1_img = NULL;
        $this->slide1_detail = NULL;
        $this->slide2_name = NULL;
        $this->slide2_img = NULL;
        $this->slide2_detail = NULL;
        $this->slide3_name = NULL;
        $this->slide3_img = NULL;
        $this->slide3_detail = NULL;
        $this->img = NULL;
    }

    // ฟังชั่นเพิ่มสินค้า
    public function insertPackage() {
        if(isset($_POST['submit'])) {
            $this->name = $_POST['name'];
            $this->duration = $_POST['duration'];
            $this->adult_max = $_POST['adult_max'];
            $this->adult_price = $_POST['adult_price'];
            $this->child_max = $_POST['child_max'];
            $this->child_price = $_POST['child_price'];
            $this->detail = $_POST['detail'];
            $this->start_reduce = $_POST['start_reduce'];
            $this->quantity = $_POST['quantity'];
            $this->unit = $_POST['unit'];
            $this->slide1_name = $_POST['slide1_name'];
            $this->slide1_img = $this->toBinary($_FILES['slide1_img']);
            $this->slide1_detail = $_POST['slide1_detail'];
            $this->slide2_name = $_POST['slide2_name'];
            $this->slide2_img = $this->toBinary($_FILES['slide2_img']);
            $this->slide2_detail = $_POST['slide2_detail'];
            $this->slide3_name = $_POST['slide3_name'];
            $this->slide3_img = $this->toBinary($_FILES['slide3_img']);
            $this->slide3_detail = $_POST['slide3_detail'];
            $this->img = $this->toBinary($_FILES['file']);

            $conn = $this->connect();
            $sql_img = '';
            $sql_s1_img = '';
            $sql_s2_img = '';
            $sql_s3_img = '';
            $sql_v_img = '';
            $sql_vs1_img = '';
            $sql_vs2_img = '';
            $sql_vs3_img = '';
            $arr_values = [$this->name, $this->duration, $this->adult_max, $this->adult_price, $this->child_max, $this->child_price, $this->detail, $this->start_reduce, $this->quantity, $this->unit, $this->slide1_name, $this->slide1_detail, $this->slide2_name, $this->slide2_detail, $this->slide3_name, $this->slide3_detail];
            $types = "ssiiiisiiissssss";
            if($this->img != NULL) { $sql_img = ', pkg_img'; $sql_v_img = ', ?'; array_push($arr_values, $this->img); $types .= "s"; }
            if($this->slide1_img != NULL) { $sql_s1_img = ', pkg_slide1_img'; $sql_vs1_img = ', ?'; array_push($arr_values, $this->slide1_img); $types .= "s"; }
            if($this->slide2_img != NULL) { $sql_s2_img = ', pkg_slide2_img'; $sql_vs2_img = ', ?'; array_push($arr_values, $this->slide2_img); $types .= "s"; }
            if($this->slide2_img != NULL) { $sql_s3_img = ', pkg_slide3_img'; $sql_vs3_img = ', ?'; array_push($arr_values, $this->slide3_img); $types .= "s"; }
            $sql = "INSERT INTO packages (pkg_name, pkg_duration, pkg_adult_max, pkg_adult_price, pkg_child_max, pkg_child_price, pkg_detail, pkg_promo_start_reduce, pkg_promo_quantity, pkg_promo_unit, pkg_slide1_name, pkg_slide1_detail, pkg_slide2_name, pkg_slide2_detail, pkg_slide3_name, pkg_slide3_detail{$sql_img}{$sql_s1_img}{$sql_s2_img}{$sql_s3_img})
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?{$sql_v_img}{$sql_vs1_img}{$sql_vs2_img}{$sql_vs3_img})";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$arr_values);
            
            if($this->slide1_img != NULL) {
                if($stmt->execute()) {
                    $this->setDefaultVal();
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ!',
                                text: 'เพิ่มแพคเกจท่องเที่ยวใหม่สำเร็จ',
                                confirmButtonText: 'ยืนยัน'
                            })
                          </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!',
                                html: 'ไม่สามารถเพิ่มแพคเกจท่องเที่ยวใหม่ได้ โปรดลองใหม่อีกครั้ง {$stmt->error}',
                                confirmButtonText: 'ปิด',
                                confirmButtonColor: '#f27474'
                            })
                          </script>";
                }
                $stmt->close();
                $conn->close();
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'คุณไม่ได้เลือกรูปภาพสำหรับสไลด์ที่ 1 โปรดลองใหม่อีกครั้ง',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
        }
    }

    // ฟังชั่นแก้ไขแพคเกจท่องเที่ยว
    public function updatePackage($id) {
        
        if(isset($_POST['submit'])) {
            $this->name = $_POST['name'];
            $this->duration = $_POST['duration'];
            $this->adult_max = $_POST['adult_max'];
            $this->adult_price = $_POST['adult_price'];
            $this->child_max = $_POST['child_max'];
            $this->child_price = $_POST['child_price'];
            $this->detail = $_POST['detail'];
            $this->start_reduce = $_POST['start_reduce'];
            $this->quantity = $_POST['quantity'];
            $this->unit = $_POST['unit'];
            $this->slide1_name = $_POST['slide1_name'];
            $this->slide1_img = $this->toBinary($_FILES['slide1_img']);
            $this->slide1_detail = $_POST['slide1_detail'];
            $this->slide2_name = $_POST['slide2_name'];
            $this->slide2_img = $this->toBinary($_FILES['slide2_img']);
            $this->slide2_detail = $_POST['slide2_detail'];
            $this->slide3_name = $_POST['slide3_name'];
            $this->slide3_img = $this->toBinary($_FILES['slide3_img']);
            $this->slide3_detail = $_POST['slide3_detail'];
            $this->img = $this->toBinary($_FILES['file']);

            $conn = $this->connect();
            $sql_img = '';
            $sql_s1_img = '';
            $sql_s2_img = '';
            $sql_s3_img = '';
            $arr_values = [$this->name, $this->duration, $this->adult_max, $this->adult_price, $this->child_max, $this->child_price, $this->detail, $this->start_reduce, $this->quantity, $this->unit, $this->slide1_name, $this->slide1_detail, $this->slide2_name, $this->slide2_detail, $this->slide3_name, $this->slide3_detail];
            $types = "ssiiiisiiissssss";
            if($this->img != NULL) { $sql_img = ', pkg_img = ?'; array_push($arr_values, $this->img); $types .= "s"; }
            if($this->slide1_img != NULL) { $sql_s1_img = ', pkg_slide1_img = ?'; array_push($arr_values, $this->slide1_img); $types .= "s"; }
            if($this->slide2_img != NULL) { $sql_s2_img = ', pkg_slide2_img = ?'; array_push($arr_values, $this->slide2_img); $types .= "s"; }
            if($this->slide2_img != NULL) { $sql_s3_img = ', pkg_slide3_img = ?'; array_push($arr_values, $this->slide3_img); $types .= "s"; }
            $types .= "i";
            array_push($arr_values, $this->id);

            $sql = "UPDATE packages SET pkg_name = ?, pkg_duration = ?, pkg_adult_max = ?, pkg_adult_price = ?, pkg_child_max = ?, pkg_child_price = ?, pkg_detail = ?,
                    pkg_promo_start_reduce = ?, pkg_promo_quantity = ?, pkg_promo_unit = ?, pkg_slide1_name = ?, pkg_slide1_detail = ?, pkg_slide2_name = ?,
                    pkg_slide2_detail = ?, pkg_slide3_name = ?, pkg_slide3_detail = ?{$sql_img}{$sql_s1_img}{$sql_s2_img}{$sql_s3_img}
                    WHERE pkg_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($types, ...$arr_values);
            
            if($this->slide1_img != NULL) {
                if($stmt->execute()) {
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ!',
                                text: 'แก้ไขแพคเกจท่องเที่ยวใหม่สำเร็จ',
                                confirmButtonText: 'ยืนยัน'
                            })
                          </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!',
                                html: 'ไม่สามารถแก้ไขแพคเกจท่องเที่ยวใหม่ได้ โปรดลองใหม่อีกครั้ง {$stmt->error}',
                                confirmButtonText: 'ปิด',
                                confirmButtonColor: '#f27474'
                            })
                          </script>";
                }
                $stmt->close();
                $conn->close();
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'คุณไม่ได้เลือกรูปภาพสำหรับสไลด์ที่ 1 โปรดลองใหม่อีกครั้ง',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
        }
    }

    // ฟังชั่นเรียกใช้ข้อมูลจากฐานข้อมูล Packages ทั้งหมด
    public function queryPackages() {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM packages ORDER BY pkg_id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    // ฟังชั่นเช็คการมีอยู่ของแพคเกจท่องเที่ยว ด้วย ID
    public function checkPackageByID($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT pkg_id FROM packages WHERE pkg_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // ฟังชั่นเช็ครูปภาพสินค้า อาหาร เครื่องดื่ม
    public function getImage($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT pkg_img FROM packages WHERE pkg_id = ? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['pkg_img'] == '' || $row['pkg_img'] == NULL || $row['pkg_img'] == 'null' || $row['pkg_img'] == 'NULL') {
                return $this->default_img;
            } else {
                return $id;
            }
        } else {
            return $this->default_img;
        }
    }

    // ฟังชั่นเช็ครูปภาพสไลด์ 1 2 3
    public function getImageSlide($id, $key) {
        $conn = $this->connect();
        if($key == 1) { $stmt = $conn->prepare("SELECT pkg_slide1_img FROM packages WHERE pkg_id = ? LIMIT 1"); }
        else if($key == 2) { $stmt = $conn->prepare("SELECT pkg_slide2_img FROM packages WHERE pkg_id = ? LIMIT 1"); }
        else if($key == 3) { $stmt = $conn->prepare("SELECT pkg_slide3_img FROM packages WHERE pkg_id = ? LIMIT 1"); }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $link = $this->default_img;
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if(!empty($row['pkg_slide1_img'])) {
                if($row['pkg_slide1_img'] != '' || $row['pkg_slide1_img'] != NULL || $row['pkg_slide1_img'] != 'null' || $row['pkg_slide1_img'] != 'NULL') {
                    $link = "../img_view.php?type=pkg1&id={$id}";
                }
            } else if(!empty($row['pkg_slide2_img'])) {
                if($row['pkg_slide2_img'] != '' || $row['pkg_slide2_img'] != NULL || $row['pkg_slide2_img'] != 'null' || $row['pkg_slide2_img'] != 'NULL') {
                    $link = "../img_view.php?type=pkg2&id={$id}";
                }
            } else if(!empty($row['pkg_slide3_img'])) {
                if($row['pkg_slide3_img'] != '' || $row['pkg_slide3_img'] != NULL || $row['pkg_slide3_img'] != 'null' || $row['pkg_slide3_img'] != 'NULL') {
                    $link = "../img_view.php?type=pkg3&id={$id}";
                }
            }
            return $link;
        } else {
            return $link;
        }
    }

    // ฟังชั่นเช็คชื่อสไลด์ 1 2 3
    public function getNameSlide($id, $key) {
        $conn = $this->connect();
        if($key == 1) { $stmt = $conn->prepare("SELECT pkg_slide1_name FROM packages WHERE pkg_id = ? LIMIT 1"); }
        else if($key == 2) { $stmt = $conn->prepare("SELECT pkg_slide2_name FROM packages WHERE pkg_id = ? LIMIT 1"); }
        else if($key == 3) { $stmt = $conn->prepare("SELECT pkg_slide3_name FROM packages WHERE pkg_id = ? LIMIT 1"); }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $name = "หัวข้อภาพสไลด์ที่ {$key}";
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if(!empty($row['pkg_slide1_name'])) {
                if($row['pkg_slide1_name'] != '' || $row['pkg_slide1_name'] != NULL || $row['pkg_slide1_name'] != 'null' || $row['pkg_slide1_name'] != 'NULL') {
                    $name = $row['pkg_slide1_name'];
                }
            } else if(!empty($row['pkg_slide2_name'])) {
                if($row['pkg_slide2_name'] != '' || $row['pkg_slide2_name'] != NULL || $row['pkg_slide2_name'] != 'null' || $row['pkg_slide2_name'] != 'NULL') {
                    $name = $row['pkg_slide2_name'];
                }
            } else if(!empty($row['pkg_slide3_name'])) {
                if($row['pkg_slide3_name'] != '' || $row['pkg_slide3_name'] != NULL || $row['pkg_slide3_name'] != 'null' || $row['pkg_slide3_name'] != 'NULL') {
                    $name = $row['pkg_slide3_name'];
                }
            }   
            return $name;
        } else {
            return $name;
        }
    }

    // ฟังชั่นเช็ครายละเอียดสไลด์ 1 2 3
    public function getDetailSlide($id, $key) {
        $conn = $this->connect();
        if($key == 1) { $stmt = $conn->prepare("SELECT pkg_slide1_detail FROM packages WHERE pkg_id = ? LIMIT 1"); }
        else if($key == 2) { $stmt = $conn->prepare("SELECT pkg_slide2_detail FROM packages WHERE pkg_id = ? LIMIT 1"); }
        else if($key == 3) { $stmt = $conn->prepare("SELECT pkg_slide3_detail FROM packages WHERE pkg_id = ? LIMIT 1"); }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $detail = "รายละเอียดสไลด์ที่ {$key}";
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if(!empty($row['pkg_slide1_detail'])) {
                if($row['pkg_slide1_detail'] != '' || $row['pkg_slide1_detail'] != NULL || $row['pkg_slide1_detail'] != 'null' || $row['pkg_slide1_detail'] != 'NULL') {
                    $detail = $row['pkg_slide1_detail'];
                }
            } else if(!empty($row['pkg_slide2_detail'])) {
                if($row['pkg_slide2_detail'] != '' || $row['pkg_slide2_detail'] != NULL || $row['pkg_slide2_detail'] != 'null' || $row['pkg_slide2_detail'] != 'NULL') {
                    $detail = $row['pkg_slide2_detail'];
                }
            } else if(!empty($row['pkg_slide3_detail'])) {
                if($row['pkg_slide3_detail'] != '' || $row['pkg_slide3_detail'] != NULL || $row['pkg_slide3_detail'] != 'null' || $row['pkg_slide3_detail'] != 'NULL') {
                    $detail = $row['pkg_slide3_detail'];
                }
            }   
            return $detail;
        } else {
            return $detail;
        }
    }

    // ฟังชั่นเซ็ตค่าข้อมูลสินค้าด้วย ID
    public function setPackageByID($id) {
        if($this->checkPackageByID($id)) {
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT * FROM packages WHERE pkg_id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $this->id = $row['pkg_id'];
            $this->name = $row['pkg_name'];
            $this->duration = $row['pkg_duration'];
            $this->adult_max = $row['pkg_adult_max'];
            $this->adult_price = $row['pkg_adult_price'];
            $this->child_max = $row['pkg_child_max'];
            $this->child_price = $row['pkg_child_price'];
            $this->detail = $row['pkg_detail'];
            $this->start_reduce = $row['pkg_promo_start_reduce'];
            $this->quantity = $row['pkg_promo_quantity'];
            $this->unit = $row['pkg_promo_unit'];
            $this->slide1_name = $row['pkg_slide1_name'];
            $this->slide1_img = $row['pkg_slide1_img'];
            $this->slide1_detail = $row['pkg_slide1_detail'];
            $this->slide2_name = $row['pkg_slide2_name'];
            $this->slide2_img = $row['pkg_slide2_img'];
            $this->slide2_detail = $row['pkg_slide2_detail'];
            $this->slide3_name = $row['pkg_slide3_name'];
            $this->slide3_img = $row['pkg_slide3_img'];
            $this->slide3_detail = $row['pkg_slide3_detail'];
            $this->img = $row['pkg_img'];
            $this->promo_quantity = $row['pkg_promo_quantity'];
            $this->promo_unit = $row['pkg_promo_unit'];
        } else {
            echo '<script>window.location.assign("/travel")</script>';
            exit;
        }
    }
    
    // ฟังชั่นเช็ค selected option
    public function selected($val1, $val2) {
        if($val1 == $val2) {
            return 'selected';
        } else {
            return '';
        }
    }

    //
    public function convertPromotion($quantity, $unit) {
        if($unit == 'NULL') {
            return "<span class=\"badge badge-danger\">ไม่มีส่วนลด</span>";
        } else {
            $arr = [null, '%', ' บาท'];
            $newq = number_format($quantity);
            return "<span class=\"badge badge-premium\">{$newq}{$arr[$unit]}</span>";
        }
    }

    //
    public function convertPromotionUnit($unit) {
        if($unit == 'NULL') {
            return "ไม่มีส่วนลด";
        } else {
            $arr = ['ไม่มีส่วนลด', '%', 'บาท'];
            return $arr[$unit];
        }
    }

    // ฟังชั่นแปลงวันเดือนปีเป็นภาษาไทย
    public function convertDate($date) {
        $date_new = date_create($date);
        $arrMonth = [null, 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
        $dayTH = date_format($date_new, "d");
        $monthTH = $arrMonth[date_format($date_new, "n")];
        $yearTH = date_format($date_new, "Y") + 543;
        return "{$dayTH} {$monthTH} {$yearTH} ";
    }

    // ฟังชั่นเช็คไอดีที่ลบว่ามีหรือไม่
    public function checkDelID($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM packages WHERE pkg_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // ฟังชั่นลบแพคเกจท่องเที่ยว
    public function deletePkg($id) {
        if($this->checkDelID($id)) {
            $conn = $this->connect();
            $stmt = $conn->prepare("DELETE FROM packages WHERE pkg_id = ?");
            $stmt->bind_param('i', $id);
            if($stmt->execute()) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'ลบแพคเกจท่องเที่ยวสำเร็จ',
                            confirmButtonText: 'ยืนยัน'
                        })
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'ไม่สามารถลบแพคเกจท่องเที่ยวได้ โปรดลองใหม่อีกครั้ง {$stmt->error}',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
            $stmt->close();
            $conn->close();
        } else {
            echo '<script>window.location.assign("?page=package_list")</script>';
            exit;
        }
    }


}

?>