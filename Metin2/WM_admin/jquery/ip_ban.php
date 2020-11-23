<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$ip       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "ip" ] ) ) );
$bansure  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "bansure2" ] ) ) );
$bansebep = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "bansebep2" ] ) ) );
$banlayan = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "banlayan2" ] ) ) );
$kontrol  = $odb->prepare( "SELECT login FROM account WHERE web_ip = ?" );
$kontrol->execute( array(
     $ip 
) );
if ( $ip != "" ) {
    if ( $kontrol->rowCount() ) {
        if ( !isset( $_POST[ "sinirsiz2" ] ) ) {
            if ( !$bansure ) {
                $WMform->hata( " Sınırsız banlanma olmadığı için tarih boş bırakılamaz.!" );
                exit( );
            } else {
                $sinirsiz = $bansure . ' ' . date( "H:i:s" );
            }
        } else {
            $sinirsiz = "1";
        }
        foreach ( $kontrol as $row ) {
            $ban    = $odb->prepare( "UPDATE account SET status = ?, ban_neden = ?, ban_sure = ?, kim_banlamis = ?, ban_time = ? WHERE login = ?" );
            $banla  = $ban->execute( array(
                 "BLOCK",
                $bansebep,
                $sinirsiz,
                $banlayan,
                date( "Y-m-d H:i:s" ),
                $row[ "login" ] 
            ) );
            $insert = $odb->prepare( "INSERT INTO ban_list SET account = ?, reason = ?, source = ?, date = ?, action = ?" );
            $ekle   = $insert->execute( array(
                 $WMadmin->kullanici( $row[ "login" ], "id", 2 ),
                $bansebep,
                $ip,
                date( "Y-m-d H:i:s" ),
                "ban" 
            ) );
        }
        if ( $banla ) {
            $WMadmin->log_gonder( $ip . "  İP ye sahip kullanıcılar banlandı" );
            $WMform->basari( $ip . " İP ye sahip kullanıcılar başarıyla banlandı" );
        } else {
            $WMform->hata();
        }
    } else {
        $WMform->hata( $ip . " numaralı ip bulunamadı" );
    }
} else {
    $WMform->hata( "İP boş bırakılamaz" );
}
?>