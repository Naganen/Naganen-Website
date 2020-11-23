<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="breadcumb">
<li><a href="<?=$vt->url(0);?>"><?=$vt->a("isim");?> </a> > </li>
<li><a href="oyuncu-siralamasi">Karakterler </a> > </li>
<li><?=$isim;?><?php 
$goz_at = $db->query("Select id FROM onayli_karakter WHERE sid = '".server."' && isim = '".$isim."'");
if($goz_at->rowCount()){ ?><img title="Onaylı Karakter" src="<?=$ayar->WMimg;?>onaylandi.png"></a></td><?php }
?></li>
</div>

<br>
