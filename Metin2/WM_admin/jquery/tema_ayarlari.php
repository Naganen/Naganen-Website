<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $tema       = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "tema" ] ) ) );
    $update     = $db->prepare( "UPDATE server SET tema = ? WHERE id = ?" );
    $tema_array = array(
         "tema",
        $tema 
    );
    $guncelle   = $update->execute( array(
         json_encode( $tema_array ),
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( "Tema " . $tema . " olarak değiştirildi" );
        $WMform->basari( "Tema başarıyla güncellendi" );
        echo '<meta http-equiv="refresh" content="3;URL=#">';
    } else {
        $WMform->hata();
    }
} else if ( $fid == 2 ) {
    $tema     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "tema" ] ) ) );
    $guncelle = $db->prepare( "UPDATE ayarlar SET market_tema = ?" );
    $guncelle->execute( array(
         $tema 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( "Market Teması " . $tema . " olarak değiştirildi" );
        $WMform->basari( "Market Teması başarıyla güncellendi" );
        echo '<meta http-equiv="refresh" content="3;URL=#">';
    } else {
        $WMform->hata();
    }
}
if ( $fid == 3 ) {
    $tema     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "tema" ] ) ) );
    $update   = $db->prepare( "UPDATE server SET mail_tema = ? WHERE id = ?" );
    $guncelle = $update->execute( array(
         $tema,
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( "Mail Teması " . $tema . " olarak değiştirildi" );
        $WMform->basari( "Mail Teması başarıyla güncellendi" );
        echo '<meta http-equiv="refresh" content="3;URL=#">';
    } else {
        $WMform->hata();
    }
} else if ( $fid == 4 ) {
    $tema     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "tema" ] ) ) );
    $guncelle = $db->prepare( "UPDATE ayarlar SET index_tema = ?" );
    $guncelle->execute( array(
         $tema 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( "İndex Teması " . $tema . " olarak değiştirildi" );
        $WMform->basari( "İndex Teması başarıyla güncellendi" );
        echo '<meta http-equiv="refresh" content="3;URL=#">';
    } else {
        $WMform->hata();
    }
}
?>