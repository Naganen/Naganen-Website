<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$tur   = $WMkontrol->WM_get( $WMkontrol->WM_tostring( $_GET[ "tur" ] ) );
$id    = $WMkontrol->WM_get( $WMkontrol->WM_toint( $_GET[ "id" ] ) );
$query = $odb->prepare( "UPDATE account SET status = :status, ban_sure = :bansure WHERE id = :id" );
if ( $tur == "OK" ) {
    $guncelle = $query->execute( array(
         "status" => "OK",
        "bansure" => 0,
        "id" => $id 
    ) );
    if ( $guncelle ) {
        $WMform->basari( " Kullanıcının Banını Başarıyla Kaldırdınız." );
        $insert = $odb->prepare( "INSERT INTO ban_list SET account = ?, date = ?, action = ?" );
        $ekle   = $insert->execute( array(
             $id,
            date( "Y-m-d H:i:s" ),
            "unban" 
        ) );
    } else {
        $WMform->hata();
    }
} else if ( $tur == "BLOCK" ) {
    $guncelle = $query->execute( array(
         "status" => "BLOCK",
        "bansure" => 1,
        "id" => $id 
    ) );
    if ( $guncelle ) {
        $WMform->basari( " Kullanıcıyı Başarıyla Banladınız." );
        $insert = $odb->prepare( "INSERT INTO ban_list SET account = ?, date = ?, action = ?" );
        $ekle   = $insert->execute( array(
             $id,
            date( "Y-m-d H:i:s" ),
            "ban" 
        ) );
    } else {
        $WMform->hata();
    }
}
echo '<meta http-equiv="refresh" content="2;URL=#">';
?>