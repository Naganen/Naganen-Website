<?php
class kullanici_teknik_destek {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_teknik_destek/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_teknik_destek/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Destek Talepleri';
    }
    public function orta( ) {
        global $ayar, $WMkontrol, $vt, $db, $tema, $WMinf;
        if ( isset( $_SESSION[ $vt->a( "isim" ) . "username" ] ) ) {
            if ( $vt->a( "breadcumb" ) == 1 ) {
                if ( file_exists( WM_tema . 'sayfalar/kullanici_teknik_destek/breadcumb.php' ) ) {
                    require_once WM_tema . 'sayfalar/kullanici_teknik_destek/breadcumb.php';
                } else {
                    require_once Sayfa_html . 'breadcumb.php';
                }
            }
            $sayfada      = 25;
            $toplam_talep = $db->prepare( "SELECT * FROM destek WHERE sid = ? && acan = ?" );
            $toplam_talep->execute( array(
                 server,
                $_SESSION[ $vt->a( "isim" ) . "username" ] 
            ) );
            $toplam_talep = $toplam_talep->rowCount();
            $toplam_sayfa = ceil( $toplam_talep / $sayfada );
            $sayfa        = isset( $_GET[ 'sayfa' ] ) ? (int) $_GET[ 'sayfa' ] : 1;
            if ( $sayfa < 1 ) {
                $sayfa = 1;
            }
            if ( $sayfa > $toplam_sayfa ) {
                $sayfa = $toplam_sayfa;
            }
            $limit = ( $sayfa - 1 ) * $sayfada;
            $query = $db->prepare( "SELECT destek.*,destek_kategori.isim AS kategori FROM destek LEFT JOIN destek_kategori ON destek.kid = destek_kategori.id  
	WHERE destek.sid = ? && destek.acan = ?
	ORDER BY id DESC
	LIMIT $limit, $sayfada" );
            $query->execute( array(
                 server,
                $_SESSION[ $vt->a( "isim" ) . "username" ]
            ) );
            if ( file_exists( WM_tema . 'sayfalar/kullanici_teknik_destek/destek.php' ) ) {
                require_once WM_tema . 'sayfalar/kullanici_teknik_destek/destek.php';
            } else {
                require_once Sayfa_html . 'destek.php';
            }
        } else {
            $tema->hata( "Kullanıcı girişi yapmadan teknik destek talebi oluşturamazsınız" );
            $tema->uyari( "Giriş Yapmak İçin <a href='" . $vt->url( 4 ) . "'> Tıklayın </a> " );
        }
    }
}
?>