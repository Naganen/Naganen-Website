<?php
class kullanici_teknik_destek_talep_olustur {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_teknik_destek_talep_olustur/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_teknik_destek_talep_olustur/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Destek Talebi Oluştur';
    }
    public function orta( ) {
        global $ayar, $WMkontrol, $vt, $db, $tema, $WMclass;
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( $vt->url( 4 ) );
        } else {
            @$departman = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "departman" ] ) ) );
            if ( isset( $_POST[ "talepgonder" ] ) ) {
                $konu         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "konu" ] ) ) );
                $icerik       = nl2br( strip_tags( htmlspecialchars( $_POST[ "icerik" ] ), "<br />" ) );
                $crsf_token   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "crsf_token" ] ) ) );
                $captcha_code = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                if ( !$crsf_token ) {
                    $tema->hata( "Token Yok" );
                } else if ( $ayar->sessionid != $crsf_token ) {
                    $tema->hata( "Token Hatası" );
                } else if ( $_SESSION[ "captcha_code" ] != $captcha_code ) {
                    $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                } else if ( !$konu || !$icerik ) {
                    $tema->hata( "Boş alan bırakamzsınız" );
                } else {
                    $kontrol = $db->prepare( "SELECT * FROM destek_kategori WHERE sid = ? && id = ?" );
                    $kontrol->execute( array(
                         server,
                        $departman 
                    ) );
                    if ( $kontrol->rowCount() ) {
                        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                        if ( $vt->a( "destek_mail" ) == 1 ) {
                            $mail_icerik = '<center><table class="wm_table">' . '<thead><tr><th><p class="text-center">Yeni Bir Destek Talebi Oluşturuldu</p></th></tr></thead><tbody>' . "<tr><td class='text-center'>Server : <b>" . $vt->a( "isim" ) . "</b></tr></td>" . "<tr><td class='text-center'>Oluşturan : <b>" . $_SESSION[ $vt->a( "isim" ) . "username" ] . "</b></tr></td>" . "<tr><td class='text-center'>Destek Departmanı : <b>" . $fetch[ "isim" ] . "</b></tr></td>" . "<tr><td class='text-center'>Konu : <b>" . $konu . "</b></tr></td>" . "</table></tbody></center>";
                            $gonder      = $vt->mail_gonder( $WMclass->ayar( "admin_mail" ), "Yeni Destek Talebi", $mail_icerik );
                            if ( !$gonder ) {
                            }
                        }
                        $ekle = $db->prepare( "INSERT INTO destek SET acan = ?, sid = ?, kid = ?, konu = ?, icerik = ?, tarih = ?" );
                        $ekle->execute( array(
                             $_SESSION[ $vt->a( "isim" ) . "username" ],
                            server,
                            $departman,
                            $konu,
                            $icerik,
                            date( "Y-m-d H:i:s" ) 
                        ) );
                        if ( $ekle->errorInfo()[2] == false  ) {
                            $tema->basari( "Destek talebi başarıyla oluşturuldu" );
                            echo '<meta http-equiv="refresh" content="2;URL=' . $vt->url( 7 ) . '">';
                        } else {
                            $tema->hata( "Sistem hatası" );
                        }
                    } else {
                        $tema->hata( "Böyle bir kategori bulunamadı" );
                    }
                }
            }
            if ( !$departman || $departman == "" || !isset( $departman ) ) {
                if ( $vt->a( "breadcumb" ) == 1 ) {
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_teknik_destek_talep_olustur/breadcumb.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_teknik_destek_talep_olustur/breadcumb.php';
                    } else {
                        require_once Sayfa_html . 'breadcumb.php';
                    }
                }
                $query = $db->prepare( "SELECT * FROM destek_kategori WHERE sid = ?" );
                $query->execute( array(
                     server 
                ) );
                if ( file_exists( WM_tema . 'sayfalar/kullanici_teknik_destek_talep_olustur/departmanlar.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_teknik_destek_talep_olustur/departmanlar.php';
                } else {
                    require_once Sayfa_html . 'departmanlar.php';
                }
            } else {
                $kontrol = $db->prepare( "SELECT * FROM destek_kategori WHERE sid = ? && id = ? " );
                $kontrol->execute( array(
                     server,
                    $departman 
                ) );
                if ( $kontrol->rowCount() ) {
                    $kategori_detay = $kontrol->fetch( PDO::FETCH_ASSOC );
                    if ( $vt->a( "breadcumb" ) == 1 ) {
                        if ( file_exists( WM_tema . 'sayfalar/kullanici_teknik_destek_talep_olustur/breadcumb_2.php' ) ) {
                            require_once WM_tema . 'sayfalar/kullanici_teknik_destek_talep_olustur/breadcumb_2.php';
                        } else {
                            require_once Sayfa_html . 'breadcumb_2.php';
                        }
                    }
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_teknik_destek_talep_olustur/olustur.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_teknik_destek_talep_olustur/olustur.php';
                    } else {
                        require_once Sayfa_html . 'olustur.php';
                    }
                } else {
                    $tema->uyari( "Destek kategorisi bulunamadı" );
                }
            }
            printf( '<div style="clear:both;"></div>' );
        }
    }
}
?>