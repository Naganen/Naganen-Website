<?php

function davet_sistem_yukle()
{

global $db, $odb;

@$kontrol = $db->query("SELECT davet_durum FROM server LIMIT 1");

@$kontrol2 = $odb->query("SELECT account.davet, player.dvt, player_deleted.dvt FROM account.account INNER JOIN player.player INNER JOIN player_deleted LIMIT 1");

if(!$kontrol || !$kontrol2)
{
	
$ekle = $db->query("ALTER TABLE `server` ADD `davet_durum` INT NULL DEFAULT '1' AFTER `breadcumb`, ADD `davet_level` INT NOT NULL DEFAULT '75' AFTER `davet_durum`, ADD `davet_ep` VARCHAR(855) NOT NULL DEFAULT '1,2' AFTER `davet_level`");

$ekle2 = $odb->query("ALTER TABLE `account` ADD `davet` VARCHAR(855) NOT NULL");

$ekle3 = $odb->query("ALTER TABLE `player`.`player` ADD `dvt` INT NOT NULL DEFAULT '1'");

$ekle4 = $odb->query("ALTER TABLE `player`.`player_deleted` ADD `dvt` INT NOT NULL DEFAULT '1'");

if(!$ekle || !$ekle2 || !$ekle3 || !$ekle4)
{
	
return 'Sistem eklenirken eksik eklendi';
	
}
else
{
	
return 'Sistem Başarıyla Eklendi';
	
}
	
}
else
{
	
return 'Sistem Zaten Var';

}

}

?>
