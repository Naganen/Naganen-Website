<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="alert alert-info"><b><?=$vt->a("davet_level");?></b> level olan her <b><?=$bol[0];?></b> üye için <b><?=$bol[1];?></b> ep alabilirsiniz. </div>

<form action="" method="post">

<table cellspacing="5" cellpadding="5" height="30" class="birtablo">
      <tbody>
	  <tr>
        <th width="184" class="topLine">Davet Kodu</th>
        <td width="495" class="tdunkel"><input type="text" value="<?=($vt->uye("davet") == "") ? "Kodu Yok" : $vt->a("link").'kaydol?davet='.$vt->uye("davet");?>"></td>
      </tr>
	  <tr>
	  <th class="topLine">Kayıt Olan</th>
	  <td class="tdunkel"><?=$Kayitli;?> Kayıtlı Üye</td>
	  </tr>
	  <tr>
	  <th class="topLine"><?=$vt->a("davet_level");?> Level Olan</th>
	  <td class="tdunkel"><?=$Kayitli_basari->rowCount();?> Karakter</td>
	  </tr>
	  <tr>
	  <th class="topLine">Birikmiş Hediye</th>
	  <td class="tdunkel"><?=$hediye_toplam;?> EP </td>
	  </tr>
		
	  
    </tbody></table>
	
	<?php if($hediye_toplam != 0){?><input type="submit" name="hediyemi_al" value="Hediyemi Al"><?php } ?>
	
</form>
