<?php @$ara = $WMkontrol->WM_get($WMkontrol->WM_html($WMkontrol->WM_toint($_GET["ara"]))); ?>

<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">

<?=$WMadmin->item_bul($fetch["vnum"]);?>
<a  onClick="WM_sil('itemsil&id=<?=$fetch["id"];?>')" href="javascript:;" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash"></i> İtemi Sil</a>												
</div>
<div class="panel-body">



<div class="col-md-6">

<div class="list-group border-bottom" id="external-events">
<a class="list-group-item external-event ui-draggable ui-draggable-handle active">İtem : <?=$WMadmin->item_bul($fetch["vnum"]);?> </a>

<?php if($fetch["attrtype0"] != 0){ ?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMinf->efsun_detay($fetch["attrtype0"]);?> Oran : <?=$fetch["attrvalue0"];?></a> 
<?php } ?>
<?php if($fetch["attrtype1"] != 0){ ?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMinf->efsun_detay($fetch["attrtype1"]);?> Oran : <?=$fetch["attrvalue1"];?></a> 
<?php } ?>
<?php if($fetch["attrtype2"] != 0){ ?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMinf->efsun_detay($fetch["attrtype2"]);?> Oran : <?=$fetch["attrvalue2"];?></a> 
<?php } ?>
<?php if($fetch["attrtype3"] != 0){ ?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMinf->efsun_detay($fetch["attrtype3"]);?> Oran : <?=$fetch["attrvalue3"];?></a> 
<?php } ?>
<?php if($fetch["attrtype4"] != 0){ ?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMinf->efsun_detay($fetch["attrtype4"]);?> Oran : <?=$fetch["attrvalue4"];?></a> 
<?php } ?>
<?php if($fetch["attrtype5"] != 0){ ?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMinf->efsun_detay($fetch["attrtype5"]);?> Oran : <?=$fetch["attrvalue5"];?></a> 
<?php } ?>
<?php if($fetch["attrtype6"] != 0){ ?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMinf->efsun_detay($fetch["attrtype6"]);?> Oran : <?=$fetch["attrvalue6"];?></a> 
<?php } ?>


<?php for($i = 0; $i < 1; $i++){
if($fetch["socket0"] == 0) continue;	
if($fetch["socket0"] == 1) continue;	
if($fetch["socket1"] == 0) continue;	
if($fetch["socket1"] == 1) continue;	
if($fetch["socket2"] == 0) continue;	
if($fetch["socket2"] == 1) continue;	
?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle active">Taşlar</a>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMadmin->item_bul($fetch["socket0"]);?></a>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMadmin->item_bul($fetch["socket1"]);?></a>
<a class="list-group-item external-event ui-draggable ui-draggable-handle"><?=$WMadmin->item_bul($fetch["socket2"]);?></a>

<?php } ?>
</div>	
	
</div>	

<div class="col-md-6">
<div class="list-group border-bottom" id="external-events">
<a class="list-group-item external-event ui-draggable ui-draggable-handle active">Genel Bilgiler </a>
<?php if($fetch["window"] == "MALL" || $fetch["window"] == "SAFEBOX")
{
$sahip =	$WMadmin->kullanici($fetch["owner_id"], "login");

$href = "index.php?sayfa=kullanicilar&login=".$sahip;
} 
else
{
	
$sahip = 	$WMadmin->karakter($fetch["owner_id"], "name", 2);

$href  = "index.php?sayfa=karakterler&name=".$sahip;
	
}

$nerde = array(
'EQUIPMENT' => 'Üstünde',
'INVENTORY' => 'Envanterinde',
'MALL' => 'Nesne Marketinde',
'SAFEBOX' => 'Deposunda');


?>
<a class="list-group-item external-event ui-draggable ui-draggable-handle" href="<?=$href;?>" target="_blank">İtem Sahibi : <b> <?=$sahip;?>
</b></a>
<a class="list-group-item external-event ui-draggable ui-draggable-handle">Nerede : <b> <?=$nerde[$fetch["window"]];?></b></a>
</div>	
	
</div>	


</div>
</div>
                            
</div>   



 

                   
</div>
                    
                    
                    
</div>
