<?php
class kullanici_ep_gonder {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_ep_gonder/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return @$_SESSION[ $vt->a( "isim" ) . "username" ] . ' -  EP Gönder';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        @$select = $db->prepare( "SELECT id FROM eptransfer_log LIMIT 1" );
        @$select->execute( );
        @$select2 = $odb->prepare( "SELECT edurum, epass FROM account LIMIT 1" );
        @$select2->execute( );
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( $vt->url( 4 ) );
        } else if ( $select->errorInfo()[2] != false  || $select2->errorInfo()[2] != false  ) {
            $vt->yonlendir( $vt->url( 5 ) );
        } else {
            $eptransfer = explode( ',', $vt->a( "eptransfer" ) );
            if ( $eptransfer[ 0 ] == 1 && $vt->uye( "edurum" ) == 1 ) {
                if ( $vt->a( "breadcumb" ) == 1 ) {
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder/breadcumb.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_ep_gonder/breadcumb.php';
                    } else {
                        require_once Sayfa_html . 'breadcumb.php';
                    }
                }
                if ( $eptransfer[ 1 ] == 1 && $eptransfer[ 2 ] == 1 ) {
                    if ( strlen( $vt->uye( "epass" ) ) < 2 ) {
                        $random   = substr( str_shuffle( "abcdefghkl0123456789" ), 0, 7 );
                        $guncelle   = $odb->prepare( "UPDATE account SET epass = ? WHERE id = ? && login = ?" );
                        $guncelle->execute( array(
                             $random,
                            $_SESSION[ $vt->a( "isim" ) . "userid" ],
                            $_SESSION[ $vt->a( "isim" ) . "username" ] 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false  ) {
                            $tema->uyari( "Ep transfer şifreniz kurallara uymadığından yeni şifre oluşturuldu. Şifreniz : <b>" . $random . "</b>" );
                            echo '<script>alert("Sayfayı yenilemeden önce uyarıyı oku ! "); </script>';
                        }
                    }
                }
                if ( isset( $_POST[ "tokenkullan" ] ) ) {
                    $gonderilcek = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "gonderilcek" ] ) ) );
                    $epmiktar    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "epmiktar" ] ) ) );
                    if ( $eptransfer[ 1 ] == 1 ) {
                        $epass = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "epass" ] ) ) );
                    }
                    $crsf_token   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "crsf_token" ] ) ) );
                    $captcha_code = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                    if ( !$crsf_token ) {
                        $tema->hata( "Token Yok" );
                    } else if ( $ayar->sessionid != $crsf_token ) {
                        $tema->hata( "Token Hatası" );
                    } else if ( $_SESSION[ "captcha_code" ] != $captcha_code ) {
                        $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                    } else if ( $eptransfer[ 1 ] == 1 && @$epass == "" ) {
                        $tema->hata( "Ep transfer şifresi boş bırakılamaz" );
                    } else {
                        $kullanici_kontrol = $odb->prepare( "SELECT account.login, account.id, account.edurum FROM player.player LEFT JOIN account.account ON player.account_id = account.id WHERE player.account_id != ? && player.name = ?" );
                        $kullanici_kontrol->execute( array(
                             $_SESSION[ $vt->a( "isim" ) . "userid" ],
                            $gonderilcek 
                        ) );
                        if ( $kullanici_kontrol->rowCount() ) {
                            $fetch = $kullanici_kontrol->fetch( PDO::FETCH_ASSOC );
                            if ( $eptransfer[ 1 ] == 1 && $vt->uye( "epass" ) != $epass ) {
                                $tema->hata( "Ep transfer şifrenizi yanlış girdiniz" . $epass );
                            } else if ( $fetch[ "edurum" ] == 2 ) {
                                $tema->hata( "Karşıdaki karakter ep transfer sistemini kabul etmediği için ep gönderemiyorsunuz" );
                            } else if ( $vt->uye( "coins" ) < $epmiktar ) {
                                $tema->hata( "Epiniz yeterli olmadığı için gönderemezsiniz" );
                            } else {
                                $kendi_ep_dusur = $odb->prepare( "UPDATE account SET coins = coins - ? WHERE id = ? && login = ?" );
                                $kendi_ep_dusur->execute( array(
                                     $epmiktar,
                                    $_SESSION[ $vt->a( "isim" ) . "userid" ],
                                    $_SESSION[ $vt->a( "isim" ) . "username" ] 
                                ) );
                                if ( $kendi_ep_dusur->errorInfo()[2] == false  ) {
                                    $log_send       = $db->prepare( "INSERT INTO eptransfer_log SET sid = ?, tur = ?, gonderen = ?, alan = ?, ep = ?, tarih = ?" );
                                    $log_gonder     = $log_send->execute( array(
                                         server,
                                        1,
                                        $_SESSION[ $vt->a( "isim" ) . "username" ],
                                        $gonderilcek,
                                        $epmiktar,
                                        date( "Y-m-d H:i:s" ) 
                                    ) );
                                    $karsi_ep_yukle = $odb->prepare( "UPDATE account SET coins = coins + ? WHERE id = ? && login = ?" );
                                    $karsi_ep_yukle->execute( array(
                                         $epmiktar,
                                        $fetch[ "id" ],
                                        $fetch[ "login" ] 
                                    ) );
                                    if ( $karsi_ep_yukle->errorInfo()[2] == false  ) {
                                        $tema->basari( $gonderilcek . " Adlı karaktere <b>" . $epmiktar . "</b> EP Gönderdiniz" );
                                    } else {
                                        $vt->hata_gonder( $_SESSION[ $vt->a( "isim" ) . "username" ] . " Adlı kullanıcı " . $gonderilcek . " Adlı Karaktere " . $epmiktar . " Ep Gönderirken bir hata meydana geldi. (Kullanıcıdan ep eksildi)" );
                                        $tema->uyari( "Epiniz eksildi fakat " . $gonderilcek . " Adlı karaktere <b>" . $epmiktar . "</b> EP Gönderilemedi. Bu hata yöneticiye bildirildi" );
                                    }
                                } else {
                                    $tema->hata( "Sistem hatası" );
                                }
                            }
                        } else {
                            $tema->hata( "Böyle bir karakter bulunamadı" );
                        }
                    }
                }
                if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder/ep_gonder.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_ep_gonder/ep_gonder.php';
                } else {
                    require_once Sayfa_html . 'ep_gonder.php';
                }
            } else {
                $vt->yonlendir( $vt->url( 5 ) );
            }
        }
    }
}
?>