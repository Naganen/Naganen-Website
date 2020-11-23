<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$formid   = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
$apply    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "apply-$formid" ] ) ) );
$gelme    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "gelme-$formid" ] ) ) );
$lv1      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "lv1-$formid" ] ) ) );
$lv2      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "lv2-$formid" ] ) ) );
$lv3      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "lv3-$formid" ] ) ) );
$lv4      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "lv4-$formid" ] ) ) );
$lv5      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "lv5-$formid" ] ) ) );
$silah    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "silah-$formid" ] ) ) );
$zirh     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "zirh-$formid" ] ) ) );
$bileklik = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "bileklik-$formid" ] ) ) );
$ayakkabi = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ayakkabi-$formid" ] ) ) );
$kolye    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "kolye-$formid" ] ) ) );
$kask     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "kask-$formid" ] ) ) );
$kalkan   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "kalkan-$formid" ] ) ) );
$kupe     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "kupe-$formid" ] ) ) );
$kontrol  = $odb->prepare( "SELECT apply FROM player.item_attr WHERE apply = ?" );
$kontrol->execute( array(
     $apply 
) );
if ( $kontrol->rowCount() ) {
    $update   = $odb->prepare( "UPDATE player.item_attr SET prob = ?, lv1 = ?, lv2 = ?, lv3 = ?, lv4 = ?, lv5 = ?, weapon = ?, body = ?, wrist = ?, foots = ?, neck = ?, head = ?, shield = ?, ear = ? WHERE apply = ?" );
    $guncelle = $update->execute( array(
         $gelme,
        $lv1,
        $lv2,
        $lv3,
        $lv4,
        $lv5,
        $silah,
        $zirh,
        $bileklik,
        $ayakkabi,
        $kolye,
        $kask,
        $kalkan,
        $kupe,
        $apply 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( $apply . " Adlı efsun düzenlendi" );
        $WMform->basari( "Efsun başarıyla güncellendi" );
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( "Düzenleme çalıştığınız efsun artık yok ! " );
}
?>