<?php
    if(!isset($_SESSION["cust_id"])) { header('Location: /login'); }
    if(empty($id)) {
        // echo '<script>window.location.assign("/travel")</script>';
        exit;
    } else {
        require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
        require_once("components/Package.Class.php");
        require_once("components/OrderPackage.Class.php");
        require_once("libs/PromptPay/PromptPayQR.php");

        $opkgObj = new OrderPackage();
        $headObj = new HeadHTML();
        $pkgObj = new Package();
        $pkgObj->setPackageByID($opkgObj->getIDByPkgID($id));
        $opkgObj->setOrderPkgByID($id);
        $PromptPayQR = new PromptPayQR(); // new object
        $PromptPayQR->size = 10; // Set QR code size to 8
        $PromptPayQR->id = '1341100230128'; // PromptPay ID
        $PromptPayQR->amount = 0; // Set amount (not necessary)
    }
?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">
<?php
    if(isset($_POST["submit"])) {
        $opkgObj->addOrderPackage($id);
    }
?>
<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<style>
.card-img {
    min-height: 220px;
    max-height: 220px;
}
</style>

<div style="background: #F5F5F5; padding: 100px 0 145px 0;">
<div class="container mt-3">
    <div class="row" id="cafePage">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4 box-shadow br-20">
                <div class="card-body">
                    <h5 class="mb-4"><b>กรุณากรอกข้อมูลของท่าน</b></h5>
                    <form class="row" action="" method="POST">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="first_name" class="mb-0">ชื่อ <b><sup class="text-danger">*</sup></b></label>
                                <input type="text" class="form-control form-control-lg br-20" id="first_name" name="first_name" value="<?php echo $opkgObj->name; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="phone" class="mb-0">เบอร์โทรศัพท์ <b><sup class="text-danger">*</sup></b></label>
                                <input type="text" class="form-control form-control-lg br-20" id="phone" name="phone" value="<?php echo $opkgObj->zerofill($opkgObj->phone, 10); ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="email" class="mb-0">อีเมล <b><sup class="text-danger">*</sup></b></label>
                                <input type="email" class="form-control form-control-lg br-20" id="email" name="email" value="<?php echo $opkgObj->email; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="province" class="mb-0">จังหวัด <b><sup class="text-danger">*</sup></b></label>
                                <input type="text" class="form-control form-control-lg br-20" id="province" name="province" value="<?php echo $opkgObj->province; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="zipcode" class="mb-0">รหัสไปรษณีย์ <b><sup class="text-danger">*</sup></b></label>
                                <input type="number" class="form-control form-control-lg br-20" id="zipcode" name="zipcode" value="<?php echo $opkgObj->zipcode; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="travel_date" class="mb-0">วันที่เริ่มท่องเที่ยว <b><sup class="text-danger">*</sup></b></label>
                                <input type="date" class="form-control form-control-lg br-20" id="travel_date" name="travel_date" value="<?php echo $opkgObj->travel_date; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="adult" class="mb-0">จำนวนผู้ใหญ่ (<?php echo $pkgObj->adult_price; ?> / คน) <b><sup class="text-danger">*</sup></b></label>
                                <select class="form-control form-control-lg br-20" id="adult" name="adult" readonly>
                                    <option>0</option>
                                <?php
                                    for($i = 1; $i <= $pkgObj->adult_max; $i++) {
                                        if($i == $opkgObj->adult) { $selected = "selected"; } else { $selected = "";}
                                        echo "<option {$selected}>{$i}</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="child" class="mb-0">จำนวนเด็ก (<?php echo $pkgObj->child_price; ?> / คน)</label>
                                <select class="form-control form-control-lg br-20" id="child" name="child" readonly>
                                    <option>0</option>
                                <?php
                                    for($i = 1; $i <= $pkgObj->child_max; $i++) {
                                        if($i == $opkgObj->child) { $selected = "selected"; } else { $selected = "";}
                                        echo "<option {$selected}>{$i}</option>";
                                    }
                                ?>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 mb-3 shadow-sm br-20">
                <div class="card-body px-2 py-3">
                    <div class="text-center">
                        <?php $PromptPayQR->amount = (((($opkgObj->adult*$opkgObj->adult_price)+($opkgObj->child*$opkgObj->child_price))-$opkgObj->discount)*0.25); ?>
                        <img class="mt-2" src="https://pp.js.org/img/PromptPay-logo.jpg" width="60%"><br>
                        <img class="mt-2 mb-2" src="<?php echo $PromptPayQR->generate(); ?>" width="65%">
                        <p class="text-info mb-2"><b>สแกน QR เพื่อจ่ายเงิน</b></p>
                        <p class="mb-2">ชื่อบัญชี <b>นายภารดร เตชะสกลรัศมิ์</b></p>
                        <p class="mb-1">จำนวนเงิน <b class="text-premium"><?php echo number_format($PromptPayQR->amount, 2); ?></b> บาท</p>
                        <p class="mb-1"><b class="text-danger">*** สำคัญ ***</b></p>
                        <p class="mb-1"><b class="text-danger">ส่งหลักฐานการชำระเงินมาที่ Line@ : @664uzmwr</b></p>
                    </div>
                </div>
            </div>
            <div class="card border-0 mb-3 shadow-sm br-20">
                <div class="card-body px-2 py-3">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <h5 class="ml-2"><b>แพ็คเกจท่องเที่ยว (<?php echo $pkgObj->name; ?>)</5></h4>
                        </li>
                        <hr />
                        <li>
                            <div class="card-img">
                                <img src="/img_view/pkg/<?php echo $pkgObj->id; ?>/0.3" width="100%">
                            </div>
                        </li>
                        <li class="d-flex">
                            <div class="ml-auto mr-2">
                                <b>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star text-warning"></span>
                                    <span class="fa fa-star-half-alt text-warning"></span>
                                </b>
                                (12)
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card border-0 mb-3 shadow-sm br-20">
                <div class="card-body p-3">
                    <ul class="list-unstyled mb-0">
                        <li>
                            <h5><b>รายละเอียด</b></h5>
                            <hr />
                        </li>
                        <li>ระยะเวลา : <b><?php echo $pkgObj->duration; ?></b></li>
                        <li>รองรับสูงสุด : <b><?php echo $pkgObj->adult_max + $pkgObj->child_max; ?> คน</b></li>
                        <li>โปรโมชั่น : <?php echo $pkgObj->convertPromotion($pkgObj->promo_quantity, $pkgObj->promo_unit); ?></li>
                        <li>ราคาสำหรับเด็ก : <b><?php echo number_format($pkgObj->child_price, 0); ?> บาท</b></li>
                    </ul>
                </div>
            </div>
            <div class="card border-0 mb-4 shadow-sm br-20">
                <div class="card-body p-3">
                    <h5><b>รายละเอียด</b></h5>
                    <hr />
                    <div class="d-flex">
                        <p class="mb-1">จำนวนผู้ใหญ่ (<?php echo number_format($pkgObj->adult_price, 0); ?> / คน)</p>
                        <p class="ml-auto mb-1" id="adult_text"><?php echo $opkgObj->adult; ?></p>
                    </div>
                    <div class="d-flex">
                        <p class="mb-1">จำนวนเด็ก (<?php echo number_format($pkgObj->child_price, 0); ?> / คน)</p>
                        <p class="ml-auto mb-1" id="child_text"><?php echo $opkgObj->child; ?></p>
                    </div>
                    <div class="d-flex">
                        <p class="mb-1">จำนวนรวม (คน)</p>
                        <p class="ml-auto mb-1" id="total_text"><?php echo ($opkgObj->adult+$opkgObj->child); ?></p>
                    </div>
                    <div class="d-flex">
                        <p class="mb-1">ราคารวม (บาท)</p>
                        <p class="ml-auto mb-1" id="total_price"><?php echo (($opkgObj->adult*$opkgObj->adult_price)+($opkgObj->child*$opkgObj->child_price)); ?></p>
                    </div>
                    <div class="d-flex">
                        <p class="mb-1">ส่วนลด (<b>บาท<?php /*echo $pkgObj->convertPromotionUnit($pkgObj->promo_unit);*/ ?></b>)</p>
                        <p class="ml-auto mb-1" id="promo_text"><?php echo $opkgObj->discount; ?></p>
                    </div>
                    <div class="d-flex">
                        <p class="mb-1">ราคาที่จ่าย (บาท)</p>
                        <p class="ml-auto mb-1 text-premium" id="total_end"><b><?php echo ((($opkgObj->adult*$opkgObj->adult_price)+($opkgObj->child*$opkgObj->child_price))-$opkgObj->discount); ?></b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</body>
</html>