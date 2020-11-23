<?php
if ( !isset( $izin_verme ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
} else if ( !isset( $_SESSION[ "market_server" ] ) ) {
    die( "Server Bulunamadı" );
    exit;
}
require_once WM_market . 'sonuc.php';
if ( isset( $_POST[ "satin_al" ] ) ) {
    @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
    $pos     = depo_kontrol();
    $kontrol = $db->prepare( "SELECT * FROM market_item WHERE id = ? && sid = ?" );
    $kontrol->execute( array(
         $id,
        $_SESSION[ "market_server" ] 
    ) );
    $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
    if ( !$id ) {
        $sonuc = new WM_sonuc( "hata", "Form Hatası" );
    } else if ( !isset( $_SESSION[ "market_user" ] ) || !isset( $_SESSION[ "market_token" ] ) || !isset( $_SESSION[ "market_userid" ] ) || !isset( $_SESSION[ "market_server" ] ) ) {
        $sonuc = new WM_sonuc( "hata", "Giriş Yapmalısınız" );
    } else if ( $pos == 86 ) {
        $sonuc = new WM_sonuc( "hata", "Deponuz sonuna kadar dolmuştur. Lütfen nesne market deponuzu boşluk kalmayacak şekilde boşaltın." );
    } else if ( $fetch[ "fiyat" ] > muye( "coins" ) ) {
        $sonuc = new WM_sonuc( "hata", "Almaya çalıştığınız itemin fiyatı <b>" . $fetch[ "fiyat" ] . " EP </b> Sizin ise <b>" . muye( "coins" ) . " EP</b> ' iniz bulunmaktadır. " );
    } else {
        if ( $kontrol->rowCount() ) {
            if ( $fetch[ "efsun" ] == 1 ) {
                $efsunlar = array( );
                for ( $i = 1; $i <= $vt->a( "market_efsun" ); $i++ ) {
                    $efsunlar[ ] = intval( $_POST[ "efsun-" . $i ] );
                }
                if ( $fetch[ "itemtur" ] == 1 || $fetch[ "itemtur" ] == 2 ) {
                    $taslar = array( );
                    for ( $i = 1; $i <= 3; $i++ ) {
                        $taslar[ ] = intval( $_POST[ "tas-" . $i ] );
                    }
                }
                $tipler   = array( );
                $degerler = array( );
                $socket   = array( );
                for ( $i = 0; $i < $vt->a( "market_efsun" ); $i++ ) {
                    $market_efsun = $db->prepare( "SELECT efsunid,oran FROM market_efsun WHERE id = '" . $efsunlar[ $i ] . "'" );
                    $market_efsun->execute( array(
                         $efsunlar[ $i ] 
                    ) );
                    $market_efsun = $market_efsun->fetch();
                    $degerler[ ]  = $market_efsun[ "oran" ];
                    $tipler[ ]    = $market_efsun[ "efsunid" ];
                }
                if ( $fetch[ "itemtur" ] == 1 || $fetch[ "itemtur" ] == 2 ) {
                    for ( $i = 0; $i < 3; $i++ ) {
                        $market_tas = $db->prepare( "SELECT vnum FROM market_tas WHERE id = ?" );
                        $market_tas->execute( array(
                             $taslar[ $i ] 
                        ) );
                        $market_tas = $market_tas->fetch();
                        $socket[ ]  = $market_tas[ "vnum" ];
                    }
                } else {
                    $socket[ 0 ] = 0;
                    $socket[ 1 ] = 1;
                    $socket[ 2 ] = 0;
                }
                if ( $vt->a( "market_efsun" ) == 1 ) {
                    $efsunlar[ 1 ] = 0;
                    $efsunlar[ 2 ] = 0;
                    $efsunlar[ 3 ] = 0;
                    $efsunlar[ 4 ] = 0;
                    $efsunlar[ 5 ] = 0;
                    $efsunlar[ 6 ] = 0;
                    $degerler[ 1 ] = 0;
                    $degerler[ 2 ] = 0;
                    $degerler[ 3 ] = 0;
                    $degerler[ 4 ] = 0;
                    $degerler[ 5 ] = 0;
                    $degerler[ 6 ] = 0;
                    $tipler[ 1 ]   = 0;
                    $tipler[ 2 ]   = 0;
                    $tipler[ 3 ]   = 0;
                    $tipler[ 4 ]   = 0;
                    $tipler[ 5 ]   = 0;
                    $tipler[ 6 ]   = 0;
                }
                if ( $vt->a( "market_efsun" ) == 2 ) {
                    $efsunlar[ 2 ] = 0;
                    $efsunlar[ 3 ] = 0;
                    $efsunlar[ 4 ] = 0;
                    $efsunlar[ 5 ] = 0;
                    $efsunlar[ 6 ] = 0;
                    $degerler[ 2 ] = 0;
                    $degerler[ 3 ] = 0;
                    $degerler[ 4 ] = 0;
                    $degerler[ 5 ] = 0;
                    $degerler[ 6 ] = 0;
                    $tipler[ 2 ]   = 0;
                    $tipler[ 3 ]   = 0;
                    $tipler[ 4 ]   = 0;
                    $tipler[ 5 ]   = 0;
                    $tipler[ 6 ]   = 0;
                }
                if ( $vt->a( "market_efsun" ) == 3 ) {
                    $efsunlar[ 3 ] = 0;
                    $efsunlar[ 4 ] = 0;
                    $efsunlar[ 5 ] = 0;
                    $efsunlar[ 6 ] = 0;
                    $degerler[ 3 ] = 0;
                    $degerler[ 4 ] = 0;
                    $degerler[ 5 ] = 0;
                    $degerler[ 6 ] = 0;
                    $tipler[ 3 ]   = 0;
                    $tipler[ 4 ]   = 0;
                    $tipler[ 5 ]   = 0;
                    $tipler[ 6 ]   = 0;
                }
                if ( $vt->a( "market_efsun" ) == 4 ) {
                    $efsunlar[ 4 ] = 0;
                    $efsunlar[ 5 ] = 0;
                    $efsunlar[ 6 ] = 0;
                    $degerler[ 4 ] = 0;
                    $degerler[ 5 ] = 0;
                    $degerler[ 6 ] = 0;
                    $tipler[ 4 ]   = 0;
                    $tipler[ 5 ]   = 0;
                    $tipler[ 6 ]   = 0;
                }
                if ( $vt->a( "market_efsun" ) == 5 ) {
                    $efsunlar[ 5 ] = 0;
                    $efsunlar[ 6 ] = 0;
                    $degerler[ 5 ] = 0;
                    $degerler[ 6 ] = 0;
                    $tipler[ 5 ]   = 0;
                    $tipler[ 6 ]   = 0;
                }
                if ( $vt->a( "market_efsun" ) == 6 ) {
                    $efsunlar[ 6 ] = 0;
                    $degerler[ 6 ] = 0;
                    $tipler[ 6 ]   = 0;
                }
                if ( ayni_kontrol( $efsunlar, $vt->a( "market_efsun" ) ) ) {
                    $sonuc = new WM_sonuc( "hata", "İtemin efsunları tekrarlayamaz. Lütfen farklı efsunlar seçiniz" );
                } else if ( ( $fetch[ "itemtur" ] == 1 || $fetch[ "itemtur" ] == 2 ) && ( ayni_kontrol( $taslar, 3 ) ) ) {
                    $sonuc = new WM_sonuc( "hata", "İtemin taşları tekrarlayamaz. Lütfen farklı taşlar seçiniz" );
                } else if ( efsun_kontrol( $efsunlar, $vt->a( "market_efsun" ), $fetch[ "itemtur" ] ) ) {
                    $sonuc = new WM_sonuc( "hata", "Efsunlar ile ilgili Bir şeyler yanlış gitti" );
                } else if ( ( $fetch[ "itemtur" ] == 1 || $fetch[ "itemtur" ] == 2 ) && ( tas_kontrol( $taslar, 3, $fetch[ "itemtur" ] ) ) ) {
                    $sonuc = new WM_sonuc( "hata", "Taşlar ile ilgili Bir şeyler yanlış gitti" );
                } else {
                    $insert = $odb->prepare( "INSERT INTO player.item 
(owner_id,window,pos,count,vnum,attrtype0, attrvalue0, attrtype1, attrvalue1, attrtype2, attrvalue2, attrtype3, attrvalue3, attrtype4, attrvalue4, attrtype5, 
attrvalue5, attrtype6, attrvalue6, socket0, socket1, socket2) values 
(:id, :pencere, :sutun, :miktar, :item, :tip0, :value0, :tip1, :value1, :tip2, :value2, :tip3, :value3, :tip4, :value4, :tip5, :value5, :tip6, :value6, :soket0, :soket1, :soket2)" );
                    $ekle   = $insert->execute( array(
                         "id" => $_SESSION[ "market_userid" ],
                        "pencere" => 'MALL',
                        "sutun" => $pos,
                        "miktar" => $fetch[ "miktar" ],
                        "item" => $fetch[ "vnum" ],
                        "tip0" => $tipler[ 0 ],
                        "value0" => $degerler[ 0 ],
                        "tip1" => $tipler[ 1 ],
                        "value1" => $degerler[ 1 ],
                        "tip2" => $tipler[ 2 ],
                        "value2" => $degerler[ 2 ],
                        "tip3" => $tipler[ 3 ],
                        "value3" => $degerler[ 3 ],
                        "tip4" => $tipler[ 4 ],
                        "value4" => $degerler[ 4 ],
                        "tip5" => $tipler[ 5 ],
                        "value5" => $degerler[ 5 ],
                        "tip6" => $tipler[ 6 ],
                        "value6" => $degerler[ 6 ],
                        "soket0" => $socket[ 0 ],
                        "soket1" => $socket[ 1 ],
                        "soket2" => $socket[ 2 ] 
                    ) );
                    if ( $ekle ) {
                        $sonuc = new WM_sonuc( "basari", "İtem nesne market deponuza başarıyla gönderildi" );
                        ep_dusur( $fetch[ "fiyat" ] );
                        $log = array(
                             json_encode( $tipler ),
                            json_encode( $degerler ),
                            json_encode( $socket ) 
                        );
                        log_ekle( $fetch[ "isim" ], $fetch[ "fiyat" ], 2, json_encode( $log ), $fetch[ "vnum" ] );
                    } else {
                        $sonuc = new WM_sonuc( "hata", "Sistem Hatası" );
                    }
                }
            } else {
                if ( $fetch[ "sure_tur" ] == 1 ) {
                    $socket000 = 0;
                    $socket22  = 0;
                } else {
                    $sure_parcala = explode( ',', $fetch[ "sure" ] );
                    if ( $fetch[ "itemtur" ] == 9 ) {
                        $socket000 = strtotime( '+' . $sure_parcala[ 0 ] . ' days +' . $sure_parcala[ 1 ] . ' hour' );
                        $socket22  = 0;
                    } else if ( $fetch[ "itemtur" ] == 10 ) {
                        function dakka_cevir( $saat )
                        {
                            return $saat * 60;
                        }
                        $socket22  = dakka_cevir( $sure_parcala[ 1 ] );
                        $socket000 = 0;
                    } else {
                        $socket22  = 0;
                        $socket000 = 0;
                    }
                }
                $insert = $odb->prepare( "INSERT INTO player.item (owner_id, window, pos, count, vnum, socket0, socket2) values (:id, :pencere, :sutun, :miktar, :item, :socket0, :socket2)" );
                $ekle   = $insert->execute( array(
                     "id" => $_SESSION[ "market_userid" ],
                    "pencere" => 'MALL',
                    "sutun" => $pos,
                    "miktar" => $fetch[ "miktar" ],
                    "item" => $fetch[ "vnum" ],
                    "socket0" => $socket000,
                    "socket2" => $socket22 
                ) );
                if ( $ekle ) {
                    $sonuc = new WM_sonuc( "basari", "İtem nesne market deponuza başarıyla gönderildi" );
                    ep_dusur( $fetch[ "fiyat" ] );
                    log_ekle( $fetch[ "isim" ], $fetch[ "fiyat" ], 1 );
                } else {
                    $sonuc = new WM_sonuc( "hata", "Sistem Hatası" );
                }
            }
        } else {
            $sonuc = new WM_sonuc( "hata", "Böyle Bir İtem Bulunamadı" );
        }
    }
} else {
    $sonuc = new WM_sonuc( "hata", "Bu sayfaya giriş izniniz yok. !" );
}
?>