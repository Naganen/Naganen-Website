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
                                    <li><a href="index.php?sayfa=kullanicilar&login=<?=$kfetch["login"];?>"><?=$kfetch["login"];?></a></li>
                                    <li><a href="#nesnemarket" data-toggle="tab"><i class="fa fa-warning"></i> Nesne Market Deposu</a></li>
                                    <li class="active"><a href="#depo" data-toggle="tab"><i class="fa fa-warning"></i> Oyun Deposu</a></li>
                                </ul>
                                <div class="panel-body tab-content">
									
									
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
									

                                    <div class="tab-pane active" id="depo">
																		
									
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

