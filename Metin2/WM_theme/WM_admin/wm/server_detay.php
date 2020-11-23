<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
<?=$fetch["isim"];?>
												
</div>
<div class="panel-body">

<div class="alert alert-warning"> Serverı Sildikten sonra veritabanındaki servera ait olan bütün veriler silinir.
<a href="javascript:;" onclick="WM_sil('server_islemleri&formid=2&server_id=<?=$fetch["id"];?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Serverı Sil</a></div>			
			
<?=$WMform->head("server_duzenle");?>
<?=$WMform->veri("host", false, "text", false, 'value="'.$fetch["host"].'"', "* Server İP Adresi");?>
<?=$WMform->veri("user", false, "text", false, 'value="'.$fetch["user"].'"', "* Server Kullanıcı Adı");?>
<?=$WMform->veri("pass", false, "text", false, 'value="'.$fetch["pass"].'"', "Server MYSQL Şifresi");?>
<?=$WMform->veri("port", false, "text", false, 'value="'.$fetch["sql_port"].'" onkeyup="sayi_kontrol(this)"', "* Server MYSQL Portu");?>
<hr>
<?=$WMform->veri("isim", false, "text", false, 'value="'.$fetch["isim"].'"', "* Server İsimi");?>
<?=$WMform->veri("link", false, "text", false, 'value="'.$fetch["link"].'"', "* Site Adresi ( Örnek : http://webmeric.com/ gibi olmalıdır)");?>
<?=$WMform->veri("title", false, "text", false, 'value="'.$fetch["title"].'"', "* Server Sekme Yazısı ( Title )");?>
<?=$WMform->veri("keywords", false, "text", false, 'value="'.$fetch["keywords"].'"', "Site Anahtar Kelimeleri ( Keywords ) , ile ayırınız ( Örnek : webmeric1, webmeric2)");?>
<?=$WMform->veri("description", false, "text", false, 'value="'.$fetch["description"].'"', "Site Açıklaması ( description ) )");?>
<?=$WMform->buton(1, " Ayarları Kaydet", "success pull-right", "save", $id);?>
<?=$WMform->footer();?>
	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
