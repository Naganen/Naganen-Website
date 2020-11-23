<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-4">
						
<div class="panel panel-default">
<div class="panel-body">
									

								
<?=$WMform->head("karakter_ara");?>
<div class="form-group"><label>Arama Türünü Seçin</label>
<select class="form-control" name="aramatur">
<option value="1" <?=($tur == 1) ? 'selected' : '';?>>Karakter Adı</option>
<option value="2" <?=($tur == 2) ? 'selected' : '';?>>Kullanıcı Adı</option>
<option value="3" <?=($tur == 3) ? 'selected' : '';?>>İP Adresi</option>
<option value="4" <?=($tur == 4) ? 'selected' : '';?>>Email Adresi</option>
<option value="5" <?=($tur == 5) ? 'selected' : '';?>>Gerçek İsmi</option>
</select>
</div>
<?php if(@!$deger){ $yazdir = ""; }else{ $yazdir = 'value="'.$deger.'"'; } ?>
<?=$WMform->veri("deger", "Değer Giriniz", "text", false, $yazdir, 'Arama türünü seçtikten sonra arancak değeri giriniz.');?>
<?=$WMform->buton(1, " Karakter Ara", "warning btn-block pull-right", "search");?>
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
<th>Karakter Adı</th>
<th>Level</th>
<th>Son Giriş</th>
<th>Karakter Sahibi</th>
<th>İşlemler</th>
</tr>
</thead>
<tbody>

<?php 
if($tur == 1)
{ 
$ara = $odb->prepare("SELECT player.name, player.id, player.job, player.level, player.last_play, account.login FROM player.player 
INNER JOIN account.account ON account.id = player.account_id WHERE player.name LIKE ? ORDER BY level DESC LIMIT 100");
$ara->execute(array('%'.$deger.'%'));
}
else if($tur == 2)
{
	
$ara = $odb->prepare("SELECT player.name, player.id, player.job, player.level, player.last_play, account.login FROM player.player 
INNER JOIN account.account ON account.id = player.account_id WHERE account.login LIKE ? ORDER BY level DESC LIMIT 100");
$ara->execute(array('%'.$deger.'%'));
	
}
else if($tur == 3)
{
	
$ara = $odb->prepare("SELECT player.name, player.id, player.job, player.level, player.last_play, account.login FROM player.player 
INNER JOIN account.account ON account.id = player.account_id WHERE account.web_ip LIKE ? ORDER BY level DESC LIMIT 100");
$ara->execute(array('%'.$deger.'%'));
	
}
else if($tur == 4)
{
	
$ara = $odb->prepare("SELECT player.name, player.id, player.job, player.level, player.last_play, account.login FROM player.player 
INNER JOIN account.account ON account.id = player.account_id WHERE account.email LIKE ? ORDER BY level DESC LIMIT 100");
$ara->execute(array('%'.$deger.'%'));
	
}
else if($tur == 5)
{
	
$ara = $odb->prepare("SELECT player.name, player.id, player.job, player.level, player.last_play, account.login FROM player.player
INNER JOIN account.account ON account.id = player.account_id WHERE account.real_name LIKE ? ORDER BY level DESC LIMIT 100");
$ara->execute(array('%'.$deger.'%'));
	
}


foreach($ara as $sonuc){
?>
<tr id="karakter-<?=$sonuc["id"];?>">
<td><img style="width:25px; height:20px;" src="<?=WMadmintema.'img/karakterler/'.$sonuc["job"];?>.jpg"/> <?=$sonuc["name"];?></td>
<td><?=$sonuc["level"];?></td>
<td><?=WM_zaman_cevir($sonuc["last_play"]);?></td>
<td><label class="label label-success"><a style="color:#fff;" href="index.php?sayfa=kullanicilar&login=<?=$sonuc["login"];?>" target="_blank"><i class="fa fa-user"></i> <?=$sonuc["login"];?></a> </label></td>
<td>
<a class="btn btn-info" href="index.php?sayfa=karakterler&name=<?=$sonuc["name"];?>" target="_blank"><i class="fa fa-eye"></i></a>
<a onclick="WM_sil('kullanici_karakter_sil&tur=1&id=<?=$sonuc["id"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
