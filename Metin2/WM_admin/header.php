<?php
session_start();

require_once 'fonksiyon.php';

if(!isset($_SESSION["adminid"]) || !isset($_SESSION["adminisim"]) || !isset($_SESSION["giris"]) )
{
	
header('Location: giris.php');

}
else
{
	
$yetkiler = json_decode($WMadmin->yonetici("yetki"));

$serverlar = json_decode($WMadmin->yonetici("server_yetki"));

$yonetim_tur = $WMadmin->yonetici("tur");

if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array($_SESSION["server"], $serverlar))){ 
	
require_once WMadmintema.'header.php';

}
else
{
	
header('Location: giris.php');
	
}

}
?>