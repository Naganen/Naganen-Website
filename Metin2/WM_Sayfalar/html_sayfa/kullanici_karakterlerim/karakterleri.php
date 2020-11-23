<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<style>
.karakterler input[type='text'], textarea {
	border-top-style: none;
	background-color: transparent;
	line-height: 35px;
	border-radius: 3px;
	border: none;
	outline:none;
	border: 1px solid #000;
	background-image: url();
	-webkit-box-shadow: 7px 10px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 7px 10px 5px 0px rgba(0,0,0,0.75);
box-shadow: 7px 10px 5px 0px rgba(0,0,0,0.75);
margin-bottom:10px;
}


</style>



<?php

foreach($karakterler as $karakter)
{

?>

<div class="karakterlerim">
<span class="karakter_name"><?=$karakter["name"];?> <?php 
$goz_at = $db->prepare("Select id FROM onayli_karakter WHERE sid = ? && isim = ?");
$goz_at->execute(array(server, $karakter["name"]));
if($goz_at->rowCount()){ ?><img title="Onaylı Karakter" src="<?=$ayar->WMimg;?>onaylandi.png"></a></td><?php }
?></span>
<a href="karakter/<?=$karakter["name"];?>" target="_blank"><img style="width:140px;" src="<?=$ayar->WMimg;?>profil/<?=$karakter["job"];?>.png" class="profil_img" width="110"></a>
<span class="karakter_name"><?=$karakter["level"];?> Lv</span>
<span class="karakter_name"><?=$WMinf->WM_rutbe($karakter["alignment"]);?></span>
<?php if($sosyal_kontrol->rowCount()){?><br>
<a href="kullanici/karakterlerim?karakter_duzenle=<?=$karakter["id"];?>"><img src="<?=$ayar->WMimg;?>edit.png"></a><?php } ?>
</div>

<?php

}

?>
