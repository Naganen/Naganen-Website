<?php
class kullanici_giris_loglari {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_giris_loglari/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_giris_loglari/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Kullanıcı Giriş Logları';
    }
    public function orta( ) {
        global $ayar, $WMkontrol, $vt, $db, $tema, $odb, $WMinf;
        if ( isset( $_SESSION[ $vt->a( "isim" ) . "username" ] ) ) {
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici_giris_loglari/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_giris_loglari/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            $sayfada    = 20;
            $toplam_log = $odb->prepare( "SELECT * FROM log.loginlog2 WHERE account_id = ?" );
            $toplam_log->execute( array(
                 $_SESSION[ $vt->a( "isim" ) . "userid" ] 
            ) );
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
                $query = $odb->prepare( "SELECT * FROM log.loginlog2 WHERE account_id = ?
ORDER BY id DESC
LIMIT $limit, $sayfada" );
                $query->execute( array(
                     $_SESSION[ $vt->a( "isim" ) . "userid" ]
                ) );
                if ( file_exists( WM_tema . 'sayfalar/kullanici_giris_loglari/log.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_giris_loglari/log.php';
                } else {
                    require_once Sayfa_html . 'log.php';
                }
            } else {
                $tema->uyari( "Giriş logu bulunamadı <a href='kullanici'>Buraya</a> tıklayarak kullanıcı sayfasına gidebilirsiniz" );
            }
        } else {
            $vt->yonlendir( $vt->url( 4 ) );
        }
    }
}
?>