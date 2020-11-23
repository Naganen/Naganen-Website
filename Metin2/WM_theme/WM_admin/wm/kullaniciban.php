<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-6">
						
							<div class="panel panel-default">
                                <div class="panel-heading ui-draggable-handle">
                                    <h3 class="panel-title"> Kullanıcı - Karakter Ban İşlemleri</h3>
                                </div>
                                <div class="panel-body">
									<code>Karakter adından kullanıcı adını bulmak için aşağıdaki kutucuğa karakterin adını giriniz.. </code>
									<?=$WMform->head("kullanicisorgula");?>
									<?=$WMform->veri("karakteradi", " Karakterin adını giriniz", "text", "6");?>
									<?=$WMform->buton(0, " Kullanıcı Sorgula", "info", "search");?>
									<?=$WMform->footer();?>
									<br>
									<?=$WMform->head("kullaniciban");?>
									<?=$WMform->veri("banlancak", "Banlamak istediğiniz Kullanıcı Adını Giriniz", "text");?>
									<?=$WMform->veri("karakter", "Ban Sebebini yapan karakteri", "text");?>
									<label>Banının Kalkma Süresini Ayarlayınız.</label>
                                    <p><code>Sınırsız banlamak istiyorsanız burayı boş bırakıp. Sınırsız Banlansın kutucuğunu işaretleyiniz..</code></p>
									<?=$WMform->veri("bansure", "Banlanma Süresini Giriniz. Sınırsızsa Boş Bırakın.", "date");?>
									<?=$WMform->check("sinirsiz", "sinirsizkontrol", "Sınırsız Banlansın");?>
									<?=$WMform->veri("bansebep", "Banlanma Sebebini Giriniz. Örnek : Küfür", "text");?>
									<?=$WMform->veri("banlayan", "Banlayan kişiyi giriniz. Örnek : [TL]Webmeric", "text");?>
									<?=$WMform->buton(1, " Kullanıcı Banla", "danger btn-block", "ban");?>
									<?=$WMform->footer();?>
									
                                </div>
                            </div>						
						
                            
                        </div>   

                        <div class="col-md-6">
						
							<div class="panel panel-default">
                                <div class="panel-heading ui-draggable-handle">
                                    <h3 class="panel-title"> İP Ban işlemi</h3>
                                </div>
                                <div class="panel-body">
									<?=$WMform->head("ip_ban");?>
									<?=$WMform->veri("ip", "Banlamak istediğiniz Kullanıcı Adını Giriniz", "text");?>
									<label>Banının Kalkma Süresini Ayarlayınız.</label>
                                    <p><code>Sınırsız banlamak istiyorsanız burayı boş bırakıp. Sınırsız Banlansın kutucuğunu işaretleyiniz..</code></p>
									<?=$WMform->veri("bansure2", "Banlanma Süresini Giriniz. Sınırsızsa Boş Bırakın.", "date");?>
									<?=$WMform->check("sinirsiz2", "sinirsizkontrol", "Sınırsız Banlansın");?>
									<?=$WMform->veri("bansebep2", "Banlanma Sebebini Giriniz. Örnek : Küfür", "text");?>
									<?=$WMform->veri("banlayan2", "Banlayan kişiyi giriniz. Örnek : [TL]Webmeric", "text");?>
									<?=$WMform->buton(2, " Kullanıcı Banla", "danger btn-block", "ban");?>
									<?=$WMform->footer();?>
									
                                </div>
                            </div>						
						
                            
                        </div>                        
						
                    </div>
                    
                    
                </div>
