<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-4">
						
<div class="panel panel-default">
<div class="panel-body">
									

								
<?=$WMform->head("lonca_ara");?>
<div class="form-group"><label>Arama Türünü Seçin</label>
<select class="form-control" name="aramatur">
<option value="1" <?=($tur == 1) ? 'selected' : '';?>>Lonca İsim</option>
<option value="2" <?=($tur == 2) ? 'selected' : '';?>>Lonca Başkanı</option>
</select>
</div>
<?php if(@!$deger){ $yazdir = ""; }else{ $yazdir = 'value="'.$deger.'"'; } ?>
<?=$WMform->veri("deger", "Değer Giriniz", "text", false, $yazdir, 'Arama türünü seçtikten sonra arancak değeri giriniz.');?>
<?=$WMform->buton(1, " Lonca Ara", "warning btn-block pull-right", "search");?>
<?=$WMform->footer();?>
									
									
									
</div>
</div>
						
</div>   

<?php if($deger != '' && $tur != ''){ ?>

<div class="col-md-8">
						
<div class="panel panel-default">
<div class="panel-body">
									
<table class="table" id="karaktersirala">
<thead>
<tr>
<th></th>
<th>Lonca İsimi</th>
<th>Lonca Başkanı</th>
<th>Lonca Level</th>
<th></th>
</tr>
</thead>
<tbody>

<?php 
if($tur == 1)
{ 
$ara = $odb->prepare("
SELECT guild.*, player.name AS baskan FROM player.guild LEFT JOIN player.player ON guild.master = player.id WHERE guild.name LIKE ?  
GROUP BY guild.id ORDER BY guild.ladder_point DESC LIMIT 100
");
$ara->execute(array('%'.$deger.'%'));
}
else if($tur == 2)
{
	
$ara = $odb->prepare("SELECT guild.*, player.name AS baskan FROM player.guild LEFT JOIN player.player ON player.id = guild.master WHERE player.name LIKE ? LIMIT 350");
$ara->execute(array('%'.$deger.'%'));
	
}

$i = 0;

foreach($ara as $sonuc){ $i++;
?>
<tr>
<td WIDTH=15>#<?=$i;?></td>
<td><?=$sonuc["name"];?></td>
<td><a href="index.php?sayfa=karakterler&name=<?=$sonuc["baskan"];?>" target="_blank"><?=$sonuc["baskan"];?></a></td>
<td><?=$sonuc["level"];?> Level</td>
<td>
<a class="btn btn-danger" onclick="WM_sil('lonca_dagit&gid=<?=$sonuc["id"];?>')"><i class="fa fa-trash"></i></a>
<a class="btn btn-success" href="index.php?sayfa=lonca&name=<?=$sonuc["name"];?>" target="_blank"><i class="fa fa-eye"></i></a>
</td>
</tr>
<?php } ?>

</tbody>
</table>
									
									
									
</div>
</div>
						
</div>

<?php } ?>   

                     
</div>
                    
                    
                    
</div>
