<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$pid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "pid" ] ) ) );
$parcala = explode( '--', $pid );
$kontrol = $db->prepare( "SELECT id, onaylananlar, red_edilenler, basvuranlar, konu FROM basvurular WHERE sid = ? && id = ?" );
$kontrol->execute( array(
     $_SESSION[ "server" ],
    $parcala[ 0 ] 
) );
if ( $kontrol->rowCount() ) {
    $fetch          = $kontrol->fetch( PDO::FETCH_ASSOC );
    $basvuran_array = json_decode( $fetch[ "basvuranlar" ], true );
    $onay_array     = json_decode( $fetch[ "onaylananlar" ], true );
    $red_array      = json_decode( $fetch[ "red_edilenler" ], true );
    $tur            = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tur" ] ) ) );
    if ( $tur == 1 ) {
        if ( isset( $onay_array[ $parcala[ 1 ] ] ) ) {
            $WMform->hata( "Bu başvuruyu daha önceden zaten onaylamışsınız" );
        } else {
            $ekle_array = array(
                 $parcala[ 1 ] => $basvuran_array[ $parcala[ 1 ] ] 
            );
            $yeni_array = array_replace( $ekle_array, $onay_array );
            unset( $basvuran_array[ $parcala[ 1 ] ] );
            $update   = $db->prepare( "UPDATE basvurular SET onaylananlar = ?, basvuranlar = ? WHERE sid = ? && id = ?" );
            $guncelle = $update->execute( array(
                 json_encode( $yeni_array ),
                json_encode( $basvuran_array ),
                $_SESSION[ "server" ],
                $parcala[ 0 ] 
            ) );
            if ( $guncelle ) {
                $WMform->basari( "Kullanıcının başvurusu onaylandı" );
                $WMform->jquery_sil( 'tr#basvuru-' . $parcala[ 2 ] . '' );
                $WMadmin->log_gonder( $fetch[ "konu" ] . " adlı başvuru formunda " . $parcala[ 1 ] . " adlı kullanıcının başvurusu onaylandı" );
                $WMadmin->bildirim_gonder( $parcala[ 1 ], 3, $fetch[ "konu" ] . " adlı başvuru formuna yaptığınız başvuru onaylandı", $fetch[ "id" ] );
            } else {
                $WMform->hata();
            }
        }
    }
    if ( $tur == 2 ) {
        if ( isset( $red_array[ $parcala[ 1 ] ] ) ) {
            $WMform->hata( "Bu başvuruyu daha önceden zaten red edilmiş" );
        } else {
            $ekle_array = array(
                 $parcala[ 1 ] => $basvuran_array[ $parcala[ 1 ] ] 
            );
            $yeni_array = array_replace( $ekle_array, $red_array );
            unset( $basvuran_array[ $parcala[ 1 ] ] );
            $update   = $db->prepare( "UPDATE basvurular SET red_edilenler = ?, basvuranlar = ? WHERE sid = ? && id = ?" );
            $guncelle = $update->execute( array(
                 json_encode( $yeni_array ),
                json_encode( $basvuran_array ),
                $_SESSION[ "server" ],
                $parcala[ 0 ] 
            ) );
            if ( $guncelle ) {
                $WMform->basari( "Kullanıcının başvurusu red edildi" );
                $WMform->jquery_sil( 'tr#basvuru-' . $parcala[ 2 ] . '' );
                $WMadmin->log_gonder( $fetch[ "konu" ] . " adlı başvuru formunda " . $parcala[ 1 ] . " adlı kullanıcının başvurusu red edildi" );
                $WMadmin->bildirim_gonder( $parcala[ 1 ], 3, $fetch[ "konu" ] . " adlı başvuru formuna yaptığınız başvuru red edildi", $fetch[ "id" ] );
            } else {
                $WMform->hata();
            }
        }
    } else if ( $tur == 3 ) {
        if ( isset( $basvuran_array[ $parcala[ 1 ] ] ) ) {
            unset( $basvuran_array[ $parcala[ 1 ] ] );
            $update   = $db->prepare( "UPDATE basvurular SET basvuranlar = ? WHERE sid = ? && id = ?" );
            $guncelle = $update->execute( array(
                 json_encode( $basvuran_array ),
                $_SESSION[ "server" ],
                $parcala[ 0 ] 
            ) );
            if ( $guncelle ) {
                $WMform->basari( $parcala[ 1 ] . " adlı kullanıcının başvurusu başarıyla silindi" );
                $WMform->jquery_sil( 'tr#basvuru-' . $parcala[ 2 ] . '' );
                $WMadmin->log_gonder( $fetch[ "konu" ] . " adlı başvuru formunda " . $parcala[ 1 ] . " adlı kullanıcının başvurusunu sildi." );
            } else {
                $WMform->hata();
            }
        } else {
            $WMform->hata( "Bu başvuru formuna " . $parcala[ 1 ] . " adında bir kullanıcı başvuru yapmamıştır" );
        }
    } else if ( $tur == 4 ) {
        if ( isset( $onay_array[ $parcala[ 1 ] ] ) || @$onay_array[ $parcala[ 1 ] ] == null ) {
            unset( $onay_array[ $parcala[ 1 ] ] );
            $update   = $db->prepare( "UPDATE basvurular SET onaylananlar = ? WHERE sid = ? && id = ?" );
            $guncelle = $update->execute( array(
                 json_encode( $onay_array ),
                $_SESSION[ "server" ],
                $parcala[ 0 ] 
            ) );
            if ( $guncelle ) {
                $WMform->basari( $parcala[ 1 ] . " adlı kullanıcının onaylanan başvurusu başarıyla silindi" );
                $WMform->jquery_sil( 'tr#onayli-' . $parcala[ 2 ] . '' );
                $WMadmin->log_gonder( $fetch[ "konu" ] . " adlı başvuru formunda " . $parcala[ 1 ] . " adlı kullanıcının onaylanan başvurusunu sildi" );
            } else {
                $WMform->hata();
            }
        } else {
            $WMform->hata( $parcala[ 1 ] . " adında kullanıcı onaylanmış başvurularda bulunamadı." );
        }
    } else if ( $tur == 5 ) {
        if ( isset( $red_array[ $parcala[ 1 ] ] ) || @$red_array[ $parcala[ 1 ] ] == null ) {
            unset( $red_array[ $parcala[ 1 ] ] );
            $update   = $db->prepare( "UPDATE basvurular SET red_edilenler = ? WHERE sid = ? && id = ?" );
            $guncelle = $update->execute( array(
                 json_encode( $red_array ),
                $_SESSION[ "server" ],
                $parcala[ 0 ] 
            ) );
            if ( $guncelle ) {
                $WMform->basari( $parcala[ 1 ] . " adlı kullanıcının red edilen başvurusu başarıyla silindi" );
                $WMform->jquery_sil( 'tr#redli-' . $parcala[ 2 ] . '' );
                $WMadmin->log_gonder( $fetch[ "konu" ] . " adlı başvuru formunda " . $parcala[ 1 ] . " adlı kullanıcının red edilen başvurusunu sildi" );
            } else {
                $WMform->hata();
            }
        } else {
            $WMform->hata( $parcala[ 1 ] . " adında kullanıcı red edilen başvurularda bulunamadı." );
        }
    } else if ( $tur == 6 ) {
        if ( isset( $onay_array[ $parcala[ 1 ] ] ) ) {
            if ( isset( $red_array[ $parcala[ 1 ] ] ) ) {
                $WMform->hata( $parcala[ 1 ] . " adlı kullanıcının başvurusu zaten red edilmiş" );
            } else {
                $ekle_array = array(
                     $parcala[ 1 ] => $onay_array[ $parcala[ 1 ] ] 
                );
                $yeni_array = array_replace( $ekle_array, $red_array );
                unset( $onay_array[ $parcala[ 1 ] ] );
                $update   = $db->prepare( "UPDATE basvurular SET onaylananlar = ?, red_edilenler = ? WHERE sid = ? && id = ?" );
                $guncelle = $update->execute( array(
                     json_encode( $onay_array ),
                    json_encode( $yeni_array ),
                    $_SESSION[ "server" ],
                    $parcala[ 0 ] 
                ) );
                if ( $guncelle ) {
                    $WMform->basari( $parcala[ 1 ] . " adlı kullanıcının onaylı başvurusu red edildi" );
                    $WMform->jquery_sil( 'tr#onayli-' . $parcala[ 2 ] . '' );
                    $WMadmin->log_gonder( $fetch[ "konu" ] . " adlı başvuru formunda " . $parcala[ 1 ] . " adlı kullanıcının onaylanan başvurusunu red etti." );
                    $WMadmin->bildirim_gonder( $parcala[ 1 ], 3, $fetch[ "konu" ] . " adlı başvuruda onaylanan başvurunuz, red edildi olarak düzenlenmiştir.", $fetch[ "id" ] );
                } else {
                    $WMform->hata();
                }
            }
        } else {
            $WMform->hata( $parcala[ 1 ] . " adında bir kullanıcının onaylanmış başvurusu yok." );
        }
    } else if ( $tur == 7 ) {
        if ( isset( $red_array[ $parcala[ 1 ] ] ) ) {
            if ( isset( $onay_array[ $parcala[ 1 ] ] ) ) {
                $WMform->hata( $parcala[ 1 ] . " adlı kullanıcının başvurusu zaten onaylanmış" );
            } else {
                $ekle_array = array(
                     $parcala[ 1 ] => $red_array[ $parcala[ 1 ] ] 
                );
                $yeni_array = array_replace( $ekle_array, $onay_array );
                unset( $red_array[ $parcala[ 1 ] ] );
                $update   = $db->prepare( "UPDATE basvurular SET onaylananlar = ?, red_edilenler = ? WHERE sid = ? && id = ?" );
                $guncelle = $update->execute( array(
                     json_encode( $yeni_array ),
                    json_encode( $red_array ),
                    $_SESSION[ "server" ],
                    $parcala[ 0 ] 
                ) );
                if ( $guncelle ) {
                    $WMform->basari( $parcala[ 1 ] . " adlı kullanıcının red edilen başvurusu onaylandı" );
                    $WMform->jquery_sil( 'tr#redli-' . $parcala[ 2 ] . '' );
                    $WMadmin->log_gonder( $fetch[ "konu" ] . " adlı başvuru formunda " . $parcala[ 1 ] . " adlı kullanıcının red edilen başvurusunu onayladı." );
                    $WMadmin->bildirim_gonder( $parcala[ 1 ], 3, $fetch[ "konu" ] . " adlı başvuruda red edilen başvurunuz, onaylandı olarak düzenlenmiştir.", $fetch[ "id" ] );
                } else {
                    $WMform->hata();
                }
            }
        } else {
            $WMform->hata( $parcala[ 1 ] . " adında bir kullanıcının onaylanmış başvurusu yok." );
        }
    }
} else {
    $WMform->hata( "Böyle bir başvuru formu bulunamadı" );
}
?>