<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Kullanıcıları Görüntülüyorsunuz.
												</div>
									<div class="panel-body">
									<?php if($WMadmin->serverbilgi("log") == 1){ ?>
									<a onclick="WM_click('log_islemleri&formid=1&tur=2')" href="javascript:;" class="btn btn-danger"><i class="fa fa-close"></i> Log Kapat (Adminlerin yaptığı düzenlemeler daha kayıt olmaz.)</a>
									<?php }else{ ?>
									<a onclick="WM_click('log_islemleri&formid=1&tur=1')" href="javascript:;" class="btn btn-success"><i class="fa fa-check"></i> Log Aç (Adminlerin yaptığı düzenlemeler kayıt olur)</a>
									<?php } ?>
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
												<th>Log</th>
												<th>İşlemi Yapan</th>
												<th>Tarih</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $db->prepare("SELECT * FROM log WHERE tur != ? && sid = ? ORDER BY id DESC");
											$query->execute(array(4, $_SESSION["server"]));
											foreach($query as $row){
												?>
												<tr id="log-<?=$row["id"];?>">
												<td><?=$row["log"];?></td>
												<td><?=$row["yapan"];?></td>
												<td><?=WM_zaman_cevir($row["tarih"]);?></td>
												<td>
							<a onclick="WM_sil('log_islemleri&formid=2&id=<?=$row["id"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
												<?php if($row["tur"] == 2 || $row["tur"] == 3){ ?>
												<a href="index.php?sayfa=log&tur=<?=$row["tur"];?>&id=<?=$row["id"];?>" target="_blank" class="btn btn-success"><i class="fa fa-eye"></i></a>
											<?php } ?>
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
