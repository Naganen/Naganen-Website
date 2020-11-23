<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-4">
						
<div class="panel panel-default">
<div class="panel-body">
									

								
<?=$WMform->head("kullanici_ara");?>
<div class="form-group"><label>Arama Türünü Seçin</label>
<select class="form-control" name="aramatur">
<option value="1" <?=($tur == 1) ? 'selected' : '';?>>Kullanıcı Adı</option>
<option value="2" <?=($tur == 2) ? 'selected' : '';?>>Karakter Adı</option>
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
<th>Kullanıcı</th>
<th>Gerçek İsmi</th>
<th>Kayıt Tarihi</th>
<th>Son Giriş</th>
<th>Ejderha Parası</th>
<th>Email</th>
<th>İşlemler</th>
</tr>
</thead>
<tbody>

<?php 
if($tur == 1)
{ 
$ara = $odb->prepare("SELECT account.id, account.login, account.real_name, account.create_time, account.last_play, account.coins, account.email FROM account.account WHERE account.login LIKE ?  LIMIT 100");
$ara->execute(array('%'.$deger.'%'));
}
else if($tur == 2)
{
	
$ara = $odb->prepare("SELECT account.id, account.login, account.real_name, account.create_time, account.last_play, account.coins, account.email FROM account.account 
LEFT JOIN player.player ON player.account_id = account.id WHERE player.name LIKE ?  LIMIT 100");
$ara->execute(array('%'.$deger.'%'));
}
else if($tur == 3)
{
	
$ara = $odb->prepare("SELECT account.id, account.login, account.real_name, account.create_time, account.last_play, account.coins, account.email FROM account.account WHERE account.web_ip LIKE ?  LIMIT 100");
$ara->execute(array('%'.$deger.'%'));
}
else if($tur == 4)
{
	
$ara = $odb->prepare("SELECT account.id, account.login, account.real_name, account.create_time, account.last_play, account.coins, account.email FROM account.account WHERE account.email LIKE ?  LIMIT 100");
$ara->execute(array('%'.$deger.'%'));
}
else if($tur == 5)
{
	
$ara = $odb->prepare("SELECT account.id, account.login, account.real_name, account.create_time, account.last_play, account.coins, account.email FROM account.account WHERE account.real_name LIKE ?  LIMIT 100");
$ara->execute(array('%'.$deger.'%'));
}


foreach($ara as $sonuc){
?>
<tr id="kullanici-<?=$sonuc["id"];?>">
<td><?=$sonuc["login"];?></td>
<td><?=$sonuc["real_name"];?></td>
<td><?=WM_zaman_cevir($sonuc["create_time"]);?></td>
<td><?=WM_zaman_cevir($sonuc["last_play"]);?></td>
<td><?=$sonuc["coins"];?> EP</td>
<td><?=$sonuc["email"];?></td>
<td>
<a class="btn btn-info" href="index.php?sayfa=kullanicilar&login=<?=$sonuc["login"];?>" target="_blank"><i class="fa fa-eye"></i></a>
<a onclick="WM_sil('kullanici_karakter_sil&tur=2&id=<?=$sonuc["id"];?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a>
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