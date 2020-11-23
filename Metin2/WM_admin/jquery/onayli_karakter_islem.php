<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $isim    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "isim" ] ) ) );
    $kontrol = $db->prepare( "SELECT isim FROM onayli_karakter WHERE sid = ? && isim = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $isim 
    ) );
    $kontrol2 = $odb->prepare( "SELECT name FROM player.player WHERE name = ?" );
    $kontrol2->execute( array(
         $isim 
    ) );
    $kontrol2 = $kontrol2->rowCount();
    if ( !$isim ) {
        $WMform->hata( "Karakter ismini boş bırakamazsınız" );
    } else if ( $kontrol->rowCount() ) {
        $WMform->hata( "Böyle bir onaylı karakter zaten var" );
    } else if ( $kontrol2 == 0 ) {
        $WMform->hata( "Böyle bir karakter bulunamadı" );
    } else {
        $insert = $db->prepare( "INSERT INTO onayli_karakter SET  sid = ?, isim = ?, tarih = ?" );
        $ekle   = $insert->execute( array(
             $_SESSION[ "server" ],
            $isim,
            date( "Y-m-d H:i:s" ) 
        ) );
        if ( $ekle ) {
            $WMadmin->log_gonder( $isim . " Adlı Onaylanmış Karakter Eklendi" );
            $WMform->basari( "Onaylanmış Karakter başarıyla eklendi" );
            echo '<meta http-equiv="refresh" content="2;URL=#">';
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 2 ) {
    $id      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
    $kontrol = $db->prepare( "SELECT id,isim FROM onayli_karakter WHERE sid = ? && id = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $id 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "isim" ] . " Adlı Onaylı Karakter silindi" );
        $onayli_sil = $db->prepare( "DELETE FROM onayli_karakter WHERE sid = ? && id = ? " );
        $onayli_sil->execute( array(
             $_SESSION[ "server" ],
            $id 
        ) );
        if ( $onayli_sil ) {
            $WMform->jquery_sil( 'tr#onayli_karakter-' . $id . '' );
            $WMform->basari( "Onaylı Karakter Başarıyla Silindi" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Silincek Kategori Bulunamadı" );
    }
} else {
    $pid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
    $isim    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "isim-$fid" ] ) ) );
    $kontrol = $db->prepare( "SELECT isim FROM onayli_karakter WHERE id != ? && sid = ? && isim = ?" );
    $kontrol->execute( array(
         $pid,
        $_SESSION[ "server" ],
        $isim 
    ) );
    $kontrol2 = $odb->prepare( "SELECT name FROM player.player WHERE name = ?" );
    $kontrol2->execute( array(
         $isim 
    ) );
    $kontrol2 = $kontrol2->fetch();
    if ( !$isim ) {
        $WMform->hata( "Karakter ismini boş bırakamazsınız" );
    } else if ( $kontrol->rowCount() ) {
        $WMform->hata( "Böyle bir onaylı karakter zaten var" );
    } else if ( $kontrol2 == 0 ) {
        $WMform->hata( "Böyle bir karakter bulunamadı" );
    } else {
        $bak = $db->prepare( "SELECT isim FROM onayli_karakter WHERE id = ? && sid = ?" );
        $bak->execute( array(
             $pid,
            $_SESSION[ "server" ] 
        ) );
        $bak = $bak->fetch();
        $WMadmin->log_gonder( $bak[ "isim" ] . " Adlı Onaylı Karakter düzenlendi" );
        $update   = $db->prepare( "UPDATE `onayli_karakter` SET `isim` = ? WHERE sid = ?  && id = ?" );
        $guncelle = $update->execute( array(
             $isim,
            $_SESSION[ "server" ],
            $pid 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Onaylı Karakter başarıyla güncellendi" );
        } else {
            $WMform->hata();
        }
    }
}
?>