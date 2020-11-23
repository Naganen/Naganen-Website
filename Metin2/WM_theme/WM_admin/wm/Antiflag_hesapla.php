                <div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Antiflag Hesaplama
												</div>
									<div class="panel-body">
									<?$WMform->head("antiflag_hesapla");?>
									<div class="col-md-6">
									<?=$WMform->info("--Cinsiyet--");?>
									<?$WMform->check("flag", 1, " Kadın Karakter Tarafından Kullanılabilir", 1, 1);?>
									<?$WMform->check("flag", 2, " Erkek Karakter Tarafından Kullanılabilir", 1, 1);?>
									<?=$WMform->info("--Karakter--");?>
									<?$WMform->check("flag", 4, " Savaşçılar Tarafından Kullanılabilir", 1, 1);?>
									<?$WMform->check("flag", 8, " Ninjalar Tarafından Kullanılabilir", 1, 1);?>
									<?$WMform->check("flag", 16, " Suralar Tarafından Kullanılabilir", 1, 1);?>
									<?$WMform->check("flag", 32, " Şamanlar Tarafından Kullanılabilir", 1, 1);?>
									<?=$WMform->info("--Krallık--");?>
									<?$WMform->check("flag", 512, " Kırmızı Krallık Kullanılabilir", 1, 1);?>
									<?$WMform->check("flag", 1024, " Sarı Krallık Kullanılabilir", 1, 1);?>
									<?$WMform->check("flag", 2048, " Mavi Krallık Kullanılabilir", 1, 1);?>
									 </div>
									 
									<div class="col-md-4">
									<?=$WMform->info("--Diğer--");?>
									<?$WMform->check("flag", 64, " Almak", 1, 1);?>
									<?$WMform->check("flag", 128, " Yere Atılabilir", 1, 1);?>
									<?$WMform->check("flag", 256, " Npc ' ye satılabilir", 1, 1);?>
									<?$WMform->check("flag", 4096, " Kaydetmek", 1, 1);?>
									<?$WMform->check("flag", 8192, " Ticarete Konulabilir", 1, 1);?>
									<?$WMform->check("flag", 16384, " Derece eksideyken ölünce düşebilir", 1, 1);?>
									<?$WMform->check("flag", 32768, " Üst üste konulabilir", 1, 1);?>
									<?$WMform->check("flag", 65536, " Paket veya ipek bohça ile açılan özel markete konulabilir", 1, 1);?>
									<?$WMform->check("flag", 131072, " Depoya Konulabilir", 1, 1);?>
									 </div>
									 
									<div class="col-md-2">
									<?=$WMform->buton(1, "Hesapla", "danger pull-right", "calculator");?>
									<div style="margin-top:40px;" align="center">Sonuç : <b id="sonuc">0</b></div>
									</div>
									 
									 
									</div>
									<?$WMform->footer();?>
									</div>
                            
                        </div>                        
                    </div>
                    
                    
                    
                </div>
