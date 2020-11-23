<?php
class kullanici {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Hoşgeldiniz ' . $_SESSION[ $vt->a( "isim" ) . "username" ];
    }
    public function orta( ) {
        
		global $ayar, $odb, $WMkontrol, $vt, $db, $tema, $WMinf;
						
        if ( isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $ep_transfer = $db->prepare( "SELECT eptransfer FROM server LIMIT 1" );
            $ep_transfer->execute();
            @$ep_transfer_log = $db->prepare( "SELECT id FROM eptransfer_log LIMIT 1" );
            @$ep_transfer_log->execute( );
            @$ep_token = $db->prepare( "SELECT id FROM eptoken LIMIT 1" );
            @$ep_token->execute(  );
            @$e_durum = $odb->prepare( "SELECT edurum FROM account LIMIT 1" );
            @$e_durum->execute( );
            @$davet_kontrol = $db->prepare( "SELECT id, davet_durum FROM server LIMIT 1 " );
            @$davet_kontrol->execute( );
            $bildirimler = $db->prepare( "SELECT id FROM bildirim WHERE sid = ? && alici_tur = ? && alan = ? && durum = ?" );
            $bildirimler->execute( array(
                 server,
                1,
                $_SESSION[ $vt->a( "isim" ) . "username" ],
                1 
            ) );
									
            if ( $ep_transfer->errorInfo()[2] == false ) {
                $eptransayar = explode( ',', $vt->a( "eptransfer" ) );
            }
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            if ( $tema->ayar_server( 2 ) == 1 ) {
                if ( isset( $_SESSION[ "yeni_girdi" ] ) ) {
                    if ( file_exists( WM_tema . 'sayfalar/kullanici/giris_duyuru.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici/giris_duyuru.php';
                    } else {
                        require_once Sayfa_html . 'giris_duyuru.php';
                    }
                    unset( $_SESSION[ "yeni_girdi" ] );
                }
            }
            if ( file_exists( WM_tema . 'sayfalar/kullanici/kullanici.php' ) ) {
                require_once WM_tema . 'sayfalar/kullanici/kullanici.php';
            } else {
                require_once Sayfa_html . 'kullanici.php';
            }
        } else {
            $vt->yonlendir( "giris-yap" );
        }
    }
}
?>