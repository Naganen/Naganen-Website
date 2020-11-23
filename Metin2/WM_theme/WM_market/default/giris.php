<?php if(!isset($izin_verme)){ die("Buraya giriş izniniz yoktur."); exit;} 
ob_start();
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Webmeric Market Paneli Giriş</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?=WM_market;?>css/genel.css" type="text/css" media="screen, projection" rel="stylesheet" />
    <meta name="layout" content="main"/>
<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
  
</head>
    <body>
	
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.php" class="brand"><i class="icon-leaf"> webmeric / ></i></a>
                    <div id="app-nav-top-bar" class="nav-collapse">
					
					
                    </div>
                </div>
            </div>
        </div>
	
	

        <div id="body-container">
            <div id="body-content">
			
			
                
    <section class="page container" > 
					<div class="span4"></div>
                    <div class="span8">
                        <div class="box pattern pattern-sandstone">
                            <div class="box-header" align="center">
                                <i class="fa fa-sign-in fa-2x"></i>
                                <h5>
                                  Giriş Yap
                                </h5>
                            </div>
                            <div class="box-content box-table">
							<div align="center" style="margin-top:20px;">
                            <form action='' method='POST' autocomplete='off'>
							
								<?php if(isset($_POST["girisyap"])){ echo $bilgi; }?>
							
                                <div class="form-inner">
								
                                    <div class="input-prepend">
                                        <label> <b>Server Seçin</b> </label>
                                        <span class="add-on"><i class="icon-list"></i></span>
                                        <select class="span4" name="server"><?=market_serverlar();?></select>
                                    </div>
								
                                    <div class="input-prepend">
                                        
                                        <span class="add-on" rel="tooltip"><i class="icon-user"></i></span>
                                        <input type='text' class='span4' name='username'/>
                                    </div>

                                    <div class="input-prepend">
                                        
                                        <span class="add-on"><i class="icon-key"></i></span>
                                        <input type='password' class='span4' name='password'/>
                                    </div>
									
									
                                </div>
								
                                <footer class="signin-actions">
                                    <input class="btn btn-primary" type='submit' name="girisyap" value='Giriş Yap'/>
                                </footer>
                            </form>
							
							</div>
							
                            </div>
							
							<br><br>
							
                        </div>
                    </div>
            
    </section>

            </div>


            </div>
			
			

	

    </body>
</html>