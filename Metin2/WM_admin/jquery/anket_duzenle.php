<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$pid       = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "pid" ] ) );
$anket_bul = $db->prepare( "SELECT * FROM anketler WHERE id = ? && sid = ?" );
$anket_bul->execute( array(
     $pid,
    $_SESSION[ "server" ] 
) );
$afetch   = $anket_bul->fetch( PDO::FETCH_ASSOC );
$konu     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "konu" ] ) ) );
$cevaplar = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "cevaplar" ] ) ) );
@$tarih_durum = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "tarih_durum" ] ) ) );
if ( $tarih_durum ) {
    $tarih = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "tarih" ] ) ) );
    $saat  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "saat" ] ) ) );
} else {
    $tarih = "";
    $saat  = "";
}
$hatalar = array( );
try {
    if ( !$konu || !$cevaplar ) {
        Throw New Exception( 'Anket konusunu ve cevapları boş bırakamazsınız' );
    }
    $cevaplar_bak  = explode( ',', $cevaplar );
    $cevaplar_bak2 = explode( ',', $afetch[ "secenekler" ] );
    if ( count( $cevaplar_bak ) < count( $cevaplar_bak2 ) ) {
        Throw New Exception( 'Anket cevaplarını lütfen cevap sil sayfasından siliniz' );
    }
    foreach ( $cevaplar_bak as $cevaplar ) {
        if ( !$cevaplar ) {
            Throw New Exception( 'Cevap eklemek için , bıraktınız fakat boş bıraktınız' );
        } else if ( strlen( $cevaplar ) < 3 ) {
            Throw New Exception( 'Cevaplar en az 3 haneli olmalıdır' );
        }
    }
    $kontrol = $db->prepare( "SELECT seo FROM anketler WHERE seo = ? && id != ?" );
    $kontrol->execute( array(
         $WMkontrol->WM_eng( $konu ),
        $pid 
    ) );
    if ( $kontrol->rowCount() ) {
        Throw New Exception( 'Bu soru ile bir anket zaten oluşturmuşsunuz' );
    }
    if ( $tarih_durum ) {
        $saat_bak = explode( ':', $saat );
        if ( !$tarih ) {
            Throw New Exception( 'Tarih Boş Bırakılamaz' );
        }
        if ( count( $saat_bak ) != 3 ) {
            Throw New Exception( 'Saat Kısmı 13:50:00 şeklinde olmalıdır' );
        }
        if ( count( $saat_bak ) == 3 ) {
            for ( $i = 0; $i <= 2; $i++ ) {
                if ( strlen( $saat_bak[ $i ] ) != 2 ) {
                    Throw New Exception( 'Saat Kısmı 13:50:00 şeklinde 2 haneli olmalıdır' );
                }
            }
            if ( $saat_bak[ 0 ] < 0 || $saat_bak[ 0 ] > 23 ) {
                Throw New Exception( 'Saat 0 dan küçük 23 den büyük olamaz' );
            } else if ( ( $saat_bak[ 1 ] < 0 || $saat_bak[ 1 ] > 59 ) || ( $saat_bak[ 2 ] < 0 || $saat_bak[ 2 ] > 59 ) ) {
                Throw New Exception( 'Dakika ve Saniye 0 dan küçük 59 den büyük olamaz' );
            }
        }
    }
}
catch ( Exception $e ) {
    $hatalar[ ] = $e->getMessage();
}
if ( count( $hatalar ) == 0 ) {
    $cevaplar2  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "cevaplar" ] ) ) );
    $kac_cevap  = explode( ',', $cevaplar2 );
    $kac_cevap2 = explode( ',', $afetch[ "secenekler" ] );
    if ( count( $kac_cevap ) == count( $kac_cevap2 ) ) {
        $oy_guncelle = $afetch[ "onay" ];
    } else {
        $cikart       = count( $kac_cevap ) - count( $kac_cevap2 );
        $oy_guncelle2 = json_decode( $afetch[ "onay" ] );
        if ( $cikart > 1 ) {
            for ( $j = 0; $j <= $cikart; $j++ ) {
                array_push( $oy_guncelle2, '[]' );
            }
        } else {
            array_push( $oy_guncelle2, '[]' );
        }
        echo $oy_guncelle = json_encode( $oy_guncelle2 );
    }
    $update   = $db->prepare( "UPDATE anketler SET konu = ?, secenekler = ?, onay = ?, tarih = ?, bitis_tarih = ?, seo = ? WHERE sid = ? && id = ?" );
    $guncelle = $update->execute( array(
         $konu,
        $cevaplar2,
        $oy_guncelle,
        date( "Y-m-d H:i:s" ),
        $tarih . ' ' . $saat,
        $WMkontrol->WM_eng( $konu ),
        $_SESSION[ "server" ],
        $pid 
    ) );
    if ( $guncelle ) {
        $WMadmin->log_gonder( $afetch[ "konu" ] . " Sorulu anket düzenlendi" );
        $WMform->basari( "Anket Başarıyla Güncellendi" );
    } else {
        $WMform->hata();
    }
} else if ( count( $hatalar ) > 0 ) {
    foreach ( $hatalar as $key => $hata ) {
        $WMform->hata( $hata );
    }
}
?>