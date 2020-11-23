<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="breadcumb">
<li><a href="<?=$vt->url(0);?>"><?=$vt->a("isim");?> </a> > </li>
<li><a href="<?=$vt->url(5);?>">Kullanıcı </a> > </li>
<li><a href="<?=$vt->url(7);?>">Teknik Destek </a> > </li>
<li><?=$WMinf->kisalt($this->konu, 35);?> </li>
</div>

<br>
