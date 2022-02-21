<?php
if (!isset($_SESSION["cust_id"])) {
    header('Location: /login');
}
if (empty($id)) {
    echo '<script>window.location.assign("/travel")</script>';
    exit;
} else {
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once("components/Package.Class.php");
    $headObj = new HeadHTML();
    $pkgObj = new Package();
    $pkgObj->setPackageByID($id);
    /*$pkgObj->updateViewByID($_GET['id']);
        if(isset($_POST['add_cart'])) {
            $prodObj->addProdToCart($_GET['id']);
        }*/
    $cart_count = 0;
}
?>

<!DOCTYPE html>
<html lang="th">
<?php
echo $headObj->getHead();
?>

<body style="overflow-x: hidden">
    <?php
    if (isset($_POST["submit"])) {
        require_once("components/OrderPackage.Class.php");
        $opkgObj = new OrderPackage();
        $opkgObj->addOrderPackage($id);
    }
    ?>
    <?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

    <link rel="stylesheet" href="/assets/jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <script type="text/javascript" src="/assets/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
    <script type="text/javascript" src="/assets/jquery.Thailand.js/dependencies/zip.js/zip.js"></script>
    <script type="text/javascript" src="/assets/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="/assets/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>

    <style>
        .card-img {
            min-height: 220px;
            max-height: 220px;
        }
    </style>

    <div style="background: #F5F5F5; padding: 100px 0 145px 0;">
        <div class="container mt-3">
            <div class="row" id="cafePage">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-white shadow-sm br-20">
                            <li class="breadcrumb-item"><a href="." class="text-premium"><i class="fa fa-home"></i> หน้าแรก</a></li>
                            <li class="breadcrumb-item"><a href="/travel" class="text-premium"><i class="fa fa-suitcase-rolling"></i> แพ็คเกจท่องเที่ยว</a></li>
                            <li class="breadcrumb-item"><a href="/travel/<?php echo $pkgObj->id; ?>" class="text-premium"> แพ็คเกจท่องเที่ยว (<?php echo $pkgObj->name; ?>)</a></li>
                            <li class="breadcrumb-item active" aria-current="page">เลือกซื้อแพ็คเกจ</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm mb-4 box-shadow br-20">
                        <div class="card-body">
                            <h5 class="mb-4"><b>กรุณากรอกข้อมูลของท่าน</b></h5>
                            <form class="row" action="" method="POST" id="demo1" class="demo" autocomplete="on">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="first_name" class="mb-0">ชื่อ <b><sup class="text-danger">*</sup></b></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg br-20"
                                            id="first_name"
                                            name="first_name"
                                            placeholder="ชื่อ"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="last_name" class="mb-0">นามสกุล <b><sup class="text-danger">*</sup></b></label>
                                        <input
                                            type="text"
                                            class="form-control
                                            form-control-lg br-20"
                                            id="last_name"
                                            name="last_name"
                                            placeholder="นามสกุล"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="phone" class="mb-0">เบอร์โทรศัพท์ <b><sup class="text-danger">*</sup></b></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg br-20"
                                            id="phone"
                                            name="phone"
                                            placeholder="เบอร์โทรศัพท์"
                                            onkeypress="if(this.value.length==10) return false;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                            maxlength="10"
                                            pattern="[0]{1}[0-9]{9}"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email" class="mb-0">อีเมล <b><sup class="text-danger">*</sup></b></label>
                                        <input
                                            type="email"
                                            class="form-control form-control-lg br-20"
                                            id="email"
                                            name="email"
                                            placeholder="อีเมล"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="province" class="mb-0">จังหวัด <b><sup class="text-danger">*</sup></b></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg br-20"
                                            id="province"
                                            name="province"
                                            placeholder="จังหวัด"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="zipcode" class="mb-0">รหัสไปรษณีย์ <b><sup class="text-danger">*</sup></b></label>
                                        <input
                                            type="text"
                                            class="form-control form-control-lg br-20"
                                            id="zipcode"
                                            name="zipcode"
                                            placeholder="รหัสไปรษณีย์"
                                            onkeypress="if(this.value.length==5) return false;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
                                            maxlength="5"
                                            pattern="[0-9]{5}"
                                            required
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="travel_date" class="mb-0">วันที่เริ่มท่องเที่ยว (วัน/เดือน/ปี) <b><sup class="text-danger">*</sup></b></label>
                                        <input type="date" class="form-control form-control-lg br-20" id="travel_date" name="travel_date" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="adult" class="mb-0">จำนวนผู้ใหญ่ (<?php echo $pkgObj->adult_price; ?> / คน) <b><sup class="text-danger">*</sup></b></label>
                                        <select class="form-control form-control-lg br-20" id="adult" name="adult" required>
                                            <option>0</option>
                                            <?php
                                            for ($i = 1; $i <= $pkgObj->adult_max; $i++) {
                                                echo "<option>{$i}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="child" class="mb-0">จำนวนเด็ก (<?php echo $pkgObj->child_price; ?> / คน)</label>
                                        <select class="form-control form-control-lg br-20" id="child" name="child">
                                            <option>0</option>
                                            <?php
                                            for ($i = 1; $i <= $pkgObj->child_max; $i++) {
                                                echo "<option>{$i}</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="comment" class="mb-0">หมายเหตุ</label>
                                        <textarea class="form-control form-control-lg br-20" rows="5" id="comment" name="comment"></textarea>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">ท่านยอมรับ <a href="">ข้อกำหนดการใช้งาน</a> และ <a href="">นโยบายความเป็นส่วนตัว</a> ของเราเมื่อดำเนินการต่อ</label>
                                    </div>
                                    <?php
                                    if (isset($_SESSION["cust_id"])) {
                                        echo "<button type=\"submit\" name=\"submit\" class=\"btn btn-warning btn-premium btn-lg border-0 br-20 px-5\">ยืนยันการจอง</button>";
                                    } else {
                                        echo "<a href=\"/login\" class=\"btn btn-premium btn-block br-30 py-3\" name=\"send\">เข้าสู่ระบบ <span class=\"fa fa-sign-in-alt\"></span></a>";
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-0 mb-3 shadow-sm br-20">
                        <div class="card-body px-2 py-3">
                            <ul class="list-unstyled mb-0">
                                <li>
                                    <h5 class="ml-2"><b>แพ็คเกจท่องเที่ยว (<?php echo $pkgObj->name; ?>)</5>
                                            </h4>
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
                                <p class="ml-auto mb-1" id="adult_text">0</p>
                            </div>
                            <div class="d-flex">
                                <p class="mb-1">จำนวนเด็ก (<?php echo number_format($pkgObj->child_price, 0); ?> / คน)</p>
                                <p class="ml-auto mb-1" id="child_text">0</p>
                            </div>
                            <div class="d-flex">
                                <p class="mb-1">จำนวนรวม (คน)</p>
                                <p class="ml-auto mb-1" id="total_text">0</p>
                            </div>
                            <div class="d-flex">
                                <p class="mb-1">ราคารวม (บาท)</p>
                                <p class="ml-auto mb-1" id="total_price">0</p>
                            </div>
                            <div class="d-flex">
                                <p class="mb-1">ส่วนลด (<b>บาท<?php /*echo $pkgObj->convertPromotionUnit($pkgObj->promo_unit);*/ ?></b>)</p>
                                <p class="ml-auto mb-1" id="promo_text">0</p>
                            </div>
                            <div class="d-flex">
                                <p class="mb-1">ราคาที่จ่าย (บาท)</p>
                                <p class="ml-auto mb-1 text-premium" id="total_end"><b>0</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.Thailand({
            database: '/assets/jquery.Thailand.js/database/db.json',

            $district: $('#demo1 [name="district"]'),
            $amphoe: $('#demo1 [name="amphoe"]'),
            $province: $('#demo1 [name="province"]'),
            $zipcode: $('#demo1 [name="zipcode"]'),

            onDataFill: function(data) {
                console.info('Data Filled', data);
            },

            onLoad: function() {
                console.info('Autocomplete is ready!');
                // $('#loader, .demo').toggle();
            }
        });

        $('#demo1 [name="district"]').change(function() {
            console.log('ตำบล', this.value);
        });
        $('#demo1 [name="amphoe"]').change(function() {
            console.log('อำเภอ', this.value);
        });
        $('#demo1 [name="province"]').change(function() {
            console.log('จังหวัด', this.value);
        });
        $('#demo1 [name="zipcode"]').change(function() {
            console.log('รหัสไปรษณีย์', this.value);
        });


        // if($("#adult_price").val() >= 1) {  }
        $("#adult_text").text($("#adult").val());
        $("#adult").change(function() {
            $("#adult_text").text($("#adult").val());
        })

        $("#child_text").text($("#child").val());
        $("#child").change(function() {
            $("#child_text").text($("#child").val());
        })

        $("#adult, #child").change(function() {
            let adult = $("#adult").val();
            let child = $("#child").val();
            let total = parseInt(adult) + parseInt(child);
            let total_price = parseInt(adult * <?php echo $pkgObj->adult_price; ?>) + parseInt(child * <?php echo $pkgObj->child_price; ?>);
            let promo = 0;
            $("#total_text").text(total);
            $("#total_price").text(total_price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","))
            if (total >= <?php echo $pkgObj->start_reduce; ?>) {
                let promo_unit = <?php echo $pkgObj->promo_unit; ?>;
                if (promo_unit == 1) {
                    promo = (<?php echo $pkgObj->quantity ?> * total_price / 100);
                    $("#promo_text").text('-' + promo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                } else if (promo_unit == 2) {
                    promo = <?php echo $pkgObj->quantity ?>;
                    $("#promo_text").text('-' + promo.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                }
            } else {
                $("#promo_text").text(0);
            }
            let total_end = total_price - promo;
            if (total_end <= 0) {
                total_end = 0;
            }
            $("#total_end").text(total_end.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        })
    </script>

</body>

</html>