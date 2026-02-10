<?php

session_start();

function createCaptcha() {
    $captcha_code = '';
    for ($i = 0; $i < 6; $i++) {
        $captcha_code .= chr(rand(65, 90)); 
    }
    $_SESSION['captcha'] = $captcha_code;
    return $captcha_code;
}

function generateCaptchaImage($captcha_code) {
    $width = 120;
    $height = 40;
    $image = imagecreate($width, $height);
    $background = imagecolorallocate($image, 255, 255, 255);
    $text_color = imagecolorallocate($image, 0, 0, 0);


    imagestring($image, 5, 10, 10, $captcha_code, $text_color);

 
    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
}

$captcha_code = createCaptcha();
generateCaptchaImage($captcha_code);


?>
