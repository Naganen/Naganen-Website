<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$pid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$npc = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "npc" ] ) ) );
$sil = $odb->prepare( "DELETE FROM player.shop WHERE npc_vnum = ? && vnum = ?" );
$sil->execute( array(
     $npc,
    $pid 
) );
if ( $sil ) {
    $WMform->jquery_sil( 'tr#shop-' . $pid . '' );
    $itemsil = $odb->prepare( "DELETE FROM player.shop_item WHERE shop_vnum = ?" );
    $itemsil->execute( array(
         $pid 
    ) );
    if ( $itemsil ) {
        $WMadmin->log_gonder( $pid . " vnumlu npc silindi " );
        $WMform->basari( " NPC başarıyla silindi" );
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata();
}
?>