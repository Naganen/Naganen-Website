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
		<td><input name="arancak" <?=($isim == "") ? 'placeholder="Arancak Lonca Adı"' : 'value="'.$isim.'"';?> type="text" /></td>
		<td><input type="submit" value="Ara" onclick="lonca_ara()" /></td>
	</tr>
	
</form>
	
</table>
