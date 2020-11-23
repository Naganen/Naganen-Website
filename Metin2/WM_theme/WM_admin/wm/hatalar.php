<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
SİTE HATALARI
</div>
<div class="panel-body">
<table class="table" id="karaktersirala">
<thead>
<tr>
<th WIDTH=10%>#</th>
<th>Hata</th>
</tr>
</thead>
<tbody>
<?php
$query = $db->prepare("SELECT icerik FROM hatalar WHERE sid = ? ORDER BY id DESC"); 
$query->execute(array($_SESSION["server"]));
$i = 0;
foreach($query as $row){ 
$i++;
?>
<tr>
<td><?=$i;?></td>
<td><?=$row["icerik"];?></td>
												
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
