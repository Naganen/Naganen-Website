                <div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">

<?php 
$anasayfa_anket = $db->prepare("SELECT konu,onay,red,id FROM anketler WHERE tur = ? && sid = ?");
$anasayfa_anket->execute(array(1, $_SESSION["server"]));
?>

<table class="table table-actions table-striped">
<tbody>
<?php if($anasayfa_anket->rowCount()){ $anfetch = $anasayfa_anket->fetch(PDO::FETCH_ASSOC); 
$ana_onay = explode(',', $anfetch["onay"]);

$ana_red = explode(',', $anfetch["red"]);

?>
<tr id="anket-<?=$anfetch["id"];?>">
<td><b>Ana Sayfa Anketi : </b></td>
<td><b><?=$anfetch["konu"];?> </b></td>
<td><b>Beğenenler (<i class="fa fa-thumbs-o-up"></i> <?=count($ana_onay);?>)</b></td>
<td><b>Beğenmeyenler (<i class="fa fa-thumbs-o-down"></i> <?=count($ana_red);?>)</b></td>
<td>
<a class="btn btn-success" href="index.php?sayfa=anket&islem=<?=$anfetch["id"];?>" target="_blank"><i class="fa fa-eye"></i></a>
<a onclick="WM_sil('anket_sil&id=<?=$anfetch["id"];?>&fid=2')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
</td>
</tr>
<?php }else{?>
<tr>
<?=$WMform->head("anket_anasayfa");?>
<td WIDTH=20%><b><i class="fa fa-plus"></i> Ana Sayfa Anketi Ekle</b></td>
<td WIDTH=70%><?=$WMform->veri("konu", 'Ana Sayfa Anketinin Konusunu Giriniz', "text", false);?></td>
<td WIDTH=10%><?=$WMform->buton(1, "Ekle", "default", "plus");?></td>
<?=$WMform->footer();?>
</tr>
<?php } ?>
</tbody>
</table>
						
						
<div class="panel panel-default">
<div class="panel-body">

<table class="table" id="karaktersirala">
<thead>
<tr>
<th></th>
<th>Konu</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
$query = $db->prepare("SELECT konu,id FROM anketler WHERE sid = ? && tur = ? ORDER BY id DESC");
$query->execute(array($_SESSION["server"], 2));
$i = 0;
foreach($query as $row){
$i++;
?>
<tr id="anket-<?=$row["id"];?>">
<td WIDTH=15>#<?=$i;?></td>
<td><?=$WMinf->kisalt($row["konu"], 85);?></td>
<td>
<a class="btn btn-success" href="index.php?sayfa=anket&islem=<?=$row["id"];?>" target="_blank"><i class="fa fa-eye"></i></a>
<a onclick="WM_sil('anket_sil&id=<?=$row["id"];?>&fid=2')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
