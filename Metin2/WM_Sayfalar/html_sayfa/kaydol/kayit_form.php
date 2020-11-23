<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<script>
function refreshCaptcha() {
	$("img#captcha_code").attr('src','<?=WMcaptcha;?>');
}
</script>


<form action="" method="post">

<input type="hidden" name="kayit_token" value="<?=$ayar->sessionid;?>">

<table border="0" align="center" width="100%">
  
  	<tbody><tr>
      <td align="center"><label>Adınız ve Soyadınız:<br>
      <input name="real_name" onkeyup="turkce_kontrol(this)" type="text" value=""></label>
      </td>
      </tr>
    <tr>
      <td align="center"><label>Kullanıcı Adı:<span style="color:darkred;text-shadow:none;">*</span><br>
      <input name="username" onkeyup="turkce_kontrol(this)"  type="text" value=""></label>
      </td>
      </tr>
    <tr>
    </tr><tr>
      <td align="center"><label>Şifre:<span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="pass" type="password">
      </label></td>
      </tr>
    <tr>
      <td align="center"><label>Şifre (Tekrar):<span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="pass_retry" type="password">
      </label></td>
    </tr>
    	<tr>
      <td align="center"><label>Karakter Silme Kodu:<span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="social_id" onkeyup="sayi_kontrol(this)" maxlength="7" type="text">
      </label></td>
    </tr>
		
	    <tr>
      <td align="center"><label>Telefon Numarası:<span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="phone_number" onkeyup="sayi_kontrol(this)" maxlength="11" type="text">
      </label></td>
    </tr>
		
    <tr>
      <td align="center"><label>E-Posta:<span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="eposta" type="text" value="">
      </label></td>
    </tr>
	
	
	<?php if($vt->a("guvenlik") == 1){ ?>
    <tr>
      <td align="center"><label>Güvenlik Sorusu:<span style="color:darkred;text-shadow:none;">*</span><br>
        	<select size="1" name="guvenlik_soru" class="txt">
		<option value="1">En iyi arkadaşım</option>
		<option value="2">Doğum yerim</option>
		<option value="3">Dedemin mesleği</option>
		<option value="4">Favorori itemim</option>
		<option value="5">En sevdiğim şehir</option>

		</select>

      </label></td>
    </tr>
	
    <tr>
      <td align="center"><label>Soru Cevabı:<span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="guvenlik_cevap" type="text" value="">
      </label></td>
    </tr>
	
	<?php } ?>
		
		<tr>
		<td align="center">
		<img src="<?=WMcaptcha;?>" id="captcha_code" /> <a href="javascript:;" onClick="refreshCaptcha();"><img src="<?=$ayar->WMimg;?>refresh.png" /></a></td>
	</tr>
	
	
     <tr>
      <td align="center"><label>Güvenlik Kodu:<span style="color:darkred;text-shadow:none;">*</span><br><br>
          <input name="captcha_code" type="text" autocomplete="off"><br><br>
          </label></td>
    </tr>
	<?php if(isset($sistem_true)){ ?>
	
	<?php if(@$eptransfer[1] == 1){ ?>
	
    <tr>
      <td align="center"><label>Ep Transfer Şifrenizi Giriniz <span style="color:darkred;text-shadow:none;">*</span><br>
        <input name="epass" type="password" value="">
      </label></td>
    </tr>
	
	<?php } ?>
	
     <tr>
      <td align="center">
        <input type="checkbox" name="eptransfer" id="checkbox" value="1" style="float:none; margin:0; padding:0; height: 15px;">
		<label for="checkbox">
        <strong>Ep Transfer Sistemi </strong> 'ni kullanmak istemiyorum </label><br></td>
    </tr>
	<?php } ?>
	
     <tr>
      <td align="center">
        <input type="checkbox" name="sozlesme" id="checkbox" value="1" checked style="float:none; margin:0; padding:0; height: 15px;">
		<label for="checkbox">
        <strong><a href="<?=$WMclass->ayar("base");?>uyelik_sozlesmesi.php" target="_blank" class="uyesozlesmelink">Üyelik ve Hizmet Sözleşmesi</a></strong> 'ni okudum ve kabul ediyorum.</label><br></td>
    </tr>
	
    <tr>
      <td align="center">
	  <br>
	  <input type="submit" value="Kayıt ol"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    </tbody></table>
	
	</form>
