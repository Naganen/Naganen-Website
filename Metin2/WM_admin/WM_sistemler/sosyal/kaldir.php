<?php

function karakter_sosyal_kaldir()
{

global $odb;

@$kontrol = $odb->query("SELECT player.sosyal,player.imza, guild.sosyal FROM player.player INNER JOIN player.guild LIMIT 1");

if(!$kontrol)
{

return 'Sistem Bulunamadı';
		
}
else
{
	
$tablosil = $odb->query("ALTER TABLE `player`.`player` DROP `imza`, DROP `sosyal`;");

$tablosil = $odb->query("ALTER TABLE `player`.`guild` DROP `sosyal`;");

if($tablosil)
{
	
return 'Sistem Başarıyla Kaldırıldı';
	
}
else
{
	
return 'Sistem Kaldırılırken bir hata meydana geldi';
	
}
	
}

}

?>
