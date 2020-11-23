<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $bakim_yazi = $WMkontrol->WM_tostring( $_POST[ "bakim_icerik" ] );
    $update     = $db->prepare( "UPDATE server SET bakim_yazi = ? WHERE id = ?" );
    $guncelle   = $update->execute( array(
         $bakim_yazi,
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Bakım yazısı başarıyla güncellendi" );
        $WMadmin->log_gonder( "Bakım yazısı güncellendi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 2 ) {
    $tema       = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "tema" ] ) ) );
    $update     = $db->prepare( "UPDATE server SET tema = ? WHERE id = ?" );
    $tema_array = array(
         "bakim",
        $tema 
    );
    $guncelle   = $update->execute( array(
         json_encode( $tema_array ),
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( $tema . " temalı bakım sayfasını aktif etti" );
        $WMform->basari( "Bakım sayfası başarıyla aktif oldu" );
        echo '<meta http-equiv="refresh" content="3;URL=#">';
    } else {
        $WMform->hata();
    }
}
?>