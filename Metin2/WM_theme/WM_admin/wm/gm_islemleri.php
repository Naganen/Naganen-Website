<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												GM İşlemleri
												
												</div>
									<div class="panel-body">
									
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th>Karakter Sahibi</th>
                                                <th>Karakter</th>
                                                <th>İP Adresi</th>
                                                <th>Yetki</th>
												<th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
									<tr>	
									<?=$WMform->head("gm_islem");?>
									<td><?=$WMform->veri("sahip", "Karakter Sahibini Giriniz", "text", false);?></td>
									<td ><?=$WMform->veri("karakter", "Karakter Adını Giriniz", "text", false);?></td>
									<td ><?=$WMform->veri("ip", "İP Adresini Giriniz", "text", false);?></td>
									<td ><select class="form-control" name="yetki">
												<option value="IMPLEMENTOR">IMPLEMENTOR (Tam Yetki)</option>
												<option value="HIGH_WIZARD">HIGH_WIZARD (Bazı Yetkiler Kısık)</option>
												<option value="GOD">GOD (Ölümsüz GM)</option>
												<option value="LOW_WIZARD">LOW_WIZARD (En Alt Yetki)</option>
												</select></td>
									<td><?=$WMform->buton(1, " GM EKLE", "info", "plus");?></td>
									<?=$WMform->footer();?>
									</tr>
										
											<?php
$query = $odb->prepare("SELECT gmlist.mID, gmlist.mAccount, gmlist.mName, gmlist.mContactIP, gmlist.mAuthority FROM common.gmlist ORDER BY gmlist.mID DESC");
$query->execute();
											$i = 4;
											foreach($query as $row){ $i++;
											?>
												<tr id="gm-<?=$row["mID"];?>">
												<?=$WMform->head("gm_islem", $i);?>
												<td><?=$WMform->veri("sahip-$i", false, "text", false, "value='".$row["mAccount"]."'");?></td>
												<td><?=$WMform->veri("karakter-$i", false, "text", false, "value='".$row["mName"]."'");?></td>
												<td><?=$WMform->veri("ip-$i", false, "text", false, "value='".$row["mContactIP"]."'");?></td>
												<td><select class="form-control" name="yetki-<?=$i;?>">
												<option value="IMPLEMENTOR">IMPLEMENTOR (Tam Yetki)</option>
												<option value="HIGH_WIZARD">HIGH_WIZARD (Bazı Yetkiler Kısık)</option>
												<option value="GOD">GOD (Ölümsüz GM)</option>
												<option value="LOW_WIZARD">LOW_WIZARD (En Alt Yetki)</option>
												</select>
												</td>
												<td WIDTH=10%>
								<a onclick="WM_sil('gm_islem&formid=2&id=<?=$row["mID"];?>&')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
												<?=$WMform->buton($i, false, "info", "save", $row["mID"]);?>
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
