<link rel="stylesheet" type="text/css" href="<?=WM_admin_plugin.'WM_envanter_ortak/nesne_market/style.css'?>">
<?php

function WM_nesne_market($user){
	
global $WMadmin, $odb;
		
			echo '<div id="nesneinventar_wrap">
	<div id="nesneinventar">
	<div id="nesneinv_page"></div>
	<div id="nesneinv_con"></div>
	</div>
	<div id="nesneinv_layer">
	<div id="nesneinv_lay_1">';
		
			$sql2 = $odb->prepare("SELECT item.pos, item.vnum, item.count, item.window, item_proto.type FROM `player`.`item` 
			INNER JOIN player.item_proto
			ON item_proto.vnum = item.vnum
			WHERE `owner_id`= ? && window = ? GROUP BY item.id ORDER BY `pos`");
			$sql2->execute(array($user, 'MALL'));
			while($res2 = $sql2->fetch(PDO::FETCH_ASSOC)) {
				if($res2['window']=='MALL') {
					$inventar_length = strlen($res2['vnum']);
					$vnum = $res2['vnum'];
					if(strlen($vnum) == 1){
						$bilgi = "0000".$vnum;
						$bilgi2 = substr($bilgi, 0, -1)."0";
					}else if(strlen($vnum) == 2){
						$bilgi = "000".$vnum;
						$bilgi2 = substr($bilgi, 0, -1)."0";
					}else if(strlen($vnum) == 3){
						$bilgi = "00".$vnum;
						$bilgi2 = substr($bilgi, 0, -1)."0";
					}else if(strlen($vnum) == 4){
						$bilgi = "0".$vnum;
						$bilgi2 = substr($bilgi, 0, -1)."0";
					}else if(strlen($vnum) == 5){
						$bilgi = $vnum;
						$bilgi2 = substr($bilgi, 0, -1)."0";
					}
					
					if($res2["type"] == 1 || $res2["type"] == 2){
						$item = $bilgi2;
					}else{
						$item = $bilgi;
					}
								
					if(!file_exists('../WM_envanter_ortak/img/item/'.$item.'.png')) {
						$inventar[$res2['pos']] = $item;
					} else {
						$inventar[$res2['pos']] = "30130";
					}
					$inventar_count[$res2['pos']] = $res2['count'];
				}
			}
			echo '<div id="nesneil1_4" class="nesneil1_con"></div></div>
			<div id="nesneinv_page2">
			<div class="clear"></div>
			</div>
			<div id="nesneinv_lay_2">
			';
			$start = 0; $end = 44;
			for($i=$start; $i<=$end; $i++) {
				echo '<div id="nesneil2_'.$i.'" class="nesneil2_con">';
				if(isset($inventar[$i])) {
					if(strlen($inventar[$i])==4) {
						echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$inventar[$i].'0.png" alt="">';
					} else {
						echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$inventar[$i].'.png" alt="">';
					}
					if($inventar_count[$i]>'1') {
						echo '<div class="nesneitem_count">'.$inventar_count[$i].'</div>';
					}
				}
				echo '</div>';
				if(($i+1)%5==0) {
					echo '<div class="clear"></div>';
				}
			}
		
	
	
		echo '</div></div></div>';
		
}

?>


