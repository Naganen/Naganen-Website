<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="krallar">

<?php 

if($kral[0] != '')
{
	
$kontrol_oyuncu = $odb->prepare("SELECT player.name, player.job, player.level, player_index.empire FROM player.player INNER JOIN player.player_index 
ON player.account_id = player_index.id WHERE player.name = ?");
$kontrol_oyuncu->execute(array($kral[0]));

if($kontrol_oyuncu->rowCount())
{
	
$ofetch = $kontrol_oyuncu->fetch(PDO::FETCH_ASSOC);
		
?>

<div class="kral_oyuncu">
<span class="kral_title">» Kral Oyuncu</span>
<span class="kral_img"><img src="<?=$ayar->WMimg;?>profil/<?=$ofetch["job"];?>.png" /></span>
<span class="kral_isim">Adı: <font class="kral_adi"><?=$ofetch["name"];?></font> <?php 
$goz_at = $db->prepare("Select id FROM onayli_karakter WHERE sid = ? && isim = ?");
$goz_at->execute(array(server, $ofetch["name"]));
if($goz_at->rowCount()){ ?><img title="Onaylı Karakter" src="<?=$ayar->WMimg;?>onaylandi.png"></a></td><?php }
?></span>
<span class="kral_level">Seviye: <font class="kral_seviye"><?=$ofetch["level"];?></font></span>
<span class="kral_bayrak"><img src="<?=$ayar->WMimg;?>bayrak/<?=$ofetch["empire"];?>.png" /></span>
</div>

<?php
} 

} 

?>

<?php 

if($kral[1] != '')
{
	
$kontrol_lonca = $odb->prepare("SELECT guild.name, guild.level, player_index.empire FROM player.guild LEFT JOIN player.player ON guild.master = player.id
LEFT JOIN player.player_index ON player_index.id = player.account_id WHERE guild.name = ?
");
$kontrol_lonca->execute(array($kral[1]));

if($kontrol_lonca->rowCount())
{
	
$ll = $kontrol_lonca->fetch(PDO::FETCH_ASSOC);

?>

<div class="kral_lonca">
<span class="kral_title">» Kral Lonca</span>
<span class="kral_img"><img src="<?=$ayar->WMimg;?>king_tac.png" /></span>
<span class="kral_isim">Adı: <font class="kral_adi"><?=$ll["name"];?></font></span>
<span class="kral_level">Seviye: <font class="kral_seviye"><?=$ll["level"];?></font></span>
<span class="kral_bayrak"><img src="<?=$ayar->WMimg;?>bayrak/<?=$ll["empire"];?>.png" /></span>
</div>

<?php } }   ?>

</div>


<?php
