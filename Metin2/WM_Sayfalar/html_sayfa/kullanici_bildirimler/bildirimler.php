<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>
<form action="javascript:;">

<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-top:25px;">
  <tbody>
  <tr>
    <td align="center">#</td>
    <td align="center">Bildirim</td>
    <td align="center">Tarih</td>
  </tr>
	  
    
	<?php 
	$i = $limit;
	foreach($query as $row)
	{ $i++;
	
	$update = $db->prepare("UPDATE bildirim SET durum = ? WHERE sid = ? && id = ?");
	
	$guncelle = $update->execute(array(2, server, $row["id"]));
	
	?>
	<tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><a href="<?=$vt->bildirim_url($row["tur"], $row["olay_yeri"])?>"><?=$row["bildirim"];?></a></td>
    <td align="center"><?=$WMinf->tarih_format('j F Y , l,  H:i:s', $row["tarih"]);?></td>
  </tr>
	<?php
	
	}
	?>
    
    </tbody></table>
<div class="sayfalar">
<?php

$tema->sayfala("kullanici/bildirimler?sayfa=", $sayfa, $sayfada, $toplam_sayfa);

?>

</div>

</form>
