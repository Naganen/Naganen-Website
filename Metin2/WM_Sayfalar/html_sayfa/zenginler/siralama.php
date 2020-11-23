<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-top:25px;">
  <tbody><tr>
    <th width="10%" align="center" class="siralama_th_bg"><h5>#</h5></th>
    <th width="30%" align="center" class="siralama_th_bg"><h5>İsim</h5></th>
    <th width="10%" align="center" class="siralama_th_bg"><h5>Level</h5></th>
    <th width="15%" align="center" class="siralama_th_bg"><h5>Sınıf</h5></th>
    <th width="20%" align="center" class="siralama_th_bg"><h5>Bayrak</h5></th>
    <th width="30%" align="center" class="siralama_th_bg"><h5>Lonca</h5></th>
	<th width="10%" align="center" class="siralama_th_bg"><h5>Durum</h5></th>
  </tr>
	  
    
	<?php 
	$i = $limit;
	foreach($query as $row){
	$i++;
	?>
	
    <tr>
      <td width="5%" align="center"><?=$i;?></td>
      <td width="30%" align="center"><a href="karakter/<?=$row["name"];?>"><?=$row["name"];?>  
	  <?php 
	  $goz_at = $db->prepare("Select id FROM onayli_karakter WHERE sid = ? && isim = ?");
	  $goz_at->execute(array(server, $row["name"]));
	  if($goz_at->rowCount()){ ?><img title="Onaylı Karakter" src="<?=$ayar->WMimg;?>onaylandi.png"></a></td><?php }
	  ?>
      <td width="10%" align="center"><?=$row["level"];?></td>
      <td width="10%" align="center"><img src="<?=$ayar->WMimg.'karekterler/'.$row["job"];?>.jpg" border="0" width="25" height="25"></td>
      <td width="10%" align="center"><img src="<?=$ayar->WMimg.'bayrak/'.$row["empire"];?>.png"></td>
      <td width="30%" align="center"><?=($row["lonca"] == "") ? '<span style="color:red">Yok<span></span>' : $row["lonca"];?></span></td>
	  <td width="10%" align="center"><?=$vt->online_kontrol($row["name"]);?></td>
    </tr>
    
	<?php 
	}
	?>
    
    </tbody></table>
<div class="sayfalar">
<?php

$tema->sayfala("zenginler?isim=$isim&karakter=$karakter&sayfa=", $sayfa, $sayfada, $toplam_sayfa);

?>

</div>
