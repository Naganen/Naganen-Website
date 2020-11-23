<?php $query = $odb->query("Select davet FROM account LIMIT 1"); 
if($query)
{
?>
               <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    
                    <div class="row">
					
<div class="col-md-12">
<div class="panel panel-warning">
<div class="panel-heading ui-draggable-handle">
Arkadaş Davet Etme
</div>
<div class="panel-body">
<?php
if($WMadmin->serverbilgi("davet_durum") == 1){$dvton = 1; $dvtoff = false;}else{$dvton = false; $dvtoff = 1;}
?>
<?$WMform->head("site_ayarlari_2");?>
<?$WMform->check("davet_durum", 1, " Arkadaş davet etme açık", $dvton, 1);?>
<?$WMform->check("davet_durum", 2, " Arkadaş davet etme pasif", $dvtoff, 1);?>
<?$WMform->buton(9, "Kayıt Et", "info", "save");?>
<?$WMform->footer();?>
</div>
</div>
</div>  
					
					<div class="col-md-4">
												
					
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Davet İle Kayıt Olmuş Son 10 Kullanıcı</h4>
									
                                     <table class="table table-actions table-striped">
                                     <thead>                                            
                                     <tr>
                                     <th WIDTH=3%>#</th>
                                     <th WIDTH=40%>Kayıt Olan</th>
                                     <th WIDTH=30%>Davet Eden</th>
                                     </tr>
                                     </thead>
                                     <tbody>
									 <?php 
									 $davetile = $odb->query("SELECT account.login, account.securitycode FROM account.account WHERE account.securitycode != '' LIMIT 10");
									 $say = 0; foreach($davetile as $davet){ $say++; 
									 $davet_eden = $odb->query("SELECT login FROM account WHERE davet = '".$davet["securitycode"]."'")->fetch(PDO::FETCH_ASSOC);
									 ?>
									<tr>
									<td><?=$say;?></td>
									<td><a href="index.php?sayfa=kullanicilar&login=<?=$davet["login"];?>" target="_blank"><?=$davet["login"];?></a></td>
									<td><a href="index.php?sayfa=kullanicilar&login=<?=$davet_eden["login"];?>" target="_blank"><?=(!$davet_eden["login"]) ? "Belli Değil" : $davet_eden["login"];?></a></td>
									</tr>
									 <?php } ?>
									</tbody>
									</table>
									
									
                                </div>
                            </div>
							
					
					</div>
												
							<div class="col-md-4">	
							
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Davet Sistem Ayarları</h4>
								<?php 
								$bol = explode(",", $WMadmin->serverbilgi("davet_ep"));

								$bol_kac = count($bol);

								if($bol_kac != 2)
								{
									
								$bol[0] = 1;

								$bol[1] = 5;
									
								}
								else if(!ctype_digit($bol[0]) || !$bol[0])
								{
									
								$bol[0] = 1;
									
								}
								else if(!ctype_digit($bol[1]) || !$bol[1])
								{
									
								$bol[1] = 5;
									
								}
								?>	
									
								<?=$WMform->head("sistem_davet");?>
								<?=$WMform->veri("davet_level", false, "text", false, 'onkeyup="sayi_kontrol(this)" value="'.$WMadmin->serverbilgi("davet_level").'"', 'Kaç Level Olunduğunda Hediye Alınsın');?>
								<?=$WMform->veri("kac_karakter", false, "text", false, 'value="'.$bol[0].'" onkeyup="sayi_kontrol(this)"', 'Kaç Karakterde Hediye Verilsin');?>
								<?=$WMform->veri("kac_ep", false, "text", false, 'value="'.$bol[1].'" onkeyup="sayi_kontrol(this)"', 'Tamamlandığında Kaç Ep Versin');?>
								<?=$WMform->buton(1, " Ayarları Kaydet", "default btn-block pull-right", "save");?>
								<?=$WMform->footer();?>
                                </div>
                            </div>
							
							
                            <div class="panel panel-default">
                                <div class="panel-body">
								<h4>Hediye Sorgula</h4>
								Kullancı sorgusu için başına 1 karakter sorgusu için başına 2 yazın <br> Örnek : 1webmeric <br><br>
								<?=$WMform->head("sistem_davet");?>
								<?=$WMform->veri("sorgulancak", "Sorgulancak ismi giriniz", "text", false);?>
								<?=$WMform->buton(2, " Hediye Sorgula", "info btn-block pull-right", "search");?>
								<?=$WMform->footer();?>
                                </div>
                            </div>
							
							
							
                            <div class="panel panel-default">
                                <div class="panel-body">
								Arkadaş Davet Sistem Yapımcısı : <b>Webmeric © 2013-2016</b>
                                </div>
                            </div>
							
					
					</div>
					
					<?php 
					
					@$isim = $WMkontrol->WM_get($WMkontrol->WM_html($WMkontrol->WM_eng($_GET["isim"])));
					
					@$tur = $WMkontrol->WM_get($WMkontrol->WM_html($WMkontrol->WM_toint($_GET["tur"])));
						
					if($isim != '' && $tur != '')
					{
						
					
					if($tur == 1)
					{
						
					$turr = "Kullanıcı";
						
					$kontrol = $odb->query("SELECT login FROM account WHERE login = '$isim'");
						
					}
					else if($tur == 2)
					{
						
					$turr = "Karakter";
						
					$kontrol = $odb->query("SELECT name FROM player.player WHERE name = '$isim'");
						
					}
					if($kontrol->rowCount())
					{
											
					if($WMadmin->uye(false,$tur.$isim, "davet") == "")
					{
						
					$davet_kodu = "davet_kodu_yok";
						
					}
					else
					{
						
					$davet_kodu = $WMadmin->uye(false,$tur.$isim, "davet");
						
					}
					
					$Kayitli = $odb->query("SELECT account.securitycode, account.login FROM account.account WHERE account.securitycode = '$davet_kodu'");
					
					$Kayitli_basari = $odb->query("SELECT account.securitycode, account.login, account.id, player.id AS playerid, player.name FROM account.account INNER JOIN player.player ON account.id = player.account_id WHERE account.securitycode = '$davet_kodu'
					&& player.level >= '".$WMadmin->serverbilgi("davet_level")."' && player.dvt = '1'
					GROUP BY player.id");
					
					$hediyesi_alinmis = $odb->query("SELECT account.securitycode, account.login, account.id, player.id AS playerid, player.name FROM account.account INNER JOIN player.player ON account.id = player.account_id WHERE account.securitycode = '$davet_kodu'
					&& player.level >= '".$WMadmin->serverbilgi("davet_level")."' && player.dvt = '2'
					GROUP BY player.id");
					
					$hediye_topla = floor($Kayitli_basari->rowCount() / $bol[0]);
											
					$hediye_toplam = $hediye_topla * $bol[1];
					
					$alinmis_hediyele = floor($hediyesi_alinmis->rowCount() / $bol[0]);
										
					$alinmis_hediyeler = $alinmis_hediyele * $bol[1];
						
					?>
					
							<div class="col-md-4">					
                            <div class="panel panel-default">
                                <div class="panel-body">
								<h4><?=$isim;?> Adlı <?=$turr;?> </h4>
								<p>Kayıt Ettirdiği Kullanıcı : <b><?=$Kayitli->rowCount();?></b></p>
								<p><?=$WMadmin->serverbilgi("davet_level");?>  Level Olan Karakter : <b><?=$Kayitli_basari->rowCount();?></b></p>
								<p>Hediyesi Alınmış Karakterler <b><?=$hediyesi_alinmis->rowCount();?></b></p>
								<p>Alınabilir Hediye <b><?=$hediye_toplam;?> EP </b></p>
								<p>Alınmış Hediyeler <b><?=$alinmis_hediyeler;?> EP </b></p>
                                </div>
                            </div>							
					
					
					<?php if($Kayitli->rowCount()){ ?>
					
                            <div class="panel panel-default">
                                <div class="panel-body">
								<h4>Davet Edilen Kullanıcılar </h4>
                                     <table class="table table-actions table-striped">
                                     <thead>                                            
                                     <tr>
                                     <th WIDTH=3%>#</th>
                                     <th WIDTH=40%>Kayıt Olan</th>
                                     <th WIDTH=30%>Davet Eden</th>
                                     </tr>
                                     </thead>
                                     <tbody>
									 <?php 
									 $say = 0; foreach($Kayitli as $kayit){ $say++; 
									 ?>
									<tr>
									<td><?=$say;?></td>
									<td><a href="index.php?sayfa=kullanicilar&login=<?=$kayit["login"];?>" target="_blank"><?=$kayit["login"];?></a></td>
									<td><?=$isim;?></td>
									</tr>
									 <?php } ?>
									</tbody>
									</table>
                                </div>
                            </div>	
							
					<?php } if($Kayitli_basari->rowCount()){ ?>
					
                            <div class="panel panel-default">
                                <div class="panel-body">
								<h4><?=$WMadmin->serverbilgi("davet_level");?> Level Olan Karakterler </h4>
                                     <table class="table table-actions table-striped">
                                     <thead>                                            
                                     <tr>
                                     <th WIDTH=3%>#</th>
                                     <th WIDTH=40%><?=$WMadmin->serverbilgi("davet_level");?> Level Olan</th>
                                     <th WIDTH=30%>Sahibi</th>
                                     </tr>
                                     </thead>
                                     <tbody>
									 <?php 
									 $say = 0; foreach($Kayitli_basari as $kayit_basari){ $say++; 
									 ?>
									<tr>
									<td><?=$say;?></td>
									<td><a href="index.php?sayfa=karakterler&name=<?=$kayit_basari["login"];?>" target="_blank"><?=$kayit_basari["name"];?></a></td>
									<td><a href="index.php?sayfa=kullanicilar&login=<?=$kayit_basari["login"];?>" target="_blank"><?=$kayit_basari["login"];?></a></td>
									</tr>
									 <?php } ?>
									</tbody>
									</table>
                                </div>
                            </div>	
							
					
					<?php } if($hediyesi_alinmis->rowCount()){ ?>
					
                            <div class="panel panel-default">
                                <div class="panel-body">
								<h4>Hediyesi Alınan Karakterler </h4>
                                     <table class="table table-actions table-striped">
                                     <thead>                                            
                                     <tr>
                                     <th WIDTH=3%>#</th>
                                     <th WIDTH=40%><?=$WMadmin->serverbilgi("davet_level");?> Level Olan</th>
                                     <th WIDTH=30%>Sahibi</th>
                                     </tr>
                                     </thead>
                                     <tbody>
									 <?php 
									 $say = 0; foreach($hediyesi_alinmis as $hediye_alindi){ $say++; 
									 ?>
									<tr>
									<td><?=$say;?></td>
									<td><a href="index.php?sayfa=karakterler&name=<?=$hediye_alindi["login"];?>" target="_blank"><?=$hediye_alindi["name"];?></a></td>
									<td><a href="index.php?sayfa=kullanicilar&login=<?=$hediye_alindi["login"];?>" target="_blank"><?=$hediye_alindi["login"];?></a></td>
									</tr>
									 <?php } ?>
									</tbody>
									</table>
                                </div>
                            </div>	
					
					<?php } ?>

					</div>
					

					<?php
						
						
					}
					
					}
					
					
					?>
					
                    </div>
                    
                    
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
<?php }else{ $WMadmin->yonlendir("index.php?sayfa=sistem_kur"); } ?>
