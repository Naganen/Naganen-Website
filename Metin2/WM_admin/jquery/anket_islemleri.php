<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
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
    $cevaplar_bak = explode( ',', $cevaplar );
    foreach ( $cevaplar_bak as $cevaplar ) {
        if ( !$cevaplar ) {
            Throw New Exception( 'Cevap eklemek için , bıraktınız fakat boş bıraktınız' );
        } else if ( strlen( $cevaplar ) < 3 ) {
            Throw New Exception( 'Cevaplar en az 3 haneli olmalıdır' );
        }
    }
    $kontrol = $db->prepare( "SELECT seo FROM anketler WHERE seo = ?" );
    $kontrol->execute( array(
         $WMkontrol->WM_eng( $konu ) 
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
    $cevaplar2 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "cevaplar" ] ) ) );
    $kac_cevap = explode( ',', $cevaplar2 );
    $oylar     = array( );
    foreach ( $kac_cevap as $cevaps ) {
        $oylar[ ] = '[]';
    }
    $tum_oylar = json_encode( $oylar );
    $insert    = $db->prepare( "INSERT INTO anketler SET sid = ?, tur = ?, konu = ?, secenekler = ?, onay = ?, tarih = ?, bitis_tarih = ?, token = ?, seo = ?" );
    $ekle      = $insert->execute( array(
         $_SESSION[ "server" ],
        2,
        $konu,
        $cevaplar2,
        $tum_oylar,
        date( "Y-m-d H:i:s" ),
        $tarih . ' ' . $saat,
        md5( uniqid( mt_rand(), true ) ),
        $WMkontrol->WM_eng( $konu ) 
    ) );
    if ( $ekle ) {
        $WMadmin->log_gonder( $konu . " Sorulu bir anket oluşturuldu" );
        $WMform->basari( "Anket Başarıyla Eklendi" );
    } else {
        $WMform->hata();
    }
} else if ( count( $hatalar ) > 0 ) {
    foreach ( $hatalar as $key => $hata ) {
        $WMform->hata( $hata );
    }
}
?>