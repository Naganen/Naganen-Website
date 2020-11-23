<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-top:25px;">
  <tbody><tr>
    <th width="10%" align="center"><h5>#</h5></th>
    <th width="30%" align="center"><h5>İsim</h5></th>
    <th width="10%" align="center"><h5>Level</h5></th>
    <th width="15%" align="center"><h5>Puan</h5></th>
    <th width="20%" align="center"><h5>Bayrak</h5></th>
    <th width="30%" align="center"><h5>Üyeler</h5></th>
	<th width="10%" align="center"><h5>Lider</h5></th>
  </tr>
	  
    
	<?php 
	$i = $limit;
	foreach($query as $row){
	$i++;
	$uyeler = $odb->prepare("SELECT COUNT(guild_member.pid) AS COUNT FROM player.guild_member WHERE guild_id = ?");
	$uyeler->execute(array($row["id"]));
	$uyeler = $uyeler->fetchColumn();
	?>
	
    <tr>
      <td width="5%" align="center"><?=$i;?></td>
      <td width="30%" align="center"><a href="lonca/<?=$row["name"];?>"><?=$row["name"];?></a></td>
      <td width="10%" align="center"><?=$row["level"];?></td>
      <td width="10%" align="center"><?=$row["ladder_point"];?></td>
      <td width="10%" align="center"><img src="<?=$ayar->WMimg.'bayrak/'.$row["empire"];?>.png"></td>
      <td width="30%" align="center"><?=$uyeler;?></span></td>
      <td width="10%" align="center"><a href="karakter/<?=$row["lider"];?>"><?=$row["lider"];?></a></td>
    </tr>
    
	<?php 
	}
	?>
    
    </tbody></table>
<div class="sayfalar">
<?php

$tema->sayfala("lonca-siralamasi?isim=$isim&sayfa=", $sayfa, $sayfada, $toplam_sayfa);

?>

</div>
