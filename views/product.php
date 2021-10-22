<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/Product.Class.php');
    $headObj = new HeadHTML();
    $prodObj = new Product();
    $cart_count = 0;
?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">

<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<!-- Present -->
<div style="background-image: url('../image/bg-1.jpg'); background-color: #FFF; background-size: cover; background-position: top center; background-attachment: fixed; padding: 12vh 0">
    <div class="container">
        <h1 class="text-center" style="color: #CF952A; font-weight: 800; font-size: 30px; padding-top: 40px">กาแฟโรบัสต้าพรีเมียม</h1>
        <div class="row">
            <div class="col-lg-12 pt-5 text-center">
                <video
                    id="myVideo"
                    class="br-30"
                    data-aos="zoom-ins"
                    data-aos-easing="ease-in-sine"
                    data-aos-duration="350"
                    width="100%"
                    controls
                    autoplay
                >
                    <source src="assets/video/1.mp4" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</div>

<div style="background-color: #f8f8f8;">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-1"></div>
        <?php
            $result = $prodObj->queryProducts(); $i = 1;
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>
            <div class="col-lg-5">
                <a href="robusta/<?php echo $row['prod_id']/*$prodObj->getLinkView($row['prod_id'], $row['prod_type'])*/; ?>">
                    <div class="card border-0 shadow-sm br-20">
                        <div class="card-body p-2">
                            <div class="card-img">
                                <img src="/<?php echo $prodObj->getImage($row['prod_id']); ?>" width="100%" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (<?php echo "{$row['prod_name']} ขนาด {$row['prod_weight']} กรัม" ?>)">
                            </div>
                            <div class="card-title text-center" style="font-weight: 600;">
                                <!-- -->
                                <a href="robusta/<?php echo $row['prod_id']/*$prodObj->getLinkView($row['prod_id'], $row['prod_type'])*/; ?>" class="card-link text-dark">
                                    <b><?php echo "{$row['prod_name']} ({$row['prod_weight']} กรัม)"; ?></b>
                                </a>
                            </div>
                            <!-- <div class="card-price d-flex mb-0">
                                <div class="mr-auto mr-2"><b class="text-info"><?php echo number_format($row['prod_price'],2); ?> </b> บาท</div>
                            </div>
                            <div class="text-warning" style="font-size: 12px;">
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star-half-alt"></span>
                                <span class="far fa-star"></span>
                                <a class="text-dark">(8)</a>
                            </div> -->
                            <div class="text-center mb-4">
                                <a href="robusta/<?php echo $row['prod_id']/*$prodObj->getLinkView($row['prod_id'], $row['prod_type'])*/; ?>" class="btn btn-premium py-2 px-5 mt-4 br-30 text-white" style="font-weight: 650; font-size: 18px;">สั่งซื้อสินค้า</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php
                    $i++;
                }
            }
        ?>
            <div class="col-lg-1"></div>
        </div>
    </div>
</div>

<!-- สไลด์ -->
<div style="background-image: url('image/bg-1.jpg'); background-color: #FFF; background-size: cover; background-position: top center; background-attachment: fixed; padding: 12vh 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div id="demo" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#demo" data-slide-to="0" class="active"></li>
                        <li data-target="#demo" data-slide-to="1"></li>
                        <li data-target="#demo" data-slide-to="2"></li>
                        <li data-target="#demo" data-slide-to="3"></li>
                        <li data-target="#demo" data-slide-to="4"></li>
                        <li data-target="#demo" data-slide-to="5"></li>
                        <li data-target="#demo" data-slide-to="6"></li>
                        <li data-target="#demo" data-slide-to="7"></li>
                        <li data-target="#demo" data-slide-to="8"></li>
                        <li data-target="#demo" data-slide-to="9"></li>
                    </ul>
                    <div class="carousel-inner br-30s">
                        <div class="carousel-item active">
                            <img src="../image/slide/ปกขั้นตอนการคัดกาแฟ-01.jpg" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการผลิตกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img src="../image/slide/ขั้นตอนการคัดกาแฟ1-02.jpg" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการตากกาแฟโรบัสต้า)" width="100%">
                        </div>
                        <div class="carousel-item">
                            <img src="../image/slide/ขั้นตอนการคัดกาแฟ1-03.jpg" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการอบลมร้อนกาแฟโรบัสต้า)" width="100%">
                        </div>
                        <div class="carousel-item">
                            <img src="../image/slide/ขั้นตอนการคัดกาแฟ1-04.jpg" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการบ่มกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img src="../image/slide/ขั้นตอนการคัดกาแฟ021-01.jpg" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการสีแห้งกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img src="../image/slide/ขั้นตอนการคัดกาแฟ021-02.jpg" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนกาคัดแยกเมล็ดกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img src="../image/slide/ขั้นตอนการคัดกาแฟ021-03.jpg" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการคั่วกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img src="../image/slide/ขั้นตอนการคัดกาแฟ021-04.jpg" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการเลือกเมล็ดกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img src="../image/slide/ขั้นตอนการคัดกาแฟ021-05.jpg" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการเลือกเมล็ดหลังคั่วกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#demo" data-slide="prev">
                        <span class="fa fa-chevron-left text-dark" style="font-size: 50px"></span>
                    </a>
                    <a class="carousel-control-next" href="#demo" data-slide="next">
                        <span class="fa fa-chevron-right text-dark" style="font-size: 50px"></span>
                    </a>
                </div>
            </div>
            <div class="col-lg-2"></div>
        </div>
    </div>
</div>

<script>
let vid = document.getElementById("myVideo");
vid.volume = 0.05;
$("body").css("background", "url('../../image/bg-coffee1.jpg')");
$("body").css("background-size", "cover" );
$("body").css("background-position", "top center");
$("body").css("background-attachment", "fixed");
</script>

</body>
</html>