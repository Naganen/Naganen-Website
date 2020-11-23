<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$banlancak = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "banlancak" ] ) ) );
$bansure   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "bansure" ] ) ) );
$bansebep  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "bansebep" ] ) ) );
$banlayan  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "banlayan" ] ) ) );
$karakter  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "karakter" ] ) ) );
$kontrol   = $odb->prepare( "SELECT login FROM account WHERE login = ?" );
$kontrol->execute( array(
     $banlancak 
) );
if ( $kontrol->rowCount() ) {
    if ( !isset( $_POST[ "sinirsiz" ] ) ) {
        if ( !$bansure ) {
            $WMform->hata( " Sınırsız banlanma olmadığı için tarih boş bırakılamaz.!" );
            exit( );
        } else {
            $sinirsiz = $bansure . ' ' . date( "H:i:s" );
        }
    } else {
        $sinirsiz = "1";
    }
    $ban    = $odb->prepare( "UPDATE account SET status = ?, ban_neden = ?, ban_sure = ?, kim_banlamis = ?, ban_time = ? WHERE login = ?" );
    $banla  = $ban->execute( array(
         "BLOCK",
        $bansebep,
        $sinirsiz,
        $banlayan,
        date( "Y-m-d H:i:s" ),
        $banlancak 
    ) );
    $insert = $odb->prepare( "INSERT INTO ban_list SET account = ?, reason = ?, source = ?, date = ?, action = ?" );
    $ekle   = $insert->execute( array(
         $WMadmin->kullanici( $banlancak, "id", 2 ),
        $bansebep,
        $karakter,
        date( "Y-m-d H:i:s" ),
        "ban" 
    ) );
    if ( $banla ) {
        $WMadmin->log_gonder( $banlancak . " Adlı Kullanıcı Banlandı" );
        $WMform->basari( $banlancak . " Adlı kullanıcı başarıyla banlandı" );
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( $banlancak . " adında kullanıcı sistemde bulunamadı. !" );
}
?>