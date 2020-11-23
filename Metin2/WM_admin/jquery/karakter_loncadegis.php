<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$lonca = $WMkontrol->WM_html( $WMkontrol->WM_post( $WMkontrol->WM_tostring( $_POST[ "loncaisim" ] ) ) );
$pid   = $WMkontrol->WM_html( $WMkontrol->WM_post( $WMkontrol->WM_toint( $_POST[ "pid" ] ) ) );
if ( !$lonca ) {
    $WMform->hata( "Lonca ismi boş bırakılamaz..!" );
} else {
    $kontrol = $odb->prepare( "SELECT id,name FROM player.guild WHERE name = ?" );
    $kontrol->execute( array(
         $lonca 
    ) );
    $kontrol2 = $odb->prepare( "SELECT name FROM player.guild WHERE master = ?" );
    $kontrol2->execute( array(
         $pid 
    ) );
    if ( $kontrol->rowCount() ) {
        if ( $kontrol2->rowCount() ) {
            $WMform->bilgi( "Bu oyuncu loncanın kurucusu olduğu için lonca dağıtılamıyor. Loncanın kurucusunu değiştirin veya loncayı dağıtın.", 10000 );
        } else {
            $kontrol3 = $odb->prepare( "SELECT pid FROM player.guild_member WHERE pid = ?" );
            $kontrol3->execute( array(
                 $pid 
            ) );
            if ( $kontrol3->rowCount() ) {
                $ll       = $kontrol->fetch( PDO::FETCH_ASSOC );
                $guncelle = $odb->prepare( "UPDATE player.guild_member SET guild_id = ?, grade = ?, is_general = ?, offer = ? WHERE pid = ?" );
                $degis    = $guncelle->execute( array(
                     $ll[ "id" ],
                    1,
                    0,
                    0,
                    $pid 
                ) );
                if ( $degis ) {
                    $WMadmin->log_gonder( $WMadmin->karakter( $pid, "name", 2 ) . " adlı üyenin loncası " . $lonca . " olarak düzenlendi" );
                    $WMform->basari( "Oyuncunun Loncası başarıyla <b>" . $lonca . "</b> olarak değiştirildi" );
                } else {
                    $WMform->hata();
                }
            } else {
                $ll       = $kontrol->fetch( PDO::FETCH_ASSOC );
                $guncelle = $odb->prepare( "INSERT INTO player.guild_member SET guild_id = ?, grade = ?, is_general = ?, offer = ?, pid = ?" );
                $degis    = $guncelle->execute( array(
                     $ll[ "id" ],
                    1,
                    0,
                    0,
                    $pid 
                ) );
                if ( $degis ) {
                    $WMform->basari( "Oyuncunun Loncası başarıyla <b>" . $lonca . "</b> olarak değiştirildi" );
                } else {
                    $WMform->hata();
                }
                $WMadmin->log_gonder( $WMadmin->karakter( $pid, "name", 2 ) . " adlı üyenin loncası " . $lonca . " olarak düzenlendi" );
            }
        }
    } else {
        $WMform->uyari( " Böyle bir lonca ismi bulunamadı" );
    }
}
?>