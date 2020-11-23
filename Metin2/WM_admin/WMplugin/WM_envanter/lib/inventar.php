<link rel="stylesheet" type="text/css" href="<?=WM_admin_plugin.'WM_envanter_ortak/envanter/style.css'?>">
	
<?php

function WM_envanter($karakter, $id = 0){

global $WMadmin, $odb;

?>

<div id="inventar_wrap">
<div id="inventar">
	<div id="inv_top"></div>
	<div id="inv_page"></div>
	<div id="inv_con"></div>
	<div id="inv_bottom"></div>
</div>
<div id="inv_layer">
	<div id="inv_lay_1">
	<?php
	$user_gold = $WMadmin->karakter($karakter, "gold");
	$user_gold_length = strlen($user_gold);
		
	$equip = array();
	$equip_count = array();
	
	$inventar = array();
	$inventar_count = array();
	
			$sql2 = $odb->prepare("SELECT item.pos, item.vnum, item.count, item.window, item_proto.type FROM `player`.`item` 
			INNER JOIN player.item_proto
			ON item_proto.vnum = item.vnum
			WHERE `owner_id`= ? && (window = ? || window = ? ) GROUP BY item.id ORDER BY `pos`");
			$sql2->execute(array($id, 'INVENTORY', 'EQUIPMENT'));
			
			foreach($sql2 as $res2) {
		if($res2['window']=='EQUIPMENT') {
			$equip_length = strlen($res2['vnum']);
			switch($equip_length) {
				case '1':
					$res2['vnum'] = '0000'.$res2['vnum'];
				break;
				case '2':
					$res2['vnum'] = '000'.$res2['vnum'];
				break;
				case '3':
					$res2['vnum'] = '00'.$res2['vnum'];
				break;
				case '4':
					$res2['vnum'] = '0'.$res2['vnum'];
				break;
			}
			$equip[$res2['pos']] = substr($res2['vnum'], 0, -1);
			$equip_count[$res2['pos']] = $res2['count'];
		} elseif($res2['window']=='INVENTORY') {
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
			
					if(!file_exists('../WM_envanter_ortak/'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$item.'.png')) {
						$inventar[$res2['pos']] = $item;
					} else {
						$inventar[$res2['pos']] = "30130";
					}
					$inventar_count[$res2['pos']] = $res2['count'];
		}
	}
	echo '<div id="il1_4" class="il1_con">';
		if(isset($equip[4])) {echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$equip[4].'0.png" alt="">';}
	echo '</div><div id="il1_1" class="il1_con">';
		if(isset($equip[1])) {echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$equip[1].'0.png" alt="">';}
	echo '</div><div id="il1_0" class="il1_con">';
		if(isset($equip[0])) {echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$equip[0].'0.png" alt="">';}
	echo '</div><div id="il1_2" class="il1_con">';
		if(isset($equip[2])) {echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$equip[2].'0.png" alt="">';}
	echo '</div><div id="il1_10" class="il1_con">';
		if(isset($equip[10])) {echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$equip[10].'0.png" alt="">';}
	echo '</div><div id="il1_3" class="il1_con">';
		if(isset($equip[3])) {echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$equip[3].'0.png" alt="">';}
	echo '</div><div id="il1_6" class="il1_con">';
		if(isset($equip[6])) {echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$equip[6].'0.png" alt="">';}
	echo '</div><div id="il1_5" class="il1_con">';
		if(isset($equip[5])) {echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$equip[5].'0.png" alt="">';}
	echo '</div><div id="il1_9" class="il1_con">';
		if(isset($equip[9])) {echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$equip[9].'0.png" alt=""><div class="item_count">'.$equip_count[9].'</div>';}
	echo '</div>';
	?>
	</div>
	<div id="inv_page2">
	
	<?php if($WMadmin->serverbilgi("envanter") == 2){?>
	
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=1" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==1 || !@$_REQUEST['sutun']) {echo WM_admin_plugin.'WM_envanter_ortak/img/env2/inv_pag1_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env2/inv_pag1_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=2" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==2) {echo WM_admin_plugin.'WM_envanter_ortak/img/env2/inv_pag2_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env2/inv_pag2_in.png';} ?>" alt="">
		</a>
		
	<?php }else if($WMadmin->serverbilgi("envanter") == 3){ ?>
		<div style="margin-left:8px">
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=1" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==1 || !@$_REQUEST['sutun']) {echo WM_admin_plugin.'WM_envanter_ortak/img/env3/inv_pag1_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env3/inv_pag1_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=2" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==2) {echo WM_admin_plugin.'WM_envanter_ortak/img/env3/inv_pag2_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env3/inv_pag2_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=3" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==3) {echo WM_admin_plugin.'WM_envanter_ortak/img/env3/inv_pag3_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env3/inv_pag3_in.png';} ?>" alt="">
		</a>
		</div>

	<?php }else if($WMadmin->serverbilgi("envanter") == 4){ ?>
		<div style="margin-left:8px">
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=1" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==1 || !@$_REQUEST['sutun']) {echo WM_admin_plugin.'WM_envanter_ortak/img/env4/inv_pag1_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env4/inv_pag1_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=2" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==2) {echo WM_admin_plugin.'WM_envanter_ortak/img/env4/inv_pag2_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env4/inv_pag2_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=3" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==3) {echo WM_admin_plugin.'WM_envanter_ortak/img/env4/inv_pag3_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env4/inv_pag3_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=4" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==4) {echo WM_admin_plugin.'WM_envanter_ortak/img/env4/inv_pag4_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env4/inv_pag4_in.png';} ?>" alt="">
		</a>
		</div>
	<?php }else if($WMadmin->serverbilgi("envanter") == 5){ ?>
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=1" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==1 || !@$_REQUEST['sutun']) {echo WM_admin_plugin.'WM_envanter_ortak/img/env5/inv_pag1_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env5/inv_pag1_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=2" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==2) {echo WM_admin_plugin.'WM_envanter_ortak/img/env5/inv_pag2_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env5/inv_pag2_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=3" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==3) {echo WM_admin_plugin.'WM_envanter_ortak/img/env5/inv_pag3_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env5/inv_pag3_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=4" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==4) {echo WM_admin_plugin.'WM_envanter_ortak/img/env5/inv_pag4_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env5/inv_pag4_in.png';} ?>" alt="">
		</a>
		<a href="index.php?sayfa=karakterler&id=<?=$id;?>&name=<?=$karakter;?>&gor=envanter&sutun=5" class="page_link">
			<img src="<?php if(@$_REQUEST['sutun']==5) {echo WM_admin_plugin.'WM_envanter_ortak/img/env5/inv_pag5_ac.png';} else {echo WM_admin_plugin.'WM_envanter_ortak/img/env5/inv_pag5_in.png';} ?>" alt="">
		</a>
	<?php } ?>
		
		<div class="clear"></div>
	</div>
	
	
	<div id="inv_lay_2">
	<div id="equip_show"></div>
		<?php
		if(@!$_REQUEST['sutun'] || @$_REQUEST['sutun'] == 1 || !@isset($_REQUEST['sutun']))
		{
		$start = 0; $end = 44;
			
		}
		if(@$_REQUEST['sutun'] == 2)
		{
		$start = 45; $end = 89;
		}
		if($WMadmin->serverbilgi("envanter") >= 3 && @$_REQUEST['sutun'] == 3 )
		{
		$start = 90; $end = 134;
		}
		if($WMadmin->serverbilgi("envanter") >= 4 && @$_REQUEST['sutun'] == 4 )
		{
		$start = 135; $end = 179;
		}
		if($WMadmin->serverbilgi("envanter") == 5 && @$_REQUEST['sutun'] == 5 )
		{
		$start = 180; $end = 224;
		}
		for($i=$start; $i<=$end; $i++) {
			echo '<div id="il2_'.$i.'" class="il2_con">';
			if(isset($inventar[$i])) {
				if(strlen($inventar[$i])==4) {
					echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$inventar[$i].'0.png" alt="">';
				} else {
					echo '<img src="'.$WMadmin->ayarlar("base").'WM_global/img/item/'.$inventar[$i].'.png" alt="">';
				}
				if($inventar_count[$i]>'1') {
					echo '<div class="item_count">'.$inventar_count[$i].'</div>';
				}
			}
			echo '</div>';
			if(($i+1)%5==0) {
				echo '<div class="clear"></div>';
			}
		}
		?>
	</div>
	<div id="inv_lay_3">
	<?php echo number_format($user_gold, 0, '.', '.');?>
	Yang</div>
</div>
</div>

<?php } ?>


<link rel="stylesheet" type="text/css" href="<?=WM_admin_plugin.'WM_envanter_ortak/envanter/js/functions.js'?>">

