<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<form action="" method="post">

<table border="0" align="center" width="100%">
	    <tr>
      <td align="center"><label><?=$guvenlik_sorusu;?><span style="color:darkred;text-shadow:none;">*</span><br>
		<input type="hidden" name="guvenlik_token" value="<?=$ayar->sessionid;?>">
        <input name="guvenlik_cevap" type="text">
      </label></td>
    </tr>
    <tr>
      <td align="center">
	  <br>
	  <input type="submit" name="guvenlik_sorusu_ile" value="Doğrula"></td>
    </tr>
</table>

</form>
