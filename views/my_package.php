<?php
    if(!isset($_SESSION["cust_id"])) { header('Location: /login'); }
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/Product.Class.php');
    require_once('components/OrderProduct.Class.php');
    require_once("libs/PromptPay/PromptPayQR.php");

    $headObj = new HeadHTML();
    $oprodObj = new OrderProduct();
    $prodObj = new Product();
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
        <div class="col-lg-12 mt-4 mb-5">
            <h4 class="text-premium"><span class="fa fa-suitcase"></span> <b>การจองของฉัน</b></h4>
        </div>
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm br-20">
                <img src="/img_view/pkg/31/0.3" class="card-img-top" alt="..." style="border-radius: 20px 0 0 20px">
                <div class="card-body">
                    <div class="d-flex mb-4">
                        <div class="mr-auto">
                            <h5 class="mb-0"><b class="text-premium">แพคเกจท่องเที่ยว (แหลมคอกวาง-เขาหัวโม่ง)</b></h5>
                            หมายเลขการจอง : <b class="text-premium">PKG000003TH</b>
                            (วันที่จอง 25 ก.ย. 2564 เวลา 03.30 น.)
                        </div>
                        <div class="ml-auto">
                            <p class="text-right mb-0">วันที่เริ่มท่องเที่ยว</p>
                            <h5><b class="text-premium">25 ก.ย. 2564</b></h5>
                        </div>
                    </div>
                    <div class="row mb-4 ml-4">
                        <div class="col-lg-2 text-center">
                            <p class="mb-0"> ระยะเวลา</p>
                            <h4 class="text-premium">1 วัน</h4>
                        </div>
                        <div class="col-lg-2 text-center">
                            <p class="mb-0"> จำนวนผู้ใหญ่</p>
                            <h4>3 คน</h4>
                        </div>
                        <div class="col-lg-2 text-center">
                            <p class="mb-0"> จำนวนเด็ก</p>
                            <h4>1 คน</h4>
                        </div>
                        <div class="col-lg-6 text-right">
                            <p class="mb-0"> ราคารวม</p>
                            <h4><b class="text-premium">1,700 บาท</b></h4>
                        </div>
                    </div>
                    <a href="#" class="btn btn-success br-20 px-5 mr-2">รายละเอียดการจอง</a>
                    <a href="#" class="btn btn-premium br-20 px-5">เลื่อนวันนัดหมาย</a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm br-20">
                <img src="/img_view/pkg/32/0.3" class="card-img-top" alt="..." style="border-radius: 20px 0 0 20px">
                <div class="card-body">
                    <div class="d-flex mb-4">
                        <div class="mr-auto">
                            <h5 class="mb-0"><b class="text-premium">แพคเกจท่องเที่ยว (เขาถ้ำศิลางู)</b></h5>
                            หมายเลขการจอง : <b class="text-premium">PKG000002TH</b>
                            (วันที่จอง 25 ก.ย. 2564 เวลา 10.30 น.)
                        </div>
                        <div class="ml-auto">
                            <p class="text-right mb-0">วันที่เริ่มท่องเที่ยว</p>
                            <h5><b class="text-premium">20 ก.ย. 2564</b></h5>
                        </div>
                    </div>
                    <div class="row mb-4 ml-4">
                        <div class="col-lg-2 text-center">
                            <p class="mb-0"> ระยะเวลา</p>
                            <h4 class="text-premium">3 วัน</h4>
                        </div>
                        <div class="col-lg-2 text-center">
                            <p class="mb-0"> จำนวนผู้ใหญ่</p>
                            <h4>5 คน</h4>
                        </div>
                        <div class="col-lg-2 text-center">
                            <p class="mb-0"> จำนวนเด็ก</p>
                            <h4>2 คน</h4>
                        </div>
                        <div class="col-lg-6 text-right">
                            <p class="mb-0"> ราคารวม</p>
                            <h4><b class="text-premium">3,000 บาท</b></h4>
                        </div>
                    </div>
                    <a href="#" class="btn btn-success br-20 px-5 mr-2">รายละเอียดการจอง</a>
                    <a href="#" class="btn btn-premium br-20 px-5">เลื่อนวันนัดหมาย</a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm br-20">
                <img src="/img_view/pkg/33/0.3" class="card-img-top" alt="..." style="border-radius: 20px 0 0 20px">
                <div class="card-body">
                    <div class="d-flex mb-4">
                        <div class="mr-auto">
                            <h5 class="mb-0"><b class="text-premium">แพคเกจท่องเที่ยว (เขาร้อยยอดและผาตาอู๊ด)</b></h5>
                            หมายเลขการจอง : <b class="text-premium">PKG000001TH</b>
                            (วันที่จอง 25 ก.ย. 2564 เวลา 13.02 น.)
                        </div>
                        <div class="ml-auto">
                            <p class="text-right mb-0">วันที่เริ่มท่องเที่ยว</p>
                            <h5><b class="text-premium">12 ก.ย. 2564</b></h5>
                        </div>
                    </div>
                    <div class="row mb-4 ml-4">
                        <div class="col-lg-2 text-center">
                            <p class="mb-0"> ระยะเวลา</p>
                            <h4 class="text-premium">2 วัน</h4>
                        </div>
                        <div class="col-lg-2 text-center">
                            <p class="mb-0"> จำนวนผู้ใหญ่</p>
                            <h4>2 คน</h4>
                        </div>
                        <div class="col-lg-2 text-center">
                            <p class="mb-0"> จำนวนเด็ก</p>
                            <h4>1 คน</h4>
                        </div>
                        <div class="col-lg-6 text-right">
                            <p class="mb-0"> ราคารวม</p>
                            <h4><b class="text-premium">400 บาท</b></h4>
                        </div>
                    </div>
                    <a href="#" class="btn btn-success br-20 px-5 mr-2">รายละเอียดการจอง</a>
                    <a href="#" class="btn btn-premium br-20 px-5">เลื่อนวันนัดหมาย</a>
                </div>
            </div>
        </div>
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