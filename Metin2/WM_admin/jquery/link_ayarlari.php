<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$linkler       = array( );
$linkler[ 0 ]  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "anasayfa" ] ) ) );
$linkler[ 1 ]  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kaydol" ] ) ) );
$linkler[ 2 ]  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "siralama" ] ) ) );
$linkler[ 3 ]  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "indir" ] ) ) );
$linkler[ 4 ]  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "giris" ] ) ) );
$linkler[ 5 ]  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "hesap" ] ) ) );
$linkler[ 6 ]  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "cikis" ] ) ) );
$linkler[ 7 ]  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "destek" ] ) ) );
$linkler[ 8 ]  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "forum" ] ) ) );
$linkler[ 9 ]  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "bansorgula" ] ) ) );
$linkler[ 10 ] = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "tanitim" ] ) ) );
$linkler[ 11 ] = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "market" ] ) ) );
$update        = $db->prepare( "UPDATE server SET linkler = ? WHERE id = ?" );
$guncelle      = $update->execute( array(
     json_encode( $linkler ),
    $_SESSION[ "server" ] 
) );
if ( $guncelle ) {
    $WMadmin->log_gonder( "Linkler değiştirildi" );
    $WMform->basari( "Linkler başarıyla güncellendi" );
} else {
    $WMform->hata();
}
?>