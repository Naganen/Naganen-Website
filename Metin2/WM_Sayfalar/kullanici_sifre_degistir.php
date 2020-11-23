<?php
class kullanici_sifre_degistir {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_sifre_degistir/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_sifre_degistir/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return @$_SESSION[ $vt->a( "isim" ) . "username" ] . ' -  Şifre Değiştir';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema, $WMinf;
        if ( isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici_sifre_degistir/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_sifre_degistir/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            if ( $vt->a( "hesap_sifre" ) == 1 || $vt->a( "hesap_sifre" ) == 2 ) {
                if ( $vt->a( "hesap_sifre" ) == 1 ) {
                    if ( isset( $_POST[ "sifre_degistir_1" ] ) ) {
                        $vt->token_ekle( 2, $_SESSION[ $vt->a( "isim" ) . "username" ], $ayar->token_rastgele );
						$mail_icerik = array('sifre_degistir', 1, $_SESSION[ $vt->a( "isim" ) . "username" ],
						$vt->a( "link" ) . 'kullanici/sifre-degistir?degistir_token=' . $ayar->token_rastgele);
                        $gonder      = $vt->mail_gonder( $vt->uye( "email" ), "Şifrenizi Değiştirin", $mail_icerik );
                        if ( !$gonder ) {
                            $tema->hata( "Sistemdeki hatadan dolayı mail gönderemedik. Yöneticiler bu hata ile ilgileniyor.." );
                        }
                        $vt->kullanici_log( "Şifre değiştirme isteği yollandı" );
                        echo '<div class="alert alert-success">' . $vt->uye( "email" ) . ' adresinize gelen linke tıklayarak şifrenizi değiştirin.</div><center> <a href="kullanici" class="button">K. Paneline Dön</a></center>';
                    } else {
                        @$degistir_token = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "degistir_token" ] ) ) );
                        if ( !$degistir_token ) {
                            if ( file_exists( WM_tema . 'sayfalar/kullanici_sifre_degistir/link_gonder.php' ) ) {
                                require_once WM_tema . 'sayfalar/kullanici_sifre_degistir/link_gonder.php';
                            } else {
                                require_once Sayfa_html . 'link_gonder.php';
                            }
                        } else {
                            $degistir_kontrol = $db->prepare( "SELECT token FROM token WHERE sid = ? && login = ? && token = ?" );
                            $degistir_kontrol->execute( array(
                                 server,
                                $_SESSION[ $vt->a( "isim" ) . "username" ],
                                $degistir_token 
                            ) );
                            if ( $degistir_kontrol->rowCount() ) {
                                if ( isset( $_POST[ "hesap_sifre_degistir_mail" ] ) ) {
                                    $pass_mail         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_mail" ] ) ) );
                                    $pass_mail_retry   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_mail_retry" ] ) ) );
                                    $mail_captcha_code = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "mail_captcha_code" ] ) ) );
                                    $sifre_degis_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sifre_degis_token" ] ) ) );
                                    if ( !$sifre_degis_token ) {
                                        $tema->hata( "Token yok" );
                                    } else if ( $ayar->sessionid != $sifre_degis_token ) {
                                        $tema->hata( "Token Hatası" );
                                    } else if ( !$pass_mail || $pass_mail != $pass_mail_retry ) {
                                        $tema->hata( "Şifreleriniz uyumlu değil" );
                                    } else if ( $_SESSION[ "captcha_code" ] != $mail_captcha_code ) {
                                        $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                                    } else {
                                        $guncelle = $odb->prepare( "UPDATE account SET password = PASSWORD(?) WHERE login = ? && id = ?" );
                                        $guncelle->execute( array(
                                             $pass_mail,
                                            $_SESSION[ $vt->a( "isim" ) . "username" ],
                                            $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                                        ) );
                                        if ( $guncelle->errorInfo()[2] == false  ) {
                                            $sifre_degis_tokeni_sil = $db->prepare( "DELETE FROM token WHERE tur = ? && sid = ? && login = ?" );
                                            $sifre_degis_tokeni_sil->execute( array(
                                                 2,
                                                server,
                                                $_SESSION[ $vt->a( "isim" ) . "username" ] 
                                            ) );
											$WMinf->session_giris_sonlandir();
                                            printf( '<meta http-equiv="refresh" content="4;URL=' . $vt->url( 4 ) . '">' );
                                            $vt->kullanici_log( "Şifre değiştirildi" );
                                            $tema->basari( "Şifrenizi Başarıyla Değiştirdiniz. Hesaptan çıkış yapılıyor." );
                                        } else {
                                            $tema->hata( "Sistem hatası" );
                                        }
                                    }
                                }
                                if ( file_exists( WM_tema . 'sayfalar/kullanici_sifre_degistir/sifre_degistir_mail.php' ) ) {
                                    require_once WM_tema . 'sayfalar/kullanici_sifre_degistir/sifre_degistir_mail.php';
                                } else {
                                    require_once Sayfa_html . 'sifre_degistir_mail.php';
                                }
                            } else {
                                $tema->hata( "Şifrenizi bu tokenle değiştiremezsiniz .. ! Tokeninizi bilmiyorsanız veya mailinize gelmediyse lütfen tekrar göndermeyi deneyin." );
                                printf( '<meta http-equiv="refresh" content="4;URL=kullanici/sifre-degistir">' );
                            }
                        }
                    }
                } else if ( $vt->a( "hesap_sifre" ) == 2 ) {
                    if ( isset( $_POST[ "sifre_degistir_2" ] ) ) {
                        $rastgele_sifre = substr( str_shuffle( "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ), 0, 6 );
                        $guncelle       = $odb->prepare( "UPDATE account SET password = PASSWORD(?) WHERE login = ? && id = ?" );
                        $guncelle->execute( array(
                             $rastgele_sifre,
                            $_SESSION[ $vt->a( "isim" ) . "username" ],
                            $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false  ) {
							$mail_icerik = array('sifre_degistir', 2, $_SESSION[ $vt->a( "isim" ) . "username" ], $rastgele_sifre);
                            $gonder      = $vt->mail_gonder( $vt->uye( "email" ), "Şifreniz Değiştirildi", $mail_icerik );
                            $vt->kullanici_log( "Şifre değiştirildi" );
                            if ( !$gonder ) {
                                $tema->hata( "Sistemdeki hatadan dolayı mail gönderemedik. Yöneticiler bu hata ile ilgileniyor.." );
                            }
                            $WMinf->session_giris_sonlandir();
                            printf( '<meta http-equiv="refresh" content="4;URL=' . $vt->url( 4 ) . '">' );
                            $tema->basari( "Yeni şifreniz <b>" . $vt->uye( "email" ) . "</b> Adresine gönderildi. Hesaptan çıkış yapılıyor." );
                        } else {
                            $tema->hata( "Sistem hatası" );
                        }
                    } else {
                        if ( file_exists( WM_tema . 'sayfalar/kullanici_sifre_degistir/sistem_degisecek.php' ) ) {
                            require_once WM_tema . 'sayfalar/kullanici_sifre_degistir/sistem_degisecek.php';
                        } else {
                            require_once Sayfa_html . 'sistem_degisecek.php';
                        }
                    }
                }
            } else if ( $vt->a( "hesap_sifre" ) == 3 ) {
                if ( isset( $_POST[ "hesap_sifre_degistir" ] ) ) {
                    $pass_old          = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_old" ] ) ) );
                    $pass              = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
                    $pass_retry        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_retry" ] ) ) );
                    $sifre_degis_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sifre_degis_token" ] ) ) );
                    $captcha_code      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                    $kontrol           = $odb->prepare( "SELECT COUNT(id) FROM account WHERE login = ? && password = PASSWORD(?)" );
                    $kontrol->execute( array(
                         $_SESSION[ $vt->a( "isim" ) . "username" ],
                        $pass_old 
                    ) );
                    $kontrol->rowCount();
                    if ( !$sifre_degis_token ) {
                        $tema->hata( "Token yok" );
                    } else if ( $ayar->sessionid != $sifre_degis_token ) {
                        $tema->hata( "Token Hatası" );
                    } else if ( $kontrol == 0 ) {
                        $tema->hata( "Eski şifrenizi yanlış girdiniz." );
                    } else if ( !$pass || $pass != $pass_retry ) {
                        $tema->hata( "ifreleriniz uyumlu değil" );
                    } else if ( $_SESSION[ "captcha_code" ] != $captcha_code ) {
                        $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                    } else {
                        $guncelle = $odb->prepare( "UPDATE account SET password = PASSWORD(?) WHERE login = ? && id = ?" );
                        $guncelle->execute( array(
                             $pass,
                            $_SESSION[ $vt->a( "isim" ) . "username" ],
                            $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false  ) {
                            $WMinf->session_giris_sonlandir();
                            $vt->kullanici_log( "Şifre değiştirildi" );
                            $tema->basari( "Şifrenizi Başarıyla Değiştirdiniz. Hesaptan çıkış yapılıyor." );
                        } else {
                            $tema->hata( "Sistem hatası" );
                        }
                    }
                }
                if ( file_exists( WM_tema . 'sayfalar/kullanici_sifre_degistir/sifre_degistir.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_sifre_degistir/sifre_degistir.php';
                } else {
                    require_once Sayfa_html . 'sifre_degistir.php';
                }
            }
        } else {
            $vt->yonlendir( $vt->url( 4 ) );
        }
    }
}
?>