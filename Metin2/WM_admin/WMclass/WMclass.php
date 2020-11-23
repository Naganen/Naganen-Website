<?php
class WMadmin {
    public function serverbilgi( $deger ) {
        global $db;
        $id    = $this->admin( "server" );
        $query = $db->prepare( "SELECT * FROM server WHERE id = ?" );
        $query->execute( array(
             $id 
        ) );
        $query = $query->fetch();
        return $query[ $deger ];
    }
    public function ayarlar( $deger ) {
        global $db;
        $query = $db->prepare( "SELECT * FROM ayarlar" );
        $query->execute();
        $query = $query->fetch();
        return $query[ $deger ];
    }
    public function admin( $deger, $id = false ) {
        global $db;
        if ( $id == false ) {
            $id2 = 1;
        } else {
            $id2 = $id;
        }
        $query = $db->prepare( "SELECT * FROM users WHERE id = ?" );
        $query->execute( array(
             $id2 
        ) );
        $query = $query->fetch();
        return $query[ $deger ];
    }
    public function item_bul( $id ) {
        $oku  = file_get_contents( "WMitems.txt" );
        $kes  = explode( '"' . $id . '"', $oku );
        $kes2 = explode( ",", $kes[ 1 ] );
        $kes3 = explode( '"', $kes2[ 1 ] );
        return $kes3[ 1 ];
    }
    public function yonlendir( $nereye ) {
?>
	<SCRIPT LANGUAGE="JavaScript">
	<!-- 
	window.location="<?= $nereye; ?>";
	// -->
	</script>

	<?php
    }
    public function bildirim_okundu( $id ) {
        global $db;
        $update   = $db->prepare( "UPDATE bildirim SET durum = ? WHERE sid = ? && id = ?" );
        $guncelle = $update->execute( array(
             2,
            $_SESSION[ "server" ],
            $id 
        ) );
    }
    public function uye( $turr = 1, $name, $cek ) {
        global $odb;
        $sorgulancak = substr( $name, 1 );
        $tur         = substr( $name, 0, 1 );
        if ( $tur == 1 ) {
            if ( $turr == 1 ) {
                $query = $odb->prepare( "SELECT $cek FROM account WHERE login = ? " );
                $query->execute( array(
                     $sorgulancak 
                ) );
            } else {
                $query = $odb->prepare( "SELECT $cek FROM account WHERE id = ? " );
                $query->execute( array(
                     $sorgulancak 
                ) );
            }
        } else if ( $tur == 2 ) {
            $query = $odb->prepare( "SELECT account.$cek FROM player.player LEFT JOIN account.account ON account.id = player.account_id WHERE name = ?" );
            $query->execute( array(
                 $sorgulancak 
            ) );
        }
        $fetch = $query->fetch( PDO::FETCH_ASSOC );
        return $fetch[ $cek ];
    }
    public function bildirim_gonder( $alan, $tur, $bildirim, $olay_yeri, $alici_tur = 1 ) {
        global $db;
        $insert = $db->prepare( "INSERT INTO bildirim SET sid = ?, alan = ?, tur = ?, bildirim = ?, olay_yeri = ?, durum = ?, tarih = ?, alici_tur = ?" );
        $ekle   = $insert->execute( array(
             $_SESSION[ "server" ],
            $alan,
            $tur,
            $bildirim,
            $olay_yeri,
            1,
            date( "Y-m-d H:i:s" ),
            $alici_tur 
        ) );
    }
    public function karakter( $isim, $deger, $tur = 1 ) {
        global $odb;
        if ( $tur == 1 ) {
            $query = $odb->prepare( "SELECT $deger FROM player.player WHERE name = ?" );
            $query->execute( array(
                 $isim 
            ) );
            $query = $query->fetch( PDO::FETCH_ASSOC );
        } else {
            $query = $odb->prepare( "SELECT $deger FROM player.player WHERE id = ?" );
            $query->execute( array(
                 $isim 
            ) );
            $query = $query->fetch();
        }
        return $query[ $deger ];
    }
    public function kullanici( $id, $deger, $tur = 1 ) {
        global $odb;
        if ( $tur == 1 ) {
            $query = $odb->prepare( "SELECT $deger FROM account WHERE id = ?" );
            $query->execute( array(
                 $id 
            ) );
            $query = $query->fetch( PDO::FETCH_ASSOC );
        } else {
            $query = $odb->prepare( "SELECT $deger FROM account WHERE login = ?" );
            $query->execute( array(
                 $id 
            ) );
            $query = $query->fetch( PDO::FETCH_ASSOC );
        }
        return $query[ $deger ];
    }
    public function mail_gonder( $kime, $konu, $icerik ) {
        global $mail, $WMclass;
        $this->mail_tema_varmi = "../WM_theme/WM_mail/" . $this->serverbilgi( "mail_tema" );
        if ( file_exists( $this->mail_tema_varmi ) ) {
            $this->mail_tema = "../WM_theme/WM_mail/" . $this->serverbilgi( "mail_tema" ) . "/";
        } else {
            $this->mail_tema = "../WM_theme/WM_mail/default/";
        }
        require '../' . WM_Plugins_lib . 'WM_smtp/class.phpmailer.php';
        require $this->mail_tema . 'index.php';
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPDebug  = false;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = $WMclass->ayar( "mail_secure" );
        $mail->Host       = $WMclass->ayar( "mail_host" );
        $mail->Port       = $WMclass->ayar( "mail_port" );
        $mail->IsHTML( true );
        $mail->SetLanguage( "tr", "phpmailer/language" );
        $mail->CharSet  = "utf-8";
        $mail->Username = $WMclass->ayar( "mail_user" );
        $mail->Password = $WMclass->ayar( "mail_pass" );
        $mail->SetFrom( $WMclass->ayar( "mail_profil" ), $WMclass->ayar( "mail_isim" ) );
        $mail->AddAddress( $kime );
        $mail->Subject = $konu;
        $mail->Body    = mail_icerik( $icerik );
        return $mail->send();
    }
    public function yonetici( $deger ) {
        global $db;
        $query = $db->prepare( "SELECT * FROM users WHERE id = ? && username = ?" );
        $query->execute( array(
             $_SESSION[ "adminid" ],
            $_SESSION[ "adminisim" ] 
        ) );
        $query = $query->fetch();
        return $query[ $deger ];
    }
    public function log_gonder( $log, $tur = 1, $aciklama = "" ) {
        if ( !isset( $_SESSION[ "server" ] ) || !isset( $_SESSION[ "adminisim" ] ) ) {
            session_start();
        }
        global $db;
        if ( $this->serverbilgi( "log" ) == 1 ) {
            $insert = $db->prepare( "INSERT INTO log SET sid = ?, tur = ?, yapan = ?, log = ?, icerik = ?, tarih = ?" );
            $ekle   = $insert->execute( array(
                 $_SESSION[ "server" ],
                $tur,
                $_SESSION[ "adminisim" ],
                $log,
                $aciklama,
                date( "Y-m-d H:i:s" ) 
            ) );
        }
    }
}
?>