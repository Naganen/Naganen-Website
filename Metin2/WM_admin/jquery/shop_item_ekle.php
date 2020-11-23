<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$pid    = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$item   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "item" ] ) ) );
$miktar = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "miktar" ] ) ) );
if ( !$item || !$miktar ) {
    $WMform->hata( "İtem vnumunu veya item miktarını boş bırakamazsınız" );
} else {
    $kontrol = $odb->prepare( "SELECT item_vnum FROM player.shop_item WHERE shop_vnum = ? && item_vnum = ?" );
    $kontrol->execute( array(
         $pid,
        $item 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMform->uyari( "NPC de böyle bir item zaten var.!" );
    } else {
        $WMadmin->log_gonder( $pid . " vnumlu npc ye " . $WMadmin->item_bul( $item ) . " adlı item eklendi" );
        $insert = $odb->prepare( "INSERT INTO player.shop_item SET shop_vnum = ?, item_vnum = ?, count = ?" );
        $ekle   = $insert->execute( array(
             $pid,
            $item,
            $miktar 
        ) );
        if ( $ekle ) {
            $WMform->basari( "NPC ye itemi başarıyla eklediniz." );
            echo '<meta http-equiv="refresh" content="2;URL=#">';
        } else {
            $WMform->hata();
        }
    }
}
?>