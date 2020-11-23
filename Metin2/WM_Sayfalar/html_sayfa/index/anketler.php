<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table class="duyurular">
<thead>
<th>Anketler</th>
</thead>

<tbody>

<?php
$anketler = $db->query("SELECT konu,seo,tarih FROM anketler WHERE tur = '2' && sid = '".server."' ORDER BY id DESC ");
if($anketler->rowCount())
{
	
foreach($anketler as $anket)
{
	
	
?>

<td><a href="anket/<?=$anket["seo"];?>.html">>> <?=$WMinf->kisalt($anket["konu"], 75, '....'); ?></a> - <l class="yazi"><?=$tema->zaman_cevir($anket["tarih"]);?></l></td>

<?php
	
}
	
}
else
{
	
echo '<td> Anket Eklenmemiş </td>';
	
}
?>

</tbody>

</table>
