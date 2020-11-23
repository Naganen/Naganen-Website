<?php $mob = @$_GET["vnum"]; ?> 
 <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												<?=$WMform->head("mob_arastir");?>
												<?=$WMform->veri("mob", "Arancak mobun vnumunu giriniz", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
												<?=$WMform->buton(1, "Ara", "info", "search");?>
												<?=$WMform->footer();?>
												</div>
									
									</div>
									
												<?php
												if($mob < 10){}
												else if($mob != "")
												{
												$query = $odb->prepare("SELECT * FROM player.mob_proto WHERE vnum = ?");
												$query->execute(array($mob));
																								
												if($query->rowCount())
												{
												$mfetch = $query->fetch(PDO::FETCH_ASSOC);
													?>
												<div class="panel panel-default">
												<div class="panel-body">
												
												<div class="col-md-3">
												<div class="alert alert-warning"><b><?=$mfetch["locale_name"];?></b></div>
												</div>
												
												<div class="col-md-2">
												<?=$WMform->head("mob_duzenle");?>
												<?=$WMform->veri("rank", false, "text", false, "value='".$mfetch["rank"]."' onkeyup='sayi_kontrol(this)'", "Güç Seviyesi");?>
												<?=$WMform->veri("type", false, "text", false, "value='".$mfetch["type"]."' onkeyup='sayi_kontrol(this)'", "Mob Tipi");?>
												<?=$WMform->veri("battle_type", false, "text", false, "value='".$mfetch["battle_type"]."' onkeyup='sayi_kontrol(this)'", "Karakter Tipi");?>
												<?=$WMform->veri("level", false, "text", false, "value='".$mfetch["level"]."' onkeyup='sayi_kontrol(this)'", "Mobun Seviyesi");?>
												<?=$WMform->veri("ai_flag", false, "text", false, "value='".$mfetch["ai_flag"]."'", "Mobun Özelliği");?>
												<?=$WMform->veri("attack_range", false, "text", false, "value='".$mfetch["attack_range"]."' onkeyup='sayi_kontrol(this)'", 'Karakter Vurma Uzaklığı');?>
												</div>
												
												<div class="col-md-2">
												<?=$WMform->veri("setRaceFlag", false, "text", false, "value='".$mfetch["setRaceFlag"]."'", 'Mobun Etkilendiği Efsun');?>
												<?=$WMform->veri("setImmuneFlag", false, "text", false, "value='".$mfetch["setImmuneFlag"]."'", "Mobun Korunduğu Bonus");?>
												<?=$WMform->veri("empire", false, "text", false, "value='".$mfetch["empire"]."' onkeyup='sayi_kontrol(this)'", "Mobun Bayrağı");?>
												<?=$WMform->veri("folder", false, "text", false, "value='".$mfetch["folder"]."' onkeyup='sayi_kontrol(this)'", "Mobun Grubu");?>
												<?=$WMform->veri("on_click", false, "text", false, "value='".$mfetch["on_click"]."' onkeyup='sayi_kontrol(this)'", "Mobun Tıklanma Ayarı");?>
												<?=$WMform->veri("aggressive_sight", false, "text", false, "value='".$mfetch["aggressive_sight"]."' onkeyup='sayi_kontrol(this)'", 'Karakter Görme Uzaklığı');?>
												</div>
												
												<div class="col-md-2">
												<?=$WMform->veri("damage_min", false, "text", false, "value='".$mfetch["damage_min"]."' onkeyup='sayi_kontrol(this)'", 'Mobun Minimum Hasarı');?>
												<?=$WMform->veri("damage_max", false, "text", false, "value='".$mfetch["damage_max"]."' onkeyup='sayi_kontrol(this)'", "Mobun Maximum Bonus");?>
												<?=$WMform->veri("max_hp", false, "text", false, "value='".$mfetch["max_hp"]."' onkeyup='sayi_kontrol(this)'", "Mobun HP si");?>
												<?=$WMform->veri("aggressive_hp_pct", false, "text", false, "value='".$mfetch["aggressive_hp_pct"]."' onkeyup='sayi_kontrol(this)'", "HP % kaç indiğinde saldırsın");?>
												<?=$WMform->veri("regen_cycle", false, "text", false, "value='".$mfetch["regen_cycle"]."' onkeyup='sayi_kontrol(this)'", "Hp kaç saniyede dolsun");?>
												<?=$WMform->veri("regen_percent", false, "text", false, "value='".$mfetch["regen_percent"]."' onkeyup='sayi_kontrol(this)'", "HP % kaç dolsun");?>
												</div>
												
												<div class="col-md-2">
												<?=$WMform->veri("gold_min", false, "text", false, "value='".$mfetch["gold_min"]."' onkeyup='sayi_kontrol(this)'", 'Düşçek En az yang');?>
												<?=$WMform->veri("gold_max", false, "text", false, "value='".$mfetch["gold_max"]."' onkeyup='sayi_kontrol(this)'", "Düşçek En fazla yang");?>
												<?=$WMform->veri("exp", false, "text", false, "value='".$mfetch["exp"]."' onkeyup='sayi_kontrol(this)'", "Kaç Exp Versin ? ");?>
												<?=$WMform->veri("def", false, "text", false, "value='".$mfetch["def"]."' onkeyup='sayi_kontrol(this)'", "Mobun Savunması");?>
												<?=$WMform->veri("attack_speed", false, "text", false, "value='".$mfetch["attack_speed"]."' onkeyup='sayi_kontrol(this)'", "Mobun Saldırı Hızı");?>
												<?=$WMform->veri("move_speed", false, "text", false, "value='".$mfetch["move_speed"]."' onkeyup='sayi_kontrol(this)'", "Mobun Hareket Hızı");?>
												</div>
												<div class="col-md-1">
												<?=$WMform->veri("st", false, "text", false, "value='".$mfetch["st"]."' onkeyup='sayi_kontrol(this)'", 'Güç');?>
												<?=$WMform->veri("dx", false, "text", false, "value='".$mfetch["dx"]."' onkeyup='sayi_kontrol(this)'", "Savunma");?>
												<?=$WMform->veri("ht", false, "text", false, "value='".$mfetch["ht"]."' onkeyup='sayi_kontrol(this)'", "HP");?>
												<?=$WMform->veri("iq", false, "text", false, "value='".$mfetch["iq"]."' onkeyup='sayi_kontrol(this)'", "Zeka");?>
												<?=$WMform->veri("drop_item", false, "text", false, "value='".$mfetch["drop_item"]."' onkeyup='sayi_kontrol(this)'", "Dönüşüm K.");?>
												<?=$WMform->veri("dam_multiply", false, "text", false, "value='".$mfetch["dam_multiply"]."' onkeyup='sayi_kontrol(this)'", "Hasar X");?>
												</div>
												<?=$WMform->buton(11, "Kayıt Et", "primary pull-right", "save", $mob, "style='margin-top:10px;'");?>
												<?=$WMform->footer();?>

												
												</div>
												</div>
												
													
													<?php
													
												}
												
												}

												?>
                            
                        </div>                        
                    </div>
                    
                    
                    
                </div>
