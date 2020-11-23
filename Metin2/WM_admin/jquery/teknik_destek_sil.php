<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$tid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tid" ] ) ) );
$sid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "sid" ] ) ) );
$kontrol = $db->prepare( "SELECT id,konu FROM destek WHERE id = ?" );
$kontrol->execute( array(
     $tid 
) );
if ( $kontrol->rowCount() ) {
    $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
    $WMadmin->log_gonder( $fetch[ "konu" ] . " sorulu destek talebi silindi" );
    $sil = $db->prepare( "DELETE FROM destek WHERE id = ? && sid = ?" );
    $sil->execute( array(
         $tid,
        $sid 
    ) );
    if ( $sil ) {
        $cevapsil = $db->prepare( "DELETE FROM destek_cevap WHERE tid = ? && sid = ?" );
        $cevapsil->execute( array(
             $tid,
            $sid 
        ) );
        if ( $cevapsil ) {
            $WMform->basari( "Destek talebi başarıyla silindi" );
            $WMform->jquery_sil( 'tr#destek-' . $tid . '' );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( " Destek talebi zaten silinmiş" );
}
?>