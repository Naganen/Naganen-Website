<script type="text/javascript">
					
	$('#itemdetay').fadeIn();
	$('#itembg').fadeIn();
	

	$('#itembg').live('click', function() {
		$('#itemdetay').fadeOut();
		$('#itembg').fadeOut();
	});
	
	$('a#kapat').live('click', function() {
		$('#itemdetay').fadeOut();
		$('#itembg').fadeOut();
	});
	
	

	
	
</script>

	<div id="itembg"><!-- --></div>
	<div id="detaybg" class="dimhides popupwindow">
	<div id="itemdetay" class="dimhides popupwindow">

<div class="box pattern pattern-sandstone">
<div class="box-header" style="background:#63393E; color:#fff;"><font style="padding:0 20px;"><?=$ifetch["isim"];?></font>  <a href="javascript:;" id="kapat" class="btn btn-danger btn-xs pull-right"><i class="fa fa-close"></i></a></div>
<?php if($ifetch["durum"] == 2){?><div class="table img"><div class="indirimli"></div></div><?php } ?>			
</div>

<form action="index.php?sayfa=satin_al&id=<?=$ifetch["id"];?>" method="post">

<table class="table beyaztable">
<tbody>
<tr>
<td WIDTH=11%>
<div class="img">
<img src="<?=$ifetch["resim"];?>" alt="daha fazla bilgi">
<?php if($ifetch["durum"] == 2){?><div class="indirimli"></div><?php } ?>
</div>										
										
</td>
<td WIDTH=70%><?=$ifetch["isim"];?><span class="line"></span> <?=$ifetch["aciklama"];?></td>
										
<td class="td-actions" WIDTH=20%>


<?php

										if($ifetch["sure_tur"] == 2)
										{
										$sure_parcala = explode(',', $ifetch["sure"]);
										
										if($sure_parcala[0] != 0 && $sure_parcala[1] != 0)
										{
											$sure2 = $sure_parcala[0].' gün'.$sure_parcala[1].' Saat';
										}
										
										else if($sure_parcala[0] != 0)
										{
											$sure2 = $sure_parcala[0].' gün';
										}
										else if($sure_parcala[1] != 0)
										{
											$sure2 = $sure_parcala[1].' saat';
										}
										else
										{
											$sure2 = 'Süre bulunamadı';
										}
																					
										$sure = '<div class="itemPrice">
											<p><i class="fa fa-clock-o"></i> <font color="red">'.$sure2.'</font></p>
										</div>';
										}
										else
										{
											$sure = "";
										}


?>										
										
<div class="itemPrice">
<p><?=$ifetch["miktar"];?> tanesi : <font color="lightgreen"><?=$ifetch["fiyat"];?> EP </font></p>
<?php if($ifetch["durum"] == 2){ ?> <div class="indirim-fiyat"></div><?php } ?>
</div>

<?php if($ifetch["durum"] == 2){ ?> <div class="itemPrice">
<p>Eski Fiyatı : <font color="red"><?=$ifetch["eskifiyat"];?> EP </font></p>
</div><?php } ?>

<?=$sure;?>
										
<?php if($ifetch["efsun"] == 0){ if($ifetch["durum"] == 2){ ?>
<button type="submit" href="javascript:;" name="satin_al"  class="btn btn-success"><i class="fa fa-shopping-cart"></i> Satın Al</button>
<?php }else{ ?>
<button type="submit" href="javascript:;" name="satin_al"  class="btn btn-info"><i class="fa fa-shopping-cart"></i> Satın Al</button>
<?php }} ?>
										
</td>
																				
</tr>
							
</tbody>
									
</table>

<?php 
if($ifetch["efsun"] == 1){ 

$efsunlar = $db->prepare("SELECT id FROM market_efsun WHERE tur LIKE ? && sid = ?");
$efsunlar->execute(array('%'.$ifetch["itemtur"].'%', $_SESSION["market_server"]));

$efsun_var = true;

if($efsunlar->rowCount()){
	
echo '<div class="span4" align="center"> <b> Efsun Seçin </b>';
	
for($i = 1; $i <= $vt->a("market_efsun"); $i++){
	
$efsunlarr = $db->prepare("SELECT * FROM market_efsun WHERE tur LIKE ? && sid = ?");
$efsunlarr->execute(array('%'.$ifetch["itemtur"].'%', $_SESSION["market_server"]));
		
echo '<select name="efsun-'.$i.'">';
	
foreach($efsunlarr as $efsun){

echo '<option value="'.$efsun["id"].'">'.$efsun["isim"].'</option>';

?>


<?php } echo '</select>';  } echo '</div>'; 

if($ifetch["itemtur"] == 1 || $ifetch["itemtur"] == 2)
{
	
$tas_kontrol = $db->prepare("SELECT id FROM market_tas WHERE tur = ? && sid = ?");
$tas_kontrol->execute(array($ifetch["itemtur"], $_SESSION["market_server"]));

if($tas_kontrol->rowCount())
{

echo '<div class="span4" align="center"> <b> Taş Seçin </b>';

for($i = 1; $i <= 3; $i++)
{
	
$taslar = $db->prepare("SELECT * FROM market_tas WHERE tur = ? && sid = ?");
$taslar->execute(array($ifetch["itemtur"], $_SESSION["market_server"]));

echo '<select name="tas-'.$i.'">';

foreach($taslar as $tas)
{
	
echo '<option value="'.$tas["id"].'">'.$tas["tas"].'</option>';
	
}

echo '</select>';
	
}

echo '</div> ';
}

}
 
}

} ?>
<div style="clear:both;"></div>

<?php if(isset($efsun_var)){ echo '<div class="span8"><div class="alert alert-warning"><b><i class="fa fa-warning"></i> BİLGİ !</b> Satın ala tıkladığınız anda işlem gerçekleşir.'; ?>
<?php if($ifetch["durum"] == 2){ ?><button type="submit" name="satin_al" class="btn btn-success btn-xs pull-right"><i class="fa fa-shopping-cart"></i> Satın Al</button> <?php }else{ ?>
<button type="submit" name="satin_al" class="btn btn-info pull-right"><i class="fa fa-shopping-cart"></i> Satın Al</button>
<?php } echo '</div></div><div style="clear:both;"></div>'; } ?>

</form>

<?php if($ifetch["efsun"] == 0){ ?>



<div class="alert alert-warning" style="margin-top:20%;" align="center">Kategoriye Son Eklenen 7 İtem</div>

<div class="son_eklenenler" align="center">
<?php $kategori_itemler = $db->prepare("SELECT resim,id,kid,vnum,durum FROM market_item WHERE kid = ? && sid = ? ORDER BY id DESC LIMIT 7 "); 
$kategori_itemler->execute(array($ifetch["kid"], $_SESSION["market_server"]));
foreach($kategori_itemler as $item){ ?>
<a onclick="WM_click('&item=<?=$item["vnum"];?>&id=<?=$item["id"];?>&kategori=<?=$item["kid"];?>')" href="javascript:;"><img class="<?=($item["durum"] == 2) ? 'indirim' : 'img';?>" src="<?=$item["resim"];?>" /></a>
<?php } ?>
</div>	

<?php } ?>						

<div style="clear:both; margin-bottom:15px;"></div>


</div></div>
    
