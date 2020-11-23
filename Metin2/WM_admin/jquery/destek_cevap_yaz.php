<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
session_start();
$tid     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$cevap   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "cevap" ] ) ) );
$kontrol = $db->prepare( "SELECT id,konu,acan FROM destek WHERE id = ?" );
$kontrol->execute( array(
     $tid 
) );
if ( !$cevap ) {
    $WMform->hata( "Cevabı boş bırakamazsınız" );
} else if ( $kontrol->rowCount() ) {
    $insert     = $db->prepare( "INSERT INTO destek_cevap SET tid = ?, sid = ?, ckisi = ?, cevap = ?, cevaplayan = ?, tarih = ?" );
    $imza_durum = $WMadmin->admin( "imza_durum", $_SESSION[ "adminid" ] );
    $gm_isim    = $WMadmin->admin( "gm", $_SESSION[ "adminid" ] );
    if ( $imza_durum == 1 ) {
        $imza       = $WMadmin->admin( "imza", $_SESSION[ "adminid" ] );
        $yeni_cevap = $cevap . "<hr>" . $imza;
    } else {
        $yeni_cevap = $cevap;
    }
    $ekle     = $insert->execute( array(
         $tid,
        $_SESSION[ "server" ],
        2,
        $yeni_cevap,
        $gm_isim,
        tarih() 
    ) );
    $guncelle = $db->prepare( "UPDATE destek SET durum = ? WHERE sid = ? && id = ?" );
    $guncelle->execute( array(
         1,
        $_SESSION[ "server" ],
        $tid 
    ) );
    if ( $ekle ) {
        $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
        $WMadmin->log_gonder( $fetch[ "konu" ] . " Sorulu destek talebine yanıt verildi" );
        if ( $WMadmin->serverbilgi( "destek_mail" ) == 1 ) {
			$mail_icerik = array('admin_destek_cevap', $fetch[ "acan" ], $fetch[ "konu" ]);
            $gonder      = $WMadmin->mail_gonder( $WMadmin->kullanici( $fetch[ "acan" ], "email", 2 ), "Destek Talebinize Cevap Geldi ", $mail_icerik );
            if ( !$gonder ) {
                $WMform->hata( "Mail gönderilirken bir hata meydana geldi" );
            }
        }
        $WMadmin->bildirim_gonder( $fetch[ "acan" ], 1, $fetch[ "konu" ] . " konulu destek talebinize yanıt geldi.", $fetch[ "id" ] );
        $WMform->basari( "Cevap Gönderildi" );
        echo '<meta http-equiv="refresh" content="2;URL=#">';
    } else {
        $WMform->hata();
    }
} else {
    $WMform->hata( "Cevap yazmaya çalıştığınız destek talebi silinmiş" );
}
?>