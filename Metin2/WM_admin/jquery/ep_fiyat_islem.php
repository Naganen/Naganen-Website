<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $sira    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sira" ] ) ) );
    $fiyat   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "fiyat" ] ) ) );
    $miktar  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "miktar" ] ) ) );
    $kontrol = $db->prepare( "SELECT sira FROM epfiyatlari WHERE sid = ? && sira = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $sira 
    ) );
    if ( !$sira || !$fiyat || !$miktar ) {
        $WMform->hata( "Boş Alan Bırakamazsınız" );
    } else if ( $kontrol->rowCount() ) {
        $WMform->hata( "Bu sırada zaten bir ep fiyatı var" );
    } else {
        $insert = $db->prepare( "INSERT INTO epfiyatlari SET  sid = ?, sira = ?, fiyat = ?, ep = ?" );
        $ekle   = $insert->execute( array(
             $_SESSION[ "server" ],
            $sira,
            $fiyat,
            $miktar 
        ) );
        if ( $ekle ) {
            $WMadmin->log_gonder( $fiyat . " TL Lik ep fiyatı eklendi" );
            $WMform->basari( "Ep fiyatı başarıyla eklendi" );
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 2 ) {
    $id      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
    $kontrol = $db->prepare( "SELECT id,fiyat FROM epfiyatlari WHERE sid = ? && id = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $id 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "fiyat" ] . " TL Lik Ep fiyatı silindi" );
        $kategori_sil = $db->prepare( "DELETE FROM epfiyatlari WHERE sid = ? && id = ? " );
        $kategori_sil->execute( array(
             $_SESSION[ "server" ],
            $id 
        ) );
        if ( $kategori_sil ) {
            $WMform->jquery_sil( 'tr#ep_fiyatlari-' . $id . '' );
            $WMform->basari( "Ep Fiyatı Başarıyla Silindi" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Silincek EP Fiyatı Bulunamadı" );
    }
} else {
    $pid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
    $sira    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sira-$fid" ] ) ) );
    $fiyat   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "fiyat-$fid" ] ) ) );
    $miktar  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "miktar-$fid" ] ) ) );
    $kontrol = $db->prepare( "SELECT sira FROM epfiyatlari WHERE id != ? && sid = ? && sira = ?" );
    $kontrol->execute( array(
         $pid,
        $_SESSION[ "server" ],
        $sira 
    ) );
    if ( !$sira || !$fiyat || !$miktar ) {
        $WMform->hata( "Boş Alan Bırakamazsınız" );
    } else if ( $kontrol->rowCount() ) {
        $WMform->hata( "Bu sırada zaten bir ep fiyatı var" );
    } else {
        $bak = $db->prepare( "SELECT fiyat FROM epfiyatlari WHERE id = ? && sid = ?" );
        $bak->execute( array(
             $pid,
            $_SESSION[ "server" ] 
        ) );
        $bak = $bak->fetch();
        $WMadmin->log_gonder( $bak[ "fiyat" ] . " TL Lik Ep Fiyatı Güncellendi" );
        $update   = $db->prepare( "UPDATE epfiyatlari SET  sira = ?, fiyat = ?, ep = ? WHERE sid = ? && id = ?" );
        $guncelle = $update->execute( array(
             $sira,
            $fiyat,
            $miktar,
            $_SESSION[ "server" ],
            $pid 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "EP Fiyatı başarıyla güncellendi" );
        } else {
            $WMform->hata();
        }
    }
}
?>