<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 31 ) {
    $kontrol = count( $_POST[ "mail_degis" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET mail_degistir = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "mail_degis" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMform->basari( " Mail Değiştirme başarıyla güncellendi" );
            $WMadmin->log_gonder( "Karakter Mail Değiştirme Güncellendi ( Site Ayarları )" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 32 ) {
    $kontrol = count( $_POST[ "kullanici_degis" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET kullanici_degis = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "kullanici_degis" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Kullanıcı Değiştirme işlemleri başarıyla güncellendi" );
            $WMadmin->log_gonder( "Kullanıcı Değiştirme Güncellendi ( Site Ayarları )" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 33 ) {
    $tur    = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tur" ] ) ) );
    $update = $db->prepare( "UPDATE server SET destek_mail = ? WHERE id = ?" );
    if ( $tur == 1 || $tur == 2 ) {
        if ( $tur == 1 ) {
            $WMadmin->log_gonder( "Destek mail gönderme açıldı" );
            $guncelle = $update->execute( array(
                 1,
                $_SESSION[ "server" ] 
            ) );
        } else if ( $tur == 2 ) {
            $WMadmin->log_gonder( "Destek mail gönderme kapandı" );
            $guncelle = $update->execute( array(
                 2,
                $_SESSION[ "server" ] 
            ) );
        }
        if ( $guncelle ) {
            $WMform->basari( "Destek mail ayarı başarıyla güncellendi" );
            echo '<meta http-equiv="refresh" content="3;URL=#">';
        } else {
            $WMform->hata();
        }
    }
} else {
    $WMform->hata( "Sistem hatası" );
}
?>