<?php 
  require_once('components/Image.Class.php');
  $imgObj = new Images();
  $imgObj->size = $size;
  $imgObj->imgView($type, $id);
  //imagecreatefromstring()
?>