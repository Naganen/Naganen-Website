<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Market Efsun Ekle
												
</div>
<div class="panel-body">
									
<?=$WMform->head("market_efsun_islemleri");?>
<?=$WMform->veri("isim", "* Efsun İsmini Giriniz", "text", false);?>
<?=$WMform->veri("oran", "* Efsun Oranını Giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?>
<?=$WMform->veri("efsunid", "* Efsun ID Giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?>
<div class="col-md-12"><label>* Efsun Hangi İtemlere Gelebilir ?  </label></div>
<div class="col-md-3">
<?$WMform->check("efsuntur", 9, "Diğer", false, 1);?>
<?$WMform->check("efsuntur", 1, "Silah", false, 1);?>
<?$WMform->check("efsuntur", 2, "Zırh", false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("efsuntur", 3, "Bileklik", false, 1);?>
<?$WMform->check("efsuntur", 4, "Ayakkabı", false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("efsuntur", 5, "Kolye", false, 1);?>
<?$WMform->check("efsuntur", 6, "Kas", false, 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("efsuntur", 7, "Kalkan", false, 1);?>
<?$WMform->check("efsuntur", 8, "Küpe", false, 1);?>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr><?=$WMform->buton(1, " EFSUN EKLE", "info pull-right", "plus");?></div>
<?=$WMform->footer();?>
	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
