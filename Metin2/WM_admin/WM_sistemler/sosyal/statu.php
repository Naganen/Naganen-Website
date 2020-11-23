<?php

function karakter_sosyal_statu()
{

global $odb;

@$kontrol = $odb->query("SELECT player.sosyal,player.imza, guild.sosyal FROM player.player INNER JOIN player.guild LIMIT 1");

if($kontrol)
{

return true;
		
}
else
{
	
return false;
	
}

}

?>
