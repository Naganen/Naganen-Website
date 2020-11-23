<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $icerik = $WMkontrol->WM_tostring( $_POST[ "icerik" ] );
    @$imza = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "imza" ] ) ) );
    if ( $imza ) {
        $imza_durum = 1;
    } else {
        $imza_durum = 2;
    }
    $update   = $db->prepare( "UPDATE users SET imza = ?, imza_durum = ? WHERE id = ?" );
    $guncelle = $update->execute( array(
         $icerik,
        $imza_durum,
        $_SESSION[ "adminid" ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Bilgileriniz başarıyla güncellendi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 2 ) {
    $pass       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
    $pass_retry = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_retry" ] ) ) );
    if ( !$pass ) {
        $WMform->hata( "Şifre boş bırakılamaz" );
    } else if ( $pass != $pass_retry ) {
        $WMform->hata( "Şifreler eşleşmiyor" );
    } else {
        $update   = $db->prepare( "UPDATE users SET password = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             md5( $pass ),
            $_SESSION[ "adminid" ] 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Şifreniz başarıyla değiştirildi" );
        } else {
            $WMform->hata();
        }
    }
}
?>