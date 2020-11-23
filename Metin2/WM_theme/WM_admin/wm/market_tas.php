<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Market Taş Ekle / Düzenle
												
</div>
<div class="panel-body">
									
<table class="table" id="karaktersirala">
<thead>
<tr>
<th>Taş İsimi</th>
<th>Taş Türü</th>
<th>Taş Vnumu</th>
<th>İşlemler</th>
</tr>
</thead>
<tbody>
<tr>	
<?=$WMform->head("market_tas_islem");?>
<td><?=$WMform->veri("tas", "Taşın İsmini Giriniz", "text", false);?></td>
<td><select name="tur" class="form-control"><option value="1">Silah</option><option value="2">Zırh</option></select></td>
<td ><?=$WMform->veri("vnum", "Taşın Vnumunu Giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?></td>
<td><?=$WMform->buton(1, " TAŞ EKLE", "info pull-right", "plus");?></td>
<?=$WMform->footer();?>
</tr>
										
<?php
$query = $db->prepare("SELECT tas,tur,vnum,id FROM market_tas WHERE sid = ? ORDER BY id DESC");
$query->execute(array($_SESSION["server"]));
$i = 4;
foreach($query as $row){ $i++;
?>
<tr id="market_tas-<?=$row["id"];?>">
<?=$WMform->head("market_tas_islem", $i);?>
<td><?=$WMform->veri("tas-$i", false, "text", false, "value='".$row["tas"]."'");?></td>
<td><select name="tur-<?=$i;?>" class="form-control"><option value="1" <?=($row["tur"] == 1) ? 'selected' : '';?>>Silah</option><option <?=($row["tur"] == 2) ? 'selected' : '';?> value="2">Zırh</option></select></td>
<td><?=$WMform->veri("vnum-$i", false, "text", false, "value='".$row["vnum"]."' onkeyup='sayi_kontrol(this)'");?></td>
<td WIDTH=10%>
<a onclick="WM_sil('market_tas_islem&formid=2&id=<?=$row["id"];?>&')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
<?=$WMform->buton($i, false, "info", "save", $row["id"]);?>
<?=$WMform->footer();?>
</td>
</tr>
												
<?php
}
?>
</tbody>
</table>
									
										
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
