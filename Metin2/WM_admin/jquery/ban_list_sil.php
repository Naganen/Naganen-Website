<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$fid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "fid" ] ) ) );
$account = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "account" ] ) ) );
$source  = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "source" ] ) ) );
$sil     = $odb->prepare( "DELETE FROM ban_list WHERE account = ? && source = ?" );
$sil->execute( array(
     $account,
    $source 
) );
if ( $sil ) {
    $WMadmin->log_gonder( $source . " Adlı karakter ban listesinden kaldırıldı" );
    $WMform->jquery_sil( 'tr#ban_list-' . $fid . '' );
    $WMform->basari( " Karakter ban listesinden başarıyla kaldırıldı" );
} else {
    $WMform->hata();
}
?>