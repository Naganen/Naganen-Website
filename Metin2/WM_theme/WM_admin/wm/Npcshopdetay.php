                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												<?=$sfetch["name"];?> Adlı Npc yi görüntülüyorsunuz..
												</div>
									<div class="panel-body">
									
											<table class="table table-bordered">
											<thead>
											<tr>
											<th>Shop Vnum</th>
											<th>Shop İsim</th>
											<th>Npc Vnum</th>
											<th></th>
											</tr>
											</thead>
											<tbody>
											<tr>
											<?=$WMform->head("shop_duzenle");?>
											<td><?=$WMform->veri("svnum", "İtem Vnum", "text", "12", "value='".$sfetch["vnum"]."' onkeyup='sayi_kontrol(this)'");?></td>
											<td><?=$WMform->veri("shopname", "İtem Vnum", "text", "12", "value='".$sfetch["name"]."' onkeyup='sayi_kontrol(this)'");?></td>
											<td><?=$WMform->veri("shopvnum", "İtem Vnum", "text", "12", "value='".$sfetch["npc_vnum"]."' onkeyup='sayi_kontrol(this)'");?>
											<?=$WMform->veri("shoporj", false, "hidden", "1", "value='".$sfetch["vnum"]."''");?>
											</td>
											<td><?=$WMform->buton(-2, false, "info btn-xs", "save", $vnum);?></td>
											<?=$WMform->footer();?>
											</tr>
											</tbody>
											
											</table>
									
									
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th></th>
												<th>İtem</th>
												<th>İtem Vnum</th>
												<th>Miktar</th>
												<th>Birim Fiyat</th>
												<th>Toplam Fiyat</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
										
											<tr>
											<?=$WMform->head("shop_item_ekle");?>
											<td></td>
											<td>İtem Ekleyin</td>
											<td><?=$WMform->veri("item", "İtem Vnum", "text", "7", 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("miktar", "Miktar", "text", "5", 'onkeyup="sayi_kontrol(this)"');?></td>
											<td>Otomatik</td>
											<td>Otomatik</td>
											<td><?=$WMform->buton(-1, false, "info btn-xs", "plus", $vnum);?></td>
											<?=$WMform->footer();?>
											</tr>
																					
											<?php
											$i = 0;
											foreach($shopitem as $row){
												$i++;
												?>
												<tr id="item-<?=$row["item_vnum"];?>">
												<td WIDTH=15>#<?=$i;?></td>
												<td><a href="index.php?sayfa=İtem_ara&vnum=<?=$row["item_vnum"];?>" target="_blank"><i class="fa fa-eye"></i> <?=$WMadmin->item_bul($row["item_vnum"]);?></a></td>
												<?=$WMform->head("shop_item_degis", $i);?>
												<td><?=$WMform->veri("vnum-$i", false, "text", "6", "value='".$row["item_vnum"]."' onkeyup='sayi_kontrol(this)'");?>
												<?=$WMform->veri("orj-$i", false, "hidden", "1", "value='".$row["item_vnum"]."'");?>
												</td>
												<td><?=$WMform->veri("miktar-$i", false, "text", "4", "value='".$row["count"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$inf->yang_cevir($row["gold"]);?></td>
												<td><?=$inf->yang_cevir($row["gold"]*$row["count"]);?></td>
												<td>
												<?=$WMform->buton($i, false, "primary btn-xs", "save", $vnum);?>
												<a onclick="WM_sil('shop_item_sil&svnum=<?=$row["shop_vnum"];?>&item=<?=$row["item_vnum"];?>')" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
												<?=$WMform->footer();?>
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
                    
                    
                    <!-- START DASHBOARD CHART -->
					<div class="chart-holder" id="dashboard-area-1" style="height: 200px;"></div>
					<div class="block-full-width">
                                                                       
                    </div>                    
                    <!-- END DASHBOARD CHART -->
                    
                </div>
