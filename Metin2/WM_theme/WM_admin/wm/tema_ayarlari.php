<div class="body-content animated fadeIn">

<div class="row">

<div class="col-md-12">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
Tema Sidebar Ayarları
</div>
<div class="panel-body">


<?$WMform->head("tema_ayarlari_");?>
<div class="col-md-3">
<div class="form-group"><code> Server İstatistikleri </code></div>
<?$WMform->check("online_oyuncu", 1, " Online Oyuncu", ($istatistikler[0] == 1) ? 1 : false);?>
<?$WMform->check("rekor_online", 1, " Rekor Online", ($istatistikler[1] == 1) ? 1 : false);?>
<?$WMform->check("toplam_kayit", 1, " Toplam Kayıt", ($istatistikler[2] == 1) ? 1 : false);?>
<?$WMform->check("toplam_karakter", 1, " Toplam Karakter", ($istatistikler[3] == 1) ? 1 : false);?>
<?$WMform->check("toplam_lonca", 1, " Toplam Lonca ", ($istatistikler[4] == 1) ? 1 : false);?>
</div>
<div class="col-md-3">
<div class="form-group"><code> Sıralamalar </code></div>
<?$WMform->check("oyuncu_siralama", 1, " Oyuncu Sıralaması", ($siralama[0] == 1) ? 1 : false);?>
<?$WMform->check("lonca_siralama", 1, " Lonca Sıralaması", ($siralama[1] == 1) ? 1 : false);?>
</div>
<div class="col-md-3">
<div class="form-group"><code> Drop Ayarları </code></div>
<?$WMform->check("exp_drop", 1, " Exp Drobu", ($drop[0] == 1) ? 1 : false);?>
<?$WMform->check("yang_drop", 1, " Yang Düşürme Drobu", ($drop[1] == 1) ? 1 : false);?>
<?$WMform->check("esya_drop", 1, " Eşya Düşürme Drobu", ($drop[2] == 1) ? 1 : false);?>
</div>
<div class="col-md-3">
<div class="form-group"><code> Genel Ayarlar </code></div>
<?$WMform->check("yan_menu", 1, " Yan Menü", ($genel[0] == 1) ? 1 : false);?>
<?$WMform->check("server_durum", 1, " Server Durum (Açıkca İşaretle)", ($genel[1] == 1) ? 1 : false);?>
<?$WMform->check("facebook", 1, " Facebookta Takip Et", ($genel[2] == 1) ? 1 : false);?>
</div>
<div class="col-md-12" style="margin-top:10px;">
<?$WMform->buton(1, "Kayıt Et", "success pull-right", "save");?>
</div>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-12">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
Tema Alt Sayfa Duyurusu
</div>
<div class="panel-body">


<?$WMform->head("tema_ayarlari_");?>

<div class="alert alert-warning"><strong><i class="fa fa-warning"></i> UYARI ! </strong> Bir tik işaretlediğiniz zaman diğer tiki kaldırmanız gereklidir. </div>

<?$WMform->check("duyuru_aktif", 1, " Duyuru Aktif Olsun", ($duyuru[0] == 1) ? 1 : false, 1);?>
<?=$WMform->veri("duyurubaslik", false, "text", false, 'value="'.$duyuru[1].'"', "Duyuru Başlığını Giriniz");?>
<?=$WMform->veri("duyuruicerik", false, "text", false, 'value="'.$duyuru[2].'"', "Duyuru İçeriğini Giriniz");?>


<div class="col-md-12" style="margin-top:10px;">
<?$WMform->buton(2, "Kayıt Et", "success pull-right", "save");?>
</div>
<?$WMform->footer();?>
</div>
</div>
</div>  




                      
</div>

</div>
