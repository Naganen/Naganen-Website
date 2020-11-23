<?php

define('oyunhost', $WMadmin->serverbilgi("host"));

define('oyunuser', $WMadmin->serverbilgi("user"));

define('oyunpass', $WMadmin->serverbilgi("pass"));

define('oyunport', $WMadmin->serverbilgi("sql_port"));

require_once 'WMdatabase.php';



?>