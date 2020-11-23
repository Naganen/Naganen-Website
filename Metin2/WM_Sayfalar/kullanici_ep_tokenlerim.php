<?php
class kullanici_ep_tokenlerim {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_tokenlerim/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_ep_tokenlerim/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return $vt->a( "title" ) . ' - EP Tokenlerim';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( $vt->url( 4 ) );
        } else {
            @$eptokenler = $db->prepare( "SELECT * FROM eptoken WHERE sid = ? && olusturan = ? ORDER BY id DESC" );
            @$eptokenler->execute( array(
                 server,
                $_SESSION[ $vt->a( "isim" ) . "username" ] 
            ) );
            @$kontrol = $db->prepare( "SELECT eptoken FROM server LIMIT 1" );
            @$kontrol->execute( );
            if ( $kontrol->errorInfo()[2] != false ) {
                $vt->yonlendir( $vt->url( 0 ) );
            } else if ( $eptokenler->errorInfo()[2] == false ) {
                $ayarlar = explode( ',', $vt->a( "eptoken" ) );
                if ( $vt->a( "breadcumb" ) == 1 ) {
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_tokenlerim/breadcumb.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_ep_tokenlerim/breadcumb.php';
                    } else {
                        require_once Sayfa_html . 'breadcumb.php';
                    }
                }
                if ( isset( $_POST[ "kullan" ] ) ) {
                    @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
                    @$token = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "token" ] ) ) );
                    $kontrol_token = $db->prepare( "SELECT id,kullanan,ep FROM eptoken WHERE sid = ? && id = ? && token = ? && olusturan = ? " );
                    $kontrol_token->execute( array(
                         server,
                        $id,
                        $token,
                        $_SESSION[ $vt->a( "isim" ) . "username" ] 
                    ) );
                    if ( $kontrol_token->rowCount() ) {
                        $fetch = $kontrol_token->fetch( PDO::FETCH_ASSOC );
                        if ( $fetch[ "kullanan" ] == "" || !$fetch[ "kullanan" ] ) {
                            $token_kullan   = $db->prepare( "UPDATE eptoken SET kullanan = ?, kullanma_tarih = ? WHERE sid = ? && id = ? && token = ?" );
                            $token_kullan->execute( array(
                                 $_SESSION[ $vt->a( "isim" ) . "username" ],
                                date( "Y-m-d H:i:s" ),
                                server,
                                $id,
                                $token 
                            ) );
                            if ( $token_kullan->errorInfo()[2] == false ) {
                                $ep_gonder = $odb->prepare( "UPDATE account SET coins = coins + ? WHERE id = ? && login = ? " );
                                $ep_gonder->execute( array(
                                     $fetch[ "ep" ],
                                    $_SESSION[ $vt->a( "isim" ) . "userid" ],
                                    $_SESSION[ $vt->a( "isim" ) . "username" ] 
                                ) );
                                if ( $ep_gonder ) {
                                    $tema->basari( "Ep tokeni başarıyla kullanıldı. Barındırdığı ep hesabınıza yüklendi" );
                                } else {
                                    $tema->uyari( "Ep tokeni kullanıldı fakat barındırdığı ep hesabınıza yüklenemedi. Bu hata yöneticiye bildirildi" );
                                    $tema->hata_gonder( $_SESSION[ $vt->a( "isim" ) . "username" ] . " adlı kullanıcıya ep tokeninden " . $fetch[ "ep" ] . " Yüklenemedi" );
                                }
                            } else {
                                $tema->hata( "Sistem hatası" );
                            }
                        } else {
                            $tema->hata( "Bu ep tokeni zaten kullanılmış" );
                        }
                    } else {
                        $tema->hata( "Böyle bir ep bulunamadı" );
                    }
                }
                if ( isset( $_POST[ "sifregonder" ] ) ) {
                    @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
                    @$token = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "token" ] ) ) );
                    $kontrol_token = $db->prepare( "SELECT id,kullanan,ep,tokenpass,token FROM eptoken WHERE sid = ? && id = ? && token = ? && olusturan = ?" );
                    $kontrol_token->execute( array(
                         server,
                        $id,
                        $token,
                        $_SESSION[ $vt->a( "isim" ) . "username" ] 
                    ) );
                    if ( $kontrol_token->rowCount() ) {
                        $fetch = $kontrol_token->fetch( PDO::FETCH_ASSOC );
                        if ( $fetch[ "kullanan" ] == "" ) {
							$mail_icerik = array('ep_token', 2, $_SESSION[ $vt->a( "isim" ) . "username" ], $fetch[ "token" ], $fetch[ "tokenpass" ]);
                            $mail_gonder = $vt->mail_gonder( $vt->uye( "email" ), "EP Token Şifrem", $mail_icerik );
                            if ( $mail_gonder ) {
                                $tema->basari( "Tokenin Şifresi Mailinize Başarıyla Gönderildi" );
                            } else {
                                $tema->hata( "Mail Gönderilemedi" );
                            }
                        } else {
                            $tema->hata( "Kullanılmış bir tokenin şifresini isteyemezsiniz" );
                        }
                    } else {
                        $tema->hata( "Bu tokenin sahibi siz değilsiniz" );
                    }
                }
                if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_tokenlerim/tokenlerim.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_ep_tokenlerim/tokenlerim.php';
                } else {
                    require_once Sayfa_html . 'tokenlerim.php';
                }
            } else {
                $vt->yonlendir( $vt->url( 0 ) );
            }
        }
    }
}
?>