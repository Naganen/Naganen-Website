
<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
<i class="fa fa-user-plus"></i> Yeni Kullanıcı Oluştur
</div>
<div class="panel-body">
									
<?=$WMform->head("kullanici_olustur");?>
<?=$WMform->veri("username", "Kullanıcı Adını Giriniz", "text", false);?>
<?=$WMform->veri("real", "İsmini Giriniz", "text", false, 'onkeyup="turkce_kontrol(this)"');?>
<?=$WMform->veri("email", "Email Adresini Giriniz", "text", false);?>
<?=$WMform->veri("pass", "Şifresini Giriniz", "password", false);?>
<?=$WMform->veri("pass_retry", "Şifresini Tekrar Giriniz", "password", false);?>
<?=$WMform->buton(1, " Kullanıcı Oluştur", "danger pull-right", "user-plus");?>
<?=$WMform->footer();?>
	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
