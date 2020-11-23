<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$tid  = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tid" ] ) ) );
$sid  = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "sid" ] ) ) );
$info = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "durum" ] ) ) );
if ( $info == 370 ) {
    $durum = 0;
} else {
    $durum = $info;
}
$kontrol = $db->prepare( "SELECT id FROM destek WHERE id = ?" );
$kontrol->execute( array(
     $tid 
) );
if ( $kontrol->rowCount() ) {
    $guncelle = $db->prepare( "UPDATE destek SET durum = ? WHERE id = ? && sid = ?" );
    $guncelle->execute( array(
         $durum,
        $tid,
        $sid 
    ) );
    if ( $guncelle ) {
        $bak = $db->prepare( "SELECT konu FROM destek WHERE sid = ? && id = ?" );
        $bak->execute( array(
             $sid,
            $tid 
        ) );
        $bak = $bak->fetch();
        $WMadmin->log_gonder( $bak[ "konu" ] . " sorulu destek talebinin durumu güncellendi" );
        $WMform->basari( "Destek durumu başarıyla güncellendi" );
        echo '<meta http-equiv="refresh" content="2;URL=#">';
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( "Destek talebi bulunamadı" );
}
?>