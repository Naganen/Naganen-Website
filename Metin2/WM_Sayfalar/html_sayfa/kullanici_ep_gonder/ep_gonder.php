<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<form action="" method="post">

<table border="0" align="center" width="100%">
	    <tr>
      <td align="center"><label>Gönderilcek Karakter<span style="color:darkred;text-shadow:none;">*</span><br>
		<input type="hidden" name="crsf_token" value="<?=$ayar->sessionid;?>">
        <input name="gonderilcek" type="text">
      </label></td>
    </tr>
	    <tr>
      <td align="center"><label>Gönderilcek Ep<span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="epmiktar" type="text" onkeyup="sayi_kontrol(this)">
      </label></td>
    </tr>
	<?php if($eptransfer[1] == 1){?>
	    <tr>
      <td align="center"><label>Ep Transfer Şifreniz<span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="epass" type="password">
      </label></td>
    </tr>
	<?php if($eptransfer[3] == 1){ ?>
	    <tr>
      <td align="center"><a href="kullanici/ep-gonder-sifre-unuttum" style="color:darkred;text-shadow:none;"> Şifrenimizi mi unuttunuz ? </a><br></td>
    </tr>
	<?php }} ?>
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
	  <input type="submit" name="tokenkullan" value="Gönder"></td>
    </tr>
</table>

</form>
