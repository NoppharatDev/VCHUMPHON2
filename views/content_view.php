<?php
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/Blog.Class.php");
    require_once("{$_SERVER['DOCUMENT_ROOT']}/components/HeadHTML.Class.php");
    $headObj = new HeadHTML();
    $blogObj = new Blog();
    $blogObj->setBlogByID($id);
    $headObj->editTitleText(" - {$blogObj->name}");
    $headObj->addMeta("<meta name=\"description\" content=\"ในช่วง 1-2 ปีที่ผ่านมากระแสกาแฟสกัดเย็นกำลังมาแรง ดังนั้นในบทความนี้จะมาแนะนำเกี่ยวกับกาแฟสกัดเย็น ว่ามีรสชาติอย่างไรบ้าง ต้องทำอย่างไรบ้าง มาทราบพร้อมกันในบทความนี้\" />");
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

<div style="background-color: #FFF; padding-top: 10vh; min-height: 100vh">
    <div class="container py-5">
        <h1 style="color: #CF952A; font-weight: 800; font-size: 30px;"><?php echo $blogObj->name; ?></h1>
        <hr>
        <div class="text-right mb-5"><i class="far fa-calendar-alt mr-2"></i><?php echo $blogObj->dateThai($blogObj->created); ?> <a style="color: #CF952A;">(อัพเดทล่าสุด : <?php echo $blogObj->dateThai($blogObj->updated); ?>)</a></div>
        <?php echo $blogObj->detail; ?>
    </div>
</div>

</body>
</html>