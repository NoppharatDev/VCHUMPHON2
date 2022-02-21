<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/Product.Class.php');
    $headObj = new HeadHTML();
    $prodObj = new Product();
?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">

<?php
    if(isset($_SESSION["my_cart"])) {
        if(isset($_GET['key'])) {
            // if(count($_SESSION['my_cart'])) {}
            $array = $_SESSION["my_cart"];
            array_splice($_SESSION['my_cart'], $_GET['key'], 1);
            //unset($_SESSION["my_cart"]); // = [json_encode($arrData)];
            // echo ' ลบกัน';
        }
        if(isset($_POST['calculate_price'])) {
            $prodObj->calculatePrice();
        }
    }
?>
<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<div style="background-color: #F5F5F5">
    <div class="container pb-5" style="padding-top: 130px">
    <?php
        if(isset($_SESSION['my_cart']) && count($_SESSION['my_cart']) > 0) {
    ?>
            <form class="row" method="POST" action="">
                <div class="col-lg-12">
                    <h2 class="text-center text-premium my-5"><b>ตะกร้าสินค้า <span class="fa fa-shopping-cart"></span></b></h2>

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
                            $show = ""; if($key == 0) { $show = "show"; }
                    ?>
                        <div class="card border-0 shadow-sm br-20">
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
                                            <th width="15%" class="text-center">ราคา/หน่วย</th>
                                            <th width="10%" class="text-center">จำนวน</th>
                                            <th width="15%" class="text-center">ราคารวม</th>
                                            <th width="10%"></th>
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
                                                            <img src="/img_view/prod/<?php echo $obj->prodID; ?>/0.15" width="100%">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <b class="text-premium"><?php echo $prodObj->getDataCart($obj->prodID, 'prod_name') . " (" . $prodObj->getDataCart($obj->prodID, 'prod_weight') . " กรัม)"; ?></b>
                                                        <?php
                                                            if($obj->adminID == 1) {
                                                        ?>
                                                                <small class="form-text text-muted"><b>ชนิด : <?php echo $prodObj->convertType($obj->type); ?></b></small>
                                                                <small class="form-text text-muted"><b>ระดับการคั่ว : <?php echo $prodObj->convertLevel($obj->level); ?></b></small>
                                                        <?php
                                                            }
                                                        ?>
                                                        <!-- <small class="form-text text-muted"><b>ขนาด : <?php echo $obj->weight; ?></b></small> -->
                                                    </td>
                                                    <td class="text-center"><?php echo number_format($prodObj->getDataCart($obj->prodID, 'prod_price'), 2); ?></td>
                                                    <td class="text-center">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm text-center" placeholder="จำนวน" name="prod_<?php echo $key; ?>" value="<?php echo $obj->amt; ?>">
                                                            <input class="d-none" name="type_<?php echo $key; ?>" value="<?php echo $obj->type; ?>">
                                                            <input class="d-none" name="level_<?php echo $key; ?>" value="<?php echo $obj->level; ?>">
                                                            <input class="d-none" name="weight_<?php echo $key; ?>" value="<?php echo $obj->weight; ?>">
                                                            <small class="form-text text-muted"><b>คงเหลือ <?php echo number_format($prodObj->getDataCart($obj->prodID, 'prod_amount'), 0); ?></b></small>
                                                        </div>
                                                    </td>
                                                    <td class="text-center"><?php echo number_format(($prodObj->getDataCart($obj->prodID, 'prod_price') * $obj->amt), 2); ?></td>
                                                    <td>
                                                        <a href="?page=my_cart&key=<?php echo $key; ?>" class="btn btn-danger btn-sm btn-block br-30"><i class="fa fa-trash-alt"></i> ลบสินค้า</a>
                                                    </td>
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
                                <div class="d-flex">
                                    <div class="ml-auto">
                                        <button type="submit" name="calculate_price" class="btn btn-info btn-sm py-2 px-3 br-30">
                                            <i class="fa fa-calculator"></i> คำนวณราคาสินค้าใหม่
                                        </button>
                                    </div>
                                </div>
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
                    
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <a href="/product" class="btn btn-danger btn-block br-30 py-3 px-5" name="send">
                                <span class="fa fa-angle-double-left"></span> กลับไปเลือกสินค้าต่อ
                            </a>
                        </div>
                        <div class="col-md-6 col-12">
                        <?php
                            if(isset($_SESSION["cust_id"])){
                                echo "<a href=\"/cart/address\" class=\"btn btn-premium btn-block br-30 py-3\" name=\"send\">ดำเนินการต่อ <span class=\"fa fa-angle-double-right\"></span></a>";
                            } else {
                                echo "<a href=\"/login\" class=\"btn btn-premium btn-block br-30 py-3\" name=\"send\">เข้าสู่ระบบ <span class=\"fa fa-sign-in-alt\"></span></a>";
                            }
                        ?>
                        </div>
                    </div>

                    <!-- <div class="card border-0 shadow-sm br-20">
                        <div class="card-body">
                            <table class="table table-responsive table-hover br-20">
                                <thead class="thead-dark br-20">
                                    <tr>
                                        <th width="5%" class="text-center">ลำดับ</th>
                                        <th width="15%" class="text-center">ภาพสินค้า</th>
                                        <th width="30%">ชื่อสินค้า</th>
                                        <th width="15%" class="text-center">ราคา/หน่วย</th>
                                        <th width="10%" class="text-center">จำนวน</th>
                                        <th width="15%" class="text-center">ราคารวม</th>
                                        <th width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $prices = 0; $weight = 0;
                                    foreach($_SESSION["my_cart"] as $key => $val) {
                                        $obj = json_decode($val);
                                        $prices += ($prodObj->getDataCart($obj->prodID, 'prod_price') * $obj->amt);
                                        $weight += ($prodObj->getDataCart($obj->prodID, 'prod_weight') * $obj->amt);
                                        // echo $val . '<br>';
                                ?>
                                        <tr>
                                            <th class="text-center"><?php echo ($key + 1); ?></th>
                                            <td>
                                                <div class="cart-img">
                                                    <img src="img_view.php?type=prod&id=<?php echo $obj->prodID; ?>" width="100%">
                                                </div>
                                            </td>
                                            <td>
                                                <b class="text-premium"><?php echo $prodObj->getDataCart($obj->prodID, 'prod_name') . " (" . $prodObj->getDataCart($obj->prodID, 'prod_weight') . " กรัม)"; ?></b>
                                                <small class="form-text text-muted"><b>ชนิด : <?php echo $prodObj->convertType($obj->type); ?></b></small>
                                                <small class="form-text text-muted"><b>ระดับการคั่ว : <?php echo $prodObj->convertLevel($obj->level); ?></b></small>
                                                <small class="form-text text-muted"><b>ขนาด : <?php echo $obj->weight; ?></b></small>
                                            </td>
                                            <td class="text-center"><?php echo number_format($prodObj->getDataCart($obj->prodID, 'prod_price'), 2); ?></td>
                                            <td class="text-center">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm text-center" placeholder="จำนวน" name="prod_<?php echo $key; ?>" value="<?php echo $obj->amt; ?>">
                                                    <input class="d-none" name="type_<?php echo $key; ?>" value="<?php echo $obj->type; ?>">
                                                    <input class="d-none" name="level_<?php echo $key; ?>" value="<?php echo $obj->level; ?>">
                                                    <input class="d-none" name="weight_<?php echo $key; ?>" value="<?php echo $obj->weight; ?>">
                                                    <small class="form-text text-muted"><b>คงเหลือ <?php echo number_format($prodObj->getDataCart($obj->prodID, 'prod_amount'), 0); ?></b></small>
                                                </div>
                                            </td>
                                            <td class="text-center"><?php echo number_format(($prodObj->getDataCart($obj->prodID, 'prod_price') * $obj->amt), 2); ?></td>
                                            <td>
                                                <a href="?page=my_cart&key=<?php echo $key; ?>" class="btn btn-danger btn-sm btn-block br-30"><i class="fa fa-trash-alt"></i> ลบสินค้า</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                    $shipping_cost = $prodObj->calculateShippingCost($weight);
                                    $total_price = $prices + $shipping_cost;
                                ?>
                                </tbody>
                            </table>
                            <hr />
                            <div class="d-flex">
                                <div class="ml-auto">
                                    <button type="submit" name="calculate_price" class="btn btn-info btn-sm py-2 px-3 br-30">
                                        <i class="fa fa-calculator"></i> คำนวณราคาสินค้าใหม่
                                    </button>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-7 col-0"></div>
                                <div class="col-md-5 col-12">
                                    <div class="text-right"><h6>น้ำหนักรวม <b><?php echo (number_format(($weight / 1000), 2));?></b> กิโลกรัม</h6></div>
                                    <div class="text-right"><h6>ราคาสินค้ารวม <b><?php echo number_format($prices, 2);?></b> บาท</h6></div>
                                    <div class="text-right"><h6>ค่าจัดส่งสินค้า <b><?php echo number_format($shipping_cost, 2);?></b> บาท</h6></div>
                                    <div class="text-right"><h5>ราคาสุทธิ <b class="text-premium"><?php echo number_format($total_price , 2); ?></b> บาท</h5></div>
                                </div>
                                <div class="col-12"><hr /></div>
                                <div class="col-md-6 col-12">
                                    <a href="?page=prod" class="btn btn-danger btn-block br-30 py-3 px-5" name="send">
                                        <span class="fa fa-angle-double-left"></span> กลับไปเลือกสินค้าต่อ
                                    </a>
                                </div>
                                <div class="col-md-6 col-12">
                                <?php
                                    if(isset($_SESSION["cust_id"])){
                                        echo "<a href=\"?page=cart_confirm\" class=\"btn btn-premium btn-block br-30 py-3\" name=\"send\">ดำเนินการต่อ <span class=\"fa fa-angle-double-right\"></span></a>";
                                    } else {
                                        echo "<a href=\"?page=login\" class=\"btn btn-premium btn-block br-30 py-3\" name=\"send\">เข้าสู่ระบบ <span class=\"fa fa-sign-in-alt\"></span></a>";
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
            </form>
    <?php
        } else {
            unset($_SESSION["my_cart"]);
    ?>
            <div class="text-center" style="margin: 20vh auto">
                <h1 class="text-danger mb-5" style="font-size: 100px"><b><span class="fa fa-tired"></span></b></h1>
                <h3 class="text-danger"><b>ไม่พบสินค้าในตะกร้า</b></h3>
            </div>
    <?php
        }
    ?>
    </div>
</div>

</body>
</html>