<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$formid  = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
$pid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$id      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "refine-$formid" ] ) ) );
$ekle1   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ekle1-$formid" ] ) ) );
$ekle2   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ekle2-$formid" ] ) ) );
$ekle3   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ekle3-$formid" ] ) ) );
$ekle4   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ekle4-$formid" ] ) ) );
$ekle5   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ekle5-$formid" ] ) ) );
$adet1   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "adet1-$formid" ] ) ) );
$adet2   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "adet2-$formid" ] ) ) );
$adet3   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "adet3-$formid" ] ) ) );
$adet4   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "adet4-$formid" ] ) ) );
$adet5   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "adet5-$formid" ] ) ) );
$cost    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "cost-$formid" ] ) ) );
$prob    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "prob-$formid" ] ) ) );
$kontrol = $odb->prepare( "SELECT id FROM player.refine_proto WHERE id = ?" );
$kontrol->execute( array(
     $pid 
) );
if ( $kontrol->rowCount() ) {
    $kontrol2 = $odb->prepare( "SELECT id FROM player.refine_proto WHERE id != ? && id = ?" );
    $kontrol2->execute( array(
         $pid,
        $id 
    ) );
    if ( $kontrol2->rowCount() ) {
        $WMform->uyari( $id . " id ' sine sahip yükseltme verisi zaten var" );
    } else {
        $update   = $odb->prepare( "UPDATE player.refine_proto SET id = ?, vnum0 = ?, vnum1 = ?, vnum2 = ?, vnum3 = ?, vnum4 = ?, count0 = ?, count1 = ?, count2 = ?, count3 = ?, count4 = ?, cost = ?, prob = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
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
            $prob,
            $pid 
        ) );
        if ( $guncelle ) {
            $WMadmin->log_gonder( $pid . " Numaralı arttırma işlemi silindi" );
            $WMform->basari( "Yükseltme verisi başarıyla güncellendi" );
        } else {
            $WMform->hata();
        }
    }
} else {
    $WMform->hata( " Düzenlemeye çalıştığınız yükseltme verisi artık yok.! " );
}
?>