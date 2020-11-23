<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$id      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
$kontrol = $odb->prepare( "SELECT id FROM player.refine_proto WHERE id = ?" );
$kontrol->execute( array(
     $id 
) );
if ( $kontrol->rowCount() ) {
    $sil = $odb->prepare( "DELETE FROM player.refine_proto WHERE id = ?" );
    $sil->execute( array(
         $id 
    ) );
    if ( $sil ) {
        $WMadmin->log_gonder( $id . " numaralı yükseltme verisi silindi" );
        $WMform->basari( "Yükseltme verisi başarıyla silindi" );
        $WMform->jquery_sil( "tr#refine-$id" );
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( "Silincek veri çoktan silinmiş." );
}
?>