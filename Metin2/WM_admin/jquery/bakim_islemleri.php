<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$tur = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tur" ] ) ) );
if ( $tur == 1 ) {
    $loglari_sil = $db->prepare( "DELETE FROM log WHERE sid = ?" );
    $loglari_sil->execute( array(
         $_SESSION[ "server" ] 
    ) );
    if ( $loglari_sil ) {
        $WMform->basari( "Adminlerin logları başarıyla silindi" );
    } else {
        $WMform->hata();
    }
} else if ( $tur == 2 ) {
    $ban_gecmis = $odb->prepare( "DELETE FROM ban_list" );
    $ban_gecmis->execute();
    if ( $ban_gecmis ) {
        $WMadmin->log_gonder( "Ban geçmişleri silindi" );
        $WMform->basari( "Ban geçmişi başarıyla temizlendi" );
    } else {
        $WMform->hata();
    }
} else if ( $tur == 3 ) {
    $karakter_sil_gecmis = $odb->prepare( "DELETE FROM player.player_deleted" );
    $karakter_sil_gecmis->execute();
    if ( $karakter_sil_gecmis ) {
        $WMadmin->log_gonder( "Silinmiş karakterler geçmişi temizlendi" );
        $WMform->basari( "Silinmiş karakterler geçmişi temizlendi" );
    } else {
        $WMform->hata();
    }
} else if ( $tur == 4 ) {
    $konusma_sil = $odb->prepare( "DELETE FROM player.guild_comment" );
    $konusma_sil->execute();
    if ( $konusma_sil ) {
        $WMadmin->log_gonder( "Lonca Konuşmaları silindi" );
        $WMform->basari( "Lonca konuşmaları başarıyla silindi" );
    } else {
        $WMform->hata();
    }
} else if ( $tur == 5 ) {
    $odb->query( "TRUNCATE log.bootlog" );
    $odb->query( "TRUNCATE log.change_name" );
    $odb->query( "TRUNCATE log.command_log" );
    $odb->query( "TRUNCATE log.cube" );
    $odb->query( "TRUNCATE log.dragon_slay_log" );
    $odb->query( "TRUNCATE log.exo_bank_log" );
    $odb->query( "TRUNCATE log.fish_log" );
    $odb->query( "TRUNCATE log.gmhost" );
    $odb->query( "TRUNCATE log.gmlist" );
    $odb->query( "TRUNCATE log.goldlog" );
    $odb->query( "TRUNCATE log.hackshield_log" );
    $odb->query( "TRUNCATE log.hack_crc_log" );
    $odb->query( "TRUNCATE log.hack_log" );
    $odb->query( "TRUNCATE log.ingame_ban_log" );
    $odb->query( "TRUNCATE log.levellog" );
    $odb->query( "TRUNCATE log.locale" );
    $odb->query( "TRUNCATE log.locale_bug" );
    $odb->query( "TRUNCATE log.log" );
    $odb->query( "TRUNCATE log.loginlog" );
    $odb->query( "TRUNCATE log.loginlog2" );
    $odb->query( "TRUNCATE log.money_log" );
    $odb->query( "TRUNCATE log.pcbang_loginlog" );
    $odb->query( "TRUNCATE log.quest_reward_log" );
    $odb->query( "TRUNCATE log.refinelog" );
    $odb->query( "TRUNCATE log.shout_log" );
    $odb->query( "TRUNCATE log.speed_hack" );
    $WMadmin->log_gonder( "Log veritabanı boşaltıldı" );
    $WMform->basari( "Log veritabanı başarıyla boşaltıldı" );
}
?>