<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$pid         = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$host        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "host" ] ) ) );
$user        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "user" ] ) ) );
$pass        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
$port        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "port" ] ) ) );
$isim        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "isim" ] ) ) );
$link        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "link" ] ) ) );
$title       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "title" ] ) ) );
$keywords    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "keywords" ] ) ) );
$description = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "description" ] ) ) );
if ( !$host || !$user || !$port || !$isim || !$link || !$title ) {
    $WMform->hata( "* ile işaretlenen yerler boş bırakılamaz.." );
} else {
    $update   = $db->prepare( "UPDATE server SET host = ?, user = ?, pass = ?, sql_port = ?, isim = ?, link = ?, title = ?, keywords = ?, description = ? WHERE id = ?" );
    $guncelle = $update->execute( array(
         $host,
        $user,
        $pass,
        $port,
        $isim,
        $link,
        $title,
        $keywords,
        $description,
        $pid 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Server Ayarları Başarıyla Güncellendi" );
        $WMadmin->log_gonder( $isim . " Serverı Düzenlendi" );
        echo '<meta http-equiv="refresh" content="3;URL=#">';
    } else {
        $WMform->hata();
    }
}
?>