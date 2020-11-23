<?php
class kullanici_davet_et {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_davet_et/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_davet_et/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        return 'Kullanıcı Davet Et';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( "giris-yap" );
        } else if ( !$vt->a( "davet_durum" ) ) {
            $vt->yonlendir( "anasayfa" );
        } else {
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici_davet_et/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_davet_et/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            if ( $vt->a( "davet_durum" ) == 2 ) {
                $vt->yonlendir( $vt->url( 5 ) );
            } else {
                $uid   = $_SESSION[ $vt->a( "isim" ) . "userid" ];
                $uname = $_SESSION[ $vt->a( "isim" ) . "username" ];
                if ( !$vt->uye( "davet" ) ) {
                    $rastgele_davet = $ayar->token_rastgele;
                    $kontrol        = $odb->prepare( "SELECT davet FROM account WHERE davet = ?" );
                    $kontrol->execute( array(
                         $rastgele_davet 
                    ) );
                    if ( $kontrol->rowCount() ) {
                        $rastgele_davet = md5( $rastgele_davet );
                    }
                    $guncelle = $odb->prepare( "UPDATE account SET davet = ? WHERE id = ? && login = ?" );
                    $guncelle->execute( array(
                         $rastgele_davet,
                        $uid,
                        $uname 
                    ) );
                    if ( $guncelle->errorInfo()[2] != false  ) {
                        $tema->hata( "Sistem hatası" );
                    }
                    $tema->uyari( "Davet Kodunuz Yok sayfayı yeniledikten sonra davet kodunuz otomatik oluşturulacaktır." );
                }
                $bol     = explode( ",", $vt->a( "davet_ep" ) );
                $bol_kac = count( $bol );
                if ( $bol_kac != 2 ) {
                    $bol[ 0 ] = 1;
                    $bol[ 1 ] = 5;
                } else if ( !ctype_digit( $bol[ 0 ] ) || !$bol[ 0 ] ) {
                    $bol[ 0 ] = 1;
                } else if ( !ctype_digit( $bol[ 1 ] ) || !$bol[ 1 ] ) {
                    $bol[ 1 ] = 5;
                }
                $Kayitli = $odb->prepare( "SELECT account.securitycode, account.login FROM account.account WHERE account.securitycode = ?" );
                $Kayitli->execute( array(
                     $vt->uye( "davet" ) 
                ) );
                $Kayitli = $Kayitli->rowCount();
                $Kayitli_basari = $odb->prepare( "SELECT account.securitycode, account.login, account.id, player.id AS playerid, player.name FROM account.account INNER JOIN player.player ON account.id = player.account_id WHERE account.securitycode = ?
&& player.level >= ? && player.dvt = ?
GROUP BY player.id" );
                $Kayitli_basari->execute( array(
                     $vt->uye( "davet" ),
                    $vt->a( "davet_level" ),
                    1 
                ) );
                if ( $Kayitli_basari->rowCount() ) {
                    $karakter_idler = array( );
                    foreach ( $Kayitli_basari as $karakter ) {
                        $karakter_idler[ ] = $karakter[ "playerid" ];
                    }
                }
                $hediye_topla  = floor( $Kayitli_basari->rowCount() / $bol[ 0 ] );
                $hediye_toplam = $hediye_topla * $bol[ 1 ];
                if ( isset( $_POST[ "hediyemi_al" ] ) ) {
                    if ( isset( $karakter_idler ) ) {
                        $hatalar = array( );
                        try {
                            foreach ( $karakter_idler as $guncellencek ) {
                                $guncelle = $odb->prepare( "UPDATE player.player SET dvt = ? WHERE id = ?" );
                                $guncelle->execute( array(
                                     2,
                                    $guncellencek 
                                ) );
                                if ( $guncelle->errorInfo()[2] != false  ) {
                                    throw new Exception( 'Sistem Hatası' );
                                }
                            }
                        }
                        catch ( Exception $e ) {
                            $hatalar[ ] = $e->getMessage();
                        }
                        $hata_varmi = count( $hatalar );
                        if ( $hata_varmi == 0 ) {
                            $ep_gonder = $odb->prepare( "UPDATE account SET coins = coins + ? WHERE id = ? && login = ? " );
                            $ep_gonder->execute( array(
                                 $hediye_toplam,
                                $uid,
                                $uname 
                            ) );
                            if ( $ep_gonder->errorInfo()[2] == false  ) {
                                $vt->kullanici_log( $hediye_toplam . " Ep Aldı ( Davet )" );
                                $tema->basari( "Hesabınıza başarıyla " . $hediye_toplam . " Ep yüklendi" );
                            } else {
                                $vt->hata_gonder( $uname . " Adlı kullanıcı davet ederek topladığı toplam " . $hediye_toplam . " Ep ' i hesabına yüklüyemedi" );
                                $tema->hata( "Bir hata nedeniyle ep gönderme işlemini gerçekleştiremedik. Bu hata yönetim ekibine bildirildi." );
                            }
                        } else {
                            $tema->hata( "Sistem Hatası" );
                        }
                    } else {
                        $tema->hata( "Alıncak Ep Yok" );
                    }
                }
                if ( file_exists( WM_tema . 'sayfalar/kullanici_davet_et/kullanici_davet_et.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_davet_et/kullanici_davet_et.php';
                } else {
                    require_once Sayfa_html . 'kullanici_davet_et.php';
                }
            }
        }
    }
}
?>