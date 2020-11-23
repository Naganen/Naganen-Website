<?php @$ara = $WMkontrol->WM_get($WMkontrol->WM_html($WMkontrol->WM_toint($_GET["ara"]))); ?>

<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">

<?=$fetch["alinan"];?>
												
</div>
<div class="panel-body">

<div class="col-md-12">
<?php if($ara != 1){ ?>
<a class="btn btn-success pull-right" href="index.php?sayfa=market_log&id=<?=$fetch["id"];?>&ara=1" style="margin-bottom:10px;"><i class="fa fa-search"></i> Aynı özellikteki itemleri bul</a>
<?php }else{ ?>
<a class="btn btn-danger pull-right" href="index.php?sayfa=market_log&id=<?=$fetch["id"];?>" style="margin-bottom:10px;"><i class="fa fa-close"></i> Aramayı Kapat</a>
<?php } ?>
</div>

<?php 
$arrays = json_decode($fetch["log"]);

$tipler = json_decode($arrays[0]);

$efsunlar = json_decode($arrays[1]);

$taslar = json_decode($arrays[2]);


?>


<div class="col-md-6">

<div class="list-group border-bottom" id="external-events">
<a class="list-group-item external-event ui-draggable ui-draggable-handle active">Alınan İtem : <?=$fetch["alinan"];?>  </a>
<?php for($i = 0; $i < count($tipler); $i++){
if($tipler[$i] == 0) continue;	
?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMinf->efsun_detay($tipler[$i]);?> Oran : <?=$efsunlar[$i];?></a>

<?php } ?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle active">Taşlar</a>
<?php for($i = 0; $i < count($taslar); $i++){
if($taslar[$i] == 0) continue;	
if($taslar[$i] == 1) continue;	
?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMadmin->item_bul($taslar[$i]);?></a>

<?php } ?>
</div>	
	
</div>	

<div class="col-md-6">
<div class="list-group border-bottom" id="external-events">
<a class="list-group-item external-event ui-draggable ui-draggable-handle active">Genel Bilgiler </a>
<a class="list-group-item external-event ui-draggable ui-draggable-handle">İtemi Oluşturan : <b> <?=$fetch["karakter"];?></b></a>
<a class="list-group-item external-event ui-draggable ui-draggable-handle">İtem Fiyatı : <b> <?=$fetch["fiyat"];?> EP </b></a>
<a class="list-group-item external-event ui-draggable ui-draggable-handle">Oluşturulma Tarihi : <b> <?= $WMinf->tarih_format('j F Y , l,  H:i:s', $fetch["tarih"]);  ?></b></a>
</div>	
	
</div>	


</div>
</div>
                            
</div>   


<?php if($ara == 1){ ?>

<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">

Aynı Özellikteki İtemler
												
</div>
<div class="panel-body">

<table class="table" id="karaktersirala">
<thead>
<tr>
<th>İtem</th>
<th>Sahibi</th>
<th>Nerde</th>
<th>İşlemler</th>
</tr>
</thead>
<tbody>
<?php
$arastir_bul = $odb->query("SELECT * FROM player.item 
WHERE vnum = '".$fetch["vnum"]."' && socket0 = '".$taslar[0]."' && socket1 = '".$taslar[1]."' && socket2 = '".$taslar[2]."' &&
attrtype0 = '".$tipler[0]."' && attrtype1 = '".$tipler[1]."' && attrtype2 = '".$tipler[2]."' && 
attrtype3 = '".$tipler[3]."' && attrtype4 = '".$tipler[4]."' && attrtype5 = '".$tipler[5]."' && attrtype6 = '".$tipler[6]."' &&
attrvalue0 = '".$efsunlar[0]."' && attrvalue1 = '".$efsunlar[1]."' && attrvalue2 = '".$efsunlar[2]."' && 
attrvalue3 = '".$efsunlar[3]."' && attrvalue4 = '".$efsunlar[4]."' && attrvalue5 = '".$efsunlar[5]."' && attrvalue6 = '".$efsunlar[6]."'
");
foreach($arastir_bul as $row){
if($row["window"] == "INVENTORY"){$nerde = "Envanterde";}
else if($row["window"] == "EQUIPMENT"){ $nerde = "Giyili";}
else if($row["window"] == "MALL"){ $nerde = "Nesne Deposunda";}
else if($row["window"] == "SAFEBOX"){ $nerde = "Deposunda"; }
else{ $nerde = "Bilinmiyor";}
if($row["window"] == "INVENTORY" || $row["window"] == "EQUIPMENT"){ $sahip2 = $WMadmin->karakter($row["owner_id"], "account_id", 2); $kullanici = $WMadmin->kullanici($sahip2, "login"); $sahip = $WMadmin->karakter($row["owner_id"], "name", 2).'( '.$kullanici.' )'; }
else{ $sahip = $WMadmin->kullanici($row["owner_id"], "login"); $kullanici = $sahip; }
?>
<tr id="item-<?=$row["id"];?>">
<td><?=$WMadmin->item_bul($row["vnum"]);?></td>
<td><a href="index.php?sayfa=kullanicilar&login=<?=$kullanici;?>" target="_blank"><?=$sahip;?></a></td>
<td><?=$nerde;?></td>
<td WIDTH=40><a  onClick="WM_sil('itemsil&id=<?=$row["id"];?>')" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> İtemi Sil</a>
<a  href="index.php?sayfa=item_detay&id=<?=$row["id"];?>" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-info-circle"></i> İtem Ayrıntıları</a>
</td>
</tr>
												<?php
											}
											?>
                                        </tbody>
                                    </table>

</div>
</div>
                            
</div>   

<?php } ?> 

 

                   
</div>
                    
                    
                    
</div>
