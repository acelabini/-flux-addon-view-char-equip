# -flux-addon-view-char-equip

![alt tag](http://image.prntscr.com/image/e6021e27cf6f48b6b8769866ccc92bc4.png)

A simple flux free addon that can view a character in-game equipment and status. 

Instructions:

1. Clone using git or download as zip
2. Copy and paste to your flux folder
3. go to modules\character\pagemenu\ and open view.php

Add this code before <b>return $pageMenu</b>
```
if ($isMine && $auth->actionAllowed('character', 'viewinventory')) {
	$pageMenu['View Inventory'] = $this->url('character', 'viewinventory', array('id' => $char->char_id));
}
```
Test by going to your flux site, login and go to my account, chose your character, then in the upper menu click View Inventory

How to add my server items?
1. item should be in item_db or item_db2
2. go to addons\viewinventory\data\
3. paste your server idnum2itemdesctable.txt and idnum2itemresnametable.txt which can be found in your grf
3. go to data\texture\유저인터페이스
4. put your item images

item folder 
-item icon
collection folder
-item full image


Written by Axis ( x13th of rA & herc )
