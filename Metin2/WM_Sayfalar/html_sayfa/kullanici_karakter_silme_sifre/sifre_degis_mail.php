<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<form action="" method="post">

<table border="0" align="center" width="100%">
	    <tr>
      <td align="center"><label>Karakter Silme Şifrenizi Giriniz<span style="color:darkred;text-shadow:none;">*</span><br>
		<input type="hidden" name="sifre_degis_token" value="<?=$ayar->sessionid;?>">
        <input name="pass_karakter" maxlength="7" onkeyup="sayi_kontrol(this)" type="password">
      </label></td>
    </tr>
	    <tr>
      <td align="center"><label>Karakter Silme Şifrenizi Tekrar Giriniz:<span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="pass_karakter_retry" maxlength="7" onkeyup="sayi_kontrol(this)" type="password">
      </label></td>
    </tr>
		<tr>
		<td align="center">
		<img src="<?=WMcaptcha;?>" id="captcha_code" /> <a href="javascript:;" onClick="refreshCaptcha();"><img src="<?=$ayar->WMimg;?>refresh.png" /></a></td>
	</tr>
	
	
     <tr>
      <td align="center"><label>Güvenlik Kodu:<span style="color:darkred;text-shadow:none;">*</span><br><br>
          <input name="karakter_captcha_code" type="text" autocomplete="off"><br><br>
          </label></td>
    </tr>
    <tr>
      <td align="center">
	  <br>
	  <input type="submit" name="sifre_degistir_karakter_mail" value="Değiştir"></td>
    </tr>
</table>

</form>
