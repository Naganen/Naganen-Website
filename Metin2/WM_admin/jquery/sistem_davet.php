<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $davet_level  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "davet_level" ] ) ) );
    $kac_karakter = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "kac_karakter" ] ) ) );
    $kac_ep       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "kac_ep" ] ) ) );
    if ( !$davet_level || !$kac_karakter || !$kac_ep ) {
        $WMform->hata( "Boş Alan bırakamazsınız" );
    } else {
        $update   = $db->prepare( "UPDATE server SET davet_level = ?, davet_ep = ? WHERE id = ? " );
        $guncelle = $update->execute( array(
             $davet_level,
            $kac_karakter . ',' . $kac_ep,
            $_SESSION[ "server" ] 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Sistem ayarları başarıyla kaydedildi" );
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 2 ) {
    $sorgulancak = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sorgulancak" ] ) ) );
    $sorgula     = substr( $sorgulancak, 1 );
    $tur         = substr( $sorgulancak, 0, 1 );
    if ( !$sorgulancak ) {
        $WMform->hata( "Sorgulancak isim boş bırakılamaz" );
    } else if ( $tur != 1 && $tur != 2 ) {
        $WMform->hata( "Sorgulancak isimin başına 1 veya 2 gelmelidir" );
    } else {
        if ( $tur == 1 ) {
            $turr     = "Kullanıcı";
            $sorgulaa = $odb->prepare( "SELECT login FROM account WHERE login = ?" );
            $sorgulaa->execute( array(
                 $sorgula 
            ) );
        } else if ( $tur == 2 ) {
            $turr     = "Karakter";
            $sorgulaa = $odb->prepare( "SELECT name FROM player.player WHERE name = ?" );
            $sorgulaa->execute( array(
                 $sorgula 
            ) );
        }
        if ( $sorgulaa->rowCount() ) {
            $WMadmin->yonlendir( 'index.php?sayfa=sistemler&ayar=davet&tur=' . $tur . '&isim=' . $sorgula . '' );
        } else {
            $WMform->hata( '<b>' . $sorgula . '</b> adında bir ' . $turr . ' bulunamadı' );
        }
    }
} else {
    $WMform->hata();
}
?>