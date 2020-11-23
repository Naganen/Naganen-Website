<?php $query = $db->prepare("SELECT * FROM eptransfer_log WHERE sid = ? && tur = ? ORDER BY id DESC"); $query->execute(array($_SESSION["server"], 1));
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
                                    <h4>Gönderilmiş Tüm Epler </h4>
									
<table class="table" id="karaktersirala">
<thead>
<tr>
<th>Gönderen</th>
<th>Alan</th>
<th>Ep</th>
<th>Tarih</th>
</tr>
</thead>
<tbody>
<?php
foreach($query as $row){ 
?>
<tr id="eptoken-<?=$row["id"];?>">
<td><?=$row["gonderen"];?></td>
<td><?=$row["alan"];?></td>
<td><?=$row["ep"];?></td>
<td><?=WM_zaman_cevir($row["tarih"]);?></td>
												
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
								<?php $ayarlar = explode(',', $WMadmin->serverbilgi("eptransfer")); ?>
								<?=$WMform->head("sistem_eptransfer");?>
								<div class="form-group"><select class="form-control" name="sistem">
								<option value="1" <?=($ayarlar[0] == 1) ? 'selected' : '';?>>Ep Transfer Sistemi Aktif</option>
								<option value="2" <?=($ayarlar[0] == 2) ? 'selected' : '';?>>Ep Transfer Sistemi Pasif</option>
								</select></div>
								<div class="form-group"><select class="form-control" name="sistem_sifre">
								<option value="1" <?=($ayarlar[1] == 1) ? 'selected' : '';?>>Ep Transfer Şifresi Aktif</option>
								<option value="2" <?=($ayarlar[1] == 2) ? 'selected' : '';?>>Ep Transfer Şifresi Pasif</option>
								</select></div>
								<div class="form-group"><select class="form-control" name="sifre_olustur">
								<option value="1" <?=($ayarlar[2] == 1) ? 'selected' : '';?>>Otomatik Şifre Oluşturucu Aktif</option>
								<option value="2" <?=($ayarlar[2] == 2) ? 'selected' : '';?>>Otomatik Şifre Oluşturucu Pasif </option>
								</select></div>
								<div class="form-group"><select class="form-control" name="sifre_unuttum">
								<option value="1" <?=($ayarlar[3] == 1) ? 'selected' : '';?>>Şifremi Unuttum Aktif</option>
								<option value="2" <?=($ayarlar[3] == 2) ? 'selected' : '';?>>Şifremi Unuttum Pasif </option>
								</select></div>
								<div class="form-group"><select class="form-control" name="sifre_degistir">
								<option value="1" <?=($ayarlar[4] == 1) ? 'selected' : '';?>>Şifre Değiştirme Aktif</option>
								<option value="2" <?=($ayarlar[4] == 2) ? 'selected' : '';?>>Şifre Değiştirme Pasif </option>
								</select></div>
								<div class="form-group"><select class="form-control" name="sistem_kabul">
								<option value="1" <?=($ayarlar[5] == 1) ? 'selected' : '';?>>Sistem Kabul Değişimi Aktif</option>
								<option value="2" <?=($ayarlar[5] == 2) ? 'selected' : '';?>>Sistem Kabul Değişimi Pasif</option>
								</select></div>
								<?=$WMform->buton(1, " Kaydet", "warning btn-block pull-right", "save");?>
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
