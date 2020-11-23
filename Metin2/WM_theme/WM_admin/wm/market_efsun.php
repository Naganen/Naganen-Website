<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Market Efsunları
</div>
<div class="panel-body">
<table class="table" id="karaktersirala">
<thead>
<tr>
<th></th>
<th>Efsun İsimi</th>
<th>Efsun Oranı</th>
<th>Efsun ID</th>
<th>İşlemler</th>
</tr>
</thead>
<tbody>
<?php
$query = $db->prepare("SELECT * FROM market_efsun WHERE sid = ? ORDER BY id DESC");
$query->execute(array($_SESSION["server"]));
$i = 0;
foreach($query as $row){
$i++;
?>
<tr id="market_efsun-<?=$row["id"];?>">
<td WIDTH=15>#<?=$i;?></td>
<td><?=$row["isim"];?></td>
<td><?=$row["oran"];?></td>
<td><?=$row["efsunid"];?></td>
<td>
<a onclick="WM_sil('market_efsun_islemleri&id=<?=$row["id"];?>&formid=3')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
<a href="index.php?sayfa=market_efsun&id=<?=$row["id"];?>" target="_blank" class="btn btn-success"><i class="fa fa-eye"></i></a>
</td>
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
