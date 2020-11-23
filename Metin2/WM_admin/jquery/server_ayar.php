<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 3 ) {
    @$ayar = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ayar" ] ) ) );
    @$ayar2 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ayar2" ] ) ) );
    @$ayar5 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ayar5" ] ) ) );
    if ( $ayar ) {
        $a = 1;
    } else {
        $a = 2;
    }
    if ( $ayar2 ) {
        $b = 1;
    } else {
        $b = 2;
    }
    if ( $ayar5 ) {
        $c = 1;
    } else {
        $c = 2;
    }
    $array        = array(
         0 => $a,
        1 => $b,
        4 => $c 
    );
    $suankiarray1 = json_decode( $WMadmin->serverbilgi( "ayar" ) );
    $array_degis  = array_replace( $suankiarray1, $array );
    $guncellencek = json_encode( $array_degis );
    $update       = $db->prepare( "UPDATE server SET ayar = ? WHERE id = ?" );
    $guncelle     = $update->execute( array(
         $guncellencek,
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Server ayarları güncellendi" );
        $WMadmin->log_gonder( "Server ayarlarını güncelledi ( Sağ tık engeli vs)" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 4 ) {
    @$ayar3 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ayar3" ] ) ) );
    @$icerik_duyuru = $WMkontrol->WM_tostring( $_POST[ "icerik_duyuru" ] );
    if ( $ayar3 ) {
        $a = 1;
    } else {
        $a = 2;
    }
    $suankiarray1  = json_decode( $WMadmin->serverbilgi( "ayar" ) );
    $yeni_array1   = array(
         2 => $a 
    );
    $duyuru_icerik = json_decode( $WMadmin->serverbilgi( "duyuru_2" ) );
    $yeni_array2   = array(
         0 => $icerik_duyuru 
    );
    $degistir1     = array_replace( $suankiarray1, $yeni_array1 );
    $degistir2     = array_replace( $duyuru_icerik, $yeni_array2 );
    $update        = $db->prepare( "UPDATE server SET ayar = ?, duyuru_2 = ? WHERE id = ? " );
    $guncelle      = $update->execute( array(
         json_encode( $degistir1 ),
        json_encode( $degistir2 ),
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Başarıyla güncellendi" );
        $WMadmin->log_gonder( "Server ayarları, giriş yapılan duyuru ayarları güncellendi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 5 ) {
    @$ayar4 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ayar4" ] ) ) );
    @$icerik_duyuru2 = $WMkontrol->WM_tostring( $_POST[ "icerik_duyuru2" ] );
    if ( $ayar4 ) {
        $a = 1;
    } else {
        $a = 2;
    }
    $suankiarray1  = json_decode( $WMadmin->serverbilgi( "ayar" ) );
    $yeni_array1   = array(
         3 => $a 
    );
    $duyuru_icerik = json_decode( $WMadmin->serverbilgi( "duyuru_2" ) );
    $yeni_array2   = array(
         1 => $icerik_duyuru2 
    );
    $degistir1     = array_replace( $suankiarray1, $yeni_array1 );
    $degistir2     = array_replace( $duyuru_icerik, $yeni_array2 );
    $update        = $db->prepare( "UPDATE server SET ayar = ?, duyuru_2 = ? WHERE id = ? " );
    $guncelle      = $update->execute( array(
         json_encode( $degistir1 ),
        json_encode( $degistir2 ),
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Başarıyla güncellendi" );
        $WMadmin->log_gonder( "Server ayarları,  ana sayfa duyuru ayarları güncellendi" );
    } else {
        $WMform->hata();
    }
}
?>