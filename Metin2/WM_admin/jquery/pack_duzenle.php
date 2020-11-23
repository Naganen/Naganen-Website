<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$pid          = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$sira         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sira" ] ) ) );
$pack         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pack" ] ) ) );
$aciklama     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "aciklama" ] ) ) );
$boyut        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "boyut" ] ) ) );
$linkler      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "linkler" ] ) ) );
$sira_kontrol = $db->prepare( "SELECT sira FROM packlar WHERE sid = ? && sira = ? && id != ?" );
$sira_kontrol->execute( array(
     $_SESSION[ "server" ],
    $sira,
    $pid 
) );
if ( $sira_kontrol->rowCount() ) {
    $WMform->hata( $sira . '. Sırada zaten bir pack var' );
} else if ( !$sira || !$pack || !$aciklama || !$boyut || !$linkler ) {
    $WMform->hata( 'Hiç Bir Alanı Boş Bırakamazsınız' );
} else {
    $bak = $db->prepare( "SELECT pack FROM packlar WHERE id = ? && sid = ?" );
    $bak->execute( array(
         $pid,
        $_SESSION[ "server" ] 
    ) );
    $bak = $bak->fetch();
    $WMadmin->log_gonder( $bak[ "pack" ] . " Adlı Pack Düzenlendi" );
    $update   = $db->prepare( "UPDATE packlar SET sira = ?, pack = ?, aciklama = ?, boyut = ?, linkler = ? WHERE id = ?" );
    $guncelle = $update->execute( array(
         $sira,
        $pack,
        $aciklama,
        $boyut,
        $linkler,
        $pid 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Pack Başarıyla Düzenlendi" );
    } else {
        $WMform->hata();
    }
}
?>