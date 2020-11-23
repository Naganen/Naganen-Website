<?php
class kullanici_ep_gonder_sifre_unuttum {
    public function head( ) {
        global $vt;
        if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_unuttum/header.php' ) ) {
            require_once WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_unuttum/header.php';
        } else {
            require_once Sayfa_html . 'header.php';
        }
    }
    public function ust( ) {
        global $vt;
        return 'Ep Transfer Şifremi Unuttum';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        @$select = $db->prepare( "SELECT id FROM eptransfer_log LIMIT 1" );
        @$select->execute( );
        @$select2 = $odb->prepare( "SELECT edurum, epass FROM account LIMIT 1" );
        @$select2->execute( );
        if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
            $vt->yonlendir( $vt->url( 4 ) );
        } else if ( $select->errorInfo()[2] != false || $select2->errorInfo()[2] != false ) {
            $vt->yonlendir( $vt->url( 5 ) );
        } else if ( $vt->uye( "edurum" ) == 2 ) {
            $vt->yonlendir( $vt->url( 5 ) );
        } else {
            $eptransfer = explode( ',', $vt->a( "eptransfer" ) );
            if ( $eptransfer[ 0 ] == 1 && $eptransfer[ 3 ] == 1 && $eptransfer[ 1 ] == 1 ) {
                if ( $vt->a( "breadcumb" ) == 1 ) {
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_unuttum/breadcumb.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_unuttum/breadcumb.php';
                    } else {
                        require_once Sayfa_html . 'breadcumb.php';
                    }
                }
                if ( isset( $_POST[ "sifre_degistir" ] ) ) {
                    $random   = substr( str_shuffle( "abcdefghkl0123456789" ), 0, 7 );
                    $guncelle   = $odb->prepare( "UPDATE account SET epass = ? WHERE id = ? && login = ?" );
                    $guncelle->execute( array(
                         $random,
                        $_SESSION[ $vt->a( "isim" ) . "userid" ],
                        $_SESSION[ $vt->a( "isim" ) . "username" ] 
                    ) );
                    if ( $guncelle->errorInfo()[2] == false ) {
                        $log_send    = $db->prepare( "INSERT INTO eptransfer_log SET sid = ?, tur = ?, gonderen = ?, tarih = ?" );
                        $log_gonder  = $log_send->execute( array(
                             server,
                            2,
                            $_SESSION[ $vt->a( "isim" ) . "username" ],
                            date( "Y-m-d H:i:s" ) 
                        ) );
							$mail_icerik = array('ep_transfer_sifre_unuttum', $_SESSION[ $vt->a( "isim" ) . "username" ], $random );							
                        $gonder      = $vt->mail_gonder( $vt->uye( "email" ), "Ep Transfer Şifresi Değiştirildi", $mail_icerik );
                        if ( $gonder ) {
                            $tema->basari( "Şifreniz Başarıyla Değiştirildi" );
                        } else {
                            $tema->uyari( "Şifreniz Değiştirildi. Fakat mail gönderemedik. Bu hatayı en kısa süre içerisinde düzelteceğiz." );
                        }
                    } else {
                        $tema->hata( "Sistem hatası" );
                    }
                } else {
                    if ( file_exists( WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_unuttum/sifre_gonder.php' ) ) {
                        require_once WM_tema . 'sayfalar/kullanici_ep_gonder_sifre_unuttum/sifre_gonder.php';
                    } else {
                        require_once Sayfa_html . 'sifre_gonder.php';
                    }
                }
            } else {
                $vt->yonlendir( $vt->url( 5 ) );
            }
        }
    }
}
?>