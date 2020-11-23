<?php
$query = $db->prepare("SELECT id,isim FROM market_kategori WHERE sid = ? ORDER BY id DESC");
$query->execute(array($_SESSION["server"]));

?>  

<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Market İtem Ekle
												
</div>
<div class="panel-body">
									
<?=$WMform->head("market_item_islemleri");?>
<?=$WMform->veri("isim", "* İtem İsmini Giriniz", "text", false);?>
<div class="form-group"><textarea rows="6" class="form-control" name="aciklama" placeholder="İtem Açıklamasını Yazınız"></textarea></div>
<?=$WMform->veri("vnum", "* İtem Vnumunu giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?>
<?$WMform->check("resimtur", 1, "İtem resimi girdiğiniz vnuma göre otomatik kaydolsun istiyor iseniz burayı seçiniz. ( Burayı seçtikten sonra resim linki girmeye gerek yoktur.)", false);?>
<?=$WMform->veri("resim", "İtem resim link adresini giriniz", "text", false);?>
<?=$WMform->veri("fiyat", "* İtem Fiyatını giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?>
<?=$WMform->veri("miktar", "* İtem Miktarını giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?>
<div class="form-group"><label>* Market kategorisi seçiniz</label><select class="form-control" name="kategori">
<?php foreach($query as $row){ ?> 
<option value="<?=$row["id"];?>"><?=$row["isim"];?></option>
<?php } ?></select></div>
<div class="col-md-12"><label>* Eklediğiniz itemin türünü seçiniz </label></div>
<div class="col-md-3">
<?$WMform->check("itemtur", 9, "Diğer", false, 1);?>
<?$WMform->check("itemtur", 1, "Silah", false, 1);?>
<?$WMform->check("itemtur", 2, "Zırh", false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("itemtur", 3, "Bileklik", false, 1);?>
<?$WMform->check("itemtur", 4, "Ayakkabı", false, 1);?>
<?$WMform->check("itemtur", 10, "Tecrübe Yüzüğü", false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("itemtur", 5, "Kolye", false, 1);?>
<?$WMform->check("itemtur", 6, "Kask", false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("itemtur", 7, "Kalkan", false, 1);?>
<?$WMform->check("itemtur", 8, "Küpe", false, 1);?>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr><?$WMform->check("efsun", 1, "Eklediğiniz iteme efsun gelebilecek mi ? ", false, 1);?></div>
<div class="col-md-12" style="margin-top:10px;"><hr>
<div class="alert alert-warning"><i class="fa fa-warning"></i><b> UYARI !</b> Eğer item süreli olarak seçilirse itemin türü diğer olmalı ve iteme efsun gelecek mi ? yeri işaretlenmemelidir .!</div>
<div class="col-md-6"><?$WMform->check("sureli", 16, "Eklediğiniz İtem süreli olsun mu ?  ", false);?></div>
<div class="col-md-3"><?=$WMform->veri("gun", "Süreli ise Kaç Gün Süresi Olucak ? ", "text", 6, 'onkeyup="sayi_kontrol(this)"');?></div>
<div class="col-md-3"><?=$WMform->veri("saat", "Süreli ise Kaç Saat Süresi Olucak ? ", "text", 6, 'onkeyup="sayi_kontrol(this)"');?></div>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr>
<div class="col-md-6"><?$WMform->check("indirim", 15, "Eklediğiniz İtem İndirimli olsun mu ?  ", false, 1);?></div>
<div class="col-md-6"><?=$WMform->veri("eskifiyat", "İndirimli ise itemin eski fiyatını giriniz", "text", 6, 'onkeyup="sayi_kontrol(this)"');?></div>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr><?=$WMform->buton(1, " İTEM EKLE", "info pull-right", "plus");?></div>
<?=$WMform->footer();?>
	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
