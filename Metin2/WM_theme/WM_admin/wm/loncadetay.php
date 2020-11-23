 <?php
 $uyeler = $odb->prepare("SELECT guild_member.*, guild_grade.name AS yetki, player.name, player.id AS playerid, player.job FROM player.guild_member INNER JOIN player.guild_grade ON guild_member.grade = guild_grade.grade && guild_member.guild_id = guild_grade.guild_id INNER JOIN player.player ON player.id = guild_member.pid WHERE guild_member.guild_id = ? GROUP BY guild_member.pid");
 
 $uyeler->execute(array($lfetch["id"]));
 
 ?>
 
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
                            <!-- START JUSTIFIED TABS -->
                            <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#itemekle" data-toggle="tab"><?=$lfetch["name"];?></a></li>
                                    <li><a href="#konusmalar" data-toggle="tab"><i class="fa fa-comments"></i> Lonca Konuşmaları</a></li>
                                    <li><a href="#savaslar" data-toggle="tab"><i class="fa fa-rebel"></i> Lonca Savaşları</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="itemekle">
									
																		
									<div class="col-md-6">
									
									<div class="col-md-12" align="center">
									

									<div class="btn-group" style="margin-bottom:10px; margin-left:15px;">
													<h5 align="center"><b><i class="fa fa-info-circle"></i> Lonca Bilgileri</b></h5>
                                                    <button class="btn btn-default"><i class="fa fa-bookmark"></i> Level : <?=$lfetch["level"];?>  </button>
                                                    <button class="btn btn-default"><i class="fa fa-industry"></i> Puan : <?=$lfetch["ladder_point"];?>  </button>
                                                    <button class="btn btn-default"><i class="fa fa-crosshairs"></i> Beceri :  <?=$lfetch["skill_point"];?> </button>
                                                </div>
												
										<br><br><br>
																								
									<div class="btn-group" style="margin-bottom:25px;">
													<h5 align="center"><b><i class="fa fa-trophy"></i> Savaş İstatistikleri</b></h5>
                                                    <button class="btn btn-success"><i class="fa fa-child"></i> Kazanılan : <?=$lfetch["win"];?>  </button>
                                                    <button class="btn btn-danger"><i class="fa fa-close"></i> Kaybedilen : <?=$lfetch["loss"];?>  </button>
                                                    <button class="btn btn-warning"><i class="fa fa-hourglass-half"></i> Berabere :  <?=$lfetch["draw"];?> </button>
                                                </div>
												
											<div class="col-md-12">
											<a onclick="WM_sil('lonca_dagit&gid=<?=$lfetch["id"]?>')" class="btn btn-danger "><i class="fa fa-trash"></i> Loncayı Dağıt </a></div>
 
									</div>
									
										<div class="col-md-2"></div>
										<div class="col-md-9">
													<?=$WMform->head("lonca_yeni_isim");?>
													<?=$WMform->veri("yenilonca", "Loncanın Yeni İsmini Giriniz.", "text", "8");?>
													<?=$WMform->veri("gid", false, "hidden", false, 'value="'.$lfetch["id"].'"');?>
													<?=$WMform->buton(0, "Değiş", "info", "refresh");?>
													<?=$WMform->footer();?>
													<?=$WMform->head("lonca_lider_degis");?>
													<?=$WMform->veri("baskanisim", "Yeni Lonca Başkanının İsmini Giriniz", "text", "8");?>
													<?=$WMform->veri("gid", false, "hidden", false, 'value="'.$lfetch["id"].'"');?>
													<?=$WMform->buton(1, "Değiş", "info", "refresh");?>
													<?=$WMform->footer();?>
													<?=$WMform->head("lonca_uye_ekle");?>
													<?=$WMform->veri("uyeisim", "Loncaya Eklencek Yeni Üyenin İsmi", "text", "8");?>
													<?=$WMform->veri("gid", false, "hidden", false, 'value="'.$lfetch["id"].'"');?>
													<?=$WMform->buton(2, "Ekle &nbsp;", "danger", "plus");?>
													<?=$WMform->footer();?>

										</div>	
									</div>
									
                        <div class="col-md-6">
						
						
						<center><a href="index.php?sayfa=karakterler&name=<?=$lfetch["baskan"];?>" target="_blank" class="btn btn-default" style="margin-bottom:10px;"><i class="fa fa-bookmark"></i> Lonca Lideri <img style="width:15px; height:15px;" src="<?=WMadmintema?>img/karakterler/<?=$lfetch["job"];?>.jpg"/> <?=$lfetch["baskan"];?> </a></center>
						
						
						<?php
								foreach($uyeler as $urow){
									?>
									<div class="col-md-6">
											<div class="btn-group" style="margin-bottom:10px;">
                                                    <a href="index.php?sayfa=karakterler&name=<?=$urow["name"];?>" target="_blank" style="width:150px;" class="btn btn-default"><i class="fa fa-bookmark"></i> <?=$urow["yetki"];?> <br> <img style="width:15px; height:15px;" src="<?=WMadmintema?>img/karakterler/<?=$urow["job"];?>.jpg"/> <?=$urow["name"];?></a>
                                                    <a class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="fa fa-refresh"></span>&nbsp;<br><span class="fa fa-cog"></span>&nbsp;</a>
                                                    <ul class="dropdown-menu" role="menu">
													<?=$inf->guild_grade($lfetch["id"], $urow["playerid"]);?>
                                                    </ul>
                                                </div>								
																					
													</div>
													<?php
								}
						?>
                            
                            
                        </div>
									
									
                        <div class="col-md-3">
                            
                            
                        </div>
									
                                    </div>
									
									
                                    <div class="tab-pane" id="konusmalar">
									
                                    <table class="table" id="karaktersirala">
                                        <thead>
                                            <tr>
                                                <th></th>
												<th>Yazan Karakter</th>
												<th>Yazılan</th>
												<th>Tarih</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$comment = $odb->prepare("SELECT * FROM player.guild_comment WHERE guild_id = ?");
											$comment->execute(array($lfetch["id"]));
											$i = 0;
											foreach($comment as $yorum){
												$i++;
												echo '<tr>
												<td WIDTH=15>#'.$i.'</td>
												<td>'.$yorum["name"].'</td>
												<td>'.$yorum["content"].'</td>
												<td>'.WM_zaman_cevir($yorum["time"]).'</td>
												</tr>';
											}
											?>
                                        </tbody>
                                    </table>
																		
														
                                    </div>
									
									
									
                                    <div class="tab-pane" id="savaslar">
									
<?php
$savas_kontrol = $odb->prepare("SELECT * FROM player.guild_war_reservation WHERE guild1= ? or guild2= ? ORDER BY time DESC");
$savas_kontrol->execute(array($lfetch["id"], $lfetch["id"]));

function savas_durum($result1, $result2)
{

if($result1 == $result2){ return 'Berabere'; }
else if($result1 > $result2){ return 'Davet Eden Kazandı'; }
else if($result2 > $result1){ return 'Davet Edilen Kazandı'; }
else { return 'Sonuçlanmadı'; }

}

function lonca($id, $deger = "name")
{
global $odb;

$query = $odb->prepare("SELECT $deger FROM player.guild WHERE id = ?");
$query->execute(array($id));
$query = $query->fetch();

return $query[$deger];

}

?>
<table class="table" id="karaktersirala2">
	<thead>
  <tr>
    <th>#</th>
    <th>D.E.L - T.Ö</th>
    <th>H.L - T.Ö</th>
    <th>Sonuç</th>
    <th>Kazanan</th>
    <th>Tarih</th>
  </tr>
  </thead>

  <tbody>
	  
    <?php $i = 0; foreach($savas_kontrol as $ls){  $i++; ?>
    <tr>
      <td><?=$i;?></td>
      <td><a href="index.php?sayfa=lonca&name=<?=lonca($ls["guild1"]);?>"><?=lonca($ls["guild1"]);?></a></td>
      <td><a href="index.php?sayfa=lonca&name=<?=lonca($ls["guild2"]);?>"><?=lonca($ls["guild2"]);?></a></td>
      <td><?=savas_durum($ls["result1"], $ls["result2"]);?></td>
      <td><a href="index.php?sayfa=lonca&name=<?=lonca($ls["winner"]);?>"><?=lonca($ls["winner"]);?></a></td>
      <td><?= $WMinf->tarih_format('j F Y , l,  H:i:s', $ls["time"]);  ?></td>
    </tr>
	<?php } ?>
																		
														
                                    </div>
									
									

                                </div>
                            </div>                                         
                            <!-- END JUSTIFIED TABS -->
						

                            
                        </div>                        
                    </div>
                    
                    
                    <!-- START DASHBOARD CHART -->
                    
                </div>
