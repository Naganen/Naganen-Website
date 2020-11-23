<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>WMCP - Server Seç</title>            
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
            <div class="error-text">Server Bulunamadı</div><div id="sonuc"></div>
            <div class="error-subtext">Kullanıcının serverı boş veya serverı sistemde bulunamadı. ! Aşağıdaki server listesinden yönetmek istediğiniz serverı seçiniz. ! </div>
            <div class="row">
			
					
            <div class="error-actions"> 
                <div class="row">
				
				<form action="?post=server_sec" method="post">
				
				<div class="col-md-9 form-group">
					<select name="serversec" class="form-control">
					<?php $query = $db->query("SELECT * FROM server ORDER BY id DESC"); 
					if($query->rowCount()){
					foreach($query as $row)
					{
					if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array($row["id"], $serverlar)) )
					{	
					echo '<option value="'.$row["id"].'">'.$row["isim"].'</option>';
					}
					
					} 
					}
					else{
					echo '<option value=""> Server Bulunamadı</option>';}
					?>
					</select>
				</div>
				<div class="col-md-3">
					<button type="submit" class="btn btn-primary"><i class="fa fa-cog"></i> Yönet</button>
				</div>
				
				</form>
				
							<?php if($yonetim_tur == 2){ ?>
				
				<?php $sayfa = @$_GET["sayfa"]; if(!$sayfa){ ?>
                    <div class="col-md-12" style="margin-bottom:10px;">
                        <a href="index2.php?sayfa=ekle" class="btn btn-danger btn-block btn-lg"><i class="fa fa-plus"></i> Server Ekle</a>
                    </div>
				<?php }if($sayfa == "ekle"){ ?>
					<form action="?sayfa=ekle&post=server_ekle" method="post">
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control" name="vthost" placeholder="* Server İP Adresinizi giriniz" />
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control" name="vtuser" placeholder="* Server MYSQL Kullanıcı Adını Giriniz" />
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="password" class="form-control" name="vtpass" placeholder="Server MYSQL Şifresini Giriniz" />
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control" name="vtport" placeholder="* Server MYSQL Portu Giriniz Default : 3306" />
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control" name="servername" placeholder="* Serverınızın İsmini Giriniz" />
                    </div>
                    <div class="col-md-12 form-group">
                        <input type="text" class="form-control" name="serverfolder" placeholder="* Serverınızın Klasör Yolunu Giriniz" />
                    </div>
                    <div class="col-md-12" style="margin-bottom:10px;">
                        <button type="submit" class="btn btn-danger btn-block btn-lg"><i class="fa fa-plus"></i> Server Ekle</button>
                    </div>
					</form>
				<?php } ?>
				
				<?php } ?>
				
                </div>                                
            </div>
            </div>
        </div>                 
    </body>
</html>
