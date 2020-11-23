<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $kategori = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kategori" ] ) ) );
    $sira     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sira" ] ) ) );
    $kontrol  = $db->prepare( "SELECT sira FROM market_kategori WHERE sid = ? && sira = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $sira 
    ) );
    $kontrol2 = $db->prepare( "SELECT sira FROM market_kategori WHERE sid = ? && (isim = ? || seo = ?)" );
    $kontrol2->execute( array(
         $_SESSION[ "server" ],
        $kategori,
        $WMkontrol->WM_eng( $kategori ) 
    ) );
    if ( !$kategori || !$sira ) {
        $WMform->hata( "Kategori  İsmini ve Sırayı Boş Bırakamazsınız" );
    } else if ( $kontrol->rowCount() ) {
        $WMform->hata( "Bu sırada zaten bir kategori var" );
    } else if ( $kontrol2->rowCount() ) {
        $WMform->hata( "Böyle bir kategori zaten var" );
    } else {
        $insert = $db->prepare( "INSERT INTO market_kategori SET  sid = ?, sira = ?, isim = ?, seo = ?" );
        $ekle   = $insert->execute( array(
             $_SESSION[ "server" ],
            $sira,
            $kategori,
            $WMkontrol->WM_eng( $kategori ) 
        ) );
        if ( $ekle ) {
            $WMadmin->log_gonder( $kategori . " Adlı Market Kategorisi eklendi" );
            $WMform->basari( "Kategori başarıyla eklendi" );
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 2 ) {
    $id      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
    $kontrol = $db->prepare( "SELECT id,isim FROM market_kategori WHERE sid = ? && id = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $id 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "isim" ] . " Adlı Market kategorisi silindi" );
        $kategori_sil = $db->prepare( "DELETE FROM market_kategori WHERE sid = ? && id = ? " );
        $kategori_sil->execute( array(
             $_SESSION[ "server" ],
            $id 
        ) );
        if ( $kategori_sil ) {
            $itemler_sil = $db->prepare( "DELETE FROM market_item WHERE sid = ?' && kid = ? " );
            $itemler_sil->execute( array(
                 $_SESSION[ "server" ],
                $id 
            ) );
            if ( $itemler_sil ) {
                $WMform->jquery_sil( 'tr#market_kategori-' . $id . '' );
                $WMform->basari( "Kategori Başarıyla Silindi" );
            } else {
                $WMform->hata();
            }
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Silincek Kategori Bulunamadı" );
    }
} else {
    $pid      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
    $kategori = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "isim-$fid" ] ) ) );
    $sira     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sira-$fid" ] ) ) );
    $kontrol  = $db->prepare( "SELECT sira FROM market_kategori WHERE id != ? && sid = ? && sira = ?" );
    $kontrol->execute( array(
         $pid,
        $_SESSION[ "server" ],
        $sira 
    ) );
    $kontrol2 = $db->prepare( "SELECT sira FROM market_kategori WHERE id != ? && sid = ? && (isim = ? || seo = ?)" );
    $kontrol2->execute( array(
         $pid,
        $_SESSION[ "server" ],
        $kategori,
        $WMkontrol->WM_eng( $kategori ) 
    ) );
    if ( !$kategori || !$sira ) {
        $WMform->hata( "Kategori ismi ve sırası boş bırakılamaz" );
    } else if ( $kontrol->rowCount() ) {
        $WMform->hata( "Bu sırada zaten bir kategori var" );
    } else if ( $kontrol2->rowCount() ) {
        $WMform->hata( "Böyle bir kategori zaten var" );
    } else {
        $bak = $db->prepare( "SELECT isim FROM market_kategori WHERE id = ? && sid = ?" );
        $bak->execute( array(
             $pid,
            $_SESSION[ "server" ] 
        ) );
        $bak = $bak->fetch();
        $WMadmin->log_gonder( $bak[ "isim" ] . " Adlı Market kategorisi düzenlendi" );
        $update   = $db->prepare( "UPDATE market_kategori SET  sira = ?, isim = ?, seo = ? WHERE sid = ? && id = ?" );
        $guncelle = $update->execute( array(
             $sira,
            $kategori,
            $WMkontrol->WM_eng( $kategori ),
            $_SESSION[ "server" ],
            $pid 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Kategori başarıyla güncellendi" );
        } else {
            $WMform->hata();
        }
    }
}
?>