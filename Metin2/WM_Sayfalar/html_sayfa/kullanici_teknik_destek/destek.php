<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<form action="javascript:;">

<a class="button" href="kullanici/teknik-destek-talep-olustur"> Talep Oluştur </a>
<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-top:25px;">
  <tbody><tr>
    <th align="center">Konu</th>
    <th align="center">Departman</th>
    <th align="center">Durum</th>
    <th align="center"></th>
  </tr>
	  
    
	<?php
	if($toplam_talep != 0)
	{
	foreach($query as $row)
	{
		
	?>
	<tr>
	<td><?=$WMinf->kisalt($row["konu"], 15);?></td>
	<td><?=$row["kategori"];?></td>
	<td><?=$WMinf->destek_durum($row["durum"], 2);?></td>
	<td><a href="kullanici/teknik-destek-detay?id=<?=$row["id"];?>">Gör </a></td>
	</tr>
	<?php	
	
	}
	
	}
	?>
    
    </tbody></table>
<div class="sayfalar">
<?php

$tema->sayfala("kullanici/ep-transfer-log?sayfa=", $sayfa, $sayfada, $toplam_sayfa);

?>

</div>

</form>
