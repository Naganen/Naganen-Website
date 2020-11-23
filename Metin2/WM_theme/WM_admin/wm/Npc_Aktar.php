                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-6">
						
						
									<div class="panel panel-danger">
												<div class="panel-heading ui-draggable-handle">
												Aktarılcak Olan NPC
												</div>
									<div class="panel-body">
						<?=$WMform->head("shop_npc_aktar");?>			
						<select name="aktarilcak" class="form-control"><option>Aktarılcak Olan Npc Seçin</option><?=$inf->shops();?></select>
									
									
									</div>
									</div>
                            
                        </div>  

                        <div class="col-md-6">
						
						
									<div class="panel panel-success">
												<div class="panel-heading ui-draggable-handle">
												Aktarılcağı NPC
												</div>
									<div class="panel-body">
									
						<select name="aktar" class="form-control"><option>Aktarılcağı Npc Seçin</option><?=$inf->shops();?></select>
									
									
									</div>
									</div>
                            
                        </div> 
					<div align="center">	
					<?=$WMform->buton(-1, " İtemleri Aktar", "danger", "refresh");?>
					</div>
					<?=$WMform->footer();?>
						
                    </div>
                    
                    
                    
                </div>
