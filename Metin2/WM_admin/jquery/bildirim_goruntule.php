<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriÅŸ izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "fid" ] ) );
if ( $fid == 1 ) {
    $olay_yeri   = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "olay_yeri" ] ) );
    $bildirim_id = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "bildirim_id" ] ) );
    $tur         = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "tur" ] ) );
    if ( $tur == 2 ) {
        $WMadmin->yonlendir( "index.php?sayfa=Teknik_destek&tid=" . $olay_yeri );
        $WMadmin->bildirim_okundu( $bildirim_id );
    } else if ( $tur == 3 ) {
        $WMadmin->yonlendir( "index.php?sayfa=basvurular&id=" . $olay_yeri );
        $WMadmin->bildirim_okundu( $bildirim_id );
    }
} else if ( $fid == 2 ) {
    $pid    = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "pid" ] ) );
    $delete = $db->prepare( "DELETE FROM bildirim WHERE id = ? && sid = ?" );
    $sil    = $delete->execute( array(
         $pid,
        $_SESSION[ "server" ] 
    ) );
    if ( $sil ) {
        $WMform->jquery_sil( 'tr#bildirim-' . $pid . '' );
        $WMform->basari( "Bildirim başarıyla silindi" );
    } else {
        $WMform->hata();
    }
}
?>