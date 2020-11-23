<html>
<style>
body {
    background-color: #34495e;
}

.title_textpositer {
    color: #FFFFFF;
    text-shadow: #2c3e50;
    font-family: "Arial";
    font-size: 36px;
    position: fixed;
    top: 172px;
    left: 282px;
    text-shadow: 1px 1px 0px #2c3e50;
}

.desc_textpositer {
    color: #FFFFFF;
    text-shadow: #2c3e50;
    font-family: "Arial";
    font-size: 16px;
    position: fixed;
    top: 216px;
    left: 262px;
    text-shadow: 1px 1px 0px #2c3e50;
}

.mtc_imgpositer {
    position: fixed;
    top: 126px;
    left: 186px;
	
}


.social_fb {
    position: fixed;
    top: 380px;
    left: 290px;
}

  .social_tw {
    position: fixed;
    top: 382px;
    left: 380px;
}
  .social_yt {
    position: fixed;
    top: 382px;
    left: 470px;
}


.maker {
    position: fixed;
    bottom: 90px;
    left: 290px;
    font-family: "Arial";
    font-size: 15px;
    color: #FFFFFF;
    text-shadow: 1px 1px 0px #2c3e50;
}

</style>

<meta charset="UTF-8">

<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false"></body>

<link rel="shortcut icon" href="http://icons.iconarchive.com/icons/mag1cwind0w/akisame/16/Tools-icon.png">
<title>Bakımdayız - <?=$vt->a("isim");?></title>



<div class="mtc_imgpositer">
<img src="http://icons.iconarchive.com/icons/custom-icon-design/flatastic-8/128/Maintenance-icon.png" alt="bakim" title="Bakımdayız">
</div>

<div class="title_textpositer">
<i>"Bakımdayız "</i>
</div>

<div class="desc_textpositer">
<?=html_entity_decode($vt->a("bakim_yazi"));?>
</div>

<div class="social_fb">
<a href="<?=$vt->sosyal(0);?>" target="_blank"><img src="http://icons.iconarchive.com/icons/icontexto/social-inside/48/social-inside-facebook-icon.png" alt="fb"></a>
</div>

<div class="social_tw">
<a href="<?=$vt->sosyal(2);?>" target="_blank"><img src="http://icons.iconarchive.com/icons/icontexto/social-inside/48/social-inside-twitter-icon.png" alt="tw"></a>
</div>

<div class="social_yt">
<a href="<?=$vt->sosyal(1);?>" target="_blank"><img src="http://icons.iconarchive.com/icons/icontexto/social-inside/48/social-inside-youtube-icon.png" alt="tw">
</div>


<div class="maker">
<?=date("Y");?> © <strong> <?=$vt->a("isim");?></strong>.
</div>

</html>