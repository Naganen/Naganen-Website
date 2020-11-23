<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$sistem         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sistem" ] ) ) );
$sistem_sifre   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sistem_sifre" ] ) ) );
$sifre_olustur  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sifre_olustur" ] ) ) );
$sifre_unuttum  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sifre_unuttum" ] ) ) );
$sifre_degistir = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sifre_degistir" ] ) ) );
$sistem_kabul   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sistem_kabul" ] ) ) );
if ( ( $sistem != 1 && $sistem != 2 ) || ( $sistem_sifre != 1 && $sistem_sifre != 2 ) || ( $sifre_olustur != 1 && $sifre_olustur != 2 ) && ( $sifre_unuttum != 1 && $sifre_unuttum != 2 ) || ( $sifre_degistir != 1 && $sifre_degistir != 2 ) || ( $sistem_kabul != 1 && $sistem_kabul != 2 ) ) {
    $WMform->hata( "Değerler 1 ve 2 nin dışında olamaz" );
} else {
    $deger    = $sistem . ',' . $sistem_sifre . ',' . $sifre_olustur . ',' . $sifre_unuttum . ',' . $sifre_degistir . ',' . $sistem_kabul;
    $update   = $db->prepare( "UPDATE server SET eptransfer = ? WHERE id = ? " );
    $guncelle = $update->execute( array(
         $deger,
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( "Ep Transfer Ayarlar Düzenlendi" );
        $WMform->basari( "Sistem ayarları başarıyla kaydedildi" );
    } else {
        $WMform->hata();
    }
}
?>