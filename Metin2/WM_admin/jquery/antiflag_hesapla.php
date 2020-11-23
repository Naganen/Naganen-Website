<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$zirve = 262143;
if ( !isset( $_POST[ "flag" ] ) ) {
    $WMform->jquery_duzelt( "b#sonuc", $zirve );
} else {
    $flaglar = $_POST[ 'flag' ];
    $toplam  = 0;
    foreach ( $flaglar as $flag ) {
        $toplam += $flag;
    }
    $WMform->jquery_duzelt( "b#sonuc", $zirve - $toplam );
}
?>