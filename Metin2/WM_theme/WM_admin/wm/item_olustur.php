<?php 
require '../WM_plugins/WM_item_olusturma/genel.php'; 
function efsunlar($efsun, $name)
{
global $efsunlar;
echo '<div class="form-group">
<select class="form-control" name="'.$name.'"><option value="">'.$efsun.'. Efsunu seçiniz</option>';
foreach($efsunlar as $value => $efsun)
{
	
echo '<option value="'.$value.'">'.$efsun.'</option>';

}

echo '</select></div>';

}

function oranlar($id)
{
	
return '<div class="form-group"><input class="form-control" placeholder="Oranı Girin" name="oran'.$id.'" type="text" onkeyup="sayi_kontrol(this)"></div>';	
	
}

function taslar($efsun, $name)
{
global $taslar;
echo '<div class="col-md-4">
<div class="form-group">
<select class="form-control" name="'.$name.'"><option value="0">'.$efsun.'. Taşı seçiniz</option>';
foreach($taslar as $value => $efsun)
{
	
echo '<option value="'.$value.'">'.$efsun.'</option>';

}

echo '</select></div></div>';

}

?> 
<div class="body-content animated fadeIn">
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
İtem Oluştur
</div>
<div class="panel-body">
<?=$WMform->head("item_olustur");?>
<div class="col-md-10">
<?php $WMform->veri("vnum", "Gönderilcek İtemin Vnumunu giriniz", "text", false);?>
<?php $WMform->veri("name", "Gönderilcek kullanıcının veya karakterin ismini giriniz.", "text", false);?>
<?php efsunlar(1, "efsun1");?>
<?php efsunlar(2, "efsun2");?>
<?php efsunlar(3, "efsun3");?>
<?php efsunlar(4, "efsun4");?>
<?php efsunlar(5, "efsun5");?>
<?php efsunlar(6, "efsun6");?>
<?php efsunlar(7, "efsun7");?>
<? taslar(1, "tas1");?>
<? taslar(2, "tas2");?>
<? taslar(3, "tas3");?>
</div>
<div class="col-md-2">
<?php $WMform->veri("adet", "Adet", "text", false);?>
<div class="form-group">
<select class="form-control" name="tur">
<option value="kullanici">Kullanıcı</option><option value="karakter">Karakter</option>
</select>
</div>
<?=oranlar(1);?>
<?=oranlar(2);?>
<?=oranlar(3);?>
<?=oranlar(4);?>
<?=oranlar(5);?>
<?=oranlar(6);?>
<?=oranlar(7);?>
<?=$WMform->buton(1, "İtem Oluştur", "success", "plus");?>
</div>
<?=$WMform->footer();?>

</div>
</div>
</div>                        
</div>
</div>
