<?php
class sifremi_unuttum {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/sifremi_unuttum/header.php' ) ) {
            require_once WM_tema . 'sayfalar/sifremi_unuttum/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return $vt->a( "isim" ) . ' - Şifremi Unuttum';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema, $WMinf;
        if ( isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( $vt->url( 5 ) );
        } else {
            @$asama = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "asama" ] ) ) );
            if ( !$asama || $asama == 1 ) {
                if ( isset( $_POST[ "sifre_unuttum" ] ) ) {
                    $kullanici           = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kullanici" ] ) ) );
                    $email               = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "email" ] ) ) );
                    $sifre_unuttum_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sifre_unuttum_token" ] ) ) );
                    $captcha_code        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                    if ( !$sifre_unuttum_token ) {
                        $tema->hata( "Token yok" );
                    } else if ( $sifre_unuttum_token != $ayar->sessionid ) {
                        $tema->hata( "Token Hatası" );
                    } else if ( $_SESSION[ "captcha_code" ] != $captcha_code ) {
                        $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                    } else if ( !$kullanici || !$email ) {
                        $tema->hata( "Boş alan bırakamazsınız" );
                    } else {
                        $kontrol = $odb->prepare( "SELECT login FROM account WHERE login = ? && email = ?" );
                        $kontrol->execute( array(
                             $kullanici,
                            $email 
                        ) );
                        if ( $kontrol->rowCount() ) {
                            $_SESSION[ "unuttum_kullanici" ] = $kullanici;
                            $_SESSION[ "unuttum_email" ]     = $email;
                            printf( '<meta http-equiv="refresh" content="4;URL=sifremi-unuttum?asama=2">' );
                            $tema->basari( "Bilgileri doğru girdiniz 2.aşamaya yönlendiriliyorsunuz." );
                        } else {
                            $tema->hata( "Kullanıcı adını veya kullanıcının eposta adresini yanlış girdiniz." );
                        }
                    }
                }
                if ( file_exists( WM_tema . 'sayfalar/sifremi_unuttum/asama_1.php' ) ) {
                    require_once WM_tema . 'sayfalar/sifremi_unuttum/asama_1.php';
                } else {
                    require_once Sayfa_html . 'asama_1.php';
                }
            } else if ( $asama == 2 ) {
                if ( isset( $_SESSION[ "unuttum_kullanici" ] ) && isset( $_SESSION[ "unuttum_email" ] ) ) {
                    $kontrol_session = $odb->prepare( "SELECT login FROM account WHERE login = ? && email = ?" );
                    $kontrol_session->execute( array(
                         $_SESSION[ "unuttum_kullanici" ],
                        $_SESSION[ "unuttum_email" ] 
                    ) );
                    if ( $kontrol_session->rowCount() ) {
                        if ( $vt->a( "sifre_unuttum" ) == 1 || $vt->a( "sifre_unuttum" ) == 2 ) {
                            if ( $vt->a( "sifre_unuttum" ) == 1 ) {
                                $rastgele    = substr( str_shuffle( "abcdefghjklmnoprstuvyz1234567890" ), 0, 18 );
                                $rastgelee   = $ayar->token_rastgele . '_' . $_SESSION[ "unuttum_kullanici" ] . '_' . $_SESSION[ "unuttum_email" ] . '_' . $rastgele;
                                $link_yapisi = $vt->a( "link" ) . 'sifremi-unuttum?asama=degistir&token_degistir=' . $rastgelee . '&user=' . $_SESSION[ "unuttum_kullanici" ];
                                $vt->token_ekle( 7, $_SESSION[ "unuttum_kullanici" ], $rastgelee );
								
								$mail_icerik = array('sifremi_unuttum', 1, $_SESSION[ "unuttum_kullanici" ],
								$link_yapisi
								);
								
                                $gonder      = $vt->mail_gonder( $_SESSION[ "unuttum_email" ], "Şifremi Unuttum", $mail_icerik );
                                if ( !$gonder ) {
                                    $tema->hata( "Sistemdeki hatadan dolayı mail gönderemedik. Yöneticiler bu hata ile ilgileniyor.." );
                                }
                                printf( '<meta http-equiv="refresh" content="3;URL=' . $vt->url( 0 ) . '">' );
                                $tema->basari( 'Şifrenizi ' . $_SESSION[ "unuttum_email" ] . ' mailine gelen linke tıklayarak değiştirebilirsiniz..' );
                                unset( $_SESSION[ "unuttum_email" ] );
                                unset( $_SESSION[ "unuttum_kullanici" ] );
                            } else if ( $vt->a( "sifre_unuttum" ) == 2 ) {
                                $yeni_sifre  = substr( str_shuffle( "abcdefghjklmnoprstuvyz1234567890" ), 0, 7 );
								$mail_icerik = array('sifremi_unuttum', 2, $_SESSION[ "unuttum_kullanici" ], $yeni_sifre);
                                $gonder      = $vt->mail_gonder( $_SESSION[ "unuttum_email" ], "Yeni Şifreniz : ", $mail_icerik );
                                if ( !$gonder ) {
                                    $tema->hata( "Sistemdeki hatadan dolayı mail gönderemedik. Yöneticiler bu hata ile ilgileniyor.." );
                                }
                                $sifre_degistir = $odb->prepare( "UPDATE account SET password = PASSWORD(?) WHERE login = ? && email = ?" );
                                $sifre_degistir->execute( array(
                                     $yeni_sifre,
                                    $_SESSION[ "unuttum_kullanici" ],
                                    $_SESSION[ "unuttum_email" ] 
                                ) );
                                if ( $sifre_degistir->errorInfo()[2] == false  ) {
                                    printf( '<meta http-equiv="refresh" content="3;URL=' . $vt->url( 0 ) . '">' );
                                    $tema->basari( 'Yeni Şifreniz ' . $_SESSION[ "unuttum_email" ] . ' adresine gönderilmiştir.' );
                                    unset( $_SESSION[ "unuttum_email" ] );
                                    unset( $_SESSION[ "unuttum_kullanici" ] );
                                } else {
                                    echo "Sistem Hatası";
                                }
                            }
                        } else {
                            if ( $vt->a( "guvenlik" ) == 1 ) {
                                $kullanici_bul = $odb->prepare( "SELECT question1, answer1 FROM account WHERE login = ? && email = ?" );
                                $kullanici_bul->execute( array(
                                     $_SESSION[ "unuttum_kullanici" ],
                                    $_SESSION[ "unuttum_email" ] 
                                ) );
                                if ( $kullanici_bul->rowCount() ) {
                                    $kullanici_fetch = $kullanici_bul->fetch( PDO::FETCH_ASSOC );
                                    $guvenlik_sorusu = $kullanici_fetch[ "question1" ];
                                    $guvenlik_cevabi = $kullanici_fetch[ "answer1" ];
                                    if ( $guvenlik_sorusu != "" ) {
                                        if ( isset( $_POST[ "guvenlik_sorusu_ile" ] ) ) {
                                            $guvenlik_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "guvenlik_token" ] ) ) );
                                            $guvenlik_cevap = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "guvenlik_cevap" ] ) ) );
                                            if ( !$guvenlik_token ) {
                                                $tema->hata( "Token yok" );
                                            } else if ( $guvenlik_token != $ayar->sessionid ) {
                                                $tema->hata( "Token Hatası" );
                                            } else if ( $guvenlik_cevabi != $guvenlik_cevap ) {
                                                $tema->hata( "Güvenlik Sorusunun cevabını yanlış girdiniz.." );
                                            } else {
                                                $_SESSION[ "guvenlik_dogru" ] = $guvenlik_token;
                                                $tema->basari( "Güvenlik Sorusu doğru. Şifre değiştirme sayfasına yönlendiriliyorsunuz.." );
                                            }
                                        }
                                        if ( file_exists( WM_tema . 'sayfalar/sifremi_unuttum/guvenlik.php' ) ) {
                                            require_once WM_tema . 'sayfalar/sifremi_unuttum/guvenlik.php';
                                        } else {
                                            require_once Sayfa_html . 'guvenlik.php';
                                        }
                                    } else {
                                        printf( '<meta http-equiv="refresh" content="4;URL=sifremi-unuttum">' );
                                        $tema->hata( "Güvenlik Sorusu Tanımlanmamış. !" );
                                    }
                                } else {
                                    $vt->yonlendir( "sifremi-unuttum" );
                                }
                            } else {
                                $tema->hata( "Sistemde güvenlik sorusu ile şifre sıfırlama kapalı gözüküyor. Lütfen yetkili ile iletişime geçiniz." );
                            }
                        }
                    } else {
                        $WMinf->session_giris_sonlandir();
                        $vt->yonlendir( "sifremi-unuttum" );
                    }
                } else {
                    $WMinf->session_giris_sonlandir();
                    $vt->yonlendir( "sifremi-unuttum" );
                }
            } else if ( $asama == "degistir" ) {
                $WMinf->session_giris_sonlandir();
                @$token_degistir = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "token_degistir" ] ) ) );
                @$user = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "user" ] ) ) );
                if ( !$user || !$token_degistir ) {
                    $vt->yonlendir( "sifremi-unuttum" );
                } else {
                    $parcala   = explode( "_", $token_degistir );
                    $mail      = $parcala[ 2 ];
					
					if(count($parcala) > 3){
						
						$parcala_mail = "";
						
						for($ii = 2; $ii < count($parcala) - 1; $ii++){
							
							$parcala_mail .= $parcala[$ii].'_';
							
							
						}
						
						$mail = substr($parcala_mail, 0, -1);
						
					}
                    $kullanici = $parcala[ 1 ];
                    $kontroll  = $db->prepare( "SELECT token FROM token WHERE tur = ? && sid = ? && token = ? && login = ?" );
                    $kontroll->execute( array(
                         7,
                        server,
                        $token_degistir,
                        $user 
                    ) );
                    $kontrol = $kontroll->rowCount();
                    if ( $kullanici != $user ) {
                        $vt->yonlendir( "sifremi-unuttum" );
                    } else if ( $kontrol == 0 ) {
                        $vt->yonlendir( "sifremi-unuttum" );
                    } else {
                        if ( isset( $_POST[ "sifre_degistir" ] ) ) {
                            $pass              = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
                            $pass_retry        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_retry" ] ) ) );
                            $sifre_degis_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sifre_degis_token" ] ) ) );
                            $captcha_code      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                            if ( !$sifre_degis_token ) {
                                $tema->hata( "Token yok" );
                            } else if ( $sifre_degis_token != $ayar->sessionid ) {
                                $tema->hata( "Token Hatası" );
                            } else if ( !$pass || !$pass_retry ) {
                                $tema->hata( "Şifrelerinizi boş bırakamazsınız." );
                            } else if ( $pass != $pass_retry ) {
                                $tema->hata( "Şifreleriniz uyumlu değil" );
                            } else if ( $captcha_code != $_SESSION[ "captcha_code" ] ) {
                                $tema->hata( "Güvenlik kodunu yanlış girdiniz. ! " );
                            } else {
                                $kontrol = $odb->prepare( "SELECT login FROM account WHERE login = ? && email = ?" );
                                $kontrol->execute( array(
                                     $user,
                                    $mail 
                                ) );
                                if ( $kontrol->rowCount() ) {
                                    $guncelle = $odb->prepare( "UPDATE account SET password = PASSWORD(?) WHERE login = ? && email = ?" );
                                    $guncelle->execute( array(
                                         $pass,
                                        $user,
                                        $mail 
                                    ) );
                                    if ( $guncelle->errorInfo()[2] == false  ) {
                                        $vt->tokenleri_sil( 7, $user );
                                        $tema->basari( "Şifreniz başarıyla değiştirildi.!" );
                                    }
                                } else {
                                    printf( '<meta http-equiv="refresh" content="3;URL=sifremi-unuttum">' );
                                    $tema->hata( "Böyle Bir kullanıcı bulunamadı." );
                                }
                            }
                        }
                        if ( file_exists( WM_tema . 'sayfalar/sifremi_unuttum/degistir_1.php' ) ) {
                            require_once WM_tema . 'sayfalar/sifremi_unuttum/degistir_1.php';
                        } else {
                            require_once Sayfa_html . 'degistir_1.php';
                        }
                    }
                }
            } else if ( $asama == "guvenlik_soru_dogru" ) {
                $token_sayfa = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "token" ] ) ) );
                if ( !$token_sayfa ) {
                    $vt->yonlendir( "sifremi-unuttum" );
                } else if ( $token_sayfa != $ayar->sessionid ) {
                    $vt->yonlendir( "sifremi-unuttum" );
                } else if ( !isset( $_SESSION[ "guvenlik_dogru" ] ) ) {
                    $vt->yonlendir( "sifremi-unuttum" );
                } else {
                    if ( isset( $_POST[ "sifre_degistir_guvenlik" ] ) ) {
                        $pass              = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
                        $pass_retry        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_retry" ] ) ) );
                        $sifre_degis_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sifre_degis_token" ] ) ) );
                        $captcha_code      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                        if ( !$sifre_degis_token ) {
                            $tema->hata( "Token yok" );
                        } else if ( $sifre_degis_token != $ayar->sessionid ) {
                            $tema->hata( "Token hatası" );
                        } else if ( !$pass || !$pass_retry ) {
                            $tema->hata( "Şifrelerinizi boş bırakamazsınız." );
                        } else if ( $pass != $pass_retry ) {
                            $tema->hata( "Şifreleriniz uyumlu değil" );
                        } else if ( $captcha_code != $_SESSION[ "captcha_code" ] ) {
                            $tema->hata( "Güvenlik kodunu yanlış girdiniz. ! " );
                        } else {
                            $kontrol = $odb->prepare( "SELECT login FROM account WHERE login = ? && email = ?" );
                            $kontrol->execute( array(
                                 $_SESSION[ "unuttum_kullanici" ],
                                $_SESSION[ "unuttum_email" ] 
                            ) );
                            if ( $kontrol->rowCount() ) {
                                $guncelle = $odb->prepare( "UPDATE account SET password = PASSWORD(?) WHERE login = ? && email = ?" );
                                $guncelle->execute( array(
                                     $pass,
                                    $_SESSION[ "unuttum_kullanici" ],
                                    $_SESSION[ "unuttum_email" ] 
                                ) );
                                if ( $guncelle->errorInfo()[2] == false  ) {
                                    unset( $_SESSION[ "unuttum_email" ] );
                                    unset( $_SESSION[ "unuttum_email" ] );
                                    unset( $_SESSION[ "guvenlik_dogru" ] );
                                    printf( '<meta http-equiv="refresh" content="4;URL=' . $vt->url( 4 ) . '">' );
                                    $tema->basari( "Şifreniz başarıyla değiştirildi.!" );
                                }
                            } else {
                                printf( '<meta http-equiv="refresh" content="3;URL=sifremi-unuttum">' );
                                $tema->hata( "Böyle Bir kullanıcı bulunamadı." );
                            }
                        }
                    }
                    if ( file_exists( WM_tema . 'sayfalar/sifremi_unuttum/degistir_2.php' ) ) {
                        require_once WM_tema . 'sayfalar/sifremi_unuttum/degistir_2.php';
                    } else {
                        require_once Sayfa_html . 'degistir_2.php';
                    }
                }
            }
        }
    }
}
?>