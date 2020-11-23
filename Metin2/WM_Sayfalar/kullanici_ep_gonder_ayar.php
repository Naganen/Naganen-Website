<?php
class kullanici_ep_gonder_ayar {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder_ayar/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_ep_gonder_ayar/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Ep Transfer Ayar';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        @$select = $db->prepare( "SELECT id FROM eptransfer_log LIMIT 1" );
        @$select->execute( );
        @$select2 = $odb->prepare( "SELECT edurum, epass FROM account LIMIT 1" );
        @$select2->execute( );
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( $vt->url( 4 ) );
        } else if ( $select->errorInfo()[2] != false  || $select2->errorInfo()[2] != false ) {
            $vt->yonlendir( $vt->url( 5 ) );
        } else {
            $eptransfer = explode( ',', $vt->a( "eptransfer" ) );
            if ( $eptransfer[ 0 ] == 1 && $eptransfer[ 5 ] == 1 ) {
                if ( $vt->a( "breadcumb" ) == 1 ) {
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder_ayar/breadcumb.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_ep_gonder_ayar/breadcumb.php';
                    } else {
                        require_once Sayfa_html . 'breadcumb.php';
                    }
                }
                @$durum = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "durum" ] ) ) );
                if ( $durum == 1 || $durum == 2 ) {
                    $update = $odb->prepare( "UPDATE account SET edurum = ? WHERE id = ? && login = ?" );
                    if ( $durum == 1 ) {
                        $update->execute( array(
                             1,
                            $_SESSION[ $vt->a( "isim" ) . "userid" ],
                            $_SESSION[ $vt->a( "isim" ) . "username" ] 
                        ) );
                    } else if ( $durum == 2 ) {
                        $update->execute( array(
                             2,
                            $_SESSION[ $vt->a( "isim" ) . "userid" ],
                            $_SESSION[ $vt->a( "isim" ) . "username" ] 
                        ) );
                    }
					
                    if ( $update->errorInfo()[2] == false ) {
                        $vt->yonlendir( "kullanici/ep-gonder-ayar" );
                    } else {
                        $tema->hata( "Sistem Hatası" );
                    }
                }
                if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder_ayar/ayar.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_ep_gonder_ayar/ayar.php';
                } else {
                    require_once Sayfa_html . 'ayar.php';
                }
            } else {
                $vt->yonlendir( $vt->url( 5 ) );
            }
        }
    }
}
?>