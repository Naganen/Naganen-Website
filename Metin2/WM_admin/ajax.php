<?php 
if($_GET["islem"] == "giris_yap")
{
require_once '../WM_settings/WM_database_ayar.php';

require_once '../WM_settings/WMdatabase.php';

require_once '../fonksiyon.php';

}
else
{
	
require_once 'fonksiyon.php';

}

$cek = $WMkontrol->WM_get($_GET["islem"]);

$dizin	= "jquery/";

if(!$cek)
{
	
echo "Dosya yok ! ";

}
else
{
	
$bul = $dizin.$WMkontrol->WM_eng($cek).".php";
if( file_exists($bul) )
{
	
require_once $bul;

}
else
{
	
$WMform->bilgi("Aradığınız dosya yok");

} 

}

?>