<?php

class server
{
	
public function lonca($limit = 5)
{
global $odb, $ayar;

$query = $odb->query("SELECT guild.name, player.name AS lider, player_index.empire AS bayrak, guild.level, guild.ladder_point,guild.id FROM player.guild
	LEFT JOIN player.player
	ON guild.master = player.id
	LEFT JOIN player.player_index
	ON player_index.id = player.account_id
	ORDER BY ladder_point DESC
	LIMIT 0, $limit");

$i = 0;

foreach($query as $row)
{
$i++;
?>
<tr class="c1">
<td class="index"><?=$i;?></td>
<td class="pname"><a href="lonca/<?=$row["name"];?>"><?=$row["name"];?></td>
<td class="score"><img src="<?=$ayar->WMimg;?>bayrak/<?=$row["bayrak"];?>.jpg"></td>
<td class="score"><?=$row["ladder_point"];?></td>
</tr>	

<?php	
}

}

public function karakter($limit = 5)
{
global $odb, $ayar, $db;

$query = $odb->query("SELECT player.id,player.name,player.job,player.level,player.exp,player_index.empire,guild.name AS guild_name 
	  FROM player.player 
	  LEFT JOIN player.player_index 
	  ON player_index.id=player.account_id 
	  LEFT JOIN player.guild_member 
	  ON guild_member.pid=player.id 
	  LEFT JOIN player.guild 
	  ON guild.id=guild_member.guild_id
	  INNER JOIN account.account 
	  ON account.id=player.account_id
	  WHERE player.name NOT LIKE '[%]%' AND account.status!='BLOCK' ORDER BY player.level DESC, player.playtime DESC LIMIT 0,$limit");

$i = 0;

foreach($query as $row)
{
$i++;
?>
<tr class="c1">
<td class="index"><?=$i;?></td>
<td class="pname"><a href="karakter/<?=$row["name"];?>"><?=$row["name"];?> <?php 
$goz_at = $db->query("Select id FROM onayli_karakter WHERE sid = '".server."' && isim = '".$row["name"]."'");
if($goz_at->rowCount()){ ?><img title="Onaylı Karakter" src="<?=$ayar->WMimg;?>onaylandi.png"></a></td><?php }
?>
<td class="score"><img src="<?=$ayar->WMimg;?>bayrak/<?=$row["empire"];?>.jpg"></td>
<td class="score"><?=$row["level"];?></td>
</tr>	
<?php	
}

}
	
}

?>