<?php
if (!defined('FLUX_ROOT')) exit;


if (Flux::config('UseCleanUrls') == true && Flux::config('BaseURI') == '/') {
    $VIpath = $this->basePath.FLUX_ADDON_DIR.'/viewinventory/';
} else if (Flux::config('UseCleanUrls') == true ) {
    $VIpath = $this->basePath.'/'.FLUX_ADDON_DIR.'/viewinventory/';
} else {
    $VIpath = FLUX_ADDON_DIR.'/viewinventory/';
}

$this->loginRequired();

require_once 'Flux/TemporaryTable.php';
require_once $VIpath.'lib/functions/ViewInventory.php';

$fromTables = array("{$server->charMapDatabase}.item_db", "{$server->charMapDatabase}.item_db2");
$tableName = "{$server->charMapDatabase}.items";
$tempTable = new Flux_TemporaryTable($server->connection, $tableName, $fromTables);

$charID = $params->get('id');
if (!$charID) {
    $this->deny();
}

$char = $server->getCharacter($charID);
if ($char) {

    if ($char->account_id != $session->account->account_id) {
        $this->deny();
    }
    $col  = "inventory.*, items.name_japanese, items.type, items.slots, items.view, items.equip_locations, c.char_id, c.name AS char_name";

    $sql  = "SELECT $col FROM {$server->charMapDatabase}.inventory ";
    $sql .= "LEFT JOIN {$server->charMapDatabase}.items ON items.id = inventory.nameid ";
    $sql .= "LEFT JOIN {$server->charMapDatabase}.`char` AS c ";
    $sql .= "ON c.char_id = IF(inventory.card0 IN (254, 255), ";
    $sql .= "IF(inventory.card2 < 0, inventory.card2 + 65536, inventory.card2) ";
    $sql .= "| (inventory.card3 << 16), NULL) ";
    $sql .= "WHERE inventory.char_id = ? ";

    if (!$auth->allowedToSeeUnknownItems) {
        $sql .= 'AND inventory.identify > 0 ';
    }

    $sql .= "ORDER BY IF(inventory.equip > 0, 1, 0) DESC, inventory.nameid ASC, inventory.identify DESC, ";
    $sql .= "inventory.attribute DESC, inventory.refine ASC";

    $sth  = $server->connection->getStatement($sql);
    $sth->execute(array($char->char_id));
    $items = $sth->fetchAll();

    if ($items) {
        $charView = array();
        $cards = array();
        $cardIDs = array();
        $itemView = array();
        $itemInventory = array();
        $gender = $session->account->sex == 'M' ? 1 : 0;
        $headgear_equip = [1,256,512];
        foreach ($items as $item) {
            $itemView[] = $item->equip;
        }
        foreach ($items as $item) {
            $item->cardsOver = -$item->slots;

            if ($item->card0) {
                $cardIDs[] = $item->card0;
                $item->cardsOver++;
            }
            if ($item->card1) {
                $cardIDs[] = $item->card1;
                $item->cardsOver++;
            }
            if ($item->card2) {
                $cardIDs[] = $item->card2;
                $item->cardsOver++;
            }
            if ($item->card3) {
                $cardIDs[] = $item->card3;
                $item->cardsOver++;
            }
            if ($item->card0 == 254 || $item->card0 == 255 || $item->card0 == -256 || $item->cardsOver < 0) {
                $item->cardsOver = 0;
            }
            if ($cardIDs) {
                $ids = implode(',', array_fill(0, count($cardIDs), '?'));
                $sql = "SELECT id, name_japanese FROM {$server->charMapDatabase}.items WHERE id IN ($ids)";
                $sth = $server->connection->getStatement($sql);

                $sth->execute($cardIDs);
                $temp = $sth->fetchAll();
                if ($temp) {
                    foreach ($temp as $card) {
                        $cards[$card->id] = $card->name_japanese;
                    }
                }
            }
            unset($cardIDs);
            $cardIDs = array();
            $Items = array(
                'Lower_headgear'            =>    get_item_pos(1, $item, $cards),
                'Right_hand'                =>    get_item_pos(2, $item, $cards),
                'Mantle'                    =>    get_item_pos(4, $item, $cards),
                'Accessory_1'               =>    get_item_pos(8, $item, $cards),
                'Armor'                     =>    get_item_pos(16, $item, $cards),
                'Left_hand'                 =>    get_item_pos(32, $item, $cards),
                'Shoes'                     =>    get_item_pos(64, $item, $cards),
                'Accessory_2'               =>    get_item_pos(128, $item, $cards),
                'Upper_headgear'            =>    get_item_pos(256, $item, $cards),
                'Middle_headgear'           =>    get_item_pos(512, $item, $cards),
                //TODO: Implement this
//                'Costume_Top_Headgear'      =>    get_item_pos(1024, $item, $cards),
//                'Costume_Mid_Headgear'      =>    get_item_pos(2048, $item, $cards),
//                'Costume_Low_Headgear'      =>    get_item_pos(4096, $item, $cards),
//                'Costume_Garment'           =>    get_item_pos(8192, $item, $cards),
//                'Arrow_Type'                =>    get_item_pos(32768, $item, $cards),
//                'Shadow_Armor'              =>    get_item_pos(65536, $item, $cards),
//                'Shadow_Weapon'             =>    get_item_pos(131072, $item, $cards),
//                'Shadow_Shield'             =>    get_item_pos(262144, $item, $cards),
//                'Shadow_Shoes'              =>    get_item_pos(524288, $item, $cards),
//                'Shadow_Accessory_2'        =>    get_item_pos(1048576, $item, $cards),
//                'Shadow_Accessory_1'        =>    get_item_pos(2097152, $item, $cards),
            );
            unset($cards);
            $cards = array();
            array_push($itemInventory, array_filter($Items));
            foreach($headgear_equip as $hg){
                if($item->equip == $hg){
                    $itemV = in_array($hg, $itemView) ? $item->view : -$hg;
                    $itemLoc = in_array($hg, $itemView) ? $item->equip_locations : 0;
                    $charView[] = 'http://ro-character-simulator.ratemyserver.net/charsim.php?gender=' . $gender . '&job=' . $char->class . '&hair=' . $char->hair . '&viewid=' . $itemV . '&location=' . $itemLoc . '&direction=0&action=0&hdye=0&dye=0&framenum=0&bg=0&cart=&mount=0&shield=0&weapon=0';
                }
            }
        }
        $itemInventory = (object)array_merge(...$itemInventory);
    }
}


