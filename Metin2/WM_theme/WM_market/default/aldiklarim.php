<?php require 'header.php'; ?>
	
<section class="page container">
<div class="row">

<?php 



?>

<div class="span15">
<div class="box pattern pattern-sandstone">
<div class="box-header">
<i class="fa fa-shopping-basket fa-2x"></i>
<h5>
Marketten Satın Aldıklarım
</h5>
</div>
<div class="box-content box-table">
<table class="table">
<tbody>
<?php 
$kontrol = $db->prepare("SELECT * FROM market_log WHERE sid = ? && karakter = ? ORDER BY id DESC");
$kontrol->execute(array($_SESSION["market_server"], $_SESSION["market_user"]));

if($kontrol->rowCount())
{ $i = 0;
foreach($kontrol as $log){ $i++;
?>

<tr>
<td># <?=$i;?></td>
<td>Alınan İtem : <font color="lightgreen">  <?=$log["alinan"];?> </font></td>
<td>Fiyat: <font color="red">  <?=$log["fiyat"];?> EP </font></td>
<td><i class="fa fa-clock-o"></i> <?=zaman_cevir($log["tarih"]);?> </font></td>
<?php if($log["tur"] == 2){ ?><td><a href="kullanici/aldiklarim?id=<?=$log["id"];?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> Efsunları Gör</a></td><?php } ?>
</tr>

<?php }} else{ ?>
<tr>
<td>Marketten bir şey satın almamışsınız. </td>
</tr>
<?php } ?>
										
</tbody>
									
</table>
</div>

					
					
</div>
            
</div>



</div>

</section>
	

<?php require 'footer.php'; ?>