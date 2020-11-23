<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div style="margin-bottom:10px;"></div>

<hr>

<div style="margin-bottom:20px;"></div>

<table class="indirtbl">
  <tr>
	  <th width="45%" align="center">Ep Miktarı</th>
	  <th width="40%" align="center">Fiyat</th>
	  <th width="30%" align="center">İşlemler</th>
  </tr>
  <?php 
  foreach($epfiyatlari as $epfiyat){
  ?>
  <form action="kullanici/ep-satin-al?id=<?=$epfiyat["id"];?>" method="post">
  <tr>
      <td><?=$epfiyat["ep"];?> EP</td>
      <td><?=$epfiyat["fiyat"];?> TL</td>
      <td>
	   <input name="satinal" type="submit" value="Satın Al" />
	  </td>
  </tr>
  </form>
  <?php } ?>
</table>

