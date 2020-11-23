                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												EP Fiyatları Düzenle
												
												</div>
									<div class="panel-body">
									
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th>Sıra</th>
                                                <th>EP</th>
												<th>FİYAT</th>
												<th>İŞLEMLER</th>
                                            </tr>
                                        </thead>
                                        <tbody>
									<tr>	
									<?=$WMform->head("ep_fiyat_islem");?>
									<td><?=$WMform->veri("sira", "Sırayı Giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
									<td><?=$WMform->veri("miktar", "EP Miktarını giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
									<td><?=$WMform->veri("fiyat", "EP Fiyatını giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
									<td><?=$WMform->buton(1, " EP EKLE", "info", "plus");?></td>
									<?=$WMform->footer();?>
									</tr>
										
											<?php
											$query = $db->prepare("SELECT sira,ep,fiyat,id FROM epfiyatlari WHERE sid = ? ORDER BY sira");
											$query->execute(array($_SESSION["server"]));
											$i = 4;
											foreach($query as $row){ $i++;
											?>
												<tr id="ep_fiyatlari-<?=$row["id"];?>">
												<?=$WMform->head("ep_fiyat_islem", $i);?>
												<td><?=$WMform->veri("sira-$i", false, "text", false, "value='".$row["sira"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("miktar-$i", false, "text", false, "value='".$row["ep"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("fiyat-$i", false, "text", false, "value='".$row["fiyat"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td WIDTH=10%>
								<a onclick="WM_sil('ep_fiyat_islem&formid=2&id=<?=$row["id"];?>&')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
