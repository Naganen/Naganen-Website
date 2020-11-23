<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="breadcumb">
<li><a href="<?=$vt->url(0);?>"><?=$vt->a("isim");?> </a> > </li>
<li><a href="<?=$vt->url(5);?>">Kullanıcı</a> > </li>
<li><a href="kullanici/karakterlerim">Karakterlerim</a> > </li>
<li><?=$fetch["name"];?> </li>
</div>

<br>
