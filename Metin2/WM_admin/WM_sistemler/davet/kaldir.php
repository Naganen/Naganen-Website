<?php

function davet_sistem_kaldir()
{

global $db, $odb;

@$kontrol = $db->query("SELECT davet_durum FROM server LIMIT 1");

@$kontrol2 = $odb->query("SELECT account.davet, player.dvt, player_deleted.dvt FROM account.account INNER JOIN player.player INNER JOIN player.player_deleted LIMIT 1");

if(!$kontrol || !$kontrol2)
{

return 'Sistem Bulunamadı';
		
}
else
{
	
$yapisil = $db->query("ALTER TABLE `server` DROP `davet_ep`, DROP `davet_level`, DROP `davet_durum`");

$yapisil2 = $odb->query("ALTER TABLE `account` DROP `davet`");

$yapisil3 = $odb->query("ALTER TABLE `player`.`player` DROP `dvt`");

$yapisil4 = $odb->query("ALTER TABLE `player`.`player_deleted` DROP `dvt`");

if(!$yapisil || !$yapisil2 || !$yapisil3 || !$yapisil4)
{
	
return 'Sistem kaldırılırken eksik kaldırıldı';
	
}
else
{
	
return 'Sistem Başarıyla Kaldırıldı';
	
}
	
}

}

?>
