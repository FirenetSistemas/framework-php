<?php
namespace FirenetSolucoes\system\helpers;

class CaptchaHelper {
    private $width, $height, $image, $background, $font, $fontColor, $fontSize, $numberOfLinesSpace, $length;
    private $tokenText, $tokenId = 'token';

    public function setSizeImage($width, $height) {
        if (is_int($width)) {
            $this->width = $width;
        } else {
            $this->width = 200;
        }
        if (is_int($height)) {
            $this->height = $height;
        } else {
            $this->height = 100;
        }
        $this->image = imagecreatetruecolor($this->width, $this->height);
    }

    public function setColorBackground($r, $g, $b) {
        if ($r >= 0 && $r <= 255 && $g >= 0 && $b <= 255 && $b >= 0 && $b <= 255) {
            $this->background = imagecolorallocate($this->image, $r, $g, $b);
        } else {
            $this->background = imagecolorallocate($this->image, 255, 255, 255);
        }
    }

    public function setFont($font, $size, $rgb) {
        if ($rgb[0] >= 0 && $rgb[0] <= 255 && $rgb[1] >= 0 && $rgb[1] <= 255 && $rgb[2] >= 0 && $rgb[2] <= 255) {
            $this->fontColor = imagecolorallocate($this->image, $rgb[0], $rgb[1], $rgb[2]);
        } else {
            $this->fontColor = imagecolorallocate($this->image, 90, 90, 90);
        }
        if (is_int($size)) {
            $this->fontSize = $size;
        } else {
            $this->fontSize = 40;
        }
        $this->font = $font;
    }

    public function __destruct() {
        imagedestroy($this->image);
    }

    private function filters() {
        imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);
        imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);
        imagefilter($this->image, IMG_FILTER_GAUSSIAN_BLUR);
    }

    public function showCaptcha($length) {
        header("Content-type: image/png");
        $this->numberOfLinesSpace = rand(7, 7);
        $this->length = $length;
		//$this->createBackground();
        $this->generateCaptchaText();
        $this->showText();
        $this->filters();
        session_start();
        $_SESSION[$this->tokenId] = $this->tokenText;
        imagepng($this->image);
    }

    private function showText() {
        for ($i = 0; $i < strlen($this->tokenText); $i++) {
            imagettftext($this->image, $this->fontSize, rand(-20, 20), $i * $this->fontSize / 2 + 10, $this->height / 2 + 10 + rand(-5, 5), $this->fontColor, $this->font, $this->tokenText[$i]);
        }
    }

    private function createBackground() {
        imagefilledrectangle($this->image, 0, 0, $this->width, $this->height, $this->background);
        for ($x = 0; $x <= $this->width; $x+=$this->numberOfLinesSpace) {
            imageline($this->image, $x, 0, $x, $this->height, $this->randomColor());
        }
        for ($y = 0; $y <= $this->width; $y+=$this->numberOfLinesSpace) {
            imageline($this->image, 0, $y, $this->width, $y, $this->randomColor());
        }
        imagefilledellipse($this->image, rand(0, $this->width), rand(0, $this->height), rand(0, 130), rand(0, 90), $this->randomColor());
        imagefilledellipse($this->image, rand(0, $this->width), rand(0, $this->height), rand(0, 130), rand(0, 90), $this->randomColor());
    }

    private function generateCaptchaText() {
        $this->tokenText = substr(md5(uniqid(time())), 0 - $this->length);
    }

    private function randomColor() {
        return imagecolorallocate($this->image, rand(0, 255), rand(0, 255), rand(0, 255));
    }

}