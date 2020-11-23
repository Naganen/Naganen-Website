<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<form action="" method="post">

<table border="0" align="center" width="100%">
	    <tr>
      <td align="center"><label>Kullanıcı Adınızı Giriniz<span style="color:darkred;text-shadow:none;">*</span><br>
		<input type="hidden" name="sifre_unuttum_token" value="<?=$ayar->sessionid;?>">
        <input name="kullanici" type="text">
      </label></td>
    </tr>
	    <tr>
      <td align="center"><label>E-mail Adresinizi Giriniz<span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="email" type="text">
      </label></td>
    </tr>
		<tr>
		<td align="center">
		<img src="<?=WMcaptcha;?>" id="captcha_code" /> <a href="javascript:;" onClick="refreshCaptcha();"><img src="<?=$ayar->WMimg;?>refresh.png" /></a></td>
	</tr>
	
	
     <tr>
      <td align="center"><label>Güvenlik Kodu:<span style="color:darkred;text-shadow:none;">*</span><br><br>
          <input name="captcha_code" type="text" autocomplete="off"><br><br>
          </label></td>
    </tr>
    <tr>
      <td align="center">
	  <br>
	  <input type="submit" name="sifre_unuttum" value="Gönder"></td>
    </tr>
</table>

</form>
