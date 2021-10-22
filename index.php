<?php
    // session_start();
    $cart_count = 0;
?>
<!DOCTYPE html>
<html lang="en">
<body style="overflow-x: hidden">

<?php
    /*if(isset($_GET['page'])) {
        $p = $_GET['page'];
        if($p == 'pkg') {
            require_once('views/package.php');
        } else if($p == 'pkg_view') {
            require_once('views/package_view.php');
        } else if($p == 'pkg_conf') {
            require_once('views/package_confirm.php');
        } else if($p == 'prod') {
            require_once('views/product.php');
        } else if($p == 'prod_view') {
            require_once('views/product_view.php');
        } else if($p == 'prod_view1') {
            require_once('views/product_view1.php');
        } else if($p == 'prod_view2') {
            require_once('views/product_view2.php');
        } else if($p == 'prodp') {
            require_once('views/product_partner.php');
        } else if($p == 'prodp_view') {
            require_once('views/product_partner_view.php');
        } else if($p == 'my_cart') {
            require_once('views/my_cart.php');
        } else if($p == 'cart_confirm') {
            require_once('views/cart_confirm.php');
        } else if($p == 'login') {
            require_once('views/login.php');
        } else if($p == 'register') {
            require_once('views/register.php');
        } else if($p == 'logout') {
            unset($_SESSION["cust_id"]);
            if(!isset($_SESSION["cust_id"])) { header('Location: ?page=login'); }
            else { header('Location: .'); }
        } else if($p == 'my_orders') {
            require_once('views/my_order.php');
        } else if($p == 'my_order') {
            require_once('views/my_order_view.php');
        } else if($p == 'my_packages') {
            require_once('views/my_package.php');
        }
        
        if(isset($_SESSION['my_cart']) && count($_SESSION['my_cart']) > 0) {
            $cart_count = count($_SESSION['my_cart']);
        }
    } else {
        require_once('views/home.php');
    }*/
?>

<div style="background: rgba(92,92,92,0.50); padding: 25px 0px;" data-spy="scroll" data-target="#contact" data-offset="0">
    <div class="container" id="contact">
        <div class="row">
            <div class="col-lg-8">
                <p class="text-white">© 2021 กาแฟเขาถ้ำสิงห์<br></p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7752.152420267936!2d100.5379!3d13.713834!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5f6b33fcde5412b9!2z4Liq4LiW4Liy4Lia4Lix4LiZ4Lin4Li04LiI4Lix4Lii4LmB4Lil4Liw4Lie4Lix4LiS4LiZ4LiyIOC4oeC4q-C4suC4p-C4tOC4l-C4ouC4suC4peC4seC4ouC5gOC4l-C4hOC5guC4meC5guC4peC4ouC4teC4o-C4suC4iuC4oeC4h-C4hOC4peC4geC4o-C4uOC4h-C5gOC4l-C4ng!5e0!3m2!1sth!2sth!4v1628766969275!5m2!1sth!2sth" width="100%" height="400px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            <div class="col-1"></div>
            <div class="col-lg-3 mx-0 px-0 text-white">
                <p>
                </p><h4>ติดต่อเรา ::</h4>
                <img src="image/018-location pin.png" class="mr-1" style="width:1.2em;"> การวิจัยและพัฒนานวัตกรรมเทคโนโลยีดิจิตอลฯ
                มหาวิทยาลัยเทคโนโลยีราชมงคลกรุงเทพ
                เลขที่ 2 ถนนนางลิ้นจี่ แขวงทุ่งมหาเมฆ
                เขตสาทร
                10120<br>
                <img src="image/049-viber.png" class="mr-1" style="width:1.2em;"> 02-287-9600<br>
                <img src="image/009-message.png" class="mr-1" style="width:1.2em;"> rdi@mail.rmutk.ac.th<br>
                <img src="image/023-home.png" class="mr-1" style="width:1.2em;"> <a href="https://vchumphon.com" style="text-decoration: none; color: #FFF;">www.vchumphon.com</a><br>
                <img src="image/line-me.png" class="mr-1" style="width:1.2em;"> <a href="https://line.me/ti/p/@664uzmwr" style="text-decoration: none; color: #FFF;">Line@ : @664uzmwr</a>
                <p></p>
                <p>	
                </p><h4>Social Media :: </h4>
                <a href="" style="text-decoration: none; color: #fff;"><img src="image/facebook.png" style="width:1.2em;"> Facebook</a><br> 
                <a href="" style="text-decoration: none; color: #fff;"><img src="image/twitter.png" style="width:1.2em;"> Twitter</a><br> 
                <a href="" style="text-decoration: none; color: #fff;"><img src="image/instagram.png" style="width:1.2em;"> Instagram</a>
                <p></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>