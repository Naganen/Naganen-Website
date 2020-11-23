<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$ep = $WMkontrol->WM_toint( $_POST[ "epmiktar" ] );
if ( $ep != 0 ) {
    $id    = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "pid" ] ) );
    $query = $odb->prepare( "UPDATE account SET coins = coins + ? WHERE id = ?" );
    $query->execute( array(
         $ep,
        $id 
    ) );
    if ( $query ) {
        $WMadmin->log_gonder( $WMadmin->kullanici( $id, "login" ) . " Adlı kullanıcıya $ep gönderildi" );
        $WMform->basari( "Kullanıcıya Başarıyla $ep EP Yüklendi." );
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( " Ep miktarını boş bırakamazsınız" );
}
?>