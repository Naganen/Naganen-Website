<?php

function eptransfer_sistem_kaldir()
{

global $db, $odb;

@$kontrol = $db->query("SELECT id FROM eptransfer_log LIMIT 1");

@$kontrol2 = $odb->query("SELECT edurum,epass FROM account LIMIT 1");

@$kontrol3 = $db->query("SELECT eptransfer FROM server LIMIT 1");

if(!$kontrol || !$kontrol2 || !$kontrol3)
{

return 'Sistem Bulunamadı';
		
}
else
{
	
$tablosil = $odb->query("ALTER TABLE `account` DROP `edurum`, DROP `epass`;");

$tablosil = $db->query("ALTER TABLE `server` DROP `eptransfer`;");

$tablosil = $db->query("DROP TABLE `eptransfer_log`");

if(!$tablosil)
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
