<?php
class kullanici_bugdan_kurtar {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_bugdan_kurtar/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_bugdan_kurtar/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Bugdan Kurtar';
    }
    public function orta( ) {
        global $ayar, $WMkontrol, $vt, $db, $odb, $tema;
        if ( $vt->a( "breadcumb" ) == 1 ) {
            if ( file_exists( WM_tema . 'sayfalar/kullanici_bugdan_kurtar/breadcumb.php' ) ) {
                require_once WM_tema . 'sayfalar/kullanici_bugdan_kurtar/breadcumb.php';
            } else {
                require_once Sayfa_html . 'breadcumb.php';
            }
        }
        if ( isset( $_POST[ "bugdan_kurtar" ] ) ) {
            $karakter     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "bugdan_kurtarilcak" ] ) ) );
            $kurtar_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kurtar_token" ] ) ) );
            if ( !$kurtar_token ) {
                $tema->hata( "Token Yok" );
            } else if ( $kurtar_token != $ayar->sessionid ) {
                $tema->hata( "Token hatası" );
            } else if ( $karakter == 1 ) {
                $tema->hata( "Kurtarılcak Karakter bulunamadı " );
            } else {
                $id      = $_SESSION[ $vt->a( "isim" ) . "userid" ];
                $kontrol = $odb->prepare( "SELECT name FROM player.player WHERE account_id = ? && name = ?" );
                $kontrol->execute( array(
                     $id,
                    $karakter 
                ) );
                if ( $kontrol->rowCount() ) {
                    $kordi  = array(
                         "402100",
                        "673900",
                        "64",
                        "402100",
                        "673900",
                        "64" 
                    );
                    $kurtar = $odb->prepare( "UPDATE player.player SET exit_x = ?, exit_y = ?, exit_map_index = ?, x = ?,y = ?,map_index = ? WHERE name = ?" );
                    $kurtar->execute( array(
                         $kordi[ 0 ],
                        $kordi[ 1 ],
                        $kordi[ 2 ],
                        $kordi[ 3 ],
                        $kordi[ 4 ],
                        $kordi[ 5 ],
                        $karakter 
                    ) );
                    if ( $kurtar->errorInfo()[2] == false  ) {
                        $tema->basari( $karakter . " Adlı karakteriniz başarıyla bugdan kurtarıldı. 15 dakka boyunca bu karaktere giriş yapmayınız." );
                        $vt->kullanici_log( $karakter . " Karakteri bugdan kurtarıldı" );
                    } else {
                        $tema->hata( "Sistem hatası" );
                    }
                } else {
                    $tema->hata( "Karakter size ait değil." );
                }
            }
        }
        if ( file_exists( WM_tema . 'sayfalar/kullanici_bugdan_kurtar/bugdan_kurtar.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_bugdan_kurtar/bugdan_kurtar.php';
        } else {
            require_once Sayfa_html . 'bugdan_kurtar.php';
        }
    }
}
?>