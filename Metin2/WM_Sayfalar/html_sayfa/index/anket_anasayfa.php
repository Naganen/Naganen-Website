<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>
<div class="anket_div" style="margin-bottom:20px;">
<p class="anket_soru">
<?=$fetch_anket["konu"];?></p>

<div class="inout">
<span class="in"><a href="anasayfa?oy=evet"><img src="<?=$ayar->WMimg;?>in.png" width="52" height="50" /></a><?=$onayli;?></span>
<span class="out"><a href="anasayfa?oy=hayir"><img src="<?=$ayar->WMimg;?>out.png" width="52" height="50" /></a><?=$redli;?></span>
</div>

</div>
