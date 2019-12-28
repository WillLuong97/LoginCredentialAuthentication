<?php
    session_start();
    
    //generating random combination of characters to for captcha
    //using md5 for secret codes.
    $str_rand = md5(rand());
    //limiting the range of the random combination.
    $str = substr($str_rand, 0,6);

    $_SESSION['captcha'] = $str;
    //creating random images.
    $newImage = imagecreate(100, 30);
    imagecolorallocate($newImage, 220, 220, 255);
    $col=imagecolorallocate($newImage, 0, 0,0);
    imagestring($newImage, 29, 10, 2, $str, $col);
    header('content:image/jpeg');
    imagejpeg($newImage);
?>


    