                <div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
							<div class="panel panel-default">
                                <div class="panel-heading ui-draggable-handle">
                                    <h3 class="panel-title"> Ep İşlemleri</h3>
                                </div>
                                <div class="panel-body">
									<code>Karakter adından kullanıcı adını bulmak için aşağıdaki kutucuğa karakterin adını giriniz.. </code>
									<?=$WMform->head("kullanicisorgula");?>
									<?=$WMform->veri("karakteradi", " Karakterin adını giriniz", "text", "6");?>
									<?=$WMform->buton(0, " Kullanıcı Sorgula", "info", "search");?>
									<?=$WMform->footer();?>
									<br>
									<div class="col-md-12">
                                    <p><code>Ep Gönderilcek Kullanıcıyı Giriniz</code></p>
									<?=$WMform->head("epislem");?>
									<?=$WMform->veri("banlancak", "Ep gönderilcek kullanıcıyı giriniz.", "text");?>
                                    <p><code>Ep Yükseltmek İstiyor iseniz Örnek : 25 Azaltmak istiyor iseniz Örnek : -25</code></p>
									<?=$WMform->veri("epmiktar", "Ep gönderilcek kullanıcıyı giriniz.", "text", "", 'onkeyup="sayi_kontrol(this)"');?>
									<?=$WMform->buton(1, " Ep Gönder", "success btn-block", "send");?>
									<?=$WMform->footer();?>
									</div>
									
                                </div>
                            </div>						
						
                            
                        </div>                        
                    </div>
					
					</div>
                    
                    
