<?php 
$efsunlar = $odb->prepare("SELECT * FROM player.item_attr_rare"); 
$efsunlar->execute();
?>
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
                            <!-- START ACCORDION -->        
                            <div class="panel-group accordion">
							<?php
							$i = 0;
							foreach($efsunlar as $efsun){
							$i++;
							?>
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="#<?=$efsun["apply"];?>">
                                                <?=$efsun["apply"];?>
                                            </a>
                                        </h4>
                                    </div>                                
                                    <div class="panel-body" id="<?=$efsun["apply"];?>">
									<?$WMform->head("efsun_2_duzenle", $i);?>
									<?$WMform->veri("gelme-$i", false, "text", "2", "value='".$efsun["prob"]."' onkeyup='sayi_kontrol(this)'", "Gelme % ");?>
									<?$WMform->veri("lv1-$i", false, "text", "2", "value='".$efsun["lv1"]."' onkeyup='sayi_kontrol(this)'", "Level 1");?>
									<?$WMform->veri("lv2-$i", false, "text", "2", "value='".$efsun["lv2"]."' onkeyup='sayi_kontrol(this)'", "Level 2");?>
									<?$WMform->veri("lv3-$i", false, "text", "2", "value='".$efsun["lv3"]."' onkeyup='sayi_kontrol(this)'", "Level 3");?>
									<?$WMform->veri("lv4-$i", false, "text", "2", "value='".$efsun["lv4"]."' onkeyup='sayi_kontrol(this)'", "Level 4");?>
									<?$WMform->veri("lv5-$i", false, "text", "2", "value='".$efsun["lv5"]."' onkeyup='sayi_kontrol(this)'", "Level 5");?>
									<?$WMform->veri("silah-$i", false, "text", "2", "value='".$efsun["weapon"]."' onkeyup='sayi_kontrol(this)'", "Silah %");?>
									<?$WMform->veri("zirh-$i", false, "text", "2", "value='".$efsun["body"]."' onkeyup='sayi_kontrol(this)'", "Zırh %");?>
									<?$WMform->veri("bileklik-$i", false, "text", "2", "value='".$efsun["wrist"]."' onkeyup='sayi_kontrol(this)'", "Bileklik %");?>
									<?$WMform->veri("ayakkabi-$i", false, "text", "2", "value='".$efsun["foots"]."' onkeyup='sayi_kontrol(this)'", "Ayakkabı %");?>
									<?$WMform->veri("kolye-$i", false, "text", "2", "value='".$efsun["neck"]."' onkeyup='sayi_kontrol(this)'", "Kolye %");?>
									<?$WMform->veri("kask-$i", false, "text", "2", "value='".$efsun["head"]."' onkeyup='sayi_kontrol(this)'", "Kask %");?>
									<?$WMform->veri("kalkan-$i", false, "text", "2", "value='".$efsun["shield"]."' onkeyup='sayi_kontrol(this)'", "Kalkan %");?>
									<?$WMform->veri("kupe-$i", false, "text", "2", "value='".$efsun["ear"]."' onkeyup='sayi_kontrol(this)'", "Küpe %");?>
									<?$WMform->veri("apply-$i", false, "hidden", false, "value='".$efsun["apply"]."'");?>
									<?$WMform->buton($i, "Kayıt Et", "success pull-right", "save", false, "style='margin-top:60px;'");?>
									<?$WMform->footer();?>
                                    </div>                                
                                </div>
							<?php } ?>
                            </div>
                            <!-- END ACCORDION -->                        
						
						
                            
                        </div>                        
                    </div>
                    
                    
                    
                </div>
