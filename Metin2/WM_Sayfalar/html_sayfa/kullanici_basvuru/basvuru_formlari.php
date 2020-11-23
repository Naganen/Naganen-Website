<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-top:25px;">
  <tbody><tr>
    <th width="100%" align="center"><h5><?=$vt->a("isim").' - Başvuru Formları';?></h5></th>
  </tr>
	  
    
	<?php 
	$i = $limit;
	foreach($query as $basvuru){
	$i++;
	?>
	
    <tr>
	<td align="center"><a href="kullanici/basvuru?detay_basvuru=<?=$basvuru["id"];?>"><?=$basvuru["konu"];?></a></td>
    </tr>
    
	<?php 
	}
	?>
    
    </tbody></table>
<div class="sayfalar">
<?php

$tema->sayfala("basvuru?sayfa=", $sayfa, $sayfada, $toplam_sayfa);

?>

</div>

