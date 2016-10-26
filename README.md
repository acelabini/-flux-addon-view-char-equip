# -flux-addon-view-char-equip

![alt tag](http://image.prntscr.com/image/476b146a6e77491a94abca808be55dfb.png)

A simple flux free addon that can view a character in-game equipment and status. 

Instructions:

1. Clone using git or download as zip
2. Copy and paste to your flux folder
3. go to modules\character\pagemenu\ and open view.php

Add this code before <b>return $pageMenu</b>
```
if ($isMine && $auth->actionAllowed('character', 'viewinventory')) {
	$pageMenu['View In-game Equipment'] = $this->url('character', 'viewinventory', array('id' => $char->char_id));
}
```
Test by going to your flux site, login and go to my account, chose your character, then in the upper menu click View In-game equipment

How to add my server items?

1. item should be in item_db or item_db2
2. go to addons\viewinventory\data\
3. paste your server idnum2itemresnametable.txt and cardprefixnametable.txt which can be found in your grf
3. go to data\texture\유저인터페이스
4. put your item icon in item folder

Collection item soon



Written by Axis ( x13th of rA & herc )
