
<?php 

$sosyal = json_decode($WMadmin->serverbilgi("sosyal_ag"));

?>

                <div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
<div class="panel panel-default">
<div class="panel-body">
									
<div class="col-md-6">

<?php $kral = explode(',', $WMadmin->serverbilgi("krallar"));?>
								
<?=$WMform->head("anasayfa_ayarlari");?>
<?=$WMform->veri("kral_oyuncu", false, "text", false, 'value="'.$kral[0].'"', 'Kral Oyuncuyu Girin ( Yoksa Boş Bırakın )');?>
<?=$WMform->buton(1, " Kral Oyuncu Güncelle", "info btn-block pull-right", "save");?>
									
</div>

<div class="col-md-6">
									
<?=$WMform->veri("kral_lonca", false, "text", false, 'value="'.$kral[1].'"', 'Kral Loncayı Girin ( Yoksa Boş Bırakın )');?>
<?=$WMform->buton(2, " Kral Lonca Güncelle", "danger btn-block pull-right", "save");?>
<?=$WMform->footer();?>
									
</div>

<div class="col-md-12"><hr></div>
									
<div class="col-md-3">
									
<?=$WMform->head("anasayfa_ayarlari");?>
<?=$WMform->veri("facebook", false, "text", false, 'value="'.$sosyal[0].'"', '<i class="fa fa-facebook-square"></i> Facebook Adresinizi Giriniz ( İstemiyorsanız Boş Bırakın )');?>
<?=$WMform->buton(3, ' <i class="fa fa-facebook-square"></i> Facebook Adresi Güncelle', "facebook1 btn-block pull-right", "save");?>
<?=$WMform->footer();?>
									
</div>

<div class="col-md-3">
									
<?=$WMform->head("anasayfa_ayarlari");?>
<?=$WMform->veri("youtube", false, "text", false, 'value="'.$sosyal[1].'"', '<i class="fa fa-youtube-square"></i> Youtube Adresinizi Giriniz ( İstemiyorsanız Boş Bırakın )');?>
<?=$WMform->buton(4, ' <i class="fa fa-youtube-square"></i> Youtube Adresi Güncelle', "danger btn-block", "save");?>
<?=$WMform->footer();?>
									
</div>

<div class="col-md-3">
									
<?=$WMform->head("anasayfa_ayarlari");?>
<?=$WMform->veri("twitter", false, "text", false, 'value="'.$sosyal[2].'"', '<i class="fa fa-twitter-square"></i> Twitter Adresinizi Giriniz ( İstemiyorsanız Boş Bırakın )');?>
<?=$WMform->buton(5, ' <i class="fa fa-twitter-square"></i> Twitter Adresi Güncelle', "twitter btn-block pull-right", "save");?>
<?=$WMform->footer();?>
									
</div>

<div class="col-md-3">
									
<?=$WMform->head("anasayfa_ayarlari");?>
<?=$WMform->veri("tanitim", false, "text", false, 'value="'.$sosyal[3].'"', '<i class="fa fa-youtube-square"></i> Youtube Tanıtım Adresinizi Giriniz ( İstemiyorsanız Boş Bırakın )');?>
<?=$WMform->buton(6, ' <i class="fa fa-youtube-square"></i> Youtube Tanıtım Adresi Güncelle', "danger btn-block", "save");?>
<?=$WMform->footer();?>
									
</div>
									
</div>
</div>
						
</div>                        
</div>
                    
                    
                    
</div>
