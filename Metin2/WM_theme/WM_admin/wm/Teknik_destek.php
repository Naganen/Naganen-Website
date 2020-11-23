<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Teknik Destek Taleplerini Görüntülüyorsunuz.
												<?php if($WMadmin->serverbilgi("destek_mail") == 1){ ?>
												<a onclick="WM_click('site_ayarlari_3&formid=33&tur=2')" href="javascript:;" class="btn btn-danger btn-xs pull-right"><i class="fa fa-close"></i> Destek Mail Kapat</a>
												<?php }else{ ?>
												<a onclick="WM_click('site_ayarlari_3&formid=33&tur=1')" href="javascript:;" class="btn btn-success btn-xs pull-right"><i class="fa fa-check"></i> Destek Mail Aç</a>
												<?php } ?>
												</div>
									<div class="panel-body">
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th></th>
												<th>Açan</th>
												<th>Konu</th>
												<th>Destek Departmanı</th>
												<th>Durum</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $db->prepare("SELECT destek.*, destek_kategori.isim AS kategori FROM destek LEFT JOIN destek_kategori ON destek.kid = destek_kategori.id 
											WHERE (destek.sid = ? && destek_kategori.sid = ?) ORDER BY destek.id DESC");
											$query->execute(array($_SESSION["server"], $_SESSION["server"]));
											$i = 0;
											foreach($query as $row){
												$i++;
												?>
												<tr id="destek-<?=$row["id"];?>">
												<td WIDTH=15>#<?=$i;?></td>
												<td><?=$row["acan"];?></td>
												<td><?=$WMinf->kisalt($row["konu"], 25);?></td>
												<td><?=$row["kategori"];?></td>
												<td><?=$WMinf->destek_durum($row["durum"]);?></td>
												<td WIDTH=130>
												<a class="btn btn-success" href="index.php?sayfa=Teknik_destek&tid=<?=$row["id"];?>" target="_blank"><i class="fa fa-eye"></i></a>
												<a onclick="WM_sil('teknik_destek_sil&tid=<?=$row["id"];?>&sid=<?=$_SESSION["server"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
