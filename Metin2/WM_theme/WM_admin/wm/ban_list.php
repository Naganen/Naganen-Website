                <div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Ban Listesi
												</div>
									<div class="panel-body">
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
												<th>Kullanıcı</th>
												<th>Karakter</th>
												<th>Sebep</th>
												<th>Tarih</th>
												<th>İşlem</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $odb->prepare("SELECT * FROM ban_list"); 
											$query->execute();
											$i = 5;
											foreach($query as $row){ 
											$i++;
												?>
												<tr id="ban_list-<?=$i;?>">
												<td><?=$WMadmin->kullanici($row["account"], "login");?></td>
												<td><?=$row["source"];?></td>
												<td><?=$row["reason"];?></td>
												<td><?=WM_zaman_cevir($row["date"]);?></td>
												<td><?=$row["action"];?></td>
												
												<td>
<a onclick="WM_sil('ban_list_sil&account=<?=$row["account"];?>&source=<?=$row["source"];?>&fid=<?=$i;?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
