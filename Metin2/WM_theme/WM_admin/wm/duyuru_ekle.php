<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-body">
									
<?=$WMform->head("duyuru_islemleri");?>
<?=$WMform->veri("konu", false, "text", false, false, 'Duyuru Konusunu Giriniz');?>
								<label>Duyuru İçeriğini Giriniz</label>
<textarea name="icerik" class="icerik"></textarea>
<?$WMform->check("label_durum", true, " Konunun Başına duyurunun kategorisini yazcakmısınız ? örnek : Güncelleme", false, 1);?>
<div class="form-group">
<?=$WMform->veri("label", false, "text", false, false, 'Yazacaksanız Buraya Değer Girin');?>
<label>Yazdığınız Şeyin Arkaplanı Ne Olsun ? </label>
<select class="form-control" name="label_renk">
<option value="yesil">Yeşil</option>
<option value="acikmavi">Açık Mavi</option>
<option value="kapalimavi">Kapalı Mavi</option>
<option value="kirmizi">Kırmızı</option>
<option value="sari">Sarı</option>
<option value="siyah">Siyah</option>
<option value="turuncu">Turuncu</option>
<option value="beyaz">Beyaz</option>
</select>
</div>
<?=$WMform->buton(1, " Duyuru Ekle", "success pull-right", "plus");?>
<?=$WMform->footer();?>
									
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
