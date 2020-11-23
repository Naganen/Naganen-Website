<?php
class giris_yap {
   public function head( ) {
      global $vt;
      if ( file_exists( WM_tema . 'sayfalar/giris_yap/header.php' ) ) {
         require_once WM_tema . 'sayfalar/giris_yap/header.php';
      } else {
         require_once Sayfa_html . 'header.php';
      }
   }
   public function ust( ) {
      global $vt;
      return $vt->a( "isim" ) . ' - Giriş Yap';
   }
   public function orta( ) {
      global $odb, $vt, $ayar, $WMkontrol, $tema;
      if ( !isset( $_SESSION[ $vt->a( "isim" ) . "token" ] ) ) {
         @$onay_gonder = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "onay_gonder" ] ) ) );
         if ( $onay_gonder == 1 && isset( $_SESSION[ "hesap_onay" ] ) ) {
            $token       = $ayar->token_rastgele;
            $vt->token_ekle( 1, $_SESSION[ "hesap_onay" ], $token );
			$mail_icerik = array('kayit_onay', $_SESSION[ "hesap_onay" ], 
			$vt->a( "link" ) . 'kayit_onay?token=' . $token . '&user=' . $_SESSION[ "hesap_onay" ]
			);
            $gonder = $vt->mail_gonder( $_SESSION[ "hesap_onay_mail" ], "Hesabınızı Onaylayın", $mail_icerik );
            if ( $gonder ) {
               $tema->basari( "Hesap onaylama maili tekrar gönderildi" );
            } else {
               $tema->hata( "Mail gönderilemedi" );
            }
            unset( $_SESSION[ "hesap_onay" ] );
            unset( $_SESSION[ "hesap_onay_mail" ] );
         }
         if ( $_POST ) {
            $username    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "username" ] ) ) );
            $password    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "pass" ] ) ) );
            $giris_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "giris_token" ] ) ) );
            $error       = array( );
            try {
               if ( !$giris_token ) {
                  throw new Exception( 'Token bulunamadı' );
               } else if ( $ayar->sessionid != $giris_token ) {
                  throw new Exception( 'Token uyuşmuyor' );
               } else if ( !$username || !$password ) {
                  throw new Exception( 'Giriş yaparken boş alan bırakamazsınız' );
               } else if ( @$_COOKIE[ 'hata_cerez' ] == 5 ) {
                  throw new Exception( '5 kere üst üste yanlış girdiğinizden dolayı 15 dakka boyunca sisteme giriş yapamazsınız' );
               } else {
                  $kontrol = $odb->prepare( "SELECT login,password,id,status,email_onay,email FROM account WHERE login = ? && password = PASSWORD(?)" );
                  $kontrol->execute( array(
                      $username,
                     $password 
                  ) );
                  if ( $kontrol->rowCount() ) {
                     $afetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                     if ( $afetch[ "status" ] == "block" || $afetch[ "status" ] == "BLOCK" ) {
                        throw new Exception( 'Hesabınız Banlandığından Dolayı giriş yapamıyorsunuz. İtiraz etmek, sebebini öğrenmek için lütfen destek bildirimi oluşturun' );
                     } else if ( $afetch[ "email_onay" ] == 1 && $vt->a( "kayit_onay" ) == 2 ) {
                        $_SESSION[ "hesap_onay" ]      = $username;
                        $_SESSION[ "hesap_onay_mail" ] = $afetch[ "email" ];
                        $tema->uyari( "Hesabınız Onaylanmamış. Onay Mailini Tekrar Göndermek İçin <a href='giris-yap?onay_gonder=1'> Tıklayınız </a>" );
                     } else {
                        $_SESSION[ "yeni_girdi" ]                  = true;
                        $_SESSION[ $vt->a( "isim" ) . "token" ]    = $ayar->sessionid;
                        $_SESSION[ $vt->a( "isim" ) . "username" ] = $username;
                        $_SESSION[ $vt->a( "isim" ) . "userid" ]   = $afetch[ "id" ];
                        $tema->basari( "Giriş yaptınız 2 saniye içinde yönlendirileceksiniz." );
                        printf( '<meta http-equiv="refresh" content="2;URL=' . $vt->url( 5 ) . '">' );
                     }
                  } else {
                     if ( isset( $_COOKIE[ 'hata_cerez' ] ) ) {
                        $yeni  = $_COOKIE[ 'hata_cerez' ] + 1;
                        $kalan = 5 - $yeni;
                        setcookie( "hata_cerez", $yeni, time() + 60 * 15 );
                        if ( $kalan == 0 ) {
                           $kalan_yazi = "5 kere üst üste yanlış girdiğiniz için sistem tarafından 15 dakka banlandınız";
                        } else {
                           $kalan_yazi = 'Tekrar denemek için ' . $kalan . ' şansınız var';
                        }
                     } else {
                        setcookie( "hata_cerez", 1, time() + 60 * 15 );
                        $yeni       = 1;
                        $kalan_yazi = "Tekrar denemek için 4 şansınız var";
                     }
                     throw new Exception( 'Kullanıcı adınızı veya şifrenizi yanlış girdiniz. ' . $kalan_yazi );
                  }
               }
            }
            catch ( Exception $e ) {
               $error[ ] = $e->getMessage();
            }
            if ( $error ) {
               foreach ( $error as $key => $value ) {
                  $tema->hata( $value );
               }
            }
         }
         if ( file_exists( WM_tema . 'sayfalar/giris_yap/giris_yap.php' ) ) {
            require_once WM_tema . 'sayfalar/giris_yap/giris_yap.php';
         } else {
            require_once Sayfa_html . 'giris_yap.php';
         }
      } else {
         if ( file_exists( WM_tema . 'sayfalar/giris_yap/hata.php' ) ) {
            require_once WM_tema . 'sayfalar/giris_yap/hata.php';
         } else {
            require_once Sayfa_html . 'hata.php';
         }
      }
   }
}
?>