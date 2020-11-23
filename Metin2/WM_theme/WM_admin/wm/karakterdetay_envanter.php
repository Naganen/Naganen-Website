<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
                            <!-- START JUSTIFIED TABS -->
                            <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li><a href="index.php?sayfa=karakterler&name=<?=$name;?>"><?=$pfetch["name"];?></a></li>
                                    <li class="active"><a> Envanter</a></li>
                                </ul>
																		
                                <div class="panel-body tab-content">
									
									<div class="col-md-3">
	
	
											<div id="wrap">
											<div id="content">
											<div id="equip_show"></div>
											<!--INVENTAR START-->
											<?php require'WMplugin/WM_envanter/lib/inventar.php'; ?>
											<?=WM_envanter($pfetch["name"], $pfetch["id"]);?>
											<!--INVENTAR END-->
											</div>
											</div>
														</div>

									<div class="col-md-9">
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th>#</th>
												<th>İtem İsimi</th>
												<th>Durum</th>
												<th>İşlemler</th>
                                            </tr>
                                        </thead>
										<tbody>
									<?php
									$i = 0;
									$query = $odb->prepare("SELECT vnum,id,count,window FROM player.item WHERE owner_id = ? ORDER BY window DESC ");
									$query->execute(array($pfetch["id"]));
									foreach($query as $row){
										$i++;
										if($row["window"] == "INVENTORY"){ $durum = "Envanterde"; }else{ $durum = "Giyili"; }
										echo '<tr id="item-'.$row["id"].'">
										<td WIDTH=10>'.$i.'</td>
										<td>'.$WMadmin->item_bul($row["vnum"]).' [ '.$row["count"].'X ]</td>
										<td WIDTH=10>'.$durum.'</td>
										<td WIDTH=190>
										<a target="_blank" href="index.php?sayfa=item_detay&id='.$row["id"].'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Gör</a>
										<a  onClick="WM_sil(\'itemsil&id='.$row["id"].'\')" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Sil</a></td>
										</tr>
										';
									}
									
									?>
									</tbody>
									
									</table>
									
									</div>
									
									
									</div>   
									

                            </div>                                         
                            <!-- END JUSTIFIED TABS -->
						

                            
                        </div>                        
                    </div>
                    
                    
                    <!-- START DASHBOARD CHART -->
                    
                </div>
		
									<script type="text/javascript" src="<?=WM_admin_plugin.'WM_envanter_ortak/nesne_market/js/jquery-1.6.2.min.js'?>"></script>
									<script type="text/javascript" src="<?=WM_admin_plugin.'WM_envanter_ortak/envanter/js/functions.js'?>"></script>

