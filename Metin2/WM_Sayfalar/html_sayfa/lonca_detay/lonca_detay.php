<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table width="300" align="center" height="58" cellpadding="5" cellspacing="5" style="border:none; margin-top:15px; margin-bottom:20px;">

  <tr>
    <td width="112" align="center" class="lonca_td">Puan</td>
    <td width="180" align="center" class="lonca_td_2"><?=$ll["ladder_point"];?></td>
  </tr>
  <tr>
    <td width="112" align="center" class="lonca_td">Seviye</td>
    <td width="180" align="center" class="lonca_td_2"><?=$ll["level"];?></td>	
  </tr>
  <tr>
    <td width="112" align="center" class="lonca_td">Exp</td>
    <td width="180" align="center" class="lonca_td_2"><?=$ll["exp"];?></td>
  </tr>
  <tr>
    <td width="112" align="center" class="lonca_td">Kazanma</td>
    <td width="180" align="center" class="lonca_td_2"><?=$ll["win"];?></td>
  </tr>
  <tr>
    <td width="112" align="center" class="lonca_td">Kaybetme</td>
    <td width="180" align="center" class="lonca_td_2"><?=$ll["loss"];?></td>
  </tr>
  <tr>
    <td width="112" align="center" class="lonca_td">Beraberlik</td>
    <td width="180" align="center" class="lonca_td_2"><?=$ll["draw"];?></td>
  </tr>
  <tr>
    <td width="112" align="center" class="lonca_td">Lider</td>
    <td width="180" align="center" class="lonca_td_2" ><a href="karakter/<?=$ll["baskan"];?>"><?=$ll["baskan"];?> <?php 
$goz_at = $db->prepare("Select id FROM onayli_karakter WHERE sid = ? && isim = '?");
$goz_at->execute(array(server, $ll["baskan"]));
if($goz_at->rowCount()){ ?><img title="Onaylı Karakter" src="<?=$ayar->WMimg;?>onaylandi.png"></a></td><?php }
?></a></td>
      
  </tr>
  
  <tr>
    <td width="112" align="center"class="lonca_td">İmparatorluk</td>
    <td width="180" align="center" class="lonca_td_2"><img src="<?=$ayar->WMimg;?>bayrak2/<?=$ll["bayrak"];?>.png" /></td>
  </tr>
