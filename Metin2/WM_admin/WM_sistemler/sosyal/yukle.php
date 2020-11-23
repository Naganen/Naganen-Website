<?php

function karakter_sosyal_yukle()
{

global $odb;

@$kontrol = $odb->query("SELECT player.sosyal,player.imza, guild.sosyal FROM player.player INNER JOIN player.guild LIMIT 1");

if(!$kontrol)
{
	
 
$ekle = $odb->query("ALTER TABLE `player`.`player` ADD `imza` TEXT CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL, 
ADD `sosyal` VARCHAR(2555) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL  DEFAULT '['','','']';");

$ekle = $odb->query("ALTER TABLE `player`.`guild` ADD `sosyal` VARCHAR(2555) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL  DEFAULT '['','','']';");

if($ekle)
{
	
return 'Sistem Kuruldu Kontrol Edin';
	
}
else
{
	
return 'Sistem kurulurken bir hata meydana geldi';
	
}

	
}
else
{
	
return 'Sistem Zaten Var';

}

}

?>
