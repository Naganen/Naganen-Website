<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $mailhost   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "mailhost" ] ) ) );
    $mailuser   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "mailuser" ] ) ) );
    $mailpass   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "mailpass" ] ) ) );
    $mailport   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "mailport" ] ) ) );
    $mailisim   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "mailisim" ] ) ) );
    $mail       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "mail" ] ) ) );
    $security   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "security" ] ) ) );
    $admin_mail = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "admin_mail" ] ) ) );
    $update     = $db->prepare( "UPDATE ayarlar SET mail_host = ?, mail_user = ?, mail_pass = ?, mail_port = ?, mail_isim = ?, mail_profil = ?, mail_secure = ?, admin_mail = ?" );
    $guncelle   = $update->execute( array(
         $mailhost,
        $mailuser,
        $mailpass,
        $mailport,
        $mailisim,
        $mail,
        $security,
        $admin_mail 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( "Mail ayarları güncellendi" );
        $WMform->basari( "Mail ayarları başarıyla değiştirildi" );
    } else {
        $WMform->hata();
    }
}
?>