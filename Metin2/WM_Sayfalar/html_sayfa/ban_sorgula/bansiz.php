<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="alert alert-success" id="success">
    <a class="close" href="javascript:;" onClick="document.getElementById('success').setAttribute('style','display:none;');">×</a>
    DURUM : <strong>AKTİF</strong> -- Karakterin sahibinin hesabı aktif. Detaylar Aşağıda Listelenmiştir.
</div>

<table cellspacing="5" cellpadding="5" height="30" class="birtablo">
      <tbody>
	  <tr>
        <th width="184" class="topLine">Sicili:</th>
        <td width="495" class="tdunkel"><?=($ban_list->rowCount()) ? "Temiz Değil ( Sicili Tabloda Listelenmiştir. )" : "Temiz";?></td>
      </tr>
	  
    </tbody>
	</table>
