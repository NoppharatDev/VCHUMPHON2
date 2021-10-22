<?php
    if(empty($id)) {
        echo '<script>window.location.assign("/robusta")</script>';
        exit;
    } else {
        require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
        require_once('components/Product.Class.php');
        $headObj = new HeadHTML();
        $prodObj = new Product();
        $prodObj->setProductByID($id);
        $prodObj->updateViewByID($id);
    }
?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">
<?php
    if(isset($_POST['add_cart'])) {
        $prodObj->addProdToCart($id);
    }
?>
<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<style>
    .btn-line {
        background-color: #1dbd57;
    }
</style>

<div style="background-color: #FFF; margin-top: 90px">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm br-20">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-lg-5">
                                <div class="product-img">
                                    <img src="/<?php echo $prodObj->getImage($prodObj->id); ?>" width="100%" alt="<?php echo "{$prodObj->name} ขนาด {$prodObj->weight} กรัม"; ?>">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="d-flex product-title mb-4">
                                    <a class="card-link text-dark">
                                        <?php echo "$prodObj->name ($prodObj->weight กรัม)"; ?>
                                    </a>
                                </div>
                                <hr />
                                <p class="mb-2"><span class="fa fa-star"></span> รีวิว : <b>4.8/5.0</b></p>
                                <p class="mb-2"><span class="fa fa-eye"></span> การเข้าชม : <b><?php echo $prodObj->view; ?> ครั้ง</b></p>
                                <p class="mb-3"><span class="fa fa-store"></span> สินค้าคงเหลือ : <b id="amtSQL"><?php echo $prodObj->amount; ?> ชิ้น</b></p>
                                <h3><b class="text-dangerx" style="color: #CF952A;"><?php echo number_format($prodObj->price, 2); ?></b> <small>บาท</small></h3>
                                <hr />
                                <form action="" method="POST" name="form1" class="row mt-3">
                                <div class="row mt-3">
                                    <div class="col-lg-3 mt-1">
                                        <span class="mx-auto" style="font-size: 15px;">ชนิด</span>
                                    </div>
                                    <div class="col-lg-9 mb-3">
                                        <select class="custom-select mr-sm-2 border-0 shadow-sm" id="type" name="type" required>
                                            <option value="" selected>โปรดเลือกชนิดกาแฟ</option>
                                            <option value="1">ชนิดบด</option>
                                            <option value="2">ชนิดเมล็ด</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 mt-1">
                                        <span class="mx-auto" style="font-size: 15px;">ระดับการคั่ว</span>
                                    </div>
                                    <div class="col-lg-9 mb-3">
                                        <select class="custom-select mr-sm-2 border-0 shadow-sm" id="level" name="level" required>
                                            <option value="" selected>โปรดเลือระดับการคั่ว</option>
                                            <option value="1">คั่วอ่อน</option>
                                            <option value="2">คั่วกลาง</option>
                                            <option value="3">คั่วเข้ม</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 mt-1">
                                        <span class="mx-auto">จำนวน</span>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-select bg-1 btn-sm" type="button" id="minus"><span class="fa fa-minus"></span></button>
                                            </div>
                                                <input type="text" class="form-control form-control-sm text-center border-0" value="1" name="amt" id="amt" style="max-height:35px; font-weight: bold;">
                                            <div class="input-group-append">
                                                <button class="btn btn-select bg-1 btn-sm" type="button" id="plus"><span class="fa fa-plus"></span></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-premium btn-block py-2 px-5 mt-4 br-30" style="font-weight: 650; font-size: 18px;" name="add_cart">
                                            <span class="fa fa-cart-plus"></span> เพิ่มลงตะกร้า
                                        </button>
                                    </div>
                                    <!-- <div class="col-lg-4">
                                        <a href="https://line.me/ti/p/@664uzmwr" class="btn btn-line btn-block py-2 px-5 mt-4 br-30 text-white" style="font-weight: 650; font-size: 18px;"><img src="image/LINE_logo.svg.png" class="mr-2" width="25px"> ติดต่อ</a>
                                    </div> -->
                                    <!-- <div class="col-lg-2">
                                        <a href="?line=xxx" class="btn btn-line btn-block py-2 px-5 mt-4 br-30 text-white" style="font-weight: 650; font-size: 18px;"><img src="image/LINE_logo.svg.png" class="mr-2" width="25px"> สั่งซื้อสินค้าผ่านไลน์</a>
                                    </div> -->
                                </div>
                                </form>
                            </div>
                        </div>
                        <hr />
                        <h5><b>รายละเอียดสินค้า " <?php echo $prodObj->name; ?> "</b></h5>
                        <hr />
                        <div id="details">
                            <?php echo $prodObj->detail; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
    </div>
</div>

<script>
$("body").css("background", "url('../../image/bg-coffee1.jpg')");
$("body").css("background-size", "cover" );
$("body").css("background-position", "top center");
$("body").css("background-attachment", "fixed");
</script>

</body>
</html>