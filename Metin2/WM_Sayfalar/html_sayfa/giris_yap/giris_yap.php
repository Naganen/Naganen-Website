<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>
<form action="" method="post">

<input type="hidden" name="kayit_token" value="<?=$ayar->sessionid;?>">

<table border="0" align="center" width="100%">
  
  	<tbody>
	<tr>
      <td align="center"><label>Kullanıcı Adı:<span style="color:darkred;text-shadow:none;">*</span><br>
      <input name="username" onkeyup="turkce_kontrol(this)"  type="text" value=""></label>
	  <input type="hidden" value="<?=$ayar->sessionid;?>" name="giris_token" />
      </td>
      </tr>
	<tr>
      <td align="center"><label>Şifre:<span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="pass" type="password">
      </label></td>
      </tr>
	      <tr>
      <td align="center">
	  <br>
	  <input type="submit" value="Giriş Yap">
	  <br><br>
	  <?php if($vt->a("kullanici_unuttum") == 1){?><a href="kullanici-adi-unuttum">Kullanıcı adını mı unuttun ?</a> <br> <br><?php } ?>
	  <a href="sifremi-unuttum">Şifreni mi unuttun ? </a>
	  </td>
	  
    </tr>

    </tbody>
	</table>
	
	</form>
