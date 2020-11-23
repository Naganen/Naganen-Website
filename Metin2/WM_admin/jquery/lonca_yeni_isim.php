<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$gid       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "gid" ] ) ) );
$yenilonca = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "yenilonca" ] ) ) );
if ( !$yenilonca ) {
    $WMform->hata( "Lonca ismini boş bırakamazsınız" );
} else {
    $kontrol = $odb->prepare( "SELECT name FROM player.guild WHERE name = ?" );
    $kontrol->execute( array(
         $yenilonca 
    ) );
    if ( $kontrol->rowCount() ) {
        $WMform->uyari( "<b>" . $yenilonca . "</b> Adında bir lonca zaten var." );
    } else {
        $bak = $odb->prepare( "SELECT name FROM player.guild WHERE id = ?" );
        $bak->execute( array(
             $gid 
        ) );
        $bak = $bak->fetch();
        $WMadmin->log_gonder( $bak[ "name" ] . " adlı loncanın ismi " . $yenilonca . " olarak düzenlendi" );
        $update   = $odb->prepare( "UPDATE player.guild SET name = ? WHERE id = ?" );
        $guncelle = $update->execute( array(
             $yenilonca,
            $gid 
        ) );
        if ( $guncelle ) {
            $WMform->basari( "Loncanın ismini başarıyla <b>" . $yenilonca . "</b> olarak değiştirdiniz" );
            echo '<meta http-equiv="refresh" content="2;URL=index.php?sayfa=lonca&name=' . $yenilonca . '">';
        } else {
            $WMform->hata();
        }
    }
}
?>