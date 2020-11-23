<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$vnum = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "vnum" ] ) ) );
$npc  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "npc" ] ) ) );
$info = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "info" ] ) ) );
if ( !$vnum || !$npc ) {
    $WMform->hata( "Shop veya Npc vnumunu boş bırakamazsınız. !" );
} else {
    $kontrol = $odb->prepare( "SELECT vnum FROM player.shop WHERE vnum = ?" );
    $kontrol->execute( array(
         $vnum 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMform->uyari( "Böyle bir shop vnumuna sahip npc zaten var" );
    } else {
        $insert = $odb->prepare( "INSERT INTO player.shop SET vnum = ?, name = ?, npc_vnum = ?" );
        $ekle   = $insert->execute( array(
             $vnum,
            $info,
            $npc 
        ) );
        if ( $ekle ) {
            $WMadmin->log_gonder( $info . " adlı npc eklendi" );
            $WMform->basari( "NPC yi başarıyla eklediniz" );
        } else {
            $WMform->hata();
        }
    }
}
?>