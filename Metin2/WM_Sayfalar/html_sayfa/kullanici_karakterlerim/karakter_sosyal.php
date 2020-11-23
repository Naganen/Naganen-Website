<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="karakterlerim active_karakter">
<span class="karakter_name"><?=$fetch["name"];?></span>
<a href="karakter/<?=$fetch["name"];?>" target="_blank"><img style="width:140px;" src="<?=$ayar->WMimg;?>profil/<?=$fetch["job"];?>.png" class="profil_img" width="110"></a>
</div>



<?php if($lonca_baskan->rowCount()){ $lonca = $lonca_baskan->fetch(PDO::FETCH_ASSOC); 

$lonca_sosyal = $odb->query("SELECT sosyal FROM player.guild LIMIT 1");

?>
	

<div class="karakterlerim ">
<a href="lonca/<?=$lonca["name"];?>" target="_blank"><span class="karakter_name"> Lonca : <?=$lonca["name"];?></span></a>
<?php if(1 == 1){?><br>
<a href="kullanici/karakterlerim?karakter=<?=$fetch["id"];?>&guild_id=<?=$lonca["id"];?>"><img src="<?=$ayar->WMimg;?>edit.png"></a><?php } ?>
</div>


<?php } ?>

<div class="karakterler">

<form action="" method="post">

<table border="0" align="center" width="100%">
		
	    <tr>
      <td><label><div style="margin-left:20px;">Facebook Adresinizi Giriniz </div>
		<input type="hidden" name="crsf_token" value="<?=$ayar->sessionid;?>">
        <input style="width:90%;" name="facebook" type="text" value="<?=$sosyal[0];?>">
       </label></td>
    </tr>
	    <tr>
      <td><label><div style="margin-left:20px;">Youtube Adresinizi Giriniz </div>
        <input style="width:90%;" name="youtube" type="text" value="<?=$sosyal[1];?>">
       </label></td>
    </tr>
	    <tr>
      <td><label><div style="margin-left:20px;">İnstagram Adresinizi Giriniz </div>
        <input style="width:90%;" name="instagram" type="text" value="<?=$sosyal[2];?>">
       </label></td>
    </tr>
	    <tr>
      <td><label><div style="margin-left:20px;">İmzanızı Giriniz<span style="color:darkred;text-shadow:none;">*</span> </div>
        <textarea rows="4" style="width:90%;" name="imza"><?=$fetch["imza"];?></textarea>
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
	  <input type="submit" name="sosyal_kaydet" value="Güncelle"></td>
    </tr>
</table>

</form>

</div>
