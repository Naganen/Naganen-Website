<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$arama = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "aramatur" ] ) ) );
$deger = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "deger" ] ) ) );
if ( $arama == 1 ) {
    $kontrol = $odb->prepare( "SELECT name FROM player.player WHERE name LIKE ? LIMIT 1" );
    $kontrol->execute( array(
         '%' . $deger . '%' 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMadmin->yonlendir( "index.php?sayfa=karakter_ara&tur=1&deger=$deger" );
    } else {
        $WMform->hata( "Arama kriterine uygun karakter bulunamadı" );
    }
} else if ( $arama == 2 ) {
    $kontrol = $odb->prepare( "SELECT login FROM account WHERE login LIKE ? LIMIT 1" );
    $kontrol->execute( array(
         '%' . $deger . '%' 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMadmin->yonlendir( "index.php?sayfa=karakter_ara&tur=2&deger=$deger" );
    } else {
        $WMform->hata( "Arama kriterine uygun karakter bulunamadı" );
    }
} else if ( $arama == 3 ) {
    $kontrol = $odb->prepare( "SELECT web_ip FROM account WHERE web_ip LIKE ? LIMIT 1" );
    $kontrol->execute( array(
         '%' . $deger . '%' 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMadmin->yonlendir( "index.php?sayfa=karakter_ara&tur=3&deger=$deger" );
    } else {
        $WMform->hata( "Arama kriterine uygun karakter bulunamadı" );
    }
} else if ( $arama == 4 ) {
    $kontrol = $odb->prepare( "SELECT email FROM account WHERE email LIKE ? LIMIT 1" );
    $kontrol->execute( array(
         '%' . $deger . '%' 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMadmin->yonlendir( "index.php?sayfa=karakter_ara&tur=4&deger=$deger" );
    } else {
        $WMform->hata( "Arama kriterine uygun karakter bulunamadı" );
    }
} else if ( $arama == 5 ) {
    $kontrol = $odb->prepare( "SELECT real_name FROM account WHERE real_name LIKE ? LIMIT 1" );
    $kontrol->execute( array(
         '%' . $deger . '%' 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMadmin->yonlendir( "index.php?sayfa=karakter_ara&tur=5&deger=$deger" );
    } else {
        $WMform->hata( "Arama kriterine uygun karakter bulunamadı" );
    }
}
?>