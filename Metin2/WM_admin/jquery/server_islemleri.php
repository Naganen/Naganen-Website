<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid         = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
$server_id   = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "server_id" ] ) ) );
$yetkiler    = json_decode( $WMadmin->yonetici( "yetki" ) );
$serverlar   = json_decode( $WMadmin->yonetici( "server_yetki" ) );
$yonetim_tur = $WMadmin->yonetici( "tur" );
if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( $server_id, $serverlar ) ) ) {
    if ( $fid == 1 ) {
        $kontrol = $db->prepare( "SELECT id FROM server WHERE id = ?" );
        $kontrol->execute( array(
             $server_id 
        ) );
        if ( $kontrol->rowCount() ) {
            $guncelle = $db->prepare( "UPDATE users SET server = ? WHERE id = ?" );
            $guncelle->execute( array(
                 $server_id,
                $_SESSION[ "adminid" ] 
            ) );
            if ( $guncelle ) {
                $_SESSION[ "server" ] = $server_id;
                $WMadmin->yonlendir( "index.php" );
            } else {
                $WMform->hata();
            }
        } else {
            $WMform->hata( "Böyle bir server bulunamadı" );
        }
    } else if ( $fid == 2 ) {
        $db->query( "DELETE FROM anketler WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM destek WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM destek_cevap WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM destek_kategori WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM duyurular WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM epfiyatlari WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM eptoken WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM eptransfer_log WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM hatalar WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM kullanici_log WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM log WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM market_efsun WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM market_item WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM market_kategori WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM market_tas WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM market_log WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM onayli_karakter WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM packlar WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM sayfalar WHERE sid = '$server_id'" );
        $db->query( "DELETE FROM token WHERE sid = '$server_id'" );
        $sil = $db->prepare( "DELETE FROM server WHERE id = ?" );
        $sil->execute( array(
             $server_id 
        ) );
        if ( $sil ) {
            $WMform->basari( "Server başarıyla silindi klasörü silmeyi unutmayın..", 10000 );
        } else {
            $WMform->hata();
        }
    }
} else {
    $WMform->hata( "Yetkiniz yok" );
}
?>