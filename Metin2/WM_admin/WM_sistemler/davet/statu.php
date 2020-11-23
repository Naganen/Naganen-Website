<?php

function davet_statu_kontrol()
{

global $db, $odb;

@$kontrol = $db->query("SELECT davet_durum FROM server LIMIT 1");

@$kontrol2 = $odb->query("SELECT account.davet, player.dvt, player_deleted.dvt FROM account.account INNER JOIN player.player INNER JOIN player.player_deleted LIMIT 1");

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
