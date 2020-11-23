<?php
$query = $db->prepare("SELECT id,isim FROM market_kategori WHERE sid = ? ORDER BY id DESC");
$query->execute(array($_SESSION["server"]));

?>  

<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
<?=$mfetch["isim"];?>
												
</div>
<div class="panel-body">
									
<?=$WMform->head("market_item_islemleri");?>
<?=$WMform->veri("isim", false, "text", false, 'value="'.$mfetch["isim"].'"', '* İtem İsmini Giriniz');?>
<div class="form-group"><label>İtem Açıklaması</label><textarea rows="6" class="form-control" name="aciklama"><?=$mfetch["aciklama"];?></textarea></div>
<?=$WMform->veri("vnum", false, "text", false, 'onkeyup="sayi_kontrol(this)" value="'.$mfetch["vnum"].'"', "* İtem Vnumunu giriniz");?>
<?$WMform->check("resimtur", 1, "İtem resimi girdiğiniz vnuma göre otomatik kaydolsun istiyor iseniz burayı seçiniz. ( Burayı seçtikten sonra resim linki girmeye gerek yoktur.)", false);?>
<?=$WMform->veri("resim", false, "text", false, 'value="'.$mfetch["resim"].'"', "İtem Resim Adresini giriniz");?>
<?=$WMform->veri("fiyat", false, "text", false, 'value="'.$mfetch["fiyat"].'" onkeyup="sayi_kontrol(this)"', "* İtem Fiyatını giriniz");?>
<?=$WMform->veri("miktar", false, "text", false, 'value="'.$mfetch["miktar"].'" onkeyup="sayi_kontrol(this)"', "* İtem Miktarını giriniz");?>
<div class="form-group"><label>* Market kategorisi seçiniz</label><select class="form-control" name="kategori">
<?php foreach($query as $row){ ?> 
<option value="<?=$row["id"];?>" <?=($mfetch["kid"] == $row["id"]) ? 'selected' : '';?>><?=$row["isim"];?></option>
<?php } ?></select></div>
<div class="col-md-12"><label>* Eklediğiniz itemin türünü seçiniz </label></div>
<div class="col-md-3">
<?$WMform->check("itemtur", 9, "Diğer", ($mfetch["itemtur"] == 9) ? 1 : '', 1);?>
<?$WMform->check("itemtur", 1, "Silah", ($mfetch["itemtur"] == 1) ? 1 : '', 1);?>
<?$WMform->check("itemtur", 2, "Zırh", ($mfetch["itemtur"] == 2) ? 1 : '', 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("itemtur", 3, "Bileklik", ($mfetch["itemtur"] == 3) ? 1 : '', 1);?>
<?$WMform->check("itemtur", 4, "Ayakkabı", ($mfetch["itemtur"] == 4) ? 1 : '', 1);?>
<?$WMform->check("itemtur", 10, "Tecrübe Yüzüğü", ($mfetch["itemtur"] == 10) ? 1 : '', 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("itemtur", 5, "Kolye", ($mfetch["itemtur"] == 5) ? 1 : '', 1);?>
<?$WMform->check("itemtur", 6, "Kas", ($mfetch["itemtur"] == 6) ? 1 : '', 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("itemtur", 7, "Kalkan", ($mfetch["itemtur"] == 7) ? 1 : '', 1);?>
<?$WMform->check("itemtur", 8, "Küpe", ($mfetch["itemtur"] == 8) ? 1 : '', 1);?>
</div>

<?php 

@$parcala_sure = explode(',', $mfetch["sure"]);

?>

<div class="col-md-12" style="margin-top:10px;"><hr><?$WMform->check("efsun", 1, "Eklediğiniz iteme efsun gelebilecek mi ? ", ($mfetch["efsun"] == 1) ? 1 : '', 1);?></div>
<div class="col-md-12" style="margin-top:10px;"><hr>
<div class="col-md-6"><?$WMform->check("sureli", 16, "Eklediğiniz İtem süreli olsun mu ?  ", ($mfetch["sure_tur"] == 2) ? 1 : '', 1);?></div>
<div class="col-md-3"><?=$WMform->veri("gun", false, "text", 6, 'value="'.@$parcala_sure[0].'" onkeyup="sayi_kontrol(this)"', "Süreli ise ise kaç gün süresi olucak ? ");?></div>
<div class="col-md-3"><?=$WMform->veri("saat", false, "text", 6, 'value="'.@$parcala_sure[1].'" onkeyup="sayi_kontrol(this)"', "Süreli ise ise kaç saat süresi olucak ? ");?></div>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr>
<div class="col-md-6"><?$WMform->check("indirim", 15, "Eklediğiniz İtem İndirimli olsun mu ?  ", ($mfetch["durum"] == 2) ? 1 : '', 1);?></div>
<div class="col-md-6"><?=$WMform->veri("eskifiyat", false, "text", 6, 'value="'.$mfetch["eskifiyat"].'" onkeyup="sayi_kontrol(this)"', "İndirimli ise itemin eski fiyatını giriniz");?></div>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr><?=$WMform->buton(2, " İTEM DÜZENLE", "danger pull-right", "save", $mfetch["id"]);?></div>
<?=$WMform->footer();?>
	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
