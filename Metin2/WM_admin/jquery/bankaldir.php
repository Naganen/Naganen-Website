<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$kalkcak = $WMkontrol->WM_get( $WMkontrol->WM_tostring( $_GET[ "login" ] ) );
$ban     = $odb->prepare( "UPDATE account SET status = ?, ban_time = ? WHERE login = ?" );
$kaldir  = $ban->execute( array(
     "OK",
    "",
    $kalkcak 
) );
if ( $kaldir ) {
    $insert = $odb->prepare( "INSERT INTO ban_list SET account = ?, reason = ?, source = ?, date = ?, action = ?" );
    $ekle   = $insert->execute( array(
         $WMadmin->kullanici( $kalkcak, "id", 2 ),
        "",
        "",
        date( "Y-m-d H:i:s" ),
        "unban" 
    ) );
    $WMadmin->log_gonder( $kalkcak . " Adlı Kullanıcının Banı Kaldırıldı" );
    $WMform->basari( $kalkcak . " adlı kullanıcının banı başarıyla kaldırıldı.." );
    echo '<meta http-equiv="refresh" content="2;URL=#">';
} else {
    $WMform->hata();
}
?>