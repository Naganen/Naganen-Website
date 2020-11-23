<?php
class lonca_detay {
    public function head( ) {
        global $vt, $WMkontrol;
        if ( file_exists( WM_tema . 'sayfalar/lonca_detay/header.php' ) ) {
            require_once WM_tema . 'sayfalar/lonca_detay/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt, $WMkontrol;
        return @$WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "isim" ] ) );
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema, $WMinf;
        @$isim = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "isim" ] ) ) );
        $lonca_kontrol = $odb->prepare( "SELECT guild.*, player.name AS baskan, player.id AS player_id, player_index.empire AS bayrak, player.account_id 
FROM player.guild LEFT JOIN player.player ON player.id = guild.master 
LEFT JOIN player.player_index ON player_index.id = player.account_id WHERE guild.name = ?" );
        $lonca_kontrol->execute( array(
             $isim 
        ) );
        if ( $lonca_kontrol->rowCount() ) {
            @$lonca_sosyal2 = $odb->prepare( "SELECT sosyal FROM player.guild LIMIT 1" );
            @$lonca_sosyal2->execute( );
            $ll = $lonca_kontrol->fetch( PDO::FETCH_ASSOC );
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/lonca_detay/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/lonca_detay/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            } else {
                if ( file_exists( WM_tema . 'sayfalar/lonca_detay/breadcumb_yok.php' ) ) {
                    require_once WM_tema . 'sayfalar/lonca_detay/breadcumb_yok.php';
                } else {
                    require_once Sayfa_html . 'breadcumb_yok.php';
                }
            }
            if ( $lonca_sosyal2->errorInfo()[2] == false  ) {
                if ( isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
                    if ( $ll[ "account_id" ] == $_SESSION[ $vt->a( "isim" ) . "userid" ] ) {
                        if ( file_exists( WM_tema . 'sayfalar/lonca_detay/sosyal_ust.php' ) ) {
                            require_once WM_tema . 'sayfalar/lonca_detay/sosyal_ust.php';
                        } else {
                            require_once Sayfa_html . 'sosyal_ust.php';
                        }
                    }
                }
            }
            if ( file_exists( WM_tema . 'sayfalar/lonca_detay/lonca_detay.php' ) ) {
                require_once WM_tema . 'sayfalar/lonca_detay/lonca_detay.php';
            } else {
                require_once Sayfa_html . 'lonca_detay.php';
            }
            if ( $lonca_sosyal2->errorInfo()[2] == false  ) {
                $lonca_sosyal = $odb->prepare( "SELECT sosyal FROM player.guild WHERE name = ?" );
                $lonca_sosyal->execute( array(
                     $isim 
                ) );
                if ( $lonca_sosyal->rowCount() ) {
                    $lonca_sosyal_fetch = $lonca_sosyal->fetch( PDO::FETCH_ASSOC );
                    $sosyal             = json_decode( $lonca_sosyal_fetch[ "sosyal" ] );
                    if ( $sosyal[ 0 ] != '' || $sosyal[ 1 ] != '' || $sosyal[ 2 ] != '' ) {
                        if ( file_exists( WM_tema . 'sayfalar/lonca_detay/sosyal_left.php' ) ) {
                            require_once WM_tema . 'sayfalar/lonca_detay/sosyal_left.php';
                        } else {
                            require_once Sayfa_html . 'sosyal_left.php';
                        }
                    }
                }
            }
            printf( '</table>' );
            $sayfada      = 5;
            $toplam_savas = $odb->prepare( "SELECT * FROM player.guild_war_reservation WHERE guild1 = ? or guild2 = ?
" );
            $toplam_savas->execute( array(
                 $ll[ "id" ],
                $ll[ "id" ] 
            ) );
            if ( $toplam_savas->rowCount() ) {
                $toplam_sayfa = ceil( $toplam_savas->rowCount() / $sayfada );
                $sayfa        = isset( $_GET[ 'sayfa' ] ) ? (int) $_GET[ 'sayfa' ] : 1;
                if ( $sayfa < 1 ) {
                    $sayfa = 1;
                }
                if ( $sayfa > $toplam_sayfa ) {
                    $sayfa = $toplam_sayfa;
                }
                $limit = ( $sayfa - 1 ) * $sayfada;
                $query = $odb->prepare( "SELECT * FROM player.guild_war_reservation WHERE guild1 = ? or guild2 = ?ORDER BY time DESC
	LIMIT $limit, $sayfada
	" );
                $query->execute( array(
                     $ll[ "id" ],
                    $ll[ "id" ]
                ) );
                function savas_durum( $result1, $result2 ) {
                    if ( $result1 == $result2 ) {
                        return 'Berabere';
                    } else if ( $result1 > $result2 ) {
                        return 'Davet Eden Kazandı';
                    } else if ( $result2 > $result1 ) {
                        return 'Davet Edilen Kazandı';
                    } else {
                        return 'Sonuçlanmadı';
                    }
                }
                $lonca_isim = $WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "isim" ] ) );
                if ( file_exists( WM_tema . 'sayfalar/lonca_detay/savaslari.php' ) ) {
                    require_once WM_tema . 'sayfalar/lonca_detay/savaslari.php';
                } else {
                    require_once Sayfa_html . 'savaslari.php';
                }
            }
            $lonca_uyeleri = $odb->prepare( "SELECT guild_member.pid, player.name AS isim, player.level AS lv FROM player.guild_member
LEFT JOIN player.player ON guild_member.pid = player.id WHERE guild_member.guild_id = ? ORDER BY player.level DESC" );
            $lonca_uyeleri->execute( array(
                 $ll[ "id" ] 
            ) );
            if ( file_exists( WM_tema . 'sayfalar/lonca_detay/uyeleri.php' ) ) {
                require_once WM_tema . 'sayfalar/lonca_detay/uyeleri.php';
            } else {
                require_once Sayfa_html . 'uyeleri.php';
            }
        } else {
            $vt->yonlendir( "lonca-siralamasi" );
        }
    }
}
?>