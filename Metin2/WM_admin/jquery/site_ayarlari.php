<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $kontrol = count( $_POST[ "kayit" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET kayit = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "kayit" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Kayıt işlemleri başarıyla güncellendi" );
            $WMadmin->log_gonder( "Kayıt işlemleri güncellendi ( Site Ayarları )" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 2 ) {
    $kontrol = count( $_POST[ "guvenlik" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET guvenlik = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "guvenlik" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Güvenlik Sorusu işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Güvenlik Sorusu işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 3 ) {
    $kontrol = count( $_POST[ "kayit_onay" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET kayit_onay = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "kayit_onay" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Kayıt Onay işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Kayıt Onay işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 4 ) {
    $kontrol = count( $_POST[ "kayit_hosgeldin" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET kayit_hosgeldin = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "kayit_hosgeldin" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Kayıt Hoşgeldin işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Kayıt Hoşgeldin işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 5 ) {
    $kontrol = count( $_POST[ "mail_kac" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET mail_kac = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "mail_kac" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Mail Sınır işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Mail Sınır işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 6 ) {
    $kontrol = count( $_POST[ "online_liste" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET online_liste = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "online_liste" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Online Sıralama işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Online Sıralama işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
} else if ( $fid == 7 ) {
    $kontrol = count( $_POST[ "zenginler" ] );
    if ( $kontrol > 1 ) {
        $WMform->hata( "1 den fazla kutucuk işaretliyemezsiniz" );
    } else if ( $kontrol == 0 ) {
        $WMform->hata( "Kutucukları boş bırakamazsınız" );
    } else if ( $kontrol == 1 ) {
        $update   = $db->prepare( "UPDATE server SET zenginler = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $_POST[ "zenginler" ][ 0 ],
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( "Zenginler Sıralama işlemleri  güncellendi ( Site Ayarları )" );
            $WMform->basari( "Zenginler Sıralama işlemleri başarıyla güncellendi" );
        } else {
            $WMform->hata( "Sistem hatası" );
        }
    } else {
        $WMform->hata( "Sistem hatası" );
    }
}
?>