<?php
    if(!isset($_SESSION["cust_id"])) { header('Location: /login'); }
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/Product.Class.php');
    require_once('components/OrderProduct.Class.php');
    require_once("libs/PromptPay/PromptPayQR.php");

    $headObj = new HeadHTML();
    $prodObj = new Product();
    $oprodObj = new OrderProduct();
    $PromptPayQR = new PromptPayQR(); // new object
    $PromptPayQR->size = 10; // Set QR code size to 8
    $PromptPayQR->id = '1341100230128'; // PromptPay ID
    $PromptPayQR->amount = 0; // Set amount (not necessary)

?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">
<?php
    if(isset($_POST['submit'])) {
        $oprodObj->addOrder();
    }
?>
<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<div style="background-color: #F5F5F5; padding-top: 110px; min-height: 100vh">
    <div class="container mt-3 pb-5">
    <?php
        if(isset($_SESSION['my_cart']) && count($_SESSION['my_cart']) > 0) {
    ?>
            <div class="row">
                <div class="col-lg-8">
                    <?php
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
                        foreach($arr_admin_id as $key => $val) {
                            // $show = ""; if($key == 0) { $show = "show"; }
                    ?>
                        <div class="card border-0 shadow-sm br-20 mb-4">
                            <div class="card-body">
                                <h3 class="mb-0">
                                    <b class="text-premium"><span class="fa fa-store"></span> <?php echo $prodObj->getStoreNameByID($val); ?></b>
                                </h3>
                                <hr>
                                <table class="table table-responsive table-hover br-20">
                                    <thead class="thead-dark br-20">
                                        <tr>
                                            <th width="5%" class="text-center">ลำดับ</th>
                                            <th width="15%" class="text-center">ภาพสินค้า</th>
                                            <th width="30%">ชื่อสินค้า</th>
                                            <th width="10%" class="text-center">จำนวน</th>
                                            <th width="15%" class="text-center">ราคารวม</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $prices = 0; $weight = 0;
                                        foreach($_SESSION["my_cart"] as $key => $val_cart) {
                                            $obj = json_decode($val_cart);
                                            // echo "ADMIN ID : {$obj->adminID} == VALUE : {$val} <br>";
                                            if($obj->adminID == $val) {
                                                $prices += ($prodObj->getDataCart($obj->prodID, 'prod_price') * $obj->amt);
                                                $weight += ($prodObj->getDataCart($obj->prodID, 'prod_weight') * $obj->amt);
                                    ?>
                                                <tr>
                                                    <th class="text-center"><?php echo ($key + 1); ?></th>
                                                    <td>
                                                        <div class="cart-img">
                                                            <img src="/img_view/prod/<?php echo $obj->prodID; ?>/0.2" width="100%">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <b class="text-premium"><?php echo $prodObj->getDataCart($obj->prodID, 'prod_name') . " (" . $prodObj->getDataCart($obj->prodID, 'prod_weight') . " กรัม)"; ?></b>
                                                        <?php
                                                            if($obj->adminID == 1) {
                                                        ?>
                                                            <small class="form-text text-muted"><b>ราคา : <?php echo number_format($prodObj->getDataCart($obj->prodID, 'prod_price'), 2); ?> / ชิ้น</b></small>
                                                                <small class="form-text text-muted"><b>ชนิด : <?php echo $prodObj->convertType($obj->type); ?></b></small>
                                                                <small class="form-text text-muted"><b>ระดับการคั่ว : <?php echo $prodObj->convertLevel($obj->level); ?></b></small>
                                                        <?php
                                                            }
                                                        ?>
                                                        <!-- <small class="form-text text-muted"><b>ขนาด : <?php echo $obj->weight; ?></b></small> -->
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $obj->amt; ?>
                                                    </td>
                                                    <td class="text-center"><?php echo number_format(($prodObj->getDataCart($obj->prodID, 'prod_price') * $obj->amt), 2); ?></td>
                                                </tr>
                                    <?php
                                            }
                                        }
                                        $shipping_cost = $prodObj->calculateShippingCost($weight);
                                        $total_price = $prices + $shipping_cost;
                                        $PromptPayQR->amount += $total_price;
                                    ?>
                                    </tbody>
                                </table>
                                <hr />
                                <div class="row mt-4">
                                    <div class="col-md-7 col-0"></div>
                                    <div class="col-md-5 col-12">
                                        <div class="text-right"><h6>น้ำหนักรวม <b><?php echo (number_format(($weight / 1000), 2));?></b> กิโลกรัม</h6></div>
                                        <div class="text-right"><h6>ราคาสินค้ารวม <b><?php echo number_format($prices, 2);?></b> บาท</h6></div>
                                        <div class="text-right"><h6>ค่าจัดส่งสินค้า <b><?php echo number_format($shipping_cost, 2);?></b> บาท</h6></div>
                                        <div class="text-right"><h5>ราคาสุทธิ <b class="text-premium"><?php echo number_format($total_price , 2); ?></b> บาท</h5></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
                <div class="col-lg-4 mt-4">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="text-center text-premium mb-0"><b>โปรดชำระเงินผ่าน QR CODE</b></p>
                                <div class="form-check form-check-inline mt-3">
                                    <input class="form-check-input" type="radio" id="pp" name="payment" value="pp" checked>
                                    <label class="form-check-label mr-4" for="pp"><b>ชำระเงินผ่านพร้อมเพย์</b></label>
                                </div>
                            </div>
                            <div class="col-lg-12" id="item_pp">
                                <div class="text-center">
                                    <img class="mt-2" src="https://pp.js.org/img/PromptPay-logo.jpg" width="40%"><br>
                                    <img class="mt-2 mb-2" src="<?php echo $PromptPayQR->generate(); ?>" width="65%">
                                    <p class="text-info mb-2"><b>สแกน QR เพื่อจ่ายเงิน</b></p>
                                    <p class="mb-2">ชื่อบัญชี <b>นายภารดร เตชะสกลรัศมิ์</b></p>
                                    <p class="mb-1">จำนวนเงิน <b class="text-premium"><?php echo number_format($PromptPayQR->amount, 2); ?></b> บาท</p>
                                    <p class="mb-1"><b class="text-danger">*** สำคัญ ***</b></p>
                                    <p class="mb-1"><b class="text-danger">ส่งหลักฐานการชำระเงินมาที่ Line@ : @664uzmwr</b></p>
                                    <button type="button" class="btn btn-info br-20">แนบหลักฐานการชำระเงิน</button>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="cod" name="payment" value="cod">
                                    <label class="form-check-label mr-4" for="cod"><b>ชำระเงินปลายทาง</b></label>
                                </div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                                <p class="text-center text-premium"><b>ที่อยู่ในการจัดส่งสินค้าและหลักฐานการชำระเงิน</b></p>
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name"><b>ชื่อ-นามสกุล <sup class="text-danger">*</sup></b></label>
                                            <input type="text" class="form-control br-10" id="name"name="name" placeholder="ชื่อ-นามสกุล" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="phone"><b>เบอร์โทรศัพท์ <sup class="text-danger">*</sup></b></label>
                                            <input type="text" class="form-control br-10" id="phone" name="phone" placeholder="เบอร์โทรศัพท์" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email"><b>อีเมล</b></label>
                                            <input type="text" class="form-control br-10" id="email" name="email" placeholder="อีเมล">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="address"><b>ที่อยู่ <sup class="text-danger">*</sup></b></label>
                                            <textarea class="form-control br-10" id="address" name="address" rows="2" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="province"><b>จังหวัด <sup class="text-danger">*</sup></b></label>
                                            <input type="text" class="form-control br-10" id="province" name="province" placeholder="จังหวัด" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="zipcode"><b>รหัสไปรษณีย์ <sup class="text-danger">*</sup></b></label>
                                            <input type="text" class="form-control br-10" id="zipcode" name="zipcode" placeholder="รหัสไปรษณีย์" required>
                                        </div>
                                    </div>
                                    <!-- <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="fullName"><b>หลักฐานการชำระเงิน</b></label>
                                            <input type="file" class="d-none" id="file" placeholder="">
                                            <div>
                                                <button id="shooseFile" class="btn btn-info br-10"><i class="fa fa-file-upload"></i> เลือกไฟล์</button> 
                                                <small id="fileName" class="form-text text-muted">ยังไม่ได้เลือกไฟล์</small>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                                <hr />
                            </div>
                            <div class="col-md-6 col-12">
                                <a href="/my_cart" class="btn btn-danger btn-block mt-3 br-10 text-white">
                                    <span class="fa fa-angle-double-left"></span> กลับไปตะกร้าสินค้า
                                </a>
                            </div>
                            <div class="col-md-6 col-12">
                                <button type="submit" class="btn btn-success btn-block mt-3 br-10" name="submit">สั่งซื้อสินค้า <span class="fa fa-angle-double-right"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    <?php
        } else {
    ?>
        <div class="row">
            <div class="col-lg-12 text-center" style="margin-top: 200px">
                <span class="fa fa-box-open text-premium mb-5" style="font-size: 150px"></span> <br>
                <a href="/my_orders" class="btn btn-premium br-30 px-4 py-3"><b>ไปที่รายการสั่งซื้อ</b></a>
            </div>
        </div>
    <?php
        }
    ?>
    </div>
</div>

<script>
$(".form-check-input").change(function() {
    if($(".form-check-input")[0].checked) {
        $("#item_pp").removeClass("d-none");
        $("#item_pp").addClass("d-block");
    }
    if($(".form-check-input")[1].checked) {
        $("#item_pp").removeClass("d-block");
        $("#item_pp").addClass("d-none");
    }
})
</script>

</body>
</html>