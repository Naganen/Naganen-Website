<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<form action="javascript:;">

<table border="0" align="center" width="100%">
		<tr>
		<td>				<select onchange="location = this.options[this.selectedIndex].value;" class="select">
		<option value="oyuncu-siralamasi" <?=($islem == "oyuncu_siralamasi") ? "selected" : "";?>>Oyuncu Sıralaması</option>
		<option value="lonca-siralamasi" <?=($islem == "lonca_siralamasi") ? "selected" : "";?>>Lonca Sıralaması</option>
		<option value="ban-sorgula" <?=($islem == "ban_sorgula") ? "selected" : "";?> >Ban Sorgula</option>
		<?php if($vt->a("online_liste") == 1){ ?>
		<option value="online-siralamasi" <?=($islem == "online_siralamasi") ? "selected" : "";?> >Online Sıralaması</option>
		<?php
		}
		?>
		<?php if($vt->a("zenginler") == 1){ ?>
		<option value="zenginler" <?=($islem == "zengin_siralamasi") ? "selected" : "";?> >Zenginler</option>
		<?php
		}
		?>
		</select>

</td>
	</tr>
	
</form>


<form action="" method="post">

<input type="hidden" name="sorgu_token" value="<?=$ayar->sessionid;?>">

<table border="0" align="center" width="100%">
  
  	<tbody><tr>
      <td align="center"><label>Sorgulancak Karakter Adı<br>
      <input name="sorgulancak" onkeyup="turkce_kontrol(this)" type="text" value=""></label>
      </td>
      </tr>
    <tr>
      <td align="center">
	  <br>
	  <input type="submit" name="ban_sorgula" value="Sorgula"></td>
    </tr>
    </tbody></table>
	
	</form>
	
</table>
