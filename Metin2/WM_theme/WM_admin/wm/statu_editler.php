<?php $statu = @$_GET["statu"]; ?> 
<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
<?=$WMform->head("edit_islemler");?>
<?=$WMform->veri("statu", "Serverınızdaki Statu Sınırı Kaç ? ", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
<?=$WMform->buton(1, "Ara", "info", "search");?>
<?=$WMform->footer();?>
</div>
									
</div>
									
<?php
if($statu != "")
{
$query = $odb->prepare("SELECT player.*, account.login FROM player.player LEFT JOIN account.account ON player.account_id = account.id
WHERE player.ht > ? || player.st > ? || player.dx > ? || player.iq > ? LIMIT 10");
$query->execute(array($statu, $statu, $statu, $statu));
																								
if($query->rowCount())
{
$pfetch = $query->fetch(PDO::FETCH_ASSOC);
?>
<div class="panel panel-default">
<div class="panel-body">
												
												
<table class="table" id="karaktersirala">
<thead>
<tr>
<th></th>
<th>Karakter Adı</th>
<th>Level</th>
<th>Son Giriş</th>
<th>Karakter Sahibi</th>
<th>İşlemler</th>
</tr>
</thead>
<tbody>
<?php
$i = 0;
foreach($query as $row){
$i++;
if(!$row["last_play"]){$bilgi = "Hiç Girmedi";}else{$bilgi = WM_zaman_cevir($row["last_play"]);}
echo '<tr id="karakter-'.$row["id"].'">
<td WIDTH=15>#'.$i.'</td>
<td><img style="width:25px; height:20px;" src="'.WMadmintema.'img/karakterler/'.$row["job"].'.jpg"/> '.$row["name"].'</td>
<td>'.$row["level"].'</td>
<td>'.WM_zaman_cevir($row["last_play"]).'</td>
<td><a href="index.php?sayfa=kullanicilar&login='.$row["login"].'" target="_blank">'.$row["login"].'</a></td>
</td>
<td>
<a class="btn btn-info" href="index.php?sayfa=karakterler&name='.$row["name"].'" target="_blank"><i class="fa fa-eye"></i></a>
<a onClick="WM_sil(\'kullanici_karakter_sil&tur=1&id='.$row["id"].'\')" href="javascript:;" class="btn btn-danger "><i class="fa fa-trash"></i></a>
</td>
</tr>';
}
?>
</tbody>
</table>
												
</div>
</div>
												
													
<?php
													
}
else
{
	
echo '<div class="alert alert-warning">Statusu '.$statu.' aşan yok </div>';
	
}
												
}

?>
                            
</div>                        
</div>
                    


</div>
