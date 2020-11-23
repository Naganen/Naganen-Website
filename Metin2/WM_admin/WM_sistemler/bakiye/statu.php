<?php

function bakiye_statu_kontrol()
{

global $db, $odb;

@$kontrol = $odb->query("SELECT bakiye FROM account LIMIT 1");

if(!$kontrol)
{

return false;
		
}
else
{
	
return true;
	
}

}

?>
