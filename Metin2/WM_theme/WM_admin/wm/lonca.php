                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Loncaları Görüntülüyorsunuz.
												</div>
									<div class="panel-body">
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th></th>
												<th>Lonca İsimi</th>
												<th>Lonca Başkanı</th>
												<th>Lonca Level</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $odb->prepare("SELECT guild.*, player.name AS baskan FROM player.guild LEFT JOIN player.player ON guild.master = player.id  GROUP BY guild.id ORDER BY guild.ladder_point DESC LIMIT 100 ");
											$query->execute( );
											$i = 0;
											foreach($query as $row){
												$i++;
												?>
												<tr>
												<td WIDTH=15>#<?=$i;?></td>
												<td><?=$row["name"];?></td>
												<td><a href="index.php?sayfa=karakterler&name=<?=$row["baskan"];?>" target="_blank"><?=$row["baskan"];?></a></td>
												<td><?=$row["level"];?> Level</td>
												<td>
												<a class="btn btn-danger" onclick="WM_sil('lonca_dagit&gid=<?=$row["id"];?>')"><i class="fa fa-trash"></i></a>
												<a class="btn btn-success" href="index.php?sayfa=lonca&name=<?=$row["name"];?>" target="_blank"><i class="fa fa-eye"></i></a>
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
