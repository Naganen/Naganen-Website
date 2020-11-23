<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table class="indirtbl">
  <tr>
	  <th>Token</th>
	  <?php if($ayarlar[1] == 1){ ?><th>Token Şifresi</th> <?php } ?>
	  <th><?=($ayarlar[2] == 1) ? 'Kullanan' : 'Durum';?></th>
	  <th>İşlemler</th>
  </tr>
  <?php 
  foreach($eptokenler as $eptoken){
  ?>
  <form action="kullanici/ep-tokenlerim?id=<?=$eptoken["id"];?>&token=<?=$eptoken["token"];?>" method="post">
  <tr>
      <td ><?=$eptoken["token"];?></td>
	  <?php if($ayarlar[1] == 1){ ?><th><?=$eptoken["tokenpass"];?></th> <?php } ?>
	  <td><?php if($ayarlar[2] == 1){?> 
      <?=($eptoken["kullanan"] == "") ? 'Kullanılmamış' : '<font color="red">'.$eptoken["kullanan"].'</font>';?>
	  <?php }else { ?>
      <?=($eptoken["kullanan"] == "") ? 'Kullanılmamış' : '<font color="red">Kullanılmış</font>';?>
	  <?php } ?>
	  </td>
      <td >
  <?php if($eptoken["kullanan"] == ""){ ?><input name="kullan" type="submit" value="Kullan" /> <?php }else { 
  echo '<font color="red">Kullanıldı</font>';} ?> <?php if($ayarlar[1] == 2 && $eptoken["kullanan"] == "" ){ ?> <br> <br>
  <input name="sifregonder" type="submit" value="Şifre Gönder" /> <?php } ?>
	  </td>
  </tr>
  </form>
  <?php } ?>
</table>
