
<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
<div class="panel panel-default">
<div class="panel-body">

 <?$WMform->head("mail_ayarlari");?>
 <?$WMform->veri("mailhost", false, "text", false, 'value="'.$WMadmin->ayarlar("mail_host").'"', "Mail Host ( Örnek : smtp.gmail.com )");?>
 <?$WMform->veri("mailuser", false, "text", false, 'value="'.$WMadmin->ayarlar("mail_user").'"', "Mail Kullanıcı Adı ( Örnek : mesutmeric61@gmail.com )");?>
 <?$WMform->veri("mailpass", false, "text", false, 'value="'.$WMadmin->ayarlar("mail_pass").'"', "Mail Şifreniz");?>
 <div class="form-group"><label>Mail Güvenlik</label><select name="security" class="form-control">
 <option value="ssl" <?=($WMadmin->ayarlar("mail_secure") == "ssl") ? 'selected' : '';?>>SSL</option><option value="tls" <?=($WMadmin->ayarlar("mail_secure") == "tls") ? 'selected' : '';?>> TLS</option>
 </select></div>
 <?$WMform->veri("mailport", false, "text", false, 'value="'.$WMadmin->ayarlar("mail_port").'" onkeyup="sayi_kontrol(this)"', "Mail Portu ( Örnek : 465 )");?>
 <?$WMform->veri("mailisim", false, "text", false, 'value="'.$WMadmin->ayarlar("mail_isim").'"', "Mail Gönderenin İsmi ( Örnek : webmeric )");?>
 <?$WMform->veri("mail", false, "text", false, 'value="'.$WMadmin->ayarlar("mail_profil").'"', "Mail Gönderinin Gözükcek Mail Adresi ( Örnek : mesutmeric61@gmail.com )");?>
 <?$WMform->veri("admin_mail", false, "text", false, 'value="'.$WMadmin->ayarlar("admin_mail").'"', "Adminin maili ( Mailinize bilgilendirmeler gelir )");?>
 <?$WMform->buton(1, "Mail Ayarlarını Kaydet", "success pull-right", "save", 1);?>
 <?$WMform->footer();?>


</div>
</div>
						
</div>                        
</div>
                    
                    
                    
</div>
