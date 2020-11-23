<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Marketten Alınanlar
												</div>
									<div class="panel-body">
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
												<th>Alan</th>
												<th>Alınan</th>
												<th>Fiyat</th>
												<th>Tarih</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $db->prepare("SELECT * FROM market_log WHERE sid = ? ORDER BY id DESC");
											$query->execute(array($_SESSION["server"]));
											foreach($query as $row){
												?>
												<tr>
												<td><a href="index.php?sayfa=kullanicilar&login=<?=$row["karakter"];?>" target="_blank"><?=$row["karakter"];?> </a></td>
												<td><?=$row["alinan"];?></td>
												<td><?=$row["fiyat"];?> EP </td>
												<td><?=WM_zaman_cevir($row["tarih"]);?></td>
												<td>
												<?php if($row["tur"] == 2){ ?>
										<a href="index.php?sayfa=market_log&id=<?=$row["id"];?>" target="_blank" class="btn btn-success"><i class="fa fa-eye"></i></a>
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
