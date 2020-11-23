<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<form action="javascript:;">

<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-top:25px;">
  <tbody>
	      
	<?php 
	$i = $limit;
	foreach($query as $log)
	{ $i++;
	?>
	<tr>
	<td># <?=$i;?></td>
	<td>Alınan İtem : <font color="lightgreen">  <?=$log["alinan"];?> </font></td>
	<td>Fiyat: <font color="red">  <?=$log["fiyat"];?> EP </font></td>
	<td><i class="fa fa-clock-o"></i> <?=$tema->zaman_cevir($log["tarih"]);?> </font></td>
	</tr>
	<?php
	
	}
	?>
    
    </tbody></table>
<div class="sayfalar">
<?php

$tema->sayfala("kullanici/market-loglari?sayfa=", $sayfa, $sayfada, $toplam_sayfa);

?>

</div>

</form>
