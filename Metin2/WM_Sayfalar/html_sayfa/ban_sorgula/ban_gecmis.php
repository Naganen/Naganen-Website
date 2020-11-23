<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table width="100%" border="0" align="center" cellpadding="2" class="siralama" style="margin-top:25px;">
  <tbody><tr>
    <th width="10%" align="center"><h5>#</h5></th>
    <th width="10%" align="center"><h5>Karakter</h5></th>
    <th width="30%" align="center"><h5>Sebep</h5></th>
    <th width="30%" align="center"><h5>Banlanma Tarihi</h5></th>
    <th width="10%" align="center"><h5>İşlem</h5></th>
  </tr>
	  
    
	<?php 
	$i = 0;
	foreach($ban_list as $banlar){
	$i++;
	?>
	
    <tr>
      <td width="5%" align="center"><?=$i;?></td>
      <td width="10%" align="center"><?=$banlar["source"];?></span></td>
      <td width="10%" align="center"><?=$banlar["reason"];?></span></td>
      <td width="10%" align="center"><?= $WMinf->tarih_format('j F Y , l,  H:i:s', $banlar["date"]);  ?></span></td>
      <td width="10%" align="center"><?=$banlar["action"];?></span></td>
    </tr>
    
	<?php 
	}
	?>
    
    </tbody></table>
	<div style="margin-bottom:15px;"></div>
