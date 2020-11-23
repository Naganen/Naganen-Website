<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$ep = $WMkontrol->WM_toint( $_POST[ "epmiktar" ] );
if ( $ep != 0 ) {
    $kullanici = $WMkontrol->WM_tostring( $WMkontrol->WM_post( $WMkontrol->WM_html( $_POST[ "banlancak" ] ) ) );
    $kontrol   = $odb->prepare( "SELECT login FROM account WHERE login = ?" );
    $kontrol->execute( array(
         $kullanici 
    ) );
    if ( $kontrol->rowCount() ) {
        $query = $odb->prepare( "UPDATE account SET coins = coins + ? WHERE login = ?" );
        $query->execute( array(
             $ep,
            $kullanici 
        ) );
        if ( $query ) {
            $WMadmin->log_gonder( $kullanici . " Adlı kullanıcıya $ep gönderildi" );
            $WMform->basari( $kullanici . " Adlı Kullanıcıya Başarıyla $ep EP Yüklendi." );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( " Girmiş olduğunuz kullanıcı sistemde bulunamadı" );
    }
} else {
    $WMform->hata( " Ep miktarını boş bırakamazsınız" );
}
?>