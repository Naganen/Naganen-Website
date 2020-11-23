<?php
class kullanici_ep_token_kullan {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_token_kullan/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_ep_token_kullan/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return @$_SESSION[ $vt->a( "isim" ) . "username" ] . ' -  EP Token Kullan';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        @$select = $db->prepare( "SELECT id FROM eptoken LIMIT 1" );
        @$select->execute( );
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( $vt->url( 4 ) );
        } else if ( $select->errorInfo()[2] != false ) {
            $vt->yonlendir( $vt->url( 5 ) );
        } else {
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_token_kullan/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_ep_token_kullan/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            if ( isset( $_POST[ "tokenkullan" ] ) ) {
                $token        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "token" ] ) ) );
                $pass         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
                $crsf_token   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "crsf_token" ] ) ) );
                $captcha_code = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                if ( !$crsf_token ) {
                    $tema->hata( "Token Yok" );
                } else if ( $ayar->sessionid != $crsf_token ) {
                    $tema->hata( "Token Hatası" );
                } else if ( $_SESSION[ "captcha_code" ] != $captcha_code ) {
                    $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                } else {
                    $kontrol = $db->prepare( "SELECT id,ep,kullanan FROM eptoken WHERE sid = ? && token = ? && tokenpass = ?" );
                    $kontrol->execute( array(
                         server,
                        $token,
                        $pass 
                    ) );
                    if ( $kontrol->rowCount() ) {
                        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                        if ( $fetch[ "kullanan" ] == "" ) {
                            $token_kullan   = $db->prepare( "UPDATE eptoken SET kullanan = ?, kullanma_tarih = ? WHERE sid = ? && id = ?" );
                            $token_kullan->execute( array(
                                 $_SESSION[ $vt->a( "isim" ) . "username" ],
                                date( "Y-m-d H:i:s" ),
                                server,
                                $fetch[ "id" ] 
                            ) );
                            if ( $token_kullan->errorInfo()[2] == false ) {
                                $ep_gonder = $odb->prepare( "UPDATE account SET coins = coins + ? WHERE id = ? && login = ? " );
                                $ep_gonder->execute( array(
                                     $fetch[ "ep" ],
                                    $_SESSION[ $vt->a( "isim" ) . "userid" ],
                                    $_SESSION[ $vt->a( "isim" ) . "username" ] 
                                ) );
                                if ( $ep_gonder->errorInfo()[2] == false ) {
                                    $tema->basari( "Ep tokeni başarıyla kullanıldı. Barındırdığı ep hesabınıza yüklendi" );
                                } else {
                                    $tema->uyari( "Ep tokeni kullanıldı fakat barındırdığı ep hesabınıza yüklenemedi. Bu hata yöneticiye bildirildi" );
                                    $tema->hata_gonder( $_SESSION[ $vt->a( "isim" ) . "username" ] . " adlı kullanıcıya ep tokeninden " . $fetch[ "ep" ] . " Yüklenemedi" );
                                }
                            } else {
                                $tema->hata( "Sistem hatası" );
                            }
                        } else {
                            $tema->hata( "Bu Token Zaten Kullanılmış" );
                        }
                    } else {
                        $tema->hata( "Böyle bir token bulunamadı" );
                    }
                }
            }
            if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_token_kullan/kullan.php' ) ) {
                require_once WM_tema . 'sayfalar/kullanici_ep_token_kullan/kullan.php';
            } else {
                require_once Sayfa_html . 'kullan.php';
            }
        }
    }
}
?>