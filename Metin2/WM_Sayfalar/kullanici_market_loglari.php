<?php
class kullanici_market_loglari {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_market_loglari/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_market_loglari/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Kullanıcı Market Logları';
    }
    public function orta( ) {
        global $ayar, $WMkontrol, $vt, $db, $tema, $WMinf;
        if ( isset( $_SESSION[ $vt->a( "isim" ) . "username" ] ) ) {
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici_market_loglari/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_market_loglari/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            $sayfada    = 20;
            $toplam_log = $db->prepare( "SELECT id FROM market_log WHERE sid = ? && karakter = ?" );
            $toplam_log->execute( array(
                 server,
                $_SESSION[ $vt->a( "isim" ) . "username" ] 
            ) );
            $toplam_log = $toplam_log->rowCount();
            if ( $toplam_log != 0 ) {
                $toplam_sayfa = ceil( $toplam_log / $sayfada );
                $sayfa        = isset( $_GET[ 'sayfa' ] ) ? (int) $_GET[ 'sayfa' ] : 1;
                if ( $sayfa < 1 ) {
                    $sayfa = 1;
                }
                if ( $sayfa > $toplam_sayfa ) {
                    $sayfa = $toplam_sayfa;
                }
                $limit = ( $sayfa - 1 ) * $sayfada;
                $query = $db->prepare( "SELECT * FROM market_log WHERE sid = ? && karakter = ? ORDER BY id DESC LIMIT $limit, $sayfada" );
                $query->execute( array(
                     server,
                    $_SESSION[ $vt->a( "isim" ) . "username" ]
                ) );
                if ( file_exists( WM_tema . 'sayfalar/kullanici_market_loglari/log.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_market_loglari/log.php';
                } else {
                    require_once Sayfa_html . 'log.php';
                }
            } else {
                $tema->uyari( "Market logu bulunamadı <a href='kullanici'>Buraya</a> tıklayarak kullanıcı sayfasına gidebilirsiniz" );
            }
        } else {
            $vt->yonlendir( $vt->url( 4 ) );
        }
    }
}
?>