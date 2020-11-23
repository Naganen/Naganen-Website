<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid != 1 ) {
    $pid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
}
if ( $fid == 1 ) {
    $kategori = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "isim" ] ) ) );
    $value    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "value" ] ) ) );
    $kontrol  = $db->prepare( "SELECT id FROM destek_kategori WHERE sid = ? && isim = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $kategori 
    ) );
    if ( !$kategori ) {
        $WMform->hata( "Kategori  İsmini Boş Bırakamazsınız" );
    } else if ( $kontrol->rowCount() ) {
        $WMform->hata( "Böyle bir kategori zaten var" );
    } else {
        $insert = $db->prepare( "INSERT INTO destek_kategori SET  sid = ?, isim = ?, value = ?, yetkililer = ?" );
        $ekle   = $insert->execute( array(
             $_SESSION[ "server" ],
            $kategori,
            $value,
            '[]' 
        ) );
        if ( $ekle ) {
            $WMadmin->log_gonder( $kategori . " Adlı Destek Kategorisi eklendi" );
            $WMform->basari( "Kategori başarıyla eklendi" );
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 2 ) {
    $kontrol = $db->prepare( "SELECT id,isim FROM destek_kategori WHERE sid = ? && id = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $pid 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "isim" ] . " Adlı Destek kategorisi silindi" );
        $kategori_sil = $db->prepare( "DELETE FROM destek_kategori WHERE sid = ? && id = ? " );
        $kategori_sil->execute( array(
             $_SESSION[ "server" ],
            $pid 
        ) );
        if ( $kategori_sil ) {
            $select_destek = $db->prepare( "SELECT id FROM destek WHERE sid = ?' && kid = ?" );
            $select_destek->execute( array(
                 $_SESSION[ "server" ],
                $pid 
            ) );
            foreach ( $select_destek as $sil_destek ) {
                $sil = $db->prepare( "DELETE FROM destek_cevap WHERE sid = ? && tid = ? " );
                $sil->execute( array(
                     $_SESSION[ "server" ],
                    $sil_destek[ "id" ] 
                ) );
            }
            $silll = $db->prepare( "DELETE FROM destek WHERE sid = ? && kid = ? " );
            $silll->execute( array(
                 $_SESSION[ "server" ],
                $pid 
            ) );
            $WMform->jquery_sil( 'tr#destek_kategori-' . $pid . '' );
            $WMform->basari( "Kategori Başarıyla Silindi" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Silincek Kategori Bulunamadı" );
    }
} else if ( $fid == 3 ) {
    $kategori = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "isim" ] ) ) );
    $value    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "value" ] ) ) );
    $kontrol  = $db->prepare( "SELECT sira FROM destek_kategori WHERE id != ? && sid = ? && isim = ? " );
    $kontrol->execute( array(
         $pid,
        $_SESSION[ "server" ],
        $kategori 
    ) );
    if ( !$kategori ) {
        $WMform->hata( "Kategori ismi ve sırası boş bırakılamaz" );
    } else if ( $kontrol->rowCount() ) {
        $WMform->hata( "Böyle bir kategori zaten var" );
    } else {
        $bak = $db->prepare( "SELECT isim FROM destek_kategori WHERE id = '$pid' && sid = '" . $_SESSION[ "server" ] . "'" );
        $bak->execute( array(
             $pid,
            $_SESSION[ "server" ] 
        ) );
        $bak = $bak->fetch();
        $WMadmin->log_gonder( $bak[ "isim" ] . " Adlı Destek kategorisi düzenlendi" );
        $update   = $db->prepare( "UPDATE destek_kategori SET isim = ?, value = ? WHERE sid = ? && id = ?" );
        $guncelle = $update->execute( array(
             $kategori,
            $value,
            $_SESSION[ "server" ],
            $pid 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Kategori başarıyla güncellendi" );
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 4 ) {
    $bak = $db->prepare( "SELECT isim,yetkililer FROM destek_kategori WHERE id = ? && sid = ?" );
    $bak->execute( array(
         $pid,
        $_SESSION[ "server" ] 
    ) );
    $bak = $bak->fetch();
    @$yetkili = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "yetkili" ] ) ) );
    $array = json_decode( $bak[ "yetkililer" ] );
    if ( in_array( $yetkili, $array ) ) {
        $WMform->hata( "Böyle bir yetkili zaten var" );
    } else if ( !$yetkili ) {
        $WMform->uyari( "Eklencek yetkili boş bırakılamaz" );
    } else {
        if ( !$bak[ "yetkililer" ] || count( $array ) == 0 ) {
            $array = array(
                 $yetkili 
            );
        } else {
            array_push( $array, $yetkili );
        }
        $update   = $db->prepare( "UPDATE destek_kategori SET yetkililer = ? WHERE id = ? && sid = ?" );
        $guncelle = $update->execute( array(
             json_encode( $array ),
            $pid,
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $gm_isim = $WMadmin->admin( "gm", $yetkili );
            $WMform->basari( $gm_isim . " adlı gm kategoriye atandı" );
            $WMadmin->log_gonder( $gm_isim . " adlı gm " . $bak[ "isim" ] . " adlı kategoriye atandı" );
            echo '<meta http-equiv="refresh" content="2;URL=#">';
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 5 ) {
    $bak = $db->prepare( "SELECT isim,yetkililer FROM destek_kategori WHERE id = ? && sid = ?" );
    $bak->execute( array(
         $pid,
        $_SESSION[ "server" ] 
    ) );
    $bak->fetch( PDO::FETCH_ASSOC );
    $yetkili_array = json_decode( $bak[ "yetkililer" ] );
    $kac_secildi   = count( $_POST[ "yetkili_sec" ] );
    for ( $j = 0; $j < $kac_secildi; $j++ ) {
        unset( $yetkili_array[ $_POST[ "yetkili_sec" ][ $j ] ] );
    }
    $yeni_array = json_encode( $yetkili_array );
    $update     = $db->prepare( "UPDATE destek_kategori SET yetkililer = ? WHERE id = ? && sid = ?" );
    $guncelle   = $update->execute( array(
         $yeni_array,
        $pid,
        $_SESSION[ "server" ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Yetkililer silindi" );
        $WMadmin->log_gonder( $bak[ "isim" ] . " adlı kategorinin yetkilileri ayarlandı" );
        echo '<meta http-equiv="refresh" content="2;URL=#">';
    } else {
        $WMform->hata();
    }
}
?>