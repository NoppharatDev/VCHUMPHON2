<?php
    if(isset($_GET["page"])) {
        $p = $_GET["page"];
        if($p == 'pkg') { header( "location: /travel" ); }
        else if($p == 'prod') { header( "location: /robusta" ); }
        else if($p == 'prodp') { header( "location: /product" ); }
        else if($p == 'cart') { header( "location: /cart" ); }
        else if($p == 'prod_view') { header( "location: /robusta/{$_GET['id']}" ); }
        else if($p == 'pkg_view') { header( "location: /travel/{$_GET['id']}" ); }
        else { header( "location: /" ); }
    }
    $cart_count = 0;
    if(isset($_SESSION['my_cart']) && count($_SESSION['my_cart']) > 0) {
        $cart_count = count($_SESSION['my_cart']);
    }
?>
<style>
    .nav-item {
        font-size: 14px;
    }
</style>
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-navbar" style="padding: 11px 0">
    <div class="container">
        <!--
        <div class="d-none">
            <script type="text/javascript" language="javascript1.1" src="https://tracker.stats.in.th/tracker.php?sid=74223"></script>
            <noscript><a target="_blank" href="http://www.stats.in.th/">www.Stats.in.th</a></noscript>
        </div>
        -->
        <a class="navbar-brand" href="/">
            <img src="/image/logo.png" class="d-inline-block align-top" alt="VCHUMPON">
            <!-- <b><span class="fa fa-coffee mr-2"></span> VCHUMPHON</b> -->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item px-2 active">
                    <a href="/." class="nav-link" id="packageMenu">หน้าแรก</a>
                </li>
                <li class="nav-item px-2 active">
                    <a href="/travel" class="nav-link" id="packageMenu">แพ็คเกจท่องเที่ยว</a>
                </li>
                <li class="nav-item px-2 active">
                    <a href="/robusta" class="nav-link" id="cafeMenu">กาแฟโรบัสต้าพรีเมียม</a>
                </li>
                <li class="nav-item px-2 active">
                    <a href="/product" class="nav-link" id="aboutMenu">ผลิตภัณฑ์ชุมชน</a>
                </li>
                <li class="nav-item px-2 active">
                    <a href="/content" class="nav-link" id="contentMenu">ประชาสัมพันธ์</a>
                </li>
                <!-- <li class="nav-item px-2 active">
                    <a href="about.html" class="nav-link" id="aboutMenu">ร้านค้าที่เข้าร่วมโครงการ</a>
                </li> -->
                <li class="nav-item px-2 active">
                    <a href="#contact" class="nav-link" id="contactMenu">ติดต่อเรา</a>
                </li>
                <li class="nav-item px-2 active">
                    <a href="/cart" class="nav-link" id="contactMenu"><span class="fa fa-shopping-cart"></span> (<?php echo $cart_count; ?>)</a>
                </li>
                <?php
                    if(isset($_SESSION["cust_id"])) {
                ?>
                        <li class="nav-item px-2 active dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: 800; color: #CF952A;">
                                ชื่อผู้ใช้งาน
                            </a>
                            <div class="dropdown-menu border-0 shadow-sm" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/my_packages"><span class="fa fa-suitcase"></span> การจองของฉัน</a>
                                <a class="dropdown-item" href="/my_orders"><span class="fa fa-box-open"></span> รายการสั่งซื้อ</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="?page=logout"><span class="fa fa-sign-out-alt"></span> ออกจากระบบ</a>
                            </div>
                        </li>
                <?php
                    } else {
                        echo "<li class=\"nav-item px-2 active\">
                                <a href=\"/login\" class=\"nav-link btn btn-outline-warning btn-outline-tumb br-30 px-4\" id=\"contactMenu\">เข้าสู่ระบบ</a>
                            </li>";
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>