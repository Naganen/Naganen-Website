                <div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Alt Kullanıcı Ekle
</div>
<div class="panel-body">
									
<?=$WMform->head("alt_kullanici_islemleri");?>
<?=$WMform->veri("username", "Kullanıcı Adını Giriniz", "text", false);?>
<?=$WMform->veri("gm", "Kullanıcının GM İsmini Giriniz", "text", false);?>
<?=$WMform->veri("pass", "Şifresini Giriniz", "password", false);?>
<?=$WMform->veri("pass_retry", "Şifresini Tekrar Giriniz", "password", false);?>
<div class="col-md-12"><label>* Eklediğiniz Kullanıcının Yetkilerini Seçiniz </label></div>
<div class="col-md-3">
<?$WMform->check("yetkiler", "a", "Kullanıcı İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "b", "Ban İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "c", "EP İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "d", "Karakter İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "e", "Lonca İşlemleri", false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("yetkiler", "f", "GM İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "g", "Edit Arama İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "h", "Shop İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "j", "İtem İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "k", "Efsun İşlemleri", false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("yetkiler", "l", "+ Basma İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "m", "Mob İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "n", "Tema İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "o", "Site Ayarları", false, 1);?>
<?$WMform->check("yetkiler", "p", "Sayfa İşlemleri", false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("yetkiler", "r", "Teknik Destek", false, 1);?>
<?$WMform->check("yetkiler", "s", "Market İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "t", "Mail Ayarları", false, 1);?>
<?$WMform->check("yetkiler", "u", "Loglar", false, 1);?>
<?$WMform->check("yetkiler", "v", "Bakım İşlemleri", false, 1);?>
<?$WMform->check("yetkiler", "y", "Server Ayarları", false, 1);?>
<?$WMform->check("yetkiler", "z", "Server Düzenleme", false, 1);?>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr>
<div class="col-md-12"><label>* Hangi Serverları Yönetebilsin ? </label></div>

<?php $serverlar = $db->prepare("SELECT isim,id FROM server"); $serverlar->execute(); foreach($serverlar as $server){ ?>
<div class="col-md-3">
<?$WMform->check("server_yetki", $server["id"], $server["isim"], false, 1);?>
</div>
<?php } ?>

</div>
<div class="col-md-12" style="margin-top:10px;"><hr><?=$WMform->buton(1, " KULLANICI EKLE", "info pull-right", "save");?></div>
<?=$WMform->footer();?>
	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
