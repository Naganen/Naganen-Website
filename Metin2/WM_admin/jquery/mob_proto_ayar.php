<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
if ( $id <= 4 ) {
    if ( $id == 4 ) {
        $pid = 3;
    } else {
        $pid = $id;
    }
    $kac = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "kac-$pid" ] ) ) );
    if ( $id == 1 ) {
        if ( !$kac ) {
            $WMform->hata( "Arttırılcak Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Tüm Mob Exp $kac arttırıldı" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET exp = exp + ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    } else if ( $id == 2 ) {
        if ( !$kac ) {
            $WMform->hata( "Azaltılcak Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Tüm Mob Exp $kac azaltıldı" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET exp = exp - ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    } else if ( $id == 3 ) {
        if ( !$kac ) {
            $WMform->hata( "Bölüncek Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Tüm Mob Exp $kac ' ye bölündü" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET exp = exp / ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    } else if ( $id == 4 ) {
        if ( !$kac ) {
            $WMform->hata( "Çarpılcak Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Tüm Mob Exp $kac ile çarpıldı" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET exp = exp * ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    }
} else if ( $id <= 13 ) {
    if ( $id == 13 ) {
        $pid = 12;
    } else {
        $pid = $id;
    }
    $kac = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "kac-$pid" ] ) ) );
    if ( $id == 10 ) {
        if ( !$kac ) {
            $WMform->hata( "Arttırılcak Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Moblardan düşen minumum altın $kac arttırıldı" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET gold_min = gold_min + ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    } else if ( $id == 11 ) {
        if ( !$kac ) {
            $WMform->hata( "Azaltılcak Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Moblardan düşen minumum altın $kac azaltıldı" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET gold_min = gold_min - ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    } else if ( $id == 12 ) {
        if ( !$kac ) {
            $WMform->hata( "Bölüncek Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Moblardan düşen minumum altın $kac ' ye bölündü" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET gold_min = gold_min / ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    } else if ( $id == 13 ) {
        if ( !$kac ) {
            $WMform->hata( "Çarpılcak Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Moblardan düşen minumum altın $kac ' ile çarpıldı" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET gold_min = gold_min * ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    }
} else {
    if ( $id == 23 ) {
        $pid = 22;
    } else {
        $pid = $id;
    }
    $kac = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "kac-$pid" ] ) ) );
    if ( $id == 20 ) {
        if ( !$kac ) {
            $WMform->hata( "Arttırılcak Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Moblardan düşen maximum altın $kac arttırıldı" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET gold_max = gold_max + ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    } else if ( $id == 21 ) {
        if ( !$kac ) {
            $WMform->hata( "Azaltılcak Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Moblardan düşen maximum altın $kac azaltıldı" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET gold_max = gold_max - ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    } else if ( $id == 22 ) {
        if ( !$kac ) {
            $WMform->hata( "Bölüncek Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Moblardan düşen maximum altın $kac ' ye bölündü" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET gold_max = gold_max / ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    } else if ( $id == 23 ) {
        if ( !$kac ) {
            $WMform->hata( "Çarpılcak Değeri Boş Bırakamazsınız" );
            exit;
        } else {
            $WMadmin->log_gonder( "Moblardan düşen maximum altın $kac ile çarpıldı" );
            $update = $odb->prepare( "UPDATE player.mob_proto SET gold_max = gold_max * ?" );
            $update->execute( array(
                 $kac 
            ) );
        }
    }
}
if ( $update ) {
    $WMform->basari( "Komutunuz başarıyla uygulandı" );
} else {
    $WMform->hata();
}
?>