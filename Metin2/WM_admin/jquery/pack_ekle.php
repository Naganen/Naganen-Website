<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$sira         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sira" ] ) ) );
$pack         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pack" ] ) ) );
$aciklama     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "aciklama" ] ) ) );
$boyut        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "boyut" ] ) ) );
$linkler      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "linkler" ] ) ) );
$sira_kontrol = $db->prepare( "SELECT sira FROM packlar WHERE sid = ? && sira = ?" );
$sira_kontrol->execute( array(
     $_SESSION[ "server" ],
    $sira 
) );
if ( $sira_kontrol->rowCount() ) {
    $WMform->hata( $sira . '. Sırada zaten bir pack var' );
} else if ( !$sira || !$pack || !$aciklama || !$boyut || !$linkler ) {
    $WMform->hata( 'Hiç Bir Alanı Boş Bırakamazsınız' );
} else {
    $WMadmin->log_gonder( $pack . " Adlı Pack Eklendi" );
    $insert = $db->prepare( "INSERT INTO packlar SET sid = ?, sira = ?, pack = ?, aciklama = ?, boyut = ?, linkler = ?" );
    $ekle   = $insert->execute( array(
         $_SESSION[ "server" ],
        $sira,
        $pack,
        $aciklama,
        $boyut,
        $linkler 
    ) );
    if ( $ekle ) {
        $WMform->basari( "Pack Başarıyla Eklendi" );
    } else {
        $WMform->hata();
    }
}
?>