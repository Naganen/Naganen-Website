<?php
class indir {
   public function head( ) {
      global $vt;
      if ( file_exists( WM_tema . 'sayfalar/indir/header.php' ) ) {
         require_once WM_tema . 'sayfalar/indir/header.php';
      } else {
         require_once Sayfa_html . 'header.php';
      }
   }
   public function ust( ) {
      global $vt;
      return $vt->a( "isim" ) . ' - İndir';
   }
   public function orta( ) {
      global $vt, $db, $tema;
         $pack_sec = $db->prepare( "SELECT * FROM packlar WHERE sid = ? ORDER BY sira" );
         $pack_sec->execute( array(
             server 
         ) );
         echo html_entity_decode( $vt->a( "pack_aciklama" ) );
         if ( file_exists( WM_tema . 'sayfalar/indir/indir.php' ) ) {
            require_once WM_tema . 'sayfalar/indir/indir.php';
         } else {
            require_once Sayfa_html . 'indir.php';
         }
   }
}
?>