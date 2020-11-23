<?php
require_once "WM_settings/WMayar.php";
$ayar = new WMayar( ".", $_SESSION[ "server_vt" ] );
$int  = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "int" ] ) ) );
$vt   = new WM_vt_settings( $_SESSION[ "server_vt" ] );
if ( $int == 0 ) {
    $dondur = $odb->prepare( "SELECT COUNT(id) as count FROM player.player WHERE DATE_SUB(NOW(), INTERVAL ? MINUTE) < last_play" );
    $dondur->execute( array(
         60 
    ) );
    $dondur = $dondur->fetchColumn();
    echo $dondur + $vt->istatistik( 0 );
} elseif ( $int == 1 ) {
    $dondur = $odb->prepare( "SELECT COUNT(id) as count FROM player.player WHERE last_play LIKE ?" );
    $dondur->execute( array(
         '%' . date( "Y-m-d" ) . '%' 
    ) );
    $dondur = $dondur->fetchColumn();
    echo $dondur + $vt->istatistik( 1 );
} else if ( $int == 2 ) {
    $dondur = $odb->prepare( "SELECT COUNT(id) as count FROM account WHERE status= ? " );
    $dondur->execute( array(
         'OK' 
    ) );
    $dondur = $dondur->fetchColumn();
    echo $dondur + $vt->istatistik( 2 );
} else if ( $int == 3 ) {
    $dondur = $odb->query( "SELECT COUNT(id) as count FROM player.player" )->fetchColumn();
    echo $dondur + $vt->istatistik( 3 );
} else if ( $int == 4 ) {
    $dondur = $odb->query( "SELECT COUNT(id) as count FROM player.guild" )->fetchColumn();
    echo $dondur + $vt->istatistik( 4 );
} else {
    echo "..";
}
?>