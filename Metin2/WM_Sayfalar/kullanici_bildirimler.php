<?php
class kullanici_bildirimler {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_bildirimler/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_bildirimler/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Kullanıcı Bildirimleri';
    }
    public function orta( ) {
        global $ayar, $WMkontrol, $vt, $db, $tema, $WMinf;
        if ( isset( $_SESSION[ $vt->a( "isim" ) . "username" ] ) ) {
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici_bildirimler/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_bildirimler/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            $sayfada    = 5;
            $toplam_log = $db->prepare( "SELECT id FROM bildirim WHERE sid = ? && alici_tur = ? && alan = ?" );
            $toplam_log->execute( array(
                 server,
                1,
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
                $query = $db->prepare( "SELECT * FROM bildirim WHERE sid = ? && alici_tur = ? && alan = ?
ORDER BY id DESC
LIMIT $limit, $sayfada" );
                $query->execute( array(
                     server,
                    1,
                    $_SESSION[ $vt->a( "isim" ) . "username" ]
                ) );
                if ( file_exists( WM_tema . 'sayfalar/kullanici_bildirimler/bildirimler.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_bildirimler/bildirimler.php';
                } else {
                    require_once Sayfa_html . 'bildirimler.php';
                }
            } else {
                $tema->uyari( "Bildirim Bulunamadı <a href='" . $vt->url( 5 ) . "'>Buraya</a> tıklayarak kullanıcı sayfasına gidebilirsiniz" );
            }
        } else {
            $vt->yonlendir( $vt->url( 4 ) );
        }
    }
}
?>