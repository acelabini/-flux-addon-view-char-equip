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
        // Search for card prefix name
        $cardprefixnametable = searchFile('cardprefixnametable.txt',$cards, $item);

        // VVS item //
        $strong = "";
        if ($item->card0 == 255 && intval($item->card1/1280) > 0):
            for ($i = 0; $i < intval($item->card1/1280); $i++):
                $strong .= 'Very';
            endfor;
            $strong .= 'Strong';
        endif;
        $item_refine = $item->refine > 0 ? '+'.$item->refine.' ' : '';
        $item_slot = $item->slots > 0 ? ' ['.$item->slots.']' : '';
        // VVS end//

        return $item->equip == $item_location ?
            (object)[
                'nameid'        => $item->nameid,
                'name_japanese' => $item_refine.$strong.$cardprefixnametable.$item->name_japanese.$item_slot,
                'cardsOver'     => $item->cardsOver,
                'card0'         => $cards[$item->card0],
                'card1'         => $cards[$item->card1],
                'card2'         => $cards[$item->card2],
                'card3'         => $cards[$item->card3]
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

    function getItemDesc($item)
    {
        $idnum2itemdesctable = searchFile('idnum2itemdesctable.txt',$item);
        return $idnum2itemdesctable;
    }
    function getImage($item, $mod, $ajax = null)
    {
        // Search for item image
        $filename = searchFile('idnum2itemresnametable.txt',$item);
        $url = VIpath().'data/texture/유저인터페이스/'.$mod.'/'.$filename.'.bmp';
        $url = $ajax == null ? '?module=character&action=generateImage&type='.$mod.'&image='.$url : $url;
        return $url;
    }
    function searchFile($filename, $string, $item = null)
    {
        $file = VIpath().'data/'.$filename;
        $contents = file_get_contents($file);
        if(is_array($string)){
            $card_name = [];
            for($i = 0; $i<=3; $i++){
                $card = 'card'.$i;
                if($item->$card != 0) {
                    $pattern = preg_quote($item->$card, '/');
                    $pattern = "/^.*$pattern.*\$/m";
                    if (preg_match_all($pattern, $contents, $matches)) {
                        $match = substr(substr($matches[0][0], strpos($matches[0][0], "#") + 1, -1), 0, -1);
                        $match = mb_convert_encoding($match, 'UTF-8', 'EUC-KR');
                        $card_name[] = $match;
                    }
                }
            }
            $card_pri = [2=>'Double',3=>'Triple',4=>'Quadruple'];
            $cardArray = $card_name;
            $card_name = "";
            foreach(array_count_values($cardArray) as $card => $count){
                if($count > 1){
                    $card_name .= $card_pri[$count]." ";
                }
                $card_name .= $card." ";
            }
            return $card_name;
        }else {
            $pattern = preg_quote($string, '/');
            $pattern = "/^.*$pattern.*\$/m";
            if (preg_match_all($pattern, $contents, $matches)) {
                $match = substr(substr($matches[0][0], strpos($matches[0][0], "#") + 1, -1), 0, -1);
                $match = mb_convert_encoding($match, 'UTF-8', 'EUC-KR');
                return $match;
            }
        }
        return "";
    }
    function dd()
    {
        array_map(function($x) { var_dump($x); }, func_get_args());
        die;
    }
