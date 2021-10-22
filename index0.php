<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets//fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/script.js"></script>
    <title>กาแฟและแพคเกจท่องเที่ยว</title>
</head>
<body class="bg">

    <div class="bg"></div>

    <nav class="navbar navbar-expand-lg navbar-dark bg-navbar">
        <div class="container">
            <a class="navbar-brand" href="#">
                <!-- <img src="https://getbootstrap.com/docs/4.1/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt=""> -->
                <b><i class="fas fa-coffee"></i> กาแฟและแพคเกจท่องเที่ยว</b>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="index.html" class="nav-link active" id="homeMenu"><i class="fa fa-home"></i> หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a href="product.html" class="nav-link" id="cafeMenu"><i class="fa fa-mug-hot"></i> อาหารและเครื่องดื่ม</a>
                    </li>
                    <li class="nav-item">
                        <a href="package.html" class="nav-link" id="packageMenu"><i class="fa fa-suitcase-rolling"></i> แพ็คเกจท่องเที่ยว</a>
                    </li>
                    <li class="nav-item">
                        <a href="about.html" class="nav-link" id="aboutMenu"><i class="fa fa-users"></i> เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.html" class="nav-link" id="contactMenu"><i class="fa fa-comments"></i> ติดต่อ</a>
                    </li>
                    <li class="nav-item">
                        <a href="cart.html" class="nav-link" id="cartMenu"><i class="fa fa-shopping-cart"></i> (2)</a>
                    </li>
                </ul>
                <div class="nav-item dropdown ml-auto">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fa fa-user-circle"></span> <b></b>
                    </a>
                    <div class="dropdown-menu border-0 shadow-sm" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="login.html"><span class="fa fa-sign-in-alt" style="font-size:12px"></span> เข้าสู่ระบบ</a>
                        <a class="dropdown-item" href="register.html"><span class="fa fa-user-plus" style="font-size:12px"></span> สมัครสมาชิก</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-1" href="login_admin.html"><span class="fa fa-user-tie" style="font-size:12px"></span> ผู้ดูแลระบบ</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm br-20">
                    <div class="card-body d-flex">
                        <div><h5 class="pt-3 mb-0 pb-0"><i class="fa fa-mug-hot"></i> อาหารและเครื่องดื่ม</h5></div>
                        <div class="ml-auto">
                            <a href="product.html" class="btn btn-dark br-30 px-4"><b>แสดงทั้งหมด</b></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0 shadow br-20 animate__animated animate__backInUp animate__fast">
                    <div class="card-body p-2">
                        <div class="card-img">
                            <img src="https://www.starbucks.co.th/stb-media/2020/08/41.Iced-Caffe-Mocha1080.png" width="100%">
                        </div>
                        <div class="d-flex card-title">
                            <a href="product_view1.html" class="card-link text-dark">
                                คาเฟ่ มอคค่า
                            </a>
                        </div>
                        <div class="card-price d-flex">
                            <div class="ml-auto"><b> 40.00 </b> บาท</div>
                        </div>
                        <a href="product_view1.html" class="btn btn-dark btn-block br-30">รายละเอียดสินค้า</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0 shadow br-20 animate__animated animate__backInUp animate__fast">
                    <div class="card-body p-2">
                        <div class="card-img">
                            <img src="https://www.starbucks.co.th/stb-media/2020/08/45.Iced-Cappuccino1080.png" width="100%">
                        </div>
                        <div class="d-flex card-title">
                            <a href="product_view1.html" class="card-link text-dark">
                                คาปูชิโน่
                            </a>
                        </div>
                        <div class="card-price d-flex">
                            <div class="ml-auto"><b> 40.00 </b> บาท</div>
                        </div>
                        <a href="product_view1.html" class="btn btn-dark btn-block br-30">รายละเอียดสินค้า</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0 shadow br-20 animate__animated animate__backInUp animate__fast">
                    <div class="card-body p-2">
                        <div class="card-img">
                            <img src="https://www.starbucks.co.th/stb-media/2020/09/111.Americano_Iced_Reserve_BlackEG-600x600.png" width="100%">
                        </div>
                        <div class="d-flex card-title">
                            <a href="product_view1.html" class="card-link text-dark">
                                อเมริกาโน่เย็น
                            </a>
                        </div>
                        <div class="card-price d-flex">
                            <div class="ml-auto"><b> 40.00 </b> บาท</div>
                        </div>
                        <a href="product_view1.html" class="btn btn-dark btn-block br-30">รายละเอียดสินค้า</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0 shadow br-20 animate__animated animate__backInUp animate__fast">
                    <div class="card-body p-2">
                        <div class="card-img">
                            <img src="https://www.starbucks.co.th/stb-media/2021/05/LTO-Yuzu-Cold-Brew-1080-x-1080.png" width="100%">
                        </div>
                        <div class="d-flex card-title">
                            <a href="product_view1.html" class="card-link text-dark">
                                ยูสุ โคลด์ บรูว์
                            </a>
                        </div>
                        <div class="card-price d-flex">
                            <div class="ml-auto"><b> 40.00 </b> บาท</div>
                        </div>
                        <a href="product_view1.html" class="btn btn-dark btn-block br-30">รายละเอียดสินค้า</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0 shadow br-20 animate__animated animate__backInUp animate__fast">
                    <div class="card-body p-2">
                        <div class="card-img">
                            <img src="https://scontent.fbkk4-2.fna.fbcdn.net/v/t1.6435-9/190193304_2995199654132875_1722215964835812499_n.jpg?_nc_cat=102&ccb=1-3&_nc_sid=8bfeb9&_nc_eui2=AeGdb39LYMWGyyGuUQPZldQqDMikAae-OPUMyKQBp7449S58gwqIb3sMSptFsgls3KtaYBbU2eBahpo4ExU06Yp7&_nc_ohc=UBEgHHOejWkAX91Q3cO&_nc_ht=scontent.fbkk4-2.fna&oh=e250772591e29ab0fe1a16e939af9566&oe=60CD758A" width="100%">
                        </div>
                        <div class="d-flex card-title">
                            <a href="product_view2.html" class="card-link text-dark">
                                ชีทเค้กไข่เค็ม 150 กรัม
                            </a>
                        </div>
                        <div class="card-price d-flex">
                            <div class="ml-auto"><b> 25.00 </b> บาท</div>
                        </div>
                        <a href="product_view2.html" class="btn btn-dark btn-block br-30">รายละเอียดสินค้า</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0 shadow br-20 animate__animated animate__backInUp animate__fast">
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
                        <a href="product_view.html" class="btn btn-dark btn-block br-30">รายละเอียดสินค้า</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0 br-20 shadow animate__animated animate__backInUp animate__fast">
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
                        <a href="product_view.html" class="btn btn-dark btn-block br-30">รายละเอียดสินค้า</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0 br-20 shadow animate__animated animate__backInUp animate__fast">
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
                        <a href="product_view.html" class="btn btn-dark btn-block br-30">รายละเอียดสินค้า</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm br-20">
                    <div class="card-body d-flex">
                        <div><h5 class="pt-3 mb-0 pb-0"><i class="fa fa-suitcase-rolling"></i> แพ็คเกจท่องเที่ยว</h5></div>
                        <div class="ml-auto">
                            <a href="package.html" class="btn btn-dark br-30 px-4"><b>แสดงทั้งหมด</b></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 mb-4 shadow text-center br-30">
                    <div class="card-body">
                        <h5 class="my-0 mb-4 package-title">
                            <b>วัดถ้ำสิงห์</b>
                        </h5>
                        <div class="card-img">
                            <img src="http://www.rakbankerd.com/our_home/travel_pics/1458522065_133/1.jpeg" width="100%">
                        </div>
                        <h1 class="card-title pricing-card-title">550 <small class="text-muted">/ คน</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>ระยะเวลา 1 วัน</li>
                            <li>สูงสุด 5 คน</li>
                            <li>ลดสูงสุด 25 %</li>
                            <li>ราคาสำหรับเด็ก 275 บาท</li>
                            <li>อัพเดทล่าสุด : 17 พ.ย. 2564</li>
                        </ul>
                        <a href="package_view.html" class="btn btn-block btn-outline-dark br-20">
                            <b>รายละเอียดแพ็คเกจ</b>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 mb-4 shadow text-center br-30">
                    <div class="card-body">
                        <h5 class="my-0 mb-4 package-title">
                            <b>หาดทรายรี - ศาลกรมหลวงชุมพร</b>
                        </h5>
                        <div class="card-img">
                            <img src="https://tatapi.tourismthailand.org/tatfs/Image/CustomPOI/Picture/P03002468_1.jpeg" width="100%">
                        </div>
                        <h1 class="card-title pricing-card-title">750 <small class="text-muted">/ คน</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>ระยะเวลา 1 วัน</li>
                            <li>สูงสุด 7 คน</li>
                            <li>ลดสูงสุด 25 %</li>
                            <li>ราคาสำหรับเด็ก 375 บาท</li>
                            <li>อัพเดทล่าสุด : 18 พ.ย. 2564</li>
                        </ul>
                        <a href="package_view.html" class="btn btn-block btn-outline-dark br-20">
                            <b>รายละเอียดแพ็คเกจ</b>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 mb-4 shadow text-center br-30">
                    <div class="card-body">
                        <h5 class="my-0 mb-4 package-title">
                            <b>เรือรบหลวงชุมพร - จุดชมวิวเขามัทรี</b>
                        </h5>
                        <div class="card-img">
                            <img src="https://cms.dmpcdn.com/travel/2021/01/13/285e0990-559d-11eb-89e4-35f1a97d3869_original.jpg" width="100%">
                        </div>
                        <h1 class="card-title pricing-card-title">1,500 <small class="text-muted">/ คน</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>ระยะเวลา 1 วัน</li>
                            <li>สูงสุด 10 คน</li>
                            <li>ลดสูงสุด 25 %</li>
                            <li>ราคาสำหรับเด็ก 750 บาท</li>
                            <li>อัพเดทล่าสุด : 19 พ.ย. 2564</li>
                        </ul>
                        <a href="package_view.html" class="btn btn-block btn-outline-dark br-20">
                            <b>รายละเอียดแพ็คเกจ</b>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 mb-4 shadow text-center br-30">
                    <div class="card-body">
                        <h5 class="my-0 mb-4 package-title">
                            <b>หมู่เกาะทะเลชุมพร</b>
                        </h5>
                        <div class="card-img">
                            <img src="https://paapaii.com/wp-content/uploads/2018/04/4-2.jpg" width="100%">
                        </div>
                        <h1 class="card-title pricing-card-title">3,000 <small class="text-muted">/ คน</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>ระยะเวลา 2 วัน</li>
                            <li>สูงสุด 10 คน</li>
                            <li>ลดสูงสุด 25 %</li>
                            <li>ราคาสำหรับเด็ก 1,000 บาท</li>
                            <li>อัพเดทล่าสุด : 20 พ.ย. 2564</li>
                        </ul>
                        <a href="package_view.html" class="btn btn-block btn-outline-dark br-20">
                            <b>รายละเอียดแพ็คเกจ</b>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 mb-4 shadow text-center br-30">
                    <div class="card-body">
                        <h5 class="my-0 mb-4 package-title">
                            <b>เกาะรังกาจิว</b>
                        </h5>
                        <div class="card-img">
                            <img src="http://www.chppao.go.th/files/com_travel/2019-02_2b734e71d28ca12.jpg" width="100%">
                        </div>
                        <h1 class="card-title pricing-card-title">3,200 <small class="text-muted">/ คน</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>ระยะเวลา 3 วัน</li>
                            <li>สูงสุด 10 คน</li>
                            <li>ลดสูงสุด 25 %</li>
                            <li>ราคาสำหรับเด็ก 1,500 บาท</li>
                            <li>อัพเดทล่าสุด : 17 พ.ย. 2564</li>
                        </ul>
                        <a href="package_view.html" class="btn btn-block btn-outline-dark br-20">
                            <b>รายละเอียดแพ็คเกจ</b>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 mb-4 shadow text-center br-30">
                    <div class="card-body">
                        <h5 class="my-0 mb-4 package-title">
                            <b>เกาะมัตรา</b>
                        </h5>
                        <div class="card-img">
                            <img src="https://f.ptcdn.info/001/050/000/on6dhqr0eMbdaLKpwwk-o.jpg" width="100%">
                        </div>
                        <h1 class="card-title pricing-card-title">3,000 <small class="text-muted">/ คน</small></h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>ระยะเวลา 2 วัน</li>
                            <li>สูงสุด 10 คน</li>
                            <li>ลดสูงสุด 25 %</li>
                            <li>ราคาสำหรับเด็ก 1,200 บาท</li>
                            <li>อัพเดทล่าสุด : 18 พ.ย. 2564</li>
                        </ul>
                        <a href="package_view.html" class="btn btn-block btn-outline-dark br-20">
                            <b>รายละเอียดแพ็คเกจ</b>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>