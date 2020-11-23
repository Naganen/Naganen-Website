<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table cellspacing="5" cellpadding="5" height="30" class="birtablo">
      <tbody>
	  <tr>
        <th width="184" class="topLine">Hesap:</th>
        <td width="495" class="tdunkel"><?=$_SESSION[$vt->a("isim")."username"];?>  &nbsp; 
		<?php if($vt->a("kullanici_degis") != 3){?><a href="kullanici/kullanici-adi-degistir">(Değiştir)</a> <?php } ?></td>
      </tr>
      <tr>
	  </tr><tr>
        <th class="topLine">E-posta:</th>
        <td class="tdunkel"><?=$vt->uye("email");?> &nbsp; 
		<?php if($vt->a("mail_degistir") == 1){?><a href="kullanici/mail-degistir">(Değiştir)</a> <?php } ?></td>
      </tr>
      <tr>
        <th class="topLine">Krallık:</th>
        <td class="tdunkel"><?=$tema->_bayrak($vt->uye("id"));?>
				</td>
      </tr>
      <tr>
        <th class="topLine">Karekter sayısı:</th>
        <td class="tdunkel"><?=$tema->kac_karakter($_SESSION[$vt->a("isim")."userid"], 1);?>  </td>
      </tr>
      <tr>
        <th class="topLine">En son giriş:</th>
        <td class="thell"> <?= $WMinf->tarih_format('j F Y , l,  H:i:s', $vt->uye("last_play"));  ?>  </td>
      </tr>
	  <tr>
        <th class="topLine">Telefon:</th>
        <td class="tdunkel"><?=$WMinf->kisalt($vt->uye("phone1"), 7, "****");?> </td>
      </tr>
	  <tr>
        <th class="topLine">EP:</th>
        <td class="tdunkel"><b style="color:red"><?=$vt->uye("coins");?></b> | 
		<a href="kullanici/ep-satin-al">Ep Yükle</a> | 
		<?php if($ep_transfer->errorInfo()[2] == false){
		if($eptransayar[0] == 1){	?>
		<?php if($e_durum->errorInfo()[2] == false){ if(@$vt->uye("edurum") == 1){ ?>
		<a href="kullanici/ep-gonder">Ep Gönder</a> | 
		<a href="kullanici/ep-transfer-log">Loglar</a> |
		<?php }} ?>
		<?php if($eptransayar[5] == 1){ ?> <a href="kullanici/ep-gonder-ayar">Ayarlar</a>  <?php } ?>
		<?php }} ?>
		</td>
      </tr>
	  
    </tbody></table>
<a class="button" href="kullanici/bildirimler"> Bildirimler (<?=$bildirimler->rowCount();?>)</a>
<?php if($vt->a("kullanici_degis") != 3){?><a class="button" href="kullanici/kullanici-adi-degistir">Kullanıcı Adı Değiştir</a><?php } ?>
<a class="button" href="kullanici/sifre-degistir">Şifre Değiştir</a>
<?php if($vt->a("mail_degistir") == 1){?><a class="button" href="kullanici/mail-degistir">Mail Değiştir</a><?php } ?>
<a class="button" href="kullanici/karakter-silme-sifresi-degistir" ><?=($vt->a("karakter_silme_sifre") == 1 || $vt->a("karakter_silme_sifre") == 3) ? "K. Silme Ş. Değiştir" : "K. Silme Ş. İste";?></a>
<a class="button" href="kullanici/depo-sifre-degistir"><?=($vt->a("depo_sifre") == 1 || $vt->a("depo_sifre") == 3) ? "Depo Şifre Değiştir" : "Depo Şifre Gönder";?></a>
<?php if($ep_transfer->errorInfo()[2] == false){ if($e_durum->errorInfo()[2] == false){ if($vt->uye("edurum") == 1){ if($eptransayar[1] == 1){ 
if($eptransayar[4] == 1){ ?> 
<a class="button" href="kullanici/ep-gonder-sifre-degistir">Ep T. Şifresi Değiştir</a>
<?php } } } } } ?>
<a class="button" href="kullanici/bugdan-kurtar">Bugdan Kurtar</a>
<a class="button" href="<?=$vt->url(7);?>">Teknik Destek</a>
<?php if($davet_kontrol->errorInfo()[2] == false){ ?><a class="button" href="kullanici/davet-et">Arkadaşını Davet Et</a><?php }  ?>
<?php if($ep_token->errorInfo()[2] == false){ ?> <a class="button" href="kullanici/ep-tokenlerim">Ep Tokenlerim</a> <a class="button" href="kullanici/ep-token-kullan">Ep Token Kullan</a><?php } ?>
<a class="button" href="kullanici/giris-loglari">Giriş Logları</a>
<a class="button" href="kullanici/level-loglari">Level Logları</a>
<a class="button" href="kullanici/market-loglari">Marketten Aldıklarım</a>
<a class="button" href="kullanici/karakterlerim">Karakterlerim (<?=$tema->kac_karakter($_SESSION[$vt->a("isim")."userid"]);?>)</a>
<a class="button" href="kullanici/basvuru">Başvuru Yap</a>

<div style="clear:both;"></div>
