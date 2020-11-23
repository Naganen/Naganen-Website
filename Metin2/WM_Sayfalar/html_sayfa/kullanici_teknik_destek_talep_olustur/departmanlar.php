<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<?php foreach($query as $row){
?>
<a href="kullanici/teknik-destek-talep-olustur?departman=<?=$row["id"];?>" class="button"><?=$row["isim"];?></a>

<?php } ?>
