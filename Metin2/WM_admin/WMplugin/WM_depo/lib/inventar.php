<link rel="stylesheet" type="text/css" href="<?=WM_admin_plugin.'WM_envanter_ortak/depo/style.css'?>">
				<div id="depoinv_page2">
		<a href="index.php?sayfa=kullanicilar&login=<?=$kfetch["login"];?>&sutun=1" class="depopage_link">
			<img src="<?php if(@$_REQUEST['sutun']==1 || !@$_REQUEST['sutun']) {echo WM_admin_plugin.'WM_envanter_ortak/img/inv_pag1_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/inv_pag1_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=kullanicilar&login=<?=$kfetch["login"];?>&sutun=2" class="depopage_link">
			<img src="<?php if(@$_REQUEST['sutun']==2) {echo WM_admin_plugin.'WM_envanter_ortak/img/inv_pag2_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/inv_pag2_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=kullanicilar&login=<?=$kfetch["login"];?>&sutun=3" class="depopage_link3">
			<img src="<?php if(@$_REQUEST['sutun']==3) {echo WM_admin_plugin.'WM_envanter_ortak/img/inv_pag3_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/inv_pag3_in.png';} ?>" alt="">
		</a>
		<div class="clear"></div>
	</div>

	
<?php
function WM_depo($user){
	
global $WMadmin, $odb;
		
			echo '<div id="depoinventar_wrap">
	<div id="depoinventar">
	<div id="depoinv_page"></div>
	<div id="depoinv_con"></div>
	</div>
	<div id="depoinv_layer">
	<div id="depoinv_lay_1">';
		
			$sql2 = $odb->prepare("SELECT item.pos, item.vnum, item.count, item.window, item_proto.type FROM `player`.`item` 
			INNER JOIN player.item_proto
			ON item_proto.vnum = item.vnum
			WHERE `owner_id`= ? && window = ? GROUP BY item.id ORDER BY `pos`");
			$sql2->execute(array($user, 'SAFEBOX'));
			while($res2 = $sql2->fetch(PDO::FETCH_ASSOC)) {
				if($res2['window']=='SAFEBOX') {
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
								
					$inventar[$res2['pos']] = $item;
						
					$inventar_count[$res2['pos']] = $res2['count'];
				}
			}
			echo '<div id="depoil1_4" class="depoil1_con"></div></div>
			<div id="depoinv_page2">
			<div class="clear"></div>
			</div>
			';?>

			<?php
			echo '<div id="depoinv_lay_2">
			';
			if(isset($_REQUEST['sutun']) && $_REQUEST['sutun']==2) {
			$start = 45; $end = 89;
			}else if(isset($_REQUEST['sutun']) && $_REQUEST['sutun']==3) {
			$start = 90; $end = 134;
			}
			else {
			$start = 0; $end = 44;
			}
			for($i=$start; $i<=$end; $i++) {
				echo '<div id="depoil2_'.$i.'" class="depoil2_con">';
				if(isset($inventar[$i])) {
					if(strlen($inventar[$i])==4) {
						echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$inventar[$i].'0.png" alt="">';
					} else {
						echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$inventar[$i].'.png" alt="">';
					}
					if($inventar_count[$i]>'1') {
						echo '<div class="depoitem_count">'.$inventar_count[$i].'</div>';
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

<link rel="stylesheet" type="text/css" href="<?=WM_admin_plugin.'WM_envanter_ortak/depo/js/functions.js'?>">

