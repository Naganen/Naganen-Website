<?php
class lonca_siralamasi {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/lonca_siralamasi/header.php' ) ) {
            require_once WM_tema . 'sayfalar/lonca_siralamasi/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Lonca Sıralaması';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        @$islem = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "islem" ] ) ) );
        @$isim = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "isim" ] ) ) );
        if ( $vt->a( "breadcumb" ) == 1 ) {
            if ( file_exists( WM_tema . 'sayfalar/lonca_siralamasi/breadcumb.php' ) ) {
                require_once WM_tema . 'sayfalar/lonca_siralamasi/breadcumb.php';
            } else {
                require_once Sayfa_html . 'breadcumb.php';
            }
        }
        if ( file_exists( WM_tema . 'sayfalar/lonca_siralamasi/ust_panel.php' ) ) {
            require_once WM_tema . 'sayfalar/lonca_siralamasi/ust_panel.php';
        } else {
            require_once Sayfa_html . 'ust_panel.php';
        }
        $sayfada      = 25;
        $toplam_lonca = $odb->prepare( "SELECT guild.name FROM player.guild
	WHERE guild.name LIKE ?" );
        $toplam_lonca->execute( array(
             '%'.$isim.'%' 
        ) );
        
		$toplam_lonca = $toplam_lonca->rowCount();
						
        if ( $toplam_lonca != 0 ) {
            $toplam_sayfa = ceil( $toplam_lonca / $sayfada );
            $sayfa        = isset( $_GET[ 'sayfa' ] ) ? (int) $_GET[ 'sayfa' ] : 1;
            if ( $sayfa < 1 ) {
                $sayfa = 1;
            }
            if ( $sayfa > $toplam_sayfa ) {
                $sayfa = $toplam_sayfa;
            }
            $limit = ( $sayfa - 1 ) * $sayfada;
            $query = $odb->prepare( "SELECT guild.name, player.name AS lider, player_index.empire, guild.level, guild.ladder_point,guild.id FROM player.guild
	LEFT JOIN player.player
	ON guild.master = player.id
	LEFT JOIN player.player_index
	ON player_index.id = player.account_id
	WHERE guild.name LIKE ?
	ORDER BY ladder_point DESC
	LIMIT $limit, $sayfada
	" );
            $query->execute( array(
             '%'.$isim.'%'
            ) );
            if ( file_exists( WM_tema . 'sayfalar/lonca_siralamasi/siralama.php' ) ) {
                require_once WM_tema . 'sayfalar/lonca_siralamasi/siralama.php';
            } else {
                require_once Sayfa_html . 'siralama.php';
            }
        } else {
            $tema->hata("Lonca bulunamadı.");
        }
    }
}
?>