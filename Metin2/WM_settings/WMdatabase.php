<?php
try {
    $db = new PDO( "mysql:host=" . ahost . ";dbname=" . avt . "", auser, apass );
    $db->exec( "set names utf8" );
}
catch ( PDOexception $wmhata ) {
    echo '<h1 align="center" style="margin-bottom:20px;">HATA !</h1><div style="border:1px solid #f00; padding:10px; margin:30px 0;">Veritabanına Bağlanılamadı - WMCP</div>';
    exit;
}
?>