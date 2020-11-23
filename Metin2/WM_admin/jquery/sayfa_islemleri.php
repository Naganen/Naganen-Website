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
        $kontrol  = $db->prepare( "SELECT seo FROM sayfalar WHERE sid = ? && seo = ?" );
        $kontrol->execute( array(
             $_SESSION[ "server" ],
            $seo_link 
        ) );
        if ( $kontrol->rowCount() ) {
            $seo = $seo_link . '-2';
        } else {
            $seo = $seo_link;
        }
        $insert = $db->prepare( "INSERT INTO sayfalar SET sid = ?, konu = ?, icerik = ?, seo = ?" );
        $ekle   = $insert->execute( array(
             $_SESSION[ "server" ],
            $konu,
            $icerik,
            $seo 
        ) );
        if ( $ekle ) {
            $WMadmin->log_gonder( $konu . " Adlı Sayfa eklendi" );
            $WMform->basari( "Sayfayı başarıyla Eklediniz" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Sayfa Konusunu Boş Bırakamazsını" );
    }
} else if ( $fid == 2 ) {
    $sayfa_id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
    $konu     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "konu" ] ) ) );
    if ( $konu != '' ) {
        $icerik   = $WMkontrol->WM_tostring( $_POST[ "icerik" ] );
        $seo_link = $WMkontrol->WM_eng( $konu );
        $kontrol  = $db->prepare( "SELECT seo,konu FROM sayfalar WHERE sid = ? && seo = ? && id != ?" );
        $kontrol->execute( array(
             $_SESSION[ "server" ],
            $seo_link,
            $sayfa_id 
        ) );
        if ( $kontrol->rowCount() ) {
            $seo = $seo_link . '-2';
        } else {
            $seo = $seo_link;
        }
        $update   = $db->prepare( "UPDATE sayfalar SET konu = ?, icerik = ?, seo = ? WHERE id = ? && sid = ?" );
        $guncelle = $update->execute( array(
             $konu,
            $icerik,
            $seo,
            $sayfa_id,
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $fetch = $db->prepare( "SELECT konu FROM sayfalar WHERE sid = ? && id = ?" );
            $fetch->execute( array(
                 $_SESSION[ "server" ],
                $sayfa_id 
            ) );
            $fetch = $fetch->fetch();
            $WMadmin->log_gonder( $fetch[ "konu" ] . " Adlı Sayfa düzenlendi" );
            $WMform->basari( "Sayfa başarıyla Güncellediniz" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Sayfa Konusunu Boş Bırakamazsını" );
    }
} else if ( $fid == 3 ) {
    $silincek = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "silincek" ] ) ) );
    $kontrol  = $db->prepare( "SELECT konu FROM sayfalar WHERE sid = ? &&  id = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $silincek 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "konu" ] . " Adlı Sayfa silindi" );
        $sil = $db->prepare( "DELETE FROM sayfalar WHERE sid = ? && id = ?" );
        $sil->execute( array(
             $_SESSION[ "server" ],
            $silincek 
        ) );
        if ( $sil ) {
            $WMform->basari( "Sayfa Başarıyla Silindi" );
            $WMform->jquery_sil( 'tr#sayfa-' . $silincek . '' );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Böyle bir Sayfa bulunamadı" );
    }
}
?>