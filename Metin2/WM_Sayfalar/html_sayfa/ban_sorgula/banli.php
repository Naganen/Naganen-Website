<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="alert alert-danger" id="danger">
    <a class="close" href="javascript:;" onClick="document.getElementById('danger').setAttribute('style','display:none;');">×</a>
    DURUM : <strong>BANLI</strong> -- Karakterin sahibi banlanmış. Detaylar aşağıda listelenmiştir.
</div>

<table cellspacing="5" cellpadding="5" height="30" class="birtablo">
      <tbody>
	  <tr>
        <th width="184" class="topLine">Sicili:</th>
        <td width="495" class="tdunkel"><?=($ban_list->rowCount()) ? "Temiz Değil ( Sicili Tabloda Listelenmiştir. )" : "Temiz";?></td>
      </tr>
	  <tr>
        <th width="184" class="topLine">Banlanma Tarihi:</th>
        <td width="495" class="tdunkel"><?= $WMinf->tarih_format('j F Y , l,  H:i:s', $fetch["ban_sure"]);  ?> </td>
      </tr>
	  <tr>
        <th width="184" class="topLine">Ban Kalkma Tarihi:</th>
        <td width="495" class="tdunkel"><?= $WMinf->tarih_format('j F Y , l,  H:i:s', $fetch["ban_time"]);  ?> </td>
      </tr>
	  <tr>
        <th width="184" class="topLine">Banlanma Nedeni:</th>
        <td width="495" class="tdunkel"><?=$fetch["ban_neden"];?> </td>
      </tr>
	  <tr>
        <th width="184" class="topLine">Banlayan:</th>
        <td width="495" class="tdunkel"><?=$fetch["kim_banlamis"];?> </td>
      </tr>
	  
    </tbody>
	</table>
