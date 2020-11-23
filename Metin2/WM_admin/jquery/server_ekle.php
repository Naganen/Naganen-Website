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
$klasor      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "klasor" ] ) ) );
$link        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "link" ] ) ) );
$title       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "title" ] ) ) );
$keywords    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "keywords" ] ) ) );
$description = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "description" ] ) ) );
$kontrol     = $db->prepare( "SELECT id FROM server WHERE klasor = ?" );
$kontrol->execute( array(
     $klasor 
) );
$kontrol2 = $db->prepare( "SELECT id FROM server WHERE isim = ?" );
$kontrol2->execute( array(
     $isim 
) );
if ( !$host || !$user || !$port || !$isim || !$link || !$title || !$klasor ) {
    $WMform->hata( "* ile işaretlenen yerler boş bırakılamaz.." );
} else if ( file_exists( "../$klasor" ) ) {
    $WMform->hata( "Böyle bir klasör zaten var" );
} else if ( $kontrol->rowCount() ) {
    $WMform->hata( $klasor . " klasörüne sahip bir server var" );
} else if ( $kontrol2->rowCount() ) {
    $WMform->hata( $isim . " isimli bir server zaten var" );
} else {
    $auto = $db->prepare( "SHOW TABLE STATUS LIKE ?" );
    $auto->execute( array(
         'server' 
    ) );
    $increment = $auto->fetch( PDO::FETCH_ASSOC );
    @mkdir( "../$klasor", 0777 );
    $yeni_dosya = "../$klasor/index.php";
    touch( $yeni_dosya );
    @file_put_contents( $yeni_dosya, "<?php " . $WMclass->server_yazdir( $increment[ "Auto_increment" ] ), FILE_APPEND );
    @copy( "../htaccess.txt", "../$klasor/.htaccess" );
    $insert = $db->prepare( "INSERT INTO server SET host = ?, user = ?, klasor = ?, pass = ?, sql_port = ?, isim = ?, link = ?, title = ?, keywords = ?, description = ?" );
    $ekle   = $insert->execute( array(
         $host,
        $user,
        $klasor,
        $pass,
        $port,
        $isim,
        $link,
        $title,
        $keywords,
        $description 
    ) );
    if ( $ekle ) {
        $WMform->basari( "Server Başarıyla Eklendi" );
    } else {
        $WMform->hata();
    }
}
?>