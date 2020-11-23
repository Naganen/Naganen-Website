<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="karakterlerim">
<span class="karakter_name"><?=$karakter_fetch["name"];?> <?php 
$goz_at = $db->prepare("Select id FROM onayli_karakter WHERE sid = ? && isim = ?");
$goz_at->execute(array(server, $karakter_fetch["name"]));
if($goz_at->rowCount()){ ?><img title="Onaylı Karakter" src="<?=$ayar->WMimg;?>onaylandi.png"></a></td><?php }
?></span>
<a href="karakter/<?=$karakter_fetch["name"];?>" target="_blank"><img style="width:140px;" src="<?=$ayar->WMimg;?>profil/<?=$karakter_fetch["job"];?>.png" class="profil_img" width="110"></a>
<?php if($sosyal_kontrol){?><br>
<a href="kullanici/karakterlerim?karakter_duzenle=<?=$karakter_fetch["id"];?>"><img src="<?=$ayar->WMimg;?>edit.png"></a><?php } ?>
</div>




<div class="karakterlerim active_karakter">
<a href="lonca/<?=$lonca_fetch["name"];?>" target="_blank"><span class="karakter_name"> Lonca : <?=$lonca_fetch["name"];?></span></a>
</div>



<div class="karakterler">

<form action="" method="post">

<table border="0" align="center" width="100%">
		
	    <tr>
      <td><label><div style="margin-left:20px;">Facebook Adresinizi Giriniz </div>
		<input type="hidden" name="crsf_token" value="<?=$ayar->sessionid;?>">
        <input style="width:90%;" name="facebook" type="text" value="<?=$sosyal_lonca[0];?>">
       </label></td>
    </tr>
	    <tr>
      <td><label><div style="margin-left:20px;">Raidcall Adresinizi Giriniz </div>
        <input style="width:90%;" name="raidcall" type="text" value="<?=$sosyal_lonca[1];?>">
       </label></td>
    </tr>
	    <tr>
      <td><label><div style="margin-left:20px;">Teamspeak3 Adresinizi Giriniz </div>
        <input style="width:90%;" name="teamspeak3" type="text" value="<?=$sosyal_lonca[2];?>">
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
	  <input type="submit" name="lonca_sosyal_kaydet" value="Güncelle"></td>
    </tr>
</table>

</form>

</div>
