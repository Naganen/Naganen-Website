<?php
class kullanici_mail_degistir {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_mail_degistir/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_mail_degistir/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return @$_SESSION[ $vt->a( "isim" ) . "username" ] . ' -  Mail Değiştir';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        if ( $vt->a( "breadcumb" ) == 1 ) {
            if ( file_exists( WM_tema . 'sayfalar/kullanici_mail_degistir/breadcumb.php' ) ) {
                require_once WM_tema . 'sayfalar/kullanici_mail_degistir/breadcumb.php';
            } else {
                require_once Sayfa_html . 'breadcumb.php';
            }
        }
        if ( $vt->a( "mail_degistir" ) == 1 ) {
            @$token_sayfa = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "token" ] ) ) );
            @$user_sayfa = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "user" ] ) ) );
            if ( !$token_sayfa || !$user_sayfa ) {
                if ( isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
                    if ( $_POST ) {
                        $mail_degis_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "mail_degis_token" ] ) ) );
                        $yeni_mail        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "yeni_mail" ] ) ) );
                        $captcha_code     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                        $kontrol          = $odb->prepare( "SELECT email FROM account WHERE email = ?" );
                        $kontrol->execute( array(
                             $yeni_mail 
                        ) );
                        if ( !$mail_degis_token ) {
                            $tema->hata( "Token yok" );
                        } else if ( $mail_degis_token != $ayar->sessionid ) {
                            $tema->hata( "Token hatası" );
                        } else if ( $WMkontrol->WM_mail( $yeni_mail ) == false ) {
                            $tema->hata( "Mail adresiniz test@ornek.com şeklinde olmalıdır. !" );
                        } else if ( $yeni_mail == $vt->uye( "email" ) ) {
                            $tema->hata( "Kullanıcının mail adresi zaten " . $yeni_mail . " olarak kayıtlı." );
                        } else if ( $_SESSION[ "captcha_code" ] != $captcha_code ) {
                            $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                        } else if ( $vt->a( "mail_kac" ) == 2 && $kontrol->rowCount() ) {
                            $tema->hata( "Bu maili kullanan bir kullanıcı zaten var. !" );
                        } else {
                            $vt->token_ekle( 3, $_SESSION[ $vt->a( "isim" ) . "username" ], $ayar->token_rastgele . '_' . $yeni_mail ); 
							$mail_icerik = array('mail_degistir', $_SESSION[ $vt->a( "isim" ) . "username" ], $yeni_mail,
							$vt->a( "link" ) . 'kullanici/mail-degistir?token=' . $ayar->token_rastgele . '_' . $yeni_mail . '&user=' . $_SESSION[ $vt->a( "isim" ) . "username" ]);
                            $gonder      = $vt->mail_gonder( $vt->uye( "email" ), "Mail Adresiniz Değiştirilecek", $mail_icerik );
                            if ( !$gonder ) {
                                $tema->hata( "Sistemdeki hatadan dolayı mail gönderemedik. Yöneticiler bu hata ile ilgileniyor.." );
                            }
                            $vt->kullanici_log( "Mail değiştirilme isteği yollandı" );
                            $tema->basari( "Mail adresinize gelen linke tıklayarak mail adresinizi " . $yeni_mail . " olarak değiştirebilirsiniz." );
                        }
                    }
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_mail_degistir/mail_degistir.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_mail_degistir/mail_degistir.php';
                    } else {
                        require_once Sayfa_html . 'mail_degistir.php';
                    }
                } else {
                    $vt->yonlendir( $vt->url( 4 ) );
                }
            } else {
                $token_kontrol = $db->prepare( "SELECT token FROM token WHERE sid = ? && tur = ? && token = ? && login = ?" );
                $token_kontrol->execute( array(
                     server,
                    3,
                    $token_sayfa,
                    $user_sayfa 
                ) );
                if ( $token_kontrol->rowCount() ) {
                    $parcala            = explode( "_", $token_sayfa );
                    $mail = $parcala[ 1 ];
					if(count($parcala) > 2){
						
						$parcala_mail = "";
						
						for($ii = 1; $ii < count($parcala); $ii++){
							
							$parcala_mail .= $parcala[$ii].'_';
							
							
						}
						
						$mail = substr($parcala_mail, 0, -1);
						
					}
                    $guncelle           = $odb->prepare( "UPDATE account SET email = ? WHERE login = ?" );
                    $guncelle->execute( array(
                         $mail,
                        $user_sayfa 
                    ) );
                    if ( $guncelle->errorInfo()[2] == false  ) {
                        $vt->tokenleri_sil( 3, $user_sayfa );
                        $vt->kullanici_log( "Mail " . $mail . " olarak değiştirildi" );
                        $tema->basari( "Mail adresiniz başarıyla " . $mail . " olarak değiştirilmiştir. " );
                    } else {
                        $tema->hata( "Sistem hatası" );
                    }
                } else {
                    $vt->yonlendir( $vt->url( 0 ) );
                }
            }
        } else {
            $vt->yonlendir( $vt->url( 5 ) );
        }
    }
}
?>