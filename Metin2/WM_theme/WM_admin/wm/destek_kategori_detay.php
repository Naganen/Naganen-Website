<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
<b><?=$fetch["isim"];?></b> Adlı destek kategorisi
												
</div>
<div class="panel-body">

<div class="col-md-8">
									
<?=$WMform->head("destek_kategori");?>
<?=$WMform->veri("isim", false, "text", false, 'value="'.$fetch["isim"].'"', "* Destek Departmanı İsmi ");?>
<div class="form-group"><label>Oto Doldurma</label><textarea rows="10" name="value" class="form-control"><?=$fetch["value"];?></textarea></div>
<?=$WMform->buton(3, " Kategori Düzenle", "default pull-right", "save", $id);?>
<?=$WMform->footer();?>
</div>

<div class="col-md-3">
<div class="form-group col-md-12"><code><i class="fa fa-user"></i> Yetkili İşlemleri</code></div>
<?$WMform->head("destek_kategori");?>
<div class="col-md-10">

<?php

$query = $db->prepare("SELECT id FROM users WHERE server_yetki LIKE ? && yetki LIKE ?");
$query->execute(array('%'.$_SESSION["server"].'%', '%r%'));

if($query->rowCount())
{
	
$yetkili_array = json_decode($fetch["yetkililer"]);

?>

<select class="form-control" name="yetkili">
<?php

foreach($query as $row)
{
	
if(in_array($row["id"], $yetkili_array)) continue;
												
echo '<option value="'.$row["id"].'">'.$WMadmin->admin("gm", $row["id"]).'</option>';
												
}
?></select>

</div>
<?$WMform->buton(4, false, "success pull-right", "plus", $id);?>
<?$WMform->footer();?>
<?php }else{ echo "<div class='alert alert-warning'>Kullanıcı Yok . <br> Bunun sebei bu serverda yetkisinin olmaması veya teknik destek yetkisinin olmaması olabilir. </div>"; } ?>
<hr>
<div class="col-md-12"><hr><code style="margin-bottom:20px;"><i class="fa fa-user"></i> Yetkililer </code></div>

<?php 

if(count($yetkililer) == 0)
{
	
echo '<font color="red">Yetkili Yok</font>';
	
}
else
{
	
$i = -1;

echo '<div class="col-md-12">';

$WMform->head("destek_kategori");
	
foreach($yetkililer as $yetkili)
{

$i++;
												
$WMform->check("yetkili_sec", $i, $WMadmin->admin("gm", $yetkili), false, 1);
												
}	

$WMform->buton(5, "Seçtiklerini Sil", "danger", "trash", $id);

echo '</div>';
	
}

?>

</div>



	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
