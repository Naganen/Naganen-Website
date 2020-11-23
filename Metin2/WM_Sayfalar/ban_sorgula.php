<?php
class ban_sorgula {
   public function head( ) {
      global $vt;
      if ( file_exists( WM_tema . 'sayfalar/ban_sorgula/header.php' ) ) {
         require_once WM_tema . 'sayfalar/ban_sorgula/header.php';
      } else {
         require_once Sayfa_html . 'header.php';
      }
   }
   public function ust( ) {
      return 'Ban Sorgula';
   }
   public function orta( ) {
      global $ayar, $odb, $WMkontrol, $vt, $tema, $db, $WMinf;
      @$islem = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_eng( $_GET[ "islem" ] ) ) );
      if ( $vt->a( "breadcumb" ) == 1 ) {
         if ( file_exists( WM_tema . 'sayfalar/ban_sorgula/breadcumb.php' ) ) {
            require_once WM_tema . 'sayfalar/ban_sorgula/breadcumb.php';
         } else {
            require_once Sayfa_html . 'breadcumb.php';
         }
      }
      if ( isset( $_POST[ "ban_sorgula" ] ) ) {
         @$sorgulancak = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sorgulancak" ] ) ) );
         @$sorgu_token = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "sorgu_token" ] ) ) );
         if ( !$sorgu_token ) {
            echo "Token yok";
         } else if ( $sorgu_token != $ayar->sessionid ) {
            echo "Token hatası";
         } else if ( !$sorgulancak ) {
            $tema->hata( "Sorgulancak karakter boş bırakılamaz." );
         } else {
            $karakter_kontrol = $odb->prepare( "SELECT player.account_id, account.status, account.ban_time, account.kim_banlamis, account.ban_sure, account.ban_neden, account.id AS account FROM player.player LEFT JOIN account.account ON account.id = player.account_id WHERE player.name = ? " );
            $karakter_kontrol->execute( array(
                $sorgulancak 
            ) );
            if ( $karakter_kontrol->rowCount() ) {
               $fetch    = $karakter_kontrol->fetch( PDO::FETCH_ASSOC );
               $ban_list = $odb->prepare( "SELECT * FROM ban_list WHERE account = ? " );
               $ban_list->execute( array(
                   $fetch[ "account" ] 
               ) );
               if ( $fetch[ "status" ] == "block" || $fetch[ "status" ] == "BLOCK" ) {
                  if ( file_exists( WM_tema . 'sayfalar/ban_sorgula/banli.php' ) ) {
                     require_once WM_tema . 'sayfalar/ban_sorgula/banli.php';
                  } else {
                     require_once Sayfa_html . 'banli.php';
                  }
               } else {
                  if ( file_exists( WM_tema . 'sayfalar/ban_sorgula/bansiz.php' ) ) {
                     require_once WM_tema . 'sayfalar/ban_sorgula/bansiz.php';
                  } else {
                     require_once Sayfa_html . 'bansiz.php';
                  }
               }
               if ( $ban_list->rowCount() ) {
                  if ( file_exists( WM_tema . 'sayfalar/ban_sorgula/ban_gecmis.php' ) ) {
                     require_once WM_tema . 'sayfalar/ban_sorgula/ban_gecmis.php';
                  } else {
                     require_once Sayfa_html . 'ban_gecmis.php';
                  }
               }
            } else {
               $tema->hata( $sorgulancak . " adında bir karakter sistemde bulunamadı." );
            }
         }
      }
      if ( file_exists( WM_tema . 'sayfalar/ban_sorgula/ban_sorgula.php' ) ) {
         require_once WM_tema . 'sayfalar/ban_sorgula/ban_sorgula.php';
      } else {
         require_once Sayfa_html . 'ban_sorgula.php';
      }
   }
}
?>