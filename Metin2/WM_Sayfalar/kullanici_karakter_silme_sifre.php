<?php
class kullanici_karakter_silme_sifre {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return ' Karakter Silme Şifresi Değiştir';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        if ( isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            if ( $vt->a( "karakter_silme_sifre" ) == 1 || $vt->a( "karakter_silme_sifre" ) == 2 ) {
                if ( $vt->a( "karakter_silme_sifre" ) == 1 ) {
                    if ( isset( $_POST[ "karakter_sifre_degistir_1" ] ) ) {
                        $vt->token_ekle( 6, $_SESSION[ $vt->a( "isim" ) . "username" ], $ayar->token_rastgele );
						$mail_icerik = array('karakter_silme_sifre', 1, $_SESSION[ $vt->a( "isim" ) . "username" ], 
						$vt->a( "link" ) . 'kullanici/karakter-silme-sifresi-degistir?karakter_token=' . $ayar->token_rastgele);
                        $gonder      = $vt->mail_gonder( $vt->uye( "email" ), "Karakter Silme Şifrenizi Değiştirin", $mail_icerik );
                        if ( !$gonder ) {
                            $tema->hata( "Sistemdeki hatadan dolayı mail gönderemedik. Yöneticiler bu hata ile ilgileniyor.." );
                        }
                        $vt->kullanici_log( "Karakter silme şifresini değiştirme isteği yollandı" );
                        echo '<div class="alert alert-success">' . $vt->uye( "email" ) . ' adresinize gelen linke tıklayarak karakter silme şifrenizi değiştirin.</div><center> <a href="kullanici" class="button">K. Paneline Dön</a></center>';
                    } else {
                        @$karakter_token = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "karakter_token" ] ) ) );
                        if ( !$karakter_token ) {
                            if ( file_exists( WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/sifre_gonder.php' ) ) {
                                require_once WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/sifre_gonder.php';
                            } else {
                                require_once Sayfa_html . 'sifre_gonder.php';
                            }
                        } else {
                            $degistir_kontrol = $db->prepare( "SELECT token FROM token WHERE sid = ? && tur = ? && login = ? && token = ?" );
                            $degistir_kontrol->execute( array(
                                 server,
                                6,
                                $_SESSION[ $vt->a( "isim" ) . "username" ],
                                $karakter_token 
                            ) );
                            if ( $degistir_kontrol->rowCount() ) {
                                if ( isset( $_POST[ "sifre_degistir_karakter_mail" ] ) ) {
                                    $pass_karakter         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_karakter" ] ) ) );
                                    $pass_karakter_retry   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_karakter_retry" ] ) ) );
                                    $karakter_captcha_code = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "karakter_captcha_code" ] ) ) );
                                    $sifre_degis_token     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sifre_degis_token" ] ) ) );
                                    if ( !$sifre_degis_token ) {
                                        $tema->hata( "Token yok" );
                                    } else if ( $ayar->sessionid != $sifre_degis_token ) {
                                        $tema->hata( "Token hatası" );
                                    } else if ( strlen( $pass_karakter ) != 7 ) {
                                        $tema->hata( "Karakter Silme şifreniz 7 haneli ve sadece sayı olmalıdır." );
                                    } else if ( !$pass_karakter || $pass_karakter != $pass_karakter_retry ) {
                                        $tema->hata( "Şifreleriniz uyumlu değil" );
                                    } else if ( $_SESSION[ "captcha_code" ] != $karakter_captcha_code ) {
                                        $tema->hata( " Güvenlik Kodunu Yanlış Girdiniz" );
                                    } else {
                                        $guncelle = $odb->prepare( "UPDATE account SET social_id = ?  WHERE login = ?  && id = ?" );
                                        $guncelle->execute( array(
                                             $pass_karakter,
                                            $_SESSION[ $vt->a( "isim" ) . "username" ],
                                            $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                                        ) );
                                        if ( $guncelle->errorInfo()[2] == false ) {
                                            $vt->tokenleri_sil( 6, $_SESSION[ $vt->a( "isim" ) . "username" ] );
                                            printf( '<meta http-equiv="refresh" content="4;URL=' . $vt->url( 5 ) . '">' );
                                            $vt->kullanici_log( "Karakter Silme şifresi değiştirildi" );
                                            $tema->basari( "Karakter Silme şifreniz başarıyla değiştirildi." );
                                        } else {
                                            $tema->hata( "Sistem hatası" );
                                        }
                                    }
                                }
                                if ( file_exists( WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/sifre_degis_mail.php' ) ) {
                                    require_once WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/sifre_degis_mail.php';
                                } else {
                                    require_once Sayfa_html . 'sifre_degis_mail.php';
                                }
                            } else {
                                $tema->hata( "Karakter Silme Şifrenizi bu tokenle değiştiremezsiniz .. ! Tokeninizi bilmiyorsanız veya mailinize gelmediyse lütfen tekrar göndermeyi deneyin." );
                                printf( '<meta http-equiv="refresh" content="4;URL=' . $vt->url( 5 ) . '">' );
                            }
                        }
                    }
                } else if ( $vt->a( "karakter_silme_sifre" ) == 2 ) {
                    if ( isset( $_POST[ "karakter_sifre_degistir_2" ] ) ) {
                        $rastgele_sifre = substr( str_shuffle( "1234567890" ), 0, 7 );
                        $guncelle       = $odb->prepare( "UPDATE account SET social_id = ?  WHERE login = ?  && id = ?" );
                        $guncelle->execute( array(
                             $rastgele_sifre,
                            $_SESSION[ $vt->a( "isim" ) . "username" ],
                            $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false ) {
							$mail_icerik = array('karakter_silme_sifre', 2, $_SESSION[ $vt->a( "isim" ) . "username" ], $rastgele_sifre );							
                            $gonder      = $vt->mail_gonder( $vt->uye( "email" ), "Karakter Silme Şifreniz Değiştirildi", $mail_icerik );
                            if ( !$gonder ) {
                                $tema->hata( "Sistemdeki hatadan dolayı mail gönderemedik. Yöneticiler bu hata ile ilgileniyor.." );
                            }
                            printf( '<meta http-equiv="refresh" content="4;URL=' . $vt->url( 5 ) . '">' );
                            $vt->kullanici_log( "Karakter Silme şifresi değiştirildi" );
                            $tema->basari( "Yeni Karakter Silme şifreniz <b>" . $vt->uye( "email" ) . " </b> Adresine gönderildi. " );
                        } else {
                            $tema->hata( "Sistem hatası" );
                        }
                    } else {
                        if ( file_exists( WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/sistem_degisecek.php' ) ) {
                            require_once WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/sistem_degisecek.php';
                        } else {
                            require_once Sayfa_html . 'sistem_degisecek.php';
                        }
                    }
                }
            } else if ( $vt->a( "karakter_silme_sifre" ) == 3 ) {
                if ( isset( $_POST[ "karakter_sifre_degistir_3" ] ) ) {
                    $pass              = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
                    $pass_retry        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_retry" ] ) ) );
                    $sifre_degis_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sifre_degis_token" ] ) ) );
                    $captcha_code      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                    if ( !$sifre_degis_token ) {
                        echo 'Token yok';
                    } else if ( $ayar->sessionid != $sifre_degis_token ) {
                        echo 'Token Hatası';
                    } else if ( strlen( $pass ) != 7 ) {
                        $tema->hata( "Karakter Silme şifreniz 7 haneli ve sadece sayı olmalıdır." );
                    } else if ( !$pass || $pass != $pass_retry ) {
                        $tema->hata( "Şifreleriniz uyumlu değil" );
                    } else if ( $_SESSION[ "captcha_code" ] != $captcha_code ) {
                        $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                    } else {
                        $guncelle = $odb->prepare( "UPDATE account SET social_id = ? WHERE login = ?  && id = ?" );
                        $guncelle->execute( array(
                             $pass,
                            $_SESSION[ $vt->a( "isim" ) . "username" ],
                            $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false ) {
                            printf( '<meta http-equiv="refresh" content="4;URL=' . $vt->url( 5 ) . '">' );
                            $vt->kullanici_log( "Karakter Silme şifresi değiştirildi" );
                            $tema->basari( "Karakter Silme Şifrenizi Başarıyla Değiştirdiniz." );
                        } else {
                            $tema->hata( "Sistem hatası" );
                        }
                    }
                }
                if ( file_exists( WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/sifre_degis.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_karakter_silme_sifre/sifre_degis.php';
                } else {
                    require_once Sayfa_html . 'sifre_degis.php';
                }
            }
        } else {
            $vt->yonlendir( $vt->url( 4 ) );
        }
    }
}
?>