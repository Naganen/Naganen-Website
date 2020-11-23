<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<?php 
if($vt->uye("edurum") == 1)
{

?>

<h3><span style="color:darkgreen;text-shadow:none;"> Sistemi Kullanmayı Kabul Etmişsiniz </span> <a href="kullanici/ep-gonder-ayar?durum=2" style="color:darkred;text-shadow:none;"> Kullanmayı Reddet </a></h3>


<?php

}
else
{
	
?>

<h3><span style="color:darkred;text-shadow:none;"> Sistemi Kullanmayı Kabul Etmemişsiniz </span> <a href="kullanici/ep-gonder-ayar?durum=1" style="color:darkgreen;text-shadow:none;"> Kullanmayı Kabul Et </a></h3>

<?php

}

?>
