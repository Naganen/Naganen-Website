<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$icerik   = $WMkontrol->WM_tostring( $_POST[ "pack_icerik" ] );
$update   = $db->prepare( "UPDATE server SET pack_aciklama = ? WHERE id = ? " );
$guncelle = $update->execute( array(
     $icerik,
    $_SESSION[ "server" ] 
) );
if ( $guncelle ) {
    $WMadmin->log_gonder( "Packın Üst Açıklaması Güncellendi" );
    $WMform->basari( "Packın Üst Açıklaması Başarıyla Güncellendi" );
} else {
    $WMform->hata();
}
?>