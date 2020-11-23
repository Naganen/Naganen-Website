<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$tid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tid" ] ) ) );
$sid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "sid" ] ) ) );
$info    = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "durum" ] ) ) );
$kontrol = $db->prepare( "SELECT id FROM destek WHERE id = ? && sid = ?" );
$kontrol->execute( array(
     $tid,
    $sid 
) );
if ( $kontrol->rowCount() ) {
    $guncelle = $db->prepare( "UPDATE destek SET kid = ? WHERE id = ? && sid = ?" );
    $guncelle->execute( array(
         $info,
        $tid,
        $sid 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Destek talebinin kategorisi başarıyla güncellendi" );
        echo '<meta http-equiv="refresh" content="2;URL=#">';
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( "Destek talebi silinmiş" );
}
?>