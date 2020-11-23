                <div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
									<div class="panel-body">
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th></th>
												<th>Kullanıcı</th>
												<th>Banlanma Nedeni</th>
												<th>Ban Kalkma Süresi</th>
												<th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $odb->prepare("SELECT login, ban_time, ban_neden, ban_sure FROM account WHERE status = ?");
											$query->execute(array('block'));
											$i = 0;
											foreach($query as $row){
												$i++;
												?>
												<tr>
												<td WIDTH=15><?=$i;?></td>
												<td><a href="index.php?sayfa=kullanicilar&login=<?=$row["login"];?>" target="_blank"><?=$row["login"];?></a></td>
												<td><?=$row["ban_neden"];?></td>
												<td><?=($row["ban_sure"] == 1) ? 'Sınırsız' : WM_zaman_cevir2($row["ban_sure"]);?></td>
												<td WIDTH=130>
												<a onClick="WM_click('bankaldir&login=<?=$row["login"];?>')" href="javascript:;" class="btn btn-success btn-xs"><i class="fa fa-check"></i> Ban Kaldır</a>
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
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
