                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												NPC (SHOP) EKLE
												
												</div>
									<div class="panel-body">
									
									<?=$WMform->head("shop_ekle");?>
									<?=$WMform->veri("vnum", "Shop Vnumunu Giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?>
									<?=$WMform->veri("npc", "NPC Vnumunu Giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?>
									<?=$WMform->veri("info", "Shop açıklamasını giriniz", "text", false);?>
									<?=$WMform->buton(-1, " NPC EKLE", "info pull-right", "plus");?>
									<?=$WMform->footer();?>
	
									</div>
									</div>
                            
                        </div>                        
                    </div>
                    
                    
                    
                </div>
