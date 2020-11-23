<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $konu = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "konu" ] ) ) );
    if ( $konu != '' ) {
        $icerik   = $WMkontrol->WM_tostring( $_POST[ "icerik" ] );
        $seo_link = $WMkontrol->WM_eng( $konu );
        $kontrol  = $db->prepare( "SELECT seo FROM market_duyuru WHERE sid = ? && seo = ?" );
        $kontrol->execute( array(
             $_SESSION[ "server" ],
            $seo_link 
        ) );
        if ( $kontrol->rowCount() ) {
            $seo = $seo_link . '-2';
        } else {
            $seo = $seo_link;
        }
        $insert = $db->prepare( "INSERT INTO market_duyuru SET sid = ?, konu = ?, icerik = ?, tarih = ?, seo = ?" );
        $ekle   = $insert->execute( array(
             $_SESSION[ "server" ],
            $konu,
            $icerik,
            date( "Y-m-d H:i:s" ),
            $seo 
        ) );
        if ( $ekle ) {
            $WMadmin->log_gonder( $konu . " Adlı Market Duyurusu eklendi" );
            $WMform->basari( "Market Duyurusu başarıyla Eklediniz" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Konuyu Boş Bırakamazsını" );
    }
} else if ( $fid == 2 ) {
    $duyuru_id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
    $konu      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "konu" ] ) ) );
    if ( $konu != '' ) {
        $icerik   = $WMkontrol->WM_tostring( $_POST[ "icerik" ] );
        $seo_link = $WMkontrol->WM_eng( $konu );
        $kontrol  = $db->prepare( "SELECT seo,konu FROM market_duyuru WHERE sid = ? && seo = ? && id != ?" );
        $kontrol->execute( array(
             $_SESSION[ "server" ],
            $seo_link,
            $duyuru_id 
        ) );
        if ( $kontrol->rowCount() ) {
            $seo = $seo_link . '-2';
        } else {
            $seo = $seo_link;
        }
        $update   = $db->prepare( "UPDATE market_duyuru SET sid = ?,  konu = ?, icerik = ?, seo = ? WHERE id = ? && sid = ?" );
        $guncelle = $update->execute( array(
             $_SESSION[ "server" ],
            $konu,
            $icerik,
            $seo,
            $duyuru_id,
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $fetch = $db->prepare( "SELECT konu FROM market_duyuru WHERE sid = ? && id = ?" );
            $fetch->execute( array(
                 $_SESSION[ "server" ],
                $duyuru_id 
            ) );
            $fetch = $fetch->fetch();
            $WMadmin->log_gonder( $fetch[ "konu" ] . " Adlı market duyurusu düzenlendi" );
            $WMform->basari( "Market Duyurusunu başarıyla Güncellediniz" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Konuyu Boş Bırakamazsını" );
    }
} else if ( $fid == 3 ) {
    $silincek = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "silincek" ] ) ) );
    $kontrol  = $db->prepare( "SELECT konu FROM market_duyuru WHERE sid = ? &&  id = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $silincek 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "konu" ] . " Adlı market duyuru silindi" );
        $sil = $db->prepare( "DELETE FROM market_duyuru WHERE sid = ? && id = ?" );
        $sil->execute( array(
             $_SESSION[ "server" ],
            $silincek 
        ) );
        if ( $sil ) {
            $WMform->basari( "Duyuru Başarıyla Silindi" );
            $WMform->jquery_sil( 'tr#duyuru-' . $silincek . '' );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Böyle bir market duyurusu bulunamadı" );
    }
}
?>