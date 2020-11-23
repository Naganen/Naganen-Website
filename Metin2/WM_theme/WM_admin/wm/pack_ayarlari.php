<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-12">
						
						
									<div class="panel panel-default">
												<div class="panel-heading ui-draggable-handle">
												Pack ayarlarınızı yapıyorsunuz. Pack Üst Açıklamayı değiştirebilir, Pack Linkleri ekliyebilir ve düzenliyebilirsiniz.
												</div>
									<div class="panel-body">
					<?=$WMform->head("pack_ayarlari");?>
				<textarea name="pack_icerik" class="icerik"><?=$WMadmin->serverbilgi("pack_aciklama");?></textarea>
					<?=$WMform->buton(1, " Kayıt Et", "success pull-right", "save");?>
					<?=$WMform->footer();?>
					
					<div class="col-md-12" style="margin-top:10px; margin-bottom:20px;">
					<div class="alert alert-warning"><i class="fa fa-warning"></i><b> BİLGİ ! </b>
					Pack Linklerini Girerken Lütfen , ile ayarınız örnek 2 link var ise link1, link2 yazınız 1 link var ise sadece link1 yazınız. (link1, link2 ifadeleri indirme linklerinin adresleridir.)
					</div>
					</div>
					
					<div class="col-md-4">
				    <?=$WMform->head("pack_ekle");?>
					<?=$WMform->veri("sira", "Pack Sırasını Giriniz", "text", false, 'onkeyup="sayi_kontrol(this)"');?>
					<?=$WMform->veri("pack", "Pack İsmini Giriniz", "text", false);?>
					<?=$WMform->textarea("aciklama", "Pack Açıklamasını Giriniz", 2, false);?>
					<?=$WMform->veri("boyut", "Pack Boyutunu Giriniz", "text", false);?>
					<?=$WMform->textarea("linkler", "Pack Linklerini Giriniz", 2, false);?>
					<?=$WMform->buton(2, " Pack Ekle", "primary pull-right", "plus");?>
					<?=$WMform->footer();?>
					</div>
					<div class="col-md-3">
                        <div class="list-group border-bottom push-down-20">
                            <a href="index.php?sayfa=pack_ayarlari" class="list-group-item <?=(!$pack) ? "active" : '';?>">Packlar</a>
							<?php $packlar = $db->prepare("SELECT * FROM packlar WHERE sid = ? ORDER BY sira"); 
							$packlar->execute(array($_SESSION["server"]));
							foreach($packlar as $packs){?>
                            <a id="pack-<?=$packs["id"]?>" href="index.php?sayfa=pack_ayarlari&pack=<?=$packs["id"];?>" class="list-group-item <?=($pack == $packs["id"]) ? "active" : '';?>"><?=$WMinf->kisalt($packs["pack"], 25);?></a>
							<?php } ?>
                        </div>                                                
					</div>
					<?php if(isset($pack_yes)){?>
					<div class="col-md-5" id="pack-<?=$pack_fetch["id"];?>">
				    <?=$WMform->head("pack_duzenle");?>
					<?=$WMform->veri("sira", false, "text", false, "value='".$pack_fetch["sira"]."' onkeyup='sayi_kontrol(this)'", "Packın Sırasını Giriniz");?>
					<?=$WMform->veri("pack", false, "text", false, "value='".$pack_fetch["pack"]."'", "Packın İsmini Giriniz");?>
					<?=$WMform->textarea("aciklama", false, 2, false, false, "Pack Açıklamasını Giriniz", $pack_fetch["aciklama"]);?>
					<?=$WMform->veri("boyut", false, "text", false, "value='".$pack_fetch["boyut"]."'", "Pack Boyutunu Giriniz");?>
					<?=$WMform->textarea("linkler", false, 2, false, false, "Pack Linklerini Giriniz", $pack_fetch["linkler"]);?>
					<a onclick="WM_sil('pack_sil&pid=<?=$pack_fetch["id"];?>&sid=<?=$_SESSION["server"];?>')" href="javascript:;" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> Packı Sil</a>
					<?=$WMform->buton(3, " Packı Kaydet", "success pull-right", "save", $pack_fetch["id"]);?>
					<?=$WMform->footer();?>
					</div>
					<?php } ?>
					
									</div>
									</div>
                            
                        </div>                        
                    </div>
                    
                                       
                </div>
