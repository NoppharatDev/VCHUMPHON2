<?php
    // session_start();
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/Blog.Class.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/Package.Class.php");
    $headObj = new HeadHTML();
    $pkgObj = new Package();
    $blogObj = new Blog();
    $cart_count = 0;
?>
<!DOCTYPE html>
<html lang="th">
<?php
    $headObj->addMeta("<meta name=\"description\" content=\"VCHUMPON ขอพาทุกท่านมาทำความรู้จักกับ “กาแฟชุมพร” หนึ่งแหล่งปลูกกาแฟคุณภาพเยี่ยมของประเทศไทย\" />");
    $headObj->addLink("<link rel=\"stylesheet\" href=\"https://unpkg.com/aos@2.3.1/dist/aos.css\">");
    $headObj->addScript("<script src=\"https://unpkg.com/aos@2.3.1/dist/aos.js\"></script>");
    $headObj->addScript("<script src=\"https://www.google-analytics.com/analytics.js\"></script>");
    $headObj->addScript("
    <!-- Google Analytics -->
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
    
    ga('create', 'UA-XXXXX-Y', 'auto');
    ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->
    ");
    $headObj->addScript("
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5NSH6S6');</script>
    <!-- End Google Tag Manager -->
    ");
    $headObj->editTitleText(" - ทำความรู้จักกาแฟชุมพร โรบัสต้าที่โดดเด่นที่สุดในเมืองไทย");
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

<!-- สไลด์ท่องเที่ยว -->
<div style="background-color: #FFF; padding-bottom: 45px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 mb-4 text-center">
                <h1 style="color: #CF952A; font-weight: 800; font-size: 30px; padding-top: 135px;">ท่องเที่ยวชุมชนถ้ำสิงห์</h1>
            </div>
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
                        <li data-target="#demo" data-slide-to="10"></li>
                        <li data-target="#demo" data-slide-to="11"></li>
                        <li data-target="#demo" data-slide-to="12"></li>
                        <li data-target="#demo" data-slide-to="13"></li>
                        <li data-target="#demo" data-slide-to="14"></li>
                        <li data-target="#demo" data-slide-to="15"></li>
                        <li data-target="#demo" data-slide-to="16"></li>
                        <li data-target="#demo" data-slide-to="17"></li>
                    </ul>
                    <div class="carousel-inner br-30s" style="max-height: 45vh; border-radius: 25px; overflow: hidden; display: flex; align-items: center;">
                        <div class="carousel-item active">
                            <img class="lazyload" data-src="../image/travel/tv0.jpeg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv1.jpeg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv2.jpg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%">
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv2.5.jpg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv3.jpg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%">
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv4.jpg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv5.jpg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv5.5.jpeg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv6.jpeg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv7.jpeg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv8.jpg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv9.jpeg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv9.5.jpeg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv10.jpeg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv11.jpeg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv12.jpg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv13.jpeg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/travel/tv14.jpg" alt="ท่องเที่ยวชุมชนถ้ำสิงห์" width="100%" height="100%"> 
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

<!-- แผนที่แสดงจุดท่องเที่ยว -->
<div style="background-color: #FFF; padding-top: 25px">
    <div class="container">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10" style="border-radius: 25px; overflow: hidden">
                <img src="../image/map.jpg" width="100%" style="border-radius: 65px">
            </div>
        </div>
    </div>
</div>

<!-- แนะนำการท่องเที่ยว -->
<div style="background-color: #FFF; padding: 10vh 0;">
    <div class="container text-center">
        <h3 style="color: #CF952A; font-weight: 800; font-size: 30px; margin-bottom: 50px">แนะนำการท่องเที่ยว</h3>
        <button class="btn btn-warning btn-lg br-20 px-4 mr-3 btn-tumb" id="t1">ตำบลถ้ำสิงห์</button>
        <button class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t2">ตำบลนาสัก</button>
        <button class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t3">ตำบลท่ามะพลา</button>
        <button class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">ตำบลนาทุ่ง</button>
    </div>
</div>

<!-- ตำบลถ้ำสิงห์ -->
<div class="d-block" id="item_t1" style="background-color: #FFF;">
    <div class="container">
        <div class="row" style="overflow-x: hidden; overflow-y: hidden;">
            <div class="col-lg-5 mb-5">
                <img
                    class="lazyload br-15 shadow"
                    data-aos="sfade-down-right"
                    data-aos-easing="ease-in-sine"
                    data-aos-duration="500"
                    data-src="../image/เขาร้อยยอด.webp"
                    width="100%"
                    alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                >
            </div>
            <div class="col-lg-7 mb-5">
                <h5 class="text-center text-premium my-3" data-aos="sfade-up-left" data-aos-duration="500" style="font-weight: 800;">เขาร้อยยอดและผาตาอู๊ด</h5>
                <p
                    data-aos="sfade-left"
                    data-aos-easing="ease-in-sine"
                    data-aos-duration="1200"
                    style="text-indent: 50px; text-align: justify;"
                >
                    พิชิต...เขาร้อยยอด จุดชมวิวที่สูงที่สุดในตัวเมืองชุมพร ยอดเขาหินเล็กๆ รองรับประมาณ 10-20 คน สามารถมองเห็นวิวได้โดยรอบ มองเห็นยอดเขามากมายหลายร้อยยอด
                </p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.1203348334816!2d99.06597811479759!3d10.41201639256943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x305603386ed914ad%3A0x219143dcc76e4d03!2z4Lic4Liy4LiV4Liy4Lit4Li54LmK4LiU!5e0!3m2!1sth!2sth!4v1648025327544!5m2!1sth!2sth" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                <a href="https://goo.gl/maps/rk3Uwbe4rHRQJVi6A" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
            </div>
            <div class="col-lg-7 mb-5">
                <h5 class="text-center text-premium my-3" data-aos="sfade-up-right" data-aos-duration="500" style="font-weight: 800;">เขาถ้ำศิลางู</h5>
                <p
                    data-aos="sfade-right"
                    data-aos-easing="ease-in-sine"
                    data-aos-duration="1200"
                    style="text-indent: 50px; text-align: justify;"
                >
                    เขาถ้ำศิลางู ธรรมชาติที่มีเรื่องเล่า ท่านนายกก้อย นายก อบต.ถ้ำสิงห์ให้เกียรติเล่าให้ฟังว่ามีชาวบ้านฝันเห็นงูใหญ่ ณ ที่แห่งนี้ จึงมีประเพณีประจำปีเพื่อสักการะพ่อท่านพญานาคราช ทุกวันที่ 13 เมษายน ของทุกปี หน้าถ้ำจะมีแท่นหินที่ธรรมชาติปั้นแต่งได้เหมือนพญานาคราชและมีบริวารงูตัวเล็กๆที่เกิดจากหินย้อยมากมายหลายตัว ที่เที่ยวอีกที่ที่ต้องไปใน จ.ชุมพร
                </p>
                <a href="https://goo.gl/maps/8bABhSmabJqsnAi3A" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.056962269918!2d99.04488071479764!3d10.417050792566013!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30560379cb2a7241%3A0xe6d5c6ae6167a070!2z4LiW4LmJ4Liz4Lio4Li04Lil4Liy4LiH4Li5!5e0!3m2!1sth!2sth!4v1648024671598!5m2!1sth!2sth" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-lg-5 mb-5">
                <img
                    class="lazyload br-15 shadow"
                    data-aos="sfade-up-left"
                    data-aos-easing="ease-in-sine"
                    data-aos-duration="500"
                    data-src="../image/ถ้ำศิลางู.webp"
                    width="100%"
                    alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                >
            </div>
        </div>
    </div>

    <div style="background-image: url('image/ถ้ำศิลางู.webp'); background-size: cover; background-position: top center; background-attachment: fixed; min-height: 60vh;">
        <div style="background-color: rgb(0, 0, 0, 0.5);">
            <div class="container" style="padding-top: 60px; padding-bottom: 60px;">
                <div style="background-color: rgba(255, 255, 255, 0.8); border-radius: 25px;">
                    <div class="p-4">
                        <div class="row" style="overflow-x: hidden; overflow-y: hidden;">
                            <div class="col-lg-12 text-center mb-4">
                                <h3 class="text-premium" style="font-weight: 800; font-size: 30px;">ประวัติความเป็นมาตำบลถ้ำสิงห์</h3>
                            </div>
                            <div class="col-lg-3">
                                <h5
                                    data-aos="sfade-up-left"
                                    data-aos-duration="800"
                                    class="text-center mb-3"
                                    style="font-weight: 800;"
                                >
                                    ประวัติความเป็นมา
                                </h5>
                                <p
                                    data-aos="sfade-left"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="1200"
                                    style="text-indent: 50px; text-align: justify;"
                                >
                                ตำบลถ้ำสิงห์ อำเภอเมืองชุมพร จังหวัดชุมพร เมื่อสมัยก่อนมีลักษณะภูมิประเทศเป็นป่าทึบประกอบไปด้วยภูเขา ที่บ้านถ้ำสิงห์ หมู่ที่ 1 ตำบลถ้ำสิงห์ ในปัจจุบันมีภูเขาอยู่ลูกหนึ่งซึ่งใหญ่โตมาก มองดูจากที่ไกลคล้ายรูปสิงห์โตกำลังหมอบอยู่ลักษณะอ้าปาก ปากที่อ้าก็คือถ้ำภายในถ้ำมีหินงอกตามธรรมชาติ มีลักษณะคล้ายสิงห์โตอยู่อีกตัวหนึ่ง ซึ่งเป็นที่รู้จักและเคารพนับถือของชาวบ้าน เลยเรียกกันว่า ถ้ำสิงห์
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <img
                                    class="lazyload shadow br-15"
                                    data-aos="szoom-in"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="500"
                                    data-src="../image/ถ้ำศิลางู.webp"
                                    width="100%"
                                    alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                                >
                            </div>
                            <div class="col-lg-3">
                                <h5
                                    data-aos="sfade-up-right"
                                    data-aos-duration="800"
                                    class="text-center mb-3"
                                    style="font-weight: 800;"
                                >
                                    เขตการปกครอง
                                </h5>
                                <p
                                    data-aos="sfade-right"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="1200"
                                    style="text-indent: 50px; text-align: justify;"
                                >
                                    ตำบลถ้ำสิงห์ อำเภอเมืองชุมพร จังหวัดชุมพร ตั้งอยู่ทางตอนใต้ของอำเภอ ห่างจากที่ว่าการอำเภอเมืองชุมพร ระยะทาง 24 กิโลเมตร
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="background-image: url('image/tum.png'); background-size: cover; background-position: top center; background-attachment: fixed; min-height: 60vh;">
        <div style="background-color: rgb(0, 0, 0, 0.5);">
            <div class="container" style="padding-bottom: 60px;">
                <div style="background-color: rgba(255, 255, 255, 0.8); border-radius: 25px;">
                    <div class="p-4">
                        <div class="row" style="overflow-x: hidden; overflow-y: hidden;">
                            <div class="col-lg-12 text-center mb-4">
                                <h3 class="text-premium" style="font-weight: 800; font-size: 30px;">ประวัติความเป็นมาของกาแฟถ้ำสิงห์</h3>
                            </div>
                            <div class="col-lg-6">
                                <h5
                                    data-aos="sfade-up-left"
                                    data-aos-duration="800"
                                    class="text-center mb-3"
                                    style="font-weight: 800;"
                                >
                                    ประวัติความเป็นมา
                                </h5>
                                <p
                                    data-aos="sfade-left"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="1200"
                                    style="text-indent: 50px; text-align: justify;"
                                >
                                ตำบลถ้ำสิงห์ อำเภอเมืองชุมพร จังหวัดชุมพร เมื่อสมัยก่อนมีลักษณะภูมิประเทศเป็นป่าทึบประกอบไปด้วยภูเขา ที่บ้านถ้ำสิงห์ หมู่ที่ 1 ตำบลถ้ำสิงห์ ในปัจจุบันมีภูเขาอยู่ลูกหนึ่งซึ่งใหญ่โตมาก มองดูจากที่ไกลคล้ายรูปสิงห์โตกำลังหมอบอยู่ลักษณะอ้าปาก ปากที่อ้าก็คือถ้ำภายในถ้ำมีหินงอกตามธรรมชาติ มีลักษณะคล้ายสิงห์โตอยู่อีกตัวหนึ่ง ซึ่งเป็นที่รู้จักและเคารพนับถือของชาวบ้าน เลยเรียกกันว่า ถ้ำสิงห์
                                </p>
                                <p>ต่อมาเมื่อมีผลผลิตเพิ่มมากขึ้นจึงได้รวมกลุ่มกันไปขายให้กับบริษัทผงไทยหรือเนสเล่ห์ในปัจจุบัน ที่กรุงเทพมหานคร สร้างความร่ำรวยให้กับเกษตรกรเป็นอย่างมากจนเป็นที่รู้จักของพ่อค้า แม่ค้าในตลาดชุมพรว่าคนถ้ำสิงห์ซื้อของง่าย ใช้เงินคล่อง</p>
                                <div class="d-none" id="moreTumText">
                                    <p>ปี พ.ศ  2522 ราคากาแฟขึ้นสูงสุดถึง 120 บาท/กิโลกรัมเป็นประวัติการณ์ เกษตรกรมีเงินเก็บและฝากไว้กับธนาคารเป็นจำนวนมากและเริ่มมองหาพื้นที่ปลูกกาแฟเพิ่มจึงได้ไปจับจอง ซื้อที่ดิน ที่ปากจั่น อำเภอกระบุรี ที่เขาค่าย เขาทะลุ ที่รับร่อ สลุย อำเภอท่าแซะ ทำให้พื้นที่ปลูกกาแฟขยายเพิ่มขึ้นอย่างรวดเร็วของจังหวัดชุมพร</p>
                                    <p>ปี พ.ศ 2530 ราคากาแฟเริ่มตกต่ำ ผลผลิตต่อไร่เริ่มลดลงราคาไม่จูงใจต่อการมีอาชีพปลูกกาแฟ เกษตรกรเริ่มมีปัญหาเรื่องราคาผลิตแล้วไม่คุ้มทุน เริ่มมีการประท้วงให้รัฐบาลเข้ามาประกันราคาขั้นต่ำ</p>
                                    <p>ปี พ.ศ 2530 รัฐบาลสมัยนั้นจึงเริ่มโครงการลดพื้นที่ปลูกกาแฟเพื่อมิให้กาแฟล้นตลาดโดยให้เงินสนับสนุนไร่ละ 6,800 บาท เกษตรกรจึงเข้าร่วมโครงการลดพื้นที่ปลูกกาแฟ ทำให้กาแฟถ้ำสิงห์ลดลงเหลือประมาณ 10 %ของพื้นที่ปลูกกาแฟทั้งหมด</p>
                                    <p>เมื่อตัดต้นกาแฟหมดจึงเหลือเพียง ทุเรียน มังคุด กล้วยหอม เกษตรกรจึงเริ่มมาทำทุเรียนนอกฤดู ผลผลิตที่ได้จึงมีราคาสูง สร้างความร่ำรวยให้กับเกษตรกรอีกครั้งหนึ่ง แต่เมื่อมีการทำทุเรียนนอกฤดูเพิ่มขึ้นอย่างไม่มีการควบคุมสุดท้ายก็ทำให้ราคาผลผลิตทุเรียนนอกฤดูใกล้เคียงกับราคาทุเรียนในฤดูกาล ทำให้เกษตรกรผลิตแล้วไม่คุ้มทุน ประกอบกับเมื่อมีการปลูกพืชเชิงเดี่ยวกันมากทำให้โรคแมลงระบาดอย่างรวดเร็ว ทุเรียนล้มตายเป็นจำนวนมาก  เงินทองที่เก็บไว้เริ่มหมดจึงได้ไปกู้เงินจากสถาบันการเงินของรัฐ และเอกชนรวมทั้งเงินกู้นอกระบบเพื่อที่จะเอามาลงทุนในสวนทุเรียนนอกฤดูแต่ก็ล้มเหลวเนื่องจากพืชมีความต้านทานต่อสารเคมี ผลผลิตจึงไม่ออกตามที่ต้องการ จำเป็นต้องใช้สารเคมีอย่างเข้มข้นเพิ่มขึ้น ทำให้เพิ่มต้นทุนการผลิตเมื่อได้ระยะเวลาเก็บเกี่ยวก็มาประสบกับปัญหาราคาต่ำเงินที่ได้มามีไม่เพียงพอต่อการนำไปชำระหนี้ เมื่อเป็นเช่นนี้ก็ต้องมีการค้างชำระหนี้ เรื่อยมา</p>
                                    <p>จากอดีตที่เคยเฟื่องฟูกับอับเฉาในวันนี้ อันเนื่องมาจากเกษตรกรนิยมปลูกพืชเชิงเดี่ยว ซึ่งให้ผลผลิตครั้งเดียวในรอบปีผิดกับเมื่อก่อนปลูกพืชผสมผสานคือมีกาแฟเป็นพืชหลัก ทุเรียน มังคุด กล้วยหอมเป็นพืชรอง จึงทำให้มีรายได้ตลอดปี ความเป็นอยู่ของเกษตรกรจึงไม่เดือดร้อน พึ่งพาตนเองได้อย่างสบาย กาแฟถ้ำสิงห์จึงถือกำเนิดขึ้นจากเหตุปัจจัยดังกล่าว</p>
                                </div>
                                <button class="btn btn-outline-warning br-20 px-4 mr-3 btn-outline-tumb" id="moreTum">อ่านต่อ...</button>
                                <button class="btn btn-outline-warning br-20 px-4 mr-3 btn-outline-tumb d-none" id="moreTum">ย่อข้อความ</button>
                            </div>
                            <div class="col-lg-6">
                                <img
                                    class="lazyload shadow br-15"
                                    data-aos="szoom-in"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="500"
                                    data-src="../image/tum.png"
                                    width="100%"
                                    alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                                >
                            </div>
                            <div class="col-12 mt-3 text-center">
                                <iframe class="mb-3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.866027311514!2d99.06182481479777!3d10.432204392555654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3056032e0989d781%3A0x878f3fc91c7e64da!2z4Lin4Li04Liq4Liy4Lir4LiB4Li04LiI4LiK4Li44Lih4LiK4LiZ4LiB4Lil4Li44LmI4Lih4LiB4Liy4LmB4Lif4Lia4LmJ4Liy4LiZ4LiW4LmJ4Liz4Liq4Li04LiH4Lir4LmM!5e0!3m2!1sth!2sth!4v1648025995051!5m2!1sth!2sth" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                <a href="https://goo.gl/maps/jAr4JZFu1qMY6sDL7" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ตำบลนาสัก -->
<div class="d-none" id="item_t2">
    <div style="background-color: #FFF;">
        <div class="container">
            <div class="row" style="overflow-x: hidden; overflow-y: hidden;">
                <div class="col-lg-7 mb-5">
                    <h5 class="text-center text-premium my-3" data-aos="sfade-up-left" data-aos-duration="500" style="font-weight: 800;">ถ้ำน้ำลอดใหญ่</h5>
                    <p
                        data-aos="sfade-left"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="1200"
                        style="text-indent: 50px; text-align: justify;"
                    >
                        ถ้ำธารลอดตั้งอยู่ที่ หมู่ที่ ๑๘ ตำบลนาสัก อำเภอสวี จังหวัดชุมพร เป็นแหล่งท่องเที่ยวเชิงอนุรักษ์ มีหินงอกหินย้อยภายในถ้ำ ที่สำคัญมีน้ำไหลผ่านถ้ำทั้งปี สามารถเข้าชมได้เฉพาะช่วงฤดูแล้งประมาณเดือนกุมภาพันธ์ถึงเดือนพฤษภาคมของทุกปี และจะมีกิจกรรมเปิดถ้ำกินฟรีช่วงเทศการสงกรานต์ของทุกปี ซึ่งดำเนินการโดยองค์การบริหารส่วนตำบลนาสักร่วมกับประชาชนในพื้นที่และหน่วยงานราชการห้างร้านต่างๆให้การสนับสนุนกิจกรรม
                    </p>
                    <a href="https://goo.gl/maps/BnEPxHCpETELqdec7" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3904664.121823996!2d96.5309263!3d17.1142514!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30d06fd91af19d1d%3A0x6a19224c76e57e7a!2z4LiW4LmJ4Liz4LiZ4LmJ4Liz4Lil4Lit4LiU!5e0!3m2!1sth!2sth!4v1648025750156!5m2!1sth!2sth" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-lg-5 mb-5">
                    <img
                        class="lazyload br-15 shadow"
                        data-aos="sfade-down-left"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="500"
                        data-src="../image/เขาตาหมื่นนี1.webp"
                        width="100%"
                        alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                    >
                </div>
                <div class="col-lg-5 mb-5">
                    <img
                        class="lazyload br-15 shadow"
                        data-aos="sfade-up-right"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="500"
                        data-src="../image/เขาตาหมื่นนี.webp"
                        width="100%"
                        alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                    >
                </div>
                <div class="col-lg-7 mb-5">
                    <h5 class="text-center text-premium my-3" data-aos="sfade-up-right" data-aos-duration="500" style="font-weight: 800;">เขาตาหมื่นนี</h5>
                    <p
                        data-aos="sfade-right"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="1200"
                        style="text-indent: 50px; text-align: justify;"
                    >
                        ที่ท่องเที่ยวแห่งใหม่แนวผจญภัย ปีนเขา เดินป่าบนสันเขา ชมดวงตะวันขึ้นขอบฟ้าริมเลอ่าวไทย สัมผัสทะเลหมอกยามเช้า แลดวงตะวันตกชายเขาทะลุ บรรยากาศสวยงามใกล้บ้านเรา
                        เหมาะกับทุกเพศทุกวัย นักท่องเที่ยว สามารถขับรถยนต์ขึ้นบนเขาได้ ส่วนการเดิน เดินประมาณ ๒๐๐ เมตร ขึ้นไปยังชมจุดชมวิว
                        การกางเต็นท์นอน ให้ประสานไปที่ เบอร์โทรของ อบต. ทาง อบต.จะประสานไห้ ผู้ใหญ่บ้านในพื้นที่ หรือเจ้าหน้าที่ผู้เกี่ยวข้อง นำพาไป
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3926.77289849013!2d99.02385836479581!3d10.199089192714867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30560d06cf5111b7%3A0x833a4b5424979b30!2z4LmA4LiC4Liy4LiV4Liy4Lir4Lih4Li34LmI4LiZ4LiZ4Li1!5e0!3m2!1sth!2sth!4v1648026654247!5m2!1sth!2sth" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <a href="https://goo.gl/maps/z5c1dAWY8fc6wD7F6" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
                </div>
                <div class="col-lg-7 mb-5">
                    <h5 class="text-center text-premium my-3" data-aos="sfade-up-left" data-aos-duration="500" style="font-weight: 800;">กลุ่มหม่อนไหมวิสาหกิจชุมชนบ้านป่ากล้วย</h5>
                    <p
                        data-aos="sfade-left"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="1200"
                        style="text-indent: 50px; text-align: justify;"
                    >
                    กลุ่มหม่อนไหมวิสาหกิจชุมชนบ้านสมัยตั้งแต่ก่อนปี 2549 ได้มี หนึ่งในสมาชิกกลุ่มหม่อนไหมวิสาหกิจชุมชนบ้านป่ากล้วยได้ย้ายถิ่นฐานมาจากจังหวัดนครราชสีมา เป็นคนที่รู้วิธีการปลูกหม่อนไหมเป็นอย่างดีจึงมีความคิดที่อยากตั้งกลุ่มขึ้นมาด้วยเหตุผลว่าทำคนเดียวไม่ไหว จึงเริ่มจากการปลูก มาทอให้เป็นลวดลายต่าง ๆ เช่น ลายใบกล้วย ลายอัตลักษณ์ ลายดอกกาแฟ ลายนกนางแอ่น ลายสมอพร ลายพุทธรักษา ลายเขาทะลุ ล้วนเป็นลายผ้าไหมที่สามารถสร้างรายได้เป็นอย่างดี นอกจากนี้สีที่ใช้ย้อมผ้าส่วนจะใช้สีธรรมชาติที่ได้จากวัตถุดิบในพื้นที่ เช่น สีแดงจากแก่นฝาง สีน้ำตาลจากใบกาแฟ ซึ่งเป็นจุดเน้น ให้มีความน่าสนใจเป็นจำนวนมาก และได้ตราพระราชทานสีเงินและสีน้ำเงิน สืบสานให้ลูกหลานและคนอื่น ๆ ได้สืบทอดด้วยความหวงแหนและมีคุณค่าตลอดไปตราบนานเท่านาน
                    </p>
                    <a href="https://goo.gl/maps/BnEPxHCpETELqdec7" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3904664.121823996!2d96.5309263!3d17.1142514!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30d06fd91af19d1d%3A0x6a19224c76e57e7a!2z4LiW4LmJ4Liz4LiZ4LmJ4Liz4Lil4Lit4LiU!5e0!3m2!1sth!2sth!4v1648025750156!5m2!1sth!2sth" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-lg-5 mb-5">
                    <img
                        class="lazyload br-15 shadow"
                        data-aos="sfade-down-left"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="500"
                        data-src="../image/กลุ่มหม่อนไหมวิสาหกิจชุมชนบ้านป่ากล้วย.jpg"
                        width="100%"
                        alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                    >
                </div>
            </div>
        </div>
    </div>

    <div style="background-image: url('image/เขาตาหมื่นนี1.webp'); background-size: cover; background-position: top center; background-attachment: fixed; min-height: 60vh;">
        <div style="background-color: rgb(0, 0, 0, 0.3);">
            <div class="container" style="padding-top: 60px; padding-bottom: 60px;">
                <div style="background-color: rgba(255, 255, 255, 0.8); border-radius: 25px;">
                    <div class="p-4">
                        <div class="row" style="overflow-x: hidden">
                            <div class="col-lg-12 text-center mb-4">
                                <h3 class="text-premium" style="font-weight: 800; font-size: 30px;">ประวัติความเป็นมาตำบลนาสัก</h3>
                            </div>
                            <div class="col-lg-3">
                                <h5
                                    data-aos="sfade-up-left"
                                    data-aos-duration="800"
                                    class="text-center mb-3"
                                    style="font-weight: 800;"
                                >
                                    ประวัติความเป็นมา
                                </h5>
                                <p
                                    data-aos="sfade-left"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="1200"
                                    style="text-indent: 50px; text-align: justify;"
                                >
                                    ในอดีตได้มีผู้มีวิชาทางด้านไสยศาสตร์ คนหนึ่งได้มาตั้งสำนักอยู่ที่กลางทุ่งนาแห่งนี้ และ ได้รับสักร่างกายอยู่ยงคงกระพันและมีลูกศิษย์อยู่มากมาย มีชื่อเสียงมากตั้งแต่นั้นมาชาวบ้านแถบนั้นจึงเรียกว่า นาสัก
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <img
                                    class="lazyload shadow br-15"
                                    data-aos="szoom-in"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="500"
                                    data-src="../image/เขาตาหมื่นนี.webp"
                                    width="100%"
                                    alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                                >
                            </div>
                            <div class="col-lg-3">
                                <h5
                                    data-aos="sfade-up-right"
                                    data-aos-duration="800"
                                    class="text-center mb-3"
                                    style="font-weight: 800;"
                                >
                                    เขตการปกครอง
                                </h5>
                                <p
                                    data-aos="sfade-right"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="1200"
                                    style="text-indent: 50px; text-align: justify;"
                                >
                                    ตำบลนาสักเป็นชุมชนขนาดใหญ่มี 17 หมู่บ้าน ชาวบ้านส่วนใหญ่มีอาชีพเกษตรกร ภูมิประเทศโดยทั่วไปเป็นที่ราบล้อมรอบด้วยภูเขา มีเนื้อที่ประมาณ 1,650 ตารางกิโลเมตร
                                </p>
                            </div>
                            <!-- <div class="col-lg-12 text-center mt-3">
                                <b 
                                    data-aos="szoom-in"
                                    data-aos-duration="500"
                                    class="badge badge-premium py-2 px-3 br-15 mr-2"
                                >
                                    อาชีพหลัก
                                </b>
                                <span data-aos="szoom-in" data-aos-duration="2000">ทำสวน/ทำไร่</span>
                                <b 
                                    data-aos="szoom-in"
                                    data-aos-duration="500"
                                    class="badge badge-premium py-2 px-3 br-15 mr-2 ml-4"
                                >
                                    อาชีพเสริม
                                </b>
                                <span data-aos="szoom-in" data-aos-duration="2000">รับจ้าง</span>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ตำบลท่ามะพลา -->
<div class="d-none" id="item_t3">
    <div style="background-color: #FFF;">
        <div class="container">
            <div class="row" style="overflow-x: hidden; overflow-y: hidden;">
                <div class="col-lg-5 mb-5">
                    <img
                        class="lazyload br-15 shadow"
                        data-aos="sfade-up-right"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="500"
                        data-src="../image/สวนสมเด็จพระศรีนครินทร์.webp"
                        width="100%"
                        alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                    >
                </div>
                <div class="col-lg-7 mb-5">
                    <h5 class="text-center text-premium my-3" data-aos="sfade-up-right" data-aos-duration="500" style="font-weight: 800;">สวนสมเด็จพระศรีนครินทร์ ชุมพร</h5>
                    <p
                        data-aos="sfade-right"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="1200"
                        style="text-indent: 50px; text-align: justify;"
                    >
                        ใครที่จะมาอำเภอหลังสวน จังหวัดชุมพร ขอแนะนำสถานที่ท่องเที่ยวอีกหนึ่งจุดที่มีนักท่องเที่ยวแวะมาสัมผัสกับบรรยากาศร่มรื่นเย็นสบาย มีพรรณไม้นานาพันธุ์ มีการจัดสวนได้อย่างสวยงาม ที่สำคัญเป็นที่ประทับของรูปปั้นสมเด็จพระศรีนครินทราบรมราชนนี ด้านหลังเป็นภูเขา มีทางเดินขึ้นถ้ำด้วยการตกแต่งราวบันไดเป็นพญานาคยาวไปถึงหน้าถ้ำ และบนถ้ำมีพระพุทธรูปให้ได้กราบไหว้ มีหินงอกหินย้อยให้ได้ชื่นชมมองลงมาจากด้านล่างจะเห็นวิวทิวทัศน์ที่สวยงามส่วนอีกด้านหนึ่งของถ้ำจะมีลิงนับร้อยตัวและมีศาลาให้นั่งพักผ่อนริมแม่น้ำ
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.8396231332777!2d99.03716001479378!3d9.947298492887299!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30567a99e5296d2d%3A0xa49dba0ca34a5099!2z4Liq4Lin4LiZ4Liq4Lih4LmA4LiU4LmH4LiI4Lie4Lij4Liw4Lio4Lij4Li14LiZ4LiE4Lij4Li04LiZ4LiX4Lij4LmMIOC4iuC4uOC4oeC4nuC4ow!5e0!3m2!1sth!2sth!4v1648025668240!5m2!1sth!2sth" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <a href="https://goo.gl/maps/GPD3o1SeCt7MccS8A" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
                </div>
                <div class="col-lg-7 mb-5">
                    <h5 class="text-center text-premium my-3" data-aos="sfade-up-left" data-aos-duration="500" style="font-weight: 800;">วัดถ้ำเขาเงิน</h5>
                    <p
                        data-aos="sfade-left"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="1200"
                        style="text-indent: 50px; text-align: justify;"
                    >
                        อีกหนึ่งวัดดังในพื้นที่อำเภอหลังสวน ที่มีนักท่องเที่ยวแวะเวียนเข้าไปชื่นชมความสวยงามของตัวโบสถ์ที่สร้างเป็นเรือสุพรรณหงษ์ มีความสวยงามโดดเด่นมาก โดยบริเวณรอบเรือมีน้ำและดอกบัวล้อมรอบ เมื่อจะเข้าโบสถ์ต้องผ่านบันไดพญานาค ซึ่งมีลวดลายวิจิตรศิลป์น่าชวนให้หลงไหลยิ่งนัก สำหรับนักท่องเที่ยวที่แวะเวียนมาจะเข้ามาสักการะร่างของพ่อหลวงคล้อยที่ไม่เน่าไม่เปื่อย ซึ่งเป็นที่เคารพและศรัทธาของประชาชนทั่วไป
                    </p>
                    <a href="https://goo.gl/maps/zHLqJZ5umSB5Uv9t7" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3304.565918598162!2d99.04210739848364!3d9.949486364018652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30567a9bac1e12df%3A0xed87ae136ae2c5be!2z4Lin4Lix4LiU4LiW4LmJ4Liz4LmA4LiC4Liy4LmA4LiH4Li04LiZ!5e0!3m2!1sth!2sth!4v1648025572955!5m2!1sth!2sth" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-lg-5 mb-5">
                    <img
                        class="br-15 shadow"
                        data-aos="sfade-down-left"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="500"
                        src="../image/วัดถ้ำเขาเงิน.webp"
                        data-src="../image/วัดถ้ำเขาเงิน.webp"
                        width="100%"
                        alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                    >
                </div>
            </div>
        </div>
    </div>

    <div style="background-image: url('image/เขาตาหมื่นนี1.webp'); background-size: cover; background-position: top center; background-attachment: fixed;">
        <div style="background-color: rgb(0, 0, 0, 0.3);">
            <div class="container" style="padding-top: 60px; padding-bottom: 60px;">
                <div style="background-color: rgba(255, 255, 255, 0.8); border-radius: 25px;">
                    <div class="p-4">
                        <div class="row" style="overflow-x: hidden">
                            <div class="col-lg-12 text-center mb-4">
                                <h3 class="text-premium" style="font-weight: 800; font-size: 30px;">ประวัติความเป็นมาตำบลท่ามะพลา</h3>
                            </div>
                            <div class="col-lg-7">
                                <h5
                                    data-aos="sfade-up-left"
                                    data-aos-duration="800"
                                    class="text-center mb-3"
                                    style="font-weight: 800;"
                                >
                                    ประวัติความเป็นมา
                                </h5>
                                <p
                                    data-aos="sfade-left"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="1200"
                                    style="text-indent: 50px; text-align: justify;"
                                >
                                    ในอดีตการจราจรยังไม่สะดวก การสัญจรไปมายังไม่มีถนน การเดินทางมีแต่เรือแพและลำน้ำเท่านั้น ซึ่งแม่น้ำหลักคือ แม่น้ำหลังสวน ริมฝั่งเป็นดงไม้ คือ "ไม้พลา" ท่าเรืออยู่ริมฝั่งกลางดงไม้ เรียกว่า "ท่าไม้พลา" มีหมู่บ้านตั้งอยู่ใกล้ๆ เรียก "บ้านไม้พลา" เวลาผ่านนานไปเริ่มเพี้ยนเป็น "ท่ามะพลา" มาจนถึงทุกวันนี้ ปัจจุบันตำบลท่ามะพลา อยู่ในเขตการปกครองของอำเภอหลังสวน มีจำนวนหมู่บ้านทั้งสิ้น 9 หมู่บ้าน ได้แก่ หมู่ 1 บ้านแม่ทะเล หมู่ 2 บ้านในลุ่ม หมู่ 3 บ้านหนองเทา หมู่ 4 บ้านหนองหิน หมู่ 5 บ้านทุ่งทอง หมู่ 6 บ้านบ้านชายเขา หมู่ 7 บ้านเขาเงิน หมู่ 8 หมู่ 9 บ้านดอนนนท์
                                </p>
                            </div>
                            <div class="col-lg-5">
                                <img
                                    class="lazyload shadow br-15"
                                    data-aos="szoom-in"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="500"
                                    data-src="../image/เขาตาหมื่นนี.webp"
                                    width="100%"
                                    alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ตำบลนาทุ่ง -->
<div class="d-none" id="item_t4">
    <div style="background-color: #FFF;">
        <div class="container">
            <div class="row" style="overflow-x: hidden; overflow-y: hidden;">
                <div class="col-lg-7 mb-5">
                    <h5 class="text-center text-premium my-3" data-aos="sfade-up-left" data-aos-duration="500" style="font-weight: 800;">แหลมคอกวาง-เขาหัวโม่ง</h5>
                    <p
                        data-aos="sfade-left"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="1200"
                        style="text-indent: 50px; text-align: justify;"
                    >
                        จุดชมพระอาทิตย์ขึ้นและพระอาทิตย์ตกที่สวยงามมากกกกกของชุมพร ตั้งอยู่ตำบลนาทุ่ง อ.เมืองชุมพร เอกลักษณ์ของที่นี่ คือ โขดหินมากมายที่วางเรียงรายอยู่บนชายหาด กลายเป็นอีกหนึ่งจุดถ่ายรูปสวยๆของทุกคนที่มาเช็คอินที่แห่งนี้
                    </p>
                    <a href="https://goo.gl/maps/TXSTAV7XrJjvq8Vz9" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3922.8290521037134!2d99.2631777!3d10.514127!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ff55c2337363d1%3A0x858f60523c266144!2z4LiI4Li44LiU4LiK4Lih4Lin4Li04Lin4LmB4Lir4Lil4Lih4Lir4Lix4Lin4LmC4Lih4LmI4LiHLeC4hOC4reC4geC4p-C4suC4hw!5e0!3m2!1sth!2sth!4v1648026920577!5m2!1sth!2sth" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-lg-5 mb-5">
                    <img
                        class="lazyload br-15 shadow"
                        data-aos="sfade-down-left"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="500"
                        data-src="../image/จุดชมวิวแหลมหัวโม่ง.webp"
                        width="100%"
                        alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                    >
                </div>
                <div class="col-lg-5 mb-5">
                    <img
                        class="lazyload br-15 shadow"
                        data-aos="sfade-up-right"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="500"
                        data-src="../image/ชายทะเลปากหาด.webp"
                        width="100%"
                        alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                    >
                </div>
                <div class="col-lg-7 mb-5">
                    <h5 class="text-center text-premium my-3" data-aos="sfade-up-right" data-aos-duration="500" style="font-weight: 800;">ชายทะเลปากหาด</h5>
                    <p
                        data-aos="sfade-right"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="1200"
                        style="text-indent: 50px; text-align: justify;"
                    >
                        มีทิวทัศน์ที่สวยงาม มีทรัพยากรธรรมชาติที่สวยงาม คงสภาพที่หาที่ไหนไม่ได้ มีชาวประมงที่หาปลา และจำหน่ายอาหารทะเลสดๆ
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d62774.050599646136!2d99.1792773!3d10.4708254!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ff557952b0d6e3%3A0x9df2eccb1a3edf9a!2z4Lij4Li04Lih4LiX4Liw4LmA4LilIOC4m-C4suC4geC4q-C4suC4lA!5e0!3m2!1sth!2sth!4v1648027031289!5m2!1sth!2sth" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <a href="https://goo.gl/maps/74S7uf8B47A2nF3L9" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
                </div>
                <div class="col-lg-7 mb-5">
                    <h5 class="text-center text-premium my-3" data-aos="sfade-up-left" data-aos-duration="500" style="font-weight: 800;">สะพานพนังตัก (หมู่บ้านชาวประมง)</h5>
                    <p
                        data-aos="sfade-left"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="1200"
                        style="text-indent: 50px; text-align: justify;"
                    >
                        จากสะพานพนังตัก ซึ่งเป็นสะพานสูง สามารถชมวิวของหมู่บ้านชาวประมงของตำบลนาทุ่ง เป็นจุดที่แม่น้ำท่าตะเภาไหลลงสู่ทะเล ด้านล่างของสะพาน หรือบนสะพานสามารถตกปลาได้ เช่น ปลากระบอก, ปลากะพง
                    </p>
                    <a href="https://goo.gl/maps/9sRuTfBvb661ketx7" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d62764.70663226379!2d99.1870564!3d10.5168722!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30f8ab47d5e3361f%3A0xf237e41e16846c8!2z4Liq4Liw4Lie4Liy4LiZ4LiE4Lil4Lit4LiH4Lir4Lix4Lin4Lin4Lix4LiHLeC4nuC4meC4seC4h-C4leC4seC4gQ!5e0!3m2!1sth!2sth!4v1648028655753!5m2!1sth!2sth" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="col-lg-5 mb-5">
                    <img
                        class="lazyload br-15 shadow"
                        data-aos="sfade-down-left"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="500"
                        data-src="../image/สะพานพนังตัก.webp"
                        width="100%"
                        alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                    >
                </div>
                <div class="col-lg-5 mb-5">
                    <img
                        class="lazyload br-15 shadow"
                        data-aos="sfade-up-right"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="500"
                        data-src="../image/สวนสมเด็จพระศรีนครินทร์.webp"
                        width="100%"
                        alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                    >
                </div>
                <div class="col-lg-7 mb-5">
                    <h5 class="text-center text-premium my-3" data-aos="sfade-up-right" data-aos-duration="500" style="font-weight: 800;">วัดนาทุ่ง</h5>
                    <p
                        data-aos="sfade-right"
                        data-aos-easing="ease-in-sine"
                        data-aos-duration="1200"
                        style="text-indent: 50px; text-align: justify;"
                    >
                    วัดนาทุ่ง ก่อตั้งขึ้นเมื่อปี พ.ศ. 2363 เป็นวัดราษฎร์ สังกัดคณะสงฆ์มหานิกาย วัดนาทุ่งมีชื่อเสียงลำดับต้น ๆ ของจังหวัดชุมพร วัดมีความเก่าแก่มากกว่า 200 ปี ด้วยสถาปัตยกรรมของโบสถ์มีการออกแบบร่วมสมัย ภายในบริเวณวัดนาทุ่งเงียบสงบ ผู้คนไม่พลุกพล่านในวันธรรมดาทั่วไป แต่เมื่อถึงวันพระ พุทธศาสนิกชนในตำบลนาทุ่งและพื้นที่ใกล้เคียงจะหลั่งไหลเข้ามาจนสร้างความคึกคักภายในวัด ที่นี่ยังเป็นศูนย์รวมจิตใจของชาวบ้านตำบลนาทุ่ง อีกทั้งยังเป็นแหล่งเรียนรู้วิถีชุมชน แหล่งรวบรวมสิ่งของเครื่องใช้และวัตถุโบราณของชาวบ้านตำบลนาทุ่งในอดีตเพื่อให้เยาวชนรุ่นหลังได้เรียนรู้
                    </p>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3922.9741381796825!2d99.2001022!3d10.502703!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ff5545dd828ca1%3A0xca383a538be06c39!2z4Lin4Lix4LiU4LiZ4Liy4LiX4Li44LmI4LiH!5e0!3m2!1sth!2sth!4v1648028705378!5m2!1sth!2sth" width="200" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    <a href="https://goo.gl/maps/X9HKrYVb17f5FeRi8" class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="t4">เส้นทางนำเที่ยว <span class="fa fa-map"></span></a>
                </div>
            </div>
        </div>
    </div>

    <div style="background-image: url('image/จุดชมวิวแหลมหัวโม่ง.webp'); background-size: cover; background-position: top center; background-attachment: fixed;">
        <div style="background-color: rgb(0, 0, 0, 0.3);">
            <div class="container" style="padding-top: 60px; padding-bottom: 60px;">
                <div style="background-color: rgba(255, 255, 255, 0.8); border-radius: 25px;">
                    <div class="p-4">
                        <div class="row" style="overflow-x: hidden">
                            <div class="col-lg-12 text-center mb-4">
                                <h3 class="text-premium" style="font-weight: 800; font-size: 30px;">ประวัติความเป็นมาตำบลนาทุ่ง</h3>
                            </div>
                            <div class="col-lg-7">
                                <h5
                                    data-aos="sfade-up-left"
                                    data-aos-duration="800"
                                    class="text-center mb-3"
                                    style="font-weight: 800;"
                                >
                                    ประวัติความเป็นมา
                                </h5>
                                <p
                                    data-aos="sfade-left"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="1200"
                                    style="text-indent: 50px; text-align: justify;"
                                >
                                    บ้านนาทุ่งในอดีตเป็นป่ารก มีที่ลุ่มเป็นนา บริเวณค่อนข้างกว้าง ที่เรียกหัวทุ่งนั้น เป็นทุ่งนาที่ยาวไปจรดทะเล ชาวบ้านเรียกว่า หัวทุ่ง เมื่อมีนาต้องมีหมู่บ้าน เรียกว่า บ้านนาหัวทุ่ง เรียกสั้น ๆ ว่าบ้านนาทุ่ง และเป็นภาษาหนังสือว่า บ้านนาทุ่ง ในปัจจุบันมีหมู่บ้านทั้งสิ้น 7 หมู่บ้าน
                                </p>
                            </div>
                            <div class="col-lg-5">
                                <img
                                    class="lazyload shadow br-15"
                                    data-aos="szoom-in"
                                    data-aos-easing="ease-in-sine"
                                    data-aos-duration="500"
                                    data-src="../image/จุดชมวิวแหลมหัวโม่ง.webp"
                                    width="100%"
                                    alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร"
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="pt-5 text-center" style="background-color: #FFF;">
    <img class="lazyload" data-src="../image/vlogo.png" width="350px" alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร">
</div>

<!-- สไลด์กาแฟ -->
<div style="background-color: #FFF;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
            <h1 class="mb-5" style="color: #CF952A; font-weight: 800; font-size: 30px; padding-top: 40px">กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร</h1>
                <!-- <video
                    id="myVideo"
                    class="br-30"
                    data-aos="szoom-ins"
                    data-aos-easing="ease-in-sine"
                    data-aos-duration="350"
                    width="100%"
                    controls
                    autoplay
                >
                    <source data-src="//assets/video/1.mp4" type="video/mp4">
                </video> -->
            </div>
            <div class="embed-responsive embed-responsive-16by9 mb-5">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/FeUY-KpI0pM?autoplay=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" autoplay allowfullscreen></iframe>
            </div>
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
                            <img class="lazyload" data-src="../image/slide/ปกขั้นตอนการคัดกาแฟ-01.webp" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการผลิตกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/slide/ขั้นตอนที่02.webp" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการตากกาแฟโรบัสต้า)" width="100%">
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/slide/ขั้นตอนที่03.webp" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการอบลมร้อนกาแฟโรบัสต้า)" width="100%">
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/slide/ขั้นตอนที่04.webp" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการบ่มกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/slide/ขั้นตอนที่05.webp" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการสีแห้งกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/slide/ขั้นตอนที่06.webp" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนกาคัดแยกเมล็ดกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/slide/ขั้นตอนที่07.webp" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการคั่วกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/slide/ขั้นตอนที่08.webp" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการเลือกเมล็ดกาแฟโรบัสต้า)" width="100%"> 
                        </div>
                        <div class="carousel-item">
                            <img class="lazyload" data-src="../image/slide/ขั้นตอนที่09.webp" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (กระบวนการเลือกเมล็ดหลังคั่วกาแฟโรบัสต้า)" width="100%"> 
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

<!-- แนะนำสินค้า -->
<div style="background-color: #FFF;" class="pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-5">
                <a href="/robusta/46">
                    <div class="card border-0 shadow-sm br-20">
                        <div class="card-body p-2">
                            <div class="card-img">
                                <img class="lazyload" data-src="img_view/prod/46/0.3" width="100%" alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร - กาแฟโรบัสต้าพรีเมียมชุมพร (ขนาด 250 กรัม)">
                            </div>
                            <div class="card-title text-center" style="font-weight: 600;">
                                <!-- -->
                                <a href="/robusta/46" class="card-link text-dark">
                                    <b>กาแฟ โรบัสต้า พรีเมียม ชุมพร (ขนาด 250 กรัม)</b>
                                </a>
                            </div>
                            <div class="text-center mb-4">
                                <a href="/robusta/46" class="btn btn-premium py-2 px-5 mt-4 br-30 text-white" style="font-weight: 650; font-size: 18px;">สั่งซื้อสินค้า</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-5">
                <a href="/robusta/45">
                    <div class="card border-0 shadow-sm br-20">
                        <div class="card-body p-2">
                            <div class="card-img">
                                <img class="lazyload" data-src="img_view/prod/45/0.3" width="100%" alt="กาแฟเกรดพรีเมียมจากสวนกาแฟชุมพร - กาแฟโรบัสต้าพรีเมียมชุมพร (ขนาด 500 กรัม)">
                            </div>
                            <div class="card-title text-center" style="font-weight: 600;">
                                <!-- -->
                                <a href="/robusta/45" class="card-link text-dark">
                                    <b>กาแฟ โรบัสต้า พรีเมียม ชุมพร (ขนาด 500 กรัม)</b>
                                </a>
                            </div>
                            <div class="text-center mb-4">
                                <a href="/robusta/45" class="btn btn-premium py-2 px-5 mt-4 br-30 text-white" style="font-weight: 650; font-size: 18px;">สั่งซื้อสินค้า</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-12 mt-4 mt-5">
                <p class="mb-2">จังหวัดชุมพรนั้นมีสินค้าประจำจังหวัดที่มีชื่อเสียงมากมาย ไม่ว่าจะเป็นผลิตภัณฑ์แปรรูปจากกล้วย สมุนไพร หรือน้ำผึ้ง และมีอีกสิ่งหนึ่งที่โดดเด่นไม่แพ้สินค้าใดๆ นั่นคือ <a class="text-premium" href="https://vchumphon.com/">กาแฟชุมพร</a> ที่มีชื่อเสียงโด่งดังไปถึงต่างแดน และได้รับการยอมรับจากคอกาแฟทั่วประเทศ</p>
                <p>มาทำความรู้จัก “กาแฟชุมพร” หนึ่งในกาแฟที่โดดเด่นที่สุดในเมืองไทย ไม่แพ้ใครในโลกกัน</p>
            </div>
            <div class="col-lg-12 d-none mb-4" id="more">
                <h2 style="font-size: 20px; color: #CF952A;"><b>สวนกาแฟจังหวัดชุมพร</b></h2>
                <p><a class="text-premium" href="https://vchumphon.com/">สวนกาแฟ</a>ในจังหวัดชุมพร ถือเป็นหนึ่งแหล่งเพาะปลูกกาแฟสายพันธุ์โรบัสต้ามากที่สุดในประเทศไทย และเป็นผลิตภัณฑ์ทางการเกษตรที่สามารถสร้างรายได้ให้กับเกษตรกรชาวชุมพรได้ดี เนื่องจากสภาพภูมิอากาศและภูมิประเทศของจังหวัดชุมพรนั้นเหมาะสมกับการปลูกกาแฟโรบัสต้า เพราะต้นกาแฟสายพันธุ์นี้เหมาะสำหรับปลูกในพื้นที่ราบต่ำและมีความชื้น นอกจากนั้น ต้นกาแฟสายพันธุ์ยังปลูกง่าย และทนต่ออุณหภูมิสูงได้ดี ไม่ต้องพึ่งสารเคมี และใช้ต้นทุนต่ำอีกด้วย</p>
                <h3 style="font-size: 20px; color: #CF952A;"><b>ความโดดเด่นของกาแฟโรบัสต้า</b></h3>
                <p>กาแฟโรบัสต้านั้นมีจุดเด่นที่ไม่ซ้ำกับกาแฟสายพันธุ์อื่น เมล็ดกาแฟโรบัสต้านั้นมีลักษณะเป็นทรงกลมมนและมีเส้นผ่าตรงกลางเป็นแนวตรง มีความเข้มและขม ไม่ค่อยติดรสชาติเปรี้ยว รสชาติจึงจะค่อนข้างฝาด อีกทั้งมีระดับน้ำตาลและระดับกรดที่ต่ำ ตอบโจทย์คอกาแฟที่ชื่นชอบความเข้มข้นเป็นพิเศษ เพราะมีปริมาณคาเฟอีนอยู่ที่ 2% - 4.5% ซึ่งถือว่าสูงกว่าการกาแฟอราบิก้าเป็นเท่าตัว จึงนิยมนำมาทำเป็นกาแฟสำเร็จรูปหรือกาแฟคั่ว อย่างไรก็ตาม กว่าจะมาเป็น<a class="text-premium" href="https://vchumphon.com/">กาแฟชุมพร</a>อย่างที่เรารู้จัก ต้องผ่านกระบวนการผลิตอันพิถีพิถันหลากหลายขั้นตอน</p>
                <h2 style="font-size: 20px; color: #CF952A;"><b>กว่าจะมาเป็นกาแฟชุมพร</b></h2>
                <p class="mb-2">กาแฟชุมพรไม่ได้มีจุดเด่นแค่เฉพาะสายพันธุ์กาแฟโรบัสต้าอย่างเดียว แต่เนื่องจากความละเอียดอ่อนในกระบวนการผลิต จึงทำให้<a class="text-premium" href="https://vchumphon.com/">สวนกาแฟ</a>ประจำภาคใต้นี้เป็นที่ยอมรับไปทั่วโลก</p>
                <p class="mb-2">เมื่อผ่านการเก็บเกี่ยวแล้ว เมล็ดกาแฟจะถูกนำมาตากแห้งเป็นเวลา 20 นาที จากนั้นจะถูกนำไปอบลมร้อนที่อุณหภูมิ 80 องศาเซลเซียส และนำมาตากในโรงอบพลังงานแสงอาทิตย์เป็นเวลา 10 วัน ต่อมาเป็นกระบวนการที่ใช้เวลานานที่สุดคือการ “บ่ม” ที่ใช้เวลา 1 ปีเพื่อดึงรสชาติที่อร่อยที่สุดออกมา หลังจากเสร็จสิ้นการบ่ม เมล็ดกาแฟจะถูกนำมาขัดสี เพื่อเอาเปลือกออก ซึ่งเปลือกเหล่านี้ยังสามารถนำไปทำเป็น ปุ๋ยหรือถ่านแท่งได้ จากนั้นจะเป็นการคัดแยกเมล็ดและนำไปคั่วในระดับต่างๆ 3 ระดับ ได้แก่ คั่วอ่อน คั่วกลาง และคั่วเข็ม สุดท้ายเมล็ดกาแฟที่ถูกคั่วจะถูกนำไปคัดแยก เพื่อค้นหาเมล็ดที่สมบูรณ์ ได้คุณภาพมากที่สุดนั่นเอง</p>
                <p class="mb-2">แม้ในสมัยก่อนกาแฟโรบัสต้าจะไม่ได้รับความนิยมมากนัก เนื่องจากการควบคุมคุณภาพการผลิตที่เป็นได้ยาก แต่ด้วยเทคโนโลยีการคั่วในยุคนี้ที่ก้าวหน้าขึ้น จึงสามารถเข้ามาช่วยให้<a class="text-premium" href="https://vchumphon.com/">กาแฟชุมพร</a>มีรสชาติและคุณภาพที่ดีขึ้น ไม่ว่าจะชงเป็นกาแฟสด นำไปผสมกับกาแฟอราบิก้าเพื่อรสชาติใหม่ๆ แปรรูปเป็นกาแฟกึ่งสำเร็จรูป หรือผลิตเป็นกาแฟกระป๋องพร้อมทาน ก็เป็นที่นิยมมากในปัจจุบัน</p>
                <p class="mb-0">สำหรับกาแฟ V Coffee นั้นเป็น กาแฟโรบัสต้าสูตรพรีเมียมจากชุมพร เป็นกาแฟโรบัสต้า 100% ที่ปลูก ณ พื้นที่จังหวัดชุมพร ด้วยกระบวนการที่ใส่ใจ ตั้งแต่กระบวนการเก็บ คัดเฉพาะผลที่มีความสมบูรณ์สุกเต็มที่ ผ่านกระบวนผลิตที่ได้คุณภาพและมาตรฐาน ทำให้กาแฟมีกลิ่นหอมและคงความเข้มของโรบัสต้าเป็นเอกลักษณ์</p>
            </div>
            <div class="col-lg-12 text-center">
                <button class="btn btn-outline-warning btn-lg br-20 px-4 mr-3 btn-outline-tumb" id="myBtn">แสดงข้อมูลเพิ่มเติม <span class="fa fa-chevron-down"></span></button>
            </div>
        </div>
    </div>
</div>

<script>
    let s = 0;
    $("#myBtn").click(function () {
        $("#more").toggleClass("d-none");
        if(s == 0) {
            $(this).html('ย่อการแสดงข้อมูล <span class="fa fa-chevron-up"></span>');
            s = 1;
        } else {
            $(this).html('แสดงข้อมูลเพิ่มเติม <span class="fa fa-chevron-down"></span>');
            s = 0;
        }
        console.log(555);
    })
</script>

<!-- แพ็คเกจท่องเที่ยว -->
<div style="background-color: #FFF" class="pt-5">
    <div class="container">
        <h3 class="text-center" style="color: #CF952A; font-weight: 800; font-size: 30px; padding: 40px 0">จองแพ็คเกจท่องเที่ยว</h3>
        <div class="row">
            <?php
                $result = $pkgObj->queryHomePackagesd(); $i = 1;
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
                                    <h3 style="font-size: 40px; color: #CF952A;" class="card-title pricing-card-title"><?php echo number_format($row['pkg_adult_price'], 0); ?> <small class="text-muted">/ คน</small></h3>
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
            <div class="col-lg-12 text-center mt-4 mb-4">
                <a href="/travel" class="btn btn-premium br-30 py-3 px-5">แสดงแพคเกจเพิ่มเติม <span class="fa fa-angle-double-right"></span></a>
            </div>
        </div>
    </div>
</div>

<!-- สนับสนุนโดย -->
<!-- <div class="pt-5 pb-5 text-center" style="background-color: #FFF;">
    <h3 class="text-premium mb-5" style="font-weight: 800;">สนับสนุนโดย</h3>
    <img data-src="../image/utk.png" class="mr-5" width="160px">
    <img data-src="../image/ททท.png" class="mr-5" width="160px">
    <img data-src="../image/วช.jpg" class="mr-5" width="80px">
    <img data-src="../image/ถ้ำสิงห์.jpg" class="mr-5" width="230px">
    <img data-src="../image/ลุงเหนอ.jpg" class="mr-5" width="160px">
</div> -->

<!-- ประชาสัมพันธ์ -->
<div style="background-color: #FFF;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-premium mt-5" style="font-weight: 800; font-size: 30px; border-bottom: dotted #BEBEBE thin; padding-bottom: 15px; margin-bottom: 20px"><span class="fa fa-bullhorn mr-2"></span> ประชาสัมพันธ์</h3>
            </div>
            <?php
                $result = $blogObj->queryBlogs(); $i = 1;
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($i <= 3) {
            ?>
                            <div class="col-lg-4">
                                <div class="card card-news shadow border-0 br-15">
                                    <div class="card-body">
                                        <div class="news-img">
                                            <img class="lazyload" data-src="img_view/blog/<?php echo $row["blog_id"]; ?>/1" width="100%" alt="<?php echo $row["blog_name"]; ?>">
                                        </div>
                                        <div class="post-meta mx-4 mt-3 text-right text-premium" style="font-size: 13px;">
                                            <i class="far fa-calendar-alt mr-2"></i><?php echo $blogObj->dateThai($row["blog_created"]); ?>
                                        </div>
                                        <h5 class="news-titles mt-1 mx-4" style="min-height: 45px; max-height: 45px; overflow: hidden;">
                                            <b><a href="/content/<?php echo $row["blog_id"]; ?>" class="text-premium" style="text-decoration:none;"><?php echo $row["blog_name"]; ?></a></b>
                                        </h5>
                                        <p class="news-details mx-4" style="min-height: 75px; max-height: 75px; overflow: hidden;"><?php echo $row["blog_detail_short"]; ?></p>
                                        <p class="mx-4 mb-4"><a href="/content/<?php echo $row["blog_id"]; ?>" class="badge badge-premium px-2">อ่านต่อ...</a> </p>
                                    </div>
                                </div>
                            </div>
            <?php
                            $i++;
                        }
                    }
                }
            ?>
            <div class="col-lg-12 text-center mb-4">
                <a href="/content" class="btn btn-premium br-30 py-3 px-5">แสดงเพิ่มเติม <span class="fa fa-angle-double-right"></span></a>
            </div>
        </div>
    </div>
</div>


<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/footer.php"); ?>

<script type="application/ld+json">
{
"@context": "http://schema.org/",
"@type": "LocalBusiness",
"name": "กาแฟชุมพรเกรดพรีเมียม ส่งตรงจากสวนกาแฟจังหวัดชุมพร",
"../image": "https://vchumphon.com/image/logo.webp",
"description": "กาแฟชุมพรเกรดพรีเมียม ส่งตรงจากสวนกาแฟจังหวัดชุมพร กาแฟโรบัสต้าเกรดพรีเมี่ยม ผลิตภัณฑ์โดยคนไทย พร้อมบริการนำเที่ยวชมสวนกาแฟ และท่องเที่ยวชุมพร",
"address":"การวิจัยและพัฒนานวัตกรรมเทคโนโลยีดิจิตอลฯ มหาวิทยาลัยเทคโนโลยีราชมงคลกรุงเทพ เลขที่ 2 ถนนนางลิ้นจี่ แขวงทุ่งมหาเมฆ เขตสาทร 10120",
"priceRange":"0 - 9,999 THB",
"telephone":"+6622879600",
"brand" : {
  "@type": "Product",
  "name": "กาแฟชุมพรเกรดพรีเมียม ส่งตรงจากสวนกาแฟจังหวัดชุมพร",
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue" : "4.95",
    "ratingCount": "9915",
    "reviewCount": "9915"
   }
  }
}
</script>


<script>

$('.carousel').carousel()

// AOS.init();

//let vid = document.getElementById("myVideo");
//vid.volume = 0.05;

$("#t1").click(function() {
    $(this).removeClass("btn-outline-warning btn-outline-tumb");
    $(this).addClass("btn-warning btn-tumb");
    $("#t2").removeClass("btn-warning btn-tumb");
    $("#t2").addClass("btn-outline-warning btn-outline-tumb");
    $("#t3").removeClass("btn-warning btn-tumb");
    $("#t3").addClass("btn-outline-warning btn-outline-tumb");
    $("#t4").removeClass("btn-warning btn-tumb");
    $("#t4").addClass("btn-outline-warning btn-outline-tumb");

    $("#item_t1").removeClass("d-none");
    $("#item_t1").addClass("d-block");
    $("#item_t2").removeClass("d-block");
    $("#item_t2").addClass("d-none");
    $("#item_t3").removeClass("d-block");
    $("#item_t3").addClass("d-none");
    $("#item_t4").removeClass("d-block");
    $("#item_t4").addClass("d-none");
})

$("#t2").click(function() {
    $(this).removeClass("btn-outline-warning btn-outline-tumb");
    $(this).addClass("btn-warning btn-tumb");
    $("#t1").removeClass("btn-warning btn-tumb");
    $("#t1").addClass("btn-outline-warning btn-outline-tumb");
    $("#t3").removeClass("btn-warning btn-tumb");
    $("#t3").addClass("btn-outline-warning btn-outline-tumb");
    $("#t4").removeClass("btn-warning btn-tumb");
    $("#t4").addClass("btn-outline-warning btn-outline-tumb");

    $("#item_t1").removeClass("d-block");
    $("#item_t1").addClass("d-none");
    $("#item_t2").removeClass("d-none");
    $("#item_t2").addClass("d-block");
    $("#item_t3").removeClass("d-block");
    $("#item_t3").addClass("d-none");
    $("#item_t4").removeClass("d-block");
    $("#item_t4").addClass("d-none");
})

$("#t3").click(function() {
    $(this).removeClass("btn-outline-warning btn-outline-tumb");
    $(this).addClass("btn-warning btn-tumb");
    $("#t1").removeClass("btn-warning btn-tumb");
    $("#t1").addClass("btn-outline-warning btn-outline-tumb");
    $("#t2").removeClass("btn-warning btn-tumb");
    $("#t2").addClass("btn-outline-warning btn-outline-tumb");
    $("#t4").removeClass("btn-warning btn-tumb");
    $("#t4").addClass("btn-outline-warning btn-outline-tumb");

    $("#item_t1").removeClass("d-block");
    $("#item_t1").addClass("d-none");
    $("#item_t2").removeClass("d-block");
    $("#item_t2").addClass("d-none");
    $("#item_t3").removeClass("d-none");
    $("#item_t3").addClass("d-block");
    $("#item_t4").removeClass("d-block");
    $("#item_t4").addClass("d-none");
})

$("#t4").click(function() {
    $(this).removeClass("btn-outline-warning btn-outline-tumb");
    $(this).addClass("btn-warning btn-tumb");
    $("#t1").removeClass("btn-warning btn-tumb");
    $("#t1").addClass("btn-outline-warning btn-outline-tumb");
    $("#t2").removeClass("btn-warning btn-tumb");
    $("#t2").addClass("btn-outline-warning btn-outline-tumb");
    $("#t3").removeClass("btn-warning btn-tumb");
    $("#t3").addClass("btn-outline-warning btn-outline-tumb");

    $("#item_t1").removeClass("d-block");
    $("#item_t1").addClass("d-none");
    $("#item_t2").removeClass("d-block");
    $("#item_t2").addClass("d-none");
    $("#item_t3").removeClass("d-block");
    $("#item_t3").addClass("d-none");
    $("#item_t4").removeClass("d-none");
    $("#item_t4").addClass("d-block");
})



let xy = 0;
$("#moreTum").click(function() {
    $("#moreTumText").toggleClass("d-none");
    if(xy == 0) {
        $(this).html('ย่อการแสดงข้อมูล');
        xy = 1;
    } else {
        $(this).html('อ่านต่อ...');
        xy = 0;
    }
})

</script>

<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5NSH6S6"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

</body>
</html>