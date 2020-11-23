<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>
<br><br>

<table class="indirtbl">
  <tr>
	  <th width="25%" align="center">Pack</th>
	  <th width="30%" align="center">Açıklama</th>
	  <th width="20%" align="center">Boyutu</th>
	  <th width="50%" align="center">Linkler</th>
  </tr>
  <?php 
  foreach($pack_sec as $pack){
  $linkler = explode(',' ,$pack["linkler"]);
  ?>
  <tr>
      <td><?=$pack["pack"];?></td>
      <td><?=$pack["aciklama"];?></td>
      <td><?=$pack["boyut"];?></td>
      <td>
	  <?php $i = 0; foreach($linkler as $link){ $i++;?>
	  <a href="<?=$link;?>" target="_blank">Alternatif Link #<?=$i;?></a><br>
	  <?php } ?>
	  </td>
  </tr>
  <?php } ?>
</table>
