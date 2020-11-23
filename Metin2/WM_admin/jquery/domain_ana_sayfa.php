<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$secilen = $_POST[ "secilen" ];
if ( count( $secilen ) > 1 ) {
    $WMform->hata( "Ana sayfada sadece bir işlem yapılabilir.." );
} else if ( count( $secilen ) == 0 ) {
    $WMform->hata( "Ana sayfa boş duramaz" );
} else {
    $islem = $secilen[ 0 ];
    if ( $islem != 1 ) {
        $server = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "server$islem" ] ) ) );
    }
    $base   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "base_url" ] ) ) );
    $update = $db->prepare( "UPDATE `ayarlar` SET `index` = ?, `base` = ? " );
    if ( $islem == 1 ) {
        $array    = array(
             "index" 
        );
        $guncelle = $update->execute( array(
             json_encode( $array ),
            $base 
        ) );
    } else if ( $islem == 2 ) {
        $array    = array(
             "yonlendir",
            $server 
        );
        $guncelle = $update->execute( array(
             json_encode( $array ),
            $base 
        ) );
    } else if ( $islem == 3 ) {
        $array    = array(
             "direk",
            $server 
        );
        $guncelle = $update->execute( array(
             json_encode( $array ),
            $base 
        ) );
    } else if ( $islem == 4 ) {
        $array    = array(
             "index_tema",
            $server 
        );
        $guncelle = $update->execute( array(
             json_encode( $array ),
            $base 
        ) );
    }
    if ( $guncelle ) {
        $WMadmin->log_gonder( "Domain ana sayfa ayarları güncellendi" );
        $WMform->basari( "Ana sayfa ayarları güncellendi" );
    } else {
        $WMform->hata();
    }
}
?>