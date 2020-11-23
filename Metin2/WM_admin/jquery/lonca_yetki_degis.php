<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$pid      = $WMkontrol->WM_get( $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) ) );
$gid      = $WMkontrol->WM_get( $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "gid" ] ) ) ) );
$grade    = $WMkontrol->WM_get( $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "grade" ] ) ) ) );
$guncelle = $odb->prepare( "UPDATE player.guild_member SET grade = ? WHERE pid = ? && guild_id = ?" );
$update   = $guncelle->execute( array(
     $grade,
    $pid,
    $gid 
) );
if ( $update ) {
    $WMadmin->log_gonder( $WMadmin->karakter( $pid, "name", 2 ) . " adlı karakterin lonca yetkisi düzenlendi" );
    $WMform->basari( "Üyenin yetkisi başarıyla değiştirildi" );
    echo '<meta http-equiv="refresh" content="2;URL=#">';
} else {
    $WMform->hata();
}
?>