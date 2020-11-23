<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$mob = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "mob" ] ) ) );
if ( !$mob ) {
    $WMform->hata( "Arancak vnumu boş bırakamazsınız" );
} else {
    $kontrol = $odb->prepare( "SELECT vnum, locale_name FROM player.mob_proto WHERE vnum = ?" );
    $kontrol->execute( array(
         $mob 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMform->basari( $fetch[ "locale_name" ] . " Adlı mobu düzenleme sayfasına yönlendiriliyorsunuz. " );
        echo '<meta http-equiv="refresh" content="2;URL=index.php?sayfa=Mob_ayarlari&vnum=' . $mob . '">';
    } else {
        $WMform->uyari( $mob . " Vnumlu bir mob bulunumadı" );
    }
}
?>