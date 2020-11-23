<div class="body-content animated fadeIn">
                    
                    <!-- START WIDGETS -->                    
                    <div class="row">
					
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-gray">
            <div class="inner">
              <h3><?=kullanici("tum");?></h3>

              <p>Toplam Üye</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="index.php?sayfa=kullanicilar" class="small-box-footer" target="_blank">Kullanıcıları Görün <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>		

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-gray">
            <div class="inner">
              <h3><?=kullanici("ban");?></h3>

              <p>Banlı Üye</p>
            </div>
            <div class="icon">
              <i class="fa fa-ban"></i>
            </div>
            <a href="index.php?sayfa=banliuyeler" class="small-box-footer" target="_blank">Banlı Üyeleri Görün <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>		


<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-gray">
            <div class="inner">
              <h3><?=kullanici("bangelmis");?></h3>

              <p>Ban Kalkma Süresi Gelmiş Üye</p>
            </div>
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>
            <a href="index.php?sayfa=bankalkicak" class="small-box-footer" target="_blank">Banı Kalkıcak Üyeler <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>		


<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-gray">
            <div class="inner">
              <h3><?=kullanici("lonca");?></h3>

              <p>Lonca</p>
            </div>
            <div class="icon">
              <i class="fa fa-group"></i>
            </div>
            <a href="index.php?sayfa=lonca" class="small-box-footer" target="_blank">Loncaları Görün <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>					
		
						
												
                    </div>
					
							<?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("r", $yetkiler))){ ?>
					
                    <div class="row">
					
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=destek("tum");?></h3>

              <p>Destek Talebi</p>
            </div>
            <div class="icon">
              <i class="fa fa-ticket"></i>
            </div>
            <a href="index.php?sayfa=Teknik_destek" class="small-box-footer" target="_blank">Destek Talepleri <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>					
		
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=destek("bekleyen");?></h3>

              <p>Cevap Bekleyen Destek Talebi</p>
            </div>
            <div class="icon">
              <i class="fa fa-support"></i>
            </div>
            <a href="index.php?sayfa=Teknik_destek&tur=cevap_bekleyen" class="small-box-footer" target="_blank">Cevap Bekleyenler <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>					
					
					
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=destek("departman");?></h3>

              <p>Destek Departmanı</p>
            </div>
            <div class="icon">
              <i class="fa fa-list"></i>
            </div>
            <a href="index.php?sayfa=destek_kategori" class="small-box-footer" target="_blank">Destek Departmanları <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>			

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=destek("departman");?></h3>

              <p>Ödeme Onaylı Talepler</p>
            </div>
            <div class="icon">
              <i class="fa fa-check"></i>
            </div>
            <a href="index.php?sayfa=Teknik_destek&tur=odeme_onayli" class="small-box-footer" target="_blank">Onaylanmış Talepler <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>					
					
						
						
						
                    </div>
                    <!-- END WIDGETS -->  

							<?php } ?>
							
							<?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("s", $yetkiler))){ ?>


                    <!-- START WIDGETS -->                    
                    <div class="row">
					
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=market("itemler");?></h3>

              <p>Market İtemleri</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="index.php?sayfa=market_item" class="small-box-footer" target="_blank">Market İtemleri Gör <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>		

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=market("alinan");?></h3>

              <p>Marketten Alınanlar</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-basket"></i>
            </div>
            <a href="index.php?sayfa=market_log" class="small-box-footer" target="_blank">Marketten Alınanları Gör <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>					
		
		
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=market("kategori");?></h3>

              <p>Market Kategori</p>
            </div>
            <div class="icon">
              <i class="fa fa-list"></i>
            </div>
            <a href="index.php?sayfa=market_kategori" class="small-box-footer" target="_blank">Market Kategorileri Gör <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>					
		
					
		
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=market("efsunlar");?></h3>

              <p>Market Efsunu</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-bag"></i>
            </div>
            <a href="index.php?sayfa=market_efsun" class="small-box-footer" target="_blank">Market Efsunları Gör <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>					
		
						
                    </div>
                    <!-- END WIDGETS -->     

							<?php } ?>
               
			   
                    <div class="row">
					
                        <div class="col-md-4">
                            
<ul class="list-group">
  <li class="list-group-item">Toplam Savaçı Karakter : <?=karakter("savasci");?></li>
  <li class="list-group-item">Toplam Ninja Karakter : <?=karakter("ninja");?></li>
  <li class="list-group-item">Toplam Sura Karakter : <?=karakter("sura");?></li>
  <li class="list-group-item">Toplam Şaman Karakter : <?=karakter("saman");?></li>
</ul>
                            
                        </div>
					
						<div class="col-md-4">
                            
                            <!-- START PROJECTS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        En Son Kayıt Olan 5 Kullanıcı 
                                    </div>                                    
                                </div>
                                <div class="panel-body panel-body-table">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="50%">Kullanıcı Adı</th>
                                                    <th width="30%">Tarih </th>
                                                   <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("a", $yetkiler))){ ?> <th width="20%"></th><?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
									$kullanicilar = $odb->prepare("SELECT login,create_time FROM account ORDER BY create_time DESC LIMIT 5");
									$kullanicilar->execute();
									foreach($kullanicilar as $kullanici){
											?>
                                                <tr>
											<td><?=$kullanici["login"];?></td>
                                                    <td><?=WM_zaman_cevir($kullanici["create_time"]);?></td>
                                             <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("a", $yetkiler))){ ?>       <td>
<a class="btn btn-info" href="index.php?sayfa=kullanicilar&login=<?=$kullanici["login"];?>" target="_blank"><i class="fa fa-eye"></i></a>
                                                    </td><?php } ?>
                                                </tr>
									<?php } ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- END PROJECTS BLOCK -->
                            
                        </div>

						<div class="col-md-4">
                            
                            <!-- START PROJECTS BLOCK -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="panel-title-box">
                                        En yüksek levelli 5 karakter
                                    </div>                                    
                                </div>
                                <div class="panel-body panel-body-table">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="50%">Karakter Adı</th>
                                                    <th width="30%">Level</th>
                                                   <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("d", $yetkiler))){ ?> <th width="20%"></th><?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
											<?php 
									$karakterler = $odb->prepare("SELECT name,level,job FROM player.player ORDER BY level DESC LIMIT 5");
									$karakterler->execute();
									foreach($karakterler as $karakter){
											?>
                                                <tr>
                          <td><img style="width:25px; height:20px;" src="<?=WMadmintema.'img/karakterler/'.$karakter["job"];?>.jpg"> <?=$karakter["name"];?></td>
                                                    <td><?=$karakter["level"];?></td>
                                   <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("d", $yetkiler))){ ?>                   <td>
<a class="btn btn-info" href="index.php?sayfa=karakterler&name=<?=$karakter["name"];?>" target="_blank"><i class="fa fa-eye"></i></a>
                                                    </td><?php } ?>
                                                </tr>
									<?php } ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            <!-- END PROJECTS BLOCK -->
                            
                        </div>
                    </div>
                    

					
                    
                    
                </div>
