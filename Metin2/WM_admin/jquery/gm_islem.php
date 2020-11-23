<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $sahip    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sahip" ] ) ) );
    $karakter = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "karakter" ] ) ) );
    $ip       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "ip" ] ) ) );
    $yetki    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "yetki" ] ) ) );
    $kontrol  = $odb->prepare( "SELECT player.name, account.login FROM account.account LEFT JOIN player.player ON player.account_id = account.id WHERE player.name = ? && account.login = ?" );
    $kontrol->execute( array(
         $karakter,
        $sahip 
    ) );
    $kontrol  = $kontrol->rowCount();
    $kontrol2 = $odb->prepare( "SELECT gmlist.mAccount FROM common.gmlist WHERE (gmlist.mAccount = ? && gmlist.mName = ?) " );
    $kontrol2->execute( array(
         $sahip,
        $karakter 
    ) );
    if ( !$sahip || !$karakter || !$yetki ) {
        $WMform->hata( "İP Adresi hariç boş alan bırakamazsınız." );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Karakter ile kullanıcı sahibi birbiriyle uyuşmuyor." );
    } else if ( $kontrol2->rowCount() ) {
        $WMform->hata( "Böyle bir GM Zaten Eklenmiş" );
    } else {
        $insert = $odb->prepare( "INSERT INTO common.gmlist SET gmlist.mAccount = ?, gmlist.mName = ?, gmlist.mContactIP = ?, gmlist.mAuthority = ?, gmlist.mServerIP = ?" );
        $ekle   = $insert->execute( array(
             $sahip,
            $karakter,
            $ip,
            $yetki,
            'ALL' 
        ) );
        if ( $ekle ) {
            $WMadmin->log_gonder( $karakter . " Adlı GM eklendi" );
            $WMform->basari( "<b>" . $karakter . "</b> Adlı GM başarıyla eklendi" );
            echo '<meta http-equiv="refresh" content="2;URL=#">';
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 2 ) {
    $id      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
    $kontrol = $odb->prepare( "SELECT gmlist.mName FROM common.gmlist WHERE mID = ?" );
    $kontrol->execute( array(
         $id 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "mName" ] . " Adlı GM silindi" );
        $gm_sil = $odb->prepare( "DELETE FROM common.gmlist WHERE gmlist.mID = ? " );
        $gm_sil->execute( array(
             $id 
        ) );
        if ( $gm_sil ) {
            $WMform->jquery_sil( 'tr#gm-' . $id . '' );
            $WMform->basari( "GM Başarıyla Silindi" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Silincek Kategori Bulunamadı" );
    }
} else {
    $pid      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
    $sahip    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sahip-$fid" ] ) ) );
    $karakter = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "karakter-$fid" ] ) ) );
    $ip       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "ip-$fid" ] ) ) );
    $yetki    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "yetki-$fid" ] ) ) );
    $kontrol  = $odb->prepare( "SELECT player.name, account.login FROM account.account LEFT JOIN player.player ON player.account_id = account.id WHERE player.name = ? && account.login = ?" );
    $kontrol->execute( array(
         $karaker,
        $sahip 
    ) );
    $kontrol  = $kontrol->fetch();
    $kontrol2 = $odb->prepare( "SELECT gmlist.mAccount FROM common.gmlist WHERE gmlist.mID != ? && (gmlist.mAccount = ? && gmlist.mName = ?) " );
    $kontrol2->execute( array(
         $pid,
        $sahip,
        $karakter 
    ) );
    if ( !$sahip || !$karakter || !$yetki ) {
        $WMform->hata( "Kategori ismi ve sırası boş bırakılamaz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Karakter ile kullanıcı sahibi birbiriyle uyuşmuyor." );
    } else if ( $kontrol2->rowCount() ) {
        $WMform->hata( "Böyle bir GM Zaten Eklenmiş" );
    } else {
        $bak = $odb->prepare( "SELECT gmlist.mName FROM common.gmlist WHERE gmlist.mID = '$pid'" );
        $bak->execute( array(
             $pid 
        ) );
        $bak = $bak->fetch();
        $WMadmin->log_gonder( $bak[ "mName" ] . " Adlı GM düzenlendi" );
        $update   = $odb->prepare( "UPDATE common.gmlist SET gmlist.mAccount = ?, gmlist.mName = ?, gmlist.mContactIP = ?, gmlist.mAuthority = ? WHERE mID = ?" );
        $guncelle = $update->execute( array(
             $sahip,
            $karakter,
            $ip,
            $yetki,
            $pid 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "GM başarıyla güncellendi" );
        } else {
            $WMform->hata();
        }
    }
}
?>