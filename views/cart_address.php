<?php
    if(!isset($_SESSION["cust_id"])) { header('Location: /login'); }
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/OrderProduct.Class.php');

    $headObj = new HeadHTML();
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
    $oprodObj->createAddress();
?>
<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<link rel="stylesheet" href="/assets/jquery.Thailand.js/dist/jquery.Thailand.min.css">
<script type="text/javascript" src="/assets/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
<script type="text/javascript" src="/assets/jquery.Thailand.js/dependencies/zip.js/zip.js"></script>
<script type="text/javascript" src="/assets/jquery.Thailand.js/dependencies/JQL.min.js"></script>
<script type="text/javascript" src="/assets/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>

<div style="background-color: #F5F5F5; padding-top: 110px; min-height: 100vh">
    <div class="container mt-3 pb-5">
    <?php
        if(isset($_SESSION['my_cart']) && count($_SESSION['my_cart']) > 0) {
    ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow br-15">
                    <div class="card-body">
                        <form action="" method="POST" id="demo1" class="demo" autocomplete="on">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="text-center text-premium mb-0"><b>วิธีการชำระเงิน</b></h4>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" id="pp" name="payment" value="pp" checked>
                                        <label class="form-check-label mr-4" for="pp"><b>ชำระเงินผ่านพร้อมเพย์</b></label>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-check form-check-inline mt-3">
                                        <input class="form-check-input" type="radio" id="cod" name="payment" value="cod" <?php echo ($oprodObj->payment == 'cod') ? 'checked' : ''; ?>>
                                        <label class="form-check-label mr-4" for="cod"><b>ชำระเงินปลายทาง</b></label>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <h4 class="text-center text-premium mb-0"><b>รายละเอียดที่อยู่ในการจัดส่งสินค้า</b></h4>
                                    <hr>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name"><b>ชื่อ-นามสกุล <sup class="text-danger">*</sup></b></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg br-10"
                                            id="name"
                                            name="name"
                                            placeholder="ชื่อ-นามสกุล"
                                            value="<?php echo $oprodObj->name; ?>"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone"><b>เบอร์โทรศัพท์ <sup class="text-danger">*</sup></b></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg br-10"
                                            id="phone"
                                            name="phone"
                                            placeholder="เบอร์โทรศัพท์"
                                            onkeypress="if(this.value.length==10) return false;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                            maxlength="10"
                                            pattern="[0]{1}[0-9]{9}"
                                            value="<?php echo $oprodObj->phone; ?>"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email"><b>อีเมล</b></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg br-10"
                                            id="email"
                                            name="email"
                                            placeholder="อีเมล"
                                            value="<?php echo $oprodObj->email; ?>"
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="address"><b>ที่อยู่ <sup class="text-danger">*</sup></b></label>
                                        <textarea
                                            class="form-control form-control-lg br-10"
                                            id="address"
                                            name="address"
                                            rows="3"
                                            required
                                        ><?php echo $oprodObj->address; ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="province"><b>จังหวัด <sup class="text-danger">*</sup></b></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg br-10"
                                            id="province"
                                            name="province"
                                            placeholder="จังหวัด"
                                            value="<?php echo $oprodObj->province; ?>"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="zipcode"><b>รหัสไปรษณีย์ <sup class="text-danger">*</sup></b></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg br-10"
                                            id="zipcode"
                                            name="zipcode"
                                            placeholder="รหัสไปรษณีย์"
                                            onkeypress="if(this.value.length==5) return false;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                            maxlength="5"
                                            pattern="[0-9]{5}"
                                            value="<?php echo $oprodObj->zipcode; ?>"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <hr>
                                </div>
                                <div class="col-md-6 col-12">
                                    <a href="/cart" class="btn btn-danger btn-block br-30 py-3 px-5">
                                        <span class="fa fa-angle-double-left"></span> กลับไปตะกร้าสินค้า
                                    </a>
                                </div>
                                <div class="col-md-6 col-12">
                                    <button type="submit" class="btn btn-premium btn-block br-30 py-3" name="createAddress">ดำเนินการต่อ <span class="fa fa-angle-double-right"></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
$.Thailand({
    database: '//<?php echo $_SERVER['HTTP_HOST']; ?>/assets/jquery.Thailand.js/database/db.json',
    $district: $('#demo1 [name="district"]'),
    $amphoe: $('#demo1 [name="amphoe"]'),
    $province: $('#demo1 [name="province"]'),
    $zipcode: $('#demo1 [name="zipcode"]'),
    onDataFill: function(data) {
        // console.info('Data Filled', data);
    },
    onLoad: function() {
        // console.info('Autocomplete is ready!');
        // $('#loader, .demo').toggle();
    }
});

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