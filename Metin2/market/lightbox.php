<?php
if ( !isset( $izin_verme ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
} else if ( !isset( $_SESSION[ "market_server" ] ) ) {
    die( "Server Bulunamadı" );
    exit;
}
@$kategori = $WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "kategori" ] ) );
@$item = $WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "item" ] ) );
@$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "id" ] ) );
$kontrol = $db->prepare( "SELECT * FROM market_item WHERE kid = ? && id = ? && sid = ?" );
$kontrol->execute( array(
     $kategori,
    $id,
    $_SESSION[ "market_server" ] 
) );
if ( $kontrol->rowCount() ) {
    $ifetch = $kontrol->fetch( PDO::FETCH_ASSOC );
    require_once WM_market . 'lightbox.php';
} else {
}
?>