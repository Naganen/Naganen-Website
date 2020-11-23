<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$sosyal = json_decode( $WMadmin->serverbilgi( "sosyal_ag" ) );
$fid    = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 || $fid == 2 ) {
    $kral_oyuncu = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kral_oyuncu" ] ) ) );
    $kral_lonca  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kral_lonca" ] ) ) );
    if ( $fid == 1 ) {
        $tur     = "Oyuncu";
        $kontrol = $odb->prepare( "SELECT name FROM player.player WHERE player.name = ?" );
        $kontrol->execute( array(
             $kral_oyuncu 
        ) );
        if ( !$kral_oyuncu ) {
            $kontrol_t = 2;
        } else {
            if ( $kontrol->rowCount() ) {
                $kontrol_t = 2;
            } else {
                $kontrol_t = 1;
            }
        }
    } else if ( $fid == 2 ) {
        $tur     = "Lonca";
        $kontrol = $odb->prepare( "SELECT name FROM player.guild WHERE name = ?" );
        $kontrol->execute( array(
             $kral_lonca 
        ) );
        if ( !$kral_lonca ) {
            $kontrol_t = 2;
        } else {
            if ( $kontrol->rowCount() ) {
                $kontrol_t = 2;
            } else {
                $kontrol_t = 1;
            }
        }
    }
    if ( $kontrol_t == 2 ) {
        $update   = $db->prepare( "UPDATE server SET krallar = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $kral_oyuncu . ',' . $kral_lonca,
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Krallar listesi güncellendi" );
            $WMform->basari( "Kral " . $tur . ' Başarıyla Güncellendi' );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( $tur . ' Bulunamadı' );
    }
} else if ( $fid == 3 ) {
    $facebook   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "facebook" ] ) ) );
    $array_yeni = array(
         0 => $facebook 
    );
    $degis      = array_replace( $sosyal, $array_yeni );
    $update     = $db->prepare( "UPDATE server SET sosyal_ag = ? WHERE id = ?" );
    $guncelle   = $update->execute( array(
         json_encode( $degis ),
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Facebook adresi başarıyla güncellendi" );
        $WMadmin->log_gonder( "Facebook adresi " . $facebook . " olarak değiştirildi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 4 ) {
    $youtube    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "youtube" ] ) ) );
    $array_yeni = array(
         1 => $youtube 
    );
    $degis      = array_replace( $sosyal, $array_yeni );
    $update     = $db->prepare( "UPDATE server SET sosyal_ag = ? WHERE id = ?" );
    $guncelle   = $update->execute( array(
         json_encode( $degis ),
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Youtube adresi başarıyla güncellendi" );
        $WMadmin->log_gonder( "Youtube adresi " . $youtube . " olarak değiştirildi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 5 ) {
    $twitter    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "twitter" ] ) ) );
    $array_yeni = array(
         2 => $twitter 
    );
    $degis      = array_replace( $sosyal, $array_yeni );
    $update     = $db->prepare( "UPDATE server SET sosyal_ag = ? WHERE id = ?" );
    $guncelle   = $update->execute( array(
         json_encode( $degis ),
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Twitter adresi başarıyla güncellendi" );
        $WMadmin->log_gonder( "Twitter adresi " . $twitter . " olarak değiştirildi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 6 ) {
    $tanitim    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "tanitim" ] ) ) );
    $array_yeni = array(
         3 => $tanitim 
    );
    $degis      = array_replace( $sosyal, $array_yeni );
    $update     = $db->prepare( "UPDATE server SET sosyal_ag = ? WHERE id = ?" );
    $guncelle   = $update->execute( array(
         json_encode( $degis ),
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Tanıtım Video adresi başarıyla güncellendi" );
        $WMadmin->log_gonder( "Tanıtım video adresi " . $tanitim . " olarak değiştirildi" );
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata();
}
?>