<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $tas     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "tas" ] ) ) );
    $vnum    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "vnum" ] ) ) );
    $tur     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "tur" ] ) ) );
    $kontrol = $db->prepare( "SELECT id FROM market_tas WHERE sid = ? && tur = ? && vnum = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $tur,
        $vnum 
    ) );
    if ( !$tas || !$vnum || !$tur ) {
        $WMform->hata( "Boş alan bırakamazsınız" );
    } else if ( $kontrol->rowCount() ) {
        $WMform->hata( "Böyle bir taş zaten var" );
    } else {
        $insert = $db->prepare( "INSERT INTO market_tas SET  sid = ?, tas = ?, tur = ?, vnum = ?" );
        $ekle   = $insert->execute( array(
             $_SESSION[ "server" ],
            $tas,
            $tur,
            $vnum 
        ) );
        if ( $ekle ) {
            $WMadmin->log_gonder( $tas . " Adlı Market Taşı eklendi" );
            $WMform->basari( "Taş başarıyla eklendi" );
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 2 ) {
    $id      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
    $kontrol = $db->prepare( "SELECT id,tas FROM market_tas WHERE sid = ? && id = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $id 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "isim" ] . " Adlı Market Taşı silindi" );
        $tas_sil = $db->prepare( "DELETE FROM market_tas WHERE sid = ? && id = ? " );
        $tas_sil->execute( array(
             $_SESSION[ "server" ],
            $id 
        ) );
        if ( $tas_sil ) {
            $WMform->jquery_sil( 'tr#market_tas-' . $id . '' );
            $WMform->basari( "Taş Başarıyla Silindi" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Silincek Taş Bulunamadı" );
    }
} else {
    $pid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
    $tas     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "tas-$fid" ] ) ) );
    $tur     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "tur-$fid" ] ) ) );
    $vnum    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "vnum-$fid" ] ) ) );
    $kontrol = $db->prepare( "SELECT id FROM market_tas WHERE id != ? && sid = ? && tur = ? && vnum = ?" );
    $tas_sil->execute( array(
         $pid,
        $_SESSION[ "server" ],
        $tur,
        $vnum 
    ) );
    if ( !$tas || !$tur || !$vnum ) {
        $WMform->hata( "Boş Alan Bırakılamaz." );
    } else if ( $kontrol->rowCount() ) {
        $WMform->hata( "Böyle bir taş zaten var" );
    } else {
        $bak = $db->prepare( "SELECT tas FROM market_tas WHERE id = ? && sid = ?" );
        $bak->execute( array(
             $pid,
            $_SESSION[ "server" ] 
        ) );
        $bak = $bak->fetch();
        $WMadmin->log_gonder( $bak[ "tas" ] . " Adlı Market Taşı düzenlendi" );
        $update   = $db->prepare( "UPDATE market_tas SET  tas = ?, tur = ?, vnum = ? WHERE sid = ? && id = ?" );
        $guncelle = $update->execute( array(
             $tas,
            $tur,
            $vnum,
            $_SESSION[ "server" ],
            $pid 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Taş Başarıyla Güncellendi" );
        } else {
            $WMform->hata();
        }
    }
}
?>