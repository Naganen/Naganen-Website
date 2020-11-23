<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

  <tr>
    <td width="112" align="center" class="lonca_td">Sosyal Ağ</td>
    <td width="180" align="center" class="lonca_td_2">
	
<?php if($sosyal[0] != ''){ ?>
<a href="<?=$sosyal[0];?>" target="_blank"><img src="<?=$ayar->WMimg;?>facebook.png"></a> 
<?php } ?>
<?php if($sosyal[1] != ''){ ?>
<a href="ts3server://<?=$sosyal[1];?>" target="_blank"><img src="<?=$ayar->WMimg;?>ts3.png"></a> 
<?php } ?>
<?php if($sosyal[2] != ''){ ?>
<a href="<?=$sosyal[2];?>" target="_blank"><img src="<?=$ayar->WMimg;?>rc.png"></a> 
<?php } ?>
	
	</td>
  </tr>
