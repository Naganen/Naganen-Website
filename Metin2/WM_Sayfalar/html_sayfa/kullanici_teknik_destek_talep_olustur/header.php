<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<title>Destek Talebi Oluştur - <?=$vt->a("title");?></title>

<meta name="keywords" content="<?=$vt->a("keywords");?>">

<meta name="description" content="<?=$vt->a("description");?>">

<base href="<?=$vt->a("link");?>">

<script>
function refreshCaptcha() {
	$("img#captcha_code").attr('src','<?=WMcaptcha;?>');
}
</script>

<style>
.destek input[type='text'], textarea {
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

.destek select
{
	
border-top-style: none;
border-right-style: none;
border-bottom-style: none;
border-left-style: none;
background-color: transparent;
font-family: "Times New Roman", Times, serif;
text-shadow: 0.08em 0.08em #000;
font-size: 15px;
background-image: url();
	border: 1px solid #000;
background-repeat: no-repeat;
height: 48px;
width: 166px;
padding-left: 10px;
padding-right: 10px;
outline: none;
	-webkit-box-shadow: 7px 10px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 7px 10px 5px 0px rgba(0,0,0,0.75);
box-shadow: 7px 10px 5px 0px rgba(0,0,0,0.75);
	
}

</style>
