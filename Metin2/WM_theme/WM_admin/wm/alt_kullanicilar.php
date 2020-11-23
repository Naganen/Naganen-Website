                <div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Alt Kullanıcılar
</div>
<div class="panel-body">
<table class="table" id="karaktersirala">
<thead>
<tr>
<th></th>
<th>Kullanıcı</th>
<th>İşlemler</th>
</tr>
</thead>
<tbody>
<?php
$query = $db->prepare("SELECT username,id FROM users WHERE tur = ? ORDER BY id DESC");
$query->execute(array(1));
$i = 0;
foreach($query as $row){
$i++;
?>
<tr id="kullanicilar-<?=$row["id"];?>">
<td WIDTH=15>#<?=$i;?></td>
<td><?=$row["username"];?></td>
<td>
<a onclick="WM_sil('alt_kullanici_islemleri&id=<?=$row["id"];?>&formid=3')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
<a href="index.php?sayfa=alt_kullanicilar&id=<?=$row["id"];?>" target="_blank" class="btn btn-success"><i class="fa fa-eye"></i></a>
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

