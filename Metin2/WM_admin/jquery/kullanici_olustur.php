<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$kullanici  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "username" ] ) ) );
$real       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "real" ] ) ) );
$email      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "email" ] ) ) );
$pass       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
$pass_retry = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_retry" ] ) ) );
if ( !$kullanici || !$pass ) {
    $WMform->hata( "Kullanıcı adını ve şifresini boş bırakamazsınız. ! " );
} else if ( $pass != $pass_retry ) {
    $WMform->hata( "Şifreler uyumlu değil" );
} else {
    $kontrol = $odb->prepare( "SELECT id FROM account WHERE login = ?" );
    $kontrol->execute( array(
         $kullanici 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMform->hata( "Böyle bir kullanıcı zaten var" );
    } else {
        $olustur = $odb->prepare( "INSERT INTO account (login, password, create_time, web_ip, real_name, email) values (?, PASSWORD(?), ?, ?, ?, ?)" );
        $olustur->execute( array(
             $kullanici,
            $pass,
            date( "Y-m-d H:i:s" ),
            $_SERVER[ 'REMOTE_ADDR' ],
            $real,
            $email 
        ) );
        if ( $olustur ) {
            $WMform->basari( $kullanici . " Adlı kullanıcı başarıyla oluşturuldu" );
            $WMadmin->log_gonder( $kullanici . " adlı kullanıcı oluşturuldu" );
        } else {
            $WMform->hata();
        }
    }
}
?>