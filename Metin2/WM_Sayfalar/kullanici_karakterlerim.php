<?php

class kullanici_karakterlerim {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_karakterlerim/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_karakterlerim/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return $vt->a( "isim" ) . ' - Karakterlerim';
    }
    public function orta( ) {
        global $ayar, $WMkontrol, $vt, $db, $tema, $odb, $WMinf;
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( $vt->url( 4 ) );
        } else {
            @$karakter_duzenle = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "karakter_duzenle" ] ) ) );
            @$karakter = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "karakter" ] ) ) );
            @$guild_id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "guild_id" ] ) ) );
            @$sosyal_kontrol = $odb->prepare( "SELECT imza, sosyal FROM player.player LIMIT 1" );
            @$sosyal_kontrol->execute( );
            if ( ( !$karakter_duzenle || $karakter_duzenle == "" ) && ( !$guild_id || !$karakter ) ) {
                $karakterler = $odb->prepare( "SELECT id,name,job,level,alignment,exp FROM player.player WHERE account_id = ? ORDER BY level DESC" );
                $karakterler->execute( array(
                     $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                ) );
                if ( $vt->a( "breadcumb" ) == 1 ) {
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_karakterlerim/breadcumb.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_karakterlerim/breadcumb.php';
                    } else {
                        require_once Sayfa_html . 'breadcumb.php';
                    }
                }
                if ( file_exists( WM_tema . 'sayfalar/kullanici_karakterlerim/karakterleri.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_karakterlerim/karakterleri.php';
                } else {
                    require_once Sayfa_html . 'karakterleri.php';
                }
            } else if ( $guild_id != '' && $karakter != '' ) {
                $lonca_sosyal = $odb->prepare( "SELECT sosyal FROM player.guild LIMIT 1" );
                $lonca_sosyal->execute( );
                if ( $lonca_sosyal->errorInfo()[2] == false ) {
                    $karakter_kontrol = $odb->prepare( "SELECT id,name,job FROM player.player WHERE account_id = ?" );
                    $karakter_kontrol->execute( array(
                         $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                    ) );
                    if ( $karakter_kontrol->rowCount() ) {
                        $lonca_kontrol = $odb->prepare( "SELECT * FROM player.guild WHERE master = ?" );
                        $lonca_kontrol->execute( array(
                             $karakter 
                        ) );
                        if ( $lonca_kontrol->rowCount() ) {
                            $karakter_fetch = $karakter_kontrol->fetch( PDO::FETCH_ASSOC );
                            $lonca_fetch    = $lonca_kontrol->fetch( PDO::FETCH_ASSOC );
                            if ( $vt->a( "breadcumb" ) == 1 ) {
                                if ( file_exists( WM_tema . 'sayfalar/kullanici_karakterlerim/breadcumb_2.php' ) ) {
                                    require_once WM_tema . 'sayfalar/kullanici_karakterlerim/breadcumb_2.php';
                                } else {
                                    require_once Sayfa_html . 'breadcumb_2.php';
                                }
                            }
                            if ( isset( $_POST[ "lonca_sosyal_kaydet" ] ) ) {
                                @$facebook = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "facebook" ] ) ) );
                                @$raidcall = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "raidcall" ] ) ) );
                                @$teamspeak3 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "teamspeak3" ] ) ) );
                                $sosyal_array = array(
                                     $facebook,
                                    $raidcall,
                                    $teamspeak3 
                                );
                                $crsf_token   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "crsf_token" ] ) ) );
                                $captcha_code = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                                if ( !$crsf_token ) {
                                    $tema->hata( "Token Yok" );
                                } else if ( $ayar->sessionid != $crsf_token ) {
                                    $tema->hata( "Token Hatası" );
                                } else if ( $_SESSION[ "captcha_code" ] != $captcha_code ) {
                                    $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                                } else {
                                    $guncelle   = $odb->prepare( "UPDATE player.guild SET sosyal = ? WHERE id = ? && master = ?" );
                                    $guncelle->execute( array(
                                         json_encode( $sosyal_array ),
                                        $guild_id,
                                        $karakter 
                                    ) );
                                    if ( $guncelle->errorInfo()[2] == false ) {
                                        $tema->basari( "Sosyal ağ ayarlarınız başarıyla güncellendi" );
                                    } else {
                                        $tema->hata( "Sistem hatası" );
                                    }
                                }
                            }
                            $sosyal_lonca = json_decode( $lonca_fetch[ "sosyal" ] );
                            if ( file_exists( WM_tema . 'sayfalar/kullanici_karakterlerim/karakter_bilgi.php' ) ) {
                                require_once WM_tema . 'sayfalar/kullanici_karakterlerim/karakter_bilgi.php';
                            } else {
                                require_once Sayfa_html . 'karakter_bilgi.php';
                            }
                        } else {
                            $vt->yonlendir( "kullanici/karakterlerim" );
                        }
                    } else {
                        $vt->yonlendir( "kullanici/karakterlerim" );
                    }
                } else {
                    $vt->yonlendir( "kullanici/karakterlerim" );
                }
            } else {
                if ( $sosyal_kontrol->errorInfo()[2] == false ) {
                    $kontrol = $odb->prepare( "SELECT id,imza,sosyal,name,job FROM player.player WHERE id = ? && account_id = ?" );
                    $kontrol->execute( array(
                         $karakter_duzenle,
                        $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                    ) );
                    if ( $kontrol->rowCount() ) {
                        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                        if ( $vt->a( "breadcumb" ) == 1 ) {
                            if ( file_exists( WM_tema . 'sayfalar/kullanici_karakterlerim/breadcumb_3.php' ) ) {
                                require_once WM_tema . 'sayfalar/kullanici_karakterlerim/breadcumb_3.php';
                            } else {
                                require_once Sayfa_html . 'breadcumb_3.php';
                            }
                        }
                        if ( isset( $_POST[ "sosyal_kaydet" ] ) ) {
                            @$facebook = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "facebook" ] ) ) );
                            @$youtube = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "youtube" ] ) ) );
                            @$instagram = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "instagram" ] ) ) );
                            $sosyal_array = array(
                                 $facebook,
                                $youtube,
                                $instagram 
                            );
                            $imza         = nl2br( strip_tags( htmlspecialchars( $_POST[ "imza" ] ), "<br />" ) );
                            $crsf_token   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "crsf_token" ] ) ) );
                            $captcha_code = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                            if ( !$crsf_token ) {
                                $tema->hata( "Token Yok" );
                            } else if ( $ayar->sessionid != $crsf_token ) {
                                $tema->hata( "Token Hatası" );
                            } else if ( $_SESSION[ "captcha_code" ] != $captcha_code ) {
                                $tema->hata( "Güvenlik Kodunu Yanlış Girdiniz" );
                            } else {
                                $guncelle   = $odb->prepare( "UPDATE player.player SET imza = ?, sosyal = ? WHERE id = ? && account_id = ?" );
                                $guncelle->execute( array(
                                     $imza,
                                    json_encode( $sosyal_array ),
                                    $karakter_duzenle,
                                    $_SESSION[ $vt->a( "isim" ) . "userid" ] 
                                ) );
                                if ( $guncelle->errorInfo()[2] == false ) {
                                    $tema->basari( "Sosyal ağ ayarlarınız başarıyla güncellendi" );
                                } else {
                                    $tema->hata( "Sistem hatası" );
                                }
                            }
                        }
                        $sosyal       = json_decode( $fetch[ "sosyal" ] );
                        $lonca_baskan = $odb->prepare( "SELECT name,id FROM player.guild WHERE master = ?" );
                        $lonca_baskan->execute( array(
                             $fetch[ "id" ] 
                        ) );
                        if ( file_exists( WM_tema . 'sayfalar/kullanici_karakterlerim/karakter_sosyal.php' ) ) {
                            require_once WM_tema . 'sayfalar/kullanici_karakterlerim/karakter_sosyal.php';
                        } else {
                            require_once Sayfa_html . 'karakter_sosyal.php';
                        }
                    } else {
                        $vt->yonlendir( "kullanici/karakterlerim" );
                    }
                }
            }
        }
    }
}
?>