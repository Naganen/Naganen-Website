<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Destek Kategori Ekle
												
												</div>
									<div class="panel-body">
									
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
												<th>Kategori İsimi</th>
												<th>Yetkililer</th>
												<th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $db->prepare("SELECT id,isim,yetkililer FROM destek_kategori WHERE sid = ? ORDER BY id DESC");
											$query->execute(array($_SESSION["server"]));
											foreach($query as $row){ 
											
											$yetkililer = json_decode($row["yetkililer"]);
											
											?>
											<tr id="destek_kategori-<?=$row["id"];?>">
											<td><?=$row["isim"];?></td>
											<td><?php
											foreach($yetkililer as $yetkili)
											{
												
											echo '<label class="label label-info">'.$WMadmin->admin("gm", $yetkili).'</label>  ';
												
											}
											?></td>
											<td>
											<a href="index.php?sayfa=destek_kategori&id=<?=$row["id"];?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
											<a  onClick="WM_sil('destek_kategori&formid=2&pid=<?=$row["id"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>	
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
