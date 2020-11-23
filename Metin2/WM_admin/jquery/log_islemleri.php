<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $tur    = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tur" ] ) ) );
    $update = $db->prepare( "UPDATE server SET log = ? WHERE id = ?" );
    if ( $tur == 1 ) {
        $WMadmin->log_gonder( "Log açıldı" );
        $guncelle = $update->execute( array(
             1,
            $_SESSION[ "server" ] 
        ) );
    } else if ( $tur == 2 ) {
        $WMadmin->log_gonder( "Log Kapandı" );
        $guncelle = $update->execute( array(
             2,
            $_SESSION[ "server" ] 
        ) );
    }
    if ( $guncelle ) {
        $WMform->basari( "Log ayarı başarıyla güncellendi" );
        echo '<meta http-equiv="refresh" content="2;URL=#">';
    } else {
        $WMform->hata();
    }
} else if ( $fid == 2 ) {
    $id     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
    $delete = $db->prepare( "DELETE FROM log WHERE sid = ? && id = ?" );
    $sil    = $delete->execute( array(
         $_SESSION[ "server" ],
        $id 
    ) );
    if ( $sil ) {
        $WMform->jquery_sil( 'tr#log-' . $id . '' );
        $WMform->basari( "Log başarıyla silindi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 3 ) {
    $tur    = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tur" ] ) ) );
    $update = $db->prepare( "UPDATE server SET kullanici_log = ? WHERE id = ?" );
    if ( $tur == 1 ) {
        $WMadmin->log_gonder( "Kullanıcı Logları açıldı" );
        $guncelle = $update->execute( array(
             1,
            $_SESSION[ "server" ] 
        ) );
    } else if ( $tur == 2 ) {
        $WMadmin->log_gonder( "Kullanıcı Logları Kapandı" );
        $guncelle = $update->execute( array(
             2,
            $_SESSION[ "server" ] 
        ) );
    }
    if ( $guncelle ) {
        $WMform->basari( "Log ayarı başarıyla güncellendi" );
        echo '<meta http-equiv="refresh" content="2;URL=#">';
    } else {
        $WMform->hata();
    }
}
?>