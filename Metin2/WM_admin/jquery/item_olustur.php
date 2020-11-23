<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
function depo_kontrol( $id )
{
    global $odb;
    $query = $odb->prepare( "SELECT pos FROM player.item WHERE owner_id = ? && window= ? ORDER BY id DESC LIMIT 0,1" );
    $query->execute( array(
         $id,
        'MALL' 
    ) );
    if ( $query->rowCount() ) {
        $fetch = $query->fetch( PDO::FETCH_ASSOC );
        if ( $fetch[ "pos" ] == "" ) {
            $pos = 0;
        } else if ( $fetch[ "pos" ] >= 44 ) {
            $pos = 86;
        } else {
            $pos = $fetch[ "pos" ] + 1;
        }
    } else {
        $pos = 0;
    }
    return $pos;
}
$vnum   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "vnum" ] ) ) );
$adet   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "adet" ] ) ) );
$name   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "name" ] ) ) );
$tur    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "tur" ] ) ) );
$efsun1 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsun1" ] ) ) );
$efsun2 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsun2" ] ) ) );
$efsun3 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsun3" ] ) ) );
$efsun4 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsun4" ] ) ) );
$efsun5 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsun5" ] ) ) );
$efsun6 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsun6" ] ) ) );
$efsun7 = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "efsun7" ] ) ) );
$oran1  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "oran1" ] ) ) );
$oran2  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "oran2" ] ) ) );
$oran3  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "oran3" ] ) ) );
$oran4  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "oran4" ] ) ) );
$oran5  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "oran5" ] ) ) );
$oran6  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "oran6" ] ) ) );
$oran7  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "oran7" ] ) ) );
$tas1   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "tas1" ] ) ) );
$tas2   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "tas2" ] ) ) );
$tas3   = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "tas3" ] ) ) );
if ( !$vnum || !$adet ) {
    $WMform->hata( "İtem vnumu ve adeti boş bırakılamaz" );
} else if ( $vnum < 10 ) {
    $WMform->hata( "İtem vnumu 10 dan büyük olmalıdır." );
} else if ( $adet < 0 || $adet > 250 ) {
    $WMform->hata( "İtem adeti en az 1 en fazla 250 olabilir." );
} else if ( !$name ) {
    $WMform->hata( "Gönderilcek karakteri veya kullanıcıyı boş bırakamazsınız" );
} else if ( ( $efsun1 != 0 && $oran1 == 0 ) || ( $efsun2 != 0 && $oran2 == 0 ) || ( $efsun3 != 0 && $oran3 == 0 ) || ( $efsun4 != 0 && $oran4 == 0 ) || ( $efsun5 != 0 && $oran5 == 0 ) || ( $efsun6 != 0 && $oran6 == 0 ) || ( $efsun7 != 0 && $oran7 == 0 ) ) {
    $WMform->hata( "Efsun Seçtikten sonra oranı boş bırakamazsınız" );
} else if ( $oran1 > 32767 || $oran2 > 32767 || $oran3 > 32767 || $oran4 > 32767 || $oran5 > 32767 || $oran6 > 32767 || $oran7 > 32767 ) {
    $WMform->uyari( "Efsun oranı en fazla 32767 olabilir" );
} else if ( ( $efsun1 == 0 && $oran1 != 0 ) || ( $efsun2 == 0 && $oran2 != 0 ) || ( $efsun3 == 0 && $oran3 != 0 ) || ( $efsun4 == 0 && $oran4 != 0 ) || ( $efsun5 == 0 && $oran5 != 0 ) || ( $efsun6 == 0 && $oran6 != 0 ) || ( $efsun7 == 0 && $oran7 != 0 ) ) {
    $WMform->hata( "Oran girdikten sonra efsunu boş bırakamazsınız" );
} else {
    $kontrol = $odb->prepare( "SELECT vnum FROM player.item_proto WHERE vnum = ?" );
    $kontrol->execute( array(
         $vnum 
    ) );
    if ( $kontrol->rowCount() ) {
        if ( $tur == "kullanici" ) {
            $kontrol = $odb->prepare( "SELECT login,id FROM account WHERE login = ?" );
            $kontrol->execute( array(
                 $name 
            ) );
            if ( $kontrol->rowCount() ) {
                $fetch    = $kontrol->fetch( PDO::FETCH_ASSOC );
                $owner_id = $fetch[ "id" ];
            } else {
                $WMform->uyari( $name . " Adlı bir kullanıcı bulunamadı" );
                exit;
            }
        } else if ( $tur == "karakter" ) {
            $kontrol = $odb->prepare( "SELECT name,account_id FROM player.player WHERE name = ?" );
            $kontrol->execute( array(
                 $name 
            ) );
            if ( $kontrol->rowCount() ) {
                $fetch    = $kontrol->fetch( PDO::FETCH_ASSOC );
                $owner_id = $fetch[ "account_id" ];
            } else {
                $WMform->uyari( $name . " Adlı bir karakter bulunamadı" );
                exit;
            }
        }
        $pos = depo_kontrol( $owner_id );
        if ( $pos == 86 ) {
            $WMform->uyari( "Kullanıcının nesne market deposu sonuna kadar dolmuştur" );
            exit;
        } else {
            $insert = $odb->prepare( "INSERT INTO player.item SET owner_id = ?, window = ?, pos = ?, count = ?, vnum = ?, socket0 = ?, socket1 = ?, socket2 = ?, attrtype0 = ?, attrtype1 = ? , attrtype2 = ? , attrtype3 = ? , attrtype4 = ?,
	attrtype5 = ?, attrtype6 = ?, attrvalue0 = ?, attrvalue1 = ?, attrvalue2 = ?, attrvalue3 = ?, attrvalue4 = ?, attrvalue5 = ?, attrvalue6 = ?" );
            $ekle   = $insert->execute( array(
                 $owner_id,
                "MALL",
                $pos,
                $adet,
                $vnum,
                $tas1,
                $tas2,
                $tas3,
                $efsun1,
                $efsun2,
                $efsun3,
                $efsun4,
                $efsun5,
                $efsun6,
                $efsun7,
                $oran1,
                $oran2,
                $oran3,
                $oran4,
                $oran5,
                $oran6,
                $oran7 
            ) );
            if ( $ekle ) {
                $genel    = array(
                     $vnum,
                    $adet,
                    $owner_id,
                    $tur 
                );
                $efsunlar = array(
                     $efsun1,
                    $efsun2,
                    $efsun3,
                    $efsun4,
                    $efsun5,
                    $efsun6,
                    $efsun7 
                );
                $oranlar  = array(
                     $oran1,
                    $oran2,
                    $oran3,
                    $oran4,
                    $oran5,
                    $oran6,
                    $oran7 
                );
                $taslar   = array(
                     $tas1,
                    $tas2,
                    $tas3 
                );
                $log      = array(
                     json_encode( $genel ),
                    json_encode( $efsunlar ),
                    json_encode( $oranlar ),
                    json_encode( $taslar ) 
                );
                $WMadmin->log_gonder( "İtem Oluşturuldu", 2, json_encode( $log ) );
                $WMform->basari( "İtem kullanıcının nesne marketine başarıyla gönderildi" );
            } else {
                $WMform->hata();
            }
        }
    } else {
        $WMform->uyari( "Girdiğiniz item vnumu sistemde bulunamadı" );
    }
}
?>