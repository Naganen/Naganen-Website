<?php
class oyuncu_siralamasi {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/oyuncu_siralamasi/header.php' ) ) {
            require_once WM_tema . 'sayfalar/oyuncu_siralamasi/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Oyuncu Sıralaması';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        @$islem = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "islem" ] ) ) );
        @$isim = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "isim" ] ) ) );
        @$karakter = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "karakter" ] ) ) );
        if ( $vt->a( "breadcumb" ) == 1 ) {
            if ( file_exists( WM_tema . 'sayfalar/oyuncu_siralamasi/breadcumb.php' ) ) {
                require_once WM_tema . 'sayfalar/oyuncu_siralamasi/breadcumb.php';
            } else {
                require_once Sayfa_html . 'breadcumb.php';
            }
        }
        if ( file_exists( WM_tema . 'sayfalar/oyuncu_siralamasi/ust_panel.php' ) ) {
            require_once WM_tema . 'sayfalar/oyuncu_siralamasi/ust_panel.php';
        } else {
            require_once Sayfa_html . 'ust_panel.php';
        }
        $sayfada        = 25;
        $veriler_toplam = array(
             '[%]%',
            'BLOCK',
            '%' . $isim . '%' 
        );
        if ( $karakter == "savasci" ) {
            $ara               = '&& (player.job= ? OR player.job= ?)';
            $veriler_toplam[ ] = 0;
            $veriler_toplam[ ] = 4;
        } else if ( $karakter == "sura" ) {
            $ara               = '&& (player.job= ? OR player.job= ?)';
            $veriler_toplam[ ] = 2;
            $veriler_toplam[ ] = 6;
        } else if ( $karakter == "saman" ) {
            $ara               = '&& (player.job= ? OR player.job= ?)';
            $veriler_toplam[ ] = 3;
            $veriler_toplam[ ] = 7;
        } else if ( $karakter == "ninja" ) {
            $ara               = '&& (player.job= ? OR player.job=?)';
            $veriler_toplam[ ] = 1;
            $veriler_toplam[ ] = 5;
        } else {
            $ara = '';
        }
        $toplam_karakterr = $odb->prepare( "SELECT COUNT(player.name) FROM player.player 
	LEFT JOIN account.account 
	ON account.id = player.account_id
	WHERE player.name NOT LIKE ? && account.status != ? && player.name LIKE ? $ara
	GROUP BY player.id
	ORDER BY player.level DESC 
	" );
        $toplam_karakterr->execute( $veriler_toplam );
        $toplam_karakter = $toplam_karakterr->rowCount();
        if ( $toplam_karakter != 0 ) {
            $toplam_sayfa = ceil( $toplam_karakter / $sayfada );
            $sayfa        = isset( $_GET[ 'sayfa' ] ) ? (int) $_GET[ 'sayfa' ] : 1;
            if ( $sayfa < 1 ) {
                $sayfa = 1;
            }
            if ( $sayfa > $toplam_sayfa ) {
                $sayfa = $toplam_sayfa;
            }
            $limit = ( $sayfa - 1 ) * $sayfada;
            $query = $odb->prepare( "SELECT player.name, account.login, player_index.empire, player.job, player.level, guild.name AS lonca FROM player.player 
	LEFT JOIN account.account 
	ON account.id = player.account_id
	LEFT JOIN player.player_index
	ON player_index.id = account.id
	LEFT JOIN player.guild_member
	ON guild_member.pid = player.id
	LEFT JOIN player.guild
	ON guild.id=guild_member.guild_id
	WHERE player.name NOT LIKE ? && account.status != ? && (player.name LIKE ?) $ara
	GROUP BY player.id
	ORDER BY player.level DESC, player.playtime DESC
	LIMIT $limit, $sayfada" );
            $query->execute( $veriler_toplam );
            if ( file_exists( WM_tema . 'sayfalar/oyuncu_siralamasi/siralama.php' ) ) {
                require_once WM_tema . 'sayfalar/oyuncu_siralamasi/siralama.php';
            } else {
                require_once Sayfa_html . 'siralama.php';
            }
        } else {
            echo "Karakter Bulunamadı";
        }
    }
}
?>