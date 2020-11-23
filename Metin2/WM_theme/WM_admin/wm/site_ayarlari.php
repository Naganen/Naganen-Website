<div class="body-content animated fadeIn">

<div class="row">

<div class="col-md-12">
<div class="alert alert-warning"><strong><i class="fa fa-warning"></i> UYARI ! </strong> Bir tik işaretlediğiniz zaman diğer tiki kaldırmanız gereklidir. </div>
</div>

<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Kayıt İşlemleri
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("kayit") == 1){$kayiton = 1; $kayitoff = false;}else{$kayiton = false; $kayitoff = 1;}
?>
<?$WMform->head("site_ayarlari");?>
<?$WMform->check("kayit", 1, " Site Kayıtlar Açılsın", $kayiton, 1);?>
<?$WMform->check("kayit", 2, " Site Kayıtlar Kapansın", $kayitoff, 1);?>
<?$WMform->buton(1, "Kayıt Et", "default btn-block pull-right", "save");?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Kayıt Güvenlik Sorusu
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("guvenlik") == 1){$guvenlikon = 1; $guvenlikoff = false;}else{$guvenlikon = false; $guvenlikoff = 1;}
?>
<?$WMform->head("site_ayarlari");?>
<?$WMform->check("guvenlik", 1, " Güvenlik Sorusu Aktif Olsun", $guvenlikon, 1);?>
<?$WMform->check("guvenlik", 2, " Güvenlik Sorusu Pasif Olsun", $guvenlikoff, 1);?>
<?$WMform->buton(2, "Kayıt Et", "default btn-block pull-right", "save");?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Kayıt Onay İşlemleri
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("kayit_onay") == 2){$kayit_onayon = 1; $kayit_onayoff = false;}else{$kayit_onayon = false; $kayit_onayoff = 1;}
?>
<?$WMform->head("site_ayarlari");?>
<?$WMform->check("kayit_onay", 2, " Kaydını Mailden Onaylasın", $kayit_onayon, 1);?>
<?$WMform->check("kayit_onay", 1, " Direk Aktif Olsun", $kayit_onayoff, 1);?>
<?$WMform->buton(3, "Kayıt Et", "default btn-block pull-right", "save");?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Kayıt Hoşgeldin Mesajı
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("kayit_hosgeldin") == 2){$kayit_hosgeldinon = 1; $kayit_hosgeldinoff = false;}else{$kayit_hosgeldinon = false; $kayit_hosgeldinoff = 1;}
?>
<?$WMform->head("site_ayarlari");?>
<?$WMform->check("kayit_hosgeldin", 2, " Hoşgeldin Maili Göndersin", $kayit_hosgeldinon, 1);?>
<?$WMform->check("kayit_hosgeldin", 1, " Hoşgeldin Maili Göndermesin", $kayit_hosgeldinoff, 1);?>
<?$WMform->buton(4, "Kayıt Et", "default btn-block pull-right", "save", 1);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-danger">
<div class="panel-heading ui-draggable-handle">
Kullanıcı Mail Sınırlaması
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("mail_kac") == 2){$mail_kacon = 1; $mail_kacoff = false;}else{$mail_kacon = false; $mail_kacoff = 1;}
?>
<?$WMform->head("site_ayarlari");?>
<?$WMform->check("mail_kac", 2, " Aynı maille sınırsız kayıt olsun", $mail_kacon, 1);?>
<?$WMform->check("mail_kac", 1, " Aynı maille 1 kere kayıt olsun", $mail_kacoff, 1);?>
<?$WMform->buton(5, "Kayıt Et", "danger btn-block pull-right", "save", 1);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-danger">
<div class="panel-heading ui-draggable-handle">
Online Sıralaması
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("online_liste") == 1){$online_listeon = 1; $online_listeoff = false;}else{$online_listeon = false; $online_listeoff = 1;}
?>
<?$WMform->head("site_ayarlari");?>
<?$WMform->check("online_liste", 1, " Online Sıralaması Olsun", $online_listeon, 1);?>
<?$WMform->check("online_liste", 2, " Online Sıralaması Olmasın", $online_listeoff, 1);?>
<?$WMform->buton(6, "Kayıt Et", "danger btn-block pull-right", "save", 1);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-danger">
<div class="panel-heading ui-draggable-handle">
Zenginler Sıralaması
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("zenginler") == 1){$zenginleron = 1; $zenginleroff = false;}else{$zenginleron = false; $zenginleroff = 1;}
?>
<?$WMform->head("site_ayarlari");?>
<?$WMform->check("zenginler", 1, " Zenginler Sıralaması Olsun", $zenginleron, 1);?>
<?$WMform->check("zenginler", 2, " Zenginler Sıralaması Olmasın", $zenginleroff, 1);?>
<?$WMform->buton(7, "Kayıt Et", "danger btn-block pull-right", "save", 1);?>
<?$WMform->footer();?>
</div>
</div>
</div>  


<div class="col-md-3">
<div class="panel panel-danger">
<div class="panel-heading ui-draggable-handle">
Kullanıcı Adımı Unuttum
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("kullanici_unuttum") == 1){$kulunuton = 1; $kulunutoff = false;}else{$kulunuton = false; $kulunutoff = 1;}
?>
<?$WMform->head("site_ayarlari_2");?>
<?$WMform->check("kullanici_unuttum", 1, " Kullanıcı Adımı Unuttum Aktif", $kulunuton, 1);?>
<?$WMform->check("kullanici_unuttum", 2, " Kullanıcı Adımı Unuttum Pasif", $kulunutoff, 1);?>
<?$WMform->buton(10, "Kayıt Et", "danger btn-block pull-right", "save");?>
<?$WMform->footer();?>
</div>
</div>
</div> 

<div class="col-md-3">
<div class="panel panel-warning">
<div class="panel-heading ui-draggable-handle">
Breadcumb Seçenekleri
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("breadcumb") == 1){$breadcon = 1; $breadcoff = false;}else{$breadcon = false; $breadcoff = 1;}
?>
<?$WMform->head("site_ayarlari_2");?>
<?$WMform->check("breadcumb", 1, " Breadcumb aktif olsun", $breadcon, 1);?>
<?$WMform->check("breadcumb", 2, " Breadcumb pasif olsun", $breadcoff, 1);?>
<?$WMform->buton(11, "Kayıt Et", "info btn-block pull-right", "save");?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-warning">
<div class="panel-heading ui-draggable-handle">
Mail Değiştirme Seçenekleri
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("mail_degistir") == 1){$maild_gson = 1; $maild_gsoff = false;}else{$maild_gson = false; $maild_gsoff = 1;}
?>
<?$WMform->head("site_ayarlari_3");?>
<?$WMform->check("mail_degis", 1, " Mail Değiştirme Olsun", $maild_gson, 1);?>
<?$WMform->check("mail_degis", 2, " Mail Değiştirme Pasif Olsun", $maild_gsoff, 1);?>
<?$WMform->buton(31, "Kayıt Et", "info btn-block pull-right", "save");?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
Kullanıcı Adı Değiştirme İşlemleri
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("kullanici_degis") == 1){$kuldgs_hmn = 1; $kuldgs_mail = false; $kuldgs_psf = false;}else if($WMadmin->serverbilgi("kullanici_degis") == 2)
{$kuldgs_hmn = false; $kuldgs_mail = 1; $kuldgs_psf = false;}else{ $kuldgs_hmn = false; $kuldgs_mail = false; $kuldgs_psf = 1; }
?>
<?$WMform->head("site_ayarlari_3");?>
<?$WMform->check("kullanici_degis", 1, " Hemen Değişsin", $kuldgs_hmn, 1);?>
<?$WMform->check("kullanici_degis", 2, " Mail İle Değiştirsin", $kuldgs_mail, 1);?>
<?$WMform->check("kullanici_degis", 3, " Pasif Olsun", $kuldgs_psf, 1);?>
<?$WMform->buton(32, "Kayıt Et", "success btn-block pull-right", "save");?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
Şifremi Unuttum Türü
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("sifre_unuttum") == 1){$kendimail = 1; $otodegis = false; $guvenlikdegis = false;}else if($WMadmin->serverbilgi("sifre_unuttum") == 2)
{$kendimail = false; $otodegis = 1; $guvenlikdegis = false;}else{ $kendimail = false; $otodegis = false; $guvenlikdegis = 1; }
?>
<?$WMform->head("site_ayarlari_2");?>
<?$WMform->check("sifre_unuttum", 1, " Mail ile kendi değiştirsin", $kendimail, 1);?>
<?$WMform->check("sifre_unuttum", 2, " Mailine otomatik yeni şifre göndersin", $otodegis, 1);?>
<?$WMform->check("sifre_unuttum", 3, " Güvenlik sorusu ile değiştirsin", $guvenlikdegis, 1);?>
<?$WMform->buton(12, "Kayıt Et", "success btn-block pull-right", "save");?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
Şifre Değiştirme Türü
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("hesap_sifre") == 1){$hsifrekendi = 1; $hsifreoto = false; $hsifredirek = false;}else if($WMadmin->serverbilgi("hesap_sifre") == 2)
{$hsifrekendi = false; $hsifreoto = 1; $hsifredirek = false;}else{ $hsifrekendi = false; $hsifreoto = false; $hsifredirek = 1; }
?>
<?$WMform->head("site_ayarlari_2");?>
<?$WMform->check("hesap_sifre", 1, " Mail ile kendi değiştirsin", $hsifrekendi, 1);?>
<?$WMform->check("hesap_sifre", 2, " Mailine otomatik yeni şifre göndersin", $hsifreoto, 1);?>
<?$WMform->check("hesap_sifre", 3, " Direk Şifre Değiştirsin", $hsifredirek, 1);?>
<?$WMform->buton(13, "Kayıt Et", "success btn-block pull-right", "save");?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
Depo Şifre Değiştirme Türü
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("depo_sifre") == 1){$deposkendi = 1; $deposoto = false; $deposdirek = false;}else if($WMadmin->serverbilgi("depo_sifre") == 2)
{$deposkendi = false; $deposoto = 1; $deposdirek = false;}else{ $deposkendi = false; $deposoto = false; $deposdirek = 1; }
?>
<?$WMform->head("site_ayarlari_2");?>
<?$WMform->check("depo_sifre", 1, " Mail ile kendi değiştirsin", $deposkendi, 1);?>
<?$WMform->check("depo_sifre", 2, " Mailine otomatik yeni şifre göndersin", $deposoto, 1);?>
<?$WMform->check("depo_sifre", 3, " Direk Şifre Değiştirsin", $deposdirek, 1);?>
<?$WMform->buton(14, "Kayıt Et", "success btn-block pull-right", "save");?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-3">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
Karakter Silme Şifresi Değiştirme Türü
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("karakter_silme_sifre") == 1){$krsilkendi = 1; $krsiloto = false; $krsildirek = false;}else if($WMadmin->serverbilgi("karakter_silme_sifre") == 2)
{$krsilkendi = false; $krsiloto = 1; $krsildirek = false;}else{ $krsilkendi = false; $krsiloto = false; $krsildirek = 1; }
?>
<?$WMform->head("site_ayarlari_2");?>
<?$WMform->check("karakter_silme_sifre", 1, " Mail ile kendi değiştirsin", $krsilkendi, 1);?>
<?$WMform->check("karakter_silme_sifre", 2, " Mailine otomatik yeni şifre göndersin", $krsiloto, 1);?>
<?$WMform->check("karakter_silme_sifre", 3, " Direk Şifre Değiştirsin", $krsildirek, 1);?>
<?$WMform->buton(15, "Kayıt Et", "success btn-block pull-right", "save", 1);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

                      
</div>

</div>
