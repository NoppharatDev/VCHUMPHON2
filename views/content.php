<?php
    // session_start();
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/Blog.Class.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    $headObj = new HeadHTML();
    $blogObj = new Blog();
    $cart_count = 0;
?>
<!DOCTYPE html>
<html lang="th">
<?php
    $headObj->addMeta("<meta name=\"description\" content=\"VCHUMPON ขอพาทุกท่านมาทำความรู้จักกับ “กาแฟชุมพร” หนึ่งแหล่งปลูกกาแฟคุณภาพเยี่ยมของประเทศไทย\" />");
    $headObj->addLink("<link rel=\"stylesheet\" href=\"https://unpkg.com/aos@2.3.1/dist/aos.css\">");
    $headObj->addScript("<script src=\"https://unpkg.com/aos@2.3.1/dist/aos.js\"></script>");
    $headObj->editTitleText(" - ทำความรู้จักกาแฟชุมพร โรบัสต้าที่โดดเด่นที่สุดในเมืองไทย");
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">

<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<!-- ประชาสัมพันธ์ -->
<div style="background-color: #FFF; padding-top: 10vh">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-premium mt-5" style="font-weight: 800; font-size: 30px; border-bottom: dotted #BEBEBE thin; padding-bottom: 15px; margin-bottom: 20px"><span class="fa fa-bullhorn mr-2"></span> ประชาสัมพันธ์</h3>
            </div>
            <?php
                $result = $blogObj->queryBlogs(); $i = 1;
                if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
            ?>
                        <div class="col-lg-4">
                            <div class="card card-news shadow border-0 br-15">
                                <div class="card-body">
                                    <div class="news-img">
                                        <img class="lazyload" data-src="img_view/blog/<?php echo $row["blog_id"]; ?>/1" width="100%" alt="<?php echo $row["blog_name"]; ?>">
                                    </div>
                                    <div class="post-meta mx-4 mt-3 text-right text-premium" style="font-size: 13px;">
                                        <i class="far fa-calendar-alt mr-2"></i><?php echo $row["blog_created"]; ?>
                                    </div>
                                    <h5 class="news-titles mt-1 mx-4" style="min-height: 45px; max-height: 45px; overflow: hidden;"><b><?php echo $row["blog_name"]; ?></b></h5>
                                    <p class="news-details mx-4" style="min-height: 75px; max-height: 75px; overflow: hidden;"><?php echo $row["blog_detail_short"]; ?></p>
                                    <p class="mx-4 mb-4"><a href="/content/<?php echo $row["blog_id"]; ?>" class="badge badge-premium px-2">อ่านต่อ...</a> </p>
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

AOS.init();

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

</script>

</body>
</html>