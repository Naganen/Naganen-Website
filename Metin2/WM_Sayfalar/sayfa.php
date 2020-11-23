<?php
class sayfa {
    private $konu;
    private $icerik;
    public function __construct( ) {
        global $ayar, $WMkontrol, $vt, $db, $tema, $WMinf;
        @$seo = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "seo" ] ) ) );
        $kontrol = $db->prepare( "SELECT * FROM sayfalar WHERE seo = ?" );
        $kontrol->execute( array(
             $seo 
        ) );
        if ( $kontrol->rowCount() ) {
            $fetch_sayfa  = $kontrol->fetch( PDO::FETCH_ASSOC );
            $this->konu   = $fetch_sayfa[ "konu" ];
            $this->icerik = $fetch_sayfa[ "icerik" ];
        } else {
            $vt->yonlendir( "anasayfa" );
        }
    }
    public function head( ) {
        global $vt, $WMkontrol;
        if ( file_exists( WM_tema . 'sayfalar/sayfa/header.php' ) ) {
            require_once WM_tema . 'sayfalar/sayfa/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt, $WMinf;
        return $WMinf->kisalt( $this->konu, 35 );
    }
    public function orta( ) {
        global $ayar, $WMkontrol, $vt, $db, $tema, $WMinf;
        if ( $vt->a( "breadcumb" ) == 1 ) {
            if ( file_exists( WM_tema . 'sayfalar/sayfa/breadcumb.php' ) ) {
                require_once WM_tema . 'sayfalar/sayfa/breadcumb.php';
            } else {
                require_once Sayfa_html . 'breadcumb.php';
            }
        }
        if ( file_exists( WM_tema . 'sayfalar/sayfa/sayfa.php' ) ) {
            require_once WM_tema . 'sayfalar/sayfa/sayfa.php';
        } else {
            require_once Sayfa_html . 'sayfa.php';
        }
    }
}
?>