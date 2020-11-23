<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$statu = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "statu" ] ) ) );
if ( !$statu ) {
    $WMform->hata( "Arancak statu sınırını boş bırakamazsınız" );
} else {
    $kontrol = $odb->prepare( "SELECT * FROM player.player WHERE ht > ? || st > ? || dx > ? || iq > ? LIMIT 1" );
    $kontrol->execute( array(
         $statu,
        $statu,
        $statu,
        $statu 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMform->basari( "Yönlendiriliyorsunuz." );
        echo '<meta http-equiv="refresh" content="2;URL=index.php?sayfa=statu_editler&statu=' . $statu . '">';
    } else {
        $WMform->uyari( "Bu statuyu aşan bir karakter yok" );
    }
}
?>