<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<h2>Lonca Üyeleri (<?=$lonca_uyeleri->rowCount();?>)</h2>
<br>
<div class="lonca_uyeleri_div">
<?php foreach($lonca_uyeleri as $uye){?>
<li><a href="karakter/<?=$uye["isim"];?>"><?=$uye["isim"].' ('.$uye["lv"].' Level) ';?> <?php 
$goz_at = $db->query("Select id FROM onayli_karakter WHERE sid = '".server."' && isim = '".$uye["isim"]."'");
if($goz_at->rowCount()){ ?><img title="Onaylı Karakter" src="<?=$ayar->WMimg;?>onaylandi.png"></a></td><?php }
?></a></li>
<?php } ?>
<div class="clear"></div>
</div>
