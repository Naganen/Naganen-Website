<?php 
require_once 'sayfalar/class.php';

$srv = new server;

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="tr" lang="tr">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>

<meta http-equiv="content-type" content="text/html;charset=UTF-8">
<?php $wmcp->head(); ?>
<?php $tema->stiller(); ?>
	

<link rel="stylesheet" type="text/css" href="<?=WM_tema;?>css/style.css" />
<script type="text/javascript" src="<?=WM_tema;?>js/jQuery.min.js"></script>
<script type="text/javascript" src="<?=WM_tema;?>js/mainscript.js"></script>
</head>

<body id="topHref">
<div id="xhtmltooltip" style="background-image: url(<?=WM_tema;?>images/inner_content.jpg); font-size: 14px;"></div> 
<div id="logo">
<img src="<?=$ayar->WMimg;?>logo/<?=$vt->a("logo");?>">
</div>
<div id="main_wrapper">
<div id="cloth">
<div id="main_menu">
<ul id="navigation">
<a href="<?=$vt->url(0);?>"><li id="home"><!-- --></li></a>
				
<a href="<?=$vt->url(1);?>"><li id="regi"><!-- --></li></a>
<a href="<?=$vt->url(3);?>"><li id="download"><!-- --></li></a>
<a href="<?=$vt->url(2);?>"><li id="ranking"><!-- --></li></a>
<a href="<?=$vt->url(7);?>"><li id="teamspeak"><!-- --></li></a>
<a href="<?=$vt->url(11);?>" title="Nesne Market"><li id="eventcalendar"><!-- --></li></a>
<a href="<?=$vt->url(8);?>" target="_blank"><li id="board"><!-- --></li></a>
</ul>
</div>
			
<div id="login"><div id="loginbtn"><!-- --></div></div>
			
<div class="inner">
<div id="slider"><img src="<?=WM_tema;?>images/slider/4.png"></div>			</div>
			
</div>
		
<div id="content_wrapper">
<div id="content_main">
<div class="inner_wrapper">
					
<div class="content_wrapper right">
<?php if($tema->genel(0) == 1){ ?>

<a href="ban-sorgula"><div id="ban_btn"><!-- --></div></a>
<a href="oyunu-indir"><div id="download_btn"><!-- --></div></a>
<a href="/"><div id="rehber_btn"><!-- --></div></a>
<?php } ?>

<?php if($tema->genel(2) == 1){ ?>
<div class="real_content">
<a href="<?=$vt->sosyal(0);?>"><div id="facebook_btn"><!-- --></div></a> 
</div>
<?php } ?>

<style type="text/css">
.stats_key {
width: 130px;color: #A4BBE7;text-shadow: 1px 1px 1px #97BBFF; font-size: 16px;
}
    
.stats_value {
color: #F22613;
  text-shadow: 1px 1px 1px #F22613;
  font-size: 16px;
}
    
.stats_ch_value {
color: #23c001; 
  text-shadow: 1px 1px 1px #A8F3A3;
}

<?php if($tema->genel(1) == 1){ $class = "stats_ch_value"; }else{$class = "stats_value";} ?>
    
</style>

<div class="real_content">
<div id="ServeurStats">
<div class="headline"><span class="title">OYUN İSTATISTIKLERI</span></div>
<div class="inner_content">
<div id="ServerStatus">
<table class="topranking" cellspacing="1" cellpadding="0">
<center>
<?php if($tema->istatistikler(0) == 1){ ?>
<tr class="c1">
<td class="pname"><i><b>Online Oyuncu:</i></b></td> <td class="score"><font id="online_oyuncu" class="<?=$class;?>">...</font><br></td>
</tr>
<?php } ?>
<?php if($tema->istatistikler(1) == 1){ ?>
<tr class="c1">
<td class="pname"><i><b>Bugün Girenler:</i></b></td> <td class="score"><font id="rekor_online" class="<?=$class;?>">...</font><br></td>
</tr>
<?php } ?>
<?php if($tema->istatistikler(2) == 1){ ?>
<tr class="c1">
<td class="pname"><i><b>Toplam Kayıtlar:</i></b></td> <td class="score"><font id="toplam_kayit" class="<?=$class;?>">...</font><br></td>
</tr>
<?php } ?>
<?php if($tema->istatistikler(3) == 1){ ?>
<tr class="c1">
<td class="pname"><i><b>Toplam Oyuncu:</i></b></td> <td class="score"><font id="toplam_karakter" class="<?=$class;?>">...</font><br></td>
</tr>
<?php } ?>
<?php if($tema->istatistikler(4) == 1){ ?>
<tr class="c0">
<td class="pname"><i><b>Toplam Lonca:</i></b></td> <td class="score"><font id="toplam_lonca" class="<?=$class;?>">...</font><br></td>
</tr>
<?php } ?>

</center>

</table>	
		
</div>

</div>

</div>
</div>

<?php if($tema->droplar(0) == 1 || $tema->droplar(1) == 1 || $tema->droplar(2) == 1 ){ ?>
<div class="real_content">
<div id="ServeurStats">
<div class="headline"><span class="title">Server Dropları</span></div>
<div class="inner_content">
<div id="ServerStatus">
<table class="topranking" cellspacing="1" cellpadding="0">
<center>
<?php if($tema->droplar(0) == 1){ ?>
<tr class="c1">
<td class="pname"><i><b>Exp Kazanma</i></b></td> <td class="score"><?=$tema->drop(0);?><br></td>
</tr>
<?php } ?>
<?php if($tema->droplar(1) == 1){ ?>
<tr class="c1">
<td class="pname"><i><b>Yang Düşürme</i></b></td> <td class="score"><?=$tema->drop(1);?><br></td>
</tr>
<?php } ?>
<?php if($tema->droplar(2) == 1){ ?>
<tr class="c1">
<td class="pname"><i><b>Eşya Düşürme</i></b></td> <td class="score"><?=$tema->drop(2);?><br></td>
</tr>
<?php } ?>

</center>

</table>	
		
</div>

</div>

</div>
</div>

<?php } ?>

<?php if($tema->siralama(0) == 1){ ?>

<div class="real_content">
<div class="headline"><span class="title">Oyuncu Sıralaması TOP10</span></div>
<div class="inner_content">
			
<table class="topranking" cellspacing="1" cellpadding="0">
<tr class="c0">
<td class="index"><i>#</i></td>
<td class="pname"><i>Karakter Adı</i></td>
<td class="score"><i>Krallık</i></td>
<td class="score"><i>Seviye</i></td>
</tr>
<tr class="spacer"><td colspan="10"></td></tr>
			
<?=$srv->karakter(10);?>
									
</table><br>
<center>
<a href="oyuncu-siralamasi"><input type="button" value="Oyuncular"></a>
<a href="lonca-siralamasi"><input type="button" value="Loncalar"></a>
</center>
<div class="clear"><!-- --></div>
</div>
</div>

<?php } ?>


<?php if($tema->siralama(1) == 1){ ?>

<div class="real_content">
<div class="headline"><span class="title">Lonca Sıralaması TOP10</span></div>
<div class="inner_content">
			
<table class="topranking" cellspacing="1" cellpadding="0">
<tr class="c0">
<td class="index"><i>#</i></td>
<td class="pname"><i>Lonca Adı</i></td>
<td class="score"><i>Krallık</i></td>
<td class="score"><i>Lonca Puanı</i></td>
</tr>
<tr class="spacer"><td colspan="10"></td></tr>
			
<?=$srv->lonca(10);?>
									
</table><br>
<center>
<a href="oyuncu-siralamasi"><input type="button" value="Oyuncular"></a>
<a href="lonca-siralamasi"><input type="button" value="Loncalar"></a>
</center>
<div class="clear"><!-- --></div>
</div>
</div>

<?php } ?>


</div>
<div class="content_wrapper left">
<div class="real_content">
	
<h2 class="headline_news"><span class="title"><?=$wmcp->ust();?></span></h2>
<div class="p4px">
<div class="real_content">
<div class="inner_content news_content">
<div align="center">
<div style="clear:both;"></div>

<?=$wmcp->orta();?>

<div style="clear:both;"></div>

</div>

</div>
</div>
</div>
		

		
</div>
</div>					
<div class="clear"><!-- --></div>
					
									
</div>
</div>
			
<div id="content_bottom">
<a href="#topHref"><div id="topbtn"><!-- --></div></a>
<div class="inner_content">
<div class="left"><br>
Copyright Webmeric, Tüm Hakları Saklıdır.<br>
Yazılım: <a href="http://www.webmeric.com" target="_blank" rel="nofollow">Webmeric</a><br>
</div>
</div>		
</div>
</div>
</div>

<div id="dim"><!-- --></div>
<div id="loginbox" class="dimhides popupwindow">
<div class="real_content">
<div class="headline"><span class="title">Giriş Yap </span></div>
<div class="p3px">
<div class="real_content">
	
<?php if(!isset($_SESSION[$vt->a("isim")."token"])){ ?>
    
<form method="post" action="giris-yap">
<input type="hidden" name="giris_csrf_token" value="<?=$ayar->sessionid;?>" />
<table>
<tr>
<td>Kullanıcı Adı</td>
<td><input name="username" onkeyup="turkce_kontrol(this)"  type="text" value=""></label><input type="hidden" value="<?=$ayar->sessionid;?>" name="giris_token" /></td>
</tr><tr>
<td>Parola</td>
<td><input name="pass" type="password"></td>
</tr><tr>
<td><input type="submit" name="submit" value="Giriş yap"></td>
<td>
<?php if($vt->a("kullanici_unuttum") == 1){?>
<a href="kullanici-adi-unuttum" class="small italic">Kullanıcı adını unuttum ?</a><br> 
<?php } ?>
<a href="sifremi-unuttum" class="small italic">Şifreni mi unuttun ?</a>
</td>
</tr>
</table>
</form>
			
<?php }else{ ?>
	
<div style="margin-left:20px">
Hoşgeldiniz <b><?=$_SESSION[$vt->a("isim")."username"];?></b><br>
<a href="kullanici">Hesabım</a><br>
<a href="cikis-yap">Çıkış Yap</a><br>
</div>
	
<?php } ?>
    
</div>
</div>
</div>
</div>

<?php 
$tema->jquery($konum); 
$tema->footer();
?>	

</body>

</html>
