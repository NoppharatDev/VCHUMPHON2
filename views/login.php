<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/Customer.Class.php');
    $headObj = new HeadHTML();
    $custObj = new Customer();
    $custObj->loginCust();
    if(isset($_SESSION["cust_id"])) { header('Location: .'); }
?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">
<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<div style="background-color: #FFF">
    <div class="container" style="padding-top: 250px; padding-bottom: 300px">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="card border-0 shadow br-20">
                    <div class="card-body">
                        <h4 class="text-center text-premium mt-3 pb-5"><b>เข้าสู่ระบบ</b></h4>
                        <form class="row px-4" method="POST" action="">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email" class="text-premium ml-2"><b>ชื่อบัญชีผู้ใช้ (Email) <sup class="text-danger">*</sup></b></label>
                                    <input type="email" class="form-control form-control-lg br-20" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="password" class="text-premium ml-2"><b>รหัสผ่าน <sup class="text-danger">*</sup></b></label>
                                    <input type="password" class="form-control form-control-lg br-20" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right my-3">
                                <button type="submit" class="btn btn-premium br-30 py-3 px-5" name="login"><b><span class="fa fa-sign-in-alt"></span> เข้าสู่ระบบ</b></button>
                            </div>
                            <div class="col-lg-12 text-center">
                                <hr>
                                <p class="mt-4">คุณยังไม่มีบัญชีผู้ใช้ ? <b><a href="?page=register" class="text-premium">สมัครสมาชิก</a></b></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>