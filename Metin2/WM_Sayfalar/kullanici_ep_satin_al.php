<?php
class kullanici_ep_satin_al {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_satin_al/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_ep_satin_al/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return $vt->a( "title" ) . ' - EP Satın Al';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        $epfiyatlari = $db->prepare( "SELECT * FROM epfiyatlari WHERE sid = ? ORDER BY sira" );
        $epfiyatlari->execute( array(
             server 
        ) );
        if ( $vt->a( "breadcumb" ) == 1 ) {
            if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_satin_al/breadcumb.php' ) ) {
                require_once WM_tema . 'sayfalar/kullanici_ep_satin_al/breadcumb.php';
            } else {
                require_once Sayfa_html . 'breadcumb.php';
            }
        }
        @$kontrol2 = $odb->prepare( "SELECT bakiye FROM account LIMIT 1" );
        @$kontrol2->execute( );
        if ( isset( $_POST[ "satinal" ] ) ) {
            $kontrol = $db->prepare( "SELECT id,fiyat,ep FROM epfiyatlari WHERE sid = ? && id = ?" );
            $kontrol->execute( array(
                 server,
                $WMkontrol->WM_get($_GET["id"]) 
            ) );
            if ( $kontrol->rowCount() ) {
                if ( $kontrol2->errorInfo()[2] == false ) {
                    @$kontrol_token = $db->prepare( "SELECT id FROM eptoken" );
                    @$kontrol_token->execute();
                    if ( $kontrol_token ) {
                        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                        @$kontrol_hata = $db->prepare( "SELECT id FROM hatalar WHERE tur = ? && sid = ? && kullanici = ?" );
                        @$kontrol_hata->execute( array(
                             1,
                            server,
                            $_SESSION[ $vt->a( "isim" ) . "username" ] 
                        ) );
                        if ( $vt->uye( "bakiye" ) < $fetch[ "fiyat" ] ) {
                            $tema->hata( "Bakiyeniz yeterli değil" );
                        } else if ( $kontrol_hata->rowCount() || $kontrol_hata->errorInfo()[2] != false ) {
                            $tema->hata( "Hatalar listesinde isminiz var. Hata giderilene kadar alışveriş yapamazsınız" );
                        } else {
                            $random1       = substr( str_shuffle( "abcdefghjklmnoprstuvyzxwqABCDEFGHJKLMNOPRSTUVYZWQ__1234567890" ), 0, 35 );
                            $random2       = substr( str_shuffle( "abcdefghjklmnoprstuvyzxwqABCDEFGHJKLMNOPRSTUVYZWQ__1234567890" ), 0, 7 );
                            $token_olustur  = $db->prepare( "INSERT INTO eptoken SET sid = ?, token = ?, tokenpass = ?, ep = ?, olusturan = ?, olusturma_tarih = ?" );
                            $token_olustur->execute( array(
                                 server,
                                $random1,
                                $random2,
                                $fetch[ "ep" ],
                                $_SESSION[ $vt->a( "isim" ) . "username" ],
                                date( "Y-m-d H:i:s" ) 
                            ) );
                            $ayarlar       = explode( ',', $vt->a( "eptoken" ) );
                            if ( $token_olustur->errorInfo()[2] == false ) {
                                if ( $ayarlar[ 0 ] == 1 ) {
									$mail_icerik = array('ep_token', 1, $_SESSION[ $vt->a( "isim" ) . "username"], $random1, $random2, $fetch["fiyat"], $fetch["ep"]);
                                    $mail_gonder = $vt->mail_gonder( $vt->uye( "email" ), "Satın Alınan Ep Bilgileri", $mail_icerik );
                                    if ( !$mail_gonder ) {
                                        $tema->hata( "Mail Gönderilemedi" );
                                    }
                                    $bilgi = "Ep başarıyla satın alındı. Bilgiler Mail Adresinize Gönderildi Oluşturduğunuz epi . Ep tokenlerimden görebilirsiniz";
                                } else {
                                    $bilgi = "Ep başarıyla satın alındı. Oluşturduğunuz epi . Ep tokenlerimden görebilirsiniz";
                                }
                                $bakiye_dusur = $odb->prepare( "UPDATE account SET bakiye = bakiye - ? WHERE id = ? && login = ?" );
                                $bakiye_dusur->execute( array(
                                     $fetch[ "fiyat" ],
                                    $_SESSION[ $vt->a( "isim" ) . "userid" ],
                                    $_SESSION[ $vt->a( "isim" ) . "username" ] 
                                ) );
                                if ( $bakiye_dusur->errorInfo()[2] == false ) {
                                    $tema->basari( $bilgi );
                                } else {
                                    $vt->hata_gonder( $_SESSION[ $vt->a( "isim" ) . "username" ] . " Adlı kullanıcı " . $fetch[ "fiyat" ] . " TL Ye ep oluşturdu fakat bakiyesi eksilmedi", 1, $_SESSION[ $vt->a( "isim" ) . "username" ] );
                                    $tema->uyari( "Ep tokeni başarıyla oluşturuldu fakat bakiyeniz eksilmedi. Bu hata admine bildirildi . Hata giderilene kadar daha ep satın alamazsınız. ! " );
                                }
                            } else {
                                $tema->hata( "Sistem hatası" );
                            }
                        }
                    } else {
                        $tema->hata( "Ep oluşturma sistemi kurulu değil" );
                    }
                } else {
                    $tema->hata( "Bakiye sistemi kurulu değil" );
                }
            } else {
                $tema->hata( "Böyle Bir Ep Fiyatı Bulunamadı" );
            }
        }
        echo html_entity_decode( $vt->a( "odeme" ) );
        if ( $kontrol2->errorInfo()[2] == false ) {
            if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_satin_al/ep_satin_al.php' ) ) {
                require_once WM_tema . 'sayfalar/kullanici_ep_satin_al/ep_satin_al.php';
            } else {
                require_once Sayfa_html . 'ep_satin_al.php';
            }
        }
    }
}
?>