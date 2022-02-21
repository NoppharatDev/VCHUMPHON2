<?php
    if(!isset($_SESSION["cust_id"])) { header('Location: /login'); }
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/Product.Class.php');
    require_once('components/OrderProduct.Class.php');

    $headObj = new HeadHTML();
    $prodObj = new Product();
    $oprodObj = new OrderProduct();
    $oprodObj->getAddress();
?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">
<?php
    if(isset($_POST['addOrder'])) {
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
                <div class="col-lg-12">
                    <div class="card border-0 shodow-sm br-20">
                        <div class="card-header d-flex border-0" style="border-radius: 20px 20px 0 0">
                            <div class="my-auto">
                                <h4 style="font-size: 18px;"><b><i class="fa fa-map-marked-alt mr-2"></i> ที่อยู่ในการจัดส่ง</b></h4>
                            </div>
                            <!-- <div class="ml-auto">
                                <a href="?page=my_order&id=0000065" class="btn btn-premium br-30 px-3" target="_blank"><span class="fas fa-tasks mr-1"></span> แก้ไข...</a>
                            </div> -->
                        </div>
                        <div class="card-body">
                            <a>ชื่อ-นามสกุล : <b class="text-premium"><?php echo $oprodObj->name; ?></b></a> <br>
                            <a>ที่อยู่ : <b><?php echo $oprodObj->address; ?></b></a> <br>
                            <a>เบอร์ติดต่อ : <b><?php echo $oprodObj->zerofill($oprodObj->phone, 10); ?></b></a> <br>
                            <a>อีเมล : <b><?php echo $oprodObj->email; ?></b></a> <br>
                            <a>ชำระเงินโดย : <b><?php echo ($oprodObj->payment == 'pp') ? 'พร้อมเพย์' : 'ชำระเงินปลายทาง'; ?></b></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
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
                                            <th width="35%">ชื่อสินค้า</th>
                                            <th width="15%" class="text-center">ราคา/หน่วย</th>
                                            <th width="15%" class="text-center">จำนวน</th>
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
                                                        <b class="text-premium"><?php echo $prodObj->getDataCart($obj->prodID, 'prod_name') . " (" . number_format($prodObj->getDataCart($obj->prodID, 'prod_weight'), 0) . " กรัม)"; ?></b>
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
                                                    <td class="text-center"><?php echo number_format($prodObj->getDataCart($obj->prodID, 'prod_price'), 2); ?></td>
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
                <div class="col-md-6 col-12">
                    <a href="/cart/address" class="btn btn-danger btn-block br-30 py-3 px-5" name="send">
                        <span class="fa fa-angle-double-left"></span> กลับไปแก้ไขที่อยู่ในการจัดส่ง
                    </a>
                </div>
                <div class="col-md-6 col-12">
                    <form action="" method="POST">
                        <button type="submit" class="btn btn-success btn-block br-30 py-3" name="addOrder">ยืนยันการสั่งซื้อ <span class="fa fa-check"></span></button>
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