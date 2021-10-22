<?php
    if(empty($_GET['id'])) {
        echo '<script>window.location.assign("?page=prod")</script>';
        exit;
    } else {
        require_once('components/Product.Class.php');
        $prodObj = new Product();
        $prodObj->setProductByID($_GET['id']);
    }
?>

<div style="background: rgba(255,255,255,0.40); padding: 160px 0 145px 0;">
    <div class="container text-center">
        <img src="image/chumphon.png" width="38%">
    </div>
</div>

<div style="background-color: #FFF;">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-9">
                <div class="card border-0 shadow-sm br-20">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="product-img">
                                    <img src="<?php echo $prodObj->getImage($prodObj->id); ?>" width="100%">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="d-flex product-title mb-4">
                                    <a class="card-link text-dark">
                                        <?php echo $prodObj->name; ?>
                                    </a>
                                </div>
                                <hr />
                                <p class="mb-2"><span class="fa fa-star"></span> รีวิว : <b>4.9/5.0</b></p>
                                <p class="mb-2"><span class="fa fa-eye"></span> การเข้าชม : <b><?php echo $prodObj->view; ?> ครั้ง</b></p>
                                <p class="mb-3"><span class="fa fa-store"></span> สถานะ : <?php echo $prodObj->convertStatus($prodObj->status, $prodObj->amount); ?></p>
                                <h3><b class="text-danger"><?php echo number_format($prodObj->price, 2); ?></b> <small>บาท</small></h3>
                                <hr />
                                <div class="row mt-3">
                                    <div class="col-lg-3 mt-1">
                                        <span class="mx-auto">จำนวน</span>
                                    </div>
                                    <div class="col-lg-4">
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
                                    <div class="col-lg-5">
                                        <a href="cart.html" class="btn btn-success btn-block br-30">
                                            <span class="fa fa-cart-plus"></span> เพิ่มลงตะกร้า
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm br-20">
                            <div class="card-body p-2">
                                <div class="card-img">
                                    <img src="//th-test-11.slatic.net/p/1535a70b36652559b2bc7a54116b57e1.jpg_720x720q80.jpg_.webp" width="100%">
                                </div>
                                <div class="d-flex card-title">
                                    <a href="product_view.html" class="card-link text-dark">
                                        กาแฟคั่ว โรบัสต้า 100% ถ้ำสิงห์ กลิ่นคั่วหอม คัดสรรโดย อ.ต.ก.
                                    </a>
                                </div>
                                <div class="card-price d-flex">
                                    <div class="ml-auto"><b> 165.00 </b> บาท</div>
                                </div>
                                <a href="product_view.html" class="btn btn-info btn-block br-30">รายละเอียดสินค้า</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm br-20">
                            <div class="card-body p-2">
                                <div class="card-img">
                                    <img src="https://cf.shopee.co.th/file/1c0990b97221189f37c6e4087d9cabd5" width="100%">
                                </div>
                                <div class="d-flex card-title">
                                    <a href="product_view.html" class="card-link text-dark">
                                        กาแฟถ้ำสิงห์สำเร็จรูปชนิดเกล็ด 100%
                                    </a>
                                </div>
                                <div class="card-price d-flex">
                                    <div class="ml-auto"><b> 160.00 </b> บาท</div>
                                </div>
                                <a href="product_view.html" class="btn btn-info btn-block br-30">รายละเอียดสินค้า</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card border-0 shadow-sm br-20">
                            <div class="card-body p-2">
                                <div class="card-img">
                                    <img src="//th-test-11.slatic.net/p/c45f34bff6a97d6594c6e852b12180ce.jpg_720x720q80.jpg_.webp" width="100%">
                                </div>
                                <div class="d-flex card-title">
                                    <a href="product_view.html" class="card-link text-dark">
                                        เมล็ดกาแฟคั่วถ้ำสิงห์
                                    </a>
                                </div>
                                <div class="card-price d-flex">
                                    <div class="ml-auto"><b> 160.00 </b> บาท</div>
                                </div>
                                <a href="product_view.html" class="btn btn-info btn-block br-30">รายละเอียดสินค้า</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$("body").css("background", "url('https://envato-shoebox-0.imgix.net/d260/042d-f845-4f23-88c9-d3b4a6951c35/C12A0522.jpg?auto=compress%2Cformat&fit=max&mark=https%3A%2F%2Felements-assets.envato.com%2Fstatic%2Fwatermark2.png&markalign=center%2Cmiddle&markalpha=18&w=1600&s=bf3b3a3ac19f72167613a0f1de1035dd')");
$("body").css("background-size", "cover" );
$("body").css("background-position", "top center");
$("body").css("background-attachment", "fixed");
</script>