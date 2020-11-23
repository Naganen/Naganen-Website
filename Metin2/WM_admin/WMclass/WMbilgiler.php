<?php
function karakter( $tur ) {
    global $odb;
    if ( $tur == "savasci" ) {
        $karakter = $odb->prepare( "SELECT COUNT(id) AS COUNT FROM player.player WHERE (job= ? OR job= ?)" );
        $karakter->execute( array(
             0,
            4 
        ) );
    } else if ( $tur == "ninja" ) {
        $karakter = $odb->prepare( "SELECT COUNT(id) AS COUNT FROM player.player WHERE (job= ? OR job= ?)" );
        $karakter->execute( array(
             1,
            5 
        ) );
    } else if ( $tur == "sura" ) {
        $karakter = $odb->prepare( "SELECT COUNT(id) AS COUNT FROM player.player WHERE (job= ? OR job= ?)" );
        $karakter->execute( array(
             2,
            6 
        ) );
    } else if ( $tur == "saman" ) {
        $karakter = $odb->prepare( "SELECT COUNT(id) AS COUNT FROM player.player WHERE (job= ? OR job= ?)" );
        $karakter->execute( array(
             3,
            7 
        ) );
    }
    return $karakter->fetchColumn();
}
function tarih( ) {
    return date( "Y-m-d H:i:s" );
}
function hatalar( ) {
    global $db;
    $dondur = $db->prepare( "SELECT COUNT(id) AS COUNT FROM hatalar WHERE sid = ?" );
    $dondur->execute( array(
         $_SESSION[ "server" ] 
    ) );
    return $dondur->fetchColumn();
}
function destek( $tur ) {
    global $db, $WMadmin;
    if ( $tur == "bekleyen" ) {
        $destek = $db->prepare( "SELECT COUNT(id) AS COUNT FROM destek WHERE (durum= ? OR durum= ?) && sid = ?" );
        $destek->execute( array(
             0,
            2,
            $_SESSION[ "server" ] 
        ) );
    } else if ( $tur == "odeme" ) {
        $destek = $db->prepare( "SELECT COUNT(id) AS COUNT FROM destek WHERE (tur = ?) && sid = ?" );
        $destek->execute( array(
             1,
            $_SESSION[ "server" ] 
        ) );
    } else if ( $tur == "tum" ) {
        $destek = $db->prepare( "SELECT COUNT(id) AS COUNT FROM destek WHERE sid = ?" );
        $destek->execute( array(
             $_SESSION[ "server" ] 
        ) );
    } else if ( $tur == "odemeonayli" ) {
        $destek = $db->prepare( "SELECT COUNT(id) AS COUNT FROM destek WHERE sid = ? && durum = ?" );
        $destek->execute( array(
             $_SESSION[ "server" ],
            5 
        ) );
    } else if ( $tur == "departman" ) {
        $destek = $db->prepare( "SELECT COUNT(id) AS COUNT FROM destek_kategori WHERE sid = ?" );
        $destek->execute( array(
             $_SESSION[ "server" ] 
        ) );
    }
    return $destek->fetchColumn();
}
function market( $tur ) {
    global $db, $WMadmin;
    if ( $tur == "itemler" ) {
        $market = $db->prepare( "SELECT COUNT(id) AS COUNT FROM market_item WHERE sid = ?" );
        $market->execute( array(
             $_SESSION[ "server" ] 
        ) );
    } else if ( $tur == "alinan" ) {
        $market = $db->prepare( "SELECT COUNT(id) AS COUNT FROM market_log WHERE sid = ?" );
        $market->execute( array(
             $_SESSION[ "server" ] 
        ) );
    } else if ( $tur == "kategori" ) {
        $market = $db->prepare( "SELECT COUNT(id) AS COUNT FROM market_kategori WHERE sid = ?" );
        $market->execute( array(
             $_SESSION[ "server" ] 
        ) );
    } else if ( $tur == "efsunlar" ) {
        $market = $db->prepare( "SELECT COUNT(id) AS COUNT FROM market_efsun WHERE sid = ?" );
        $market->execute( array(
             $_SESSION[ "server" ] 
        ) );
    }
    return $market->fetchColumn();
}
function kullanici( $tur ) {
    global $odb;
    if ( $tur == "tum" ) {
        $kullanici = $odb->prepare( "SELECT COUNT(id) AS COUNT FROM account" );
        $kullanici->execute();
    } else if ( $tur == "ban" ) {
        $kullanici = $odb->prepare( "SELECT COUNT(id) AS COUNT FROM account WHERE (status= ? OR status= ?)" );
        $kullanici->execute( array(
             'block',
            'BLOCK' 
        ) );
    } else if ( $tur == "bangelmis" ) {
        $kullanici = $odb->prepare( "SELECT COUNT(id) AS COUNT FROM account WHERE ban_sure != ?  && status = ? AND ban_sure < DATE_SUB(NOW(), INTERVAL ? SECOND)" );
        $kullanici->execute( array(
             1,
            'BLOCK',
            0 
        ) );
    } else if ( $tur == "lonca" ) {
        $kullanici = $odb->prepare( "SELECT COUNT(id) AS COUNT FROM player.guild" );
        $kullanici->execute();
    }
    return $kullanici->fetchColumn();
}
function destek_durum( $tur ) {
    if ( $tur == 0 ) {
        return "<label class='label label-success'> Açık</label>";
    } else if ( $tur == 1 ) {
        return "<label class='label label-warning'> Yanıtlandı</label>";
    } else if ( $tur == 2 ) {
        return "<label class='label label-primary'> Oyuncu Yanıtı</label>";
    } else if ( $tur == 3 ) {
        return "<label class='label label-info'> Sonuçlandı</label>";
    } else if ( $tur == 4 ) {
        return "<label class='label label-danger'> Kapandı</label>";
    } else if ( $tur == 5 ) {
        return "<label class='label label-success'> Ödeme Onaylandı</label>";
    } else if ( $tur == 6 ) {
        return "<label class='label label-danger'> Ödeme Onaylanmadı</label>";
    }
}
function WM_zaman_cevir( $zaman ) {
    $zaman       = strtotime( $zaman );
    $zaman_farki = time() - $zaman;
    $saniye      = $zaman_farki;
    $dakika      = round( $zaman_farki / 60 );
    $saat        = round( $zaman_farki / 3600 );
    $gun         = round( $zaman_farki / 86400 );
    if ( $saniye < 60 ) {
        if ( $saniye == 0 ) {
            return "az önce";
        } else {
            return $saniye . ' saniye önce';
        }
    } else if ( $dakika < 60 ) {
        return $dakika . ' dakika önce';
    } else if ( $saat < 24 ) {
        return $saat . ' saat önce';
    } else if ( $gun >= 1 ) {
        return $gun . ' gün önce';
    }
}
function WM_zaman_cevir2( $zaman ) {
    $zaman       = strtotime( $zaman );
    $zaman_farki = $zaman - time();
    $saniye      = $zaman_farki;
    $dakika      = round( $zaman_farki / 60 );
    $saat        = round( $zaman_farki / 3600 );
    $gun         = round( $zaman_farki / 86400 );
    if ( $saniye < 60 ) {
        if ( $saniye == 0 ) {
            return "az sonra";
        } else {
            if ( $saniye < 0 ) {
                return 'Zaman Doldu';
            } else {
                return $saniye . ' saniye sonra';
            }
        }
    } else if ( $dakika < 60 ) {
        return $dakika . ' dakika sonra';
    } else if ( $saat < 24 ) {
        return $saat . ' saat sonra';
    } else if ( $gun >= 1 ) {
        return $gun . ' gün sonra';
    }
}
?>