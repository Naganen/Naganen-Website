<?php
class kayit_onay {
    public function head( ) {
        global $vt;
        require_once Sayfa_html . 'header.php';
    }
    public function ust( ) {
        global $vt;
        return $vt->a( "isim" ) . ' - Kayıt Onaylama';
    }
    public function orta( ) {
        global $ayar, $odb, $WMkontrol, $vt, $db, $tema;
        @$token = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "token" ] ) ) );
        @$user = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "user" ] ) ) );
        $kontrol = $db->prepare( "SELECT token,login FROM token WHERE login = ? && token = ? && sid = ?" );
        $kontrol->execute( array(
             $user,
            $token,
            server 
        ) );
        if ( $kontrol->rowCount() ) {
            $guncelle = $odb->prepare( "UPDATE account SET email_onay = ? WHERE login = ?" );
            $guncelle->execute( array(
                 0,
                $user 
            ) );
            if ( $guncelle->errorInfo()[2] == false  ) {
                $token_sil = $db->prepare( "DELETE FROM token WHERE tur = ? && sid = ? && login = ?" );
                $token_sil->execute( array(
                     1,
                    server,
                    $user 
                ) );
                $tema->basari( "Hesabınızı başarıyla onayladınız. !" );
            }
        } else {
            $tema->hata( "Onaylama Geçersiz" );
        }
    }
}
?>