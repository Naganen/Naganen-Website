<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Onaylı karakter işlemleri
												
												</div>
									<div class="panel-body">
									
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th>Karakter İsimi</th>
												<th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
									<tr>	
									<?=$WMform->head("onayli_karakter_islem");?>
									<td ><?=$WMform->veri("isim", "Karakter İsmini Giriniz", "text", false);?></td>
									<td><?=$WMform->buton(1, " EKLE", "info", "plus");?></td>
									<?=$WMform->footer();?>
									</tr>
										
											<?php
											$query = $db->prepare("SELECT id,isim FROM onayli_karakter WHERE sid = ? ORDER BY id DESC");
											$query->execute(array($_SESSION["server"]));
											$i = 4;
											foreach($query as $row){ $i++;
											?>
												<tr id="onayli_karakter-<?=$row["id"];?>">
												<?=$WMform->head("onayli_karakter_islem", $i);?>
												<td><?=$WMform->veri("isim-$i", false, "text", false, "value='".$row["isim"]."'");?></td>
												<td WIDTH=10%>
								<a onclick="WM_sil('onayli_karakter_islem&formid=2&id=<?=$row["id"];?>&')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
