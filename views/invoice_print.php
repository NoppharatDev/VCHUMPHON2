<?php
    if(!isset($_SESSION["cust_id"])) { /*header('Location: ?page=login');*/ }
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
<body style="overflow-x: hidden; background: #F5F5F5" onload="window.print()">
<?php
    if(isset($_POST['add_cart'])) {
        $prodObj->addProdToCart($id);
    }
?>

    <div>
            <h5><b>ใบสั่งซื้อ</b></h5>
        </div>
        <div class="ml-auto">
            <h6><b>ใบสั่งซื้อเลขที่ INV<?php echo $id; ?>TH</b></h6>
        </div>
    </div>
    <div class="d-flex">
        <div class="col"><hr /></div>
        <div class="ml-auto">
            <p>วันที่สั่งซื้อ : <?php echo $oprodObj->dateThai($row["oprod_created"]);?></p>
        </div>
    </div>
    <div class="d-flex mb-3">
        <div class="ml-auto">
            <h6><b>ที่อยู่ในการจัดส่ง</b></h6>
        </div>
    </div>
    <div class="d-flex">
        <div class="ml-auto">
            <h6 style="font-size: 13px;">คุณ <?php echo $row["oprod_name"]; ?></h6>
        </div>
    </div>
    <div class="d-flex">
        <div class="ml-auto">
            <h6 style="font-size: 13px;"><?php echo $row["oprod_address"]; ?></h6>
        </div>
    </div>
    <div class="d-flex">
        <div class="ml-auto">
            <h6 style="font-size: 13px;"><?php echo $row["oprod_email"]; ?></h6>
        </div>
    </div>
    <div class="d-flex">
        <div class="ml-auto">
            <h6 style="font-size: 13px;"><?php echo $oprodObj->zerofill($row["oprod_phone"], 10); ?></h6>
        </div>
    </div>
    <hr />
    <div class="card br-10">
        <div class="card-header py-2"><b>รายการสั่งซื้อ</b></div>
        <div class="card-body px-3">
            <div class="table-responsive-sm">
                <table class="table table-sm" style="font-size: 13px;">
                    <thead class="border-0">
                        <tr>
                            <th width="5%" class="text-center">ลำดับ</th>
                            <th width="50%">ผลิตภัณฑ์</th>
                            <th width="15%" class="text-center">ราคา/หน่วย</th>
                            <th width="15%" class="text-center">จำนวน</th>
                            <th width="15%">
                                <div class="d-flex">
                                    <div class="ml-auto">ราคารวม</div>
                                </div>
                            </th>
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
                            <td><?php echo "{$row['prod_name']} ({$type}, {$level})"; ?></td>
                            <td class="text-center"><?php echo number_format($row["prodlist_price"], 2); ?></td>
                            <td class="text-center"><?php echo $row["prodlist_amount"]; ?> ชิ้น</td>
                            <td>
                                <div class="d-flex">
                                    <div class="ml-auto"><?php echo number_format(($row["prodlist_price"] * $row["prodlist_amount"]), 2); ?></div>
                                </div>
                            </td>
                        </tr>
                    <?php
                            $i++;
                        }
                    ?>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">
                                <div class="d-flex">
                                    <div class="ml-auto">น้ำหนักรวม <b><?php echo number_format(($weight / 1000), 2); ?></b> กิโลกรัม</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">
                                <div class="d-flex">
                                    <div class="ml-auto">ราคาสินค้ารวม <b><?php echo number_format($prices, 2); ?></b> บาท</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">
                                <div class="d-flex">
                                    <div class="ml-auto">ค่าจัดส่งสินค้า <b><?php echo number_format($shipping_cost, 2); ?></b> บาท</div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td colspan="2">
                                <div class="d-flex">
                                    <div class="ml-auto">ราคาสุทธิ <b><?php echo number_format($total_price, 2); ?></b> บาท</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>