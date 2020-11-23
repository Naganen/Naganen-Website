<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="breadcumb">
<li><a href="<?=$vt->url(0);?>"><?=$vt->a("isim");?> </a> > </li>
<li><?=(!isset($_POST["ban_sorgula"])) ? "Ban Sorgula" : '<a href="ban-sorgula">Ban Sorgula</a> > ';?></li> 
<?=(isset($_POST["ban_sorgula"])) ? '<li>'.$_POST["sorgulancak"].'</li>' : '';?>
</div>

<br>
