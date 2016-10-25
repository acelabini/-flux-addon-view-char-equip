<?php
/**
 * Created by x13th
 * Date: 10/25/2016
 * Time: 10:00 AM
 */
    function VIpath()
    {
        if (Flux::config('UseCleanUrls') == true && Flux::config('BaseURI') == '/') {
            $VIpath = $this->basePath.FLUX_ADDON_DIR.'/viewinventory/';
        } else if (Flux::config('UseCleanUrls') == true ) {
            $VIpath = $this->basePath.'/'.FLUX_ADDON_DIR.'/viewinventory/';
        } else {
            $VIpath = FLUX_ADDON_DIR.'/viewinventory/';
        }
        return $VIpath;
    }
    function get_item_pos( $item_location, $item, $cards )
    {
        $add_card = [];
        for($i = count($cards); $i <= 3; $i++){
            $add_card[] = null;
        }
        $cards = array_merge($cards, $add_card);
        $File = searchFile('idnum2itemresnametable.txt',$item->nameid);
        $image = getImage($File,'item');
        $item_refine = $item->refine > 0 ? '+'.$item->refine.' ' : '';
        $item_slot = $item->slots > 0 ? '['.$item->slots.']' : '';
        return $item->equip == $item_location ?
            (object)[
                'nameid'        => $image,
                'name_japanese' => $item_refine.$item_slot.$item->name_japanese,
                'card0'         => $cards[0],
                'card1'         => $cards[1],
                'card2'         => $cards[2],
                'card3'         => $cards[3]
            ] : null;
    }

    function post_card($cards)
    {
        $card = $cards->card0;
        $card .= $cards->card1 ? "<br/>".$cards->card1 : '';
        $card .= $cards->card2 ? "<br/>".$cards->card2 : '';
        $card .= $cards->card3 ? "<br/>".$cards->card3 : '';
        return $card;
    }

    function getImage($filename, $mod)
    {
        $url = VIpath().'data/texture/유저인터페이스/'.$mod.'/'.$filename.'.bmp';
        $url = '?module=character&action=generateImage&image='.$url;
        return $url;
    }
    function searchFile($filename, $string)
    {
        $file = VIpath().'data/'.$filename;
        $searchfor = $string;
        $contents = file_get_contents($file);
        $pattern = preg_quote($searchfor, '/');
        $pattern = "/^.*$pattern.*\$/m";
        if(preg_match_all($pattern, $contents, $matches)){
            $match = substr(substr($matches[0][0],strpos($matches[0][0],"#") +1,-1),0,-1);
            $match =  mb_convert_encoding($match, 'UTF-8', 'EUC-KR');
            return $match ;
        }
        return "";
    }
    function dd()
    {
        array_map(function($x) { var_dump($x); }, func_get_args());
        die;
    }
