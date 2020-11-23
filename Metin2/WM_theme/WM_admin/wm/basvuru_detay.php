                <div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
<div class="panel panel-default tabs">
<ul class="nav nav-tabs nav-justified">
<li class="active"><a href="#itemekle" data-toggle="tab"><?=$WMinf->kisalt($fetch["konu"], 85);?></a></li>
<li><a href="#konusmalar" data-toggle="tab"><i class="fa fa-line-chart"></i> Başvuranlar</a></li>
<li><a href="#savaslar" data-toggle="tab"><i class="fa fa-area-chart"></i> Onaylananlar ve Onaylanmayanlar</a></li>
</ul>
<div class="panel-body tab-content">
<div class="tab-pane active" id="itemekle">


<?=$WMform->head("basvuru_islemleri");?>
<?=$WMform->veri("konu", false, "text", false, 'value="'.$fetch["konu"].'"', "* Başvuru konusu");?>
<label>Başvuru İçeriği </label><textarea name="icerik" class="icerik"><?=$fetch["icerik"];?></textarea>

<?php

$tarih = explode(' ', $fetch["bitis"]);

$basvuranlar = json_decode($fetch["basvuranlar"], true);

$onaylananlar = json_decode($fetch["onaylananlar"], true);

$red_edilenler = json_decode($fetch["red_edilenler"], true);

if($fetch["tur"] == 2)
{

$lonca_sart = json_decode($fetch["lonca_sart"]);	

@$kisi_sinir = $lonca_sart[0];
	
@$level_sinir = $lonca_sart[1];
	
}
else
{
	
$kisi_sinir = "";
	
$level_sinir = "";
	
}

?>

<div class="col-md-12"><hr></div>
<div class="col-md-12" style="margin-top:10px;">
<div class="col-md-6"><?$WMform->check("loncami", 1, "Eklediğiniz bu başvuru formu, lonca turnuvası için ise işaretleyiniz.  ", ($fetch["tur"] == 2) ? 1 : false, 1);?></div>
<div class="col-md-3"><?=$WMform->veri("kisi_sinir", false, "text", false, 'onkeyup="sayi_kontrol(this)" value="'.$kisi_sinir.'"', "Lonca Kişi Sınırını Giriniz");?></div>
<div class="col-md-3"><?=$WMform->veri("level_sinir", false, "text", false, 'onkeyup="sayi_kontrol(this)" value="'.$level_sinir.'"', "Lonca Level Sınırını Giriniz");?></div>

</div>
<div class="col-md-12" style="margin-top:10px;"><hr>
<div class="alert alert-warning"><i class="fa fa-warning"></i><b> UYARI !</b> Eğer süreliyi işaretlerseniz belirttiğiniz tarih ve saat geldiğinde daha başvuru alınmayacaktır.  </div>
<div class="col-md-3"><?$WMform->check("sureli", 1, "Eklediğiniz Başvuru Formu Süreli mi ? ", ($fetch["bitis_tur"] == 1) ? 1 : false);?></div>
<div class="col-md-4"><?=$WMform->veri("tarih", false, "date", false, 'value="'.$tarih[0].'"', "Tarihi giriniz");?></div>
<div class="col-md-5"><?=$WMform->veri("saat", "Saati giriniz örnek -> 13:55:55", "text", false, 'value="'.@$tarih[1].'"', 'Saati giriniz örnek -> 13:55:55');?></div>
</div>

<div class="col-md-12"><hr></div>

<?=$WMform->buton(2, " Başvuru Formunu Güncelle", "danger pull-right", "save", $fetch["id"].'--'.$fetch["konu"]);?>

<?=$WMform->footer();?>
					
																		
									
</div>
									
									
<div class="tab-pane" id="konusmalar">
									

<table class="table" id="karaktersirala">
<thead>
<tr>
<th>#</th>
<th>Başvuran</th>
<th>İçerik</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
$i = 0;

foreach($basvuranlar as $basvuran => $icerik)
{
	
$i++;

	
?>
<tr id="basvuru-<?=$i;?>">
<td WIDTH=15><?=$i;?></td>
<td><a href="index.php?sayfa=kullanicilar&login=<?=$basvuran;?>" target="_blank"><?=$basvuran;?></a></td>
<td><?=$icerik;?></td>
<td>
<a onclick="WM_click('basvuru_islemleri_2&pid=<?=$fetch["id"].'--'.$basvuran.'--'.$i;?>&tur=1')" href="javascript:;" class="btn btn-success"><i class="fa fa-check"></i></a> 
<a onclick="WM_click('basvuru_islemleri_2&pid=<?=$fetch["id"].'--'.$basvuran.'--'.$i;?>&tur=2')" href="javascript:;" class="btn btn-warning"><i class="fa fa-close"></i></a> 
<a  onclick="WM_sil('basvuru_islemleri_2&pid=<?=$fetch["id"].'--'.$basvuran.'--'.$i;?>&tur=3')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
</tr>

<?php

}

?>
</tbody>
</table>
						
														
</div>
									
						
									
<div class="tab-pane" id="savaslar">

<div class="col-md-6">
									
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
	<center>ONAYLANAN BAŞVURULAR</center>
</div>
<div class="panel-body">


<table class="table" id="karaktersirala">
<thead>
<tr>
<th>#</th>
<th>Başvuran</th>
<th>İçerik</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
$i = 0;

foreach($onaylananlar as $basvuran => $icerik)
{
	
$i++;
	
?>
<tr id="onayli-<?=$i;?>">
<td WIDTH=15><?=$i;?></td>
<td><a href="index.php?sayfa=kullanicilar&login=<?=$basvuran;?>" target="_blank"><?=$basvuran;?></a></td>
<td><?=$icerik;?></td>
<td>
<a class="btn btn-warning" onclick="WM_click('basvuru_islemleri_2&pid=<?=$fetch["id"].'--'.$basvuran.'--'.$i;?>&tur=6')" href="javascript:;"><i class="fa fa-close"></i></a> 
<a  onclick="WM_sil('basvuru_islemleri_2&pid=<?=$fetch["id"].'--'.$basvuran.'--'.$i;?>&tur=4')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
</tr>

<?php

}

?>
</tbody>
</table>


</div>
</div>	
</div>	

<div class="col-md-6">
									
<div class="panel panel-danger">
<div class="panel-heading ui-draggable-handle">
	<center>RED EDİLEN BAŞVURULAR</center>
</div>
<div class="panel-body">


<table class="table" id="karaktersirala">
<thead>
<tr>
<th>#</th>
<th>Başvuran</th>
<th>İçerik</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
$i = 0;

foreach($red_edilenler as $basvuran => $icerik)
{
	
$i++;
	
?>
<tr id="redli-<?=$i;?>">
<td WIDTH=15><?=$i;?></td>
<td><a href="index.php?sayfa=kullanicilar&login=<?=$basvuran;?>" target="_blank"><?=$basvuran;?></a></td>
<td><?=$icerik;?></td>
<td>
<a class="btn btn-success" onclick="WM_click('basvuru_islemleri_2&pid=<?=$fetch["id"].'--'.$basvuran.'--'.$i;?>&tur=7')" href="javascript:;"><i class="fa fa-check"></i></a> 
<a  onclick="WM_sil('basvuru_islemleri_2&pid=<?=$fetch["id"].'--'.$basvuran.'--'.$i;?>&tur=5')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
</tr>

<?php

}

?>
</tbody>
</table>


</div>
</div>	
</div>	

																		
														
</div>
									
									

</div>
</div>                                         
						

                            
</div>                        
</div>
                    
                                        
</div>
