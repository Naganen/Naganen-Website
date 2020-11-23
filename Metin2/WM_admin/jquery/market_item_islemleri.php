<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
function resim( $vnum, $tur )
{
    global $WMadmin;
    if ( strlen( $vnum ) == 1 ) {
        $bilgi  = "0000" . $vnum;
        $bilgi2 = substr( $bilgi, 0, -1 ) . "0";
    } else if ( strlen( $vnum ) == 2 ) {
        $bilgi  = "000" . $vnum;
        $bilgi2 = substr( $bilgi, 0, -1 ) . "0";
    } else if ( strlen( $vnum ) == 3 ) {
        $bilgi  = "00" . $vnum;
        $bilgi2 = substr( $bilgi, 0, -1 ) . "0";
    } else if ( strlen( $vnum ) == 4 ) {
        $bilgi  = "0" . $vnum;
        $bilgi2 = substr( $bilgi, 0, -1 ) . "0";
    } else if ( strlen( $vnum ) == 5 ) {
        $bilgi  = $vnum;
        $bilgi2 = substr( $bilgi, 0, -1 ) . "0";
    }
    if ( $tur == 1 || $tur == 2 ) {
        return $WMadmin->ayarlar( "base" ) . 'WM_global/img/item/' . $bilgi2 . '.png';
    } else {
        return $WMadmin->ayarlar( "base" ) . 'WM_global/img/item/' . $bilgi . '.png';
    }
}
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 || $fid == 2 ) {
    $isim     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "isim" ] ) ) );
    $vnum     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "vnum" ] ) ) );
    $aciklama = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "aciklama" ] ) ) );
    $resim    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "resim" ] ) ) );
    $fiyat    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "fiyat" ] ) ) );
    @$gun = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "gun" ] ) ) );
    @$saat = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "saat" ] ) ) );
    $miktar   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "miktar" ] ) ) );
    $kategori = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kategori" ] ) ) );
    @$efsun = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "efsun" ][ 0 ] ) ) );
    @$indirim = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "indirim" ][ 0 ] ) ) );
    $eskifiyat   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "eskifiyat" ] ) ) );
    $select_item = $odb->prepare( "SELECT vnum,type FROM player.item_proto WHERE vnum = ?" );
    $select_item->execute( array(
         $vnum 
    ) );
    $itemtur = $_POST[ "itemtur" ];
    if ( !$isim || !$vnum || !$miktar || !$kategori || count( $itemtur ) == 0 ) {
        $WMform->hata( "* ile işaretlenmiş yerleri boş bırakamazsınız" );
    } else if ( $indirim == 15 && !$eskifiyat ) {
        $WMform->hata( "Ürünü indirimli olarak seçtiğiniz için eski fiyatıda girmeniz gereklidir" );
    } else if ( count( $itemtur ) != 1 ) {
        $WMform->hata( "İtemin sadece 1 türü olabilir" );
    } else if ( $select_item->rowCount() == 0 ) {
        $WMform->hata( "Böyle bir item bulunamadı" );
    } else if ( ( isset( $_POST[ "sureli" ] ) ) && ( $efsun == 1 || $itemtur[ 0 ] != 9 && $itemtur[ 0 ] != 10 ) ) {
        $WMform->hata( "Süreli seçildiği için İtem efsunsuz ve türü diğer veya tecrübe yüzüğü olmalıdır " );
    } else if ( $itemtur[ 0 ] == 10 && !isset( $_POST[ "sureli" ] ) ) {
        $WMform->hata( "Tecrübe yüzüğü süresiz olamaz" );
    } else if ( ( $itemtur[ 0 ] == 10 ) && ( !$saat ) ) {
        $WMform->hata( "Tecrübe yüzüğünü girerken saati boş bırakamazsınız" );
    } else if ( ( $itemtur[ 0 ] == 10 ) && ( $gun != 0 || $gun < 0 || $gun > 0 ) ) {
        $WMform->hata( "Tecrübe yüzüğü seçtiğiniz için günü boş bırakmanız lazım." );
    } else {
        if ( $fid == 1 ) {
            $kontrol = $db->prepare( "SELECT id FROM market_kategori WHERE sid = ? && id = ?" );
            $kontrol->execute( array(
                 $_SESSION[ "server" ],
                $kategori 
            ) );
            if ( $kontrol->rowCount() ) {
                $insert = $db->prepare( "INSERT INTO market_item SET sid = ?, kid = ?, vnum = ?, resim = ?, isim = ?, aciklama = ?, durum = ?, miktar = ?, fiyat = ?, eskifiyat = ?, efsun = ?, itemtur = ?, sure_tur = ?, sure = ?" );
                if ( $indirim == 15 ) {
                    $durum = 2;
                } else {
                    $durum = 1;
                }
                if ( isset( $_POST[ "sureli" ] ) ) {
                    $sure_tur = 2;
                } else {
                    $sure_tur = 1;
                }
                $itemf = $select_item->fetch( PDO::FETCH_ASSOC );
                if ( isset( $_POST[ "resimtur" ] ) ) {
                    $resimlink = resim( $vnum, $itemf[ "type" ] );
                } else {
                    $resimlink = $resim;
                }
                $suremiz = $gun . ',' . $saat;
                $ekle    = $insert->execute( array(
                     $_SESSION[ "server" ],
                    $kategori,
                    $vnum,
                    $resimlink,
                    $isim,
                    $aciklama,
                    $durum,
                    $miktar,
                    $fiyat,
                    $eskifiyat,
                    $efsun,
                    $itemtur[ 0 ],
                    $sure_tur,
                    $suremiz 
                ) );
                if ( $ekle ) {
                    $WMadmin->log_gonder( $isim . " Adlı Market itemi eklendi" );
                    $WMform->basari( "Market itemi başarıyla eklendi" );
                } else {
                    $WMform->hata();
                }
            } else {
                $WMform->hata( "Kategori bulunamadı" );
            }
        } else if ( $fid == 2 ) {
            $kontrol = $db->prepare( "SELECT id FROM market_kategori WHERE sid = ? && id = ?" );
            $kontrol->execute( array(
                 $_SESSION[ "server" ],
                $kategori 
            ) );
            if ( $kontrol->rowCount() ) {
                $itemf = $select_item->fetch( PDO::FETCH_ASSOC );
                $id    = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
                $bak   = $db->prepare( "SELECT isim FROM market_item WHERE id = ? && sid = ?" );
                $bak->execute( array(
                     $id,
                    $_SESSION[ "server" ] 
                ) );
                $bak = $bak->fetch();
                $WMadmin->log_gonder( $bak[ "isim" ] . " Adlı Market itemi düzenlendi" );
                $update = $db->prepare( "UPDATE market_item SET kid = ?, vnum = ?, resim = ?, isim = ?, aciklama = ?, durum = ?, miktar = ?, fiyat = ?, eskifiyat = ?, efsun = ?, itemtur = ?, sure_tur = ?, sure = ? WHERE sid = ? && id = ?" );
                if ( $indirim == 15 ) {
                    $durum = 2;
                } else {
                    $durum = 1;
                }
                if ( isset( $_POST[ "sureli" ] ) ) {
                    $sure_tur = 2;
                } else {
                    $sure_tur = 1;
                }
                if ( isset( $_POST[ "resimtur" ] ) ) {
                    $resimlink = resim( $vnum, $itemf[ "type" ] );
                } else {
                    $resimlink = $resim;
                }
                $suremiz  = $gun . ',' . $saat;
                $guncelle = $update->execute( array(
                     $kategori,
                    $vnum,
                    $resimlink,
                    $isim,
                    $aciklama,
                    $durum,
                    $miktar,
                    $fiyat,
                    $eskifiyat,
                    $efsun,
                    $itemtur[ 0 ],
                    $sure_tur,
                    $suremiz,
                    $_SESSION[ "server" ],
                    $id 
                ) );
                if ( $guncelle ) {
                    $WMform->basari( "Market itemi başarıyla güncellendi" );
                } else {
                    $WMform->hata();
                }
            } else {
                $WMform->hata( "Kategori bulunamadı" );
            }
        }
    }
} else if ( $fid == 3 ) {
    $id      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
    $kontrol = $db->prepare( "SELECT id,isim FROM market_item WHERE id = ? && sid = ?" );
    $kontrol->execute( array(
         $id,
        $_SESSION[ "server" ] 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "isim" ] . " Adlı Market itemi silindi" );
        $sil = $db->prepare( "DELETE FROM market_item WHERE id = ? && sid = ?" );
        $sil->execute( array(
             $id,
            $_SESSION[ "server" ] 
        ) );
        if ( $sil ) {
            $WMform->jquery_sil( "tr#market_item-$id" );
            $WMform->basari( "Market itemi başarıyla silindi" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Market itemi bulunamadı" );
    }
}
?>