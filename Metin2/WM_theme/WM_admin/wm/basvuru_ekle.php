<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Başvuru Formu Ekliyorsunuz
</div>
<div class="panel-body">
<?=$WMform->head("basvuru_islemleri");?>
<?=$WMform->veri("konu", "Başvurunun konusunu giriniz", "text", false);?>
<textarea name="icerik" class="icerik">Başvuru İçeriğini Giriniz</textarea>

<div class="col-md-12"><hr></div>
<div class="col-md-12" style="margin-top:10px;">
<div class="col-md-6"><?$WMform->check("loncami", 1, "Eklediğiniz bu başvuru formu, lonca turnuvası için ise işaretleyiniz.  ", false, 1);?></div>
<div class="col-md-3"><?=$WMform->veri("kisi_sinir", "Lonca Kişi Sınırını Giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?></div>
<div class="col-md-3"><?=$WMform->veri("level_sinir", "Lonca Level Sınırını Giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?></div>

</div>
<div class="col-md-12" style="margin-top:10px;"><hr>
<div class="alert alert-warning"><i class="fa fa-warning"></i><b> UYARI !</b> Eğer süreliyi işaretlerseniz belirttiğiniz tarih ve saat geldiğinde daha başvuru alınmayacaktır.  </div>
<div class="col-md-3"><?$WMform->check("sureli", 1, "Eklediğiniz Başvuru Formu Süreli mi ? ", false);?></div>
<div class="col-md-4"><?=$WMform->veri("tarih", false, "date");?></div>
<div class="col-md-5"><?=$WMform->veri("saat", "Saati giriniz örnek -> 13:55:55", "text");?></div>
</div>

<div class="col-md-12"><hr></div>

<?=$WMform->buton(1, " Başvuru Formunu Ekle", "success pull-right", "plus");?>

<?=$WMform->footer();?>
					
					
					
</div>
</div>
                            
</div>                        
</div>
                    
                                       
</div>