<?php $query = $odb->prepare("SELECT login,bakiye FROM account ORDER BY bakiye DESC LIMIT 10");  $query->execute();
if($query->rowCount())
{
?>
               <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    
                    <div class="row">
					
					<div class="col-md-4">
					
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Bakiyesi En Fazla Olan 10 Kullanıcı</h4>
									
                                     <table class="table table-actions table-striped">
                                     <thead>                                            
                                     <tr>
                                     <th WIDTH=3%>#</th>
                                     <th WIDTH=40%>Kullanıcı</th>
                                     <th WIDTH=30%>Bakiye</th>
                                     </tr>
                                     </thead>
                                     <tbody>
									 <?php $say = 0; foreach($query as $row){ $say++; ?>
									<tr>
									<td><?=$say;?></td>
									<td><a href="index.php?sayfa=kullanicilar&login=<?=$row["login"];?>" target="_blank"><?=$row["login"];?></a></td>
									<td><i class="fa fa-money"></i> <?=$row["bakiye"];?></td>
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
								<h4>Bakiye Yükle - Azalt </h4>
								Kullancıya yüklemek için başına 1 karaktere yüklemek için başına 2 yazın <br> Örnek : 1webmeric <br><br>
								<?=$WMform->head("sistem_bakiye");?>
								<?=$WMform->veri("gonderilcek", "Gönderilcek Kullanıcı veya Karakter", "text", false);?>
								<?=$WMform->veri("bakiye", "Bakiye Miktarı ( Sadece Sayı)", "text", false, 'onkeyup="sayi_kontrol(this)"');?>
								<?=$WMform->buton(1, " Bakiye Yükle", "success btn-block pull-right", "plus");?>
								<?=$WMform->buton(2, " Bakiye Azalt", "danger btn-block pull-right", "arrow-down");?>
								<?=$WMform->footer();?>
                                </div>
                            </div>
							</div>
							
							<div class="col-md-4">					
                            <div class="panel panel-default">
                                <div class="panel-body">
								<h4>Bakiye Sorgula</h4>
								Kullancı sorgusu için başına 1 karakter sorgusu için başına 2 yazın <br> Örnek : 1webmeric <br><br>
								<?=$WMform->head("sistem_bakiye");?>
								<?=$WMform->veri("sorgulancak", "Shop Vnumunu Giriniz", "text", false);?>
								<?=$WMform->buton(3, " Bakiye Sorgula", "info btn-block pull-right", "search");?>
								<?=$WMform->footer();?>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-body">
								Bakiye Sistem Yapımcısı <b>Webmeric © 2013-2016</b>
                                </div>
                            </div>
							
					
					</div>
					
                    </div>
                    
                    
                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
<?php }else{ $WMadmin->yonlendir("index.php?sayfa=sistem_kur"); } ?>
