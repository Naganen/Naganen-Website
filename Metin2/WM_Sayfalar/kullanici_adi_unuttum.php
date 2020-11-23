<?php
class kullanici_adi_unuttum {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_adi_unuttum/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_adi_unuttum/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return $vt->a( "isim" ) . ' - Kullanıcı Adımı Unuttum';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            if ( $vt->a( "kullanici_unuttum" ) == 1 ) {
                if ( isset( $_POST[ "kullanici_adimi_unuttum" ] ) ) {
                    $email                   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "email" ] ) ) );
                    $kullanici_unuttum_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kullanici_unuttum_token" ] ) ) );
                    $captcha_code            = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                    if ( !$kullanici_unuttum_token ) {
                        $tema->hata( "Token yok" );
                    } else if ( $kullanici_unuttum_token != $ayar->sessionid ) {
                        $tema->hata( "Token hatası" );
                    } else if ( !$email ) {
                        $tema->hata( "Email Adresini boş bırakamazsınız. !" );
                    } else if ( $captcha_code != $_SESSION[ "captcha_code" ] ) {
                        $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                    } else {
                        $kontrol = $odb->prepare( "SELECT email,login FROM account WHERE email = ?" );
                        $kontrol->execute( array(
                             $email 
                        ) );
                        if ( $kontrol->rowCount() ) {
                            if ( $kontrol->rowCount() > 1 ) {
                                $bilgi = array( );
                                while ( $row = $kontrol->fetch( PDO::FETCH_ASSOC ) ) {
                                    $bilgi[ ] = $row[ "login" ];
                                }
                                $bilgi = json_encode( $bilgi );
                            } else {
                                $row   = $kontrol->fetch( PDO::FETCH_ASSOC );
                                $bilgi = $row[ "login" ];
                            }
							$mail_icerik = array('kullanici_adi_unuttum', $bilgi);
						   $mail_gonder = $vt->mail_gonder( $email, "Kullanıcı Adımı Unuttum", $mail_icerik );
                            if ( $mail_gonder ) {
                                $tema->basari( $email . " adresine kayıtlı tüm kullanıcılar mail adresinize gönderildi . !" );
                                printf( '<meta http-equiv="refresh" content="5;URL=' . $vt->url( 0 ) . '">' );
                            } else {
                                $tema->hata( "Sistemden kaynaklanan bir hata nedeniyle mail gönderemiyoruz." );
                            }
                        } else {
                            $tema->hata( "Mail adresine ait kullanıcı bulunamadı" );
                        }
                    }
                }
                if ( file_exists( WM_tema . 'sayfalar/kullanici_adi_unuttum/kullanici_adi_unuttum.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_adi_unuttum/kullanici_adi_unuttum.php';
                } else {
                    require_once Sayfa_html . 'kullanici_adi_unuttum.php';
                }
            } else {
                $vt->yonlendir( $vt->url( 0 ) );
            }
        } else {
            $vt->yonlendir( $vt->url( 5 ) );
        }
    }
}
?>