<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Kullanıcınıza Gelen Bildirimler Aşağıda Listelenmiştir.
</div>
<div class="panel-body">
<table class="table" id="karaktersirala">
<thead>
<tr>
<th>Bildirim</th>
<th>Tarih</th>
<th>İşlemler</th>
</tr>
</thead>
<tbody>
<?php

function href($tur, $id)
{
	
if($tur == 2)
{
	
return "index.php?sayfa=Teknik_destek&tid=".$id;
	
}
else if($tur == 3)
{
	
return "index.php?sayfa=basvurular&id=".$id;
	
}
	
}

$bildirimler = $db->prepare("SELECT * FROM bildirim WHERE sid = ? && alan = ? && alici_tur = ?");
$bildirimler->execute(array($_SESSION["server"], $_SESSION["adminisim"], 2));

foreach($bildirimler as $row){ 
?>
<tr id="bildirim-<?=$row["id"];?>">
<td><?=$row["bildirim"];?></td>
<td><?=WM_zaman_cevir($row["tarih"]);?></td>
<td>
<a href="<?=href($row["tur"], $row["olay_yeri"]);?>" target="_blank"  class="btn btn-success">
<i class="fa fa-eye"></i></a>
<a  onclick="WM_sil('bildirim_goruntule&fid=2&pid=<?=$row["id"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
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