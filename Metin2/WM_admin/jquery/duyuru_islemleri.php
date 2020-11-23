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
        $icerik      = $WMkontrol->WM_tostring( $_POST[ "icerik" ] );
        $label_durum = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "label_durum" ][ 0 ] ) ) );
        $seo_link    = $WMkontrol->WM_eng( $konu );
        $kontrol     = $db->prepare( "SELECT seo FROM duyurular WHERE sid = ? && seo = ?" );
        $kontrol->execute( array(
             $_SESSION[ "server" ],
            $seo_link 
        ) );
        if ( $kontrol->rowCount() ) {
            $seo = $seo_link . '-2';
        } else {
            $seo = $seo_link;
        }
        if ( $label_durum ) {
            $label_renk = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "label_renk" ] ) ) );
            $label      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "label" ] ) ) );
        } else {
            $label_renk = "";
            $label      = "";
        }
        $insert = $db->prepare( "INSERT INTO duyurular SET sid = ?, label = ?, labels = ?, konu = ?, icerik = ?, tarih = ?, seo = ?" );
        $ekle   = $insert->execute( array(
             $_SESSION[ "server" ],
            $label_renk,
            $label,
            $konu,
            $icerik,
            date( "Y-m-d H:i:s" ),
            $seo 
        ) );
        if ( $ekle ) {
            $WMadmin->log_gonder( $konu . " Adlı duyuru eklendi" );
            $WMform->basari( "Duyuru başarıyla Eklediniz" );
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
        $icerik      = $WMkontrol->WM_tostring( $_POST[ "icerik" ] );
        $label_durum = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "label_durum" ][ 0 ] ) ) );
        $seo_link    = $WMkontrol->WM_eng( $konu );
        $kontrol     = $db->prepare( "SELECT seo,konu FROM duyurular WHERE sid = ? && seo = ? && id != ?" );
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
        if ( $label_durum ) {
            $label_renk = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "label_renk" ] ) ) );
            $label      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "label" ] ) ) );
        } else {
            $label_renk = "";
            $label      = "";
        }
        $update   = $db->prepare( "UPDATE duyurular SET sid = ?, label = ?, labels = ?, konu = ?, icerik = ?, seo = ? WHERE id = ? && sid = ?" );
        $guncelle = $update->execute( array(
             $_SESSION[ "server" ],
            $label_renk,
            $label,
            $konu,
            $icerik,
            $seo,
            $duyuru_id,
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $fetch = $db->prepare( "SELECT konu FROM duyurular WHERE sid = ? && id = ?" );
            $fetch->execute( array(
                 $_SESSION[ "server" ],
                $duyuru_id 
            ) );
            $fetch = $fetch->execute( array(
                 $duyuru_id 
            ) );
            $WMadmin->log_gonder( $fetch[ "konu" ] . " Adlı duyuru düzenlendi" );
            $WMform->basari( "Duyuru başarıyla Güncellediniz" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Konuyu Boş Bırakamazsını" );
    }
} else if ( $fid == 3 ) {
    $silincek = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "silincek" ] ) ) );
    $kontrol  = $db->prepare( "SELECT konu FROM duyurular WHERE sid = ? &&  id = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $silincek 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "konu" ] . " Adlı duyuru silindi" );
        $sil = $db->prepare( "DELETE FROM duyurular WHERE sid = ? && id = ?" );
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
        $WMform->hata( "Böyle bir duyuru bulunamadı" );
    }
}
?>