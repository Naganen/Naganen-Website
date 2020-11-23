<?php
class cikis_yap {
   public function head( ) {
      global $vt;
      if ( file_exists( WM_tema . 'sayfalar/cikis_yap/header.php' ) ) {
         require_once WM_tema . 'sayfalar/cikis_yap/header.php';
      } else {
         require_once Sayfa_html . 'header.php';
      }
   }
   public function ust( ) {
      global $vt;
      return 'Çıkış Yapılıyor..';
   }
   public function orta( ) {
      global $vt, $tema;
      unset( $_SESSION[ $vt->a( "isim" ) . "username" ] );
      unset( $_SESSION[ $vt->a( "isim" ) . "userid" ] );
      unset( $_SESSION[ $vt->a( "isim" ) . "token" ] );
      unset( $_SESSION[ $vt->a( "isim" ) . "unuttum_kullanici" ] );
      unset( $_SESSION[ $vt->a( "isim" ) . "unuttum_email" ] );
      $tema->uyari( "Çıkış yapılıyor.." );
      echo '<meta http-equiv="refresh" content="2;URL=' . $vt->url( 4 ) . '">';
   }
}
?>