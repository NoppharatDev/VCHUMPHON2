<?php

require_once('Database.Class.php');

class Images extends Database {

    public $size;

    public function resize($blobImage) {
        $gdImage = imagecreatefromstring($blobImage);
        if($gdImage) {
            $width = imagesx(imagecreatefromstring($blobImage));
            $height = imagesy(imagecreatefromstring($blobImage));
            $toWidth = $width * $this->size;
            $toHeight = $height * $this->size;
            list($width, $height) = getimagesizefromstring($blobImage);
            $gdRender = imagecreatetruecolor($toWidth, $toHeight);
            $colorBgAlpha = imagecolorallocatealpha($gdRender, 0, 0, 0, 127);
            imagecolortransparent($gdRender, $colorBgAlpha);
            imagefill($gdRender, 0, 0, $colorBgAlpha);
            imagecopyresampled($gdRender, $gdImage, 0, 0, 0, 0, $toWidth, $toHeight, $width, $height);
            imagetruecolortopalette($gdRender, false, 255);
            imagesavealpha($gdRender, true);
            ob_start();
            imagepng($gdRender);
            $imageContents = ob_get_contents();
            ob_end_clean();
            imagedestroy($gdRender);
            imagedestroy($gdImage);
            return $imageContents;
        }
    }

    //
    public function getProdImg($id) {
        header('content-type: image/webp');
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM products WHERE prod_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $img = $row['prod_img'];
            /*$size = mb_strlen($img, '8bit');
            for($i = 102400; $i < $size; $i++) {
                //echo "ขนาดเดิม : {$size} <br>";
                $img = $this->resize($img);
                $size = mb_strlen($img, '8bit');
                //echo "ขนาดใหม่ : {$size} <br><br>";
            }
            echo $img;*/
            $img = $this->resize($img);
            echo $img;
        }
        $conn->close();
    }

    //
    public function getPkgImg($id) {
        header('content-type: image/webp');
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT pkg_img FROM packages WHERE pkg_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $img = $row['pkg_img'];
            /*$size = mb_strlen($img, '8bit');
            for($i = 102400; $i < $size; $i++) {
                //echo "ขนาดเดิม : {$size} <br>";
                $img = $this->resize($img);
                $size = mb_strlen($img, '8bit');
                //echo "ขนาดใหม่ : {$size} <br><br>";
            }
            echo $img;*/
            $img = $this->resize($img);
            echo $img;
        }
        $conn->close();
    }

    //
    public function getPkgImg1($id) {
        header('content-type: image/webp');
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT pkg_slide1_img FROM packages WHERE pkg_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $img = $row['pkg_slide1_img'];
            echo $this->resize($img);
        }
        $conn->close();
    }

    //
    public function getPkgImg2($id) {
        header('content-type: image/webp');
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT pkg_slide2_img FROM packages WHERE pkg_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $img = $row['pkg_slide2_img'];
            echo $this->resize($img);
        }
        $conn->close();
    }

    //
    public function getPkgImg3($id) {
        header('content-type: image/webp');
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT pkg_slide3_img FROM packages WHERE pkg_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $img = $row['pkg_slide3_img'];
            echo $this->resize($img);
        }
        $conn->close();
    }

    /* 
    public function getCustImg($id) {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT * FROM customers WHERE customer_id = ?");
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                header('content-type: image/jpeg');
                echo $a = $row['prod_img'];
                echo base64_decode($a); 
            }
        }
        $conn->close();
    }
    */

    // ฟังชั่นเรียกใช้ข้อมูลจากฐานข้อมูล Products ทั้งหมด
    public function imgView($type, $id) {
        if(isset($type) && isset($id)) {
            if($type == 'prod') {
                $this->getProdImg($id);
            } else if($type == 'cust') {
                $this->getCustImg($id);
            } else if($type == 'pkg') {
                $this->getPkgImg($id);
            } else if($type == 'pkg1') {
                $this->getPkgImg1($id);
            } else if($type == 'pkg2') {
                $this->getPkgImg2($id);
            } else if($type == 'pkg3') {
                $this->getPkgImg3($id);
            }
        }
    }
}

?>