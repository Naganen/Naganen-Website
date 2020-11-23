<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$gid = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "gid" ] ) ) );
$uye = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "uyeisim" ] ) ) );
if ( !$uye ) {
    $WMform->hata( "Karakter ismi boş bırakılamaz.." );
} else {
    $uyevarmi = $odb->prepare( "SELECT name,id FROM player.player WHERE name = ?" );
    $uyevarmi->execute( array(
         $uye 
    ) );
    if ( $uyevarmi->rowCount() ) {
        $pfetch  = $uyevarmi->fetch( PDO::FETCH_ASSOC );
        $loncasi = $odb->prepare( "SELECT pid FROM player.guild_member WHERE pid = ?" );
        $loncasi->execute( array(
             $pfetch[ "id" ] 
        ) );
        if ( $loncasi->rowCount() ) {
            $update   = $odb->prepare( "UPDATE player.guild_member SET guild_id = ? WHERE pid = ?" );
            $guncelle = $update->execute( array(
                 $gid,
                $pfetch[ "id" ] 
            ) );
            if ( $guncelle ) {
                $WMform->basari( "<b>" . $uye . "</b> Oyuncunun Loncası Değiştirilerek İstediğiniz Loncaya Aktarıldı" );
            } else {
                $WMform->hata();
            }
        } else {
            $insert = $odb->prepare( "INSERT INTO guild_member SET pid = ?, guild_id = ?, grade = ?" );
            $ekle   = $insert->execute( array(
                 $pfetch[ "id" ],
                $gid,
                1 
            ) );
            if ( $ekle ) {
                $bak = $odb->prepare( "SELECT name FROM player.guild WHERE id = ?" );
                $bak->execute( array(
                     $gid 
                ) );
                $bak = $bak->fetch();
                $WMadmin->log_gonder( $uye . " adlı karakterin loncası " . $bak[ "name" ] . " olarak düzenlendi" );
                $WMform->basari( "<b>" . $uye . "</b> Adlı oyuncu loncaya başarıyla eklendi" );
            }
        }
    } else {
        $WMform->uyari( "<b>" . $uye . "</b> Adında bir karakter yok . !" );
    }
}
?>