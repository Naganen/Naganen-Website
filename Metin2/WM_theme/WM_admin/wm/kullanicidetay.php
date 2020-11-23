<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-success">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?=WMadmintema;?>img/default-user.png" alt="User profile picture">

              <h3 class="profile-username text-center"><?=$kfetch["login"];?></h3>
			  

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Ejderha Parası : </b> <a class="pull-right"><?=$kfetch["coins"];?> EP</a>
                </li>
                <li class="list-group-item">
                  <b>Kayıt : </b> <a class="pull-right"><?=WM_zaman_cevir($kfetch["create_time"]);?></a>
                </li>
                <li class="list-group-item">
                  <b>Gerçek İsimi : </b> <a class="pull-right"><?=$kfetch["real_name"];?></a>
                </li>
                <li class="list-group-item">
                  <b>Mail Adresi : </b> <a class="pull-right"><?=$kfetch["email"];?></a>
                </li>
                <li class="list-group-item">
                  <b>Telefon Numarası : </b> <a class="pull-right"><?=$kfetch["phone1"];?></a>
                </li>
                <li class="list-group-item">
                  <b>IP Adresi : </b> <a class="pull-right"><?=$kfetch["web_ip"];?></a>
                </li>
                <li class="list-group-item">
                  <b>Sicil : </b> <a class="pull-right"><?php 
				  $sicil = $odb->prepare("SELECT source FROM ban_list WHERE account = ?"); 
										$sicil->execute(array($kfetch["id"]));
										if($kfetch["status"] == "block" OR $kfetch["status"] == "BLOCK") 
										{
												$statu = "<label class='label label-danger'> Banlı</label>";
										} 
										else
										{
											if($sicil)
											{
											if($sicil->rowCount())
											{
												
												$statu = "<label class='label label-danger'> Temiz Değil</label>";
												
											}
											else
											{
												
												$statu = "<label class='label label-success'> Temiz</label>";
												
											}
											
											}
											else
											{
												$statu = "<label class='label label-default'> Sistem Yok</label>";
											}
											
										}
										echo $statu;?></a>
                </li>
              </ul>

			  <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("b", $yetkiler))){ ?>
									<?=(($kfetch["status"] == "block" OR $kfetch["status"] == "BLOCK")) ? 
									'<a onClick="WM_click(\'ban&tur=OK&id='.$kfetch["id"].'\')" href="javascript:;" class="btn btn-success btn-block"><span class="fa fa-check"></span>Kullanıcının Ban Kaldır </a> ' : '<a onClick="WM_click(\'ban&tur=BLOCK&id='.$kfetch["id"].'\')" href="javascript:;" class="btn btn-danger btn-block"><span class="fa fa-ban"></span> Kullanıcıyı Banla </a>  ';?>
							<?php } ?>
			  
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Karakterleri</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			
<div class="list-group">

									<?php
									$karakter = $odb->prepare("SELECT name,level,job FROM player.player WHERE account_id = ?");
									$karakter->execute(array($kfetch["id"]));
									foreach($karakter as $krow){
										echo '
                                            <a href="index.php?sayfa=karakterler&name='.$krow["name"].'" target="_blank" class="list-group-item">
                                                <img style="width:20px; height:20px;" src="'.WMadmintema.'img/karakterler/'.$krow["job"].'.jpg"/>
                                                '.$krow["name"].$krow["level"].' Lv.
                                            </a>                                            
                                        ';
									}
									?>


</div>



            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
					
                        <div class="col-md-9">
						
                            <!-- START JUSTIFIED TABS -->
                            <div class="panel panel-default tabs">
                                <ul class="nav nav-tabs nav-justified">
                                    <li class="active"><a href="#itemekle" data-toggle="tab"><?=$kfetch["login"];?></a></li>
                                    <li><a href="#nesnemarket" data-toggle="tab"><i class="fa fa-warning"></i> Nesne Market Deposu</a></li>
                                    <li><a href="#depo" data-toggle="tab"><i class="fa fa-warning"></i> Oyun Deposu</a></li>
                                </ul>
                                <div class="panel-body tab-content">
                                    <div class="tab-pane active" id="itemekle">
									
															
						<div class="col-md-12">
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Ep Arttırma - Azaltma işlemleri
												</div>
												<div class="panel-body">
													<code><strong><i class="fa fa-warning"></i> Bilgi ! </strong> Ep arttırmak istiyorsanız örnek : 25 azaltmak istiyorsanız örnek : -25 yazınız..
													</code><br>   <br>   
							<?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("c", $yetkiler))){ ?>
						<?=$WMform->head("eparttir");?>
						<?=$WMform->veri("epmiktar", "Yüklemek veya azaltmak istediğiniz ep miktarını giriniz..", "text", "10");?>
						<?$WMform->buton(5, "Gönder", "success", "arrow-right", $kfetch["id"]);?>
						<?=$WMform->footer();?>
							<?php } ?>
												</div>
											</div>	
											
											
									<div class="panel panel-success">
												<div class="panel-heading ui-draggable-handle">
												Kullanıcı Şifre Değiştirme İşlemleri
												</div>
												<div class="panel-body">
													<code><strong><i class="fa fa-warning"></i> Bilgi ! </strong> Rastgele tıklanınca buraya değer girilmek zorunda kalınmaz.
													</code><br>   <br>   
						<?=$WMform->head("kullanici_sifre_degis");?>
						<?=$WMform->veri("sifre", "Değiştirmek istediğiniz şifreyi giriniz", "password", false);?>
						<?$WMform->buton(1, "Yeni Şifresini Kaydet", "success pull-right", "save", $kfetch["id"]);?>
						<?$WMform->buton(2, "Şifre değiştir ve mail gönder", "warning pull-right", "envelope-o", $kfetch["id"]);?>
						<?$WMform->buton(3, "Rastgele Şifre Koy", "default pull-right", "save", $kfetch["id"]);?>
						<?$WMform->buton(4, "Rastgele Şifre Koy ve mail gönder", "info pull-right", "envelope-o", $kfetch["id"]);?>
						<?=$WMform->footer();?>
												</div>
											</div>	
											
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Kullanıcı Adı Değiştirme
												</div>
												<div class="panel-body">
													<code><strong><i class="fa fa-warning"></i> Bilgi ! </strong> Girceğiniz kullanıcı adını başka biri kullanmıyor olmalıdır. !
													</code><br>   <br>   
						<?=$WMform->head("kullanici_sifre_degis");?>
						<?=$WMform->veri("kullanici", "Değiştirmek istediğiniz kullanıcı adını yazınız.", "text", "10");?>
						<?$WMform->buton(9, "Değiştir", "danger", "refresh", $kfetch["login"]);?>
						<?=$WMform->footer();?>
												</div>
											</div>

<?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("s", $yetkiler))){ ?>
											
<div class="panel panel-info">
<div class="panel-heading ui-draggable-handle">
Marketten Aldıkları
</div>
<div class="panel-body">

<?php 

$kontrol = $db->prepare("SELECT * FROM market_log WHERE sid = ? && karakter = ? ORDER BY id DESC");
$kontrol->execute(array($_SESSION["server"], $kfetch["login"]));

if($kontrol->rowCount())
{

?>

<table class="table" id="karaktersirala">
<thead>
<tr>
<th>Alınan İtem</th>
<th>Fiyat</th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>

<?php foreach($kontrol as $log){ ?>

<tr>
<td>Alınan İtem : <font color="lightgreen">  <?=$log["alinan"];?> </font></td>
<td>Fiyat: <font color="red">  <?=$log["fiyat"];?> EP </font></td>
<td><i class="fa fa-clock-o"></i> <?=WM_zaman_cevir($log["tarih"]);?> </font></td>
<?php if($log["tur"] == 2){ ?><td><a target="_blank" href="index.php?sayfa=market_log&id=<?=$log["id"];?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Efsunları Gör</a></td><?php }else { echo "<td></td>";} ?>
</tr>

<?php } ?>

</tbody>

</table>

<?php }
else
{
	
echo '<div class="alert alert-danger"> Marketten hiç item almamış</div>';
	
} 

?>




												
</div>
</div>	

<?php } ?>


<?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("r", $yetkiler))){ ?>

<div class="panel panel-danger">
<div class="panel-heading ui-draggable-handle">
Açtığı Destek Talepleri
</div>
<div class="panel-body">

<?php 

$kontrol2 = $db->prepare("SELECT destek.*, destek_kategori.isim AS kategori FROM destek LEFT JOIN destek_kategori ON destek.kid = destek_kategori.id 
WHERE (destek.sid = ? && destek_kategori.sid = ? && acan = ?) ORDER BY destek.id DESC");
$kontrol2->execute(array($_SESSION["server"], $_SESSION["server"], $kfetch["login"]));

if($kontrol->rowCount())
{

?>

<table class="table" id="karaktersirala2">
<thead>
<tr>
<th>Konu</th>
<th>Destek Departmanı</th>
<th>Durum</th>
<th></th>
</tr>
</thead>
<tbody>

<?php foreach($kontrol2 as $row){ ?>

<tr id="destek-<?=$row["id"];?>">
<td><?=$WMinf->kisalt($row["konu"], 25);?></td>
<td><?=$row["kategori"];?></td>
<td><?=$WMinf->destek_durum($row["durum"]);?></td>
<td WIDTH=130>
<a class="btn btn-success" href="index.php?sayfa=Teknik_destek&tid=<?=$row["id"];?>" target="_blank"><i class="fa fa-eye"></i></a>
<a onclick="WM_sil('teknik_destek_sil&tid=<?=$row["id"];?>&sid=<?=$_SESSION["server"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
</td>
</tr>

<?php } ?>

</tbody>

</table>

<?php }
else
{
	
echo '<div class="alert alert-danger"> Destek talebi açmamış.</div>';
	
} 

?>




												
</div>
</div>	
			
<?php } ?>
			


						</div>

									
                                    </div>
									
									
                                    <div class="tab-pane" id="nesnemarket">
																		
									
									<div class="col-md-3">
	
	
											<div id="nesnewrap">
											<div id="nesnecontent">
											<div id="nesneequip_show"></div>
											<!--INVENTAR START-->
											<?php include('WMplugin/WM_nesne_market/lib/inventar.php'); ?>
											<?=WM_nesne_market($kfetch["id"]);?>
											<!--INVENTAR END-->
											</div>
											</div>
														</div>
														
									<div class="col-md-9">
									
									 <table class="table datatable_simple">
                                        <thead>
                                            <tr>
                                                <th>#</th>
												<th>İtem İsimi</th>
												<th>İşlemler</th>
                                            </tr>
                                        </thead>
										<tbody>
									<?php
									$i = 0;
									$nesnequery = $odb->prepare("SELECT vnum,id,count FROM player.item WHERE owner_id = ? && window = ? ORDER BY pos");
									$nesnequery->execute(array($kfetch["id"], 'MALL'));
									foreach($nesnequery as $nesnerow){
										$i++;
										echo '<tr id="item-'.$nesnerow["id"].'">
										<td WIDTH=10>'.$i.'</td>
										<td>'.$WMadmin->item_bul($nesnerow["vnum"]).' [ '.$nesnerow["count"].'X ]</td>
										<td WIDTH=190>
										<a target="_blank" href="index.php?sayfa=item_detay&id='.$nesnerow["id"].'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Gör</a>
										<a  onClick="WM_sil(\'itemsil&id='.$nesnerow["id"].'\')" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Sil</a></td>
										</tr>
										';
									}
									
									?>
									</tbody>
									
									</table>
																		
									</div>
														
														
                                    </div>
									

                                    <div class="tab-pane" id="depo">
																		
									
									<div class="col-md-3">
	
											<div id="depowrap">
											<div id="depocontent">
											<div id="depoequip_show"></div>
											<!--INVENTAR START-->
											<?php include('WMplugin/WM_depo/lib/inventar.php'); ?>
											<?=WM_depo($kfetch["id"]);?>
											<!--INVENTAR END-->
											</div>
											</div>
														</div>
														
									<div class="col-md-9">
									
									 <table class="table datatable_simple">
                                        <thead>
                                            <tr>
                                                <th>#</th>
												<th>İtem İsimi</th>
												<th>İşlemler</th>
                                            </tr>
                                        </thead>
										<tbody>
									<?php
									$i = 0;
									$nesnequery = $odb->prepare("SELECT vnum,id,count FROM player.item WHERE owner_id = ? && window = ? ORDER BY pos");
									$nesnequery->execute(array($kfetch["id"], 'SAFEBOX'));
									foreach($nesnequery as $nesnerow){
										$i++;
										echo '<tr id="item-'.$nesnerow["id"].'">
										<td WIDTH=10>'.$i.'</td>
										<td>'.$WMadmin->item_bul($nesnerow["vnum"]).' [ '.$nesnerow["count"].'X ]</td>
										<td WIDTH=190>
										<a target="_blank" href="index.php?sayfa=item_detay&id='.$nesnerow["id"].'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i> Gör</a>
										<a  onClick="WM_sil(\'itemsil&id='.$nesnerow["id"].'\')" href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Sil</a></td>
										</tr>
										';
									}
									
									?>
									</tbody>
									
									</table>
									
									</div>
														
														
                                    </div>
                                </div>
                            </div>                                         
                            <!-- END JUSTIFIED TABS -->
						

                            
                        </div>                        
                    </div>
                    
                    
                    <!-- START DASHBOARD CHART -->
                    
                </div>
		
									<script type="text/javascript" src="<?=WM_admin_plugin.'WM_envanter_ortak/nesne_market/js/functions.js'?>"></script>
									<script type="text/javascript" src="<?=WM_admin_plugin.'WM_envanter_ortak/depo/js/functions.js'?>"></script>

