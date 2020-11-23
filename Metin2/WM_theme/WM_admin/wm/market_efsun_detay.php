
<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
<?=$efetch["isim"];?>
												
</div>
<div class="panel-body">
									
<?=$WMform->head("market_efsun_islemleri");?>
<?=$WMform->veri("isim", false, "text", false, 'value="'.$efetch["isim"].'"',"* Efsun İsmini Giriniz");?>
<?=$WMform->veri("oran", false, "text", false, 'onkeyup="sayi_kontrol(this)" value="'.$efetch["oran"].'"', "* Efsun Oranını Giriniz");?>
<?=$WMform->veri("efsunid", false, "text", false, 'onkeyup="sayi_kontrol(this)" value="'.$efetch["efsunid"].'"', "* Efsun ID Giriniz");?>
<div class="col-md-12"><label>* Efsun Hangi İtemlere Gelebilir ?  </label></div>
<div class="col-md-3">
<?$WMform->check("efsuntur", 9, "Diğer", (strpos($efetch["tur"], "9") !== FALSE) ? 1 : '', 1);?>
<?$WMform->check("efsuntur", 1, "Silah", (strpos($efetch["tur"], "1") !== FALSE) ? 1 : '', 1);?>
<?$WMform->check("efsuntur", 2, "Zırh", (strpos($efetch["tur"], "2") !== FALSE) ? 1 : '', 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("efsuntur", 3, "Bileklik", (strpos($efetch["tur"], "3") !== FALSE) ? 1 : '', 1);?>
<?$WMform->check("efsuntur", 4, "Ayakkabı", (strpos($efetch["tur"], "4") !== FALSE) ? 1 : '', 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("efsuntur", 5, "Kolye", (strpos($efetch["tur"], "5") !== FALSE) ? 1 : '', 1);?>
<?$WMform->check("efsuntur", 6, "Kask", (strpos($efetch["tur"], "6") !== FALSE) ? 1 : '', 1);?>
</div>
<div class="col-md-3">
<?$WMform->check("efsuntur", 7, "Kalkan", (strpos($efetch["tur"], "7") !== FALSE) ? 1 : '', 1);?>
<?$WMform->check("efsuntur", 8, "Küpe", (strpos($efetch["tur"], "8") !== FALSE) ? 1 : '', 1);?>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr><?=$WMform->buton(2, " EFSUN DÜZENLE", "info pull-right", "plus", $efetch["id"]);?></div>
<?=$WMform->footer();?>
	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
