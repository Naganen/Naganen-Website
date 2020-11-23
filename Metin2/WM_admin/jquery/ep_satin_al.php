<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$odeme    = $WMkontrol->WM_tostring( $_POST[ "odeme" ] );
$update   = $db->prepare( "UPDATE server SET odeme = ? WHERE id = ? " );
$guncelle = $update->execute( array(
     $odeme,
    $_SESSION[ "server" ] 
) );
if ( $guncelle ) {
    $WMadmin->log_gonder( "Ep Satın Alma Sayfası Açıklama DÜzenlendi" );
    $WMform->basari( "Sayfa başarıyla düzenlendi" );
} else {
    $WMform->hata();
}
?>