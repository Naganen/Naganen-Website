<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Market Kategori Ekle
												
												</div>
									<div class="panel-body">
									
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th>Kategori Sırası</th>
												<th>Kategori İsimi</th>
												<th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
									<tr>	
									<?=$WMform->head("market_islem");?>
									<td><?=$WMform->veri("sira", "Kategori Sırasını Giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
									<td ><?=$WMform->veri("kategori", "Kategori İsmini Giriniz", "text", false);?></td>
									<td><?=$WMform->buton(1, " KATEGORİ EKLE", "info pull-right", "plus");?></td>
									<?=$WMform->footer();?>
									</tr>
										
											<?php
											$query = $db->prepare("SELECT sira,id,isim FROM market_kategori WHERE sid = ? ORDER BY sira");
											$query->execute(array($_SESSION["server"]));
											$i = 4;
											foreach($query as $row){ $i++;
											?>
												<tr id="market_kategori-<?=$row["id"];?>">
												<?=$WMform->head("market_islem", $i);?>
												<td><?=$WMform->veri("sira-$i", false, "text", false, "value='".$row["sira"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("isim-$i", false, "text", false, "value='".$row["isim"]."'");?></td>
												<td WIDTH=10%>
								<a onclick="WM_sil('market_islem&formid=2&id=<?=$row["id"];?>&')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
												<?=$WMform->buton($i, false, "info", "save", $row["id"]);?>
												<?=$WMform->footer();?>
												</td>
												</tr>
												
										<?php
											}
											?>
                                        </tbody>
                                    </table>
									
										
									</div>
									</div>
                            
                        </div>                        
                    </div>
                    
                    
                    
                </div>
