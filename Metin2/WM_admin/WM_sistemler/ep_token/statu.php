<?php

function eptoken_sistem_statu()
{

global $db;

@$kontrol = $db->query("SELECT token FROM eptoken LIMIT 1");

@$kontrol2 = $db->query("SELECT eptoken FROM server LIMIT 1");

if(!$kontrol || !$kontrol2)
{

return false;
		
}
else
{
	
return true;
	
}

}

?>
