<?php
class kullanici_basvuru {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_basvuru/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_basvuru/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return $vt->a( "isim" ) . ' - Başvuru Formları';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema, $WMinf;
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( $vt->url( 4 ) );
        } else {
            @$detay_basvuru = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "detay_basvuru" ] ) ) );
            if ( !$detay_basvuru ) {
                if ( $vt->a( "breadcumb" ) == 1 ) {
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_basvuru/breadcumb.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_basvuru/breadcumb.php';
                    } else {
                        require_once Sayfa_html . 'breadcumb.php';
                    }
                }
                $sayfada        = 25;
                $toplam_basvuru = $db->prepare( "SELECT COUNT(id) FROM basvurular WHERE sid = ? ORDER BY id DESC" );
                $toplam_basvuru->execute( array(
                     server 
                ) );
                $toplam_basvuru = $toplam_basvuru->fetchColumn();
                if ( $toplam_basvuru != 0 ) {
                    $toplam_sayfa = ceil( $toplam_basvuru / $sayfada );
                    $sayfa        = isset( $_GET[ 'sayfa' ] ) ? (int) $_GET[ 'sayfa' ] : 1;
                    if ( $sayfa < 1 ) {
                        $sayfa = 1;
                    }
                    if ( $sayfa > $toplam_sayfa ) {
                        $sayfa = $toplam_sayfa;
                    }
                    $limit = ( $sayfa - 1 ) * $sayfada;
                    $query = $db->prepare( "SELECT konu,id FROM basvurular WHERE sid = ? ORDER BY id DESC LIMIT $limit, $sayfada" );
                    $query->execute( array(
                         server
                    ) );
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_basvuru/basvuru_formlari.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_basvuru/basvuru_formlari.php';
                    } else {
                        require_once Sayfa_html . 'basvuru_formlari.php';
                    }
                } else {
                    $tema->uyari( "Başvuru Formu Bulunamadı. Kullanıcı yönetim paneline dönmek için <a href='" . $vt->url( 5 ) . "'> tıklayınız. </a>" );
                }
            } else {
                $kontrol = $db->prepare( "SELECT * FROM basvurular WHERE sid = ? && id = ?" );
                $kontrol->execute( array(
                     server,
                    $detay_basvuru 
                ) );
                if ( $kontrol->rowCount() ) {
                    $fetch            = $kontrol->fetch( PDO::FETCH_ASSOC );
                    $array_basvurular = json_decode( $fetch[ "basvuranlar" ], true );
                    $array_onaylanan  = json_decode( $fetch[ "onaylananlar" ], true );
                    $array_red        = json_decode( $fetch[ "red_edilenler" ], true );
                    $kullanici_adi    = $_SESSION[ $vt->a( "isim" ) . "username" ];
                    if ( $fetch[ "bitis_tur" ] == 1 ) {
                        if ( !$vt->zaman_bittimi( $fetch[ "bitis" ] ) ) {
                            $zaman_bittimi_return = true;
                        } else {
                            $zaman_bittimi_return = false;
                        }
                    } else {
                        $zaman_bittimi_return = true;
                    }
                    if ( !isset( $array_basvurular[ $kullanici_adi ] ) && !isset( $array_onaylanan[ $kullanici_adi ] ) && !isset( $array_red[ $kullanici_adi ] ) ) {
                        $durum = "Başvuru yapılmamış";
                    } else if ( isset( $array_basvurular[ $kullanici_adi ] ) ) {
                        $durum = '<p class="basvuru_yapildi">Başvuru Yapıldı</p>';
                    } else if ( isset( $array_onaylanan[ $kullanici_adi ] ) ) {
                        $durum = '<p class="basvuru_onaylandi">Başvurunuz Onaylandı</p>';
                    } else if ( isset( $array_red[ $kullanici_adi ] ) ) {
                        $durum = '<p class="basvuru_red_edildi">Başvurunuz Red Edildi</p>';
                    } else {
                        $durum = "Belli değil";
                    }
                    if ( $fetch[ "tur" ] == 2 ) {
                        if ( $vt->a( "breadcumb" ) == 1 ) {
                            if ( file_exists( WM_tema . 'sayfalar/kullanici_basvuru/breadcumb_2.php' ) ) {
                                require_once WM_tema . 'sayfalar/kullanici_basvuru/breadcumb_2.php';
                            } else {
                                require_once Sayfa_html . 'breadcumb_2.php';
                            }
                        }
                        if ( file_exists( WM_tema . 'sayfalar/kullanici_basvuru/basvuru_durum.php' ) ) {
                            require_once WM_tema . 'sayfalar/kullanici_basvuru/basvuru_durum.php';
                        } else {
                            require_once Sayfa_html . 'basvuru_durum.php';
                        }
                        if ( isset( $_POST[ "lonca_basvur" ] ) ) {
                            $lonca_sart    = json_decode( $fetch[ "lonca_sart" ] );
                            $lonca_isim    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "lonca_isim" ] ) ) );
                            $basvuru_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "basvuru_token" ] ) ) );
                            $captcha_code  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                            $kontrol1      = $odb->prepare( "SELECT id FROM player.guild WHERE name = ?" );
                            $kontrol1->execute( array(
                                 $lonca_isim 
                            ) );
                            $kontrol1 = $kontrol1->rowCount();
                            $kontrol = $odb->prepare( "SELECT guild.name, guild.id AS lonca_id, guild.level, account.id FROM player.guild LEFT JOIN player.player ON guild.master = player.id
LEFT JOIN account.account ON player.account_id = account.id WHERE guild.name = ? GROUP BY player.account_id
" );
                            $kontrol->execute( array(
                                 $lonca_isim 
                            ) );
                            $kontrol_fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                            $uyeler        = $odb->prepare( "SELECT pid FROM player.guild_member WHERE guild_id = ?" );
                            $uyeler->execute( array(
                                 $kontrol_fetch[ "lonca_id" ] 
                            ) );
                            $uyeler = $uyeler->rowCount();
                            if ( !$basvuru_token ) {
                                $tema->hata( "Token bulunamadı" );
                            } else if ( $basvuru_token != $ayar->sessionid ) {
                                $tema->hata( "Token hatası" );
                            } else if ( $captcha_code != $_SESSION[ "captcha_code" ] ) {
                                $tema->hata( "Güvenlik kodunu yanlış girdiniz" );
                            } else if ( !$lonca_isim ) {
                                $tema->hata( "Lonca ismi boş bırakılamaz" );
                            } else if ( $kontrol1 == 0 ) {
                                $tema->hata( "Böyle bir lonca bulunamadı" );
                            } else if ( $kontrol_fetch[ "id" ] != $_SESSION[ $vt->a( "isim" ) . "userid" ] ) {
                                $tema->hata( "Bu loncanın lideri siz değilsiniz" );
                            } else if ( $kontrol_fetch[ "level" ] < $lonca_sart[ 1 ] ) {
                                $tema->hata( "Loncanızın leveli : <b> " . $kontrol_fetch[ "level" ] . " </b> Başvuru şartı ise : <b>" . $lonca_sart[ 1 ] . " level</b> dir. Bu yüzden başvurunuzu alamıyoruz" );
                            } else if ( $uyeler < $lonca_sart[ 0 ] ) {
                                $tema->hata( "Loncanızın üye sayısı : <b> " . $uyeler . " </b> Başvuru şartı ise : <b>" . $lonca_sart[ 0 ] . " kişi</b> dir. Bu yüzden başvurunuzu alamıyoruz" );
                            } else if ( ( $vt->zaman_bittimi( $fetch[ "bitis" ] ) ) && ( $fetch[ "bitis_tur" ] == 1 ) ) {
                                $tema->hata( "Başvuru zamanı dolmuştur. Daha başvuru alamayız" );
                            } else {
                                if ( isset( $array_basvurular[ $_SESSION[ $vt->a( "isim" ) . "username" ] ] ) ) {
                                    $tema->hata( "Daha önceden başvuru zaten yapmışsınız" );
                                } else if ( isset( $array_onaylanan[ $_SESSION[ $vt->a( "isim" ) . "username" ] ] ) ) {
                                    $tema->hata( "Başvurunuz zaten onaylanmış. Daha başvuru yapamazsınız." );
                                } else if ( isset( $array_red[ $_SESSION[ $vt->a( "isim" ) . "username" ] ] ) ) {
                                    $tema->hata( "Başvurunuz red edilmiş. Daha başvuru yapamazsınız." );
                                } else {
                                    $array_ekle = array(
                                         $_SESSION[ $vt->a( "isim" ) . "username" ] => $lonca_isim 
                                    );
                                    $yeni_array = array_replace( $array_ekle, $array_basvurular );
                                    $guncelle     = $db->prepare( "UPDATE basvurular SET basvuranlar = ? WHERE id = ? && sid = ?" );
                                    $guncelle->execute( array(
                                         json_encode( $yeni_array ),
                                        $fetch[ "id" ],
                                        server 
                                    ) );
                                    if ( $guncelle->errorInfo()[2] == false  ) {
                                        $vt->bildirim_gonder( "admin", 3, $fetch[ "konu" ] . " adlı lonca başvuru formuna 1 yeni başvuru var", $fetch[ "id" ], 2 );
                                        $tema->basari( "Başvurunuzu başarıyla yaptınız." );
                                    } else {
                                        $tema->hata( "Sistem hatası" );
                                    }
                                }
                            }
                        }
                        $tema->uyari( "Başvurururken loncanın başkanı olduğunuzdan emin olun." );
                        if ( $fetch[ "bitis" ] != '' ) {
                            $tema->uyari( ( $vt->zaman_bittimi( $fetch[ "bitis" ] ) ) ? "Lonca Başvuru süresi bitmiştir. Daha başvuru yapamazsınız." : 'Lonca Başvuruları ' . $tema->zaman_cevir( $fetch[ "bitis" ], 2 ) . '  biticek ve işleme koyulcaktır' );
                        }
                        echo '<center>' . html_entity_decode( $fetch[ "icerik" ] ) . '</center> <div style="margin-bottom:15px;"></div>';
                        if ( $zaman_bittimi_return == true ) {
                            if ( file_exists( WM_tema . 'sayfalar/kullanici_basvuru/lonca_basvuru.php' ) ) {
                                require_once WM_tema . 'sayfalar/kullanici_basvuru/lonca_basvuru.php';
                            } else {
                                require_once Sayfa_html . 'lonca_basvuru.php';
                            }
                        }
                    } else {
                        if ( $vt->a( "breadcumb" ) == 1 ) {
                            if ( file_exists( WM_tema . 'sayfalar/kullanici_basvuru/breadcumb_2.php' ) ) {
                                require_once WM_tema . 'sayfalar/kullanici_basvuru/breadcumb_2.php';
                            } else {
                                require_once Sayfa_html . 'breadcumb_2.php';
                            }
                        }
                        if ( file_exists( WM_tema . 'sayfalar/kullanici_basvuru/basvuru_durum.php' ) ) {
                            require_once WM_tema . 'sayfalar/kullanici_basvuru/basvuru_durum.php';
                        } else {
                            require_once Sayfa_html . 'basvuru_durum.php';
                        }
                        if ( isset( $_POST[ "normal_basvur" ] ) ) {
                            $icerik        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "icerik" ] ) ) );
                            $basvuru_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "basvuru_token" ] ) ) );
                            $captcha_code  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "captcha_code" ] ) ) );
                            if ( !$basvuru_token ) {
                                $tema->hata( "Token bulunamadı" );
                            } else if ( $basvuru_token != $ayar->sessionid ) {
                                $tema->hata( "Token hatası" );
                            } else if ( $captcha_code != $_SESSION[ "captcha_code" ] ) {
                                $tema->hata( "Güvenlik kodunu yanlış girdiniz" );
                            } else if ( !$icerik ) {
                                $tema->hata( "Başvuru içeriği boş bırakılamaz." );
                            } else if ( ( $vt->zaman_bittimi( $fetch[ "bitis" ] ) ) && ( $fetch[ "bitis_tur" ] == 1 ) ) {
                                $tema->hata( "Başvuru zamanı dolmuştur. Daha başvuru alamayız" );
                            } else {
                                if ( isset( $array_basvurular[ $_SESSION[ $vt->a( "isim" ) . "username" ] ] ) ) {
                                    $tema->hata( "Daha önceden başvuru zaten yapmışsınız" );
                                } else if ( isset( $array_onaylanan[ $_SESSION[ $vt->a( "isim" ) . "username" ] ] ) ) {
                                    $tema->hata( "Başvurunuz zaten onaylanmış. Daha başvuru yapamazsınız." );
                                } else if ( isset( $array_red[ $_SESSION[ $vt->a( "isim" ) . "username" ] ] ) ) {
                                    $tema->hata( "Başvurunuz red edilmiş. Daha başvuru yapamazsınız." );
                                } else {
                                    $array_ekle = array(
                                         $_SESSION[ $vt->a( "isim" ) . "username" ] => $icerik 
                                    );
                                    $yeni_array = array_replace( $array_ekle, $array_basvurular );
                                    $guncelle     = $db->prepare( "UPDATE basvurular SET basvuranlar = ? WHERE id = ? && sid = ?" );
                                    $guncelle->execute( array(
                                         json_encode( $yeni_array ),
                                        $fetch[ "id" ],
                                        server 
                                    ) );
                                    if ( $guncelle->errorInfo()[2] == false  ) {
                                        $vt->bildirim_gonder( "admin", 3, $fetch[ "konu" ] . " adlı başvuru formuna 1 yeni başvuru var", $fetch[ "id" ], 2 );
                                        $tema->basari( "Başvurunuzu başarıyla yaptınız." );
                                    } else {
                                        $tema->hata( "Sistem hatası" );
                                    }
                                }
                            }
                        }
                        if ( $fetch[ "bitis" ] != '' ) {
                            $tema->uyari( ( $vt->zaman_bittimi( $fetch[ "bitis" ] ) ) ? "Başvuru süresi bitmiştir. Daha başvuru yapamazsınız." : 'Başvuru ' . $tema->zaman_cevir( $fetch[ "bitis" ], 2 ) . '  biticek ve işleme koyulcaktır' );
                        }
                        echo '<center>' . html_entity_decode( $fetch[ "icerik" ] ) . '</center> <div style="margin-bottom:15px;"></div>';
                        if ( $zaman_bittimi_return == true ) {
                            if ( file_exists( WM_tema . 'sayfalar/kullanici_basvuru/normal_basvuru.php' ) ) {
                                require_once WM_tema . 'sayfalar/kullanici_basvuru/normal_basvuru.php';
                            } else {
                                require_once Sayfa_html . 'normal_basvuru.php';
                            }
                        }
                    }
                } else {
                    $tema->uyari( "Böyle bir başvuru formu yok başvuru formlarını görmek için <a href='kullanici/basvuru'>Tıklayınız</a>" );
                }
            }
        }
    }
}
?>