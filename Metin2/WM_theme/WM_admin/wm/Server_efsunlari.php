<?php 
$efsunlar1 = $odb->prepare("SELECT * FROM player.item_attr LIMIT 0,20"); 
$efsunlar1->execute();
$efsunlar2 = $odb->prepare("SELECT * FROM player.item_attr LIMIT 20,20"); 
$efsunlar2->execute();
$efsunlar3 = $odb->prepare("SELECT * FROM player.item_attr LIMIT 40,20"); 
$efsunlar3->execute();

?>
                <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						    <div class="col-md-4">
                            <!-- START ACCORDION -->        
                            <div class="panel-group accordion">
							<?php
							$i = 0;
							foreach($efsunlar1 as $efsun1){
							$i++;
							?>
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="#<?=$efsun1["apply"];?>">
                                                <?=$efsun1["apply"];?>
                                            </a>
                                        </h4>
                                    </div>                                
                                    <div class="panel-body" id="<?=$efsun1["apply"];?>">
									<?$WMform->head("efsun_duzenle", $i);?>
									<?$WMform->veri("gelme-$i", false, "text", "4", "value='".$efsun1["prob"]."' onkeyup='sayi_kontrol(this)'", "Gelme % ");?>
									<?$WMform->veri("lv1-$i", false, "text", "4", "value='".$efsun1["lv1"]."' onkeyup='sayi_kontrol(this)'", "Level 1");?>
									<?$WMform->veri("lv2-$i", false, "text", "4", "value='".$efsun1["lv2"]."' onkeyup='sayi_kontrol(this)'", "Level 2");?>
									<?$WMform->veri("lv3-$i", false, "text", "4", "value='".$efsun1["lv3"]."' onkeyup='sayi_kontrol(this)'", "Level 3");?>
									<?$WMform->veri("lv4-$i", false, "text", "4", "value='".$efsun1["lv4"]."' onkeyup='sayi_kontrol(this)'", "Level 4");?>
									<?$WMform->veri("lv5-$i", false, "text", "4", "value='".$efsun1["lv5"]."' onkeyup='sayi_kontrol(this)'", "Level 5");?>
									<?$WMform->veri("silah-$i", false, "text", "4", "value='".$efsun1["weapon"]."' onkeyup='sayi_kontrol(this)'", "Silah %");?>
									<?$WMform->veri("zirh-$i", false, "text", "4", "value='".$efsun1["body"]."' onkeyup='sayi_kontrol(this)'", "Zırh %");?>
									<?$WMform->veri("bileklik-$i", false, "text", "4", "value='".$efsun1["wrist"]."' onkeyup='sayi_kontrol(this)'", "Bileklik %");?>
									<?$WMform->veri("ayakkabi-$i", false, "text", "4", "value='".$efsun1["foots"]."' onkeyup='sayi_kontrol(this)'", "Ayakkabı %");?>
									<?$WMform->veri("kolye-$i", false, "text", "4", "value='".$efsun1["neck"]."' onkeyup='sayi_kontrol(this)'", "Kolye %");?>
									<?$WMform->veri("kask-$i", false, "text", "4", "value='".$efsun1["head"]."' onkeyup='sayi_kontrol(this)'", "Kask %");?>
									<?$WMform->veri("kalkan-$i", false, "text", "4", "value='".$efsun1["shield"]."' onkeyup='sayi_kontrol(this)'", "Kalkan %");?>
									<?$WMform->veri("kupe-$i", false, "text", "4", "value='".$efsun1["ear"]."' onkeyup='sayi_kontrol(this)'", "Küpe %");?>
									<?$WMform->veri("apply-$i", false, "hidden", false, "value='".$efsun1["apply"]."'");?>
									<?$WMform->buton($i, "Kayıt Et", "danger btn-block pull-right", "save", false, "style='margin-top:10px;'");?>
									<?$WMform->footer();?>
                                    </div>                                
                                </div>
							<?php } ?>
                            </div>
                            <!-- END ACCORDION -->                        
                        </div>
						
						    <div class="col-md-4">
                            <!-- START ACCORDION -->        
                            <div class="panel-group accordion">
							<?php 
							$ii = 20;
							foreach($efsunlar2 as $efsun2){
							$ii++;
							?>
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="#<?=$efsun2["apply"];?>">
                                                <?=$efsun2["apply"];?>
                                            </a>
                                        </h4>
                                    </div>                                
                                    <div class="panel-body" id="<?=$efsun2["apply"];?>">
									<?$WMform->head("efsun_duzenle", $ii);?>
									<?$WMform->veri("gelme-$ii", false, "text", "4", "value='".$efsun2["prob"]."' onkeyup='sayi_kontrol(this)'", "Gelme % ");?>
									<?$WMform->veri("lv1-$ii", false, "text", "4", "value='".$efsun2["lv1"]."' onkeyup='sayi_kontrol(this)'", "Level 1");?>
									<?$WMform->veri("lv2-$ii", false, "text", "4", "value='".$efsun2["lv2"]."' onkeyup='sayi_kontrol(this)'", "Level 2");?>
									<?$WMform->veri("lv3-$ii", false, "text", "4", "value='".$efsun2["lv3"]."' onkeyup='sayi_kontrol(this)'", "Level 3");?>
									<?$WMform->veri("lv4-$ii", false, "text", "4", "value='".$efsun2["lv4"]."' onkeyup='sayi_kontrol(this)'", "Level 4");?>
									<?$WMform->veri("lv5-$ii", false, "text", "4", "value='".$efsun2["lv5"]."' onkeyup='sayi_kontrol(this)'", "Level 5");?>
									<?$WMform->veri("silah-$ii", false, "text", "4", "value='".$efsun2["weapon"]."' onkeyup='sayi_kontrol(this)'", "Silah %");?>
									<?$WMform->veri("zirh-$ii", false, "text", "4", "value='".$efsun2["body"]."' onkeyup='sayi_kontrol(this)'", "Zırh %");?>
									<?$WMform->veri("bileklik-$ii", false, "text", "4", "value='".$efsun2["wrist"]."' onkeyup='sayi_kontrol(this)'", "Bileklik %");?>
									<?$WMform->veri("ayakkabi-$ii", false, "text", "4", "value='".$efsun2["foots"]."' onkeyup='sayi_kontrol(this)'", "Ayakkabı %");?>
									<?$WMform->veri("kolye-$ii", false, "text", "4", "value='".$efsun2["neck"]."' onkeyup='sayi_kontrol(this)'", "Kolye %");?>
									<?$WMform->veri("kask-$ii", false, "text", "4", "value='".$efsun2["head"]."' onkeyup='sayi_kontrol(this)'", "Kask %");?>
									<?$WMform->veri("kalkan-$ii", false, "text", "4", "value='".$efsun2["shield"]."' onkeyup='sayi_kontrol(this)'", "Kalkan %");?>
									<?$WMform->veri("kupe-$ii", false, "text", "4", "value='".$efsun2["ear"]."' onkeyup='sayi_kontrol(this)'", "Küpe %");?>
									<?$WMform->veri("apply-$ii", false, "hidden", false, "value='".$efsun2["apply"]."'");?>
									<?$WMform->buton($ii, "Kayıt Et", "success btn-block pull-right", "save", false, "style='margin-top:10px;'");?>
									<?$WMform->footer();?>
                                    </div>                                
                                </div>
							<?php } ?>
                            </div>
                            <!-- END ACCORDION -->                        
                        </div>
						
						    <div class="col-md-4">
                            <!-- START ACCORDION -->        
                            <div class="panel-group accordion">
							<?php 
							$iii = 40;
							foreach($efsunlar3 as $efsun3){
							$iii++;
							?>
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="#<?=$efsun3["apply"];?>">
                                                <?=$efsun3["apply"];?>
                                            </a>
                                        </h4>
                                    </div>                                
                                    <div class="panel-body" id="<?=$efsun3["apply"];?>">
									<?$WMform->head("efsun_duzenle", $iii);?>
									<?$WMform->veri("gelme-$iii", false, "text", "4", "value='".$efsun3["prob"]."' onkeyup='sayi_kontrol(this)'", "Gelme % ");?>
									<?$WMform->veri("lv1-$iii", false, "text", "4", "value='".$efsun3["lv1"]."' onkeyup='sayi_kontrol(this)'", "Level 1");?>
									<?$WMform->veri("lv2-$iii", false, "text", "4", "value='".$efsun3["lv2"]."' onkeyup='sayi_kontrol(this)'", "Level 2");?>
									<?$WMform->veri("lv3-$iii", false, "text", "4", "value='".$efsun3["lv3"]."' onkeyup='sayi_kontrol(this)'", "Level 3");?>
									<?$WMform->veri("lv4-$iii", false, "text", "4", "value='".$efsun3["lv4"]."' onkeyup='sayi_kontrol(this)'", "Level 4");?>
									<?$WMform->veri("lv5-$iii", false, "text", "4", "value='".$efsun3["lv5"]."' onkeyup='sayi_kontrol(this)'", "Level 5");?>
									<?$WMform->veri("silah-$iii", false, "text", "4", "value='".$efsun3["weapon"]."' onkeyup='sayi_kontrol(this)'", "Silah %");?>
									<?$WMform->veri("zirh-$iii", false, "text", "4", "value='".$efsun3["body"]."' onkeyup='sayi_kontrol(this)'", "Zırh %");?>
									<?$WMform->veri("bileklik-$iii", false, "text", "4", "value='".$efsun3["wrist"]."' onkeyup='sayi_kontrol(this)'", "Bileklik %");?>
									<?$WMform->veri("ayakkabi-$iii", false, "text", "4", "value='".$efsun3["foots"]."' onkeyup='sayi_kontrol(this)'", "Ayakkabı %");?>
									<?$WMform->veri("kolye-$iii", false, "text", "4", "value='".$efsun3["neck"]."' onkeyup='sayi_kontrol(this)'", "Kolye %");?>
									<?$WMform->veri("kask-$iii", false, "text", "4", "value='".$efsun3["head"]."' onkeyup='sayi_kontrol(this)'", "Kask %");?>
									<?$WMform->veri("kalkan-$iii", false, "text", "4", "value='".$efsun3["shield"]."' onkeyup='sayi_kontrol(this)'", "Kalkan %");?>
									<?$WMform->veri("kupe-$iii", false, "text", "4", "value='".$efsun3["ear"]."' onkeyup='sayi_kontrol(this)'", "Küpe %");?>
									<?$WMform->veri("apply-$iii", false, "hidden", false, "value='".$efsun3["apply"]."'");?>
									<?$WMform->buton($iii, "Kayıt Et", "info btn-block pull-right", "save", false, "style='margin-top:10px;'");?>
									<?$WMform->footer();?>
                                    </div>                                
                                </div>
							<?php } ?>
                            </div>
                            <!-- END ACCORDION -->                        
                        </div>

                            
                        </div>                        
                    </div>
                    
                    
                    
                </div>
