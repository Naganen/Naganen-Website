<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<form action="" method="post">

<table border="0" align="center" width="100%">

	    <tr>
      <td><label>
        <textarea placeholder="Cevabınızı giriniz." rows="2" style="width:100%;" name="cevap"></textarea>
		<input type="hidden" name="crsf_token" value="<?=$ayar->sessionid;?>">
      </label></td> 
    </tr>
	
    <tr>
      <td align="right">
	  <input type="submit" name="cevap_gonder" value="Cevap Yaz"></td>
    </tr>
</table>

</form>
