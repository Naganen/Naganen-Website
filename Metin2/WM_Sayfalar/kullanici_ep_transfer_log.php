<?php
class kullanici_ep_transfer_log {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_transfer_log/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_ep_transfer_log/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'EP Transfer Logları';
    }
    public function orta( ) {
        global $ayar, $WMkontrol, $vt, $db, $tema, $odb;
        @$kontrol = $odb->prepare( "SELECT edurum FROM account LIMIT 1" );
        @$kontrol->execute( );
        if ( isset( $_SESSION[ $vt->a( "isim" ) . "username" ] ) ) {
            if ( $kontrol->errorInfo()[2] == false ) {
                if ( $vt->uye( "edurum" ) == 1 ) {
                    if ( $vt->a( "breadcumb" ) == 1 ) {
                        if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_transfer_log/breadcumb.php' ) ) {
                            require_once WM_tema . 'sayfalar/kullanici_ep_transfer_log/breadcumb.php';
                        } else {
                            require_once Sayfa_html . 'breadcumb.php';
                        }
                    }
                    $sayfada    = 25;
                    $toplam_log = $db->prepare( "SELECT * FROM eptransfer_log WHERE gonderen = ?" );
                    $toplam_log->execute( array(
                         $_SESSION[ $vt->a( "isim" ) . "username" ] 
                    ) );
                    $toplam_log->rowCount();
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
                        $query = $db->prepare( "SELECT * FROM eptransfer_log WHERE sid = ? &&  gonderen = ?
	ORDER BY id DESC
	LIMIT $limit, $sayfada" );
                        $query->execute( array(
                             server,
                            $_SESSION[ $vt->a( "isim" ) . "username" ]
                        ) );
                        if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_transfer_log/log.php' ) ) {
                            require_once WM_tema . 'sayfalar/kullanici_ep_transfer_log/log.php';
                        } else {
                            require_once Sayfa_html . 'log.php';
                        }
                    } else {
                        echo "LOG BULUNAMADI";
                    }
                } else {
                    $vt->yonlendir( $vt->url( 5 ) );
                }
            }
        } else {
            $vt->yonlendir( $vt->url( 4 ) );
        }
    }
}
?>