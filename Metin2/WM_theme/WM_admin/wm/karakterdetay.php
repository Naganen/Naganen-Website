<?php
$evlilik = $odb->prepare("SELECT marriage.*, player.name,player.job FROM player.marriage INNER JOIN player.player ON (player.id = marriage.pid1 || player.id = marriage.pid2 ) WHERE (pid1 = ? OR pid2 = ?)");

$evlilik->execute(array($pfetch["id"], $pfetch["id"]));
?> 

<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
                            <!-- START JUSTIFIED TABS -->
                            <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a><?=$pfetch["name"];?></a></li>
                                    <li><a href="index.php?sayfa=karakterler&id=<?=$pfetch["id"];?>&name=<?=$name;?>&gor=envanter"><i class="fa fa-warning"></i> Envanter</a></li>
                                </ul>
                                <div class="panel-body tab-content">
									
                        <div class="col-md-3">
                            
                            <div class="panel panel-default">
                                <div class="profile">
                                    <div class="img-circle">
                                        <img src="<?=WMadmintema;?>img/karakterler/<?=$pfetch["job"];?>.jpg" alt="<?=$pfetch["name"];?>"/>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name"><b><?=$pfetch["name"].' '.$pfetch["level"].' Lv.';?></b></div>
                                    </div>
                                </div>                                
                                <div class="panel-body list-group border-bottom">
                                    <a href="index.php?sayfa=kullanicilar&login=<?=$pfetch["login"];?>" target="_blank" class="list-group-item"><span class="fa fa-user"></span> Sahip : <?=$pfetch["login"];?></a>
                                    <a href="#" class="list-group-item"><span class="fa fa-crosshairs"></span> Beceri : <?=$inf->skill_group($pfetch["job"], $pfetch["skill_group"]);?></a>
                                    <a href="<?=(!$pfetch["guild_name"]) ? "javascript:;" : "index.php?sayfa=lonca&name=".$pfetch["guild_name"];?>" class="list-group-item"><span class="fa fa-group"></span> Lonca : <?=(!$pfetch["guild_name"]) ? " Yok" : $pfetch["guild_name"];?></a>
                                    <a href="#" class="list-group-item"><span class="fa fa-binoculars"></span> Konum : <?=$inf->WM_konum($pfetch["map_index"]);?></a>
                                    <a href="#" class="list-group-item"><span class="fa fa-bookmark"></span> Rütbe : <?=$inf->WM_rutbe($pfetch["alignment"]);?> </a>
                                    <a href="#" class="list-group-item"><span class="fa fa-clock-o"></span> Son Giriş : <?=WM_zaman_cevir($pfetch["last_play"]);?></a>
                                    <a href="#" class="list-group-item"><span class="fa fa-dashboard"></span> EXP : <?=$pfetch["exp"];?></a>
                                </div>
                            </div>                            
                            
                        </div>
									
									<div class="col-md-6">
									
											<center>
											<div class="btn-group btn-group-sm" style="margin-bottom:10px;">
                                                    <button class="btn btn-success">Güç : <?=$pfetch["st"];?> </button>
                                                    <button class="btn btn-danger">HP : <?=$pfetch["ht"];?> </button>                                                
                                                    <button class="btn btn-info">Savunma : <?=$pfetch["dx"];?> </button>                                        
                                                    <button class="btn btn-primary">Zeka : <?=$pfetch["iq"];?> </button>                                        
                                                </div>	</center>
												
									 <div class="progress">
                                        <div class="progress-bar progress-bar-danger progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">HP : <?=$pfetch["hp"]." / ".$pfetch["hp"];?></div>
                                    </div>    
																				
									 <div class="progress">
                                        <div class="progress-bar progress-bar-info progress-bar-striped active"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">SP : <?=$pfetch["mp"]." / ".$pfetch["mp"];?></div>
                                    </div>

									<?php 
									if($evlilik->rowCount()){
										$evliler = $evlilik->fetchAll(PDO::FETCH_ASSOC);
										
										echo '
										<div class="col-md-4"><img style="width:35px; height:35px;" src="'.WMadmintema.'img/karakterler/'.$evliler[0]["job"].'.jpg"/> '.$evliler[0]["name"].'</div>
										<div class="col-md-4">Evlilik Puanı <br>'.$evliler[0]["love_point"].'<br>&nbsp;<i style="color : red;" class="fa fa-heart fa-4x"></i></div>
										<div class="col-md-4"><img style="width:35px; height:35px;" src="'.WMadmintema.'img/karakterler/'.$evliler[1]["job"].'.jpg"/> '.$evliler[1]["name"].'</div>
										';
										
									}
									?>
									
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												<?php
												if(!$pfetch["guild_name"]){
													$lbuton = " Lonca Ekle";
													?><h3 class="panel-title">Loncası Yok</h3><?php
												}else{
													$lbuton = " Lonca Değiş";
													?><h3 class="panel-title">Lonca : <?=$pfetch["guild_name"];?>  </h3> <p class="pull-right"> Rütbe : <?=$inf->grade($pfetch["id"], $pfetch["guild_id"], $pfetch["grade"]);?></p><?php
												}
												?>
												</div>
												<div class="panel-body">
													<code>Oyuncunun loncasını değiştirmek veya yeni bir loncaya kayıt ettirmek istiyorsanız aşağıdaki boş bırakılan kutucuğua lonca ismini giriniz.. 
													</code><br>   <br>   
													<?=$WMform->head("karakter_loncadegis");?>
													<?=$WMform->veri("loncaisim", "Loncanın ismini giriniz..", "text", "8");?>
													<?=$WMform->veri("pid", false, "hidden", false, 'value="'.$pfetch["id"].'"');?>
													<?=$WMform->buton(0, $lbuton, "info", "plus");?>
													<?=$WMform->footer();?>
												</div>
											</div>	
											
											
									<div class="panel panel-info">
												<div class="panel-heading ui-draggable-handle">
												Oyuncu İşlemleri
												</div>
												<div class="panel-body">
													<code>Oyuncuyu Transfer Et</code><br>
													<?=$WMform->head("karakter_islemleri");?>
													<?=$WMform->veri("kullanici", false, "text", "8", 'value="'.$pfetch["login"].'"');?>
													<?=$WMform->buton(1, "Transfer Et", "info", "refresh", $pfetch["login"].'--'.$pfetch["id"].'--'.$pfetch["name"]);?>
													<?=$WMform->footer();?>
													<hr><code>Oyuncunun Adını Değiştir</code><br>
													<?=$WMform->head("karakter_islemleri");?>
													<?=$WMform->veri("karakter", false, "text", "8", 'value="'.$pfetch["name"].'"');?>
													<?=$WMform->buton(2, "Ad Değiştir", "info", "edit", $pfetch["id"]);?>
													<?=$WMform->footer();?>
													<hr><code>Oyuncunun Levelini Değiştir</code><br>
													<?=$WMform->head("karakter_islemleri");?>
													<?=$WMform->veri("level", false, "text", "8", 'onkeyup="sayi_kontrol(this)" value="'.$pfetch["level"].'"');?>
													<?=$WMform->buton(3, "Level Değiştir", "info", "edit", $pfetch["name"].'--'.$pfetch["level"]);?>
													<?=$WMform->footer();?>
													<hr><code>Oyuncunun Sınıfını Değiştir</code><br>
													<?=$WMform->head("karakter_islemleri");?>
													<div class="form-group"><div class="col-md-8"><select name="job" class="form-control">
													<option value="0">Erkek Savaşçı</option>
													<option value="4">Kız Savaşçı</option>
													<option value="5">Erkek Ninja</option>
													<option value="1">Kız Ninja</option>
													<option value="2">Erkek Sura</option>
													<option value="6">Kız Sura</option>
													<option value="7">Erkek Şaman</option>
													<option value="3">Kız Şaman</option>
													</select></div></div>
													<?=$WMform->buton(4, "Sınıf Değiştir", "info", "edit", $pfetch["name"].'--'.$pfetch["job"]);?>
													<?=$WMform->footer();?>
													<hr><code>Oyuncunun Yang Değiştir (Mevcut Yang : <?=number_format($pfetch["gold"], 0, '.', '.');?>) Not : nokta kullanmayınız</code><br>
													
													<?=$WMform->head("karakter_islemleri");?>
													<?=$WMform->veri("yang", false, "text", "8", 'onkeyup="sayi_kontrol(this)" value="'.$pfetch["gold"].'"');?>
													<?=$WMform->buton(5, "Yang Değiştir", "info", "edit", $pfetch["name"].'--'.$pfetch["gold"]);?>
													<?=$WMform->footer();?>
												</div>
											</div>	
											
									</div>
									
                        <div class="col-md-3">
                            
                            <div class="panel panel-default">
                                <div class="panel-body list-group border-bottom">
                                    <a href="#" class="list-group-item active"><span class="fa fa-user"></span> Oyuncunun Arkadaşları</a>
									<?php
									$messenger = $odb->prepare("SELECT messenger_list.*, player.job FROM player.messenger_list INNER JOIN player.player ON player.name = messenger_list.companion WHERE account = ?");
									$messenger->execute(array($pfetch["name"]));
									foreach($messenger as $mrow){
										echo '<a href="#" class="list-group-item"> <img style="width:20px; height:20px;" src="'.WMadmintema.'img/karakterler/'.$mrow["job"].'.jpg" alt="'.$mrow["companion"].'"/> '.$mrow["companion"].'</a>';
									}
									?>
                                </div>
                            </div>                            
                            
                        </div>
									
									
																		
									

                                </div>
                            </div>                                         
                            <!-- END JUSTIFIED TABS -->
						

                            
                        </div>                        
                    </div>
                    
                    
                    <!-- START DASHBOARD CHART -->
                    
                </div>
