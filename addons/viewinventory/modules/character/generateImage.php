<?php
if (!defined('FLUX_ROOT')) exit;
$type = $params->get('type');
if($type == 'item') {
    require_once 'functions/imagecreatefrombmpstring.php';

    $img = $params->get('image');
    $url = $_SERVER['SERVER_NAME'] . Flux::config('BaseURI') . '/' . $img;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    $bmp = curl_exec($ch);
    curl_close($ch);

    $image = imagecreatefrombmpstring($bmp);

    header("Content-Type: image/png");
    imagepng($image);
}else if($type == 'collection'){
    if (Flux::config('UseCleanUrls') == true && Flux::config('BaseURI') == '/') {
        $VIpath = $this->basePath.FLUX_ADDON_DIR.'/viewinventory/';
    } else if (Flux::config('UseCleanUrls') == true ) {
        $VIpath = $this->basePath.'/'.FLUX_ADDON_DIR.'/viewinventory/';
    } else {
        $VIpath = FLUX_ADDON_DIR.'/viewinventory/';
    }
    require_once $VIpath.'lib/functions/ViewInventory.php';
    $item_id = $params->get('item_id');
    $data = [
        'image_url' =>  getImage($item_id,'collection', 1)

    ];
    echo json_encode($data);
//    echo getItemDesc($item_id);
    exit;
}
?>