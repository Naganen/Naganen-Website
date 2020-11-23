<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="destek">


<form action="" method="post">

<table border="0" align="center" width="100%">

		<tr>
        <th class="topLine">Destek Departmanı : <b><?=$kategori_detay["isim"];?></b></th>
		
		</tr>
		
	    <tr>
      <td><label><div style="margin-left:20px;">Teknik Destek Konusu<span style="color:darkred;text-shadow:none;">*</span> </div>
		<input type="hidden" name="crsf_token" value="<?=$ayar->sessionid;?>">
        <input style="width:90%;" name="konu" type="text">
       </label></td>
    </tr>
	    <tr>
      <td><label><div style="margin-left:20px;">Destek İçeriği<span style="color:darkred;text-shadow:none;">*</span> </div>
        <textarea rows="4" style="width:90%;" name="icerik"><?=$kategori_detay["value"];?></textarea>
      </label></td> 
    </tr>
		<tr>
		
		<td align="center">
		<img src="<?=WMcaptcha;?>" id="captcha_code" /> <a href="javascript:;" onClick="refreshCaptcha();"><img src="<?=$ayar->WMimg;?>refresh.png" /></a></td>
		
	</tr>
	
	
     <tr>
      <td align="center"><label>Güvenlik Kodu:<span style="color:darkred;text-shadow:none;">*</span><br><br>
          <input name="captcha_code" type="text" autocomplete="off">
          </label></td>
    </tr>
    <tr>
      <td align="center">
	  <input type="submit" name="talepgonder" value="Oluştur"></td>
    </tr>
</table>

</form>

</div>

