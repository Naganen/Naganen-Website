<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table cellspacing="5" cellpadding="5" height="30" class="birtablo">
      <tbody>
	  <tr>
        <th width="184" class="topLine">Konu :</th>
        <td width="495" class="tdunkel"><?=$this->konu;?>  &nbsp; <?=$WMinf->destek_durum($fetch["durum"], 2);?> </tr>
      <tr>
<?php 
$yonlenen = json_decode($fetch["yonlenen"]);

if(count($yonlenen) != 0){

 ?>
	  <tr>
        <th width="184" class="topLine">Yönlendirilen Yetkililer :</th>
        <td width="495" class="tdunkel"><?php 
		if(count($yonlenen) == 1){
		echo $yonlenen[0];
		}else
		{
		$tum_yonlenenler = "";
		for($j = 0; $j < count($yonlenen); $j++)
		{
		$tum_yonlenenler .= $yonlenen[$j].",";	
		}
		echo substr($tum_yonlenenler, 0, -1);
		};?> </tr>
      <tr>
<?php } ?>
	  </tr>
	  
    </tbody></table>
