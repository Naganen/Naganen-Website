<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-bottom:20px;">
  <tbody><tr>
    <th width="10%" align="center"><h5>#</h5></th>
    <th width="20%" align="center"><h5>D.E.L - T.Ö</h5></th>
    <th width="20%" align="center"><h5>H.L - T.Ö</h5></th>
    <th width="15%" align="center"><h5>Sonuç</h5></th>
    <th width="20%" align="center"><h5>Kazanan</h5></th>
    <th width="30%" align="center"><h5>Tarih</h5></th>
  </tr>
	  
    <?php $i = $limit; foreach($query as $ls){  $i++; ?>
    <tr>
      <td width="5%" align="center"><?=$i;?></td>
      <td width="20%" align="center"><a href="lonca/<?=$vt->lonca($ls["guild1"]);?>"><?=$vt->lonca($ls["guild1"]);?></a></td>
      <td width="20%" align="center"><a href="lonca/<?=$vt->lonca($ls["guild2"]);?>"><?=$vt->lonca($ls["guild2"]);?></a></td>
      <td width="10%" align="center"><?=savas_durum($ls["result1"], $ls["result2"]);?></td>
      <td width="10%" align="center"><a href="lonca/<?=$vt->lonca($ls["winner"]);?>"><?=$vt->lonca($ls["winner"]);?></a></td>
      <td width="30%" align="center"><?= $WMinf->tarih_format('j F Y , l,  H:i:s', $ls["time"]);  ?></td>
    </tr>
	<?php } ?>
    
    
    </tbody>
</table>
<div class="sayfalar">

<?php

$tema->sayfala("lonca/$lonca_isim&sayfa=", $sayfa, $sayfada, $toplam_sayfa);

?>

</div>
