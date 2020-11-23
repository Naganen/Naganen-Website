<?php $refine = $odb->prepare("SELECT * FROM player.refine_proto ORDER BY id DESC");
$refine->execute();
?>
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												+ Basma Oranları
												</div>
									<div class="panel-body">
									
									
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th>Refine İD</th>
												<th>İstenilen</th>
												<th>Adet</th>
												<th>İstenilen</th>
												<th>Adet</th>
												<th>İstenilen</th>
												<th>Adet</th>
												<th>İstenilen</th>
												<th>Adet</th>
												<th>İstenilen</th>
												<th>Adet</th>
												<th>Yang</th>
												<th>Geçme Oran</th>
												<th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
										
											<tr>
											<?=$WMform->head("refine_proto_ekle");?>
											<td><?=$WMform->veri("refine", "Refine İD", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("ekle1", "İstenilen", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("adet1", "Adeti", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("ekle2", "İstenilen", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("adet2", "Adeti", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("ekle3", "İstenilen", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("adet3", "Adeti", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("ekle4", "İstenilen", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("adet4", "Adeti", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("ekle5", "İstenilen", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("adet5", "Adeti", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("cost", "Yang", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->veri("prob", "Geçme % ", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
											<td><?=$WMform->buton(-1, "Ekle", "info btn-xs", "plus", false);?></td>
											<?=$WMform->footer();?>
											</tr>
																					
											<?php
											$i = 0;
											foreach($refine as $row){
												$i++;
												?>
												<tr id="refine-<?=$row["id"];?>">
												<?=$WMform->head("refine_proto_duzenle", $i);?>
												<td><?=$WMform->veri("refine-$i", false, "text", false, "value='".$row["id"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("ekle1-$i", false, "text", false, "value='".$row["vnum0"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("adet1-$i", false, "text", false, "value='".$row["count0"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("ekle2-$i", false, "text", false, "value='".$row["vnum1"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("adet2-$i", false, "text", false, "value='".$row["count1"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("ekle3-$i", false, "text", false, "value='".$row["vnum2"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("adet3-$i", false, "text", false, "value='".$row["count2"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("ekle4-$i", false, "text", false, "value='".$row["vnum3"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("adet4-$i", false, "text", false, "value='".$row["count3"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("ekle5-$i", false, "text", false, "value='".$row["vnum4"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("adet5-$i", false, "text", false, "value='".$row["count4"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("cost-$i", false, "text", false, "value='".$row["cost"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td><?=$WMform->veri("prob-$i", false, "text", false, "value='".$row["prob"]."' onkeyup='sayi_kontrol(this)'");?></td>
												<td WIDTH=80>
												<?=$WMform->buton($i, false, "primary btn-xs", "save", $row["id"]);?>
												<a onclick="WM_sil('refine_proto_sil&id=<?=$row["id"];?>')" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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
                    
                    
                </div>
