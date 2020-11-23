<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
GM LOGLARI
</div>
<div class="panel-body">

<table class="table" id="karaktersirala">
<thead>
<tr>
<th>#</th>
<th>GM</th>
<th>Kod</th>
<th>Kanal</th>
<th>IP</th>
<th>Tarih</th>
</tr>
</thead>
<tbody>
<?php
$query = $odb->prepare("SELECT * FROM log.command_log ORDER BY date DESC");
$query->execute(array());
 $i = 0;
foreach($query as $row){ 
$i++;
?>
<tr>
<td><?=$i;?></td>
<td><?=$row["username"];?></td>
<td><?=$row["command"];?></td>
<td><?=$row["port"];?></td>
<td><?=$row["ip"];?></td>
<td><?=WM_zaman_cevir($row["date"]);?></td>
												
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