<?php
class duyuru_detay {
   private $konu;
   private $icerik;
   public function __construct( ) {
      global $WMkontrol, $vt, $db;
      @$seo = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "seo" ] ) ) );
      $kontrol = $db->prepare( "SELECT * FROM duyurular WHERE seo = ?" );
      $kontrol->execute( array(
          $seo 
      ) );
      if ( $kontrol->rowCount() ) {
         $fetch_duyuru = $kontrol->fetch( PDO::FETCH_ASSOC );
         $this->konu   = $fetch_duyuru[ "konu" ];
         $this->icerik = $fetch_duyuru[ "icerik" ];
      } else {
         $vt->yonlendir( "duyurular" );
      }
   }
   public function head( ) {
      global $vt, $WMkontrol;
      if ( file_exists( WM_tema . 'sayfalar/duyuru_detay/header.php' ) ) {
         require_once WM_tema . 'sayfalar/duyuru_detay/header.php';
      } else {
         require_once Sayfa_html . 'header.php';
      }
   }
   public function ust( ) {
      global $WMinf;
      return $WMinf->kisalt( $this->konu, 35 );
   }
   public function orta( ) {
      global $ayar, $WMkontrol, $vt, $db, $tema, $WMinf;
      @$islem = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "islem" ] ) ) );
      @$isim = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "isim" ] ) ) );
      @$karakter = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "karakter" ] ) ) );
      if ( $vt->a( "breadcumb" ) == 1 ) {
         if ( file_exists( WM_tema . 'sayfalar/duyuru_detay/breadcumb.php' ) ) {
            require_once WM_tema . 'sayfalar/duyuru_detay/breadcumb.php';
         } else {
            require_once Sayfa_html . 'breadcumb.php';
         }
      }
      echo html_entity_decode( $this->icerik );
   }
}
?>