<?php $item = @$_GET["vnum"]; ?> 
 <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												<?=$WMform->head("item_arastir");?>
												<?=$WMform->veri("item", "Arancak itemin vnumunu giriniz.", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
												<?=$WMform->buton(1, "Ara", "info", "search");?>
												<?=$WMform->footer();?>
												</div>
									
									</div>
									
												<?php
												if($item < 10){}
												else if($item != "")
												{
												$query = $odb->prepare("SELECT * FROM player.item_proto WHERE vnum = ?");
												$query->execute(array($item));
																								
												if($query->rowCount())
												{
												$ifetch = $query->fetch(PDO::FETCH_ASSOC);
													?>
												<div class="panel panel-default">
												<div class="panel-body">
												
												<div class="col-md-3">
												<div class="alert alert-warning"><?=$inf->item_resim($item, $ifetch["type"], 25, 30);?> <b><?=$WMadmin->item_bul($item);?></b></div>
												<div class="alert alert-warning"><strong><i class="fa fa-warning"></i> BİLGİLER</strong><br>
												* Sağdaki inputlar giyilebilir itemler için geçerlidir. Giyilemeyen itemlerde bazı inputlar değişkenlik gösterebilir<br><br>
												* Antiflag Hesaplayın <a href="index.php?sayfa=Antiflag_hesapla" target="_blank"><i class="fa fa-calculator"></i></a><br>
												</div>
												</div>
												
												<div class="col-md-3">
												<?=$WMform->head("item_duzenle");?>
												<?=$WMform->veri("type", false, "text", false, "value='".$ifetch["type"]."' onkeyup='sayi_kontrol(this)'", "İtem Tipi");?>
												<?=$WMform->veri("subtype", false, "text", false, "value='".$ifetch["subtype"]."' onkeyup='sayi_kontrol(this)'", "İtem Sub Tipi");?>
												<?=$WMform->veri("size", false, "text", false, "value='".$ifetch["size"]."' onkeyup='sayi_kontrol(this)'", "Büyüklüğü");?>
												<?=$WMform->veri("yukselcek", false, "text", false, "value='".$ifetch["refined_vnum"]."' onkeyup='sayi_kontrol(this)'", "Yükselceği İtem");?>
												<?=$WMform->veri("refineid", false, "text", false, "value='".$ifetch["refine_set"]."' onkeyup='sayi_kontrol(this)'", "Refine İD");?>
												</div>
												
												<div class="col-md-3">
												<?=$WMform->veri("antiflag", false, "text", false, "value='".$ifetch["antiflag"]."' onkeyup='sayi_kontrol(this)'", 'İtem Antiflag <a href="index.php?sayfa=Antiflag_hesapla" target="_blank"><i class="fa fa-calculator"></i></a>');?>
												<?=$WMform->veri("flag", false, "text", false, "value='".$ifetch["flag"]."' onkeyup='sayi_kontrol(this)'", "İtem Flag");?>
												<?=$WMform->veri("wearflag", false, "text", false, "value='".$ifetch["wearflag"]."' onkeyup='sayi_kontrol(this)'", "İtem WearFlag");?>
												<?=$WMform->veri("gold", false, "text", false, "value='".$ifetch["gold"]."' onkeyup='sayi_kontrol(this)'", "İtem Alış Fiyatı");?>
												<?=$WMform->veri("buy", false, "text", false, "value='".$ifetch["shop_buy_price"]."' onkeyup='sayi_kontrol(this)'", "İtem Satış Fiyatı");?>
												</div>
												
												<div class="col-md-2">
												<?=$WMform->veri("lvsinir", false, "text", false, "value='".$ifetch["limittype0"]."' onkeyup='sayi_kontrol(this)'", "Level Sınırı Olsun mu ?");?>
												<?=$WMform->veri("efsun1", false, "text", false, "value='".$ifetch["applytype0"]."' onkeyup='sayi_kontrol(this)'", "Kendi Efsunu - 1");?>
												<?=$WMform->veri("efsun2", false, "text", false, "value='".$ifetch["applytype1"]."' onkeyup='sayi_kontrol(this)'", "Kendi Efsunu - 2");?>
												<?=$WMform->veri("efsun3", false, "text", false, "value='".$ifetch["applytype2"]."' onkeyup='sayi_kontrol(this)'", "Kendi Efsunu - 3");?>
												<?=$WMform->veri("taslar", false, "text", false, "value='".$ifetch["socket_pct"]."' onkeyup='sayi_kontrol(this)'", "Kaç Adet Taş Olcak");?>
												</div>
												
												<div class="col-md-1">
												<?=$WMform->veri("lv", false, "text", false, "value='".$ifetch["limitvalue0"]."' onkeyup='sayi_kontrol(this)'", "Sınır");?>
												<?=$WMform->veri("oran1", false, "text", false, "value='".$ifetch["applyvalue0"]."' onkeyup='sayi_kontrol(this)'", "Oran");?>
												<?=$WMform->veri("oran2", false, "text", false, "value='".$ifetch["applyvalue1"]."' onkeyup='sayi_kontrol(this)'", "Oran");?>
												<?=$WMform->veri("oran3", false, "text", false, "value='".$ifetch["applyvalue2"]."' onkeyup='sayi_kontrol(this)'", "Oran");?>
												</div>
												<?=$WMform->buton(11, "Kayıt Et", "primary pull-right", "save", $item, "style='margin-top:10px;'");?>
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
