<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$pid   = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$orj   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "shoporj" ] ) ) );
$name  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "shopname" ] ) ) );
$svnum = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "shopvnum" ] ) ) );
$vnum  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "svnum" ] ) ) );
if ( !$name || !$svnum || !$vnum ) {
    $WMform->hata( "Boş alan bırakamazsınız..!" );
} else {
    $kontrol = $odb->prepare( "SELECT vnum FROM player.shop WHERE vnum != ? && vnum = ?" );
    $kontrol->execute( array(
         $orj,
        $vnum 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMform->uyari( " Aynı vnumlu bir shop zaten var.!" );
    } else {
        $tasi = $odb->prepare( "UPDATE shop_item SET player.shop_vnum = ? WHERE shop_vnum = ?" );
        $tasi->execute( array(
             $vnum,
            $orj 
        ) );
        $update   = $odb->prepare( "UPDATE player.shop SET name = ?, vnum = ?, npc_vnum = ? WHERE vnum = ?" );
        $guncelle = $update->execute( array(
             $name,
            $vnum,
            $svnum,
            $orj 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Shop başarıyla güncellendi" );
            echo '<meta http-equiv="refresh" content="2;URL=index.php?sayfa=Npcshop&vnum=' . $vnum . '">';
        } else {
            $WMform->hata();
        }
    }
}
?>