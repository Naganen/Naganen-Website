<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "formid" ] ) );
if ( $fid == 1 ) {
    $kontrol = $db->prepare( "SELECT tur FROM anketler WHERE tur = ? && sid = ?" );
    $kontrol->execute( array(
         1,
        $_SESSION[ "server" ] 
    ) );
    $konu = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "konu" ] ) ) );
    if ( $kontrol->rowCount() ) {
        $WMform->uyari( "Anasayfa anketi zaten eklenmiş" );
    } else if ( !$konu ) {
        $WMform->hata( "Konuyu boş bırakamazsınız" );
    } else {
        $insert = $db->prepare( "INSERT INTO anketler SET sid = ?, tur = ?, konu = ?, token = ?, tarih = ?" );
        $ekle   = $insert->execute( array(
             $_SESSION[ "server" ],
            1,
            $konu,
            md5( uniqid( mt_rand(), true ) ),
            date( "Y-m-d H:i:s" ) 
        ) );
        if ( $ekle ) {
            $WMadmin->log_gonder( $konu . " sorulu ana sayfa anketi eklendi" );
            $WMform->basari( "AnaSayfa Anketi Başarıyla Eklendi" );
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 2 ) {
    $id       = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "pid" ] ) );
    $konu     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "konu" ] ) ) );
    $update   = $db->prepare( "UPDATE anketler SET konu = ? WHERE sid = ? && id = ? && tur = ?" );
    $guncelle = $update->execute( array(
         $konu,
        $_SESSION[ "server" ],
        $id,
        1 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( "Anasayfa anketi güncellendi" );
        $WMform->basari( "Anasayfa anketi başarıyla güncellendi" );
    } else {
        $WMform->hata();
    }
}
?>