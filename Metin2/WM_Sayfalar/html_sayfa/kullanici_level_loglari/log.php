<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<form action="javascript:;">

<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-top:25px;">
  <tbody>
  <tr>
    <td align="center">#</td>
    <td align="center">İsim</td>
    <td align="center">Level</td>
    <td align="center">Zaman</td>
    <td align="center">Oynayış Süresi</td>
  </tr>
	  
    
	<?php 
	$i = $limit;
	foreach($query as $row)
	{ $i++;
	?>
	<tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$row["name"];?></td>
    <td align="center"><?=$row["level"];?></td>
    <td align="center"><?=$row["time"];?></td>
    <td align="center"><?=$row["playtime"];?> dakika</td>
  </tr>
	<?php
	
	}
	?>
    
    </tbody></table>
<div class="sayfalar">
<?php

$tema->sayfala("kullanici/level-loglari?sayfa=", $sayfa, $sayfada, $toplam_sayfa);

?>

</div>

</form>
