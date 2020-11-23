<?php
class kullanici_depo_sifre {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_depo_sifre/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_depo_sifre/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return @$_SESSION[ $vt->a( "isim" ) . "username" ] . ' - Depo Şifresi Değiştir';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        if ( isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici_depo_sifre/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_depo_sifre/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            if ( $vt->a( "depo_sifre" ) == 1 || $vt->a( "depo_sifre" ) == 2 ) {
                if ( $vt->a( "depo_sifre" ) == 1 ) {
                    if ( isset( $_POST[ "depo_sifre_degistir_1" ] ) ) {
                        $vt->token_ekle( 5, $_SESSION[ $vt->a( "isim" ) . "username" ], $ayar->token_rastgele );
						$mail_icerik = array('depo_sifre', 1, $_SESSION[ $vt->a( "isim" ) . "username" ], $vt->a( "link" ) . 'kullanici/depo-sifre-degistir?depo_token=' . $ayar->token_rastgele);
                        $gonder      = $vt->mail_gonder( $vt->uye( "email" ), "Depo Şifrenizi Değiştirin", $mail_icerik );
                        if ( !$gonder ) {
                            $tema->hata( "Sistemdeki hatadan dolayı mail gönderemedik. Yöneticiler bu hata ile ilgileniyor.." );
                        }
                        $vt->kullanici_log( "Depo şifre değiştirme isteği gönderildi." );
                        echo '<div class="alert alert-success">' . $vt->uye( "email" ) . ' adresinize gelen linke tıklayarak depo şifrenizi değiştirin.</div><center> <a href="kullanici" class="button">K. Paneline Dön</a></center>';
                    } else {
                        @$depo_token = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "depo_token" ] ) ) );
                        if ( !$depo_token ) {
                            require_once Sayfa_html . 'sifre_gonder.php';
                            if ( file_exists( WM_tema . 'sayfalar/kullanici_depo_sifre/sifre_gonder.php' ) ) {
                                require_once WM_tema . 'sayfalar/kullanici_depo_sifre/sifre_gonder.php';
                            } else {
                                require_once Sayfa_html . 'sifre_gonder.php';
                            }
                        } else {
                            $degistir_kontrol = $db->prepare( "SELECT token FROM token WHERE sid = ? && ? && login = ? && token = ?" );
                            $degistir_kontrol->execute( array(
                                 server,
                                5,
                                $_SESSION[ $vt->a( "isim" ) . "username" ],
                                $depo_token 
                            ) );
                            if ( $degistir_kontrol->rowCount() ) {
                                if ( isset( $_POST[ "sifre_degistir_depo_mail" ] ) ) {
                                    $pass_depo         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_depo" ] ) ) );
                                    $pass_depo_retry   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_depo_retry" ] ) ) );
                                    $depo_captcha_code = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "depo_captcha_code" ] ) ) );
                                    $sifre_degis_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sifre_degis_token" ] ) ) );
                                    if ( !$sifre_degis_token ) {
                                        $tema->hata( 'Token yok' );
                                    } else if ( $ayar->sessionid != $sifre_degis_token ) {
                                        $tema->hata( 'Token Hatası' );
                                    } else if ( strlen( $pass_depo ) != 6 ) {
                                        $tema->hata( "Depo şifreniz 6 haneli ve sadece sayı olmalıdır." );
                                    } else if ( !$pass_depo || $pass_depo != $pass_depo_retry ) {
                                        $tema->hata( "Şifreleriniz uyumlu değil" );
                                    } else if ( $_SESSION[ "captcha_code" ] != $depo_captcha_code ) {
                                        $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                                    } else {
                                        $guncelle = $odb->prepare( "UPDATE player.safebox SET password = ? WHERE account_id = ?" );
                                        $guncelle->execute( array(
                                             $pass_depo,
                                            $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                                        ) );
                                        if ( $guncelle ) {
                                            $vt->tokenleri_sil( 5, $_SESSION[ $vt->a( "isim" ) . "username" ] );
                                            printf( '<meta http-equiv="refresh" content="4;URL=kullanici">' );
                                            $vt->kullanici_log( "Depo şifresi değiştirildi" );
                                            $tema->basari( "Depo şifreniz başarıyla değiştirildi." );
                                        } else {
                                            $tema->hata( "Sistem hatası" );
                                        }
                                    }
                                }
                                if ( file_exists( WM_tema . 'sayfalar/kullanici_depo_sifre/sifre_degis_mail.php' ) ) {
                                    require_once WM_tema . 'sayfalar/kullanici_depo_sifre/sifre_degis_mail.php';
                                } else {
                                    require_once Sayfa_html . 'sifre_degis_mail.php';
                                }
                            } else {
                                $tema->hata( "Depo Şifrenizi bu tokenle değiştiremezsiniz .. ! Tokeninizi bilmiyorsanız veya mailinize gelmediyse lütfen tekrar göndermeyi deneyin." );
                                printf( '<meta http-equiv="refresh" content="4;URL=kullanici">' );
                            }
                        }
                    }
                } else if ( $vt->a( "depo_sifre" ) == 2 ) {
                    if ( isset( $_POST[ "depo_sifre_degistir_2" ] ) ) {
                        $rastgele_sifre = substr( str_shuffle( "1234567890" ), 0, 6 );
                        $guncelle       = $odb->prepare( "UPDATE player.safebox SET password = ? WHERE account_id = ?" );
                        $guncelle->execute( array(
                             $rastgele_sifre,
                            $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false  ) {
							$mail_icerik = array('depo_sifre', 2, $_SESSION[ $vt->a( "isim" ) . "username" ], $rastgele_sifre );							
                            $gonder      = $vt->mail_gonder( $vt->uye( "email" ), "Depo Şifreniz Değiştirildi", $mail_icerik );
                            if ( !$gonder ) {
                                $tema->hata( "Sistemdeki hatadan dolayı mail gönderemedik. Yöneticiler bu hata ile ilgileniyor.." );
                            }
                            $vt->kullanici_log( "Depo şifresi değiştirildi" );
                            $tema->basari( "Yeni Depo şifreniz " . $vt->uye( "email" ) . " Adresine gönderildi. " );
                            printf( '<meta http-equiv="refresh" content="4;URL=kullanici">' );
                        } else {
                            $tema->hata( "Sistem hatası" );
                        }
                    } else {
                        if ( file_exists( WM_tema . 'sayfalar/kullanici_depo_sifre/sistem_degisecek.php' ) ) {
                            require_once WM_tema . 'sayfalar/kullanici_depo_sifre/sistem_degisecek.php';
                        } else {
                            require_once Sayfa_html . 'sistem_degisecek.php';
                        }
                    }
                }
            } else if ( $vt->a( "depo_sifre" ) == 3 ) {
                if ( isset( $_POST[ "depo_sifre_degistir_3" ] ) ) {
                    $pass              = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
                    $pass_retry        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_retry" ] ) ) );
                    $sifre_degis_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sifre_degis_token" ] ) ) );
                    $captcha_code      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                    if ( !$sifre_degis_token ) {
                        $tema->hata( "Token yok" );
                    } else if ( $ayar->sessionid != $sifre_degis_token ) {
                        $tema->hata( "Token hatası" );
                    } else if ( strlen( $pass ) != 6 ) {
                        $tema->hata( "Depo şifreniz 6 haneli ve sadece sayı olmalıdır." );
                    } else if ( !$pass || $pass != $pass_retry ) {
                        $tema->hata( "Depo şifreniz 6 haneli ve sadece sayı olmalıdır." );
                    } else if ( $_SESSION[ "captcha_code" ] != $captcha_code ) {
                        $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                    } else {
                        $guncelle = $odb->prepare( "UPDATE player.safebox SET password = ?  WHERE account_id = ?" );
                        $guncelle->execute( array(
                             $pass,
                            $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false  ) {
                            $vt->kullanici_log( "Depo şifresi değiştirildi" );
                            $tema->basari( "Depo Şifrenizi Başarıyla Değiştirdiniz." );
                        } else {
                            $tema->hata( "Sistem hatası" );
                        }
                    }
                }
                if ( file_exists( WM_tema . 'sayfalar/kullanici_depo_sifre/sifre_degis.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_depo_sifre/sifre_degis.php';
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