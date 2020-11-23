<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<form action="javascript:;">

<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-top:25px;">
  <tbody><tr>
    <th align="center">LOG</th>
    <th align="center">Tarih</th>
  </tr>
	  
    
	<?php 
	foreach($query as $row)
	{
	if($row["tur"] == 1)
	{
	echo '<tr><td>'.$row["alan"].' Adlı karaktere '.$row["ep"].' EP Gönderildi </td><td>'.$tema->zaman_cevir($row["tarih"]).'</td></tr>';
		
	}
	else if($row["tur"] == 2)
	{
		
	echo '<tr><td> Ep transfer şifresi unuttum ( Şifre değiştirildi )</td><td>'.$tema->zaman_cevir($row["tarih"]).'</td></tr>';
		
	}
	else if($row["tur"] == 3)
	{
		
	echo '<tr><td> Ep transfer şifresi değiştirildi</td><td>'.$tema->zaman_cevir($row["tarih"]).'</td></tr>';
		
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
