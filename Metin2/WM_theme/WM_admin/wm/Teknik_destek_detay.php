<?php

$ticket = $db->prepare("SELECT * FROM destek_cevap WHERE tid = ? && sid = ?");
$ticket->execute(array($tid, $_SESSION["server"]));

$Tickets = $db->prepare("SELECT acan, icerik, id FROM destek WHERE sid = ? && (durum = ? || durum = ?)");
$Tickets->execute(array($_SESSION["server"], 0, 2));

$kullanicilar = $db->prepare("SELECT id,gm FROM users WHERE id != ? && server_yetki LIKE ? && yetki LIKE ?");
$kullanicilar->execute(array($_SESSION["adminid"], '%'.$_SESSION["server"].'%', '%r%'));

$kategori_fetch = $db->prepare("SELECT yetkililer FROM destek_kategori WHERE sid = ? && id = ?");
$kategori_fetch->execute(array($_SESSION["server"], $tfetch["kid"]));
$kategori_fetch = $kategori_fetch->fetch(PDO::FETCH_ASSOC);

$yonlenen_array = json_decode($tfetch["yonlenen"]);

$yetkililer = json_decode($kategori_fetch["yetkililer"]);

if(($yonetim_tur == 2) || (in_array($_SESSION["adminid"], $yetkililer)))
{

?>
<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">

<div class="panel">

<div class="panel-body">
<span class="fa fa-comments"></span> <?=$tfetch["konu"];?> <?=$WMinf->destek_durum($tfetch["durum"]);?>

                        <div class="pull-right">

                             <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Ekip Yönlendir <i class="caret"></i></button>
                                <ul class="dropdown-menu" role="menu">
								<?php
								foreach($kullanicilar as $kullanici){
								if(in_array($kullanici["gm"], $yonlenen_array)) continue;
								?>
                                <li><a onclick="WM_click('teknik_destek_yonlendir&tid=<?=$tid;?>&uid=<?=$kullanici["id"];?>')" href="javascript:;"> <?=$kullanici["gm"];?></a></li>
                                <?php } ?>
                                 </ul>
                                                </div>
						
                             <div class="btn-group">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Destek Türü <i class="caret"></i></button>
                                <ul class="dropdown-menu" role="menu">
								<?php $kategoriler = $db->prepare("SELECT * FROM destek_kategori WHERE sid = ? ORDER BY id DESC");
								$kategoriler->execute(array($_SESSION["server"]));
								foreach($kategoriler as $kategori){
									
									
									
								?>
                                <li><a onclick="WM_click('teknik_destek_tur_degis&tid=<?=$tid;?>&sid=<?=$_SESSION["server"];?>&durum=<?=$kategori["id"];?>')" href="javascript:;"> <?=$kategori["isim"];?></a></li>
                                <?php } ?>
								</ul>
                                                </div>
                             <div class="btn-group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">İşlemler <i class="caret"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                <li><a onclick="WM_click('teknik_destek_durum_degis&tid=<?=$tid;?>&sid=<?=$_SESSION["server"];?>&durum=370')" href="javascript:;"><i class="fa fa-check"></i> Açık</a></li>
                                <li><a onclick="WM_click('teknik_destek_durum_degis&tid=<?=$tid;?>&sid=<?=$_SESSION["server"];?>&durum=1')" href="javascript:;"><i class="fa fa-send"></i> Yanıtlandı</a></li>
                                <li><a onclick="WM_click('teknik_destek_durum_degis&tid=<?=$tid;?>&sid=<?=$_SESSION["server"];?>&durum=2')" href="javascript:;"><i class="fa fa-send"></i> Oyuncu Yanıtı</a></li>
                                <li><a onclick="WM_click('teknik_destek_durum_degis&tid=<?=$tid;?>&sid=<?=$_SESSION["server"];?>&durum=3')" href="javascript:;"><i class="fa fa-info-circle"></i> Sonuçlandı</a></li>
                                <li><a onclick="WM_click('teknik_destek_durum_degis&tid=<?=$tid;?>&sid=<?=$_SESSION["server"];?>&durum=4')" href="javascript:;"><i class="fa fa-lock"></i> Kapandı</a></li>
                                <li><a onclick="WM_click('teknik_destek_durum_degis&tid=<?=$tid;?>&sid=<?=$_SESSION["server"];?>&durum=5')" href="javascript:;"><i class="fa fa-check"></i> Ödeme Onaylandı</a></li>
                                <li><a onclick="WM_click('teknik_destek_durum_degis&tid=<?=$tid;?>&sid=<?=$_SESSION["server"];?>&durum=6')" href="javascript:;"><i class="fa fa-close"></i> Ödeme Onaylanmadı</a></li>
                                 </ul>
                                                </div>
												
												
							<a onclick="WM_sil('teknik_destek_sil&tid=<?=$tid;?>&sid=<?=$_SESSION["server"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i> Talebi Sil</a>
                        </div>                           

</div>

</div>

<div class="col-md-9">


<div class="box box-primary">

<div class="box-header">
Açan Kişi : <?=$tfetch["acan"];?> <span class="pull-right"><i class="fa fa-clock-o"></i> <?=WM_zaman_cevir($tfetch["tarih"]);?></span>
 </div>

 <div class="box-body">
 
               <?=$tfetch["icerik"];?>
 

 </li>
 
 </div>

 
</div>
	
						<?php foreach($ticket as $tic){ 
						if($tic["ckisi"] == 2){$labell = 'danger'; $ico = 'user-secret';}else{$labell = 'default'; $ico = 'user';}
						?>	
						
<div class="box box-<?=$labell;?>">

<div class="box-header">
Cevaplayan : <i class="fa fa-<?=$ico;?>"></i><?=$tic["cevaplayan"];?> <span class="pull-right"><i class="fa fa-clock-o"></i> <?=WM_zaman_cevir($tic["tarih"]);?></span>
<hr>
 </div>

 <div class="box-body">
 
                <?=html_entity_decode($tic["cevap"]);?>
 

 </li>
 
 </div>

 
</div>
							
							
						<?php  } ?>
						

              						<?php 
												
						if($tfetch["durum"] != 3 && $tfetch["durum"] != 4 && $tfetch["durum"] != 5 ){ ?>
                        
                        <div class="panel panel-default push-up-10">
                            <div class="panel-body panel-body-search">
								<?=$WMform->head("destek_cevap_yaz");?>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cevap" placeholder="Cevabınızı buraya yazınız."/>
                                    <div class="input-group-btn">
                                        <?=$WMform->buton(11, "Gönder", "default", "send", $tid);?>
                                    </div>
									<?=$WMform->footer();?>
                                </div>
                            </div>
                        </div>
						<?php }?>




</div>

<div class="col-md-3">                        <div class="list-group">
							<h4> Cevap Bekleyenler</h4>
							<?php foreach($Tickets as $tickets){
							if($tickets["id"] == $tid) continue;	?>
                            <a href="index.php?sayfa=Teknik_destek&tid=<?=$tickets["id"];?>" class="list-group-item">         
                                <div class="list-group-status label-success"></div>
                                <span class="contacts-title"><?=$tickets["acan"];?></span>
                                <p><?=$WMinf->kisalt($tickets["icerik"], 45);?></p>
                            </a>
							<?php } ?>
                        </div>
</div>

</div></div></div>

<?php 
}else
{
		
require_once WMadmintema.'yetki_yok.php';
	
} 

?>
