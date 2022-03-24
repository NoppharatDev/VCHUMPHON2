<?php

require_once('Database.Class.php');

class Customer extends Database {

    public $email, $pass, $pass_cf, $title_name, $first_name, $last_name, $province, $zipcode, $phone;

    // ฟังชั่นเช็คอีเมลซ้ำ
    public function checkEmail($email) {
        $sql = "SELECT * FROM customers WHERE customer_email = '{$email}'";
        $result = $this->connect()->query($sql);

        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // ฟังชั่นเช็คความถูกต้องของรหัสผ่าน
    public function checkPasswordCf($pass, $pass_cf) {
        if($pass == $pass_cf) {
            return true;
        } else {
            return false;
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

    // ฟังชั่นรีเซ็ตค่าทั้งหมด
    public function setDefaultVal() {
        $this->email = '';
        $this->pass = '';
        $this->pass_cf = '';
        $this->title_name = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->province = '';
        $this->zipcode = '';
        $this->phone = '';
    }

    // ฟังชั่นลงชื่อเข้าใช้งาน
    public function loginCust() {
        if(isset($_POST['login'])) {
            $this->email = $_POST['email'];
            $this->pass = $this->pass_encrypt($_POST['password']);

            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT customer_id FROM customers WHERE customer_email = ? AND customer_password = ?");
            $stmt->bind_param("ss", $this->email, $this->pass);
            if($stmt->execute()) {
                $result = $stmt->get_result();
                if($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $_SESSION["cust_id"] = $row["customer_id"];
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ!',
                                text: 'เข้าสู่ระบบสำเร็จ',
                                confirmButtonText: 'ยืนยัน'
                            })
                          </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!',
                                html: 'คุณระบุชื่อบัญชีผู้ใช้หรือรหัสผ่านไม่ถูกต้อง โปรดลองใหม่อีกครั้ง',
                                confirmButtonText: 'ปิด',
                                confirmButtonColor: '#f27474'
                            })
                          </script>";
                }
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'ไม่สามารถเข้าสู่ระบบได้ โปรดลองใหม่อีกครั้ง',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
        }
    }

    // ฟังชั่นสมัครสมาชิก
    public function registerCust() {
        if(isset($_POST['register'])) {
            $this->email = $_POST['email'];
            $this->pass = $_POST['password'];
            $this->pass_cf = $_POST['password_cf'];
            $this->title_name = $_POST['title_name'];
            $this->first_name = $_POST['full_name'];
            $this->last_name = $_POST['full_name'];
            $this->province = $_POST['province'];
            $this->zipcode = $_POST['zipcode'];
            $this->phone = $_POST['phone'];
            
            if($this->checkEmail($this->email)) {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: '{$this->email}',
                            html: '<br />ตรวจพบอีเมลนี้ในระบบแล้ว โปรดลองใช้อีเมลอื่น',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            } else {
                if($this->checkPasswordCf($this->pass, $this->pass_cf)) {
                    $this->pass_cf = $this->pass_encrypt($this->pass_cf);
                    $conn = $this->connect();
                    $values = [$this->title_name, $this->first_name, $this->last_name, $this->email, $this->pass_cf, $this->phone, $this->province, $this->zipcode];
                    $stmt = $conn->prepare("INSERT INTO customers (customer_sex, customer_first_name, customer_last_name, customer_email, customer_password, customer_phone, customer_province, customer_zipcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssssssss", ...$values);
                    if($stmt->execute()) {
                        $this->setDefaultVal();
                        echo "<script>
                                Swal.fire({
                                    icon: 'success',
                                    title: 'สำเร็จ!',
                                    text: 'สมัครสมาชิกใหม่สำเร็จ',
                                    confirmButtonText: 'ยืนยัน'
                                })
                              </script>";
                    } else {
                        echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด!',
                                    html: 'ไม่สามารถสมัครสมาชิกได้ โปรดลองใหม่อีกครั้ง {$stmt->error}',
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
                                html: 'คุณยืนยันรหัสผ่านไม่ถูกต้อง โปรดลองใหม่อีกครั้ง',
                                confirmButtonText: 'ปิด',
                                confirmButtonColor: '#f27474'
                            })
                          </script>";
                }
            }
        }
    }

    // ฟังชั่นเรียกใช้ข้อมูลจากฐานข้อมูล Customers ทั้งหมด
    public function queryCustomers() {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM customers ORDER BY customer_id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getCustomerName($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT customer_first_name, customer_last_name FROM customers WHERE customer_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return "{$row['customer_first_name']} {$row['customer_last_name']}";
    }

    // ฟังชั่นแปลง key customer_sex เป็น title_name
    public function convertTitleName($key) {
        if($key == 1) { return 'นาย'; }
        if($key == 2) { return 'นาง'; }
        if($key == 3) { return 'นางสาว'; }
    }

    // ฟังชั่นเช็คการมีอยู่ของสมาชิก
    public function checkCustByID($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT customer_id FROM customers WHERE customer_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // ฟังชั่นเซ็ตค่าข้อมูลสมาชิกรายบุคคล
    public function setCustByID($id) {
        if($this->checkCustByID($id)) {
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT * FROM customers WHERE customer_id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $this->email = $row['customer_email'];
            $this->title_name = $row['customer_sex'];
            $this->first_name = $row['customer_first_name'];
            $this->last_name = $row['customer_last_name'];
            $this->province = $row['customer_province'];
            $this->zipcode = $row['customer_zipcode'];
            $this->phone = $row['customer_phone'];
        } else {
            echo '<script>window.location.assign("?page=customer_list")</script>';
            exit;
        }
    }

    //
    public function updateCust($cust_id) {
        if(isset($_POST['submit'])) {
            $this->title_name = $_POST['title_name'];
            $this->first_name = $_POST['first_name'];
            $this->last_name = $_POST['last_name'];
            $this->province = $_POST['province'];
            $this->zipcode = $_POST['zipcode'];
            $this->phone = $_POST['phone'];
            $conn = $this->connect();
            $stmt = $conn->prepare("UPDATE customers SET customer_sex = ?, customer_first_name = ?, customer_last_name = ?, customer_phone = ?, customer_province = ?, customer_zipcode = ? WHERE customer_id = ?");
            $stmt->bind_param("sssssss", $this->title_name, $this->first_name, $this->last_name, $this->phone, $this->province, $this->zipcode, $cust_id);
            if($stmt->execute()) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'แก้ไขสมาชิกใหม่สำเร็จ',
                            confirmButtonText: 'ยืนยัน'
                        })
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'ไม่สามารถเพิ่มสมาชิกได้ โปรดลองใหม่อีกครั้ง {$stmt->error}',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
            $stmt->close();
            $conn->close();
        }
    }

    public function utf8_strrev($str) {
        preg_match_all('/./us', $str, $ar);
        return join('', array_reverse($ar[0]));
    }

    public function pass_encrypt($str) {
        $key1 = '9$u#t!k';
        $key2 = 'k!t#u$1';
        $reverse_str = $this->utf8_strrev($str);
        $md5 = md5($reverse_str);
        $reverse_md5 = $this->utf8_strrev($md5);
        $salt = substr($reverse_md5, -13) . md5($key1) . substr($reverse_md5, 0, 19) . md5($key2);
        $new_md5 = md5($salt);
        $reverse = $this->utf8_strrev($new_md5);
        $final_pass = md5($reverse);
        return $final_pass;
    }

    // ฟังชั่นแก้ไขรหัสผ่านสมาชิก
    public function updatePassword($cust_id) {
        if(isset($_POST['submit'])) {
            $pass = $_POST['password'];
            $pass_cf = $_POST['password_cf'];
            if($this->checkPasswordCf($pass, $pass_cf)) {
                $conn = $this->connect();
                $stmt = $conn->prepare("UPDATE customers SET customer_password = ? WHERE customer_id = ?");
                $stmt->bind_param("ss", $pass_cf, $cust_id);
                $pass_cf = $this->pass_encrypt($pass_cf);
                if($stmt->execute()) {
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ!',
                                text: 'แก้ไขรหัสผ่านสมาชิกสำเร็จ',
                                confirmButtonText: 'ยืนยัน'
                            })
                          </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!',
                                text: 'ไม่สามารถแก้ไขรหัสผ่านสมาชิกได้ โปรดลองใหม่อีกครั้ง {$stmt->error}',
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
                            html: 'คุณใส่รหัสยืนยันไม่ถูกต้อง โปรดลองใหม่อีกครั้ง',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
        }
    }

    // ฟังชั่นแปลงวันเดือนปีเป็นภาษาไทย
    public function convertDate($date) {
        $date_new = date_create($date);
        $arrMonth = [null, 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
        $dayTH = date_format($date_new, "d");
        $monthTH = $arrMonth[date_format($date_new, "n")];
        $yearTH = date_format($date_new, "Y") + 543;
        return "{$dayTH} {$monthTH} {$yearTH} " . date_format($date_new, "เวลา H:i น.");
    }

    // ฟังชั่นแปลงตัวเลขเป็น ZEROFILL
    public function zerofill($variable, $zerofill){
        return str_pad($variable, $zerofill, '0', STR_PAD_LEFT); // 
    }

    // ฟังชั่นเช็คไอดีที่ลบว่ามีหรือไม่
    public function checkDelID($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM customers WHERE customer_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // ฟังชั่นลบสมาชิก
    public function deleteCust($id) {
        if($this->checkDelID($id)) {
            $conn = $this->connect();
            $stmt = $conn->prepare("DELETE FROM customers WHERE customer_id = ?");
            $stmt->bind_param('i', $id);
            if($stmt->execute()) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'ลบสมาชิกสำเร็จ',
                            confirmButtonText: 'ยืนยัน'
                        })
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'ไม่สามารถลบสมาชิกได้ โปรดลองใหม่อีกครั้ง {$stmt->error}',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
            $stmt->close();
            $conn->close();
        } else {
            echo '<script>window.location.assign("?page=customer_list")</script>';
            exit;
        }
    }

}

?>