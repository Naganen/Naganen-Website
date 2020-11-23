<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$svnum = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "svnum" ] ) ) );
$item  = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "item" ] ) ) );
$sil   = $odb->query( "DELETE FROM player.shop_item WHERE shop_vnum = ? && item_vnum = ?" );
$sil->execute( array(
     $svnum,
    $item 
) );
if ( $sil ) {
    $WMadmin->log_gonder( $svnum . " vnumlu npc den " . $WMadmin->item_bul( $item ) . " adlı item silindi" );
    $WMform->jquery_sil( 'tr#item-' . $item . '' );
    $WMform->basari( " NPC itemi başarıyla silindi" );
} else {
    $WMform->hata();
}
?>