<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$tid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tid" ] ) ) );
$sid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "sid" ] ) ) );
$cid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "cid" ] ) ) );
$kontrol = $db->prepare( "SELECT id FROM destek_cevap WHERE id = ? && tid = ? && sid = ?" );
$kontrol->execute( array(
     $cid,
    $tid,
    $sid 
) );
if ( $kontrol->rowCount() ) {
    $sil = $db->prepare( "DELETE FROM destek_cevap WHERE id = ? && tid = ? && sid = ?" );
    $sil->execute( array(
         $cid,
        $tid,
        $sid 
    ) );
    if ( $sil ) {
        $bak = $db->prepare( "SELECT konu FROM destek WHERE sid = ? && id = ?" );
        $bak->execute( array(
             $sid,
            $tid 
        ) );
        $bak = $bak->fetch();
        $WMadmin->log_gonder( $bak[ "konu" ] . " sorulu destek talebinden cevap silindi" );
        $WMform->basari( "Cevap başarıyla silindi" );
        $WMform->jquery_sil( 'li#cevap-' . $cid . '' );
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( "Cevap zaten silinmiş" );
}
?>