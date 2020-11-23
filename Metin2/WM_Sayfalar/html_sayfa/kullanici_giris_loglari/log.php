<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<form action="javascript:;">


<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-top:25px;">
  <tbody>
  <tr>
    <td align="center">#</td>
    <td align="center">Durum</td>
    <td align="center">Giriş.T</td>
    <td align="center">Çıkış.T</td>
    <td align="center">Kanal</td>
    <td align="center">Oyuncu</td>
    <td align="center">IP</td>
  </tr>
	  
    
	<?php 
	$i = $limit;
	foreach($query as $row)
	{ $i++;
	?>
	<tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=($row["type"] == 'VALID') ? 'Giriş' : 'Çıkış';?></td>
    <td align="center"><?=$WMinf->tarih_format('j F Y , l,  H:i:s', $row["login_time"]);?></td>
    <td align="center"><?=$WMinf->tarih_format('j F Y , l,  H:i:s', $row["logout_time"]);?></td>
    <td align="center"><?=$row["channel"];?></td>
    <td align="center"><?=$vt->karakter($row["pid"], "name")?></td>
    <td align="center"><?=long2ip($row["ip"]);?></td>
  </tr>
	<?php
	
	}
	?>
    
    </tbody></table>
<div class="sayfalar">
<?php

$tema->sayfala("kullanici/giris-loglari?sayfa=", $sayfa, $sayfada, $toplam_sayfa);

?>

</div>

</form>
