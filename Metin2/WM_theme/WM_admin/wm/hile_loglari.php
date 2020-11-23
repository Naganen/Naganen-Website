<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Hile Logları
</div>
<div class="panel-body">

<table class="table" id="karaktersirala">
<thead>
<tr>
<th>#</th>
<th>Oyuncu</th>
<th>Vurma Hızı</th>
<th>X Kordinatı</th>
<th>Y Kordinatı</th>
<th>Tarih</th>
</tr>
</thead>
<tbody>
<?php
$query = $odb->prepare("SELECT * FROM log.speed_hack");
$query->execute();
 $i = 0;
foreach($query as $row){ 
$i++;
?>
<tr>
<td><?=$i;?></td>
<td><?=$WMadmin->karakter($row["pid"], "name", 2);?></td>
<td><?=$row["hack_count"];?></td>
<td><?=$row["x"];?></td>
<td><?=$row["y"];?></td>
<td><?=$row["time"];?></td>
												
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
                    
                    
                    
</div>