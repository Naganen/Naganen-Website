<?php

function eptoken_sistem_kaldir()
{

global $db;

@$kontrol = $db->query("SELECT token FROM eptoken LIMIT 1");

@$kontrol2 = $db->query("SELECT eptoken FROM server LIMIT 1");

if(!$kontrol || !$kontrol2)
{

return 'Sistem Bulunamadı';
		
}
else
{
	
$tablosil = $db->query("DROP TABLE `eptoken`");

$tablosil = $db->query("ALTER TABLE `server` DROP `eptoken`");

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
