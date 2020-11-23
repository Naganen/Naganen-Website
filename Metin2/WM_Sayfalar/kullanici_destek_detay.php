<?php
class kullanici_destek_detay {
    private $konu;
    private $icerik;
    public function __construct( ) {
        global $ayar, $WMkontrol, $vt, $db, $tema, $WMinf, $fetch;
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
        $kontrol = $db->prepare( "SELECT * FROM destek WHERE id = ? && sid = ? && acan = ?" );
        $kontrol->execute( array(
             $id,
            server,
			$_SESSION[ $vt->a( "isim" ) . "username" ]
        ) );
        if ( $kontrol->rowCount() ) {
            $fetch        = $kontrol->fetch( PDO::FETCH_ASSOC );
            $this->konu   = $fetch[ "konu" ];
            $this->icerik = html_entity_decode( nl2br( strip_tags( htmlspecialchars( $fetch[ "icerik" ] ), "<br />" ) ) );
        } else {
            $vt->yonlendir( $vt->url( 7 ) );
        }
    }
    public function head( ) {
        global $vt, $WMkontrol;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_destek_detay/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_destek_detay/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt, $WMinf;
        return $WMinf->kisalt( $this->konu, 35 );
    }
    public function orta( ) {
        global $ayar, $WMkontrol, $vt, $db, $tema, $WMinf, $fetch, $WMclass;
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
        @$sayfa = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "sayfa" ] ) ) );
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( $vt->url( 4 ) );
        } else {
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici_destek_detay/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_destek_detay/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            if ( file_exists( WM_tema . 'sayfalar/kullanici_destek_detay/destek_ust.php' ) ) {
                require_once WM_tema . 'sayfalar/kullanici_destek_detay/destek_ust.php';
            } else {
                require_once Sayfa_html . 'destek_ust.php';
            }
            if ( file_exists( WM_tema . 'sayfalar/kullanici_destek_detay/destek_detay.php' ) ) {
                require_once WM_tema . 'sayfalar/kullanici_destek_detay/destek_detay.php';
            } else {
                require_once Sayfa_html . 'destek_detay.php';
            }
            if ( isset( $_POST[ "cevap_gonder" ] ) ) {
                $cevap      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "cevap" ] ) ) );
                $crsf_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "crsf_token" ] ) ) );
                if ( !$crsf_token ) {
                    $tema->hata( "Token Yok" );
                } else if ( $ayar->sessionid != $crsf_token ) {
                    $tema->hata( "Token Hatası" );
                } else if ( !$cevap ) {
                    $tema->hata( "Cevabı boş bırakamazsınız" );
                } else {
                    $ekle = $db->prepare( "INSERT INTO destek_cevap SET tid = ?, sid = ?, ckisi = ?, cevap = ?, cevaplayan = ?, tarih = ?" );
                    $ekle->execute( array(
                         $id,
                        server,
                        1,
                        $cevap,
						$_SESSION[ $vt->a( "isim" ) . "username" ],
                        date( "Y-m-d H:i:s" ) 
                    ) );
                    if ( $ekle->errorInfo()[2] == false  ) {
                        if ( $vt->a( "destek_mail" ) == 1 ) {
                            $mail_icerik = array('destek', $vt->a( "isim" ), $_SESSION[ $vt->a( "isim" ) . "username" ], $this->konu);
							$gonder      = $vt->mail_gonder( $WMclass->ayar( "admin_mail" ), "Destek Talebine Cevap Geldi", $mail_icerik );
                            if ( !$gonder ) {
                            }
                        }
                        $guncelle = $db->prepare( "UPDATE destek SET durum = ? WHERE id = ? && sid = ?" );
                        $guncelle->execute( array(
                             2,
                            $id,
                            server 
                        ) );
                        $vt->yonlendir( "kullanici/teknik-destek-detay?id=" . $id . "&sayfa=" . $toplam_sayfa );
                    } else {
                        $tema->hata( "Sistem hatası" );
                    }
                }
            }
            if ( file_exists( WM_tema . 'sayfalar/kullanici_destek_detay/cevap_yaz.php' ) ) {
                require_once WM_tema . 'sayfalar/kullanici_destek_detay/cevap_yaz.php';
            } else {
                require_once Sayfa_html . 'cevap_yaz.php';
            }
        }
    }
}
?>