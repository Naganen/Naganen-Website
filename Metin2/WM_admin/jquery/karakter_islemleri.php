<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $pid       = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "pid" ] ) ) );
    $parcala   = explode( '--', $pid );
    $kullanici = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "kullanici" ] ) ) );
    $kontrol   = $odb->prepare( "SELECT id FROM account WHERE login = ?" );
    $kontrol->execute( array(
         $kullanici 
    ) );
    if ( !$kullanici ) {
        $WMform->hata( "Kullanıcı Adını boş bırakamazsınız" );
    } else if ( $kullanici == $parcala[ 0 ] ) {
        $WMform->hata( "Bu kullanıcı zaten bu karakterin sahibi" );
    } else {
        if ( $kontrol->rowCount() ) {
            $kac_karakter = $odb->prepare( "SELECT account.id AS account_id, player_index.pid1, player_index.pid2, player_index.pid3, player_index.pid4 FROM account.account
LEFT JOIN player.player_index ON account.id = player_index.id WHERE account.login = ?" );
            $kac_karakter->execute( array(
                 $kullanici 
            ) );
            $fetch      = $kac_karakter->fetch( PDO::FETCH_ASSOC );
            $account_id = $fetch[ "account_id" ];
            if ( $fetch[ "pid1" ] != 0 && $fetch[ "pid2" ] != 0 && $fetch[ "pid3" ] != 0 && $fetch[ "pid4" ] != 0 ) {
                $WMform->hata( "Bu kullanıcının toplam 4 karakteri var daha karakter ekliyemezsiniz" );
            } else {
                if ( $fetch[ "pid1" ] == 0 ) {
                    $pid = "pid1";
                } else if ( $fetch[ "pid2" ] == 0 ) {
                    $pid = "pid2";
                } else if ( $fetch[ "pid3" ] == 0 ) {
                    $pid = "pid3";
                } else if ( $fetch[ "pid4" ] == 0 ) {
                    $pid = "pid4";
                }
                $sahip_kontrol = $odb->prepare( "SELECT * FROM player.player_index WHERE (pid1 = ? || pid2 = ? || pid3 = ? || pid4 = ?)" );
                $sahip_kontrol->execute( array(
                     $parcala[ 1 ],
                    $parcala[ 1 ],
                    $parcala[ 1 ],
                    $parcala[ 1 ] 
                ) );
                if ( $sahip_kontrol->rowCount() ) {
                    $fetch2 = $sahip_kontrol->fetch( PDO::FETCH_ASSOC );
                    if ( $fetch2[ "pid1" ] == $parcala[ 1 ] ) {
                        $pid2 = "pid1";
                    } else if ( $fetch2[ "pid2" ] == $parcala[ 1 ] ) {
                        $pid2 = "pid2";
                    } else if ( $fetch2[ "pid3" ] == $parcala[ 1 ] ) {
                        $pid2 = "pid3";
                    } else if ( $fetch2[ "pid4" ] == $parcala[ 1 ] ) {
                        $pid2 = "pid4";
                    }
                    $update   = $odb->prepare( "UPDATE player.player_index SET " . $pid2 . " = ? WHERE id = ?" );
                    $guncelle = $update->execute( array(
                         0,
                        $fetch2[ "id" ] 
                    ) );
                    if ( $guncelle ) {
                        $update2   = $odb->prepare( "UPDATE player.player_index SET " . $pid . " = ? WHERE id = ?" );
                        $guncelle2 = $update2->execute( array(
                             $parcala[ 1 ],
                            $account_id 
                        ) );
                        if ( $guncelle2 ) {
                            $update3   = $odb->prepare( "UPDATE player.player SET account_id = ? WHERE id = ?" );
                            $guncelle3 = $update3->execute( array(
                                 $account_id,
                                $parcala[ 1 ] 
                            ) );
                            if ( $guncelle3 ) {
                                $WMform->basari( "Karakter başarıyla " . $kullanici . " adlı kullanıcıya aktarıldı" );
                                $WMadmin->log_gonder( $parcala[ 2 ] . " adlı karakteri " . $kullanici . " adlı kullanıcıya transfer etti" );
                            } else {
                                $WMform->hata( "Player tablosunda account_id düzenlenirken bir hata meydana geldi", 10000 );
                            }
                        } else {
                            $WMform->hata( "Karakter kullanıcıya eklenirken bir hata meydana geldi", 10000 );
                        }
                    } else {
                        $WMform->hata( "Karakter kullanıcıdan silinirken bir hata meydana geldi" );
                    }
                } else {
                    $WMform->hata( "Kullanının sahibinde böyle bir karakter yok" );
                }
            }
        } else {
            $WMform->hata( "Böyle bir kullanıcı bulunamadı" );
        }
    }
} else if ( $fid == 2 ) {
    $pid      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
    $karakter = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "karakter" ] ) ) );
    $kontrol  = $odb->prepare( "SELECT id FROM player.player WHERE name = ?" );
    $kontrol->execute( array(
         $karakter 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMform->hata( "Böyle bir karakter adı zaten var" );
    } else {
        $bak = $odb->prepare( "SELECT name FROM player.player WHERE id = ?" );
        $bak->execute( array(
             $pid 
        ) );
        $bak      = $bak->fetch();
        $update   = $odb->prepare( "UPDATE player.player SET name = ? WHERE id  = ?" );
        $guncelle = $update->execute( array(
             $karakter,
            $pid 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Karakterin adı başarıyla " . $karakter . " olarak değiştirildi" );
            $WMadmin->log_gonder( $bak[ "name" ] . " adlı karakterin ismi " . $karakter . " olarak değiştirildi" );
            echo '<meta http-equiv="refresh" content="2;URL=index.php?sayfa=karakterler&name=' . $karakter . '">';
        } else {
            $WMform->hata();
        }
    }
} else if ( $fid == 3 ) {
    $pid      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "pid" ] ) ) );
    $level    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "level" ] ) ) );
    $parcala  = explode( '--', $pid );
    $update   = $odb->prepare( "UPDATE player.player SET level = ? WHERE name = ?" );
    $guncelle = $update->execute( array(
         $level,
        $parcala[ 0 ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Karakterin leveli başarıyla " . $level . " olarak değiştirildi" );
        $WMadmin->log_gonder( $parcala[ 0 ] . " adlı karakterin leveli " . $parcala[ 1 ] . " levelden " . $level . " olarak değiştirildi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 4 ) {
    $pid      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "pid" ] ) ) );
    $job      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "job" ] ) ) );
    $parcala  = explode( '--', $pid );
    $update   = $odb->prepare( "UPDATE player.player SET job = ? WHERE name = ?" );
    $guncelle = $update->execute( array(
         $job,
        $parcala[ 0 ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Karakterin mesleği başarıyla değiştirildi" );
        $WMadmin->log_gonder( $parcala[ 0 ] . " adlı karakterin mesleği " . $parcala[ 1 ] . " den " . $job . " olarak değiştirildi" );
    } else {
        $WMform->hata();
    }
} else if ( $fid == 5 ) {
    $pid      = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "pid" ] ) ) );
    $yang     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "yang" ] ) ) );
    $parcala  = explode( '--', $pid );
    $update   = $odb->prepare( "UPDATE player.player SET gold = ? WHERE name = ?" );
    $guncelle = $update->execute( array(
         $yang,
        $parcala[ 0 ] 
    ) );
    if ( $guncelle ) {
        $WMform->basari( "Karakterin yangı başarıyla değiştirildi" );
        $yang1 = number_format( $parcala[ 1 ], 0, '.', '.' );
        $yang2 = number_format( $yang, 0, '.', '.' );
        $WMadmin->log_gonder( $parcala[ 0 ] . " adlı karakterin yangı " . $yang1 . " yang dan " . $yang2 . " yang olarak değiştirildi" );
    } else {
        $WMform->hata();
    }
}
?>