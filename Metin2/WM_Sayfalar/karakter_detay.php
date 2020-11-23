<?php
class karakter_detay {
    public function head( ) {
        global $vt, $WMkontrol;
        require_once Sayfa_html . 'header.php';
    }
    public function ust( ) {
        global $vt, $WMkontrol;
        return @$WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "isim" ] ) );
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema, $WMinf;
        @$isim = $WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "isim" ] ) );
        $kontrol = $odb->prepare( "SELECT player.*, guild.name AS lonca, guild.level AS lonca_level, guild.ladder_point AS lonca_puan,
 player_index.empire FROM player.player LEFT JOIN player.player_index 
ON player.account_id = player_index.id LEFT JOIN player.guild_member
ON player.id = guild_member.pid LEFT JOIN player.guild
ON guild_member.guild_id = guild.id WHERE player.name = ?" );
        $kontrol->execute( array(
             $isim 
        ) );
        if ( $kontrol->rowCount() ) {
            $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
            $sicil = $odb->prepare( "SELECT account FROM ban_list WHERE account = ?" );
            $sicil->execute( array(
                 $fetch[ "account_id" ] 
            ) );
            if ( $vt->a( "breadcumb" ) == 1 ) {
                require_once Sayfa_html . 'breadcumb.php';
            } else {
                require_once Sayfa_html . 'breadcumb_yok.php';
            }
            @$sosyal_kontrol = $odb->prepare( "SELECT sosyal FROM player.player LIMIT 1" );
            @$sosyal_kontrol->execute();
            if ( $sosyal_kontrol->errorInfo()[2] == false ) {
                if ( isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
                    if ( $fetch[ "account_id" ] == $_SESSION[ $vt->a( "isim" ) . "userid" ] ) {
                        require_once Sayfa_html . 'sosyal_ust.php';
                    }
                }
            }
            require_once Sayfa_html . 'karakter_detay.php';
            if ( $sosyal_kontrol->errorInfo()[2] == false ) {
                if ( $fetch[ "imza" ] != '' ) {
                    if ( strlen( $fetch[ "imza" ] ) > 4 ) {
                        require_once Sayfa_html . 'sosyal_imza.php';
                    }
                }
            }
        } else {
            $vt->yonlendir( "oyuncu-siralamasi" );
        }
    }
}
?>