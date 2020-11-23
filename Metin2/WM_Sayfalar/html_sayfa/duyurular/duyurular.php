<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-top:25px;">
  <tbody><tr>
    <th width="100%" align="center"><h5><?=$vt->a("isim").' - Duyurular';?></h5></th>
  </tr>
	  
    
	<?php 
	$i = $limit;
	foreach($query as $duyuru){
	$i++;
	?>
	
    <tr>
	<td align="center"><?=($duyuru["label"] != '') ? '<label class="label label-'.$duyuru["label"].'">'.$duyuru["labels"].'</label>' : '';?>
	&nbsp; <a href="duyuru/<?=$duyuru["seo"];?>.html"><?=$WMinf->kisalt($duyuru["konu"], 25, '....'); ?></a></td>
    </tr>
    
	<?php 
	}
	?>
    
    </tbody></table>
	
	
	<div class="sayfalar">
<?php

$tema->sayfala("duyurular?sayfa=", $sayfa, $sayfada, $toplam_sayfa);

?>

</div>

