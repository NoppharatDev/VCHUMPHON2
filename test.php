<?php

$n = 18000;
$thb = 0;

if($n <= 20) {
    $thb = 32;
} else if($n <= 100) {
    $thb = 37;
} else if($n <= 250) {
    $thb = 42;
} else if($n <= 500) {
    $thb = 52;
} else if($n <= 1000) {
    $thb = 67;
} else if($n <= 1500) {
    $thb = 82;
} else if($n <= 2000) {
    $thb = 97;
} else if($n <= 2500) {
    $thb = 100;
} else if($n <= 3000) {
    $thb = 105;
} else if($n <= 3500) {
    $thb = 110;
} else if($n <= 4000) {
    $thb = 120;
} else if($n <= 4500) {
    $thb = 130;
} else if($n <= 5000) {
    $thb = 140;
} else if($n <= 5500) {
    $thb = 150;
} else if($n <= 6000) {
    $thb = 160;
} else if($n <= 6500) {
    $thb = 170;
} else if($n <= 7000) {
    $thb = 180;
} else if($n <= 7500) {
    $thb = 190;
} else if($n <= 8000) {
    $thb = 200;
} else if($n <= 8500) {
    $thb = 215;
} else if($n <= 9000) {
    $thb = 230;
} else if($n <= 9500) {
    $thb = 245;
} else if($n <= 10000) {
    $thb = 260;
} else if($n <= 11000) {
    $thb = 300;
} else if($n <= 12000) {
    $thb = 320;
} else if($n <= 13000) {
    $thb = 340;
} else if($n <= 14000) {
    $thb = 360;
} else if($n <= 15000) {
    $thb = 380;
} else if($n <= 16000) {
    $thb = 395;
} else if($n <= 17000) {
    $thb = 410;
} else if($n <= 18000) {
    $thb = 425;
} else if($n <= 19000) {
    $thb = 435;
} else if($n <= 20000) {
    $thb = 445;
}

echo "น้ำหนัก : {$n} ราคาค่าส่ง {$thb} บาท";

?>