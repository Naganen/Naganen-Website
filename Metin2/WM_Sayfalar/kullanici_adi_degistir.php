<?php
class kullanici_adi_degistir {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_adi_degistir/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_adi_degistir/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return @$_SESSION[ $vt->a( "isim" ) . "username" ] . ' -  Kullanıcı Adı Değiştir';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema, $WMinf;
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( $vt->url( 4 ) );
        } else if ( $vt->a( "kullanici_degis" ) == 3 ) {
            $vt->yonlendir( $vt->url( 5 ) );
        } else {
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici_adi_degistir/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_adi_degistir/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            @$token_sayfa = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "token" ] ) ) );
            @$user_sayfa = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "user" ] ) ) );
            if ( !$token_sayfa || !$user_sayfa ) {
                if ( $_POST ) {
                    $kullanici_degis_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kullanici_degis_token" ] ) ) );
                    $yeni_kullanici        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "yeni_kullanici" ] ) ) );
                    $kontrol               = $odb->prepare( "SELECT login FROM account WHERE login = ?" );
                    $kontrol->execute( array(
                         $yeni_kullanici 
                    ) );
                    if ( strlen( $yeni_kullanici ) < 5 || strlen( $yeni_kullanici ) > 15 ) {
                        $tema->hata( "Yeni kullanıcı adınız en az 5 en fazla 15 karakterden oluşmalıdır. !" );
                    } else if ( $_SESSION[ $vt->a( "isim" ) . "username" ] == $yeni_kullanici ) {
                        $tema->hata( "Kullanıcı adınız zaten sistemde " . $yeni_kullanici . " olarak kayıtlı. !" );
                    } else if ( $kontrol->rowCount() ) {
                        $tema->hata( $yeni_kullanici . " adında bir kullanıcı sistemde zaten kayıtlı. !" );
                    } else if ( $vt->a( "kullanici_degis" ) == 2 ) {
                        $vt->token_ekle( 4, $_SESSION[ $vt->a( "isim" ) . "username" ], $ayar->token_rastgele . '_' . $yeni_kullanici );
						$mail_icerik = array('kullanici_adi_degistir', $_SESSION[ $vt->a( "isim" ) . "username" ], $yeni_kullanici,
						$vt->a("link") . 'kullanici/kullanici-adi-degistir?token='. $ayar->token_rastgele . '_' . $yeni_kullanici . '&user=' . $_SESSION[ $vt->a( "isim" ) . "username" ]);
                        $gonder      = $vt->mail_gonder( $vt->uye( "email" ), "Kullanıcı Adınız Değiştirilecek", $mail_icerik );
                        if ( !$gonder ) {
                            $tema->hata( "Sistemdeki hatadan dolayı mail gönderemedik. Yöneticiler bu hata ile ilgileniyor.." );
                        }
                        $vt->kullanici_log( "Kullanıcı adı değiştirme isteği yollandı" );
                        $tema->basari( $vt->uye( "email" ) . " Adresine kullanıcı adı değiştirme talebi gönderildi." );
                    } else {
                        $guncelle = $odb->prepare( "UPDATE account SET login = ? WHERE login = ? && id = ?" );
                        $guncelle->execute( array(
                             $yeni_kullanici,
                            $_SESSION[ $vt->a( "isim" ) . "username" ],
                            $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false ) {
                            $WMinf->session_giris_sonlandir();
                            $vt->kullanici_log( "Kullanıcı adı değiştirildi" );
                            printf( '<meta http-equiv="refresh" content="6;URL=giris-yap">' );
                            $tema->basari( "Kullanıcı Adınız Başarıyla " . $yeni_kullanici . " olarak değiştirilmiştir. Çıkış yapılıyor." );
                        } else {
                            $tema->hata( "Sistem hatası" );
                        }
                    }
                }
                if ( file_exists( WM_tema . 'sayfalar/kullanici_adi_degistir/kullanici_adi_degistir.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_adi_degistir/kullanici_adi_degistir.php';
                } else {
                    require_once Sayfa_html . 'kullanici_adi_degistir.php';
                }
            } else {
                if ( $vt->a( "kullanici_degis" ) == 2 ) {
                    $token_kontrol = $db->prepare( "SELECT token FROM token WHERE sid = ? && tur = ? && token = ? && login = ?" );
                    $token_kontrol->execute( array(
                         server,
                        4,
                        $token_sayfa,
                        $user_sayfa 
                    ) );
                    if ( $token_kontrol->rowCount() ) {
                        $parcala                 = explode( "_", $token_sayfa );
                        $degistirilcek_kullanici = $parcala[ 1 ];
                        $guncelle                = $odb->prepare( "UPDATE account SET login = ? WHERE login = ?" );
                        $guncelle->execute( array(
                             $degistirilcek_kullanici,
                            $user_sayfa 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false ) {
                            $vt->tokenleri_sil( 4, $user_sayfa );
                            $WMinf->session_giris_sonlandir();
                            $vt->kullanici_log( "Kullanıcı adı değiştirildi" );
                            $tema->basari( "Kullanıcı Adınız Başarıyla " . $degistirilcek_kullanici . " olarak değiştirilmiştir. Çıkış yapılıyor." );
                            printf( '<meta http-equiv="refresh" content="3;URL=' . $vt->url( 4 ) . '">' );
                        } else {
                            $tema->hata( "Sistem hatası" );
                        }
                    }
                } else {
                    $vt->yonlendir( $vt->url( 0 ) );
                }
            }
        }
    }
}
?>