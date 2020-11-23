<?php
class duyurular {
   public function head( ) {
      global $vt;
      if ( file_exists( WM_tema . 'sayfalar/duyurular/header.php' ) ) {
         require_once WM_tema . 'sayfalar/duyurular/header.php';
      } else {
         require_once Sayfa_html . 'header.php';
      }
   }
   public function ust( ) {
      global $vt;
      return $vt->a( "isim" ) . ' - Duyurular';
   }
   public function orta( ) {
      global $ayar, $WMkontrol, $vt, $db, $tema, $WMinf;
         if ( $vt->a( "breadcumb" ) == 1 ) {
            if ( file_exists( WM_tema . 'sayfalar/duyurular/breadcumb.php' ) ) {
               require_once WM_tema . 'sayfalar/duyurular/breadcumb.php';
            } else {
               require_once Sayfa_html . 'breadcumb.php';
            }
         }
         $sayfada       = 25;
         $toplam_duyuru = $db->prepare( "SELECT COUNT(id) FROM duyurular WHERE sid = ? ORDER BY id DESC" );
         $toplam_duyuru->execute( array(
             server 
         ) );
		 $toplam_duyuru = $toplam_duyuru->rowCount();
         if ( $toplam_duyuru != 0 ) {
            $toplam_sayfa = ceil( $toplam_duyuru / $sayfada );
            $sayfa        = isset( $_GET[ 'sayfa' ] ) ? (int) $_GET[ 'sayfa' ] : 1;
            if ( $sayfa < 1 ) {
               $sayfa = 1;
            }
            if ( $sayfa > $toplam_sayfa ) {
               $sayfa = $toplam_sayfa;
            }
            $limit = ( $sayfa - 1 ) * $sayfada;
            $query = $db->prepare( "SELECT konu,label,labels,tarih,seo FROM duyurular WHERE sid = ? ORDER BY id DESC LIMIT $limit, $sayfada" );
            $query->execute( array(
                server
            ) );
            if ( file_exists( WM_tema . 'sayfalar/duyurular/duyurular.php' ) ) {
               require_once WM_tema . 'sayfalar/duyurular/duyurular.php';
            } else {
               require_once Sayfa_html . 'duyurular.php';
            }
         } else {
            $tema->uyari( "Duyuru bulunamadı. Ana sayfaya dönmek için <a href='" . $vt->url( 0 ) . "'> tıklayınız. </a>" );
         }
   }
}
?>