<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 9 ) {
    $kontrol = count( $_POST[ "davet_durum" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET davet_durum = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "davet_durum" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Davet Ayarları Güncellendi" );
            $WMform->basari( "Sistem ayarı güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 10 ) {
    $kontrol = count( $_POST[ "kullanici_unuttum" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET kullanici_unuttum = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "kullanici_unuttum" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Kullanıcı Adımı Unuttum  işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Kullanıcı Adımı Unuttum işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 11 ) {
    $kontrol = count( $_POST[ "breadcumb" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET breadcumb = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "breadcumb" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Breadcumb  işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Breadcumb işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 12 ) {
    $kontrol = count( $_POST[ "sifre_unuttum" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET sifre_unuttum = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "sifre_unuttum" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Şifremi Unuttum  işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Şifremi Unuttum işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 13 ) {
    $kontrol = count( $_POST[ "hesap_sifre" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET hesap_sifre = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "hesap_sifre" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Şifre Değiştirme işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Şifre Değiştirme işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 14 ) {
    $kontrol = count( $_POST[ "depo_sifre" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET depo_sifre = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "depo_sifre" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Depo Şifre Değiştirme işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Depo Şifre Değiştirme işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 15 ) {
    $kontrol = count( $_POST[ "karakter_silme_sifre" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET karakter_silme_sifre = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "karakter_silme_sifre" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Karakter Silme Şifre Değiştirme işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Karakter Silme Şifre Değiştirme işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
}
?>