<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/Package.Class.php');
    $headObj = new HeadHTML();
    $pkgObj = new Package();
    $headObj->editTitleText(" - 3 เหตุผลน่าทึ่งที่ทำให้คุณต้องเข้ามาท่องเที่ยวชุมพร");
    $headObj->addMeta("<meta name=\"description\" content=\"มาดูกันว่าจะมีเหตุผลอะไรบ้างที่จะทำให้ท่านเกิดสนใจเข้ามาท่องเที่ยวชุมพร เมืองหน้าด่านของภาคใต้ในประเทศไทยนี้\" />");
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
    <div class="container pt-5">
        <h1 style="color: #CF952A; font-weight: 800; font-size: 30px;">รวมสถานที่ท่องเที่ยวชุมพร</h1>
        <p class="mb-2">เมืองชุมพรนั้นเป็นจังหวัดที่มีแหล่งท่องเที่ยวที่น่าสนใจหลายแห่ง แต่ด้วยตำแหน่งที่เป็น “ประตู” สู่ภาคใต้ จึงทำให้หลายคนมองข้ามจังหวัดนี้ไป อย่างไรก็ตามแหล่งท่องเที่ยวชุมพร นับว่าคุ้มค่าต่อการเข้ามาเยี่ยมชมอย่างมากเลยทีเดียว</p>
        <p class="mb-2">มาดูทั้ง 3 เหตุผลที่ทำให้จังหวัดชุมพรเป็นหนึ่งในจังหวัดท่องเที่ยวที่คุณไม่ควรพลาด ต้องหาโอกาสไปสักครั้งในชีวิต</p>
        <h3 style="color: #CF952A; font-weight: 800; font-size: 20px;">1. ชุมพรเป็นเมืองสำคัญทางประวัติศาสตร์ไทย</h3>
        <p class="mb-2">หากมองเพียงปัจจุบัน แหล่ง<a class="text-premium" href="https://vchumphon.com/travel">ท่องเที่ยวชุมพร</a>อาจไม่ต่างจากที่อื่นๆ แต่ความจริงแล้ว จังหวัดนี้มีความสำคัญทางประวัติศาสตร์อย่างมาก ย้อนกลับไปเมื่อปี พ.ศ. 1098 หน้าประวัติศาสตร์ไทยได้ปรากฏชื่อเมือง "ชุมพร" ขึ้น ซึ่งแรกเริ่มเดิมทีนั้น "ชุมพร" เป็นหนึ่งในเมืองสิบสองนักษัตรของอาณาจักรนครศรีธรรมราช ซึ่งเป็นเมืองหน้าด่านฝ่ายเหนือ เพราะอยู่ตอนบนของภาคใต้</p>
        <p class="mb-2">เนื่องจากเป็นเมืองหน้าด่าน จึงทำให้ผู้คนสมัยก่อนเรียกว่าเมือง “ชุมนุมพล” ที่เหล่าแม่ทัพจะทำการทำพิธีส่งทัพโดยการบวงสรวงสิ่งศักดิ์สิทธิ์ ขอให้ได้ชัยชนะในการสู้รบ หรือก็คือการชุมนุมเพื่อรับพร และได้ชื่อว่าเมือง “ชุมนุมพร” สุดท้ายชื่อดังกล่าวก็ได้เพี้ยนมาเป็น “ชุมพร” ในปัจจุบันนั่นเอง</p>
        <h3 style="color: #CF952A; font-weight: 800; font-size: 20px;">2. ท่องเที่ยวชุมพรสวยงามและหลากหลาย</h3>
        <p class="mb-2">จังหวัดชุมพรถือเป็นหนึ่งในที่มีแหล่งท่องเที่ยวที่หลากหลาย สามารถเลือกเที่ยวได้แบบไม่เบื่อเลยทีเดียว เริ่มจาก “หาดทรายรี” ซึ่งเป็นที่ที่มีหาดทรายขาวทอดยาวสุดสายตาและน้ำทะเลที่ใสเอามากๆ โด่งดังไปทั่วประเทศ และเป็นที่ตั้งของอนุสรณ์สถานกรมหลวงชุมพรเขตอุดมศักดิ์ ผู้ทรงสถาปนากองทัพเรืออันทันสมัยให้กับประเทศไทยอีกด้วย</p>
        <p class="mb-2">ต่อมาคือ “จุดชมวิวเขามัทรี” ตั้งอยู่ในอำเภอเมืองชุมพร เป็นจุดชมวิวทิวทัศน์ ที่สามารถชมวิวของเมืองชุมพรได้แบบ 360 องศา  มองเห็นชุมชนปากน้ำชุมพรและชายหาด โดยเฉพาะบรรยากาศในยามเย็นที่พระอาทิตย์งดงามมาก อีกทั้งด้านบนจุดชมวิวเขามัทรี มีประติมากรรมพระโพธิสัตว์อวโลกิเตศวร ปางมหาราชลีลา ลักษณะคล้ายกับท่านั่งขององค์จตุคามรามเทพมองออก ไปที่ชายทะเลชุมพรด้านขวาเป็นหาดภราดรภาพ หากได้ชมวิวไปพร้อมกับดื่ม<a class="text-premium" href="https://vchumphon.com/">กาแฟชุมพร</a>ร้อนๆ ต้องมีความสุขอย่างเอ่อล้นแน่นอน</p>
        <p class="mb-2">ปิดท้ายด้วย “สะพานไม้เคี่ยม” สะพานไม้ที่ทอดยาวไปในแก้มลิงขนาดใหญ่เชื่อมต่อกับเกาะกลางน้ำเล็กๆ โอบล้อมไปด้วยภูเขา ป่าพรุ และบรรยากาศอันเงียบสงบอย่างหาที่เทียบไม่ติด สะพานไม้เคี่ยมนั้นทอดยาวกว่า 290 เมตรมีลักษณะโค้งเป็นรูปตัว “S” ซึ่งถูกสร้างขึ้นโดยใช้แรงงานคนเพียง 7 คนและเวลา 45 วันเท่านั้น สะท้อนให้เห็นถึงภูมิปัญญาชาวบ้านได้ดีเป็นอย่างมาก</p>
        <p class="mb-2">นอกจากสามสถานที่นี้แล้ว ยังมีแหล่ง<a class="text-premium" href="https://vchumphon.com/travel">ท่องเที่ยวชุมพร</a>ให้ชื่นชมอีกมากมาย รวมไปถึงหมู่เกาะต่างๆ ที่อยู่ใกล้ๆ ด้วย นับว่าเป็นจังหวัดที่เที่ยวได้อย่างสนุกสนานมาก</p>
        <h3 style="color: #CF952A; font-weight: 800; font-size: 20px;">3. ชุมพรเป็นแหล่งปลูกกาแฟสำคัญของไทย</h3>
        <p class="mb-2">หลายท่านอาจจะไม่ทราบ แต่เมืองชุมพรนั้นเป็น<a class="text-premium" href="https://vchumphon.com">สวนกาแฟ</a>ที่สำคัญของประเทศไทย ซึ่งมีสภาพแวดล้อมและภูมิอากาศที่เหมาะกับการปลูกกาแฟโรบัสต้าอย่างมาก เพราะกาแฟสายพันธุ์นี้ชื่นชอบ พื้นที่ต่ำ อากาศชื้น ปลูกง่าย และสามารถทนต่อโรคต่างๆ</p>
        <p class="mb-2">ได้ดี ทำให้เกิดกาแฟโรบัสต้าไทย ที่ถูกยอมรับไปทั่วโลกและได้ส่งออกไปยังประเทศแถบยุโรป อเมริกา ญี่ปุ่น ฯลฯ สวน<a class="text-premium" href="https://vchumphon.com">กาแฟชุมพร</a>จึงเป็นอีกหนึ่งเหตุผลที่คุณไม่ควรพลาดที่จะมาท่องเที่ยวในจังหวัดนี้ ซึ่งรับรองว่าต้องถูกใจคอกาแฟอย่างแน่นอน</p>
        <p class="mb-2">สำหรับกาแฟ V Coffee นั้นเป็น กาแฟโรบัสต้าสูตรพรีเมียมจากชุมพรเป็นกาแฟโรบัสต้า 100% ที่ปลูก ณ พื้นที่จังหวัดชุมพร ด้วยกระบวนการที่ใส่ใจ ตั้งแต่กระบวนการเก็บ คัดเฉพาะผลที่มีความสมบูรณ์สุกเต็มที่ ผ่านกระบวนผลิตที่ได้คุณภาพและมาตรฐาน ทำให้กาแฟมีกลิ่นหอมและคงความเข้มของโรบัสต้าเป็นเอกลักษณ์ พร้อมดื่มด่ำควบคู่ไปกับบรรยากาศดีๆ เสมอ</p>
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