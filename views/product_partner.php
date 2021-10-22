<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/Product.Class.php');
    $headObj = new HeadHTML();
    $prodObj = new Product();
?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">
<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<div style="background-image: url('image/bg-1.jpg'); background-color: #FFF; background-size: cover; background-position: top center; background-attachment: fixed; padding: 12vh 0">
    <div class="container">
        <h1 class="text-center" style="color: #CF952A; font-weight: 800; font-size: 30px; padding-top: 40px">ผลิตภัณฑ์ชุมชน</h1>
    </div>
</div>

<div style="background-color: #f8f8f8;">
    <div class="container">
        <div class="row py-5">
        <?php
            $result = $prodObj->queryPartnerProducts(); $i = 1;
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
        ?>
            <div class="col-lg-4">
                <a href="<?php echo ($row['admin_id'] == '1') ? '/robusta' : '/product'?>/<?php echo $row['prod_id']; ?>">
                    <div class="card border-0 shadow-sm br-20">
                        <div class="card-body p-2">
                            <div class="card-img">
                                <img src="<?php echo $prodObj->getImage($row['prod_id']); ?>" width="100%" alt="<?php echo "{$row['prod_name']} ขนาด {$row['prod_weight']} กรัม"; ?>">
                            </div>
                            <div class="card-title text-center" style="font-weight: 600;">
                                <!-- -->
                                <a href="<?php echo ($row['admin_id'] == '1') ? '/robusta' : '/product'?>/<?php echo $row['prod_id']; ?>" class="card-link text-dark">
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
                                <a href="<?php echo ($row['admin_id'] == '1') ? '/robusta' : '/product'?>/<?php echo $row['prod_id']; ?>" class="btn btn-premium py-2 px-5 mt-4 br-30 text-white" style="font-weight: 650; font-size: 18px;">สั่งซื้อสินค้า</a>
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
        </div>
    </div>
</div>

</body>
</html>