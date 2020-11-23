<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
<i class="fa fa-edit"></i> Kullanıcı Bilgilerini Düzenle
</div>
<div class="panel-body">
<?=$WMform->head("kullanici_bilgi_duzenle");?>
<div class="form-group">
<label> İmzanız </label>
<textarea name="icerik" class="icerik"><?=$WMadmin->admin("imza", 1);?></textarea>

</div>

<?$WMform->check("imza", 2, " İmzam teknik destekte kullanılsın", ($WMadmin->admin("imza_durum", 1) == 1) ? 1 : false);?>

<?=$WMform->buton(1, " BİLGİLERİ DÜZENLE", "success pull-right", "save");?>

<?=$WMform->footer();?>

<div class="col-md-12"><hr></div>
									
<?=$WMform->head("kullanici_bilgi_duzenle");?>
<?=$WMform->veri("pass", "Şifrenizi Giriniz", "password", false);?>
<?=$WMform->veri("pass_retry", "Şifrenizi Tekrar Giriniz", "password", false);?>
<?=$WMform->buton(2, " ŞİFRE DEĞİŞTİR", "danger pull-right", "key");?>
<?=$WMform->footer();?>
	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
