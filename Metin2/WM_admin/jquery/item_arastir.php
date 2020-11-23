<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$item = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "item" ] ) ) );
if ( !$item ) {
    $WMform->hata( "Arancak vnumu boş bırakamazsınız" );
} else if ( $item < 10 ) {
    $WMform->hata( "10 vnumundan büyük bir sayı giriniz" );
} else {
    $kontrol = $odb->prepare( "SELECT vnum FROM player.item_proto WHERE vnum = ?" );
    $kontrol->execute( array(
         $item 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMform->basari( $WMadmin->item_bul( $item ) . " Adlı itemi düzenleme sayfasına yönlendiriliyorsunuz" );
        echo '<meta http-equiv="refresh" content="2;URL=index.php?sayfa=İtem_ara&vnum=' . $item . '">';
    } else {
        $WMform->uyari( $item . " Vnumlu bir item bulunumadı" );
    }
}
?>