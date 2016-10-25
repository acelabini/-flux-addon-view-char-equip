<?php
if (!defined('FLUX_ROOT')) exit;

require_once 'functions/imagecreatefrombmpstring.php';

    $img = $params->get('image');
    $url = $_SERVER['SERVER_NAME'].Flux::config('BaseURI').'/'.$img;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $bmp = curl_exec($ch);
    curl_close($ch);

    $image = imagecreatefrombmpstring($bmp);

    header("Content-Type: image/png");
    imagepng($image);
?>