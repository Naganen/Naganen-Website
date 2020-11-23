<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
CH LOGLARI
</div>
<div class="panel-body">
<table class="table" id="karaktersirala">
<thead>
<tr>
<th>#</th>
<th>CH NAME</th>
<th>Kanal</th>
<th>Tarih</th>
</tr>
</thead>
<tbody>
<?php
$query = $odb->prepare("SELECT * FROM log.bootlog ORDER BY time DESC"); 
$query->execute( );
$i = 0;
foreach($query as $row){ 
$i++;
?>
<tr>
<td><?=$i;?></td>
<td><?=$row["hostname"];?></td>
<td><?=$row["channel"];?></td>
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
