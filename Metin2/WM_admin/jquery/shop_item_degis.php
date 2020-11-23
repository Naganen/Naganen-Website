<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$formid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
$pid    = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$orjpid = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "orj-$formid" ] ) ) );
$vnum   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "vnum-$formid" ] ) ) );
$miktar = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "miktar-$formid" ] ) ) );
if ( !$vnum || !$miktar ) {
    $WMform->hata( "İtem vnumunu veya miktarı boş bırakamazsınız .!" );
} else if ( $miktar < 0 || $miktar > 250 ) {
    $WMform->uyari( "Miktarı 250 den yukarı veya 0 dan aşağı giremezsiniz" );
} else {
    $kontrol = $odb->prepare( "SELECT item_vnum FROM player.shop_item WHERE shop_vnum = ? && item_vnum != ? && item_vnum = ?" );
    $kontrol->execute( array(
         $pid,
        $orjpid,
        $vnum 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMform->uyari( "Güncellemek istediğiniz item NPC de zaten mevcut" );
    } else {
        $update   = $odb->prepare( "UPDATE player.shop_item SET item_vnum = ?, count = ? WHERE shop_vnum = ? && item_vnum = ?" );
        $guncelle = $update->execute( array(
             $vnum,
            $miktar,
            $pid,
            $orjpid 
        ) );
        $WMadmin->log_gonder( $pid . " vnumlu npc de " . $WMadmin->item_bul( $orjpid ) . " adlı item düzenlendi" );
        if ( $guncelle ) {
            $WMform->basari( "NPC itemi başarıyla düzenlendi" );
            echo '<meta http-equiv="refresh" content="2;URL=#">';
        } else {
            $WMform->hata();
        }
    }
}
?>