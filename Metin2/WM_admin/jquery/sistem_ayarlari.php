<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$formid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
$pid    = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$dizin  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kurulum_kaldirim-$formid" ] ) ) );
if ( $pid == 1 ) {
    $sistem_fonksiyonlar_kontrol = $dizin . '/fonksiyonlar.txt';
    if ( file_exists( $sistem_fonksiyonlar_kontrol ) ) {
        $fonksiyonlar = file_get_contents( $sistem_fonksiyonlar_kontrol );
    } else {
        $fonksiyonlar = "yok, yok, yok";
    }
    $fonksiyon = explode( ',', $fonksiyonlar );
    if ( file_exists( $dizin . 'kaldir.php' ) ) {
        require $dizin . 'kaldir.php';
        if ( function_exists( $fonksiyon[ 2 ] ) ) {
            $WMform->bilgi( $fonksiyon[ 2 ]() );
            echo '<meta http-equiv="refresh" content="4;URL=#">';
        } else {
            $WMform->hata( "Kaldırma fonksiyonu yok" );
        }
    } else {
        $WMform->hata( "Sistemi kaldırma dosyası yok" );
    }
} else if ( $pid == 2 ) {
    $sistem_fonksiyonlar_kontrol = $dizin . '/fonksiyonlar.txt';
    if ( file_exists( $sistem_fonksiyonlar_kontrol ) ) {
        $fonksiyonlar = file_get_contents( $sistem_fonksiyonlar_kontrol );
    } else {
        $fonksiyonlar = "yok, yok, yok";
    }
    $fonksiyon = explode( ',', $fonksiyonlar );
    if ( file_exists( $dizin . 'yukle.php' ) ) {
        require $dizin . 'yukle.php';
        if ( function_exists( $fonksiyon[ 1 ] ) ) {
            $WMform->bilgi( $fonksiyon[ 1 ]() );
            echo '<meta http-equiv="refresh" content="4;URL=#">';
        } else {
            $WMform->hata( "Yükleme fonksiyonu yok" );
        }
    } else {
        $WMform->hata( "Sistemi yükleme dosyası yok" );
    }
} else {
    $WMform->hata();
}
?>