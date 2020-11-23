<?php
class kullanici_ep_gonder_sifre_degistir {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_degistir/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_degistir/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Ep Transfer Şifresi Değiştir';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        @$select = $db->prepare( "SELECT id FROM eptransfer_log LIMIT 1" );
        @$select->execute( );
        @$select2 = $odb->prepare( "SELECT edurum, epass FROM account LIMIT 1" );
        @$select2->execute( );
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->url( $vt->url( 4 ) );
        } else if ( $select->errorInfo()[2] != false || $select2->errorInfo()[2] != false ) {
            $vt->url( $vt->url( 5 ) );
        } else if ( $vt->uye( "edurum" ) == 2 ) {
            $vt->url( $vt->url( 5 ) );
        } else {
            $eptransfer = explode( ',', $vt->a( "eptransfer" ) );
            if ( $eptransfer[ 0 ] == 1 && $eptransfer[ 4 ] == 1 && $eptransfer[ 1 ] == 1 ) {
                if ( $vt->a( "breadcumb" ) == 1 ) {
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_degistir/breadcumb.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_degistir/breadcumb.php';
                    } else {
                        require_once Sayfa_html . 'breadcumb.php';
                    }
                }
                if ( isset( $_POST[ "sifre_degistir" ] ) ) {
                    $old_pass     = $WMkontrol->WM_post( $WMkontrol->WM_tostring( $_POST[ "old_pass" ] ) );
                    $pass         = $WMkontrol->WM_post( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) );
                    $pass_retry   = $WMkontrol->WM_post( $WMkontrol->WM_tostring( $_POST[ "pass_retry" ] ) );
                    $crsf_token   = $WMkontrol->WM_post( $WMkontrol->WM_tostring( $_POST[ "crsf_token" ] ) );
                    $captcha_code = $WMkontrol->WM_post( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) );
                    if ( !$crsf_token ) {
                        $tema->hata( "Token Yok" );
                    } else if ( $ayar->sessionid != $crsf_token ) {
                        $tema->hata( "Token Hatası" );
                    } else if ( $_SESSION[ "captcha_code" ] != $captcha_code ) {
                        $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                    } else if ( $old_pass != $vt->uye( "epass" ) ) {
                        $tema->hata( "Eski şifrenizi yanlış girdiniz" );
                    } else if ( $pass != $pass_retry || !$pass ) {
                        $tema->hata( "Şifreleriniz aynı değil" );
                    } else {
                        $guncelle   = $odb->prepare( "UPDATE account SET epass = ? WHERE id = ? && login = ?" );
                        $guncelle->execute( array(
                             $pass,
                            $_SESSION[ $vt->a( "isim" ) . "userid" ],
                            $_SESSION[ $vt->a( "isim" ) . "username" ] 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false ) {
                            $log_send   = $db->prepare( "INSERT INTO eptransfer_log SET sid = ?, tur = ?, gonderen = ?, tarih = ?" );
                            $log_gonder = $log_send->execute( array(
                                 server,
                                3,
                                $_SESSION[ $vt->a( "isim" ) . "username" ],
                                date( "Y-m-d H:i:s" ) 
                            ) );
                            $tema->basari( "Ep transfer şifreniz başarıyla değiştirildi" );
                        } else {
                            $tema->hata( "Sistem hatası" );
                        }
                    }
                } else {
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_degistir/sifre_degistir.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_degistir/sifre_degistir.php';
                    } else {
                        require_once Sayfa_html . 'sifre_degistir.php';
                    }
                }
            } else {
                $vt->yonlendir( $vt->url( 5 ) );
            }
        }
    }
}
?>