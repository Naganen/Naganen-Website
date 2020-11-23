<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Market itemleri
</div>
<div class="panel-body">
<table class="table" id="karaktersirala">
<thead>
<tr>
<th></th>
<th>İtem İsimi</th>
<th>Kategorisi</th>
<th>İşlemler</th>
</tr>
</thead>
<tbody>
<?php
$query = $db->prepare("SELECT market_item.isim, market_item.id, market_kategori.isim AS kategori FROM market_item LEFT JOIN market_kategori ON market_item.kid = market_kategori.id WHERE market_item.sid = ? ORDER BY market_item.id DESC");
$query->execute(array($_SESSION["server"]));
$i = 0;
foreach($query as $row){
$i++;
?>
<tr id="market_item-<?=$row["id"];?>">
<td WIDTH=15>#<?=$i;?></td>
<td><?=$row["isim"];?></td>
<td><?=$row["kategori"];?></td>
<td>
<a onclick="WM_sil('market_item_islemleri&id=<?=$row["id"];?>&formid=3')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
<a href="index.php?sayfa=market_item&id=<?=$row["id"];?>" target="_blank" class="btn btn-success"><i class="fa fa-eye"></i></a>
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
