<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $istatistikler = array( );
    if ( isset( $_POST[ "online_oyuncu" ] ) ) {
        $istatistikler[ 0 ] = 1;
    } else {
        $istatistikler[ 0 ] = 2;
    }
    if ( isset( $_POST[ "rekor_online" ] ) ) {
        $istatistikler[ 1 ] = 1;
    } else {
        $istatistikler[ 1 ] = 2;
    }
    if ( isset( $_POST[ "toplam_kayit" ] ) ) {
        $istatistikler[ 2 ] = 1;
    } else {
        $istatistikler[ 2 ] = 2;
    }
    if ( isset( $_POST[ "toplam_karakter" ] ) ) {
        $istatistikler[ 3 ] = 1;
    } else {
        $istatistikler[ 3 ] = 2;
    }
    if ( isset( $_POST[ "toplam_lonca" ] ) ) {
        $istatistikler[ 4 ] = 1;
    } else {
        $istatistikler[ 4 ] = 2;
    }
    $istatistik  = json_encode( $istatistikler );
    $siralamalar = array( );
    if ( isset( $_POST[ "oyuncu_siralama" ] ) ) {
        $siralamalar[ 0 ] = 1;
    } else {
        $siralamalar[ 0 ] = 2;
    }
    if ( isset( $_POST[ "lonca_siralama" ] ) ) {
        $siralamalar[ 1 ] = 1;
    } else {
        $siralamalar[ 1 ] = 2;
    }
    $siralama = json_encode( $siralamalar );
    $droplar  = array( );
    if ( isset( $_POST[ "exp_drop" ] ) ) {
        $droplar[ 0 ] = 1;
    } else {
        $droplar[ 0 ] = 2;
    }
    if ( isset( $_POST[ "yang_drop" ] ) ) {
        $droplar[ 1 ] = 1;
    } else {
        $droplar[ 1 ] = 2;
    }
    if ( isset( $_POST[ "esya_drop" ] ) ) {
        $droplar[ 2 ] = 1;
    } else {
        $droplar[ 2 ] = 2;
    }
    $drop          = json_encode( $droplar );
    $genel_ayarlar = array( );
    if ( isset( $_POST[ "yan_menu" ] ) ) {
        $genel_ayarlar[ 0 ] = 1;
    } else {
        $genel_ayarlar[ 0 ] = 2;
    }
    if ( isset( $_POST[ "server_durum" ] ) ) {
        $genel_ayarlar[ 1 ] = 1;
    } else {
        $genel_ayarlar[ 1 ] = 2;
    }
    if ( isset( $_POST[ "facebook" ] ) ) {
        $genel_ayarlar[ 2 ] = 1;
    } else {
        $genel_ayarlar[ 2 ] = 2;
    }
    $genel      = json_encode( $genel_ayarlar );
    $tum_guncel = array(
         $istatistik,
        $siralama,
        $drop,
        $genel 
    );
    $update     = $db->prepare( "UPDATE server SET tema_a = ? WHERE id = ?" );
    $guncelle   = $update->execute( array(
         json_encode( $tum_guncel ),
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( "Tema ayarları güncellendi" );
        $WMform->basari( "Tema ayarları başarıyla güncellendi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 2 ) {
    $duyuru = array( );
    if ( isset( $_POST[ "duyuru_aktif" ] ) ) {
        $duyuru[ 0 ] = 1;
    } else {
        $duyuru[ 0 ] = 2;
    }
    $duyuru[ 1 ] = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "duyurubaslik" ] ) ) );
    $duyuru[ 2 ] = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "duyuruicerik" ] ) ) );
    if ( ( $duyuru[ 0 ] == 1 ) && ( !$duyuru[ 1 ] || !$duyuru[ 2 ] ) ) {
        $WMform->hata( "Duyuru aktif olduğu için başlığı ve içeriği boş bırakamazsınız" );
    } 
	else {
        $duyurum  = json_encode( $duyuru );
        $update   = $db->prepare( "UPDATE server SET duyuru = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
            $duyurum,
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Tema ayarları güncellendi" );
            $WMform->basari( "Tema ayarları başarıyla güncellendi" );
        } else {
            $WMform->hata();
        }
    }
}
?>