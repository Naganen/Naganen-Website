<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$arama = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "aramatur" ] ) ) );
$deger = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "deger" ] ) ) );
if ( $arama == 1 ) {
    $kontrol = $odb->prepare( "SELECT name FROM player.guild WHERE name LIKE ? LIMIT 1" );
    $kontrol->execute( array(
         '%' . $deger . '%' 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMadmin->yonlendir( "index.php?sayfa=lonca_ara&tur=1&deger=$deger" );
    } else {
        $WMform->hata( "Arama kriterine uygun lonca bulunamadı" );
    }
} else if ( $arama == 2 ) {
    $kontrol = $odb->prepare( "SELECT guild.*, player.name AS baskan FROM player.guild LEFT JOIN player.player ON player.id = guild.master WHERE player.name LIKE ? LIMIT 1" );
    $kontrol->execute( array(
         '%' . $deger . '%' 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMadmin->yonlendir( "index.php?sayfa=lonca_ara&tur=2&deger=$deger" );
    } else {
        $WMform->hata( "Arama kriterine uygun lonca bulunamadı" );
    }
}
?>