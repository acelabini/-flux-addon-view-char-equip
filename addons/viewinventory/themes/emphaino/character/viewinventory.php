<?php if (!defined('FLUX_ROOT')) exit;
?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        #view_equip_tbl th,td{
            border: medium none;
            padding: 0;
        }
        #view_equip_tbl td {
            position: relative;
        }
        #view_equip_tbl a {
            cursor: pointer;
            font-size: 10.5px;
            left: 0;
            line-height: 11px;
            padding-top: 4px;
            position: absolute;
            text-overflow: ellipsis;
            width: 75px;
            height: 27px;
            max-height: 27px;
            overflow: hidden;
            white-space: nowrap;
        }
        #view_equip_tbl{
            background:rgba(0, 0, 0, 0) url('<?php echo $this->themePath('img/charEQ.png') ?>'
            ) no-repeat scroll center center
        }
        .statusPoints {
            display: block;
            font-size: 12px;
            padding-left: 3px;
        }
    </style>
    <h2>Equipment</h2>
<?php if ($char): ?>
    <?php if (!empty($errorMessage)): ?>
        <p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
    <?php endif ?>
    <h3>Viewing character equipment for “<?php echo ($charName=htmlspecialchars($char->name))  ?>” on <?php echo htmlspecialchars($server->serverName) ?></h3>
    <?php
    foreach($charView as $i => $charV) :
        echo '<img src="'.$charV.'" style="display:none;" id="char'.$i.'">';
    endforeach; ?>
    <table id="view_equip_tbl" width="280" height="269" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="7">
                <img src="<?php echo VIpath().'images/equipwin_bg2_01.gif' ?>"  alt=""></td>
        </tr>
        <!-- start -->
        <?php
        $right_item = [
            [ 'loc'=>'Upper_headgear','img_w'=>'72','img_h'=>'26','img'=>'03' ],
            [ 'loc'=>'Lower_headgear','img_w'=>'72','img_h'=>'25','img'=>'08' ],
            [ 'loc'=>'Right_hand'    ,'img_w'=>'72','img_h'=>'27','img'=>'12' ],
            [ 'loc'=>'Mantle'        ,'img_w'=>'72','img_h'=>'25','img'=>'16' ],
            [ 'loc'=>'Accessory_1'   ,'img_w'=>'72','img_h'=>'28','img'=>'20' ]
        ];
        $left_item = [
            [ 'loc'=>'Middle_headgear','img_w'=>'65','img_h'=>'27','img'=>'05' ],
            [ 'loc'=>'Armor'          ,'img_w'=>'64','img_h'=>'25','img'=>'09' ],
            [ 'loc'=>'Left_hand'      ,'img_w'=>'64','img_h'=>'27','img'=>'13' ],
            [ 'loc'=>'Shoes'          ,'img_w'=>'64','img_h'=>'25','img'=>'17' ],
            [ 'loc'=>'Accessory_2'    ,'img_w'=>'64','img_h'=>'28','img'=>'21' ]
        ];
        foreach($right_item as $left => $right_) :
            $right  = (object)$right_;
            $loc    = $right->loc;
            $img_w  = $right->img_w;
            $img_h  = $right->img_h;
            $img    = $right->img;

            $left     = (object)$left_item[$left];
            $l_loc    = $left->loc;
            $l_img_w  = $left->img_w;
            $l_img_h  = $left->img_h;
            $l_img    = $left->img;
            ?>
            <tr>
                <td>
                    <img src="<?php echo $itemInventory->$loc->nameid;  ?>" title="<?php echo post_card($itemInventory->$loc); ?>"></td>
                <td colspan="3">
                    <img src="<?php echo VIpath().'images/equipwin_bg2_'.$img.'.gif' ?>" width="<?php echo $img_w; ?>" height="<?php echo $img_h; ?>" alt="">
                    <a title="<?php echo $itemInventory->$loc->name_japanese;  ?>" <?php if (!$icon) echo ' colspan="2"' ?><?php if ($itemInventory->$loc->cardsOver) echo ' class="overslotted' . $itemInventory->$l_loc->cardsOver . '"'; else echo ' class="normalslotted"' ?>>
                        <?php echo $itemInventory->$loc->name_japanese;  ?>
                    </a>
                </td>
                <?php if($loc == 'Upper_headgear') : ?>
                <td rowspan="11" class="wholeCharView">
                    <?php endif; ?>
                <td>
                    <img src="<?php echo VIpath().'images/equipwin_bg2_'.$l_img.'.gif' ?>" width="<?php echo $l_img_w; ?>" height="<?php echo $l_img_h; ?>" alt="">
                    <a title="<?php echo $itemInventory->$l_loc->name_japanese;  ?>" <?php if (!$icon) echo ' colspan="2"' ?><?php if ($itemInventory->$l_loc->cardsOver) echo ' class="overslotted' . $itemInventory->$l_loc->cardsOver . '"'; else echo ' class="normalslotted"' ?>>
                        <?php echo $itemInventory->$l_loc->name_japanese;  ?>
                    </a> </td>
                <td>
                    <img src="<?php  echo $itemInventory->$l_loc->nameid;  ?>" title="<?php echo post_card($itemInventory->$l_loc); ?>"  alt=""> </td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="4">
                <img src="<?php echo VIpath().'images/equipwin_bg2_23.gif' ?>" width="104" height="24" alt=""></td>
            <td colspan="2" rowspan="9"> </td>
        </tr>
        <tr>
            <td colspan="2" rowspan="10">
                <img src="<?php echo VIpath().'images/equipwin_bg2_25.gif' ?>" width="38" height="107" alt=""></td>
            <td>
                <span class="statusPoints"><?php echo $char->str; ?></span></td>
            <td rowspan="10">
            </td>
        </tr>
        <tr>
            <td>
                <span class="statusPoints"><?php echo $char->agi; ?></span></td>
        </tr>
        <tr>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                <span class="statusPoints"><?php echo $char->vit; ?></span></td>
        </tr>
        <tr>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                <span class="statusPoints"><?php echo $char->int; ?></span></td>
            <td rowspan="5">
            </td>
        </tr>
        <tr>
            <td>
            </td>
        </tr>
        <tr>
            <td>
                <span class="statusPoints"><?php echo $char->dex ?></span></td>
        </tr>
        <tr>
            <td>
                <span class="statusPoints"><?php echo $char->luk; ?></span></td>
            <td>
                <span class="statusPoints"><?php echo $char->status_point; ?></span></td>
            <td rowspan="2">
            </td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td>
                <img src="<?php echo VIpath().'images/spacer.gif' ?>" width="32" height="1" alt=""></td>
            <td>
                <img src="<?php echo VIpath().'images/spacer.gif' ?>" width="6" height="1" alt=""></td>
            <td>
                <img src="<?php echo VIpath().'images/spacer.gif' ?>" width="34" height="1" alt=""></td>
            <td>
                <img src="<?php echo VIpath().'images/spacer.gif' ?>" width="32" height="1" alt=""></td>
            <td>
                <img src="<?php echo VIpath().'images/spacer.gif' ?>" width="72" height="1" alt=""></td>
            <td>
                <img src="<?php echo VIpath().'images/spacer.gif' ?>" width="70" height="1" alt=""></td>
        </tr>
    </table>
    <div>

    </div>
    <script>
        $(document).ready(function(){
            var items=['char0','char1','char2'];
            var item = items[Math.floor(Math.random()*items.length)];
            for(var i = 0; i <= 3; i++) {
                $("#"+item).load(location.href + " #char2>*", "");
                $('.wholeCharView').removeAttr('style').css({
                    width: '0px',
                    height: 'auto',
                    background: 'rgba(0, 0, 0, 0) url( ' + $('#'+item).attr('src') + ' ) no-repeat scroll center 135%'
                });
            }
        });
    </script>
<?php else: ?>
    <p>No such character found. <a href="javascript:history.go(-1)">Go back</a>.</p>
<?php endif ?>