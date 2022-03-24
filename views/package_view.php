<?php
    if(empty($id)) {
        echo '<script>window.location.assign("/travel")</script>';
        exit;
    } else {
        require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
        require_once("components/Package.Class.php");
        $headObj = new HeadHTML();
        $pkgObj = new Package();
        $pkgObj->setPackageByID($id);
        $cart_count = 0;
    }
?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">

<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<div style="background: rgba(255,255,255,0.40); padding: 160px 0 145px 0;">
    <div class="container text-center">
        <img src="../image/chumphon.png" width="38%">
    </div>
</div>

<div style="background-color: #FFF;">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm mb-4 br-30">
                    <div class="card-body">
                        <h4><b>แพ็คเกจท่องเที่ยว : <?php echo $pkgObj->name; ?></b></h4>
                        <hr />
                        <div id="demo" class="carousel slide" data-ride="carousel">
                            <ul class="carousel-indicators">
                            <?php if(!empty($pkgObj->slide1_img)) { ?>
                                <li data-target="#demo" data-slide-to="0" class="active"></li>
                            <?php } ?>
                            <?php if(!empty($pkgObj->slide2_img)) { ?>
                                <li data-target="#demo" data-slide-to="1"></li>
                            <?php } ?>
                            <?php if(!empty($pkgObj->slide3_img)) { ?>
                                <li data-target="#demo" data-slide-to="2"></li>
                            <?php } ?>
                            </ul>
                            <div class="carousel-inner br-20">
                            <?php if(!empty($pkgObj->slide1_img)) { ?>
                                <div class="carousel-item active">
                                    <img src="/img_view/pkg1/<?php echo $pkgObj->id; ?>/0.5" alt="Los Angeles" width="1100" height="500">
                                    <div class="carousel-caption br-20" style="background-color: rgb(0, 0, 0, 0.5);">
                                        <h3><?php echo $pkgObj->slide1_name; ?></h3>
                                        <p><?php echo $pkgObj->slide1_detail; ?></p>
                                    </div>   
                                </div>
                            <?php } ?>
                            <?php if(!empty($pkgObj->slide2_img)) { ?>
                                <div class="carousel-item">
                                    <img src="/img_view/pkg2/<?php echo $pkgObj->id; ?>/0.5" alt="Chicago" width="1100" height="500px">
                                    <div class="carousel-caption br-20" style="background-color: rgb(0, 0, 0, 0.5);">
                                        <h3><?php echo $pkgObj->slide2_name; ?></h3>
                                        <p><?php echo $pkgObj->slide2_detail; ?></p>
                                    </div>   
                                </div>
                            <?php } ?>
                            <?php if(!empty($pkgObj->slide3_img)) { ?>
                                <div class="carousel-item">
                                    <img src="/img_view/pkg3/<?php echo $pkgObj->id; ?>/0.5" alt="New York" width="1100" height="500px">
                                    <div class="carousel-caption br-20" style="background-color: rgb(0, 0, 0, 0.5);">
                                        <h3><?php echo $pkgObj->slide3_name; ?></h3>
                                        <p><?php echo $pkgObj->slide3_detail; ?></p>
                                    </div>   
                                </div>
                            <?php } ?>
                            </div>
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>
                                        <div class="card-img view">
                                            <img src="/img_view/pkg/<?php echo $pkgObj->id; ?>/0.3" width="100%">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex">
                                            <div class="ml-auto">
                                                <h3 class="card-title pricing-card-title"><?php echo number_format($pkgObj->adult_price, 0); ?> บาท <small class="text-muted">/ คน</small></h3>
                                            </div>
                                        </div>
                                    </li>
                                    <li>ระยะเวลา : <b><?php echo $pkgObj->duration; ?></b></li>
                                    <li>รองรับสูงสุด : <b><?php echo $pkgObj->adult_max + $pkgObj->child_max; ?> คน</b></li>
                                    <li>โปรโมชั่น : <?php echo $pkgObj->convertPromotion($pkgObj->promo_quantity, $pkgObj->promo_unit); ?></li>
                                    <li>ราคาสำหรับเด็ก : <b><?php echo number_format($pkgObj->child_price, 0); ?> บาท</b></li>
                                    <!-- <li>อัพเดทล่าสุด : <b>17 พ.ย. 2564</b></li> -->
                                    <li>รีวิว : 
                                        <b>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star text-warning"></span>
                                            <span class="fa fa-star-half-alt text-warning"></span>
                                        </b>
                                        (12)
                                    </li>
                                    <li>
                                        <a href="/travel/booking/<?php echo $pkgObj->id; ?>" class="btn btn-premium btn-block py-2 px-5 mt-4 br-30 text-white" style="font-weight: 650; font-size: 13px;">
                                            <b>เลือกซื้อแพ็คเกจนี้</b>
                                        </a>
                                        <!-- <a href="" class="btn btn-success btn-block br-20 mt-3">
                                            <b>เลือกซื้อแพ็คเกจนี้</b>
                                        </a> -->
                                    </li>
                                </ul>
                            </div>
                            <div class="col-lg-9">
                                <hr />
                                <h5><b>รายละเอียดเพิ่มเติมสำหรับ " แพ็คเกจท่องเที่ยว : <?php echo $pkgObj->name; ?> "</b></h5>
                                <hr />
                                <?php echo $pkgObj->detail; ?>
                            </div>
                            <!-- <div class="col-lg-12">
                                <hr />
                                <h5><b>แผนที่นำทางท่องเที่ยว " แพ็คเกจท่องเที่ยว : <?php echo $pkgObj->name; ?> "</b></h5>
                                <hr />
                                <iframe src="<?php echo $pkgObj->src_map; ?>" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$("body").css("background", "url('http://www.chppao.go.th/files/com_travel/2019-02_2b734e71d28ca12.jpg')");
$("body").css("background-size", "cover" );
$("body").css("background-position", "top center");
$("body").css("background-attachment", "fixed");
</script>

</body>
</html>