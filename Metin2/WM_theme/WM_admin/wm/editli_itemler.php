<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">


<?php 

@$onay = $WMkontrol->WM_get($WMkontrol->WM_html($WMkontrol->WM_tostring($_GET["onay"])));

if($onay == session_id())
{

$apply = array(
   0 =>'',
   1 =>'MAX_HP',
   2 =>'MAX_SP',
   3 =>'CON',
   4 =>'INT',
   5 =>'STR',
   6 =>'DEX',
   7 =>'ATT_SPEED',
   8 =>'MOV_SPEED',
   9 =>'CAST_SPEED',
   10 =>'HP_REGEN',
   11 =>'SP_REGEN',
   12 =>'POISON_PCT',
   13 =>'STUN_PCT',
   14 =>'SLOW_PCT',
   15 =>'CRITICAL_PCT',
   16 =>'PENETRATE_PCT',
   17 =>'ATTBONUS_HUMAN',
   18 =>'ATTBONUS_ANIMAL',
   19 =>'ATTBONUS_ORC',
   20 =>'ATTBONUS_MILGYO',
   21 =>'ATTBONUS_UNDEAD',
   22 =>'ATTBONUS_DEVIL',
   23 =>'NONE',
   24 =>'NONE',
   25 =>'STEAL_SP',
   26 =>'',
   27 =>'BLOCK',
   28 =>'RESIST_BOW',
   29 =>'RESIST_SWORD',
   30 =>'RESIST_TWOHAND',
   31 =>'RESIST_DAGGER',
   32 =>'RESIST_BELL',
   33 =>'RESIST_FAN',
   34 =>'RESIST_BOW',
   35 =>'RESIST_FIRE',
   36 =>'RESIST_ELEC',
   37 =>'RESIST_MAGIC',
   38 =>'RESIST_WIND',
   39 =>'REFLECT_MELEE',
   40 =>'DODGE',
   41 =>'POISON_REDUCE',
   42 =>'',
   43 =>'GOLD_DOUBLE_BONUS',
   44 =>'GOLD_DOUBLE_BONUS',
   45 =>'GOLD_DOUBLE_BONUS',
   46 =>'GOLD_DOUBLE_BONUS',
   47 =>'',
   48 =>'',
   49 =>'',
   50 =>'',
   52 =>'',
   53 =>'ATT_GRADE_BONUS',
   54 =>'',
   55 =>'',
   56 =>'',
   58 =>'',
   59 =>'ATT_BONUS_TO_WARRIOR',
   60 =>'ATT_BONUS_TO_ASSASSIN',
   61 =>'ATT_BONUS_TO_SURA',
   62 =>'ATT_BONUS_TO_SHAMAN',
   63 =>'ATT_BONUS_TO_MONSTER',
   64 =>'Saldırı Değeri +',
   65 =>'',
   66 =>'EXP_DOUBLE_BONUS',
   67 =>'ITEM_DROP_BONUS',
   68 =>'GOLD_DOUBLE_BONUS',
   71 =>'BECERI',
   72 =>'ORTALAMA',
   73 =>'',
   74 =>'',
   76 =>'',
   77 =>'',
   78 =>'RESIST_WARRIOR',
   79 =>'RESIST_ASSASSIN',
   80 =>'RESIST_SURA',
   81 =>'RESIST_SHAMAN'
);


function lv_bak($applyyy)
{
global $odb, $apply;

if($apply[$applyyy] == '')
{
	
return 32768;
	
}
else if(isset($apply[$applyyy]))
{
		
$query = $odb->prepare("SELECT item_attr.`lv5` FROM player.item_attr WHERE item_attr.`apply` = ?");
$query->execute(array($apply[$applyyy]));

if($query->rowCount())
{
	
$fetch =  $query->fetch(PDO::FETCH_ASSOC);

return $fetch["lv5"];

}
else
{
	
if($applyyy == 71)
{
	
return 25;
	
}
else if($applyyy == 72)
{
	
return 65;
	
}
else
{
	
return 15;
	
}
		
}



	
}
else
{
	
return 32768;
	
}


}

?> 
						
						
<div class="panel panel-default">
<div class="panel-body">

<table class="table" id="karaktersirala">
<thead>
<tr>
<th># </th>
<th>Kimde </th>
<th>Nerede</th>
<th>Eşya Adı</th>
<th>İşlemler</th>
</tr>
</thead>
<tbody>

<?php 

$itemler = $odb->prepare("SELECT item.*,player.name AS karakter, account.login AS kullanici FROM player.item 
LEFT JOIN player.player ON item.owner_id = player.id && (item.window = ? || item.window = ?) 
LEFT JOIN account.account ON item.owner_id = account.id && (item.window = ? || item.window = ?) 
WHERE (item.attrtype0 > ? ) || item.attrtype1 > ? || item.attrtype2 > ? || item.attrtype3 > ? || 
item.attrtype4 > ? || item.attrtype5 > ? || item.attrtype6 > ?
");
$itemler->execute(array('INVENTORY', 'EQUIPMENT', 'MALL', 'SAFEBOX', 0, 0, 0, 0, 0, 0, 0));

$nerde = array(
'EQUIPMENT' => 'Üstünde',
'INVENTORY' => 'Envanterinde',
'MALL' => 'Nesne Marketinde',
'SAFEBOX' => 'Deposunda');

$i = 0;

foreach($itemler as $row)
{ 

if($row["attrtype0"] > count($apply) - 1) continue;
if($row["attrtype1"] > count($apply) - 1) continue;
if($row["attrtype2"] > count($apply) - 1) continue;
if($row["attrtype3"] > count($apply) - 1) continue;
if($row["attrtype4"] > count($apply) - 1) continue;
if($row["attrtype5"] > count($apply) - 1) continue;
if($row["attrtype6"] > count($apply) - 1) continue;

if( ($row["attrvalue0"] > lv_bak($row["attrtype0"])) || ($row["attrvalue1"] > lv_bak($row["attrtype1"])) || ($row["attrvalue2"] > lv_bak($row["attrtype2"])) ||
($row["attrvalue3"] > lv_bak($row["attrtype3"])) || ($row["attrvalue4"] > lv_bak($row["attrtype4"])) || ($row["attrvalue5"] > lv_bak($row["attrtype5"])) || ($row["attrvalue6"] > lv_bak($row["attrtype6"])) ) {

$i++;

?>

<tr id="item-<?=$row["id"];?>">
<td>#<?=$i;?></td>
<td><?php if($row["window"] == "EQUIPMENT" || $row["window"] == "INVENTORY" ){ 
echo  '<a href="index.php?sayfa=karakterler&name='.$row["karakter"].'" target="_blank">'.$row["karakter"].'</a>';
}
else{ 
echo  '<a href="index.php?sayfa=kullanicilar&login='.$row["kullanici"].'" target="_blank">'.$row["kullanici"].'</a>';
}?></td>
<td><?=$nerde[$row["window"]];?></td>
<td><?=$WMadmin->item_bul($row["vnum"]);?></td>
<td><a  onClick="WM_sil('itemsil&id=<?=$row["id"];?>')" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> İtemi Sil</a>
<a  href="index.php?sayfa=item_detay&id=<?=$row["id"];?>" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-info-circle"></i> İtem Ayrıntıları</a>
</td>
</tr>
<?php

}

}
?>

</tbody>
</table>

</div>
									
</div>
												
													
                            
</div>                        
</div>
                    



<?php }else{ ?>

<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
<h4 class="panel-title">UYARI ! </h4>
</div>
<div class="panel-body ">

        <br /> Oyun açıkken oyunda arama yaparsanız işlemciye çok yük binebilir.
        <br /> <strong style="color:red">Veritabanınızda sorgular çok fazla olcağından oyunda pingler oluşabilir. </strong>
        <br /> <strong>Bu sistem item_attr tablosundaki en son gelebilecek efsun ile oyunda karşılaştırmalar yapar.</strong>
        <br /> <strong>Oyununuzda çok veri var ise server kapalıyken yapmanız önerilir.</strong>
        <br /> Oluşabilecek herhangi bir sorunda sorumluluk <b>webmeric</b> e ait değildir
        <br /> Arama süreci serverınızdaki verilere göre değişkenlik gösterebilir.
		<br /><br />
		<a class="btn btn-success" href="index.php?sayfa=editli_itemler&onay=<?=session_id();?>" onClick="return confirm('Bu süreci başlatmak istediğinizden Emin misiniz ? ')"><i class="fa fa-arrow-right"></i> Başlat </a>

</div>
</div>
<?php } ?>

</div>
