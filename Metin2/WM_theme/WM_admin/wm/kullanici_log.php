<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Kullanıcıların Yaptığı İşlemler
												</div>
									<div class="panel-body">
									<?php if($WMadmin->serverbilgi("kullanici_log") == 1){ ?>
									<a onclick="WM_click('log_islemleri&formid=3&tur=2')" href="javascript:;" class="btn btn-danger"><i class="fa fa-close"></i> Log Kapat (Kullanıcıların yaptığı işlemler daha kayıt olmaz.)</a>
									<?php }else{ ?>
									<a onclick="WM_click('log_islemleri&formid=3&tur=1')" href="javascript:;" class="btn btn-success"><i class="fa fa-check"></i> Log Aç (Kullanıcıların yaptığı işlemler kayıt olur)</a>
									<?php } ?>
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
												<th>Log</th>
												<th>İşlemi Yapan</th>
												<th>Tarih</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $db->prepare("SELECT * FROM kullanici_log WHERE sid = ? ORDER BY id DESC");
											$query->execute(array($_SESSION["server"]));
											foreach($query as $row){
												?>
												<tr id="log-<?=$row["id"];?>">
												<td><?=$row["icerik"];?></td>
												<td><a href="index.php?sayfa=kullanicilar&login=<?=$row["kullanici"];?>" target="_blank"><?=$row["kullanici"];?></a></td>
												<td><?=WM_zaman_cevir($row["tarih"]);?></td>
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
