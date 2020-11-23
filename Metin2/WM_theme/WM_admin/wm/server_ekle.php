<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">

Server Ekle
	
</div>
<div class="panel-body">
									
<?=$WMform->head("server_ekle");?>
<?=$WMform->veri("host", false, "text", false, false, "* Server İP Adresi");?>
<?=$WMform->veri("user", false, "text", false, false, "* Server Kullanıcı Adı");?>
<?=$WMform->veri("pass", false, "text", false, false, "Server MYSQL Şifresi");?>
<?=$WMform->veri("port", false, "text", false, 'onkeyup="sayi_kontrol(this)"', "* Server MYSQL Portu");?>
<hr>
<?=$WMform->veri("klasor", false, "text", false, false, "* Klasör İsmi");?>
<?=$WMform->veri("isim", false, "text", false, false, "* Server İsimi");?>
<?=$WMform->veri("link", false, "text", false, false, "* Site Adresi ( Örnek : http://webmeric.com/ gibi olmalıdır)");?>
<?=$WMform->veri("title", false, "text", false, false, "* Server Sekme Yazısı ( Title )");?>
<?=$WMform->veri("keywords", false, "text", false, false, "Site Anahtar Kelimeleri ( Keywords ) , ile ayırınız ( Örnek : webmeric1, webmeric2)");?>
<?=$WMform->veri("description", false, "text", false, false, "Site Açıklaması ( description ) )");?>
<?=$WMform->buton(1, " Server Ekle", "success pull-right", "plus");?>
<?=$WMform->footer();?>
	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
