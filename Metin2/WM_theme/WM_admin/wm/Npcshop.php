                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Serverınızdaki Npcleri Görüntülüyorsunuz.
												</div>
									<div class="panel-body">
									<div class="alert alert-warning"><strong><i class="fa fa-warning"></i> UYARI ! </strong> NPC silindiğinde barındırdığı bütün itemlerde otomatik silinir. Silinmesini istemiyorsanız NPC itemlerini aktarın</div>
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th></th>
												<th>Shop isim</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $odb->prepare("SELECT * FROM player.shop ORDER BY vnum");
											$query->execute();
											$i = 0;
											foreach($query as $row){
												$i++;
												?>
												<tr id="shop-<?=$row["vnum"];?>">
												<td WIDTH=15>#<?=$i;?></td>
												<td><?=$row["name"];?></td>
												<td WIDTH=195>
												<a class="btn btn-success" href="index.php?sayfa=Npcshop&vnum=<?=$row["vnum"];?>" target="_blank"><i class="fa fa-eye"></i></a>
												<a onclick="WM_sil('shop_sil&pid=<?=$row["vnum"];?>&npc=<?=$row["npc_vnum"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
