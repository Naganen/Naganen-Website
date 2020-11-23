<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $mail     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "mail" ] ) ) );
    $sifre    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "sifre" ] ) ) );
    $kullanan = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "kullanan" ] ) ) );
    if ( ( $mail != 1 && $mail != 2 ) || ( $sifre != 1 && $sifre != 2 ) || ( $kullanan != 1 && $kullanan != 2 ) ) {
        $WMform->hata( "Değerler 1 ve 2 nin dışında olamaz" );
    } else {
        $update   = $db->prepare( "UPDATE server SET eptoken = ? WHERE id = ? " );
        $guncelle = $update->execute( array(
             $mail . ',' . $sifre . ',' . $kullanan,
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Ep Token Ayarlar Düzenlendi" );
            $WMform->basari( "Sistem ayarları başarıyla kaydedildi" );
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 2 ) {
    @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
    $kontrol = $db->prepare( "SELECT id,token FROM eptoken WHERE id = ? && sid = ?" );
    $kontrol->execute( array(
         $id,
        $_SESSION[ "server" ] 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "token" ] . " Ep Tokeni Silindi" );
        $sil = $db->prepare( "DELETE FROM eptoken WHERE id = ? && sid = ?" );
        $sil->execute( array(
             $id,
            $_SESSION[ "server" ] 
        ) );
        if ( $sil ) {
            $WMform->basari( "Token Başarıyla Silindi" );
            $WMform->jquery_sil( 'tr#eptoken-' . $id . '' );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Ep tokeni bulunamadı" );
    }
} else if ( $fid == 3 ) {
    $epmiktar = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "epmiktar" ] ) ) );
    if ( !$epmiktar ) {
        $WMform->hata( "Ep miktarı boş bırakılamaz" );
    } else {
        $random1       = substr( str_shuffle( "abcdefghjklmnoprstuvyzxwqABCDEFGHJKLMNOPRSTUVYZWQ__1234567890" ), 0, 35 );
        $random2       = substr( str_shuffle( "abcdefghjklmnoprstuvyzxwqABCDEFGHJKLMNOPRSTUVYZWQ__1234567890" ), 0, 7 );
        $token_insert  = $db->prepare( "INSERT INTO eptoken SET sid = ?, token = ?, tokenpass = ?, ep = ?, olusturan = ?, olusturma_tarih = ?" );
        $token_olustur = $token_insert->execute( array(
             $_SESSION[ "server" ],
            $random1,
            $random2,
            $epmiktar,
            ".!*23.",
            date( "Y-m-d H:i:s" ) 
        ) );
        if ( $token_olustur ) {
            $WMadmin->log_gonder( $epmiktar . " Ep lik token oluşturuldu" );
            $WMform->basari( "Token Başarıyla Oluşturuldu" );
            echo '<meta http-equiv="refresh" content="2;URL=#">';
        } else {
            $WMform->hata();
        }
    }
}
?>