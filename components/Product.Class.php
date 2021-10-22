<?php

require_once('Database.Class.php');

class Product extends Database {

    public $arrType = array('product' => 3, 'food' => 1, 'coffee' => 2); // ตั้งค่า Type ID

    public $id;
    public $name;
    public $type;
    public $view;
    public $status;
    public $price;
    public $amount;
    public $detail;
    public $status_hot;
    public $status_cool;
    public $status_smoothie;
    public $price_hot;
    public $price_cool;
    public $price_smoothie;
    public $start_reduce;
    public $quantity;
    public $unit;
    public $img;
    public $default_img = "https://simg.nicepng.com/png/small/304-3048415_business-advice-product-icon-png.png";
    public $admin_id;

    // ฟังชั่นแปลงไฟล์ภาพเป็น binary
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

    // ฟังชั่นเช็ครูปภาพสินค้า อาหาร เครื่องดื่ม
    public function getImage($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT prod_img FROM products WHERE prod_id = ? LIMIT 1");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if($row['prod_img'] == '' || $row['prod_img'] == NULL || $row['prod_img'] == 'null' || $row['prod_img'] == 'NULL') {
                return $this->default_img;
            } else {
                return "img_view/prod/{$id}/0.3";
            }
        } else {
            return $this->default_img;
        }
    }

    // ฟังชั่นรีเซ็ตค่าทั้งหมด
    public function setDefaultVal() {
        $this->name = '';
        $this->type = '';
        $this->view = '';
        $this->status = '';
        $this->price = '';
        $this->amount = '';
        $this->detail = '';
        $this->img = '';
    }

    // ฟังชั่นเพิ่มสินค้า
    public function insertProduct() {
        if(isset($_POST['submit'])) {
            $this->type = $this->arrType['product'];
            $this->name = $_POST['name'];
            $this->price = $_POST['price'];
            $this->amount = $_POST['amount'];
            $this->detail = $_POST['detail'];

            $conn = $this->connect();
            if(!empty($_FILES["file"]["name"])) {
                $this->img = $this->toBinary($_FILES["file"]);
                $stmt = $conn->prepare("INSERT INTO products (prod_type, prod_name, prod_price, prod_amount, prod_detail, prod_img) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssss", $this->type, $this->name, $this->price, $this->amount, $this->detail, $this->img);
            } else {
                $stmt = $conn->prepare("INSERT INTO products (prod_type, prod_name, prod_price, prod_amount, prod_detail, prod_promo_start_reduce, prod_promo_quantity, prod_promo_unit) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("issss", $this->type, $this->name, $this->price, $this->amount, $this->detail);
            }

            if($stmt->execute()) {
                $this->setDefaultVal();
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'เพิ่มสินค้าใหม่สำเร็จ',
                            confirmButtonText: 'ยืนยัน'
                        })
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'ไม่สามารถเพิ่มสินค้าใหม่ได้ โปรดลองใหม่อีกครั้ง {$stmt->error}',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
            $stmt->close();
            $conn->close();
        }
    }

    // ฟังชั่นเพิ่มอาหาร
    public function insertFood() {
        if(isset($_POST['submit'])) {
            $this->type = $this->arrType['food'];
            $this->name = $_POST['name'];
            $this->status = $_POST['status'];
            $this->price = $_POST['price'];

            $conn = $this->connect();
            if(!empty($_FILES["file"]["name"])) {
                $this->img = $this->toBinary($_FILES["file"]);
                $stmt = $conn->prepare("INSERT INTO products (prod_type, prod_name, prod_status, prod_price, prod_img) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("isiis", $this->type, $this->name, $this->status, $this->price, $this->img);
            } else {
                $stmt = $conn->prepare("INSERT INTO products (prod_type, prod_name, prod_status, prod_price) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("isii", $this->type, $this->name, $this->status, $this->price);
            }

            if($stmt->execute()) {
                $this->setDefaultVal();
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'เพิ่มอาหารใหม่สำเร็จ',
                            confirmButtonText: 'ยืนยัน'
                        })
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'ไม่สามารถเพิ่มอาหารใหม่ได้ โปรดลองใหม่อีกครั้ง {$stmt->error}',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
            $stmt->close();
            $conn->close();
        }
    }

    // ฟังชั่นเพิ่มเครื่องดื่ม
    public function insertCoffee() {
        if(isset($_POST['submit'])) {
            $this->type = $this->arrType['coffee'];
            $this->name = $_POST['name'];
            $this->status = $_POST['status'];
            $this->status_hot = $_POST['status_hot'];
            $this->status_cool = $_POST['status_cool'];
            $this->status_smoothie = $_POST['status_smoothie'];
            if($this->status_hot == 1) { $this->price_hot = $_POST['price_hot']; }
            if($this->status_cool == 1) { $this->price_cool = $_POST['price_cool']; }
            if($this->status_smoothie == 1) { $this->price_smoothie = $_POST['price_smoothie']; }
            if(!empty($_FILES["file"]["name"])) { $this->img = $this->toBinary($_FILES["file"]); }
            $this->start_reduce = $_POST['start_reduce'];
            $this->quantity = $_POST['quantity'];
            $this->unit = $_POST['unit'];

            $sql = "";
            $conn = $this->connect();
            if($this->status_hot == 1 || $this->status_cool == 1 || $this->status_smoothie == 1) {
                if(!empty($_FILES["file"]["name"])) {
                    $sql = "INSERT INTO products (prod_type, prod_name, prod_status, prod_hot_status, prod_hot_price, prod_cool_status, prod_cool_price, prod_smoothie_status, prod_smoothie_price, prod_promo_start_reduce, prod_promo_quantity, prod_promo_unit, prod_img) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("isiiiiiiiiiis", $this->type, $this->name, $this->status, $this->status_hot, $this->price_hot, $this->status_cool, $this->price_cool, $this->status_smoothie, $this->price_smoothie, $this->start_reduce, $this->quantity, $this->unit, $this->img);
                } else {
                    $sql = "INSERT INTO products (prod_type, prod_name, prod_status, prod_hot_status, prod_hot_price, prod_cool_status, prod_cool_price, prod_smoothie_status, prod_smoothie_price, prod_promo_start_reduce, prod_promo_quantity, prod_promo_unit) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("isiiiiiiiiii", $this->type, $this->name, $this->status, $this->status_hot, $this->price_hot, $this->status_cool, $this->price_cool, $this->status_smoothie, $this->price_smoothie, $this->start_reduce, $this->quantity, $this->unit);
                }

                if($stmt->execute()) {
                    $this->setDefaultVal();
                    echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'สำเร็จ!',
                                text: 'เพิ่มเครื่องดื่มใหม่สำเร็จ',
                                confirmButtonText: 'ยืนยัน'
                            })
                          </script>";
                } else {
                    echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด!',
                                html: 'ไม่สามารถเพิ่มเครื่องดื่มใหม่ได้ โปรดลองใหม่อีกครั้ง {$stmt->error}',
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
                            html: 'โปรดเปิดการจำหน่ายเครื่องดื่มอย่างน้อย 1 ประเภท <br/> (ร้อน, เย็น, ปั่น)',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
        }
    }

    // ฟังชั่นเรียกใช้ข้อมูลจากฐานข้อมูล Products ทั้งหมด
    public function queryProducts() {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM products WHERE prod_type = 3 AND admin_id = 1 ORDER BY prod_id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    // ฟังชั่นเรียกใช้ข้อมูลจากฐานข้อมูล Partner Products ทั้งหมด
    public function queryPartnerProducts() {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM products WHERE prod_type = 3 AND prod_status = 1 ORDER BY prod_id DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    // ฟังชั่นเช็คการมีอยู่ของสินค้า อาหาร และเครื่องดื่ม ด้วย ID
    public function checkProdByID($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT prod_id FROM products WHERE prod_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // ฟังชั่นเซ็ตค่าข้อมูลสินค้าด้วย ID
    public function setProductByID($id) {
        if($this->checkProdByID($id)) {
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT * FROM products WHERE prod_id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $this->id = $id;
            $this->name = $row['prod_name'];
            $this->price = $row['prod_price'];
            $this->amount = $row['prod_amount'];
            $this->weight = $row['prod_weight'];
            $this->detail = $row['prod_detail'];
            $this->view = $row['prod_view'];
            $this->status = $row['prod_status'];
            $this->admin_id = $row['admin_id'];
        } else {
            echo '<script>window.location.assign("/robusta")</script>';
            exit;
        }
    }

    // ฟังชั่นเพิ่มยอดวิวสินค้าด้วย ID
    public function updateViewByID($prod_id) {
        if(!isset($_COOKIE['view'])) {
            setcookie("view", '1', time() + (60 * 5));
            $viewNew = $this->view + 1;
            $conn = $this->connect();
            $sql = "UPDATE products SET prod_view = ? WHERE prod_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $viewNew, $this->id);
            $stmt->execute();
            $this->view = $viewNew;
        } else {
            // echo "<div class=\"text-white\">{$this->view}</div>";
        }
    }

    // คำนวณราคาใหม่
    public function calculatePrice() {
        foreach($_SESSION["my_cart"] as $key => $val) {
            $obj = json_decode($val);
            // echo 'ID : ' . $obj->prodID . '<br>';
            // echo 'จำนวน : ' . $obj->amt . '<br>';
            // echo $_SESSION["my_cart"][$key] . ' <br>';
            // echo $_POST["prod_{$obj->prodID}"] . ' <br>';
            $arrData = array(
                'prodID' => $obj->prodID,
                'amt' => $_POST["prod_$key"],
                'type' => $_POST["type_$key"],
                'level' => $_POST["level_$key"],
                'weight' => $_POST["weight_$key"],
                'adminID' => $obj->adminID
            );
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT * FROM products WHERE prod_id = ?");
            $stmt->bind_param('i', $obj->prodID);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if($_POST["prod_$key"] <= $row['prod_amount']) {
                $_SESSION["my_cart"][$key] = json_encode($arrData);
            } else {
                echo "<script>Swal.fire({
                    'icon': 'warning',
                    'title' : 'แจ้งเตือน!',
                    'text' : 'มีรายการสินค้าบางรายการไม่เพียงพอ โปรดตรวจสอบและลองใหม่อีกครั้ง'
                 })
                 </script>";
            }
        }
    }

    // เพิ่มสินค้าในตะกร้าสินค้า
    public function addProdToCart($prodID) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM products WHERE prod_id = ?");
        $stmt->bind_param('i', $prodID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if(!isset($_SESSION["my_cart"])) {
            if($_POST['amt'] <= $row['prod_amount']) {
                $arrData = array(
                    'prodID' => $prodID,
                    'amt' => $_POST['amt'],
                    'type' => $_POST['type'],
                    'level' => $_POST['level'],
                    'weight' => $row['prod_weight'],
                    'adminID' => $row['admin_id']
                );
                $_SESSION["my_cart"] = [json_encode($arrData)];
            } else {
                echo "<script>Swal.fire({
                    'icon': 'error',
                    'title' : 'เกิดข้อผิดพลาด',
                    'text' : 'สินค้าไม่เพียงพอ โปรดตรวจสอบอีกครั้ง xxx'
                 })
                 </script>";
            }
        } else {
            $statusProd = TRUE; $amtNow = 0;
            $statusType = TRUE;
            $statusLevel = TRUE;
            $arrData = array(
                'prodID' => $prodID,
                'amt' => $_POST['amt'],
                'type' => $_POST['type'],
                'level' => $_POST['level'],
                'weight' => $row['prod_weight'],
                'adminID' => $row['admin_id']
            );
            foreach($_SESSION["my_cart"] as $key => $val) {
                $obj = json_decode($val);
                $amtNow = 0;
                // echo "ใหม่ ($prodID) == เก่า ($obj->prodID)" . ($prodID == $obj->prodID) . "<br/>";
                if($prodID == $obj->prodID && $_POST['type'] == $obj->type && $_POST['level'] == $obj->level) {
                    $statusProd = FALSE;
                    if(($_POST['amt'] + $obj->amt) > $row['prod_amount']) {
                        echo "<script>Swal.fire({
                           'icon': 'error',
                           'title' : 'เกิดข้อผิดพลาด',
                           'text' : 'สินค้าไม่เพียงพอ โปรดตรวจสอบอีกครั้ง yyy'
                        })
                        </script>";
                    } else {
                        $amtNow = $_POST['amt'] + $obj->amt;
                        $arrData['amt'] = "{$amtNow}";
                        $_SESSION["my_cart"][$key] = json_encode($arrData);
                    }
                }
            }


            if($statusProd) {
                if($amtNow <= $row['prod_amount']) {
                    array_push($_SESSION["my_cart"], json_encode($arrData));
                    // echo 'เพิ่มสินค้า';
                } else {
                    echo "<script>Swal.fire({
                       'icon': 'error',
                       'title' : 'เกิดข้อผิดพลาด',
                       'text' : 'สินค้าไม่เพียงพอ โปรดตรวจสอบอีกครั้ง zzz'
                    })
                    </script>";
                }
            }

        }
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

    // แปลงชนิดกาแฟ
    public function convertType($key) {
        $arr = ['', 'บด', 'เมล็ด'];
        return $arr[$key];
    }

    // แปลงระดับการคั่วกาแฟ
    public function convertLevel($key) {
        $arr = ['', 'คั่วอ่อน', 'คั่วกลาง', 'คั่วเข้ม'];
        return $arr[$key];
    }

    // Get Data Cart
    public function getDataCart($prodID, $str) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM products WHERE prod_id = ?");
        $stmt->bind_param('i', $prodID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row[$str];
    }

    // Get Data Store Name
    public function getStoreNameByID($adminID) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT admin_name FROM admins WHERE admin_id = ?");
        $stmt->bind_param('i', $adminID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['admin_name'];
    }

    // ฟังชั่นแก้ไขสินค้า
    public function updateProduct($prod_id) {
        if(isset($_POST['submit'])) {
            $sql_img = "";
            $this->name = $_POST['name'];
            $this->price = $_POST['price'];
            $this->amount = $_POST['amount'];
            $this->detail = $_POST['detail'];

            $conn = $this->connect();
            if(!empty($_FILES["file"]["name"])) {
                $this->img = $this->toBinary($_FILES["file"]);
                $sql = "UPDATE products SET prod_name = ?, prod_price = ?, prod_amount = ?, prod_detail = ?, prod_img = ? WHERE prod_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("siissi", $this->name, $this->price, $this->amount, $this->detail, $this->img, $this->id);
            } else {
                $sql = "UPDATE products SET prod_name = ?, prod_price = ?, prod_amount = ?, prod_detail = ? WHERE prod_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("siisi", $this->name, $this->price, $this->amount, $this->detail, $this->id);
            }

            if($stmt->execute()) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'แก้ไขสินค้าสำเร็จ',
                            confirmButtonText: 'ยืนยัน'
                        })
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'ไม่สามารถแก้ไขสินค้าได้ โปรดลองใหม่อีกครั้ง ({$stmt->error})',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
            $stmt->close();
            $conn->close();
        }
    }

    // ฟังชั่นเซ็ตค่าข้อมูลอาหารด้วย ID
    public function setFoodByID($id) {
        if($this->checkProdByID($id)) {
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT * FROM products WHERE prod_id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $this->id = $_GET['id'];
            $this->name = $row['prod_name'];
            $this->status = $row['prod_status'];
            $this->price = $row['prod_price'];
        } else {
            echo '<script>window.location.assign("?page=customer_list")</script>';
            exit;
        }
    }

    // ฟังชั่นแก้ไขอาหาร
    public function updateFood($prod_id) {
        if(isset($_POST['submit'])) {
            $sql_img = "";
            $this->name = $_POST['name'];
            $this->price = $_POST['price'];
            $this->status = $_POST['status'];
            
            $conn = $this->connect();
            if(!empty($_FILES["file"]["name"])) {
                $this->img = $this->toBinary($_FILES["file"]);
                $sql = "UPDATE products SET prod_name = ?, prod_price = ?, prod_status = ?, prod_img = ? WHERE prod_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("siisi", $this->name, $this->price, $this->status, $this->img, $this->id);
            } else {
                $sql = "UPDATE products SET prod_name = ?, prod_price = ?, prod_status = ? WHERE prod_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("siii", $this->name, $this->price, $this->status, $this->id);
            }
            if($stmt->execute()) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'แก้ไขอาหารสำเร็จ',
                            confirmButtonText: 'ยืนยัน'
                        })
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'ไม่สามารถแก้ไขอาหารได้ โปรดลองใหม่อีกครั้ง ({$stmt->error})',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
            $stmt->close();
            $conn->close();
        }
    }

    // ฟังชั่นเซ็ตค่าข้อมูลเครื่องดื่มด้วย ID
    public function setCoffeeByID($id) {
        if($this->checkProdByID($id)) {
            $conn = $this->connect();
            $stmt = $conn->prepare("SELECT * FROM products WHERE prod_id = ?");
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $this->id = $_GET['id'];
            $this->name = $row['prod_name'];
            $this->status = $row['prod_status'];
            $this->status_hot = $row['prod_hot_status'];
            $this->status_cool = $row['prod_cool_status'];
            $this->status_smoothie = $row['prod_smoothie_status'];
            if($this->status_hot == 1) { $this->price_hot = $row['prod_hot_price']; }
            if($this->status_cool == 1) { $this->price_cool = $row['prod_cool_price']; }
            if($this->status_smoothie == 1) { $this->price_smoothie = $row['prod_smoothie_price']; }
        } else {
            echo '<script>window.location.assign("?page=customer_list")</script>';
            exit;
        }
    }

    // ฟังชั่นแก้ไขเครื่องดื่ม
    public function updateCoffee($prod_id) {
        if(isset($_POST['submit'])) {
            $sql_img = "";
            $this->name = $_POST['name'];
            $this->status = $_POST['status'];
            $this->status_hot = $_POST['status_hot'];
            $this->status_cool = $_POST['status_cool'];
            $this->status_smoothie = $_POST['status_smoothie'];
            if($this->status_hot == 1) { $this->price_hot = $_POST['price_hot']; }
            if($this->status_cool == 1) { $this->price_cool = $_POST['price_cool']; }
            if($this->status_smoothie == 1) { $this->price_smoothie = $_POST['price_smoothie']; }

            $conn = $this->connect();
            if(!empty($_FILES["file"]["name"])) {
                $this->img = $this->toBinary($_FILES["file"]);
                $sql = "UPDATE products SET prod_name = ?, prod_status = ?, prod_hot_status = ?, prod_hot_price = ?, prod_cool_status = ?, prod_cool_price = ?, prod_smoothie_status = ?, prod_smoothie_price = ?, prod_img = ? WHERE prod_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("siiiiiiisi", $this->name, $this->status, $this->status_hot, $this->price_hot, $this->status_cool, $this->price_cool, $this->status_smoothie, $this->price_smoothie, $this->img, $this->id);
            } else {
                $sql = "UPDATE products SET prod_name = ?, prod_status = ?, prod_hot_status = ?, prod_hot_price = ?, prod_cool_status = ?, prod_cool_price = ?, prod_smoothie_status = ?, prod_smoothie_price = ? WHERE prod_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("siiiiiiii", $this->name, $this->status, $this->status_hot, $this->price_hot, $this->status_cool, $this->price_cool, $this->status_smoothie, $this->price_smoothie, $this->id);
            }
            if($stmt->execute()) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'แก้ไขเครื่องดื่มสำเร็จ',
                            confirmButtonText: 'ยืนยัน'
                        })
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'ไม่สามารถแก้ไขเครื่องดื่มได้ โปรดลองใหม่อีกครั้ง ({$stmt->error})',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
            $stmt->close();
            $conn->close();
        }
    }
    
    // ฟังชั่นแปลงสถานะการวางจำหน่าย
    public function convertStatus($key, $amt) {
        if($key === NULL) {
            if($amt > 0) {
                return '<b class="text-success">วางจำหน่าย</b>';
            } else {
                return '<b class="text-danger">สินค้าหมด</b>';
            }
        } else {
            $data = [
                '<b class="text-warning">งดจำหนาย</b>',
                '<b class="text-success">วางจำหน่าย</b>'
            ];
            return $data[$key];
        }
    }

    // ฟังชั่น
    public function checkAmount($val) {
        if($val === NULL) {
            return '-';
        } else {
            return number_format($val);
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

    // ฟังชั่นเช็ค disabled input
    public function disabled($val) {
        if(empty($val) || $val == '0') {
            return 'disabled';
        } else {
            return '';
        }
    }

    // ฟังชั่นเก็ทลิงค์แสดงสินค้า
    public function getLinkView($id, $type) {
        $data = array(
            1 => "?page=prod_view1&id={$id}",
            2 => "?page=prod_view2&id={$id}",
            3 => "?page=prod_view&id={$id}"
        );
        return $data[$type];
    }

    // ฟังชั่น
    public function getProdCount($key = 'all') {
        $conn = $this->connect();
        // ทั้งหมด
        $stmt = $conn->prepare("SELECT COUNT(*) AS count_all FROM products");
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        // อาหาร
        $stmt_food = $conn->prepare("SELECT COUNT(*) AS count_food FROM products WHERE prod_type = ?");
        $stmt_food->bind_param("i", $prod_type);
        $prod_type = 1;
        $stmt_food->execute();
        $result_food = $stmt_food->get_result();
        $row_food = $result_food->fetch_assoc();
        // เครื่องดื่ม
        $stmt_coffee = $conn->prepare("SELECT COUNT(*) AS count_coffee FROM products WHERE prod_type = ?");
        $stmt_coffee->bind_param("i", $prod_type);
        $prod_type = 2;
        $stmt_coffee->execute();
        $result_coffee = $stmt_coffee->get_result();
        $row_coffee = $result_coffee->fetch_assoc();
        // สินค้า
        $stmt_product = $conn->prepare("SELECT COUNT(*) AS count_product FROM products WHERE prod_type = ?");
        $stmt_product->bind_param("i", $prod_type);
        $prod_type = 3;
        $stmt_product->execute();
        $result_product = $stmt_product->get_result();
        $row_product = $result_product->fetch_assoc();

        $data = array(
            'all' => $row['count_all'],
            'product' => $row_product['count_product'],
            'food' => $row_food['count_food'],
            'coffee' => $row_coffee['count_coffee'],
        );
        return $data[$key];
    }

    // ฟังชั่น
    public function getPrice($p, $h, $c, $s) {
        if($h == NULL) { $h = 'ไม่จำหน่าย'; } else { $h = number_format($h, 2); }
        if($c == NULL) { $c = 'ไม่จำหน่าย'; } else { $c = number_format($c, 2); }
        if($s == NULL) { $s = 'ไม่จำหน่าย'; } else { $s = number_format($s, 2); }
        if($p == NULL) {
            return "<span><b>ร้อน</b> : {$h}</span><br>
                    <span><b>เย็น</b> : {$c}</span><br>
                    <span><b>ปั่น</b> : {$s}</span>";
        } else {
            return number_format($p, 2);
        }
    }

    // ฟังชั่นเช็คไอดีที่ลบว่ามีหรือไม่
    public function checkDelID($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM products WHERE prod_id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    // ฟังชั่นลบสินค้า อาหาร เครื่องดื่ม
    public function deleteProd($id) {
        if($this->checkDelID($id)) {
            $conn = $this->connect();
            $stmt = $conn->prepare("DELETE FROM products WHERE prod_id = ?");
            $stmt->bind_param('i', $id);
            if($stmt->execute()) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ!',
                            text: 'ลบสินค้าสำเร็จ',
                            confirmButtonText: 'ยืนยัน'
                        })
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'เกิดข้อผิดพลาด!',
                            html: 'ไม่สามารถลบสินค้าได้ โปรดลองใหม่อีกครั้ง {$stmt->error}',
                            confirmButtonText: 'ปิด',
                            confirmButtonColor: '#f27474'
                        })
                      </script>";
            }
            $stmt->close();
            $conn->close();
        } else {
            echo '<script>window.location.assign("?page=product_list")</script>';
            exit;
        }
    }
}

?>