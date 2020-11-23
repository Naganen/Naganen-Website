<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
BAĞIRMA LOGLARI
</div>
<div class="panel-body">
<table class="table" id="karaktersirala">
<thead>
<tr>
<th>#</th>
<th>Kanal</th>
<th>Bayrak</th>
<th>Bağırış</th>
<th>Tarih</th>
</tr>
</thead>
<tbody>
<?php
$query = $odb->prepare("SELECT * FROM log.shout_log ORDER BY time DESC");
$query->execute();
 $i = 0;
foreach($query as $row){ 
$i++;
?>
<tr>
<td><?=$i;?></td>
<td><?=$row["channel"];?></td>
<td><? if($row["channel"] == 1){ echo "Kırmızı Bayrak";}else if($row["channel"] == 2){ echo "Sarı Bayrak"; }else if($row["channel"] == 3){ echo "Mavi Bayrak"; } ?></td>
<td><?=$row["shout"];?></td>
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
