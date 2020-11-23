<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$pid       = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$type      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "type" ] ) ) );
$subtype   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "subtype" ] ) ) );
$size      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "size" ] ) ) );
$yukselcek = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "yukselcek" ] ) ) );
$refineid  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "refineid" ] ) ) );
$antiflag  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "antiflag" ] ) ) );
$flag      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "flag" ] ) ) );
$wearflag  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "wearflag" ] ) ) );
$gold      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "gold" ] ) ) );
$buy       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "buy" ] ) ) );
$lvsinir   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "lvsinir" ] ) ) );
$lv        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "lv" ] ) ) );
$efsun1    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsun1" ] ) ) );
$oran1     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "oran1" ] ) ) );
$efsun2    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsun2" ] ) ) );
$oran2     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "oran2" ] ) ) );
$efsun3    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsun3" ] ) ) );
$oran3     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "oran3" ] ) ) );
$taslar    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "taslar" ] ) ) );
$itemvarmi = $odb->prepare( "SELECT vnum FROM player.item_proto WHERE vnum = ?" );
$itemvarmi->execute( array(
     $pid 
) );
if ( $itemvarmi->rowCount() ) {
    $update   = $odb->prepare( "UPDATE player.item_proto SET type = :type, subtype = :subtype, size = :size, refined_vnum = :yukselcek, refine_set = :refineid, antiflag = :antiflag, flag = :flag,
	wearflag = :wearflag, gold = :gold, shop_buy_price = :buy, limittype0 = :lvsinir, limitvalue0 = :lv, applytype0 = :efsun1, applytype1 = :efsun2, applytype2 = :efsun3,
	applyvalue0 = :oran1, applyvalue1 = :oran2, applyvalue2 = :oran3, socket_pct = :taslar WHERE vnum = :pid
	" );
    $guncelle = $update->execute( array(
         "type" => $type,
        "subtype" => $subtype,
        "size" => $size,
        "yukselcek" => $yukselcek,
        "refineid" => $refineid,
        "antiflag" => $antiflag,
        "flag" => $flag,
        "wearflag" => $wearflag,
        "gold" => $gold,
        "buy" => $buy,
        "lvsinir" => $lvsinir,
        "lv" => $lv,
        "efsun1" => $efsun1,
        "efsun2" => $efsun2,
        "efsun3" => $efsun3,
        "oran1" => $oran1,
        "oran2" => $oran2,
        "oran3" => $oran3,
        "taslar" => $taslar,
        "pid" => $pid 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( $WMadmin->item_bul( $pid ) . " Adlı item düzenlendi" );
        $WMform->basari( "İtem başarıyla güncellendi" );
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( " Düzenlemeye çalıştığınız item artık yok" );
}
?>