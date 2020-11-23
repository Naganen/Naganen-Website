<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
$id  = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
if ( $fid == 1 || $fid == 2 ) {
    $sifre = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sifre" ] ) ) );
    if ( !$sifre ) {
        $WMform->hata( "Şifreyi boş bırakamazsınız" );
    } else {
        $update = $odb->prepare( "UPDATE account SET password = PASSWORD(?) WHERE id = ?" );
        $update->execute( array(
             $sifre,
            $id 
        ) );
        if ( $update ) {
            $WMadmin->log_gonder( $WMadmin->kullanici( $id, "login" ) . " adlı kullanıcının şifresi değiştirildi" );
            $WMform->basari( "Kullanıcının şifresi başarıyla değiştirildi" );
        } else {
            $WMform->hata();
        }
        if ( $fid == 2 ) {
			$mail_icerik = array('admin_kullanici_sifre', $WMadmin->kullanici( $id, "login" ), $sifre);
            $WMadmin->log_gonder( $WMadmin->kullanici( $id, "login" ) . " adlı kullanıcının şifresi değiştirildi" );
            $gonder = $WMadmin->mail_gonder( $WMadmin->kullanici( $id, "email" ), "Şifreniz Değiştirildi", $mail_icerik );
            if ( !$gonder ) {
                $WMform->hata( "Mail gönderilirken bir hata meydana geldi" );
            }
        }
    }
} else if ( $fid == 3 || $fid == 4 ) {
    $sifre  = substr( str_shuffle( "abcdefghjklmno1234567890aqwert" ), 0, 9 );
    $update = $odb->prepare( "UPDATE account SET password = PASSWORD(?) WHERE id = ?" );
    $update->execute( array(
         $sifre,
        $id 
    ) );
    if ( $update ) {
        $WMadmin->log_gonder( $WMadmin->kullanici( $id, "login" ) . " adlı kullanıcının şifresi değiştirildi" );
        $WMform->basari( "Kullanıcının şifresi <b>" . $sifre . '</b> olarak değiştirildi' );
    } else {
        $WMform->hata();
    }
    if ( $fid == 4 ) {
		$mail_icerik = array('admin_kullanici_sifre', $WMadmin->kullanici( $id, "login" ), $sifre);
        $WMadmin->log_gonder( $WMadmin->kullanici( $id, "login" ) . " adlı kullanıcının şifresi değiştirildi" );
        $gonder = $WMadmin->mail_gonder( $WMadmin->uye( 2, "1" . $id, "email" ), "Şifreniz Değiştirildi", $mail_icerik );
        if ( !$gonder ) {
            $WMform->hata( "Mail gönderilirken bir hata meydana geldi" );
        }
    }
} else if ( $fid == 9 ) {
    $kullanici = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kullanici" ] ) ) );
    $login     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "pid" ] ) ) );
    $kontrol   = $odb->prepare( "SELECT id FROM account WHERE login = ?" );
    $kontrol->execute( array(
         $kullanici 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMform->hata( $kullanici . " adında bir kullanıcı zaten var" );
    } else {
        $update   = $odb->prepare( "UPDATE account SET login = ? WHERE login = ?" );
        $guncelle = $update->execute( array(
             $kullanici,
            $login 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Kullanıcının adı başarıyla " . $kullanici . " olarak değiştirildi" );
            $WMadmin->log_gonder( $login . " adlı kullanıcının ismi " . $kullanici . " olarak değiştirildi" );
            echo '<meta http-equiv="refresh" content="5;URL=index.php?sayfa=kullanicilar&login=' . $kullanici . '">';
        } else {
            $WMform->hata();
        }
    }
}
?>