<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Panele giriş yapan kullanıcılar
												</div>
									<div class="panel-body">
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
												<th>İsim</th>
												<th>İp Adresi</th>
												<th>Tarih</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $db->prepare("SELECT * FROM log WHERE sid = ? && tur = ? ORDER BY id DESC");
											$query->execute(array($_SESSION["server"], 4));
											foreach($query as $row){
												?>
												<tr id="log-<?=$row["id"];?>">
												<td><?=$row["yapan"];?></td>
												<td><?=$row["log"];?></td>
												<td><?=WM_zaman_cevir($row["tarih"]);?></td>
												<td>
							<a onclick="WM_sil('log_islemleri&formid=2&id=<?=$row["id"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
