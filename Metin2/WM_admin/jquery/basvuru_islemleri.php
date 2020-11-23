<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "formid" ] ) ) );
if ( $fid == 1 || $fid == 2 ) {
    $konu   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "konu" ] ) ) );
    $icerik = $WMkontrol->WM_tostring( $_POST[ "icerik" ] );
    @$sureli = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sureli" ] ) ) );
    @$loncami = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "loncami" ] ) ) );
    if ( $loncami ) {
        $tur = 2;
    } else {
        $tur = 1;
    }
    if ( $tur == 2 ) {
        $kisi_sinir  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "kisi_sinir" ] ) ) );
        $level_sinir = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "level_sinir" ] ) ) );
        $lonca_sart  = '[' . $kisi_sinir . ', ' . $level_sinir . ']';
    } else {
        $lonca_sart = '[]';
    }
    if ( $sureli ) {
        $tarih      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "tarih" ] ) ) );
        $saat       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "saat" ] ) ) );
        $tarih_saat = $tarih . ' ' . $saat;
        $bitis_tur  = 1;
    } else {
        $tarih_saat = false;
        $bitis_tur  = 2;
    }
    $hatalar = array( );
    try {
        if ( !$konu || !$icerik ) {
            throw new Exception( 'Konuyu ve içeriği boş bırakamazsınız' );
        }
        if ( $sureli ) {
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
        if ( $fid == 1 ) {
            $insert = $db->prepare( "INSERT INTO basvurular SET `sid` = ?, `tur` = ?, `lonca_sart` = ?, `konu` = ?, `icerik` = ?, `tarih` = ?, `bitis` = ?, `bitis_tur` = ?" );
            $ekle   = $insert->execute( array(
                 $_SESSION[ "server" ],
                $tur,
                $lonca_sart,
                $konu,
                $icerik,
                date( "Y-m-d H:i:s" ),
                $tarih_saat,
                $bitis_tur 
            ) );
            if ( $ekle ) {
                $WMform->basari( "Başvuru formu başarıyla eklendi" );
                $WMadmin->log_gonder( $konu . " adlı başvuru formu oluşturuldu" );
            } else {
                $WMform->hata();
            }
        } else if ( $fid == 2 ) {
            $pid      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "pid" ] ) ) );
            $parcala  = explode( '--', $pid );
            $update   = $db->prepare( "UPDATE basvurular SET tur = ?, lonca_sart = ?, konu = ?, icerik = ?, bitis = ?, bitis_tur = ? WHERE sid = ? && id = ?" );
            $guncelle = $update->execute( array(
                 $tur,
                $lonca_sart,
                $konu,
                $icerik,
                $tarih_saat,
                $bitis_tur,
                $_SESSION[ "server" ],
                $parcala[ 0 ] 
            ) );
            if ( $guncelle ) {
                $WMform->basari( "Başvuru formu başarıyla güncellendi" );
                $WMadmin->log_gonder( $parcala[ 1 ] . " adlı başvuru formu düzenlendi" );
            } else {
                $WMform->hata();
            }
        }
    } else {
        foreach ( $hatalar as $key => $hata ) {
            $WMform->hata( $hata );
        }
    }
} else if ( $fid == 3 ) {
    $pid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "pid" ] ) ) );
    $kontrol = $db->prepare( "SELECT konu FROM basvurular WHERE sid = ? && id = ?" );
    $kontrol->execute( array(
         $_SESSION[ "server" ],
        $pid 
    ) );
    if ( $kontrol->rowCount() ) {
        $bak = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $bak[ "konu" ] . " Konulu başvuru formu silindi" );
        $sil = $db->prepare( "DELETE FROM basvurular WHERE sid = ? && id = ?" );
        $sil->execute( array(
             $_SESSION[ "server" ],
            $pid 
        ) );
        if ( $sil ) {
            $WMform->jquery_sil( 'tr#basvuru-' . $pid . '' );
            $WMform->basari( "Başvuru formu başarıyla silindi" );
        } else {
            $WMform->hata();
        }
    }
}
?>