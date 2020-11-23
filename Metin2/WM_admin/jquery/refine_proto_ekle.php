<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
@$id = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "refine" ] ) ) );
$ekle1   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ekle1" ] ) ) );
$ekle2   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ekle2" ] ) ) );
$ekle3   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ekle3" ] ) ) );
$ekle4   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ekle4" ] ) ) );
$ekle5   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ekle5" ] ) ) );
$adet1   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "adet1" ] ) ) );
$adet2   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "adet2" ] ) ) );
$adet3   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "adet3" ] ) ) );
$adet4   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "adet4" ] ) ) );
$adet5   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "adet5" ] ) ) );
$cost    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "cost" ] ) ) );
$prob    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "prob" ] ) ) );
$kontrol = $odb->prepare( "SELECT id FROM player.refine_proto WHERE id = ?" );
$kontrol->execute( array(
     $id 
) );
if ( $kontrol->rowCount() ) {
    $WMform->hata( "Girdiğiniz refine id ' sine sahip bir veri zaten var" );
} else if ( !$id || $id == 0 ) {
    $WMform->hata( "Refine idsi boş bırakılamaz" );
} else {
    $insert = $odb->prepare( "INSERT INTO player.refine_proto SET id = ?, vnum0 = ?, vnum1 = ?, vnum2 = ?, vnum3 = ?, vnum4 = ?, count0 = ?, count1 = ?, count2 = ?, count3 = ?, count4 = ?, cost = ?, prob = ?" );
    $ekle   = $insert->execute( array(
         $id,
        $ekle1,
        $ekle2,
        $ekle3,
        $ekle4,
        $ekle5,
        $adet1,
        $adet2,
        $adet3,
        $adet4,
        $adet5,
        $cost,
        $prob 
    ) );
    if ( $ekle ) {
        $WMadmin->log_gonder( $id . " numaralı yükseltme verisi eklendi" );
        $WMform->basari( "Yükseltme verisi başarıyla eklendi" );
    } else {
        $WMform->hata();
    }
}
?>