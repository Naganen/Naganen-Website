<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 || $fid == 2 ) {
    $isim    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "isim" ] ) ) );
    $oran    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "oran" ] ) ) );
    $efsunid = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsunid" ] ) ) );
    @$efsuntur = $_POST[ "efsuntur" ];
    $turler = "";
    if ( count( $efsuntur ) != 0 ) {
        foreach ( $efsuntur as $efsun ) {
            $turler .= $efsun;
        }
    }
    if ( !$isim || !$oran || !$efsunid ) {
        $WMform->hata( "Boş alan bırakamazsını" );
    } else if ( count( $efsuntur ) == 0 ) {
        $WMform->hata( "Efsunun geleceği itemlerden en az 1 tane seçmelisiniz" );
    } else {
        if ( $fid == 1 ) {
            $insert = $db->prepare( "INSERT INTO market_efsun SET sid = ?, tur = ?, isim = ?, oran = ?, efsunid = ?" );
            $ekle   = $insert->execute( array(
                 $_SESSION[ "server" ],
                $turler,
                $isim,
                $oran,
                $efsunid 
            ) );
            if ( $ekle ) {
                $WMadmin->log_gonder( $isim . " Adlı Market efsunu eklendi" );
                $WMform->basari( "Market Efsunu başarıyla eklendi" );
            } else {
                $WMform->hata();
            }
        } else if ( $fid == 2 ) {
            $pid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
            $bak = $db->prepare( "SELECT isim FROM market_efsun WHERE id = ? && sid = ?" );
            $bak->execute( array(
                 $pid,
                $_SESSION[ "server" ] 
            ) );
            $WMadmin->log_gonder( $bak[ "isim" ] . " Adlı Market efsunu düzenlendi" );
            $update   = $db->prepare( "UPDATE market_efsun SET tur = ?, isim = ?, oran = ?, efsunid = ? WHERE sid = ? && id = ?" );
            $guncelle = $update->execute( array(
                 $turler,
                $isim,
                $oran,
                $efsunid,
                $_SESSION[ "server" ],
                $pid 
            ) );
            if ( $guncelle ) {
                $WMform->basari( "Market Efsunu başarıyla güncellendi" );
            } else {
                $WMform->hata();
            }
        }
    }
} else if ( $fid == 3 ) {
    $id      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
    $kontrol = $db->prepare( "SELECT id,isim FROM market_efsun WHERE id = ? && sid = ?" );
    $kontrol->execute( array(
         $id,
        $_SESSION[ "server" ] 
    ) );
    if ( $kontrol->rowCount() ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "isim" ] . " Adlı Market efsunu silindi" );
        $sil = $db->prepare( "DELETE FROM market_efsun WHERE id = ? && sid = ?" );
        $sil->execute( array(
             $id,
            $_SESSION[ "server" ] 
        ) );
        if ( $sil ) {
            $WMform->jquery_sil( "tr#market_efsun-$id" );
            $WMform->basari( "Market Efsunu başarıyla silindi" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Market efsunu bulunamadı" );
    }
}
?>