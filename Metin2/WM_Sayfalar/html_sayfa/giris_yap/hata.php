<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>
<div class="alert alert-danger" id="danger">
    <a class="close" href="javascript:;" onClick="document.getElementById('danger').setAttribute('style','display:none;');">×</a>
    <strong>Hata !</strong> Zaten giriş yapılmış Kullanıcı paneline yönlendiriliyorsunuz.
</div>

<meta http-equiv="refresh" content="2;URL=<?=$vt->url(5);?>">
