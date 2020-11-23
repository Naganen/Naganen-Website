
<?php 

$istatistik = json_decode($WMadmin->serverbilgi("istatistik"));

?>

<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
<div class="panel panel-default">
<div class="panel-body">

<?=$WMform->head("istatistik_guncelle");?>
<div class="col-md-2">
<?=$WMform->veri("istatistik0", false, "text", false, 'value="'.$istatistik[0].'"', 'Online Oyuncu Aşırtılcak Miktar');?>
</div>

<div class="col-md-2">
<?=$WMform->veri("istatistik1", false, "text", false, 'value="'.$istatistik[1].'"', 'Bugün Girenler Aşırtılcak Miktar');?>
</div>

<div class="col-md-2">
<?=$WMform->veri("istatistik2", false, "text", false, 'value="'.$istatistik[2].'"', 'Toplam Kayıtlar Aşırtılcak Miktar');?>
</div>

<div class="col-md-2">
<?=$WMform->veri("istatistik3", false, "text", false, 'value="'.$istatistik[3].'"', 'Toplam Karakter Aşırtılcak Miktar');?>
</div>

<div class="col-md-2">
<?=$WMform->veri("istatistik4", false, "text", false, 'value="'.$istatistik[4].'"', 'Toplam Lonca Aşırtılcak Miktar');?>
</div>

<div class="col-md-2">
<br>
<?=$WMform->buton(1, ' Aşırtma Güncelle', "info btn-block", "save");?>
<?=$WMform->footer();?>
</div>


									
</div>
</div>
						
</div>                        
</div>
                    
                    
                    
</div>
