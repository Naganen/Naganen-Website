<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$pid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$sid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "sid" ] ) ) );
$kontrol = $db->prepare( "SELECT id,pack FROM packlar WHERE id = ?" );
$kontrol->execute( array(
     $pid 
) );
if ( $kontrol->rowCount() ) {
    $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
    $WMadmin->log_gonder( $fetch[ "pack" ] . " Adlı Pack Silindi" );
    $sil = $db->prepare( "DELETE FROM packlar WHERE id = ? && sid = ?" );
    $sil->execute( array(
         $pid,
        $sid 
    ) );
    if ( $sil ) {
        $WMform->basari( "Pack Başarıyla Silindi" );
        $WMform->jquery_sil( 'a#pack-' . $pid . '' );
        $WMform->jquery_sil( 'div#pack-' . $pid . '' );
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( " Pack zaten silinmiş" );
}
?>