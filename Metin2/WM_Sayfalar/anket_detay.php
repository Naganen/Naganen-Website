<?php
class anket_detay {
   private $konu;
   public function __construct( ) {
      global $WMkontrol, $vt, $db, $tema, $WMinf, $fetch_anket;
      @$seo = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "seo" ] ) ) );
      $kontrol = $db->prepare( "SELECT * FROM anketler WHERE seo = ?" );
      $kontrol->execute( array(
          $seo 
      ) );
      if ( $kontrol->rowCount() ) {
         $fetch_anket = $kontrol->fetch( PDO::FETCH_ASSOC );
         $this->konu  = $fetch_anket[ "konu" ];
      } else {
         $vt->yonlendir( $vt->url( 0 ) );
      }
   }
   public function head( ) {
      global $vt, $WMkontrol;
      if ( file_exists( WM_tema . 'sayfalar/anket_detay/header.php' ) ) {
         require_once WM_tema . 'sayfalar/anket_detay/header.php';
      } else {
         require_once Sayfa_html . 'header.php';
      }
   }
   public function ust( ) {
      global $vt, $WMinf;
      return $WMinf->kisalt( $this->konu, 35 );
   }
   public function orta( ) {
      global $vt, $WMinf, $fetch_anket, $WMkontrol, $db, $tema;
      if ( file_exists( WM_tema . 'sayfalar/anket_detay/anket.php' ) ) {
         require_once WM_tema . 'sayfalar/anket_detay/anket.php';
      } else {
         require_once Sayfa_html . 'anket.php';
      }
      $secenekler = explode( ',', $fetch_anket[ "secenekler" ] );
      $oylar      = json_decode( $fetch_anket[ "onay" ] );
      @$oyla = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "oyla" ] ) ) );
      @$oyum = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "oy" ] ) ) );
      if ( $oyla != '' ) {
         if ( isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            if ( $vt->zaman_bittimi( $fetch_anket[ "bitis_tarih" ] ) && $fetch_anket[ "bitis_tarih" ] != '' ) {
               printf( '<center>
' . $tema->hata( "Anket Süresi bittiği için işleminizi gerçekleştiremiyoruz. " ) . '
</center>' );
            } else {
               if ( isset( $secenekler[ $oyla ] ) ) {
                  $hatalar = array( );
                  try {
                     for ( $i = 0; $i <= count( $oylar ); $i++ ) {
                        foreach ( $oylar as $oys[ $i ] ) {
                           $oy_coz = json_decode( $oys[ $i ] );
                           if ( @in_array( $_SESSION[ $vt->a( "isim" ) . "username" ], $oy_coz ) ) {
                              throw new Exception( 'Ankete Zaten Oy Vermişssiniz. Verdiğiniz oyu geri çekip başka bir seçeneğe oy verebilirsiniz' );
                           }
                        }
                     }
                  }
                  catch ( Exception $e ) {
                     $hatalar[ ] = $e->getMessage();
                  }
                  if ( $oyum == "ver" ) {
                     if ( count( $hatalar ) > 0 ) {
                        printf( '<center>
' . $tema->hata( "Zaten Oy Vermişsiniz. " ) . '
</center>' );
                     } else {
                        $eklencek_oy  = $oylar[ $oyla ];
                        $eklencek_oyy = json_decode( $oylar[ $oyla ] );
                        array_push( $eklencek_oyy, $_SESSION[ $vt->a( "isim" ) . "username" ] );
                        $degisilcek = str_replace( $oylar[ $oyla ], json_encode( $eklencek_oyy ), $oylar[ $oyla ] );
                        $ekle_oy    = array(
                            $oyla => $degisilcek 
                        );
                        $degistir   = array_replace( $oylar, $ekle_oy );
                        $guncelle     = $db->prepare( "UPDATE anketler SET onay = ? WHERE sid = ? && seo = ? && id = ?" );
                        $guncelle->execute( array(
                            json_encode( $degistir ),
                           server,
                           $fetch_anket[ "seo" ],
                           $fetch_anket[ "id" ] 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false  ) {
                           $vt->yonlendir( "anket/" . $fetch_anket[ "seo" ] . '.html' );
                        } else {
                           echo "Sistem Hatası";
                        }
                     }
                  } else if ( $oyum == "vazgec" ) {
                     if ( count( $hatalar ) == 0 ) {
                        $tema->hata( "Ankette hiç bır şıkkı oylamamışsınız vazgeçilemiyor. !" );
                        $degisilcek = str_replace( $oylar[ $oyla ], json_encode( $eklencek_oyy ), $oylar[ $oyla ] );
                     } else {
                        $silincek_array     = json_decode( $oylar[ $oyla ] );
                        $silincek_dizin_bul = array_search( $_SESSION[ $vt->a( "isim" ) . "username" ], $silincek_array );
                        unset( $silincek_array[ $silincek_dizin_bul ] );
                        $degis_sil = str_replace( $oylar[ $oyla ], json_encode( $silincek_array ), $oylar[ $oyla ] );
                        $sil_oy    = array(
                            $oyla => $degis_sil 
                        );
                        $degistir  = array_replace( $oylar, $sil_oy );
                        $guncelle    = $db->prepare( "UPDATE anketler SET onay = ? WHERE sid = ? && seo = ? && id = ?" );
                        $guncelle->execute( array(
                            json_encode( $degistir ),
                           server,
                           $fetch_anket[ "seo" ],
                           $fetch_anket[ "id" ] 
                        ) );
                        if ( $guncelle->errorInfo()[2] == false ) {
                           $vt->yonlendir( 'anket/' . $fetch_anket[ "seo" ] . '.html' );
                        } else {
                           $tema->hata( "Sistem Hatası" );
                        }
                     }
                  }
               }
            }
         } else {
            if ( file_exists( WM_tema . 'sayfalar/anket_detay/hata.php' ) ) {
               require_once WM_tema . 'sayfalar/anket_detay/hata.php';
            } else {
               require_once Sayfa_html . 'hata.php';
            }
         }
      }
      if ( file_exists( WM_tema . 'sayfalar/anket_detay/anket_detay.php' ) ) {
         require_once WM_tema . 'sayfalar/anket_detay/anket_detay.php';
      } else {
         require_once Sayfa_html . 'anket_detay.php';
      }
   }
}
?>