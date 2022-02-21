<?php
if (!isset($_SESSION["cust_id"])) {
    header('Location: /login');
}
require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
require_once('components/Product.Class.php');
require_once('components/OrderProduct.Class.php');
require_once("libs/PromptPay/PromptPayQR.php");

$headObj = new HeadHTML();
$oprodObj = new OrderProduct();
$prodObj = new Product();
$PromptPayQR = new PromptPayQR(); // new object
$PromptPayQR->size = 10; // Set QR code size to 8
$PromptPayQR->id = '0'; // PromptPay ID
$PromptPayQR->amount = 0; // Set amount (not necessary)
?>

<!DOCTYPE html>
<html lang="th">
<?php
echo $headObj->getHead();
?>

<body style="overflow-x: hidden">
    <?php
    if (!isset($_SESSION['cust_id'])) {
        header('Location: /login');
    }
    ?>
    <?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

    <style>
        .bg-cyan {
            background-color: #ededed;
        }
    </style>

    <div style="background-color: #F5F5F5; padding-top: 110px; min-height: 100vh">
        <div class="container mt-3 pb-5">
            <?php
            $result = $oprodObj->queryOrderProd();
            $i = 1;
            if ($result->num_rows > 0) {
            ?>
                <div class="row">
                    <div class="col-lg-12 mt-4 mb-5">
                        <h4 class="text-premium"><span class="fa fa-box-open mr-2"></span> <b>รายการสั่งซื้อของฉัน</b></h4>
                    </div>
                    <div class="col-lg-12">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            $prices = $oprodObj->sumPriceOrderByID($row["oprod_id"]);
                            $weight = $oprodObj->sumWeightOrderByID($row["oprod_id"]);
                            $shipping_cost = $prodObj->calculateShippingCost($weight);
                            $total_price = ($prices + $shipping_cost);
                            $PromptPayQR->id = $row["admin_promptpay"];
                            $PromptPayQR->amount = $total_price;
                        ?>
                            <div class="card border-0 shadow-sm br-20">
                                <div class="card-header d-flex border-0" style="border-radius: 20px 20px 0 0">
                                    <div class="mr-auto">
                                        <h4 style="font-size: 15px;">
                                            <a class="text-dark">คำสั่งซื้อหมายเลข : </a>
                                            <a class="text-premium" href="?page=my_order&id=<?php echo $oprodObj->zerofill($row["oprod_id"], 7); ?>" style="text-decoration: none;">
                                                <b>INV<?php echo $oprodObj->zerofill($row["oprod_id"], 7); ?>TH</b>
                                            </a> (<?php echo ($row['oprod_payment'] == 'cod') ? 'เก็บเงินปลายทาง' : 'ชำระเงินผ่านพร้อมเพย์' ?>)
                                        </h4>
                                        <h6 style="font-size: 12px;">สั่งซื้อเมื่อ <?php echo $oprodObj->dateThai($row["oprod_created"]); ?></h6>
                                    </div>
                                    <div class="ml-auto">
                                        <?php
                                        if ($row["oprod_payment"] == 'pp' && $row["oprod_status"] <= 1) {
                                        ?>
                                            <button type="button" class="btn btn-danger br-30 px-3 mr-2" data-toggle="modal" data-target="#evidence_<?php echo $row["oprod_id"]; ?>">
                                                <span class="fas fa-file-upload mr-1"></span> ส่งหลักฐาน
                                            </button>
                                            <div class="modal fade" id="evidence_<?php echo $row["oprod_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered br-20" role="document">
                                                    <div class="modal-content br-20">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle"><b>ส่งหลักฐาน (คำสั่งซื้อหมายเลข : <b>INV<?php echo $oprodObj->zerofill($row["oprod_id"], 7); ?>TH)</b></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center mt-3">
                                                                <p class="mb-2">ชื่อบัญชี <?php echo $row["admin_promptpay_name"]; ?><b></b></p>
                                                                <p class="mb-1">จำนวนเงิน <b class="text-premium"><?php echo number_format($PromptPayQR->amount, 2); ?></b> บาท</p>
                                                                <input type="file" class="d-none" name="file" id="file">
                                                                <button type="button" class="btn btn-info btn-block br-20 mr-3 my-3" id="chooseFile"><span class="fas fa-file-image"></span> เลือกไฟล์</button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success px-3 br-30 mr-2"><span class="fas fa-paper-plane"></span> ส่งหลักฐาน</button>
                                                            <button type="button" class="btn btn-secondary px-3 br-30" data-dismiss="modal">ปิด</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-info br-30 px-3 mr-2" data-toggle="modal" data-target="#pay_<?php echo $row["oprod_id"]; ?>"><span class="fas fa-credit-card mr-1"></span> ชำระเงิน</button>
                                            <div class="modal fade" id="pay_<?php echo $row["oprod_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered br-20" role="document">
                                                    <div class="modal-content br-20">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle"><b>ชำระเงิน (คำสั่งซื้อหมายเลข : <b>INV<?php echo $oprodObj->zerofill($row["oprod_id"], 7); ?>TH)</b></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center mt-3">
                                                                <img src="https://pp.js.org/img/PromptPay-logo.jpg" width="40%"><br>
                                                                <img src="<?php echo $PromptPayQR->generate(); ?>" width="65%">
                                                                <p class="text-info mb-2"><b>สแกน QR เพื่อจ่ายเงิน</b></p>
                                                                <p class="mb-2">ชื่อบัญชี <?php echo $row["admin_promptpay_name"]; ?><b></b></p>
                                                                <p class="mb-1">จำนวนเงิน <b class="text-premium"><?php echo number_format($PromptPayQR->amount, 2); ?></b> บาท</p>
                                                                <p class="mb-1"><b class="text-danger">*** สำคัญ ***</b></p>
                                                                <p class="mb-1"><b class="text-danger">เมื่อชำระเงินแล้วโปรดส่งหลักฐานการชำระเงินที่ปุ่ม "สั่งหลักฐาน"</b></p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary px-3 br-30" data-dismiss="modal">ปิด</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="/invoice/<?php echo $oprodObj->zerofill($row["oprod_id"], 7); ?>" class="btn btn-success br-30 px-3 mr-2" target="_blank"><span class="fas fa-file-invoice mr-1"></span> ใบเสร็จ</a>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($row["oprod_track"] != NULL) {
                                        ?>
                                            <button type="button" class="btn btn-dark br-30 px-3 mr-2" data-toggle="modal" data-target="#track_<?php echo $row["oprod_id"]; ?>"><span class="fas fa-truck-loading mr-1"></span> ติดตามคำสั่งซื้อ</button>
                                            <div class="modal fade" id="track_<?php echo $row["oprod_id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered br-20" role="document">
                                                    <div class="modal-content br-20">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle"><b>ติดตามคำสั่งซื้อ</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="text-center">
                                                                <p>คำสั่งซื้อหมายเลข : <b>INV<?php echo $oprodObj->zerofill($row["oprod_id"], 7); ?>TH</b></p>
                                                                <p>วันที่สั่งซื้อ : <?php echo $oprodObj->dateThai($row["oprod_created"]); ?></p>
                                                                <p>ราคารวม : <b class="text-success"><?php echo number_format($PromptPayQR->amount, 2); ?></b> บาท</p>
                                                                <hr>
                                                                <p>วันที่จัดส่ง : 20/09/2564 10:56 น.</p>
                                                                <p>หมายเลขติดตามพัสดุ : <b class="text-danger"><?php echo $row['oprod_track']; ?></b></p>
                                                            </div>
                                                            <?php if (isset($_POST["oprod_id"]) && $row["oprod_id"] == $_POST["oprod_id"]) { ?>
                                                                <script>
                                                                    $('#track_<?php echo $row["oprod_id"]; ?>').modal('show');
                                                                </script>
                                                                <?php
                                                                $url = "https://trackapi.thailandpost.co.th/post/api/v1/authenticate/token";
                                                                $token = "DYSrPfIHQ?DpJDF5H4R=GLIaOaUsA#QoSKYBHaIpAtU0PfWNHjG~I6FMQ7YyXfB#K9SuGRR7HCMHXzI.O#ZNS1CJO;A9VyVlNOLG";
                                                                $token = $oprodObj->getToken($url, $token, array());

                                                                $url = "https://trackapi.thailandpost.co.th/post/api/v1/track";
                                                                $params = array('status' => 'all', 'language' => 'TH', 'barcode' => ["{$row['oprod_track']}"]);
                                                                $resultTrack = $oprodObj->getItemsbyBarcodeฺ($url, $token, $params);
                                                                $resultTrack = json_decode($resultTrack, TRUE);
                                                                $track = $resultTrack["response"]["items"]["{$row['oprod_track']}"];
                                                                foreach ($track as $key => $val) {
                                                                ?>
                                                                    <!-- <div class="card card-body border-0 bg-secondary text-white">
                                                                <p class="text-right">21/09/2564 05:31 น.</p>
                                                                <p>อยู่ระหว่างขนส่ง</p>
                                                                <div class="row">
                                                                    <div class="col-lg-8">พัสดุถึงศูนย์คัดแยกสินค้า</div>
                                                                    <div class="col-lg-4">17130</div>
                                                                </div>
                                                            </div> -->
                                                                    <div class="card card-body border-0 bg-cyan">
                                                                        <p class="text-right"><?php echo substr($val["status_date"], 0, 16); ?> น.</p>
                                                                        <p><?php echo $val["status_description"]; ?></p>
                                                                        <div class="row">
                                                                            <div class="col-lg-8"><?php echo $val["location"]; ?></div>
                                                                            <div class="col-lg-4"><?php echo $val["postcode"]; ?></div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                <div class="text-center">
                                                                    <a href="submit" class="btn btn-danger px-3 br-30">
                                                                        <span class="fas fa-truck-loading mr-1"></span> ติดตามสถานะคำสั่งซื้อ
                                                                    </a>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="text-center">
                                                                    <form action="" method="POST">
                                                                        <button type="submit" class="btn btn-success px-3 br-30" name="oprod_id" value="<?php echo $row['oprod_id']; ?>">
                                                                            <span class="fas fa-eye mr-1"></span> แสดงรายละเอียดพัสดุ
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary px-3 br-30" data-dismiss="modal">ปิด</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <a href="/my_order/<?php echo $oprodObj->zerofill($row["oprod_id"], 7); ?>" class="btn btn-premium br-30 px-3" target="_blank"><span class="fas fa-tasks mr-1"></span> รายละเอียดคำสั่งซื้อ</a>
                                    </div>
                                </div>
                                <div class="card-body py-5 text-center">
                                    <div class="d-flex">
                                        <div class="col-lg-1 mr-3">
                                            <figure class="avatar mr-2 avatar-xl pt-3 text-center"><?php echo $i; ?></figure>
                                        </div>
                                        <div class="col-lg-3 my-auto">
                                            ราคารวม <b class="text-premium"><?php echo number_format($total_price, 2); ?></b> บาท
                                        </div>
                                        <div class="col-lg-2 my-auto">
                                            <b><?php echo $oprodObj->countOrderByID($row["oprod_id"]); ?> รายการ</b>
                                        </div>
                                        <div class="col-lg-2 my-auto">
                                            <?php echo $oprodObj->convertStatus($row["oprod_status"]); ?>
                                        </div>
                                        <div class="col-lg-4 my-auto">
                                            อัพเดทล่าสุด : <b><?php echo $oprodObj->dateThai($row["oprod_updated"]); ?></b>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                            $i++;
                        }
                        ?>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row">
                    <div class="col-lg-12 text-center" style="margin-top: 200px">
                        <span class="fa fa-box-open text-premium mb-5" style="font-size: 150px"></span> <br>
                        <a href="?page=my_orders" class="btn btn-premium br-30 px-4 py-3"><b>ไปที่รายการสั่งซื้อ</b></a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <script>
        $(".form-check-input").change(function() {
            if ($(".form-check-input")[0].checked) {
                $("#item_pp").removeClass("d-none");
                $("#item_pp").addClass("d-block");
            }
            if ($(".form-check-input")[1].checked) {
                $("#item_pp").removeClass("d-block");
                $("#item_pp").addClass("d-none");
            }
        })
    </script>

</body>

</html>