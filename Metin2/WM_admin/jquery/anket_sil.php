<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriÅŸ izniniz yoktur." );
    exit;
}
session_start();
$fid     = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "fid" ] ) );
$pid     = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "pid" ] ) );
$id      = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "id" ] ) );
$kontrol = $db->prepare( "SELECT * FROM anketler WHERE id = ? && sid = ?" );
$kontrol->execute( array(
     $id,
    $_SESSION[ "server" ] 
) );
$fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
if ( $fid == 1 ) {
    if ( $kontrol->rowCount() ) {
        $secenekler = explode( ',', $fetch[ "secenekler" ] );
        $oylar      = json_decode( $fetch[ "onay" ] );
        if ( isset( $secenekler[ $pid ] ) ) {
            if ( count( $secenekler ) == 1 || count( $secenekler ) == 0 ) {
                $WMform->hata( "Anket CevaplarÄ±nÄ± BoÅŸ BÄ±rakamazsÄ±nÄ±z" );
            } else {
                if ( count( $secenekler ) - 1 == $pid ) {
                    $secenek_degis = str_replace( ',' . $secenekler[ $pid ], '', $fetch[ "secenekler" ] );
                } else {
                    $secenek_degis = str_replace( $secenekler[ $pid ] . ',', '', $fetch[ "secenekler" ] );
                }
                unset( $oylar[ $pid ] );
                $yeni_oylar = array( );
                for ( $j = 0; $j <= count( $oylar ) - 1; $j++ ) {
                    if ( $j == $pid ) {
                        $yeni_oylar[ $j ] = $oylar[ $j + 1 ];
                    } else if ( $j > $pid ) {
                        $yeni_oylar[ $j ] = $oylar[ $j + 1 ];
                    } else {
                        $yeni_oylar[ $j ] = $oylar[ $j ];
                    }
                }
                $update   = $db->prepare( "UPDATE anketler SET secenekler = ?, onay = ? WHERE sid = ? && id = ?" );
                $guncelle = $update->execute( array(
                     $secenek_degis,
                    json_encode( $yeni_oylar ),
                    $_SESSION[ "server" ],
                    $id 
                ) );
                if ( $guncelle ) {
                    echo '<meta http-equiv="refresh" content="1;URL=index.php?sayfa=anket&islem=' . $id . '">';
                    $WMadmin->log_gonder( $fetch[ "konu" ] . " Sorulu bir anketten " . $secenekler[ $pid ] . " SeÃ§eneÄŸi silindi" );
                    $WMform->basari( "Anket seÃ§eneÄŸi baÅŸarÄ±yla silindi" );
                } else {
                    $WMform->hata();
                }
            }
        } else {
            $WMform->hata( "BÃ¶yle Bir Anket SeÃ§eneÄŸi yok" );
        }
    } else {
        $WMform->hata( "Anket bulunamadÄ±" );
    }
} else if ( $fid == 2 ) {
    if ( $kontrol->rowCount() ) {
        $delete = $db->prepare( "DELETE FROM anketler WHERE id = ? && sid = ?" );
        $sil    = $delete->execute( array(
             $id,
            $_SESSION[ "server" ] 
        ) );
        if ( $sil ) {
            $WMadmin->log_gonder( $fetch[ "konu" ] . " Sorulu anket silindi" );
            $WMform->basari( "Anket baÅŸarÄ±yla silindi" );
            $WMform->jquery_sil( 'tr#anket-' . $id . '' );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( "Anket BulunamadÄ±" );
    }
}
?>