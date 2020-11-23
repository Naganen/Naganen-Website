<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$tur = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tur" ] ) ) );
$id  = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
if ( $tur == 1 ) {
    $lonca_liderimi = $odb->prepare( "SELECT id FROM player.guild WHERE master = ?" );
    $lonca_liderimi->execute( array(
         $id 
    ) );
    if ( $lonca_liderimi->rowCount() ) {
        $ll     = $lonca_liderimi->fetch( PDO::FETCH_ASSOC );
        $dagit1 = $odb->prepare( "DELETE FROM player.guild_comment WHERE guild_id = ?" );
        $dagit1->execute( array(
             $ll[ "id" ] 
        ) );
        $dagit2 = $odb->prepare( "DELETE FROM player.guild_member WHERE guild_id = ?" );
        $dagit2->execute( array(
             $ll[ "id" ] 
        ) );
        $dagit3 = $odb->prepare( "DELETE FROM player.guild_war_reservation WHERE (guild1 = ? || guild2 = ?)" );
        $dagit3->execute( array(
             $ll[ "id" ],
            $ll[ "id" ] 
        ) );
        $dagit4 = $odb->prepare( "DELETE FROM player.guild WHERE id = ?" );
        $dagit4->execute( array(
             $ll[ "id" ] 
        ) );
    }
    $ldagit = $odb->prepare( "DELETE FROM player.guild_member WHERE pid = ?" );
    $ldagit->execute( array(
         $pid 
    ) );
    $account_id = $WMadmin->karakter( $id, "account_id", 2 );
    $karakter   = $WMadmin->karakter( $id, "name", 2 );
    for ( $i = 1; $i <= 4; $i++ ) {
        $bak = $odb->prepare( "SELECT pid" . $i . " FROM player.player_index WHERE pid" . $i . " = ?" );
        $bak->execute( array(
             $pid 
        ) );
        if ( $bak->rowCount() ) {
            $guncelle = $odb->prepare( "UPDATE player.player_index SET pid" . $i . " = ? WHERE id = ?" );
            $guncelle->execute( array(
                 0,
                $account_id 
            ) );
        }
    }
    $at_sil = $odb->prepare( "DELETE FROM player.horse_name WHERE id = ?" );
    $at_sil->execute( array(
         $id 
    ) );
    $arkadas_sil = $odb->prepare( "DELETE FROM player.messenger_list WHERE account = ? || companion = ?" );
    $arkadas_sil->execute( array(
         $karakter,
        $karakter 
    ) );
    $affetct_sil = $odb->prepare( "DELETE FROM player.affect WHERE dwPID = ?" );
    $affetct_sil->execute( array(
         $id 
    ) );
    $son_sil = $odb->prepare( "DELETE FROM player.player WHERE id = ?" );
    $son_sil->execute( array(
         $id 
    ) );
    $quest_sil = $odb->prepare( "DELETE FROM player.quest WHERE dwPID = ?" );
    $quest_sil->execute( array(
         $id 
    ) );
    $item_sil = $odb->prepare( "DELETE FROM player.item WHERE owner_id = ?" );
    $item_sil->execute( array(
         $id 
    ) );
    $WMform->basari( "Karakter Başarıyla Silindi" );
    $WMform->jquery_sil( 'tr#karakter-' . $id . '' );
    $WMadmin->log_gonder( $karakter . " Adlı karakter silindi" );
} else {
    $karakterlerine_bak = $odb->prepare( "SELECT id,name FROM player.player WHERE account_id = ? " );
    $karakterlerine_bak->execute( array(
         $id 
    ) );
    if ( $karakterlerine_bak->rowCount() ) {
        for ( $j = 1; $j <= $karakterlerine_bak->rowCount(); $j++ ) {
            $fetch[ $j ]    = $karakterlerine_bak->fetch( PDO::FETCH_ASSOC );
            $lonca_liderimi = $odb->prepare( "SELECT id FROM player.guild WHERE master = ?" );
            $lonca_liderimi->execute( array(
                 $fetch[ $j ][ "id" ] 
            ) );
            if ( $lonca_liderimi->rowCount() ) {
                $ll[ $j ] = $lonca_liderimi->fetch( PDO::FETCH_ASSOC );
                $dagit1   = $odb->prepare( "DELETE FROM player.guild_comment WHERE guild_id = ?" );
                $dagit1->execute( array(
                     $ll[ $j ][ "id" ] 
                ) );
                $dagit2 = $odb->prepare( "DELETE FROM player.guild_member WHERE guild_id = ?" );
                $dagit2->execute( array(
                     $ll[ $j ][ "id" ] 
                ) );
                $dagit3 = $odb->prepare( "DELETE FROM player.guild_war_reservation WHERE (guild1 = ? || guild2 = ?)" );
                $dagit3->execute( array(
                     $ll[ $j ][ "id" ],
                    $ll[ $j ][ "id" ] 
                ) );
                $dagit4 = $odb->prepare( "DELETE FROM player.guild WHERE id = ?" );
                $dagit4->execute( array(
                     $ll[ $j ][ "id" ] 
                ) );
            }
            $ldagit = $odb->prepare( "DELETE FROM player.guild_member WHERE pid = ?" );
            $ldagit->execute( array(
                 $fetch[ $j ][ "id" ] 
            ) );
            $at_sil = $odb->prepare( "DELETE FROM player.horse_name WHERE id = ?" );
            $at_sil->execute( array(
                 $fetch[ $j ][ "id" ] 
            ) );
            $arkadas_sil = $odb->prepare( "DELETE FROM player.messenger_list WHERE account = ? || companion = ?" );
            $arkadas_sil->execute( array(
                 $fetch[ $j ][ "name" ],
                $fetch[ $j ][ "name" ] 
            ) );
            $affetct_sil = $odb->prepare( "DELETE FROM player.affect WHERE dwPID = ?" );
            $affetct_sil->execute( array(
                 $fetch[ $j ][ "id" ] 
            ) );
            $son_sil = $odb->prepare( "DELETE FROM player.player WHERE id = ?" );
            $son_sil->execute( array(
                 $fetch[ $j ][ "id" ] 
            ) );
            $quest_sil = $odb->prepare( "DELETE FROM player.quest WHERE dwPID = ?" );
            $quest_sil->execute( array(
                 $fetch[ $j ][ "id" ] 
            ) );
            $item_sil = $odb->prepare( "DELETE FROM player.item WHERE owner_id = ?" );
            $item_sil->execute( array(
                 $fetch[ $j ][ "id" ] 
            ) );
        }
        $account_sil = $odb->prepare( "DELETE FROM account WHERE id = ?" );
        $account_sil->execute( array(
             $id 
        ) );
        $player_index_sil = $odb->prepare( "DELETE FROM player.player_index WHERE id = ?" );
        $player_index_sil->execute( array(
             $id 
        ) );
        $ban_list = $odb->prepare( "DELETE FROM ban_list WHERE account = ?" );
        $ban_list->execute( array(
             $id 
        ) );
        $item_sil_2 = $odb->prepare( "DELETE FROM player.item WHERE owner_id = ?" );
        $item_sil_2->execute( array(
             $id 
        ) );
        $kullanici = $WMadmin->kullanici( $id, "login" );
        $WMform->basari( "Kullanıcı Başarıyla Silindi" );
        $WMform->jquery_sil( 'tr#kullanici-' . $id . '' );
        $WMadmin->log_gonder( $kullanici . " Adlı Kullanıcı silindi" );
    }
}
?>