<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
									<div class="panel-body">
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th></th>
												<th>Konu</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $db->prepare("SELECT konu,id FROM duyurular WHERE sid = ? ORDER BY id DESC");
											$query->execute(array($_SESSION["server"]));
											$i = 0;
											foreach($query as $row){
												$i++;
												?>
												<tr id="duyuru-<?=$row["id"];?>">
												<td WIDTH=15>#<?=$i;?></td>
												<td><?=$WMinf->kisalt($row["konu"], 85);?></td>
												<td>
												<a class="btn btn-success btn-xs" href="index.php?sayfa=duyuru&islem=<?=$row["id"];?>" target="_blank"><i class="fa fa-eye"></i></a>
												<a onclick="WM_sil('duyuru_islemleri&silincek=<?=$row["id"];?>&formid=3')" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
