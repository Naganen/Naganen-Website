<?php
class online_siralamasi {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/online_siralamasi/header.php' ) ) {
            require_once WM_tema . 'sayfalar/online_siralamasi/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Online Oyuncu Sıralaması';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
		
		if($vt->a("online_liste") != 2){
		
        @$islem = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "islem" ] ) ) );
        @$isim = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "isim" ] ) ) );
        @$karakter = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "karakter" ] ) ) );
        if ( $vt->a( "breadcumb" ) == 1 ) {
            if ( file_exists( WM_tema . 'sayfalar/online_siralamasi/breadcumb.php' ) ) {
                require_once WM_tema . 'sayfalar/online_siralamasi/breadcumb.php';
            } else {
                require_once Sayfa_html . 'breadcumb.php';
            }
        }
        if ( file_exists( WM_tema . 'sayfalar/online_siralamasi/ust_panel.php' ) ) {
            require_once WM_tema . 'sayfalar/online_siralamasi/ust_panel.php';
        } else {
            require_once Sayfa_html . 'ust_panel.php';
        }
        $sayfada        = 25;
        $veriler_toplam = array(
             60,
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
	WHERE DATE_SUB(NOW(), INTERVAL ? MINUTE) < player.last_play && (player.name NOT LIKE ?) && account.status != ? && (player.name LIKE ?) $ara
	" );
        $toplam_karakterr->execute( $veriler_toplam );
        $toplam_karakter = $toplam_karakterr->fetchColumn();
        if ( $toplam_karakter != 0 ) {
            $toplam_sayfa = ceil( $toplam_karakter / $sayfada );
            $sayfa        = isset( $_GET[ 'sayfa' ] ) ? (int) $_GET[ 'sayfa' ] : 1;
            if ( $sayfa < 1 ) {
                $sayfa = 1;
            }
            if ( $sayfa > $toplam_sayfa ) {
                $sayfa = $toplam_sayfa;
            }
            $limit   = ( $sayfa - 1 ) * $sayfada;
            $query   = $odb->prepare( "SELECT player.name, account.login, player_index.empire, player.job, player.level, guild.name AS lonca FROM player.player 
	LEFT JOIN account.account 
	ON account.id = player.account_id
	LEFT JOIN player.player_index
	ON player_index.id = account.id
	LEFT JOIN player.guild_member
	ON guild_member.pid = player.id
	LEFT JOIN player.guild
	ON guild.id=guild_member.guild_id
	WHERE DATE_SUB(NOW(), INTERVAL ? MINUTE) < player.last_play && player.name NOT LIKE ? && account.status != ? && (player.name LIKE ?) $ara
	GROUP BY player.id
	ORDER BY player.level DESC 
	LIMIT $limit, $sayfada" );
            $veriler = $veriler_toplam;
            $query->execute( $veriler );
            if ( file_exists( WM_tema . 'sayfalar/online_siralamasi/siralama.php' ) ) {
                require_once WM_tema . 'sayfalar/online_siralamasi/siralama.php';
            } else {
                require_once Sayfa_html . 'siralama.php';
            }
        } else {
            $tema->hata("Online Karakter Bulunamadı");
        }
		}
		else{
			$vt->yonlendir($vt->url(0));
		}
    }
}
?>