<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    require_once('components/Customer.Class.php');
    $headObj = new HeadHTML();
    $custObj = new Customer();
    $custObj->registerCust();
?>

<!DOCTYPE html>
<html lang="th">
<?php
    echo $headObj->getHead();
?>
<body style="overflow-x: hidden">
<?php require_once("{$_SERVER['DOCUMENT_ROOT']}/navbar.php"); ?>

<link rel="stylesheet" href="assets/jquery.Thailand.js/dist/jquery.Thailand.min.css">
<script type="text/javascript" src="assets/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>
<script type="text/javascript" src="assets/jquery.Thailand.js/dependencies/zip.js/zip.js"></script>
<script type="text/javascript" src="assets/jquery.Thailand.js/dependencies/JQL.min.js"></script>
<script type="text/javascript" src="assets/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>

<div style="background-color: #FFF">
    <div class="container" style="padding-top: 12vh; padding-bottom: 15vh">
        <div class="row py-5">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <div class="card border-0 shadow br-20">
                    <div class="card-body">
                        <h4 class="text-center text-premium mt-4 mb-5"><b>สมัครสมาชิก</b></h4>
                        <form class="row px-4" method="POST" action="" id="demo1" class="demo" autocomplete="on">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email" class="text-premium ml-2"><b>อีเมล <sup class="text-danger">*</sup></b></label>
                                    <input type="email" class="form-control form-control-lg br-20" id="email" name="email" value="<?php echo $custObj->email; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password" class="text-premium ml-2"><b>รหัสผ่าน <sup class="text-danger">*</sup></b></label>
                                    <input type="password" class="form-control form-control-lg br-20" id="password" name="password" value="<?php echo $custObj->pass; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password_cf" class="text-premium ml-2"><b>ยืนยันรหัสผ่าน <sup class="text-danger">*</sup></b></label>
                                    <input type="password" class="form-control form-control-lg br-20" id="password_cf" name="password_cf" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="first_name" class="text-premium ml-2"><b>ชื่อ <sup class="text-danger">*</sup></b></label>
                                    <input type="text" class="form-control form-control-lg br-20" id="first_name" name="first_name" value="<?php echo $custObj->first_name; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="last_name" class="text-premium ml-2"><b>นามสกุล <sup class="text-danger">*</sup></b></label>
                                    <input type="text" class="form-control form-control-lg br-20" id="last_name" name="last_name" value="<?php echo $custObj->last_name; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="title_name" class="text-premium ml-2"><b>เพศ <sup class="text-danger">*</sup></b></label>
                                    <br>
                                    <div class="form-check form-check-inline ml-2 mr-2">
                                        <input class="form-check-input" type="radio" id="sex1" name="title_name" value="1" checked>
                                        <label class="form-check-label mr-4" for="sex1"><b>ชาย</b></label>
                                    </div>
                                    <div class="form-check form-check-inline ml-2 mr-2">
                                        <input class="form-check-input" type="radio" id="sex2" name="title_name" value="2">
                                        <label class="form-check-label mr-4" for="sex2"><b>หญิง</b></label>
                                    </div>
                                    <!-- <select class="form-control form-control-lg br-20" id="title_name" name="title_name" required>
                                        <option value="0">โปรดเลือกคำนำหน้า</option>
                                        <option value="1">นาย</option>
                                        <option value="2">นาง</option>
                                        <option value="3">นางสาว</option>
                                    </select> -->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="province" class="text-premium ml-2"><b>จังหวัด <sup class="text-danger">*</sup></b></label>
                                    <input type="text" class="form-control form-control-lg br-20" id="province" name="province" value="<?php echo $custObj->province; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="zipcode" class="text-premium ml-2"><b>รหัสไปรษณีย์ <sup class="text-danger">*</sup></b></label required>
                                    <input
                                        class="form-control form-control-lg br-20"
                                        type="number"
                                        id="zipcode"
                                        name="zipcode"
                                        pattern="/^-?\d+\.?\d*$/"
                                        onKeyPress="if(this.value.length==5) return false;"
                                        maxlength="5"
                                        value="<?php echo $custObj->zipcode; ?>"
                                        required
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone" class="text-premium ml-2"><b>หมายเลขโทรศัพท์ <sup class="text-danger">*</sup></b></label>
                                    <input type="text" class="form-control form-control-lg br-20" id="phone" name="phone" value="<?php echo $custObj->phone; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right">
                                <hr />
                                <a href="/login" class="btn btn-danger br-30 py-3 px-5 mr-3"><span class="fa fa-arrow-left"></span> ย้อนกลับ</a>
                                <button type="submit" class="btn btn-premium br-30 py-3 px-5" name="register"><span class="fa fa-sign-in-alt"></span> ยืนยันการสมัคร</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
  $.Thailand({
      database: 'assets/jquery.Thailand.js/database/db.json', 

      $district: $('#demo1 [name="district"]'),
      $amphoe: $('#demo1 [name="amphoe"]'),
      $province: $('#demo1 [name="province"]'),
      $zipcode: $('#demo1 [name="zipcode"]'),

      onDataFill: function(data){
          console.info('Data Filled', data);
      },

      onLoad: function(){
          console.info('Autocomplete is ready!');
          // $('#loader, .demo').toggle();
      }
  });

  // watch on change

  $('#demo1 [name="district"]').change(function(){
      console.log('ตำบล', this.value);
  });
  $('#demo1 [name="amphoe"]').change(function(){
      console.log('อำเภอ', this.value);
  });
  $('#demo1 [name="province"]').change(function(){
      console.log('จังหวัด', this.value);
  });
  $('#demo1 [name="zipcode"]').change(function(){
      console.log('รหัสไปรษณีย์', this.value);
  });
</script>

<script>
$("body").css("background", "url('https://envato-shoebox-0.imgix.net/d260/042d-f845-4f23-88c9-d3b4a6951c35/C12A0522.jpg?auto=compress%2Cformat&fit=max&mark=https%3A%2F%2Felements-assets.envato.com%2Fstatic%2Fwatermark2.png&markalign=center%2Cmiddle&markalpha=18&w=1600&s=bf3b3a3ac19f72167613a0f1de1035dd')");
$("body").css("background-size", "cover" );
$("body").css("background-position", "top center");
$("body").css("background-attachment", "fixed");
</script>

</body>
</html>