<?php
    if(!isset($_SESSION["cust_id"])) { header('Location: /login'); }
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once("libs/PromptPay/PromptPayQR.php");
    require_once("components/OrderPackage.Class.php");

    $opkgObj = new OrderPackage();
    $headObj = new HeadHTML();
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
    if(!isset($_SESSION['cust_id'])) { header('Location: /login'); }
?>
<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<style>
    .bg-cyan {
        background-color: #ededed;
    }
    .card {
        flex-direction: row;
    }
    .card img {
        width: 30%;
    }
    .card {
        // align-items: center;
    }
    .card-title {
        font-weight: bold;
    }
    .card img {
        border-top-right-radius: 0;
        border-bottom-left-radius: calc(0.25rem - 1px);
    }
</style>

<div style="background-color: #F5F5F5; padding-top: 110px; min-height: 100vh">
    <div class="container mt-3 pb-5">
    <div class="row">
        <?php
            $result = $opkgObj->queryOrderPkg(); $i = 1;
            if($result->num_rows > 0) {
        ?>
                <div class="col-lg-12 mt-4 mb-5">
                    <h4 class="text-premium"><span class="fa fa-suitcase"></span> <b> การจองของฉัน</b></h4>
                </div>
        <?php
            while($row = $result->fetch_assoc()) {
        ?>
                <div class="col-lg-12">
                    <div class="card border-0 shadow-sm br-20">
                        <img src="<?php echo $opkgObj->getLinkImgPkg($row["pkg_id"]); ?>" class="card-img-top" alt="..." style="border-radius: 20px 0 0 20px">
                        <div class="card-body">
                            <div class="d-flex mb-4">
                                <div class="mr-auto">
                                    <h5 class="mb-0"><b class="text-premium">แพคเกจท่องเที่ยว (<?php echo $opkgObj->getPkgName($row["pkg_id"]); ?>)</b></h5>
                                    หมายเลขการจอง : <b class="text-premium">PKG<?php echo $opkgObj->zerofill($row["opkg_id"], 6); ?>TH</b>
                                    (วันที่จอง <?php echo $opkgObj->dateThai($row["opkg_created"], "dd-mm-yy h:i"); ?>)
                                </div>
                                <div class="ml-auto">
                                    <p class="text-right mb-0">วันที่เริ่มท่องเที่ยว</p>
                                    <h5><b class="text-premium"><?php echo $opkgObj->dateThai($row["opkg_travel_date"], "dd-mm-yy"); ?></b></h5>
                                </div>
                            </div>
                            <div class="row mb-4 ml-4">
                                <div class="col-lg-2 text-center">
                                    <p class="mb-0"> ระยะเวลา</p>
                                    <h4 class="text-premium"><?php echo $row["opkg_duration"]; ?></h4>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <p class="mb-0"> จำนวนผู้ใหญ่</p>
                                    <h4><?php echo $row["opkg_adult"]; ?> คน</h4>
                                </div>
                                <div class="col-lg-2 text-center">
                                    <p class="mb-0"> จำนวนเด็ก</p>
                                    <h4><?php echo $row["opkg_child"]; ?> คน</h4>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <p class="mb-0"> ราคารวม</p>
                                    <h4><b class="text-premium">
                                        <?php echo number_format(((($row["opkg_adult"]*$row["opkg_adult_price"])+($row["opkg_child"]*$row["opkg_child_price"]))-$row["opkg_discount"]), 0) ; ?> บาท
                                    </b></h4>
                                </div>
                            </div>
                            <a href="/my_packages/<?php echo $opkgObj->zerofill($row["opkg_id"], 6); ?>" class="btn btn-success br-20 px-5 mr-2">รายละเอียดการจอง</a>
                            <a href="#" class="btn btn-premium br-20 px-5">เลื่อนวันนัดหมาย</a>
                        </div>
                    </div>
                </div>
        <?php
            }
            } else {
        ?>  
                <div class="col lg-12 mt-5">
                    <h2 class="text-center text-premium">ไม่พบการจองแพคเกจท่องเที่ยวของคุณ</h2>
                </div>
        <?php
            }
        ?>
    </div>
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