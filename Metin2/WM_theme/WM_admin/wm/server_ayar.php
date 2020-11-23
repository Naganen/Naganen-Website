
<?php 

$duyuru_icerik = json_decode($WMadmin->serverbilgi("duyuru_2"));

?>

                    
<div class="row">
					
<div class="col-md-12">
						
<div class="panel panel-default">
<div class="panel-body">
									
<div class="col-md-9">

<?php $kral = explode(',', $WMadmin->serverbilgi("drop"));?>
								
<?=$WMform->head("files_ayarlari");?>
<?=$WMform->veri("exp", false, "text", false, 'value="'.$kral[0].'"', 'Exp Drobu');?>
<?=$WMform->veri("yang", false, "text", false, 'value="'.$kral[1].'"', 'Yang Düşürme Drobu');?>
<?=$WMform->veri("dusme", false, "text", false, 'value="'.$kral[2].'"', 'Eşya Düşürme Drobu');?>
<?=$WMform->buton(1, " Dropları Güncelle", "info btn-block pull-right", "save");?>
<?=$WMform->footer();?>
									
</div>

<div class="col-md-3">
<?=$WMform->head("files_ayarlari");?>
<?=$WMform->veri("envanter", false, "text", false, 'value="'.$WMadmin->serverbilgi("envanter").'"', 'Serverınızdaki Envanter Sayısını Giriniz');?>
<?=$WMform->veri("efsun", false, "text", false, 'value="'.$WMadmin->serverbilgi("market_efsun").'"', 'Markette en fazla kaç efsun gelebilir ? ');?>
<?=$WMform->buton(2, " Ayarları Güncelle", "danger btn-block pull-right", "save");?>
<?=$WMform->footer();?>
									
</div>
									
</div>
						
</div>                        
</div>


<div class="col-md-9">
						
<div class="panel panel-default">
<div class="panel-body">
									
<?php
$sv_ayar = json_decode($WMadmin->serverbilgi("ayar"));

?>	

<div class="col-md-9">								

<?=$WMform->head("server_ayar");?>
<?$WMform->check("ayar", 1, " Sağ Tıklama Engeli ( İşaretlerseniz Engellenir )", ($sv_ayar[0] == 1) ? 1 : false);?>
<?$WMform->check("ayar2", 1, " Anasayfa 1 kere çıkan facebook beğen buton ( İşaretlerseniz Açılır )", ($sv_ayar[1] == 1) ? 1 : false);?>
<?$WMform->check("ayar5", 1, " Anasayfa Son Lonca Savaşı Gözüksün mü ? (İşaretlereseniz Gözükür)", ($sv_ayar[4] == 1) ? 1 : false);?>
<?=$WMform->buton(3, " Ayarları Güncelle", "success", "save");?>
<?=$WMform->footer();?>

</div>

<div class="col-md-3">

<?php 

if(isset($_FILES['dosya'])){
		
$hata = $_FILES['dosya']['error'];

if($hata != 0) 
{
	
echo '<div class="alert alert-danger"> Bir hata meydana geldi.  </div>';

} 

else 
{
	
$boyut = $_FILES['dosya']['size'];

if($boyut > (1024*1024*3)){
	
echo '<div class="alert alert-warning">Dosya 3 MB dan büyük olamaz </div>';
} 

else 
{
$tip = $_FILES['dosya']['type'];

$isim = $_FILES['dosya']['name'];

$uzanti = explode('.', $isim);

$uzanti = $uzanti[count($uzanti)-1];

if($uzanti != 'jpg' && $uzanti != 'png' && $uzanti != 'gif') 
{
	
echo '<div class="alert alert-warning">Yalnızca Resim Dosyaları Yükleyebilirsiniz.</div>';

} 
else 
{
	
$dosya = $_FILES['dosya']['tmp_name'];

$uzanti = explode('.', $_FILES['dosya']['name']);

$uzanti = $uzanti[count($uzanti)-1];

$rastgele = md5(uniqid(mt_rand(), true)).'.'.$uzanti;

$update = $db->prepare("UPDATE server SET logo = ? WHERE id = ?");

$guncelle = $update->execute(array($rastgele, $_SESSION["server"]));

if($guncelle)
{
copy($dosya, '../WM_global/img/logo/' . $rastgele);

echo '<div class="alert alert-success">Logonuz başarıyla yüklendi</div><meta http-equiv="refresh" content="2;URL=#">';

$WMadmin->log_gonder("Server logosu değiştirildi");
	
	
}
else
{
	
echo '<div class="alert alert-danger"> Bir hata meydana geldi.  </div>';
	
}


}

}

}

}

if(file_exists('../WM_global/img/logo/'.$WMadmin->serverbilgi("logo")) && $WMadmin->serverbilgi("logo") != '')
{
	
?>

<img src="../WM_global/img/logo/<?=$WMadmin->serverbilgi("logo");?>" style="width:200px; margin-bottom:20px;" />

<?php
	
}

?>


<form action="" method="post" enctype="multipart/form-data">
   <input type="file" name="dosya" />
   <button type="submit" class="btn btn-info" style="margin-top:20px;" />Logo Yükle</button>
</form>


<div class="col-md-12" style="margin-bottom:60px;"><br></div>

</div>

<div class="col-md-12"><hr></div>

<?=$WMform->head("server_ayar");?>
<?$WMform->check("ayar3", 1, " Kullanıcı giriş yaptığında çıkan duyuru ( İşaretlerseniz Aktif Olur )", ($sv_ayar[2] == 1) ? 1 : false);?>
<label> Duyuru içeriğini giriniz</label>
<textarea name="icerik_duyuru" class="icerik"><?=$duyuru_icerik[0];?></textarea>
<?=$WMform->buton(4, " Ayarları Güncelle", "danger pull-right", "save");?>
<?=$WMform->footer();?>

<div class="col-md-12"><hr></div>

<?=$WMform->head("server_ayar");?>
<div class="col-md-12"><?$WMform->check("ayar4", 1, " Altta açılan duyuru ( İşaretlerseniz Aktif olur)", ($sv_ayar[3] == 1) ? 1 : false);?>
</div>
<div class="col-md-12">
<textarea name="icerik_duyuru2" class="icerik"><?=$duyuru_icerik[1];?></textarea>
<?=$WMform->buton(5, " Ayarları Güncelle", "warning pull-right", "save");?>
<?=$WMform->footer();?>
</div>
									
									
</div>
						
</div>                        
</div>




<div class="col-md-3">
<div class="panel panel-default">
<div class="panel-body">
<h3>AÇIKLAMA </h3>	
<p>Files ayarları yeni sistemler çıktıkca güncellenip paylaşılcaktır.</p>			
<p>Yeni Sistemlerden Haberdar olmak için www.webmeric.com</p>			
									
</div>
						
</div>                        
</div>
                    
                    
                    
</div>
</div>            
</div>

