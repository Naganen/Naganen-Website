<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="tablo_wm son_savas">Serverımızda Olan Son Lonca Savaşı</div>
<div class="tablo_icerik son_savas_icerik">

<b><?=$lonca1;?></b> ile <b><?=$lonca2;?></b>  loncaları arasında gerçekleşen savaş, <?=savas_durum($result1, $result2, $lonca1, $lonca2);?>

</div>
