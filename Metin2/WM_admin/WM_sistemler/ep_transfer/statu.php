<?php

function eptransfer_sistem_statu()
{

global $db, $odb;

@$kontrol = $db->query("SELECT id FROM eptransfer_log LIMIT 1");

@$kontrol2 = $odb->query("SELECT edurum,epass FROM account LIMIT 1");

@$kontrol3 = $db->query("SELECT eptransfer FROM server LIMIT 1");

if(!$kontrol || !$kontrol2 || !$kontrol3)
{

return false;
		
}
else
{
	
return true;
	
}

}

?>
