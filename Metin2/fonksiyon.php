<?php

error_reporting(0);
define('WM_Class_lib', 'WM_class/');
define('WM_Plugins_lib', 'WM_plugins/');
define('WM_firewall', 'WM_firewall/');
define('WM_sayfalar', 'WM_Sayfalar/');
define('WMimg', '../WM_global/img/');
define('WM_HTML_KONTROL', true);

function __autoload($otocagir){
	
require_once WM_sayfalar.$otocagir.'.php';

}


/* CLASS KÜTÜPHANELERİMİZİN YOLLARINI BELİRLEDİK 
   CLASSLARIMIZI ÇAĞIRALIM
*/

require_once WM_Class_lib.'WM_class.php';
require_once WM_Class_lib.'WM_info.php';
require_once WM_Class_lib.'WM_kontrol.php';
require_once WM_Class_lib.'WM_tema_islemleri.php';
require_once WM_Class_lib.'WM_vt_islemleri.php';


/* CLASSLARIMIZI DEĞİŞKENE ATAYIP KULLANMAYA BAŞLAYALIM */

$WMclass = new WMclass;
$WMkontrol = new WMcontrol;
$WMinf = new WM_info;
$tema = new WM_theme_settings;




?>