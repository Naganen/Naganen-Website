<?php

error_reporting(0);

define('WMadmintema', '../WM_theme/WM_admin/wm/');
/* HEADER CONTENT ( UTF /)*/
header("Content-Type:text/html; Charset=UTF-8");
/* ZAMAN AYARI */
date_default_timezone_set("Europe/Istanbul");

/* ANA VERİTABANINA BAĞLANALIM */

require 'WM_database_ayar.php';

//Bilgilerimizi Girdik Bağlanma işlemini gerçekleştirelim

// HOSTİNG KLASÖR YOLUNU ALALIM

define('REAL_PATH', realpath("../")."/");

require 'WMdatabase.php';

//Bilgilerimizi çağırdıktan sonra fonksiyon kütüphanemizi çağıralım

require '../fonksiyon.php';


?>