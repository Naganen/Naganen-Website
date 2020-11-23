<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 || $fid == 2 ) {
    $username   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "username" ] ) ) );
    $gm         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "gm" ] ) ) );
    $pass       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
    $pass_retry = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_retry" ] ) ) );
    @$yetkiler = $_POST[ "yetkiler" ];
    @$server_yetki = $_POST[ "server_yetki" ];
    if ( !$username || ( !$pass && $fid == 1 ) || !$gm ) {
        $WMform->hata( "Kullanıcı adını şifreyi ve gm ismini boş bırakamazsınız" );
    } else if ( $pass != $pass_retry && $fid == 1 ) {
        $WMform->hata( "Şifreler Uyumlu Değil" );
    } else if ( count( $yetkiler ) == 0 || count( $server_yetki ) == 0 ) {
        $WMform->hata( "Yetkileri veya server yetkilerini boş bırakamazsınız" );
    } else {
        if ( $fid == 1 ) {
            $kontrol = $db->prepare( "SELECT id FROM users WHERE username = ?" );
            $kontrol->execute( array(
                 $username 
            ) );
            $kontrol_gm = $db->prepare( "SELECT id FROM users WHERE gm = ?" );
            $kontrol_gm->execute( array( $gm ) );
            if ( $kontrol->rowCount() ) {
                $WMform->hata( "Böyle bir kullanıcı zaten var" );
            } else if ( $kontrol_gm->rowCount() ) {
                $WMform->hata( $gm . " adında bir gm zaten var" );
            } else {
                $insert = $db->prepare( "INSERT INTO users SET username = ?, password = ?, server = ?, tur = ?, yetki = ?, server_yetki = ?, gm = ?" );
                $ekle   = $insert->execute( array(
                     $username,
                    md5( $pass ),
                    $server_yetki[ 0 ],
                    1,
                    json_encode( $yetkiler ),
                    json_encode( $server_yetki ),
                    $gm 
                ) );
                if ( $ekle ) {
                    $WMform->basari( "Kullanıcı Başarıyla Eklendi" );
                } else {
                    $WMform->hata();
                }
            }
        } else if ( $fid == 2 ) {
            $id      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
            $kontrol = $db->prepare( "SELECT id FROM users WHERE id != ? && username = ?" );
            $kontrol->execute( array(
                 $id,
                $username 
            ) );
            $kontrol_gm = $db->prepare( "SELECT id FROM users WHERE id != ? && gm = ?" );
            $kontrol_gm->execute( array(
                 $id,
                $gm 
            ) );
            if ( $kontrol->rowCount() ) {
                $WMform->hata( "Böyle bir kullanıcı zaten var" );
            } else if ( $kontrol_gm->rowCount() ) {
                $WMform->hata( $gm . " adında bir gm olduğu için güncellenemiyor" );
            } else {
                $update   = $db->prepare( "UPDATE users SET username = ?, server = ?, yetki = ?, server_yetki = ?, gm = ? WHERE id = ?" );
                $guncelle = $update->execute( array(
                     $username,
                    $server_yetki[ 0 ],
                    json_encode( $yetkiler ),
                    json_encode( $server_yetki ),
                    $gm,
                    $id 
                ) );
                if ( $guncelle ) {
                    $WMform->basari( "Kullanıcı Başarıyla Güncellendi" );
                } else {
                    $WMform->hata();
                }
            }
        }
    }
} else if ( $fid == 3 ) {
    $id      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
    $kontrol = $db->prepare( "SELECT id FROM users WHERE id = ?" );
    $kontrol->execute( array(
         $id 
    ) );
    if ( $kontrol->rowCount() ) {
        $sil = $db->prepare( "DELETE FROM users WHERE id = ?" );
        $sil->execute( array(
             $id 
        ) );
        if ( $sil ) {
            $WMform->jquery_sil( "tr#kullanicilar-$id" );
            $WMform->basari( "Kullanıcı Başarıyla Silindi" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Kullanıcı Bulunamadı" );
    }
} else if ( $fid == 4 ) {
    $id         = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
    $pass       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
    $pass_retry = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass_retry" ] ) ) );
    if ( !$pass ) {
        $WMform->hata( "Şifre boş bırakılamaz" );
    } else if ( $pass != $pass_retry ) {
        $WMform->hata( "Şifreler uyumlu değil" );
    } else {
        $update   = $db->prepare( "UPDATE users SET password = ? WHERE id = ? " );
        $guncelle = $update->execute( array(
             md5( $pass ),
            $id 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Şifresi başarıyla değiştirildi" );
        } else {
            $WMform->hata();
        }
    }
}
?>