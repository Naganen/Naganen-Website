<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
									<div class="panel-body">
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th></th>
												<th>Sayfa İsimi</th>
												<th>Sayfa Linki</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $db->prepare("SELECT konu,id,seo FROM sayfalar WHERE sid = ?");
											$query->execute(array($_SESSION["server"]));
											$i = 0;
											foreach($query as $row){
												$i++;
												?>
												<tr id="sayfa-<?=$row["id"];?>">
												<td WIDTH=15>#<?=$i;?></td>
												<td><?=$WMinf->kisalt($row["konu"], 85);?></td>
												<td><a href="<?=$WMadmin->serverbilgi("link").$row["seo"];?>.html" target="_blank"><?=$WMadmin->serverbilgi("link").$row["seo"];?>.html </a></td>
												<td WIDTH=195>
												<a class="btn btn-success" href="index.php?sayfa=sayfa&id=<?=$row["id"];?>" target="_blank"><i class="fa fa-eye"></i></a>
												<a onclick="WM_sil('sayfa_islemleri&silincek=<?=$row["id"];?>&formid=3')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
