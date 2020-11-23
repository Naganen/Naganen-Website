<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$itemid = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "id" ] ) );
$bak    = $odb->prepare( "SELECT * FROM player.item WHERE id = ?" );
$bak->execute( array(
     $itemid 
) );
if ( $bak->rowCount() ) {
    $fetch    = $bak->fetch( PDO::FETCH_ASSOC );
    $genel    = array(
         $fetch[ "vnum" ],
        $fetch[ "count" ],
        $fetch[ "owner_id" ],
        $fetch[ "window" ] 
    );
    $efsunlar = array(
         $fetch[ "attrtype0" ],
        $fetch[ "attrtype1" ],
        $fetch[ "attrtype2" ],
        $fetch[ "attrtype3" ],
        $fetch[ "attrtype4" ],
        $fetch[ "attrtype5" ],
        $fetch[ "attrtype6" ] 
    );
    $oranlar  = array(
         $fetch[ "attrvalue0" ],
        $fetch[ "attrvalue1" ],
        $fetch[ "attrvalue2" ],
        $fetch[ "attrvalue3" ],
        $fetch[ "attrvalue4" ],
        $fetch[ "attrvalue5" ],
        $fetch[ "attrvalue6" ] 
    );
    $taslar   = array(
         $fetch[ "socket0" ],
        $fetch[ "socket1" ],
        $fetch[ "socket2" ] 
    );
    $log      = array(
         json_encode( $genel ),
        json_encode( $efsunlar ),
        json_encode( $oranlar ),
        json_encode( $taslar ) 
    );
    $WMadmin->log_gonder( "İtem Silindi", 3, json_encode( $log ) );
    $itemsil = $odb->prepare( "DELETE FROM player.item WHERE id = ?" );
    $itemsil->execute( array(
         $itemid 
    ) );
    if ( $itemsil ) {
        $WMform->jquery_sil( 'tr#item-' . $itemid . '' );
        $WMform->basari( " İtemi başarıyla sildiniz." );
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( "İtem bulunamadı" );
}
?>