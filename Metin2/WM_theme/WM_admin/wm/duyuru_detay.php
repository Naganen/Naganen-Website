<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
									<div class="panel-body">
									
								<?=$WMform->head("duyuru_islemleri");?>
								<?=$WMform->veri("konu", false, "text", false, 'value="'.$dfetch["konu"].'"', 'Duyuru Konusunu Giriniz');?>
								<label>Duyuru İçeriğini Giriniz</label>
								<textarea name="icerik" class="icerik"><?=$dfetch["icerik"];?></textarea>
								<?php if($dfetch["label"] != ''){ $check = 1; }else{ $check = false; }?>
								<?$WMform->check("label_durum", true, " Konunun Başına duyurunun kategorisini yazcakmısınız ? örnek : Güncelleme", $check, 1);?>
								<div class="form-group">
								<?=$WMform->veri("label", false, "text", false, 'value="'.$dfetch["labels"].'"', 'Yazacaksanız Buraya Değer Girin');?>
								<label>Yazdığınız Şeyin Arkaplanı Ne Olsun ? </label>
								<select class="form-control" name="label_renk">
								<option value="yesil" <?=($dfetch["label"] == "yesil") ? "selected" : '';?>>Yeşil</option>
								<option value="acikmavi" <?=($dfetch["label"] == "acikmavi") ? "selected" : '';?>>Açık Mavi</option>
								<option value="kapalimavi" <?=($dfetch["label"] == "kapalimavi") ? "selected" : '';?>>Kapalı Mavi</option>
								<option value="kirmizi" <?=($dfetch["label"] == "kirmizi") ? "selected" : '';?>>Kırmızı</option>
								<option value="sari" <?=($dfetch["label"] == "sari") ? "selected" : '';?>>Sarı</option>
								<option value="siyah" <?=($dfetch["label"] == "siyah") ? "selected" : '';?>>Siyah</option>
								<option value="turuncu" <?=($dfetch["label"] == "turuncu") ? "selected" : '';?>>Turuncu</option>
								<option value="beyaz" <?=($dfetch["label"] == "beyaz") ? "selected" : '';?>>Beyaz</option>
								</select>
								</div>
								<?=$WMform->buton(2, " Duyuruyu Güncelle", "success pull-right", "save", $dfetch["id"]);?>
								<?=$WMform->footer();?>
									
									</div>
									</div>
                            
                        </div>                        
                    </div>
                    
                    
                    
                </div>
