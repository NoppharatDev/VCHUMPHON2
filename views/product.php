<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/Product.Class.php');
    $headObj = new HeadHTML();
    $prodObj = new Product();
    $headObj->editTitleText(" - พาทุกท่านมารู้จักกาแฟโรบัสต้ามากกว่าเดิม");
    $headObj->addMeta("<meta name=\"description\" content=\"พาทุกท่านมาทำความรู้จักกับ “กาแฟโรบัสต้า” ที่นับว่าเป็นกาแฟที่ยอดนิยมเป็นอันดับที่ 2 ของโลกและแหล่งเพาะปลูกในประเทศไทยที่ได้รับการยอมรับจากนานาชาติ\" />");
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
        <p class="mt-4 mb-0"><a class="text-premium" href="https://vchumphon.com/robusta">กาแฟโรบัสต้า</a>เป็นหนึ่งในสายพันธุ์กาแฟยอดนิยม โดยคิดเป็น 20% ของพันธุ์กาแฟที่ได้รับความนิยมทั่วโลก ซึ่งสภาพภูมิประเทศที่เหมาะกับการปลูกคือประเทศแถบร้อนชื้นหรือความสูงกว่าระดับน้ำทะเลประมาณ 500 - 600 เมตร โดยในพื้นที่ที่มีอากาศชุ่มชื่นสูงจะส่งผลให้กาแฟโรบัสต้ามีคุณภาพสูง พื้นที่ที่เหมาะในการปลูกกาแฟโรบัสต้าในประเทศไทยคือ โซนภาคใต้ที่มีอากาศร้อนชื้น ฝนตกชุก เช่น จังหวัดชุมพร จังหวัดระนอง จังหวัดสุราษฎร์ธานี ฯลฯ ที่ปัจจุบันได้กลายเป็นแหล่งเพาะปลูกกาแฟสายพันธุ์นี้ โดยเฉพาะ<a class="text-premium" href="https://vchumphon.com">กาแฟชุมพร</a>ที่ได้รับความนิยมอย่างมากในไทย การันตีความนิยมของกาแฟโรบัสต้าจากชุมพรได้จากการส่งออกไปยังประเทศแถบยุโรป อเมริกา ญี่ปุ่น ฯลฯ อีกทั้งการปลูกกาแฟโรบัสต้าสามารถกลายมาเป็นพืชเศรษฐกิจของเกษตกรที่เพาะปลูกทางภาคใต้ได้ เพราะเป็นพืชที่สามารถเพาะปลูกได้ง่าย ทนโรคได้ดี และสามารถที่จะนำไปปลูกสลับกับสวนยางพาราได้อีกด้วย</p>
        <div class="row">
            <div class="col-lg-12 pt-5 text-center">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/FeUY-KpI0pM?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" autoplay allowfullscreen></iframe>
                </div>
                <!-- <video
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
                </video> -->
            </div>
        </div>
        <h2 class="mt-5" style="color: #CF952A; font-weight: 800; font-size: 20px;">ลักษณะของต้นกาแฟโรบัสต้า</h2>
        <p>ต้นกาแฟโรบัสต้าจะเป็นไม้พุ่ม มีขนาดเล็กสูงเพียง 2-4 เมตร ลำต้นจะเป็นข้อปล้อง โคนใบจะปรากฏตามข้อปล้อง โดยใบจะมีลักษณะเป็นใบเดี่ยวแหลมๆ มีขอบหยักเป็นคลื่น ผิวใบเรียบและมัน จะออกดอกเป็นดอกเดี่ยวที่อยู่ด้วยกันเป็นกลุ่ม โดยดอกจะออกจากกิ่งแขนงจากข้อ และผล<a class="text-premium" href="https://vchumphon.com/robusta">กาแฟโรบัสต้า</a>จะหลายสีสัน โดยถ้าเป็นผลดิบจะเป็นสีเขียว ผลสุกจะเป็นสีเหลือง สีส้ม และสีแดง</p>
        <h3 style="color: #CF952A; font-weight: 800; font-size: 20px;">รสชาติที่เข้มข้นถึงใจคอกาแฟ</h3>
        <p class="mb-2">เมื่อกล่าวถึงรสชาติของ<a class="text-premium" href="https://vchumphon.com/robusta">กาแฟโรบัสต้า</a>แล้ว กาแฟสายพันธุ์นี้จะมีรสชาติเข้มข้น ขมกว่า มีกลิ่นที่หอมฉุนกว่าอราบิกาและปริมาณคาเฟอีนที่มากกว่าเป็นเท่าตัว โดยจะคัดเกรดกาแฟโรบัสต้าคุณภาพสูงได้จากสีและกลิ่นของเมล็ดไม่ปะปนกับผลกาแฟ ความชื้นจะต้องไม่เกิน 13% ลักษณะเมล็ดจะมีความอวบอ้วน มีเส้นผ่าศูนย์กลางเป็นเส้นตรง ด้วยปริมาณคาเฟอีนที่มีมากถึง 2% - 4.5% ทำให้กาแฟโรบัสต้าส่วนมากถูกนำไปทำเป็นกาแฟสำเร็จรูป กาแฟกระป๋อง หรืออาจนำไปผสมกับกาแฟอราบิกาครึ่งหนึ่งสำหรับการนำไปชงกาแฟสด แม้แต่การนำกาแฟโรบ้สต้าไปทำเป็น<a class="text-premium" href="https://vchumphon.com">กาแฟสกัดเย็น</a> รวมถึงยังเหมาะกับการนำไปทำกาแฟชนิดต่างๆ เช่น เอสเปรสโซ คาปูชิโน ลาเต้ มอคค่า หรืออเมริกาโน</p>
        <p class="mb-2">อย่างไรก็ตามการรับประทานกาแฟในปริมาณสูงจะส่งผลต่อการทำงานของร่างกาย เพราะอาจทำให้เกิดอาการเสพติดเนื่องจากคาเฟอีน อาจส่งผลให้นอนหลับไม่สนิท ร่างกายพักผ่อนไม่เพียงพอ ทำให้หัวใจเต้นเร็วกว่าปกติ รวมถึงอาจกระตุ้นอาการของโรคบางชนิดได้ ดังนั้นควรรับดื่มกาแฟในประมาณ 1-2 แก้ว/วัน และไม่ควรทานในช่วงเวลาท้องว่างเพราะอาจเกิดอาการใจสั่นได้ นอกจากนี้สรรพคุณของกาแฟโรบัสต้า คือ ช่วยลดความอ่อนล้า ความเครียด และอาการปวดศีรษะได้ อีกทั้งยังลดความเสี่ยงในการเกิดโรคมะเร็ง ลดระดับน้ำตาลในเลือด ขยายหลอดเลือดแดง สามารถบำรุงหัวใจและลดความเสี่ยงของการเกิดโรคหัวใจได้ ช่วยละลายไขมันทำให้ไขมันแตกตัวและเพิ่มไขมันดีได้</p>
        <p class="mb-0">โดยทั่วไปแล้ว <a class="text-premium" href="https://vchumphon.com/robusta">กาแฟโรบัสต้า</a>พรีเมียม จากชุมพร ถือเป็นกาแฟโรบัสต้า 100% ที่ปลูก ณ พื้นที่จังหวัดชุมพรผลิตด้วยกระบวนการที่ใส่ใจ ตั้งแต่กระบวนการเก็บ คัดเฉพาะผลที่มีความสมบูรณ์สุกเต็มที่ ผ่านกระบวนการสี การอบ การบ่ม การคัดเมล็ด และการคั่ว ที่ได้มาตรฐาน ทำให้กาแฟมีกลิ่นหอมและคงความเข้มของโรบัสต้า เป็นเอกลักษณ์</p>
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
                <a class="text-premium" href="robusta/<?php echo $row['prod_id']/*$prodObj->getLinkView($row['prod_id'], $row['prod_type'])*/; ?>">
                    <div class="card border-0 shadow-sm br-20">
                        <div class="card-body p-2">
                            <div class="card-img">
                                <img src="/<?php echo $prodObj->getImage($row['prod_id']); ?>" width="100%" alt="กาแฟโรบัสต้าเกรดพรีเมี่ยม (<?php echo "{$row['prod_name']} ขนาด {$row['prod_weight']} กรัม" ?>)">
                            </div>
                            <div class="card-title text-center mb-0 mt-5" style="font-weight: 600;">
                                <a href="robusta/<?php echo $row['prod_id']; ?>" class="card-link text-dark"><b>กาแฟ โรบัสต้า พรีเมียม ชุมพร (<?php echo $row['prod_weight']; ?> กรัม)</b></a>
                            </div>
                            <div class="text-center mb-4">
                                <a href="/robusta/<?php echo $row['prod_id']; ?>" class="btn btn-premium py-2 px-5 mt-4 br-30 text-white" style="font-weight: 650; font-size: 18px;">สั่งซื้อสินค้า</a>
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