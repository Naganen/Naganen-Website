<?php
class index {
   public function head( ) {
      global $vt, $page, $sayfa_html_index;
      if ( !$page ) {
         $sayfa_html_index = Sayfa_html . 'index/';
         if ( file_exists( WM_tema . 'sayfalar/index/header.php' ) ) {
            require_once WM_tema . 'sayfalar/index/header.php';
         } else {
            require_once Sayfa_html . 'index/header.php';
         }
      } else {
         $sayfa_html_index = Sayfa_html;
         if ( file_exists( WM_tema . 'sayfalar/index/header.php' ) ) {
            require_once WM_tema . 'sayfalar/index/header.php';
         } else {
            require_once Sayfa_html . 'header.php';
         }
      }
   }
   public function ust( ) {
      global $vt;
      return $vt->a( "isim" );
   }
   public function orta( ) {
      global $ayar, $vt, $odb, $db, $WMinf, $tema, $WMkontrol, $sayfa_html_index;
         $kral = explode( ',', $vt->a( "krallar" ) );
         if ( $kral[ 0 ] != '' || $kral[ 1 ] != '' ) {
            if ( file_exists( WM_tema . 'sayfalar/index/krallar.php' ) ) {
               require_once WM_tema . 'sayfalar/index/krallar.php';
            } else {
               require_once $sayfa_html_index . 'krallar.php';
            }
         }
         if ( $tema->ayar_server( 4 ) == 1 ) {
            function lonca_isim( $lonca_id ) {
               global $odb;
               $query = $odb->prepare( "SELECT name FROM player.guild WHERE id = ?" );
               $query->execute( array(
                   $lonca_id 
               ) );
               if ( $query->rowCount() ) {
                  $fetch = $query->fetch( PDO::FETCH_ASSOC );
                  return $fetch[ "name" ];
               } else {
                  return 'HATALI ID';
               }
            }
            function savas_durum( $result1, $result2, $isim1, $isim2 ) {
               if ( $result1 == $result2 ) {
                  return 'Berabere bitmiştir.';
               } else if ( $result1 > $result2 ) {
                  return 'Galibi <b>' . $isim1 . '</b> olmuştur.';
               } else if ( $result2 > $result1 ) {
                  return 'Galibi <b>' . $isim2 . '</b> olmuştur.';
               } else {
                  return 'Sonuçlanmadı';
               }
            }
            $select = $odb->prepare( "SELECT id FROM player.guild_war_reservation LIMIT 1" );
            $select->execute();
            if ( $select ) {
               $son_savas = $odb->prepare( "SELECT guild1, guild2, result1, result2 FROM player.guild_war_reservation ORDER BY id DESC" );
               $son_savas->execute();
               $fetch_savas = $son_savas->fetch( PDO::FETCH_ASSOC );
               $lonca1      = lonca_isim( $fetch_savas[ "guild1" ] );
               $lonca2      = lonca_isim( $fetch_savas[ "guild2" ] );
               $result1     = $fetch_savas[ "result1" ];
               $result2     = $fetch_savas[ "result2" ];
               if ( file_exists( WM_tema . 'sayfalar/index/lonca_savasi.php' ) ) {
                  require_once WM_tema . 'sayfalar/index/lonca_savasi.php';
               } else {
                  require_once $sayfa_html_index . 'lonca_savasi.php';
               }
            } else {
               echo "Sistem yok";
            }
         }
         $anket_kontrol = $db->prepare( "SELECT * FROM anketler WHERE sid = ? && tur = ?" );
         $anket_kontrol->execute( array(
             server,
            1 
         ) );
         if ( $anket_kontrol->rowCount() ) {
            $fetch_anket = $anket_kontrol->fetch( PDO::FETCH_ASSOC );
            $onay        = explode( ',', $fetch_anket[ "onay" ] );
            $red         = explode( ',', $fetch_anket[ "red" ] );
            if ( !$fetch_anket[ "onay" ] ) {
               $onayli = 0;
            } else {
               $onayli = count( $onay );
            }
            if ( !$fetch_anket[ "red" ] ) {
               $redli = 0;
            } else {
               $redli = count( $red );
            }
            @$oy = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "oy" ] ) ) );
            if ( $oy == "evet" ) {
               if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
                  $tema->hata( "Önce giriş yapmalısınız.." );
               } else if ( in_array( $_SESSION[ $vt->a( "isim" ) . "username" ], $onay ) || in_array( $_SESSION[ $vt->a( "isim" ) . "username" ], $red ) ) {
                  $tema->hata( "Daha önceden oy vermişssiniz" );
               } else {
                  if ( !$fetch_anket[ "onay" ] ) {
                     $onay_olcak = $_SESSION[ $vt->a( "isim" ) . "username" ];
                  } else {
                     $onay_olcak = $fetch_anket[ "onay" ] . ',' . $_SESSION[ $vt->a( "isim" ) . "username" ];
                  }
                  $update   = $db->prepare( "UPDATE anketler SET onay = ? WHERE sid = ? && token = ? && id = ? " );
                  $guncelle = $update->execute( array(
                      $onay_olcak,
                     server,
                     $fetch_anket[ "token" ],
                     $fetch_anket[ "id" ] 
                  ) );
                  if ( !$guncelle ) {
                     $tema->hata( "Sistem hatası" );
                  } else {
                     $vt->yonlendir( $vt->url( 0 ) );
                  }
               }
            } else if ( $oy == "hayir" ) {
               if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
                  $tema->hata( "Önce giriş yapmalısınız.." );
               } else if ( in_array( $_SESSION[ $vt->a( "isim" ) . "username" ], $onay ) || in_array( $_SESSION[ $vt->a( "isim" ) . "username" ], $red ) ) {
                  $tema->hata( "Daha önceden oy vermişssiniz" );
               } else {
                  if ( !$fetch_anket[ "red" ] ) {
                     $red_olcak = $_SESSION[ $vt->a( "isim" ) . "username" ];
                  } else {
                     $red_olcak = $fetch_anket[ "red" ] . ',' . $_SESSION[ $vt->a( "isim" ) . "username" ];
                  }
                  $update   = $db->prepare( "UPDATE anketler SET red = ? WHERE sid = ? && token = ? && id = ? " );
                  $guncelle = $update->execute( array(
                      $red_olcak,
                     server,
                     $fetch_anket[ "token" ],
                     $fetch_anket[ "id" ] 
                  ) );
                  if ( !$guncelle ) {
                     $tema->hata( "Sistem hatası" );
                  } else {
                     $vt->yonlendir( $vt->url( 0 ) );
                  }
               }
            }
            if ( file_exists( WM_tema . 'sayfalar/index/anket_anasayfa.php' ) ) {
               require_once WM_tema . 'sayfalar/index/anket_anasayfa.php';
            } else {
               require_once $sayfa_html_index . 'anket_anasayfa.php';
            }
         }
         if ( file_exists( WM_tema . 'sayfalar/index/duyurular.php' ) ) {
            require_once WM_tema . 'sayfalar/index/duyurular.php';
         } else {
            require_once $sayfa_html_index . 'duyurular.php';
         }
         if ( file_exists( WM_tema . 'sayfalar/index/anketler.php' ) ) {
            require_once WM_tema . 'sayfalar/index/anketler.php';
         } else {
            require_once $sayfa_html_index . 'anketler.php';
         }
         if ( $vt->sosyal( 3 ) != '' ) {
            if ( file_exists( WM_tema . 'sayfalar/index/tanitim_video.php' ) ) {
               require_once WM_tema . 'sayfalar/index/tanitim_video.php';
            } else {
               require_once $sayfa_html_index . 'tanitim_video.php';
            }
         }
         if ( $vt->sosyal( 0 ) != '' ) {
            if ( file_exists( WM_tema . 'sayfalar/index/facebook.php' ) ) {
               require_once WM_tema . 'sayfalar/index/facebook.php';
            } else {
               require_once $sayfa_html_index . 'facebook.php';
            }
         }
         printf( '<div style="clear:both;"></div>' );
   }
}
?>