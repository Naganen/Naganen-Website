<?php $query = $db->prepare("SELECT * FROM eptoken WHERE sid = ? ORDER BY id DESC");  $query->execute(array($_SESSION["server"]));
if($query)
{
?>
               <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    
                    
                    <div class="row">
					
					<div class="col-md-9">
					
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h4>Oluşturulmuş Tüm Ep Tokenleri </h4>
									
<table class="table" id="karaktersirala">
<thead>
<tr>
<th>Token</th>
<th>Şifre</th>
<th>Ep</th>
<th>Kullanan</th>
<th>Oluşturan</th>
<th>Oluşturulma Tarihi</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
foreach($query as $row){ 
?>
<tr id="eptoken-<?=$row["id"];?>">
<td><?=$row["token"];?></td>
<td><?=$row["tokenpass"];?></td>
<td><?=$row["ep"];?></td>
<td><?php if($row["kullanan"] == ""){ ?> Kullanılmamış <?php }else{ ?><font color="red"> <?=$row["kullanan"];?> <br> <?=WM_zaman_cevir($row["kullanma_tarih"]);?> <br> kullanıldı. </font><?php } ?></td>
<td><?=($row["olusturan"] == ".!*23.") ? 'Admin' : $row["olusturan"];?></td>
<td><?=WM_zaman_cevir($row["olusturma_tarih"]);?></td>
<td><a onclick="WM_sil('sistem_eptoken&formid=2&id=<?=$row["id"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
												
</tr>
<?php
}
?>
</tbody>
</table>
									
									
                             
							 </div>
                            </div>
							
					
					</div>
					
					<div class="col-md-3">
					
                            <div class="panel panel-default">
                                <div class="panel-body">
								<h4>Sistem Ayarları </h4>
								<?php $ayarlar = explode(',', $WMadmin->serverbilgi("eptoken")); ?>
								<?=$WMform->head("sistem_eptoken");?>
								<div class="form-group"><select class="form-control" name="mail">
								<option value="1" <?=($ayarlar[0] == 1) ? 'selected' : '';?>>EP Alındı Maili Göndersin</option>
								<option value="2" <?=($ayarlar[0] == 2) ? 'selected' : '';?>>EP Alındı Maili Göndermesin</option>
								</select></div>
								<div class="form-group"><select class="form-control" name="sifre">
								<option value="1" <?=($ayarlar[1] == 1) ? 'selected' : '';?>>Listede Şifre Gözüksün</option>
								<option value="2" <?=($ayarlar[1] == 2) ? 'selected' : '';?>>Listede Şifre Gözükmesin</option>
								</select></div>
								<div class="form-group"><select class="form-control" name="kullanan">
								<option value="1" <?=($ayarlar[2] == 1) ? 'selected' : '';?>>Listede Kullanan Gözüksün</option>
								<option value="2" <?=($ayarlar[2] == 2) ? 'selected' : '';?>>Listede Kullanan Gözükmesin</option>
								</select></div>
								<?=$WMform->buton(1, " Kaydet", "warning btn-block pull-right", "save");?>
								<?=$WMform->footer();?>
                                </div>
                            </div>
							</div>
					
					<div class="col-md-3">
					
                            <div class="panel panel-default">
                                <div class="panel-body">
								<h4>Ep Tokeni Oluştur </h4>
								<?=$WMform->head("sistem_eptoken");?>
								<?=$WMform->veri("epmiktar", "Ep Miktarı", "text", false, 'onkeyup="sayi_kontrol(this)"');?>
								<?=$WMform->buton(3, " Oluştur", "success btn-block pull-right", "plus");?>
								<?=$WMform->footer();?>
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
