<?php require 'header.php'; ?>

<script>
function goBack() {
    window.history.back();
}
</script>

	
<section class="page container">
<div class="row">

<div class="span5">
<div class="box pattern pattern-sandstone">
<div class="box-header">
<i class="fa fa-shopping-basket fa-2x"></i>
<h5>
<?=$WMinf->kisalt($fetch["alinan"], 25, '..');?>
</h5>
</div>
<div class="box-content box-table">
<table class="table">
<tbody>
<tr>
<td><a onclick="goBack()" class="btn btn-danger btn-xs" href="javascript:;"><i class="fa fa-arrow-left"></i> Geri Git</a></td>
</tr>
<tr>
<td>FİYAT : <font color="red"><i class="fa fa-money"></i> <?=$fetch["fiyat"];?></font></td>			
</tr>							
<td>TARİH : <font color="green"><i class="fa fa-clock-o"></i> <?=zaman_cevir($fetch["tarih"]);?> Satın alındı</td>
<tr>
</tr>										
</tbody>
									
</table>
</div>

					
					
</div>
            
</div>

<div class="span8">
<div class="box pattern pattern-sandstone">
<div class="box-header">
<i class="fa fa-info-circle fa-2x"></i>
<h5>
Efsunlar
</h5>
</div>
<div class="box-content box-table">
<table class="table">
<tbody>
<?php

$arrays = json_decode($fetch["log"]);

$tipler = json_decode($arrays[0]);

$efsunlar = json_decode($arrays[1]);

$taslar = json_decode($arrays[2]);

for($i = 0; $i < count($efsunlar); $i++)
{

if($efsunlar[$i] == 0) continue;

?>
<tr>
<td><font color="lightgreen"><?=$WMinf->efsun_detay($tipler[$i]);?></font> Oran : <font color="lightgreen"><?=$efsunlar[$i];?></font></td>
</tr>
<?php	
	
	
}

?>
</tbody>
</table>


</div>

					
					
</div>
            
</div>

<div class="span3">
<div class="box pattern pattern-sandstone">
<div class="box-header">
<i class="fa fa-info-circle fa-2x"></i>
<h5>
Taşlar
</h5>
</div>
<div class="box-content box-table">
<table class="table">
<tbody>
<?php

for($i = 0; $i < 3; $i++)
{

if($taslar[$i] == 0 || $taslar[$i] == 1) continue;

?>
<tr>
<td><font color="lightgreen"><?=tas($taslar[$i]);?></font></td>
</tr>
<?php	
	
	
}

?>
</tbody>
</table>


</div>

					
					
</div>
            
</div>



</div>

</section>
	

<?php require 'footer.php'; ?>