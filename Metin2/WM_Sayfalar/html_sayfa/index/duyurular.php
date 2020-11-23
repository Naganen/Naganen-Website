<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<table class="duyurular">
<thead>
<th>Duyurular</th>
</thead>

<tbody>

<?php
$duyurular = $db->query("SELECT konu,label,labels,tarih,seo FROM duyurular ORDER BY id DESC ");
if($duyurular->rowCount())
{
	
foreach($duyurular as $duyuru)
{
	
	
?>

<td><?=($duyuru["label"] != '') ? '<label class="label label-'.$duyuru["label"].'">'.$duyuru["labels"].'</label>' : '';?>
&nbsp; <a href="duyuru/<?=$duyuru["seo"];?>.html">>> <?=$WMinf->kisalt($duyuru["konu"], 25, '....'); ?></a> - <l class="yazi"><?=$tema->zaman_cevir($duyuru["tarih"]);?></l></td>

<?php
	
}

echo '<td><a href="duyurular">Tüm Duyuruları Gör</a></td>';	
	
}
else
{
	
echo '<td> Duyuru Eklenmemiş </td>';
	
}
?>

</tbody>

</table>
