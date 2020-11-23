<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">

<?=$fetch["log"];?>
												
</div>
<div class="panel-body">


<?php 
$log = json_decode($fetch["icerik"]);

$genel = json_decode($log[0]);

$tipler = json_decode($log[1]);

$oranlar = json_decode($log[2]);

$taslar = json_decode($log[3]);


?>


<div class="col-md-6">

<div class="list-group border-bottom" id="external-events">
<a class="list-group-item external-event ui-draggable ui-draggable-handle active">Silinen İtem : <?=$WMadmin->item_bul($genel[0]);?> [ X <?=$genel[1];?> ]</a>
<?php for($i = 0; $i < count($tipler); $i++){
if($tipler[$i] == 0) continue;	
?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMinf->efsun_detay($tipler[$i]);?> Oran : <?=$oranlar[$i];?></a>

<?php } ?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle active">Taşlar</a>
<?php for($i = 0; $i < count($taslar); $i++){
if($taslar[$i] == 0) continue;	
?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMadmin->item_bul($taslar[$i]);?></a>

<?php } ?>
</div>	
	
</div>	

<div class="col-md-6">
<div class="list-group border-bottom" id="external-events">
<a class="list-group-item external-event ui-draggable ui-draggable-handle active">Genel Bilgiler </a>
<a class="list-group-item external-event ui-draggable ui-draggable-handle">İtemi Silen Admin : <b> <?=$fetch["yapan"];?></b></a>
<a class="list-group-item external-event ui-draggable ui-draggable-handle">Silinme Tarihi : <b> <?= $WMinf->tarih_format('j F Y , l,  H:i:s', $fetch["tarih"]);  ?></b></a>
<?php 
if($genel[3] == "INVENTORY"){$nerde = "Envanterden Silindi";}
else if($genel[3] == "EQUIPMENT"){ $nerde = "Giyiliyken Silindi";}
else if($genel[3] == "MALL"){ $nerde = "Nesne Deposundan Silindi";}
else if($genel[3] == "SAFEBOX"){ $nerde = "Deposundan Silindi"; }
else{ $nerde = "Bilinmiyor";}

if($genel[3] == "INVENTORY" || $genel[3] == "EQUIPMENT"){ $sahip2 = $WMadmin->karakter($genel[2], "account_id", 2); $kullanici = $WMadmin->kullanici($sahip2, "login"); $sahip = $WMadmin->karakter($genel[2], "name", 2).'( '.$kullanici.' )'; }
else { $sahip = $WMadmin->kullanici($genel[2], "login"); $kullanici = $sahip; } ?>
<a href="index.php?sayfa=kullanicilar&login=<?=$kullanici;?>" target="_blank" class="list-group-item external-event ui-draggable ui-draggable-handle">İtemin Sahibi : <b> <?= $sahip;  ?></b></a>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$nerde;?></a>
</div>	
	
</div>	


</div>
</div>
                            
</div>   


 

                   
</div>
                    
                    
                    
</div>
