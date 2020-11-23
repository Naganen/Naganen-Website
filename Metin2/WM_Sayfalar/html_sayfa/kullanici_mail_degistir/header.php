<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<title>Mail Değiştir - <?=$vt->a("title");?></title>

<meta name="keywords" content="<?=$vt->a("keywords");?>">

<meta name="description" content="<?=$vt->a("description");?>">

<base href="<?=$vt->a("link");?>">

<script>
function refreshCaptcha() {
	$("img#captcha_code").attr('src','<?=WMcaptcha;?>');
}
</script>
