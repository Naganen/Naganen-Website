<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Destek Kategorisi Ekle
												
</div>
<div class="panel-body">

									
<?=$WMform->head("destek_kategori");?>
<?=$WMform->veri("isim", "* Destek Departmanı İsmi ", "text", false);?>
<div class="form-group"><label>Oto Doldurma</label><textarea rows="10" name="value" class="form-control">Örnek Aşağıda verilmiştir.
ÖDEME YOLU : 
ÖDEME MİKTARI :
ÖDEME YAPAN : </textarea></div>
<?=$WMform->buton(1, " Kategori Ekle", "default pull-right", "plus");?>
<?=$WMform->footer();?>




	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
