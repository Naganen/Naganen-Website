<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Oluşturduğunuz başvuruları listeliyorsunuz..
												
												</div>
									<div class="panel-body">
									
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
												<th>Başvuru Türü</th>
												<th>Başvuru Konusu</th>
												<th>Başvuran Sayısı</th>
												<th>Onaylı - Redli</th>
												<th>Tarih</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $db->prepare("SELECT id,konu,tur,basvuranlar,tarih,onaylananlar,red_edilenler FROM basvurular WHERE sid = ? ORDER BY id DESC");
											$query->execute(array($_SESSION["server"]));
											foreach($query as $row){ 
											
											$basvurular = json_decode($row["basvuranlar"], true);
											
											$onayli = json_decode($row["onaylananlar"], true);
											
											$redli = json_decode($row["red_edilenler"], true);
											
											?>
											<tr id="basvuru-<?=$row["id"];?>">
											<td><?=($row["tur"] == 2) ? 'Lonca Başvuru' : 'Normal Başvurusu';?></td>
											<td><?=$row["konu"];?></td>
											<td><?=count($basvurular);?> kişi başvurdu</td>
											<td><i style="color:green;" class="fa fa-thumbs-up"></i> <?=count($onayli);?> <i style="color:red;" class="fa fa-thumbs-down"></i> <?=count($redli);?></td>
											<td><?=WM_zaman_cevir($row["tarih"]);?></td>
											<td>
											<a href="index.php?sayfa=basvurular&id=<?=$row["id"];?>" class="btn btn-success" target="_blank"><i class="fa fa-eye"></i></a>
											<a  onClick="WM_sil('basvuru_islemleri&formid=3&pid=<?=$row["id"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>	
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
