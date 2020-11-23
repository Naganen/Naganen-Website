<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Bugün Kayıt Olan Kullanıcıları Görüntülüyorsunuz
												</div>
									<div class="panel-body">
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th></th>
												<th>Kullanıcı</th>
												<th>Kayıt Tarihi</th>
												<th>Son Giriş</th>
												<th>Ejderha Parası</th>
												<th>Email</th>
												<th>İşlemler</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = $odb->prepare("SELECT * FROM account WHERE create_time LIKE ? ORDER BY id DESC");
											$query->execute(array('%'.date("Y-m-d").'%'));
											$i = 0;
											foreach($query as $row){
												$i++;
												if(!$row["last_play"]){$bilgi = "Hiç Girmedi";}else{$bilgi = WM_zaman_cevir($row["last_play"]);}
												echo '<tr id="kullanici-'.$row["id"].'">
												<td WIDTH=15>#'.$i.'</td>
												<td>'.$row["login"].'</td>
												<td>'.WM_zaman_cevir($row["create_time"]).'</td>
												<td>'.$bilgi.'</td>
												<td>'.$row["coins"].' EP 
												<td>'.$row["email"].'</td>
												<td>
										<a onClick="WM_sil(\'kullanici_karakter_sil&tur=2&id='.$row["id"].'\')" href="javascript:;" class="btn btn-danger "><i class="fa fa-trash"></i></a>
												<a href="index.php?sayfa=kullanicilar&login='.$row["login"].'" target="_blank" class="btn btn-success"><i class="fa fa-eye"></i></a>
												</td>
												</tr>';
											}
											?>
                                        </tbody>
                                    </table>
									</div>
									</div>
                            
                        </div>                        
                    </div>
                    
                    
                    
                </div>
