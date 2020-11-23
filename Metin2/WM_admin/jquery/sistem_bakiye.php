<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 || $fid == 2 ) {
    $miktar      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "bakiye" ] ) ) );
    $gonderilcek = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "gonderilcek" ] ) ) );
    if ( $fid == 1 ) {
        $islem = "+";
    } else if ( $fid == 2 ) {
        $islem = "-";
    }
    $tur = substr( $gonderilcek, 0, 1 );
    if ( !$miktar || !$gonderilcek ) {
        $WMform->hata( "Gönderilcek kullanıcı ve bakiye boş bırakılamaz" );
    } else if ( $tur != 1 && $tur != 2 ) {
        $WMform->hata( "Başına 1 veya 2 yazmalısınız" );
    } else {
        $isim = substr( $gonderilcek, 1 );
        if ( $tur == 1 ) {
            $bilgi2  = "Kullanıcı";
            $bb      = "kullanıcıya";
            $kontrol = $odb->prepare( "SELECT id FROM account WHERE login = ?" );
            $kontrol->execute( array(
                 $isim 
            ) );
            $kullanici_fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
            $kullanici_id    = $kullanici_fetch[ "id" ];
        } else if ( $tur == 2 ) {
            $bilgi2  = "Karakter";
            $bb      = "karaktere";
            $kontrol = $odb->prepare( "SELECT id FROM account WHERE login = ?" );
            $kontrol->execute( array(
                 $isim 
            ) );
            $kullanici_fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
            $kullanici_id    = $karakter_fetch[ "id" ];
        }
        if ( $kontrol->rowCount() ) {
            if ( $fid == 1 ) {
                $basari = '<b>' . $isim . '</b> adlı kullanıcıya başarıyla <b>' . $miktar . '</b> bakiye yüklendi';
            } else if ( $fid == 2 ) {
                $basari = '<b>' . $isim . '</b> adlı kullanıcıdan başarıyla <b>' . $miktar . '</b> bakiye alındı';
            }
            $guncelle = $odb->prepare( "UPDATE account SET bakiye = bakiye $islem ? WHERE id = ?" );
            $guncelle->execute( array(
                 $miktar,
                $kullanici_id 
            ) );
            if ( $guncelle ) {
                if ( $islem == "+" ) {
                    $dd = "yüklendi";
                } else {
                    $dd = "azaltıldı";
                }
                $WMadmin->log_gonder( $isim . " adlı " . $bb . " " . $miktar . " TL bakiye " . $dd );
                $WMform->basari( $basari );
            } else {
                $WMform->hata();
            }
        } else {
            $WMform->uyari( '<b>' . $isim . '</b> adlı bir ' . $bilgi2 . ' bulunamadı' );
        }
    }
} else if ( $fid == 3 ) {
    $sorgula     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sorgulancak" ] ) ) );
    $sorgulancak = substr( $sorgula, 1 );
    $tur         = substr( $sorgula, 0, 1 );
    if ( $tur != 1 && $tur != 2 ) {
        $WMform->hata( "Başına 1 veya 2 yazmalısınız" );
    } else if ( !$sorgulancak ) {
        $WMform->hata( "Sorgulancak Kişiyi Boş Bırakamazsınız." );
    } else {
        if ( $tur == 1 ) {
            $delay   = 4000;
            $turr    = "Kullanıcı";
            $sorgula = $odb->prepare( "SELECT id,bakiye FROM account WHERE login = ?" );
            $sorgula->execute( array(
                 $sorgulancak 
            ) );
            $kulfetch = $sorgula->fetch( PDO::FETCH_ASSOC );
            $kulid    = $kulfetch[ "id" ];
            $basari   = '<b>' . $sorgulancak . '</b> adlı kullanıcının bakiyesi : <b>' . $kulfetch[ "bakiye" ] . '</b>';
        } else if ( $tur == 2 ) {
            $delay   = 10000;
            $turr    = "Karakter";
            $sorgula = $odb->prepare( "SELECT player.account_id, account.login, account.bakiye FROM player.player LEFT JOIN account.account ON account.id = player.account_id WHERE player.name = ?" );
            $sorgula->execute( array(
                 $sorgulancak 
            ) );
            $karfetch = $sorgula->fetch( PDO::FETCH_ASSOC );
            $kulid    = $karfetch[ "account_id" ];
            $basari   = '<b>' . $sorgulancak . '</b> adlı karakterin sahibi <b>' . $karfetch[ "login" ] . '</b> Bakiyesi <b>' . $karfetch[ "bakiye" ] . '</b>';
        }
        if ( $sorgula->rowCount() ) {
            $WMform->basari( $basari, $delay );
        } else {
            $WMform->uyari( $sorgulancak . ' adında bir ' . $turr . ' bulunamadı' );
        }
    }
} else {
    $WMform->hata();
}
?>