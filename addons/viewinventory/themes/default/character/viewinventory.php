<?php if (!defined('FLUX_ROOT')) exit;  ?>
<style>
    #Table_01 td {
        position: relative;
    }
    #Table_01 a {
        cursor: pointer;
        font-size: 11.5px;
        left: 0;
        line-height: 11px;
        padding-top: 4px;
        position: absolute;
        text-overflow: ellipsis;
    }
    #Table_01{
        background:rgba(0, 0, 0, 0) url('<?php echo $this->themePath('img/charEQ.png') ?>'
        ) no-repeat scroll center center
    }
    .statusPoints {
        display: block;
        font-size: 12px;
        padding-left: 3px;
    }
</style>
    <h2>Inventory</h2>
<?php if ($char): ?>
    <?php if (!empty($errorMessage)): ?>
        <p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
    <?php endif ?>
    <h3>Viewing character inventory for “<?php echo ($charName=htmlspecialchars($char->name))  ?>” on <?php echo htmlspecialchars($server->serverName) ?></h3>
    <?php

    foreach($charView as $i => $charV) :
            echo '<img src="'.$charV.'" style="display:none;" id="char'.$i.'">';
    endforeach; ?>
    <table id="Table_01" width="280" height="269" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="7">
                <img src="<?php echo $this->themePath('img/equipwin_bg2_01.gif') ?>"  alt=""></td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo $itemInventory->Upper_headgear->nameid;?>"  alt="" title="<?php echo post_card($itemInventory->Upper_headgear); ?>"></td>
            <td colspan="3">
                <img src="<?php echo $this->themePath('img/equipwin_bg2_03.gif') ?>" width="72" height="26" alt="">
                <a title="<?php echo $itemInventory->Upper_headgear->name_japanese;  ?>">
                    <?php echo $itemInventory->Upper_headgear->name_japanese; ?>
                </a>
            </td>
            <td rowspan="11" class="wholeCharView">
            </td>
            <td>
                <img src="<?php echo $this->themePath('img/equipwin_bg2_05.gif') ?>" width="64" height="27" alt="">
                <a title="<?php echo $itemInventory->Middle_headgear->name_japanese; ?>">
                    <?php echo $itemInventory->Middle_headgear->name_japanese; ?>
                </a>
            </td>
            <td>
                <img src="<?php echo $itemInventory->Middle_headgear->nameid; ?>" alt="" title="<?php echo post_card($itemInventory->Middle_headgear); ?>"></td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo $itemInventory->Lower_headgear->nameid;  ?>" title="<?php echo post_card($itemInventory->Lower_headgear); ?>"></td>
            <td colspan="3">
                <img src="<?php echo $this->themePath('img/equipwin_bg2_08.gif') ?>" width="72" height="25" alt="">
                <a title="<?php echo $itemInventory->Lower_headgear->name_japanese;  ?>">
                    <?php echo $itemInventory->Lower_headgear->name_japanese;  ?>
                </a>
            </td>
            <td>
                <img src="<?php echo $this->themePath('img/equipwin_bg2_09.gif') ?>" width="64" height="25" alt="">
                <a title="<?php echo $itemInventory->Armor->name_japanese;  ?>">
                    <?php echo $itemInventory->Armor->name_japanese;  ?>
                </a> </td>
            <td>
                <img src="<?php  echo $itemInventory->Armor->nameid;  ?>" title="<?php echo post_card($itemInventory->Armor); ?>"  alt=""> </td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo $itemInventory->Right_hand->nameid;  ?>" alt="" title="<?php echo post_card($itemInventory->Right_hand); ?>"></td>
            <td colspan="3">
                <img src="<?php echo $this->themePath('img/equipwin_bg2_12.gif') ?>" width="72" height="27" alt="">
                <a title="<?php echo $itemInventory->Right_hand->name_japanese; ?>">
                    <?php echo $itemInventory->Right_hand->name_japanese; ?>
                </a>
            </td>
            <td>
                <img src="<?php echo $this->themePath('img/equipwin_bg2_13.gif') ?>" width="64" height="27" alt="">
                <a title="<?php echo $itemInventory->Left_hand->name_japanese;?>">
                    <?php echo $itemInventory->Left_hand->name_japanese; ?>
                </a>  </td>
            <td>
                <img src="<?php echo $itemInventory->Left_hand->nameid; ?>" title="<?php echo post_card($itemInventory->Left_hand); ?>"></td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo $itemInventory->Mantle->nameid;  ?>" title="<?php echo post_card($itemInventory->Mantle); ?>">
            </td>
            <td colspan="3">
                <img src="<?php echo $this->themePath('img/equipwin_bg2_16.gif') ?>" width="72" height="25" alt="">
                <a title="<?php echo $itemInventory->Mantle->name_japanese;?>">
                    <?php echo $itemInventory->Mantle->name_japanese; ?>
                </a>
            </td>
            <td>
                <img src="<?php echo $this->themePath('img/equipwin_bg2_17.gif') ?>" width="64" height="25 alt="">
                <a title="<?php echo $itemInventory->Shoes->name_japanese; ?>">
                    <?php echo $itemInventory->Shoes->name_japanese; ?>
                </a>
            </td>
            <td>
                <img src="<?php echo $itemInventory->Shoes->nameid;  ?>" title="<?php echo post_card($itemInventory->Shoes); ?>"> </td>
        </tr>
        <tr>
            <td>
                <img src="<?php echo $itemInventory->Accessory_1->nameid;   ?>" title="<?php echo post_card($itemInventory->Accessory_1); ?>">
            </td>
            <td colspan="3">
                <img src="<?php echo $this->themePath('img/equipwin_bg2_20.gif') ?>" width="72" height="28" alt="">
                <a title="<?php echo $itemInventory->Accessory_1->name_japanese;  ?>">
                    <?php echo $itemInventory->Accessory_1->name_japanese; ?>
                </a>
            </td>
            <td>
                <img src="<?php echo $this->themePath('img/equipwin_bg2_21.gif') ?>" width="64" height="28" alt="">
                <a title="<?php echo $itemInventory->Accessory_2->name_japanese;  ?>">
                    <?php echo $itemInventory->Accessory_2->name_japanese; ?>
                </a>
            </td>
            <td>
                <img src="<?php echo $itemInventory->Accessory_2->nameid;  ?>" title="<?php echo post_card($itemInventory->Accessory_2); ?>"> </td>
        </tr>
        <tr>
            <td colspan="4">
                <img src="<?php echo $this->themePath('img/equipwin_bg2_23.gif') ?>" width="104" height="24" alt=""></td>
            <td colspan="2" rowspan="9"> </td>
        </tr>
        <tr>
            <td colspan="2" rowspan="10">
                <img src="<?php echo $this->themePath('img/equipwin_bg2_25.gif') ?>" width="38" height="107" alt=""></td>
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
                <img src="<?php echo $this->themePath('img/spacer.gif') ?>" width="32" height="1" alt=""></td>
            <td>
                <img src="<?php echo $this->themePath('img/spacer.gif') ?>" width="6" height="1" alt=""></td>
            <td>
                <img src="<?php echo $this->themePath('img/spacer.gif') ?>" width="34" height="1" alt=""></td>
            <td>
                <img src="<?php echo $this->themePath('img/spacer.gif') ?>" width="32" height="1" alt=""></td>
            <td>
                <img src="<?php echo $this->themePath('img/spacer.gif') ?>" width="72" height="1" alt=""></td>
            <td>
                <img src="<?php echo $this->themePath('img/spacer.gif') ?>" width="70" height="1" alt=""></td>
        </tr>
    </table>
<script>
    $(document).ready(function(){
        var items=['char0','char1','char2'];
        var item = items[Math.floor(Math.random()*items.length)];
        for(var i = 0; i <= 3; i++) {
            $("#"+item).load(location.href + " #char2>*", "");
            $('.wholeCharView').removeAttr('style').css({
                width: 'auto',
                height: 'auto',
                background: 'rgba(0, 0, 0, 0) url( ' + $('#'+item).attr('src') + ' ) no-repeat scroll center 135%'
            });
        }
    });
</script>
<?php else: ?>
    <p>No such character found. <a href="javascript:history.go(-1)">Go back</a>.</p>
<?php endif ?>