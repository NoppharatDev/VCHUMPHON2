<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/Package.Class.php');
    $headObj = new HeadHTML();
    $pkgObj = new Package();
    $cart_count = 0;
?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">

<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<style>
.btn-tumb {
    background-color: #CF952A;
    border-color: #CF952A;
    color: #FFF;
}
.btn-outline-tumb {
    border-color: #CF952A;
    color: #CF952A;
}
.btn-outline-tumb:hover {
    background-color: #CF952A;
    border-color: #CF952A;
    color: #FFF;
}
</style>

<div style="background: rgba(255,255,255,0.40); padding: 160px 0 145px 0;">
    <div class="container text-center">
        <img src="image/chumphon.png" width="38%">
    </div>
</div>

<div style="background-color: #FFF;">
    <div class="container">
        <div class="row py-5">
        <?php
            $result = $pkgObj->queryPackages(); $i = 1;
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>
                    <div class="col-lg-4">
                        <div class="card border-0 mb-4 shadow-sm text-center br-30">
                            <div class="card-body">
                                <h5 class="my-0 mb-4 package-title">
                                    <b><?php echo $row['pkg_name']; ?></b>
                                </h5>
                                <div class="card-img-pkg">
                                    <img src="img_view/pkg/<?php echo $pkgObj->getImage($row['pkg_id']); ?>/0.5" width="100%" alt="รวมสถานที่ท่องเที่ยวชุมพร <?php echo $row['pkg_name']; ?>">
                                </div>
                                <h1 class="card-title pricing-card-title"><?php echo number_format($row['pkg_adult_price'], 0); ?> <small class="text-muted">/ คน</small></h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li>ระยะเวลา <?php echo $row['pkg_duration']; ?></li>
                                    <li>สูงสุด <?php echo $row['pkg_adult_max'] + $row['pkg_child_max']; ?> คน</li>
                                    <li>ลดสูงสุด <?php echo $pkgObj->convertPromotion($row['pkg_promo_quantity'], $row['pkg_promo_unit']); ?></li>
                                    <li>ราคาสำหรับเด็ก <?php echo number_format($row['pkg_child_price'], 0); ?> บาท</li>
                                    <!-- <li>อัพเดทล่าสุด : 17 พ.ย. 2564</li> -->
                                </ul>
                                <a href="travel/<?php echo $row['pkg_id']; ?>" class="btn btn-block btn-outline-info btn-outline-tumb py-3 br-30">
                                    <b>รายละเอียดแพ็คเกจ</b>
                                </a>
                                <!--<a href="?page=pkg_view&id=<?php echo $row['pkg_id']; ?>" class="btn btn-block btn-outline-info br-10">
                                    <b>รายละเอียดแพ็คเกจ</b>
                                </a> -->
                            </div>
                        </div>
                    </div>
        <?php
                }
            }
        ?>
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