<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>
<div class="breadcumb">
<li><a href="<?=$vt->url(0);?>"><?=$vt->a("isim");?> </a> > </li>
<li><a href="duyurular">Duyurular </a> > </li>
<li><?=$WMinf->kisalt($this->konu, 35);?> </li>
</div>

<br>
