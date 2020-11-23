<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $exp      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "exp" ] ) ) );
    $yang     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "yang" ] ) ) );
    $dusme    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "dusme" ] ) ) );
    $drop     = $exp . ',' . $yang . ',' . $dusme;
    $update   = $db->prepare( "UPDATE `server` SET `drop` = ? WHERE `server`.`id` = ?" );
    $guncelle = $update->execute( array(
         $drop,
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( $WMadmin->serverbilgi( "isim" ) . " Adlı serverın files ayarları değiştirildi" );
        $WMform->basari( "Files ayarları başarıyla güncellendi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 2 ) {
    $envanter = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "envanter" ] ) ) );
    $efsun    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsun" ] ) ) );
    if ( $efsun < 0 || $efsun > 7 ) {
        $WMform->hata( "Efsun en fazla 7 en az 0 olabilir" );
    } else if ( $envanter < 2 || $envanter > 5 ) {
        $WMform->hata( "Envanter en fazla 5 en az 2 olabilir" );
    } else {
        $update   = $db->prepare( "UPDATE `server` SET `envanter` = ?, `market_efsun` = ? WHERE `server`.`id` = ?" );
        $guncelle = $update->execute( array(
             $envanter,
            $efsun,
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( $WMadmin->serverbilgi( "isim" ) . " Adlı serverın files ayarları değiştirildi" );
            $WMform->basari( "Files ayarları başarıyla güncellendi" );
        } else {
            $WMform->hata();
        }
    }
}
?>