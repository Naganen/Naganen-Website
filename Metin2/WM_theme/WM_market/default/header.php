<?php if(!isset($izin_verme)){ die("Buraya giriş izniniz yoktur."); exit;} 
ob_start();

	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=BASE_URL;?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?=server_detay("isim");?> - Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="layout" content="main"/>
    
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>

    <script src="<?=WM_market;?>jquery/jquery-1.8.2.min.js" type="text/javascript" ></script>
    <link href="<?=WM_market;?>css/genel.css" type="text/css" media="screen, projection" rel="stylesheet" />
  <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
  
	<link rel="stylesheet" type="text/css" href="<?=WM_market;?>css/jquery.mCustomScrollbar.min.css"/>

    <style>
        #body-content { padding-top: 20px;}
		#nt-title-container {
	background: #000;
}



@charset "utf-8";
/* CSS Document */

.breakingNews{width:50%; margin-left:40px; position:relative; overflow:hidden;}
.breakingNews>.bn-title{width:auto; margin-left:40px; height:40px; display:inline-block; background:#43353D; position:relative;}
.breakingNews>.bn-title>h2{display:inline-block; margin:0; padding:0 20px; line-height:40px; font-size:12px; color:#FFF; height:40px; box-sizing:border-box;}
.breakingNews>.bn-title>span{width: 0;position:absolute;right:-10px;top:10px;height: 0;border-style: solid;border-width: 10px 0 10px 10px;border-color: transparent transparent transparent #43353D;}

.breakingNews>ul{padding:0; margin:0; list-style:none; position:absolute; left:210px; top:0; right:40px; height:40px; font-size:16px;}
.breakingNews>ul>li{position:absolute; margin-left:40px; height:40px; width:100%; line-height:40px; display:none;}
.breakingNews>ul>li>a{text-decoration:none; color:#fff; overflow:hidden; display:block; white-space: nowrap;text-overflow: ellipsis; font-weight:normal;}
.breakingNews>ul>li>a>span{color:#2096cd;}
.breakingNews>ul>li>a:hover{color:#2096cd;}

.yukari
{
cursor:pointer;
 }







    </style>
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
                    <a href="index.php" class="brand"><i class="icon-shopping-cart"> <?=server_detay("isim");?> Market</i></a>
                    <div id="app-nav-top-bar" class="nav-collapse">
					
	<div class="breakingNews nav" id="bn1">
    	<div class="bn-title"><h2>Duyurular</h2><span></span></div>
        <ul>
		<?php 
		duyuru_listele();
		?>
        </ul>
        <div class="bn-navi">
        	<span></span>
            <span></span>
        </div>
    </div>
	
	
					
                    <ul class="nav pull-right">
                            <li>
                                <a href="javascript:;"><i class="fa fa-money"></i> <?=muye("coins");?> EP</a>
                            </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=muye("login");?>
                                        <b class="caret hidden-phone"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="kullanici/aldiklarim">Marketten Aldıklarım</a>
                                            <a href="cikis.php"><i class="fa fa-sign-out"></i> Çıkış Yap</a>
                                        </li>
                                    </ul>
                                </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
		
		
        <div id="body-container">
            <div id="body-content">
                
                
                
