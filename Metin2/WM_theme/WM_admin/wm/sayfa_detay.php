<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
									<div class="panel-body">
									
								<?=$WMform->head("sayfa_islemleri");?>
								<?=$WMform->veri("konu", false, "text", false, 'value="'.$fetch["konu"].'"', 'Duyuru Konusunu Giriniz');?>
								<label>Duyuru İçeriğini Giriniz</label>
								<textarea name="icerik" class="icerik"><?=$fetch["icerik"];?></textarea>
								<?=$WMform->buton(2, " Sayfayı Güncelle", "success pull-right", "save", $fetch["id"]);?>
								<?=$WMform->footer();?>
									
									</div>
									</div>
                            
                        </div>                        
                    </div>
                    
                    
                    
                </div>
