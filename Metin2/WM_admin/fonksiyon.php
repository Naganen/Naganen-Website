<?php

ob_start();

// AYAR KÜTÜPHANEMİZİ ÇAĞIRALIM 
require_once '../WM_settings/WM_admin_ayar.php';
/* WM ADMİN KÜTÜPHANELERİNE GİRİŞ */

define('WM_admin_class', 'WMclass/');
define('WM_admin_plugin', 'WMplugin/');
define('WM_IZIN_KONTROL', TRUE);

/* WM KÜTÜPHANELERİ ÇAĞIRALIM*/

require_once WM_admin_class.'WMclass.php';
require_once WM_admin_class.'WMbilgiler.php';
require_once WM_admin_class.'WMinfo.php';
require_once WM_admin_class.'WM_form.php';

/* KÜTÜPHANELERİ DEĞİŞKENE ATAYALIM */

$WMadmin = new WMadmin;
$WMform = new WMform;
$inf = new WMinfo;

// ADMİN AYAR KÜTÜPHANEMİZİ ÇAĞIRALIM 
require_once 'WM_settings/WMayar.php';

?>