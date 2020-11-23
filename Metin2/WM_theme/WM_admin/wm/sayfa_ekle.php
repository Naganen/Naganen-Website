
<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-body">
									
<?=$WMform->head("sayfa_islemleri");?>
<?=$WMform->veri("konu", false, "text", false, false, 'Sayfanın Konusunu Giriniz');?>
								<label>Sayfa İçeriğini Giriniz</label>
<textarea name="icerik" class="icerik"></textarea>
<?=$WMform->buton(1, " Sayfa Ekle", "success pull-right", "plus");?>
<?=$WMform->footer();?>
									
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>

				
