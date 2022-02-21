<?php

require_once('Database.Class.php');

class OrderProduct extends Database {

    public $payment;
    public $name;
    public $phone;
    public $email;
    public $address;
    public $zipcode;
    public $province;
    public $cust_id;
    public $admin_id;

    public function createAddress() {
        if(isset($_POST["createAddress"])) {
            $this->payment = $_POST['payment'];
            $this->name = $_POST['name'];
            $this->phone = $_POST['phone'];
            $this->email = $_POST['email'];
            $this->address = $_POST['address'];
            $this->province = $_POST['province'];
            $this->zipcode = $_POST['zipcode'];

            $_SESSION["payment"] = $_POST['payment'];
            $_SESSION["name"] = $_POST['name'];
            $_SESSION["phone"] = $_POST['phone'];
            $_SESSION["email"] = $_POST['email'];
            $_SESSION["address"] = $_POST['address'];
            $_SESSION["province"] = $_POST['province'];
            $_SESSION["zipcode"] = $_POST['zipcode'];
            
            echo "<script>window.location.assign('/cart/confirm')</script>";
        }
    }

    public function getAddress() {
        if(isset($_SESSION["payment"])) {
            $this->payment = $_SESSION['payment'];
            $this->name = $_SESSION['name'];
            $this->phone = $_SESSION['phone'];
            $this->email = $_SESSION['email'];
            $this->address = $_SESSION['address'];
            $this->province = $_SESSION['province'];
            $this->zipcode = $_SESSION['zipcode'];
        }
    }

    // ฟังชั่นเช็คอีเมลซ้ำ
    public function checkID($id) {
        $sql = "SELECT customer_id FROM customers WHERE customer_id = '{$id}'";
        $result = $this->connect()->query($sql);

        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPriceByID($prodID) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT prod_price FROM products WHERE prod_id = ?");
        $stmt->bind_param("i", $prodID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['prod_price'];
    }

    // ฟังชั่นตรวจสอบสินค้าคงเหลือ
    public function checkProdAmt($prodID) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT prod_amount FROM products WHERE prod_id = ?");
        $stmt->bind_param('i', $prodID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["prod_amount"];
    }

    // ฟังชั่นเพิ่มรายการสั่งซื้อ (Order)
    public function addOrder() {
        if($this->checkID($_SESSION["cust_id"])) {
            $this->payment = $_SESSION["payment"];
            $this->name = $_SESSION["name"];
            $this->phone = $_SESSION["phone"];
            $this->email = $_SESSION["email"];
            $this->address = $_SESSION["address"];
            $this->province = $_SESSION["province"];
            $this->zipcode = $_SESSION["zipcode"];
            $this->cust_id = $_SESSION["cust_id"];
            $arr = $this->sumProdAmt();
            $statusAmt = TRUE;
            for($i = 0; $i < count($arr); $i++) {
                $id = $arr[$i]["prodID"];
                $amt = $arr[$i]["amt"];
                $db_amt = $this->checkProdAmt($arr[$i]["prodID"]);
                if($amt > $db_amt) { $statusAmt = FALSE; }
                // echo "ID : {$id} <br>จำนวนที่สั่ง : {$amt} <br>จำนวนคงเหลือ : {$db_amt} <br>สถานะ : {$status}<hr>";
            }
            $arr_admin_id = NULL;
            foreach($_SESSION["my_cart"] as $key => $val) {
                $obj = json_decode($val);
                if($arr_admin_id == NULL) { $arr_admin_id = [$obj->adminID]; }
                else {
                    if(!in_array($obj->adminID, $arr_admin_id)) {
                        array_push($arr_admin_id, $obj->adminID);
                    }
                }
            }

            /*foreach($arr_admin_id as $key => $val) {
                echo "ID : {$val} <br>";
                $conn = $this->connect();
                $stmt = $conn->prepare("INSERT INTO order_products (oprod_status, oprod_payment, oprod_name, oprod_phone, oprod_email, oprod_address, customer_id, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ississii", $status, $this->payment, $this->name, $this->phone, $this->email, $this->address, $this->cust_id, $admin_id);
                $status = 1;
                $this->cust_id = $_SESSION["cust_id"];
                $admin_id = $val;
                if($stmt->execute()) {
                    echo "สำเร็จ !! <br>";
                }
            }*/
            if($statusAmt) {
                $updateStatus = FALSE;
                foreach($arr_admin_id as $key => $val_admin) {
                    // echo "ID : {$val_admin} <br>";
                    $conn = $this->connect();
                    $stmt = $conn->prepare("INSERT INTO order_products (oprod_status, oprod_payment, oprod_name, oprod_phone, oprod_email, oprod_address, oprod_province, oprod_zipcode, customer_id, admin_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("ississsiii", $status, $this->payment, $this->name, $this->phone, $this->email, $this->address, $this->province, $this->zipcode, $this->cust_id, $admin_id);
                    $status = 1;
                    $this->cust_id = $_SESSION["cust_id"];
                    $admin_id = $val_admin;
                    if($stmt->execute()) {
                        /*foreach($_SESSION["my_cart"] as $key => $val_cart) {
                            $obj = json_decode($val_cart);*/
                            $stmt = $conn->prepare("SELECT oprod_id FROM order_products ORDER BY oprod_id DESC LIMIT 1");
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            
                            // $amount = $arr[$i]["amt"];
                            // $prod_id = $arr[$i]["prodID"];
                            $amount = 0;
                            $prod_id = 0;
                            $price = 0;
                            $type = 0;
                            $level = 0;
                            $weight = 0;
                            $oprod_id = $row['oprod_id'];
                            date_default_timezone_set("Asia/Bangkok");
                            $date_now = date("d/m/Y H:i น.");
                            $message = "\n***คำสั่งซื้อใหม่***\nหมายเลขคำสั่งซื้อ #INV{$this->zerofill($oprod_id, 7)}\nสั่งซื้อเมื่อ {$date_now}\n\n";
                            $num = 1;
                                // echo "ObjID : {$obj->adminID} // SessionID : {$val_admin}<br>";
                                $stmt_list = $conn->prepare("INSERT INTO order_product_list (prodlist_amount, prodlist_price, prodlist_type, prodlist_level, prodlist_weight, oprod_id, prod_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
                                $stmt_list->bind_param("iiiiiii", $amount, $price, $type, $level, $weight, $oprod_id, $prod_id);
        
                                $insertStatus = FALSE;
                                foreach($_SESSION["my_cart"] as $key => $val) {
                                    $obj = json_decode($val);
                                    $db_amt = $this->checkProdAmt($obj->prodID);
                                    $price = $this->getPriceByID($obj->prodID);
                                    $amount = $obj->amt;
                                    $type = $obj->type;
                                    $level = $obj->level;
                                    $weight = $obj->weight;
                                    $prod_id = $obj->prodID;
                                    $types = ['', 'บด', 'เมล็ด'];
                                    $levels = ['', 'คั่วอ่อน', 'คั่วกลาง', 'คั่วเข้ม'];
                                    // echo "จำนวนใน DB : {$db_amt}<br>";
                                    if($obj->adminID == $val_admin) {
                                        // echo "prodID : {$prod_id} <br>";
                                        // echo "ObjIDEND : {$obj->adminID} // SessionIDEND : {$val_admin}<br>";
                                        if($stmt_list->execute()) {
                                            $insertStatus = TRUE;
                                            $stmt_prod = $conn->prepare("SELECT prod_name FROM products WHERE prod_id = ? LIMIT 1");
                                            $stmt_prod->bind_param("i", $prod_id);
                                            $stmt_prod->execute();
                                            $result_prod = $stmt_prod->get_result();
                                            $row_prod = $result_prod->fetch_assoc();
                                            $prod_name = $row_prod['prod_name'];
                                            $total_price = $price * $amount;
                                            if($type == NULL || $level == NULL) {
                                                $message .= "{$num}.) {$prod_name} {$weight} กรัม จำนวน {$amount} ชิ้น 【 ราคารวม {$total_price} บาท 】\n";
                                            } else {
                                                $message .= "{$num}.) {$prod_name} {$weight} กรัม ({$types[$type]}, {$levels[$level]}) จำนวน {$amount} ชิ้น 【 ราคารวม {$total_price} บาท 】\n";
                                            }
                                            $num += 1;
                                        } else { $insertStatus = FALSE; }

                                        if($insertStatus) {
                                            $Newamount = ($db_amt - $obj->amt);
                                            $prod_id = $obj->prodID;
                                            // echo "จำนวนเดิม {$db_amt} // จำนวนที่ซื้อ {$obj->amt} // จำนวนใหม่ {$Newamount} // ID : {$obj->prodID}<br>";
                                            $stmt = $conn->prepare("UPDATE products SET prod_amount = ? WHERE prod_id = ?");
                                            $stmt->bind_param("ii", $Newamount, $prod_id);
                                            if($stmt->execute()) { $updateStatus = TRUE; } else { $updateStatus = FALSE; }
                                            /*for($i = 0; $i < count($arr); $i++) {
                                                $db_amt = $this->checkProdAmt($arr[$i]["prodID"]);
                                                $Newamount = ($db_amt - $arr[$i]["amt"]);
                                                $prod_id = $arr[$i]["prodID"];
                                                echo "จำนวนเดิม {$db_amt} // จำนวนที่ซื้อ {$arr[$i]["amt"]} // จำนวนใหม่ {$Newamount} // ID : {$arr[$i]["prodID"]}<br>";
                                                $stmt = $conn->prepare("UPDATE products SET prod_amount = ? WHERE prod_id = ?");
                                                $stmt->bind_param("ii", $Newamount, $prod_id);
                                                if($stmt->execute()) { $updateStatus = TRUE; } else { $updateStatus = FALSE; }
                                            }*/
                                        } else {
                                            printf("Error: %s.\n", $stmt->error);
                                            echo "<script>
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'เกิดข้อผิดพลาด!',
                                                        text: 'ไม่สามารถสั่งซื้อได้ โปรดลองใหม่อีกครั้ง [i list]',
                                                        confirmButtonText: 'ปิด',
                                                        confirmButtonColor: '#f27474'
                                                    })
                                                </script>";
                                        }
                                    }
                                }
                            /*}
                        }*/
                        $message .= "\nที่อยู่ในการจัดส่งสินค้า : {$this->name} {$this->email} {$this->address} {$this->province} {$this->zipcode} โทร. {$this->phone}";
                        $stmt = $conn->prepare("SELECT admin_token FROM admins WHERE admin_id = ? LIMIT 1");
                        $stmt->bind_param("i", $admin_id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $lineToken = $row['admin_token'];
                        if($lineToken != NULL) { $this->sendLineNotify($lineToken, $message); }
                    } else {
                        printf("Error: %s.\n", $stmt->error);
                        echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาด!',
                                    text: 'ไม่สามารถสั่งซื้อได้ โปรดลองใหม่อีกครั้ง',
                                    confirmButtonText: 'ปิด',
                                    confirmButtonColor: '#f27474'
                                })
                            </script>";
                    }
                } // ปิด loop
                if($updateStatus) {
                    unset($_SESSION["my_cart"]);
                    if(empty($_SESSION["my_cart"])) {
                        echo "<script>
                                setTimeout(() => {
                                    window.location.assign('/my_orders')
                                }, 2500);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'สำเร็จ!',
                                    text: 'สั่งซื้อสินค้าสำเร็จ ระบบกำลังพาคุณไปยังเมนูรายการสั่งซื้อเพื่อดำเนินการต่อ...',
                                    confirmButtonText: 'ยืนยัน',
                                    timerProgressBar: true,
                                    timer: 2500,
                                })
                            </script>";
                    }
                } else {
                    printf("Error: %s.\n", $stmt->error);
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!',
                                text: 'ไม่สามารถสั่งซื้อได้ โปรดลองใหม่อีกครั้ง [u amt]',
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
                            html: 'จำนวนสินค้าไม่เพียงพอ โปรดลองตรวจสอบจำนวนสินค้าที่สั่งซื้อใหม่อีกครั้ง',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
        } else {
            echo 'ไม่พบอีเมลของคุณ';
        }
    }

    // รวมยอดสินค้าแต่ละ ID
    public function sumProdAmt() {
        $arr = []; $status = TRUE;
        foreach($_SESSION["my_cart"] as $key => $val) {
            $obj = json_decode($val);
            if(count($arr) == 0) {
                array_push($arr, array("prodID" => $obj->prodID, "amt" => $obj->amt));
            } else {
                for($i = 0; $i < count($arr); $i++) {
                    $newI = $i;
                    if($i < count($arr)) { $newI++; }
                    if($arr[$i]["prodID"] == $obj->prodID) {
                        $status = FALSE;
                        $newAmt = ($arr[$i]["amt"] + $obj->amt);
                        $arr[$i] = array("prodID" => $obj->prodID, "amt" => $newAmt);
                    } else { $status = TRUE; }
                }

                if($status) {
                    array_push($arr, array("prodID" => $obj->prodID, "amt" => $obj->amt));
                }
            }
        }
        // print_r($arr);
        return $arr;
    }

    // ฟังชั่นแปลงตัวเลขเป็น ZEROFILL
    public function zerofill($variable, $zerofill){
        return str_pad($variable, $zerofill, '0', STR_PAD_LEFT); // 
    }

    // ฟังชั่นเรียกใช้ข้อมูล .. .. . . . .
    public function queryOrderProdByID($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM order_products WHERE oprod_id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    // ฟังชั่นเรียกใช้ข้อมูลรายการสินค้าจากฐานข้อมูล
    public function queryOrderProd() {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM order_products NATURAL JOIN admins WHERE customer_id = ? ORDER BY oprod_created DESC");
        $stmt->bind_param("i", $cust_id);
        $cust_id = $_SESSION['cust_id'];
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    // ฟังชั่นเรียกใช้ข้อมูลรายการสินค้าด้วยรหัสสินค้าจากฐานข้อมูล
    public function queryOrderProdListByID($id) {
        $conn = $this->connect();
        // $stmt = $conn->prepare("SELECT * FROM order_products NATURAL JOIN order_product_list NATURAL JOIN products WHERE oprod_id = ?");
        $stmt = $conn->prepare("SELECT * FROM order_products NATURAL JOIN order_product_list LEFT JOIN products ON order_product_list.prod_id = products.prod_id WHERE oprod_id = ?;");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function queryOrderProdList($oprod_id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM order_product_list NATURAL JOIN products WHERE oprod_id = ?");
        $stmt->bind_param("i", $oprod_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    // ฟังชั่นแปลงชนิดการกาแฟ
    public function convertType($type) {
        $arr = ['', 'บด', 'เมล็ด'];
        return $arr[$type];
    }

    // ฟังชั่นแปลงระดับการคั่ว
    public function convertLevel($level) {
        $arr = ['', 'อ่อน', 'กลาง', 'เข้ม'];
        return $arr[$level];
    }
    
    public function convertStatus($status) {
        $arr = [
            '<span class="fa fa-times mr-1"></span> ยกเลิก',
            '<span class="fa fa-spinner mr-1"></span> รอตรวจสอบการชำระเงิน',
            '<span class="fa fa-check mr-1"></span> ชำระเงินแล้ว',
            '<span class="fa fa-check mr-1"></span> จัดส่งแล้ว'
        ];
        $arrColor = ['danger', 'premium', 'info', 'success'];
        return "<b class=\"badge badge-{$arrColor[$status]} py-2 px-3 br-30\">{$arr[$status]}</b>";
    }

    public function sumWeightOrderByID($oprod_id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT SUM((prodlist_weight * prodlist_amount)) AS sum_weight FROM order_product_list WHERE oprod_id = ?");
        $stmt->bind_param("i", $oprod_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["sum_weight"];
    }

    public function sumPriceOrderByID($oprod_id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT SUM((prodlist_price * prodlist_amount)) AS sum_price FROM order_product_list WHERE oprod_id = ?");
        $stmt->bind_param("i", $oprod_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["sum_price"];
    }

    public function countOrderByID($oprod_id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT COUNT(*) AS counts FROM order_product_list WHERE oprod_id = ?");
        $stmt->bind_param("i", $oprod_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row["counts"];
    }

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
        return "$strDaysThai $strDay $strMonthThai $strYear เวลา $strHour:$strMinute น.";
    }

    
    public function getToken($url, $token, array $params) {
        $query_content = http_build_query($params);
        $fp = fopen($url, 'r', FALSE, // do not use_include_path
        stream_context_create([
        'http' => [
            'header'  => [ // header array does not need '\r\n'
            "Authorization: Token {$token}",
            'Content-Type: application/json'
            ],
            'method'  => 'POST',
            'content' => $query_content
        ]
        ]));
        if ($fp === FALSE) {
        return json_encode(['error' => 'Failed to get contents...']);
        }
        $result = stream_get_contents($fp); // no maxlength/offset
        fclose($fp);
        $jsonGetToken = json_decode($result, TRUE);
        $token = $jsonGetToken["token"];
        return $token;
    }

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

    public function getItemsbyBarcodeฺ($url, $token, array $params) {
        $ch = curl_init();
        $headers = [
            "Authorization: Token {$token}",
            'Content-Type: application/json'
        ];
        $postData = $params;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));           
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result     = curl_exec ($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return $result;
    }

    // คำนวณค่าส่งสินค้า
    public function calculateShippingCost($n) {
        $thb = 0;
        if($n <= 20) {
            $thb = 32;
        } else if($n <= 100) {
            $thb = 37;
        } else if($n <= 250) {
            $thb = 42;
        } else if($n <= 500) {
            $thb = 52;
        } else if($n <= 1000) {
            $thb = 67;
        } else if($n <= 1500) {
            $thb = 82;
        } else if($n <= 2000) {
            $thb = 97;
        } else if($n <= 2500) {
            $thb = 100;
        } else if($n <= 3000) {
            $thb = 105;
        } else if($n <= 3500) {
            $thb = 110;
        } else if($n <= 4000) {
            $thb = 120;
        } else if($n <= 4500) {
            $thb = 130;
        } else if($n <= 5000) {
            $thb = 140;
        } else if($n <= 5500) {
            $thb = 150;
        } else if($n <= 6000) {
            $thb = 160;
        } else if($n <= 6500) {
            $thb = 170;
        } else if($n <= 7000) {
            $thb = 180;
        } else if($n <= 7500) {
            $thb = 190;
        } else if($n <= 8000) {
            $thb = 200;
        } else if($n <= 8500) {
            $thb = 215;
        } else if($n <= 9000) {
            $thb = 230;
        } else if($n <= 9500) {
            $thb = 245;
        } else if($n <= 10000) {
            $thb = 260;
        } else if($n <= 11000) {
            $thb = 300;
        } else if($n <= 12000) {
            $thb = 320;
        } else if($n <= 13000) {
            $thb = 340;
        } else if($n <= 14000) {
            $thb = 360;
        } else if($n <= 15000) {
            $thb = 380;
        } else if($n <= 16000) {
            $thb = 395;
        } else if($n <= 17000) {
            $thb = 410;
        } else if($n <= 18000) {
            $thb = 425;
        } else if($n <= 19000) {
            $thb = 435;
        } else if($n <= 20000) {
            $thb = 445;
        }
        return $thb;
    }

}

?>