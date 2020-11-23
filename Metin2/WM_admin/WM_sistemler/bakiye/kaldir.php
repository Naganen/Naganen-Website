<?php

function bakiye_sistem_kaldir()
{

global $db, $odb;

@$kontrol = $odb->query("SELECT bakiye FROM account LIMIT 1");

if(!$kontrol)
{

return 'Sistem Bulunamadı';
		
}
else
{
	

$yapisil = $odb->query("ALTER TABLE `account` DROP `bakiye`");

if(!$yapisil)
{
	
return 'Sistem Kaldırılamadı';
	
}
else
{
	
return 'Sistem Başarıyla Kaldırıldı';
	
}
	
}

}

?>
