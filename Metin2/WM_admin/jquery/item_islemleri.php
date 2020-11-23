<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $vnum = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "vnum" ] ) ) );
    $sil  = $odb->prepare( "DELETE FROM player.item WHERE vnum = ?" );
    $sil->execute( array(
         $vnum 
    ) );
    if ( $sil ) {
        $WMform->basari( $vnum . " vnumlu itemler başarıyla silindi" );
        $WMadmin->log_gonder( $vnum . " vnumlu itemler silindi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 2 ) {
    $sil = $odb->prepare( "DELETE FROM player.item" );
    $sil->execute();
    if ( $sil ) {
        $WMform->basari( "Oyundaki tüm itemler silindi" );
        $WMadmin->log_gonder( "Oyundaki tüm itemler silindi" );
    } else {
        $WMform->hata();
    }
}
?>