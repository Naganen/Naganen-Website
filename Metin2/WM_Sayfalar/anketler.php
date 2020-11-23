<?php
class anketler {
   public function head( ) {
      global $vt;
      if ( file_exists( WM_tema . 'sayfalar/anketler/header.php' ) ) {
         require_once WM_tema . 'sayfalar/anketler/header.php';
      } else {
         require_once Sayfa_html . 'header.php';
      }
   }
   public function ust( ) {
      global $vt;
      return 'Anketler';
   }
   public function orta( ) {
      global $tema, $vt;
         $tema->hata( "Tüm anketler ana sayfada gözükmektedir" );
         $tema->uyari( "Yönlendiriliyorsunuz" );
         echo '<meta http-equiv="refresh" content="2;URL=' . $vt->url( 0 ) . '">';
   }
}
?>