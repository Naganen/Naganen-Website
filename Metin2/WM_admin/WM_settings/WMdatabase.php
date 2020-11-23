<?php
try {
    $odb = new PDO( "mysql:host=" . oyunhost . ";port=" . oyunport . ";dbname=account", oyunuser, oyunpass );
    $odb->exec( "set names utf8" );
}
catch ( PDOexception $wmhata ) {
    print $wmhata->getMessage();
    header( 'Location: index2.php' );
}
?>