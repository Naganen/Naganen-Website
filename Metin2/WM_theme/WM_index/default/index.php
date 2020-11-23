<?php 

if($index_tur == 1)
{
	
define('title', 'WMCP2');

define('keywords', 'Webmeric.com, Wmcp, Webmeric Control Panel');	

define('description', 'webmeric.com');
	
}
else if($index_tur == 2)
{
	
define('title', $vt->a("title"));	

define('keywords', $vt->a("keywords"));	

define('description', $vt->a("description"));	
	
}

?>

<html><!--
!-->
<head>
<title><?=title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="<?=description;?>">
<meta name="keywords" content="<?=keywords;?>">
<link rel="shortcut icon" href="<?=WMindex;?>images/favicon.png" type="image/x-icon" />
</head>
<body bgcolor="#0d0c1c" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<!-- Started -->
<table id="Tablo_01" width="1300" height="700" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="7">
			<img src="<?=WMindex;?>images/index_01.gif" width="1300" height="288" alt=""></td>
	</tr>
	<tr>
		<td rowspan="6">
			<img src="<?=WMindex;?>images/index_02.gif" width="128" height="412" alt=""></td>
		<td colspan="5">
			<a href="anasayfa">
				<img src="<?=WMindex;?>images/anasayfa.gif" width="155" height="35" border="0" alt=""></a></td>
		<td rowspan="6">
			<img src="<?=WMindex;?>images/index_04.gif" width="1017" height="412" alt=""></td>
	</tr>
	<tr>
		<td colspan="5">
			<img src="<?=WMindex;?>images/index_05.gif" width="155" height="58" alt=""></td>
	</tr>
	<tr>
		<td rowspan="4">
			<img src="<?=WMindex;?>images/index_06.gif" width="25" height="319" alt=""></td>
		<td colspan="3">
			<a href="kaydol">
				<img src="<?=WMindex;?>images/kayitol.gif" width="100" height="25" border="0" alt=""></a></td>
		<td rowspan="4">
			<img src="<?=WMindex;?>images/index_08.gif" width="30" height="319" alt=""></td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="<?=WMindex;?>images/index_09.gif" width="100" height="54" alt=""></td>
	</tr>
	<tr>
		<td rowspan="2">
			<img src="<?=WMindex;?>images/index_10.gif" width="16" height="240" alt=""></td>
		<td>
			<a href="oyunu-indir">
				<img src="<?=WMindex;?>images/indir.gif" width="72" height="26" border="0" alt=""></a></td>
		<td rowspan="2">
			<img src="<?=WMindex;?>images/index_12.gif" width="12" height="240" alt=""></td>
	</tr>
	<tr>
		<td>
			<img src="<?=WMindex;?>images/index_13.gif" width="72" height="214" alt=""></td>
	</tr>
</table>
</center>
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false"></body>
<!-- Finished -->
</body>
</html>