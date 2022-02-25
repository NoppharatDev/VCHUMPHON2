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
    }
?>

<!DOCTYPE html>
<html lang="th">
<?php echo $headObj->getHead(); ?>
<body style="overflow-x: hidden">
<?php
    if(!empty($id)) {
        $opkgObj->uploadEvidence($id);
        $opkgObj->setOrderPkgByID($id);
        $PromptPayQR = new PromptPayQR(); // new object
        $PromptPayQR->size = 10; // Set QR code size to 8
        $PromptPayQR->id = $opkgObj->admin_promptpay; // PromptPay ID
        $PromptPayQR->amount = 0; // Set amount (not necessary)
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
        <?php
            if($opkgObj->status == 1) {
                if($opkgObj->evidence == NULL) {
        ?>
                    <div class="alert alert-primary alert-dismissible fade show" style="border-radius: 15px" role="alert">
                        <strong><span class="fas fa-credit-card"></span> แจ้งเตือน ! : </strong> โปรดชำระเงิน หากชำระแล้วโปรดส่งหลักฐานการชำระเงินเพื่อให้เราทำการตรวจสอบ
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
        <?php
                } else {
        ?>
                    <div class="alert alert-warning alert-dismissible fade show" style="border-radius: 15px" role="alert">
                        <strong><span class="fas fa-spinner"></span> แจ้งเตือน ! : </strong> ส่งหลักฐานการชำระเงินแล้ว เรากำลังตรวจสอบข้อมูล
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
        <?php
                }
        ?>
        <?php
            } else if($opkgObj->status == 2) {
        ?>
                <div class="alert alert-info alert-dismissible fade show" style="border-radius: 15px" role="alert">
                    <strong><span class="fas fa-check-circle"></span> แจ้งเตือน ! : </strong> คุณชำระเงินแล้ว เช็คอินภายในวันที่ <b><?php echo $opkgObj->dateThai($opkgObj->travel_date, 'd-m-y h:i'); ?></b> เพื่อรับส่วนลดร้านค้าในโครงการ
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php
            } else if($opkgObj->status == 3) {
        ?>
                <div class="alert alert-success alert-dismissible fade show" style="border-radius: 15px" role="alert">
                    <strong><span class="fas fa-calendar-check"></span> แจ้งเตือน ! : </strong> คุณเช็คอินแล้ว เมื่อเวลา : <b><?php echo $opkgObj->dateThai($opkgObj->travel_date, 'd-m-y h:i'); ?></b>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php
            } else if($opkgObj->status == 0) {
        ?>
                <div class="alert alert-danger alert-dismissible fade show" style="border-radius: 15px" role="alert">
                    <strong><span class="fas fa-times-circle"></span> แจ้งเตือน ! : </strong> การจองนี้ถูกยกเลิกแล้ว
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        <?php
            }
        ?>
            <div class="card border-0 shadow-sm mb-4 box-shadow br-20">
                <div class="card-body">
                    <h5 class="mb-4"><b>กรุณากรอกข้อมูลของท่าน</b></h5>
                    <form class="row" action="" method="POST">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="first_name" class="mb-0">ชื่อ <b><sup class="text-danger">*</sup></b></label>
                                <input type="text" class="form-control form-control-lg br-20" id="first_name" name="first_name" value="<?php echo $opkgObj->name; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="phone" class="mb-0">เบอร์โทรศัพท์ <b><sup class="text-danger">*</sup></b></label>
                                <input type="text" class="form-control form-control-lg br-20" id="phone" name="phone" value="<?php echo $opkgObj->zerofill($opkgObj->phone, 10); ?>" disabled>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="email" class="mb-0">อีเมล <b><sup class="text-danger">*</sup></b></label>
                                <input type="email" class="form-control form-control-lg br-20" id="email" name="email" value="<?php echo $opkgObj->email; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="province" class="mb-0">จังหวัด <b><sup class="text-danger">*</sup></b></label>
                                <input type="text" class="form-control form-control-lg br-20" id="province" name="province" value="<?php echo $opkgObj->province; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="zipcode" class="mb-0">รหัสไปรษณีย์ <b><sup class="text-danger">*</sup></b></label>
                                <input type="number" class="form-control form-control-lg br-20" id="zipcode" name="zipcode" value="<?php echo $opkgObj->zipcode; ?>" disabled>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="travel_date" class="mb-0">วันที่เริ่มท่องเที่ยว <b><sup class="text-danger">*</sup></b></label>
                                <input type="date" class="form-control form-control-lg br-20" id="travel_date" name="travel_date" value="<?php echo $opkgObj->travel_date; ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="adult" class="mb-0">จำนวนผู้ใหญ่ (<?php echo $pkgObj->adult_price; ?> / คน) <b><sup class="text-danger">*</sup></b></label>
                                <select class="form-control form-control-lg br-20" id="adult" name="adult" disabled>
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
                                <select class="form-control form-control-lg br-20" id="child" name="child" disabled>
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
        <?php
            if($opkgObj->status == 1) {
        ?>
                <div class="card border-0 mb-3 shadow-sm br-20">
                    <div class="card-body px-2 py-3">
                        <div class="text-center">
                            <?php $PromptPayQR->amount = (((($opkgObj->adult*$opkgObj->adult_price)+($opkgObj->child*$opkgObj->child_price))-$opkgObj->discount)*0.50); ?>
                            <img class="mt-2" src="https://pp.js.org/img/PromptPay-logo.jpg" width="60%"><br>
                            <img class="mt-2 mb-2" src="<?php echo $PromptPayQR->generate(); ?>" width="65%">
                            <p class="text-info mb-2"><b>สแกน QR เพื่อจ่ายเงิน</b></p>
                            <p class="mb-2">ชื่อบัญชี <b><?php echo $pkgObj->promptpay_name ?></b></p>
                            <p class="mb-1">จำนวนเงิน <b class="text-premium"><?php echo number_format($PromptPayQR->amount, 2); ?></b> บาท</p>
                            <p class="mb-1"><b class="text-danger">*** และชำระเงินเมื่อถึง <?php echo number_format((((($opkgObj->adult*$opkgObj->adult_price)+($opkgObj->child*$opkgObj->child_price))-$opkgObj->discount)*0.50), 2) ; ?> บาท ***</b></p>
                            <?php
                                if($opkgObj->status == 1 && $opkgObj->evidence == NULL) {
                            ?>
                                    <hr>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <input type="file" id="file" name="file" class="d-none" accept="image/jpg, image/jpeg, image/png" required>
                                        <button type="button" class="btn btn-danger br-20 mr-3" id="chooseFile"><span class="fas fa-file-image"></span> เลือกไฟล์</button>
                                        <button type="submit" class="btn btn-info br-20" name="evidence"><span class="fas fa-paper-plane"></span> ส่งไฟล์</button>
                                    </form>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
        <?php
            } else if($opkgObj->status == 2) {
        ?>
                <div class="card border-0 mb-3 shadow-sm br-20">
                    <div class="card-body px-2 py-3">
                        <div class="text-center">
                            <?php $PromptPayQR->amount = (((($opkgObj->adult*$opkgObj->adult_price)+($opkgObj->child*$opkgObj->child_price))-$opkgObj->discount)*0.50); ?>
                            <p class="mb-1">ชำระแล้ว <b class="text-success"><?php echo number_format($PromptPayQR->amount, 2); ?></b> บาท</p>
                            <p class="mb-1"><b class="text-danger" style="font-size: 14px;">*** และชำระเงินเมื่อถึง <?php echo number_format((((($opkgObj->adult*$opkgObj->adult_price)+($opkgObj->child*$opkgObj->child_price))-$opkgObj->discount)*0.50), 2) ; ?> บาท ***</b></p>
                        </div>
                    </div>
                </div>
        <?php
            } else if($opkgObj->status == 3) {
        ?>
                <div class="card border-0 mb-3 shadow-sm br-20">
                    <div class="card-body p-3">
                        <ul class="list-unstyled mb-0">
                            <li>
                                <h5 class="text-success text-center"><b>ยินดีด้วยคุณได้รับส่วนลด</b></h5>
                                <hr>
                            </li>
                            <li class="text-center">ส่วนลด กาแฟลาเต้ 5%</li>
                            <li class="text-center"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1200px-QR_code_for_mobile_English_Wikipedia.svg.png" width="60%"></li>
                            <li class="text-cenrer text-danger" style="font-size: 12.5px;"><b>** โปรดแสดง QR CODE เมื่อรับสินค้า จากร้านค้าที่ร่วมรายการ **</b></li>
                            <li class="text-center mt-2"><button class="btn btn-success br-20">ดาวน์โหลด QR CODE</button></li>
                        </ul>
                    </div>
                </div>
        <?php
            }
        ?>
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
                        <p class="ml-auto mb-1" id="total_price"><?php echo number_format((($opkgObj->adult*$opkgObj->adult_price)+($opkgObj->child*$opkgObj->child_price)), 0); ?></p>
                    </div>
                    <div class="d-flex">
                        <p class="mb-1">ส่วนลด (<b>บาท<?php /*echo $pkgObj->convertPromotionUnit($pkgObj->promo_unit);*/ ?></b>)</p>
                        <p class="ml-auto mb-1" id="promo_text"><?php echo number_format($opkgObj->discount, 0); ?></p>
                    </div>
                    <div class="d-flex">
                        <p class="mb-1">ราคาที่จ่าย (บาท)</p>
                        <p class="ml-auto mb-1 text-premium" id="total_end"><b><?php echo number_format(((($opkgObj->adult*$opkgObj->adult_price)+($opkgObj->child*$opkgObj->child_price))-$opkgObj->discount), 0); ?></b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
$("#chooseFile").click(function() {
    $("#file").click();
});

$("#file").change(function() {
    let fileName = document.querySelector('#file').files[0].name;
    const lastDot = fileName.lastIndexOf('.');
    const typeName = fileName.substring(lastDot + 1);
    if(fileName.length <= 10) {
        $("#chooseFile").html('<span class="fas fa-file-image"></span> ' + fileName.substring(0, 15));
    } else {
        $("#chooseFile").html('<span class="fas fa-file-image"></span> ' + fileName.substring(0, 15) + `.${typeName}`);
    }
    console.log(fileName);
})
</script>

</body>
</html>