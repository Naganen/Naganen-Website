<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$tid    = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tid" ] ) ) );
$uid    = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "uid" ] ) ) );
$destek = $db->prepare( "SELECT * FROM destek WHERE id = ?" );
$destek->execute( array(
     $tid 
) );
if ( $destek->rowCount() ) {
    $fetch = $destek->fetch( PDO::FETCH_ASSOC );
    $array = json_decode( $fetch[ "yonlenen" ] );
    $TL    = $WMadmin->admin( "gm", $uid );
    if ( in_array( $TL, $array ) ) {
        $WMform->hata( "Bu yetkili zaten yönlenmiş" );
    } else {
        array_push( $array, $TL );
        $update   = $db->prepare( "UPDATE destek SET yonlenen = ? WHERE sid = ? && id = ?" );
        $guncelle = $update->execute( array(
             json_encode( $array ),
            $_SESSION[ "server" ],
            $tid 
        ) );
        if ( $guncelle ) {
            $kullanici_kontrol = $db->prepare( "SELECT username FROM users WHERE gm = ?" );
            $kullanici_kontrol->execute( array(
                 $TL 
            ) );
            if ( $kullanici_kontrol->rowCount() ) {
                $kullanicimiz = $kullanici_kontrol->fetch( PDO::FETCH_ASSOC );
                $WMadmin->bildirim_gonder( $kullanicimiz[ "username" ], 2, $_SESSION[ "adminisim" ] . " adlı yetkili tarafından " . $fetch[ "konu" ] . " konulu destek talebine yönlendirildiniz", $fetch[ "id" ], 2 );
            }
            $WMadmin->bildirim_gonder( $fetch[ "acan" ], 2, $fetch[ "konu" ] . " konulu destek talebiniz " . $TL . " Adlı yetkiliye yönlendirilmiştir.", $fetch[ "id" ] );
            $WMform->basari( "Yetkili başarıyla yönlendirildi" );
            $WMadmin->log_gonder( $TL . " Adlı yetkili " . $fetch[ "konu" ] . " adlı konuya yönlendirildi " );
        } else {
            $WMform->hata();
        }
    }
} else {
    $WMform->hata( "Destek talebi bulunamadı" );
}
?>