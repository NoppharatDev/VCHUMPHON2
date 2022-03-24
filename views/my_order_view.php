<?php
    if(!isset($_SESSION["cust_id"])) { header('Location: /login'); }
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/OrderProduct.Class.php');
    require_once("libs/PromptPay/PromptPayQR.php");

    $headObj = new HeadHTML();
    $oprodObj = new OrderProduct();
    $PromptPayQR = new PromptPayQR(); // new object
    $PromptPayQR->size = 10; // Set QR code size to 8
    $PromptPayQR->id = '1341100230128'; // PromptPay ID
    $PromptPayQR->amount = 0; // Set amount (not necessary)

    $result = $oprodObj->queryOrderProdByID($id);
    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">
<?php
    if(!isset($_SESSION['cust_id'])) { header('Location: /login'); }
?>
<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<div style="background-color: #F5F5F5; padding-top: 110px; min-height: 100vh">
    <div class="container mt-3 pb-5">
        <div class="row">
            <!-- <div class="col-lg-12 mt-4 mb-5">
                <h4 class="text-premium"><span class="fa fa-box-open"></span> <b>รายการสั่งซื้อของฉัน</b></h4>
            </div> -->
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm br-20">
                    <div class="card-header d-flex border-0" style="border-radius: 20px 20px 0 0">
                        <div class="mr-auto">
                            <h4 style="font-size: 15px;">
                                <a class="text-dark">คำสั่งซื้อหมายเลข : </a>
                                <a style="text-decoration: none;">
                                    <b class="text-premium">INV<?php echo $id; ?>PD</b>
                                </a>
                            </h4>
                            <h6 style="font-size: 12px;">สั่งซื้อเมื่อ <?php echo $oprodObj->dateThai($row["oprod_created"]);?></h6>
                        </div>
                        <div class="ml-auto">
                            <a href="/invoice/<?php echo $id; ?>" class="btn btn-success br-30 px-3" target="_blank"><span class="fas fa-file-invoice mr-1"></span> ใบเสร็จ</a>
                        </div>
                    </div>
                    <div class="card-body py-5">
                        <div class="table-responsive-sm">
                            <table class="table table-sm" style="font-size: 13px;">
                                <thead class="border-0">
                                    <tr>
                                        <th width="5%" class="text-center">ลำดับ</th>
                                        <th width="15%">ภาพสินค้า</th>
                                        <th width="35%">ชื่อสินค้า</th>
                                        <th width="15%" class="text-center">ราคา/หน่วย</th>
                                        <th width="15%" class="text-center">จำนวน (ชิ้น)</th>
                                        <th width="15%" class="text-center">ราคารวม (บาท)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $result = $oprodObj->queryOrderProdListByID($id); $i = 1;
                                    while($row = $result->fetch_assoc()) {
                                        $type = $oprodObj->convertType($row['prodlist_type']);
                                        $level = $oprodObj->convertLevel($row['prodlist_level']);
                                        $prices = $oprodObj->sumPriceOrderByID($row["oprod_id"]);
                                        $weight = $oprodObj->sumWeightOrderByID($row["oprod_id"]);
                                        $shipping_cost = $oprodObj->calculateShippingCost($weight);
                                        $total_price = $prices + $shipping_cost;
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td>
                                            <div class="cart-img">
                                                <img src="/img_view/prod/<?php echo $row['prod_id']; ?>/0.2" width="100%">
                                            </div>
                                        </td>
                                        <td>
                                            <b class="text-premium"><?php echo "{$row['prod_name']} ({$row['prod_weight']} กรัม)"; ?></b>
                                            <?php
                                                if($row['prod_id'] == 45 || $row['prod_id'] == 46) {
                                            ?>
                                                <small class="form-text text-muted"><b>ชนิด : <?php echo $type; ?></b></small>
                                                <small class="form-text text-muted"><b>ระดับการคั่ว : <?php echo $level; ?></b></small>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center"><?php echo number_format($row["prodlist_price"], 2); ?></td>
                                        <td class="text-center"><?php echo $row["prodlist_amount"]; ?></td>
                                        <td class="text-center"><?php echo number_format(($row["prodlist_price"] * $row["prodlist_amount"]), 2); ?></td>
                                    </tr>
                                <?php
                                        $i++;
                                    }
                                    $result = $oprodObj->queryOrderProdByID($id);
                                    $row = $result->fetch_assoc();
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
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
                        <a>ชื่อ-นามสกุล : <b class="text-premium"><?php echo $row["oprod_name"]; ?></b></a> <br>
                        <a>ที่อยู่ : <b><?php echo $row["oprod_address"]; ?></b></a> <br>
                        <a>เบอร์ติดต่อ : <b><?php echo $oprodObj->zerofill($row["oprod_phone"], 10); ?></b></a> <br>
                        <a>อีเมล : <b><?php echo $row["oprod_email"]; ?></b></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shodow-sm br-20">
                    <div class="card-header d-flex border-0" style="border-radius: 20px 20px 0 0">
                        <div class="py-1">
                            <h4 style="font-size: 18px;"><b>สรุปยอดรวมทั้งสิ้น</b></h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <div>น้ำหนักรวม</div>
                            <div class="ml-auto"><b><?php echo number_format(($weight / 1000), 2); ?></b> กิโลกรัม</div>
                        </div>
                        <div class="d-flex mb-2">
                            <div>ราคาสินค้ารวม</div>
                            <div class="ml-auto"><b><?php echo number_format($prices, 2); ?></b> บาท</div>
                        </div>
                        <div class="d-flex mb-2">
                            <div>ค่าจัดส่งสินค้า</div>
                            <div class="ml-auto"><b><?php echo number_format($shipping_cost, 2); ?></b> บาท</div>
                        </div>
                        <div class="d-flex mb-2">
                            <div>ราคาสุทธิ</div>
                            <div class="ml-auto"><b class="text-danger"><?php echo number_format($total_price, 2); ?></b> บาท</div>
                        </div>
                        <div>ชำระเงินโดย <b><?php echo ($row["oprod_payment"] == 'pp') ? 'ชำระเงินผ่านพร้อมเพย์' : 'ชำระเงินปลายทาง'; ?></b></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>