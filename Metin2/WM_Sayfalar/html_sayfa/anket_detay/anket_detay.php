<div id="anket">


<?php if(strlen($fetch_anket["bitis_tarih"]) > 3){ ?>

<div class="bilgi"><strong>BİLGİ ! </strong> 
<?=($vt->zaman_bittimi($fetch_anket["bitis_tarih"])) ? "Anket Süresi Bitmiştir Daha Oy Kullanamazsınız" : 'Anket '.$tema->zaman_cevir($fetch_anket["bitis_tarih"], 2).' biticek ve işleme koyulcaktır';?>  </div>

<?php } ?>

<span id="question"><?=$this->konu;?></span>

<?php

foreach($secenekler as $key => $secenek)
{
	
$oy = json_decode($oylar[$key]);

if(in_array(@$_SESSION[$vt->a("isim")."username"], $oy))
{
$class = 'class="active"'; $oyla = 'vazgec'; $yazi = "VAZGEÇ";	
}
else{ $class = ''; $oyla = 'ver'; $yazi = 'OY VER'; }
		
?>	
<div><span id="oy"><?=count($oy);?></span><a <?=$class;?> href="anket/<?=$fetch_anket["seo"];?>.html?oyla=<?=$key;?>&oy=<?=$oyla;?>"><?=$yazi;?></a>
<secenek><?=$secenek; ?></secenek></div>

<?php
	
}

echo '</div></div>
';
