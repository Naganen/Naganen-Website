<?php

$yetkiler = json_decode($fetch["yetki"]);

$server_yetki = json_decode($fetch["server_yetki"]);

?>  

<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
<i class="fa fa-user"></i> <?=$fetch["username"];?> Düzenle
<a onclick="WM_sil('alt_kullanici_islemleri&id=<?=$fetch["id"];?>&formid=3')" href="javascript:;" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash"></i> Kullanıcı Sil</a>												
</div>
<div class="panel-body">
									
<?=$WMform->head("alt_kullanici_islemleri");?>
<?=$WMform->veri("username", false, "text", false, 'value="'.$fetch["username"].'"');?>
<?=$WMform->veri("gm", false, "text", false, 'value="'.$fetch["gm"].'"');?>
<div class="col-md-12"><label>* Eklediğiniz Kullanıcının Yetkilerini Seçiniz </label></div>
<div class="col-md-3">
<?$WMform->check("yetkiler", "a", "Kullanıcı İşlemleri", in_array("a", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "b", "Ban İşlemleri", in_array("b", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "c", "EP İşlemleri", in_array("c", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "d", "Karakter İşlemleri", in_array("d", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "e", "Lonca İşlemleri", in_array("e", $yetkiler) ? 1 : false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("yetkiler", "f", "GM İşlemleri", in_array("f", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "g", "Edit Arama İşlemleri", in_array("g", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "h", "Shop İşlemleri", in_array("h", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "j", "İtem İşlemleri", in_array("j", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "k", "Efsun İşlemleri", in_array("k", $yetkiler) ? 1 : false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("yetkiler", "l", "+ Basma İşlemleri", in_array("l", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "m", "Mob İşlemleri", in_array("m", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "n", "Tema İşlemleri", in_array("n", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "o", "Site Ayarları", in_array("o", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "p", "Sayfa İşlemleri", in_array("p", $yetkiler) ? 1 : false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("yetkiler", "r", "Teknik Destek", in_array("r", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "s", "Market İşlemleri", in_array("s", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "t", "Mail Ayarları", in_array("t", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "u", "Loglar", in_array("u", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "v", "Bakım İşlemleri", in_array("v", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "y", "Server Ayarları", in_array("y", $yetkiler) ? 1 : false, 1);?>
<?$WMform->check("yetkiler", "z", "Server Düzenleme", in_array("z", $yetkiler) ? 1 : false, 1);?>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr>
<div class="col-md-12"><label>* Hangi Serverları Yönetebilsin ? </label></div>

<?php $serverlar = $db->prepare("SELECT isim,id FROM server"); $serverlar->execute(); foreach($serverlar as $server){ ?>
<div class="col-md-3">
<?$WMform->check("server_yetki", $server["id"], $server["isim"], in_array($server["id"], $server_yetki) ? 1 : false, 1);?>
</div>
<?php } ?>

</div>
<div class="col-md-12" style="margin-top:10px;"><hr><?=$WMform->buton(2, " KULLANICI DÜZENLE", "info pull-right", "save", $fetch["id"]);?></div>
<?=$WMform->footer();?>
<div class="col-md-12" style="margin-top:10px;"><hr></div>
<?=$WMform->head("alt_kullanici_islemleri");?>
<?=$WMform->veri("pass", "Kullanıcı Şifresini Giriniz", "password", false);?>
<?=$WMform->veri("pass_retry", "Kullanıcı Şifresini Tekrar Giriniz", "password", false);?>
<?=$WMform->buton(4, " ŞİFRE DEĞİŞTİR", "danger pull-right", "key", $fetch["id"]);?>
<?=$WMform->footer();?>
	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>

