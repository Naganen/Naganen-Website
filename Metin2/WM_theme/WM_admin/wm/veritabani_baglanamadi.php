<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>WMCP - <?=$isim;?> Veritabanı Bağlanılamadı</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="<?php echo WMadmintema; ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	  <link rel="stylesheet" href="<?php echo WMadmintema; ?>dist/css/AdminLTE.css">
	  <link rel="stylesheet" href="<?php echo WMadmintema; ?>plugins/iCheck/square/blue.css">
    </head>
    <body>
        <div class="error-container">
            <div class="error-code">WMCP</div>
            <div class="error-text">Veritabanı Bağlanılamadı</div>
            <div class="error-subtext"><b><?=$isim;?></b> serverınızın veritabanından yanıt alamadığımız için kontrol panelini kullanamıyorsunuz.. Güncel veritabanı bilgilerini girerek lütfen yeniden deneyiniz.. ! </div>
            <div class="row">
			
							<?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("z", $yetkiler)) && ($yonetim_tur == 1 && in_array($_SESSION["server"], $serverlar)) ){ ?>
			
			<form action="?post=veritabani_kayit" method="post">
            <div class="form-group">
            <b><?=$isim;?> Serverının İP Adresi</b>
			<input type="text" name="vthost" value="<?=$fetch["host"];?>" class="form-control"/>
            </div>
            <div class="form-group">
            <b><?=$isim;?> Serverının MYSQL Kullanıcı Adı</b>
			<input type="text" name="vtuser" value="<?=$fetch["user"];?>" class="form-control"/>
            </div>
            <div class="form-group">
            <b><?=$isim;?> Serverının MYSQL Şifresi</b>
			<input type="text" name="vtpass" value="<?=$fetch["pass"];?>" class="form-control"/>
            </div>
            <div class="form-group">
            <b><?=$isim;?> Serverının MYSQL Portu</b>
			<input type="text" name="vtport" value="<?=$fetch["sql_port"];?>" class="form-control"/>
            </div>
            <div class="form-group">
            <button type="submit" class="btn btn-info btn-block btn-lg">Kayıt Et</button>
            </div>
			</form>
			
							<?php } ?>
					
            </div>
        </div>                 
    </body>
</html>






