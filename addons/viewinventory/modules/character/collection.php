<?php
/**
 * Created by x13th
 * Date: 10/25/2016
 * Time: 4:35 PM
 */

if (!defined('FLUX_ROOT')) exit;


if (Flux::config('UseCleanUrls') == true && Flux::config('BaseURI') == '/') {
    $VIpath = $this->basePath.FLUX_ADDON_DIR.'/viewinventory/';
} else if (Flux::config('UseCleanUrls') == true ) {
    $VIpath = $this->basePath.'/'.FLUX_ADDON_DIR.'/viewinventory/';
} else {
    $VIpath = FLUX_ADDON_DIR.'/viewinventory/';
}

$this->loginRequired();

require_once $VIpath.'lib/functions/ViewInventory.php';
