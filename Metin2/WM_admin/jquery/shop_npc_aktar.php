<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$aktarilcak = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "aktarilcak" ] ) ) );
$aktar      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "aktar" ] ) ) );
if ( !$aktarilcak || !$aktar ) {
    $WMform->hata( " Aktarma işlemi olduğu için her iki seçme yeride boş bırakılmamalı.!" );
} else if ( $aktarilcak == $aktar ) {
    $WMform->hata( " Aktarılan npc ile aktarılcak npc aynı olamaz. ! " );
} else {
    $guncelle = $odb->prepare( "UPDATE player.shop_item SET shop_vnum = ? WHERE shop_vnum = ?" );
    $aktar    = $guncelle->execute( array(
         $aktar,
        $aktarilcak 
    ) );
    $WMadmin->log_gonder( $aktar . " vnumlu npc itemleri " . $aktarilcak . " vnumlu npc ye aktarıldı" );
    if ( $aktar ) {
        $WMform->basari( " Aktarma işlemi başarıyla gerçekleştirildi" );
    } else {
        $WMform->hata();
    }
}
?>