<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$gid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "gid" ] ) ) );
$kontrol = $odb->prepare( "SELECT name FROM player.guild WHERE id = ?" );
$kontrol->execute( array(
     $gid 
) );
if ( $kontrol->rowCount() ) {
    $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
    $WMadmin->log_gonder( $fetch[ "name" ] . " adlı lonca silindi" );
    $loncasil = $odb->prepare( "DELETE FROM player.guild WHERE id = ?" );
    $loncasil->execute( array(
         $gid 
    ) );
    $uyesil = $odb->prepare( "DELETE FROM player.guild_member WHERE guild_id = ?" );
    $uyesil->execute( array(
         $gid 
    ) );
    $sohbetsil = $odb->prepare( "DELETE FROM player.guild_comment WHERE guild_id = ?" );
    $sohbetsil->execute( array(
         $gid 
    ) );
    $savassil = $odb->prepare( "DELETE FROM player.guild_war WHERE (id_from = '? OR id_to = ?)" );
    $savassil->execute( array(
         $gid,
        $gid 
    ) );
    $rezervesil = $odb->prepare( "DELETE FROM guild_war_reservation WHERE (guild1 = ? OR guild2 = ?)" );
    $savassil->execute( array(
         $gid,
        $gid 
    ) );
    $bahis = $odb->prepare( "DELETE FROM guild_war_bet WHERE guild = ?" );
    $bahis->execute( array(
         $gid 
    ) );
    $WMform->basari( " Lonca dağıtıldı" );
    echo '<meta http-equiv="refresh" content="2;URL=#">';
} else {
    $WMform->hata( "Lonca bulunamadı" );
}
?>