<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$istatistik0 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "istatistik0" ] ) ) );
$istatistik1 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "istatistik1" ] ) ) );
$istatistik2 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "istatistik2" ] ) ) );
$istatistik3 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "istatistik3" ] ) ) );
$istatistik4 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "istatistik4" ] ) ) );
$array       = array(
     $istatistik0,
    $istatistik1,
    $istatistik2,
    $istatistik3,
    $istatistik4 
);
$update      = $db->prepare( "UPDATE server SET istatistik = ? WHERE id = ?" );
$guncelle    = $update->execute( array(
     json_encode( $array ),
    $_SESSION[ "server" ] 
) );
if ( $guncelle ) {
    $WMform->basari( "İstatistik ayarları başarıyla güncellendi" );
    $WMadmin->log_gonder( "İstatistik aşırtma ayarları güncellendi" );
} else {
    $WMform->hata();
}
?>