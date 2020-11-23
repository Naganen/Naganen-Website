                <div class="body-content animated fadeIn">
                    
<div class="row">
					
<div class="col-md-12">

<?php @$nere = $WMkontrol->WM_get($WMkontrol->WM_tostring($_GET["nere"])); ?>
						
<div class="panel panel-default tabs">
<ul class="nav nav-tabs nav-justified">
<li class="<?=(!$nere) ? 'active' : '';?>"><a href="index.php?sayfa=anket&islem=<?=$islem;?>"><?=$WMinf->kisalt($afetch["konu"], 15, '...');?></a></li>
<li class="<?=($nere == "oylar") ? 'active' : '';?>"><a href="index.php?sayfa=anket&islem=<?=$islem;?>&nere=oylar"><i class="fa fa-bar-chart"></i> Anket Oyları</a></li>
</ul>
<div class="panel-body tab-content">


<?php


if(!$nere && $nere == "")
{

if(strlen($afetch["bitis_tarih"]) > 3)
{
	
$tarih = explode(' ', $afetch["bitis_tarih"]);  $sec = 1;


}
else
{
	
$tarih[0] = ''; $tarih[1] = ''; $sec = 2;	
	
}
?>

<div class="alert alert-warning"><strong><i class="fa fa-warning"></i></strong> Anketin cevaplarını buradan silemezsiniz ancak ekleme yapabilirsiniz. Bu uygulamayı cevaplara gelen oyların karışmaması için getirdik.</div>

<?=$WMform->head("anket_duzenle");?>
<?=$WMform->veri("konu", false, "text", false, 'value="'.$afetch["konu"].'"', 'Anket Konusu');?>
<?=$WMform->veri("cevaplar", false, "text", false, 'value="'.$afetch["secenekler"].'"', 'Anket Cevapları ( Anketten Cevap Silecek iseniz lütfen üstten anket oylarına gidip silin)');?>
<?$WMform->check("tarih_durum", true, " Anketinizin Bitiş Tarihi Olacak mı ? Burayı işaretlemez iseniz aşağıdaki kutucukları doldurmanıza gerek yoktur. ( Girdiğiniz tarihe gelindiğinde anket oylamaları otomatik durdurulur.)", $sec, 1);?>
<?=$WMform->veri("tarih", false, "date", false, 'value="'.$tarih[0].'"', 'Anketin Bitiş Tarihini Giriniz ( Bugün bitsin istiyorsanız boş bırakın) Daha detaylı görünüm için en sağdaki aşağı oka basınız.');?>
<?=$WMform->veri("saat", "Anket Bitiş Saati", "text", false, 'value="'.$tarih[1].'"', 'Anketin Bitiş Saatini Giriniz,  Girdiğiniz saat saniyeye kadar girilmelidir Örnek 13:45:00');?>
<?=$WMform->buton(1, " Anketi Güncelle", "warning pull-right", "save", $afetch["id"]);?>
<?=$WMform->footer();?>

<?php 
}else if($nere == "oylar"){ ?>
									
								

<div class="col-md-6">
<div class="panel panel-default">
<div class="panel-body list-group border-bottom">
<?php 

@$pid = $WMkontrol->WM_get($WMkontrol->WM_tostring($_GET["pid"]));

$secenekler = explode(',', $afetch["secenekler"]);

$oylar = json_decode($afetch["onay"]);

foreach($secenekler as $keys => $secenek)
{
	
$countla = count(json_decode($oylar[$keys]));
		
?>

<a id="oylar1-<?=$keys;?>" href="index.php?sayfa=anket&islem=<?=$islem;?>&nere=oylar&pid=<?=$keys;?>" class="list-group-item <?=($keys == $pid) ? 'active' : '';?>"><?=$secenek;?> 
<span class="badge badge-warning"><?=$countla;?> OY</span></a>

<?php
	
}

?>

</div>
</div>                            
</div>

<?php  if(!$pid || $pid == 0){ $pid = 0; } ?>

<div class="col-md-6">
<a onclick="WM_sil('anket_sil&fid=1&pid=<?=$pid;?>&id=<?=$islem;?>')" href="javascript:;" class="btn btn-danger pull-right">Bu Seçeneği Sil</a>
<table class="table table-actions table-striped">
<tbody>

<?php 


$oy_verenler = json_decode($oylar[$pid]);


foreach($oy_verenler as $oyveren)
{

?>
<tr align="center" id="oylar2-<?=$pid;?>">
<td><a href="index.php?sayfa=kullanicilar&login=<?=$oyveren;?>" target="_blank"><?=$oyveren;?></a></td>
</tr>
<?php
	
}


?>

</tbody>
</table>
</div>																							
														

<?php } ?>
									

</div>
</div>                                         
						

                            
</div>                        
</div>

                    
</div>
