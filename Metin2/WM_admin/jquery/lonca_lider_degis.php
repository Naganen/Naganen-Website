<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$gid    = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "gid" ] ) ) );
$baskan = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "baskanisim" ] ) ) );
$ara    = $odb->prepare( "SELECT name,id FROM player.player WHERE name = ?" );
$ara->execute( array(
     $baskan 
) );
$lider = $odb->prepare( "SELECT master,name FROM player.guild WHERE id = ?" );
$lider->execute( array(
     $gid 
) );
$lider = $lider->fetch();
if ( $ara->rowCount() ) {
    $pfetch        = $ara->fetch( PDO::FETCH_ASSOC );
    $baskankontrol = $odb->prepare( "SELECT name FROM player.guild WHERE master = ? && id = ?" );
    $baskankontrol->execute( array(
         $pfetch[ "id" ],
        $gid 
    ) );
    if ( $baskankontrol->rowCount() ) {
        $WMform->uyari( "<b>" . $baskan . "</b> adlı karakter zaten bu loncanın lideri." );
    } else {
        $loncavarmi = $odb->prepare( "SELECT pid FROM player.guild_member WHERE pid = ?" );
        $loncavarmi->execute( array(
             $pfetch[ "id" ] 
        ) );
        if ( $loncavarmi->rowCount() ) {
            $loncasil = $odb->prepare( "DELETE FROM player.guild_member WHERE pid = ?" );
            $loncasil->execute( array(
                 $pfetch[ "id" ] 
            ) );
            $loncakurmusmu = $odb->prepare( "SELECT name FROM player.guild WHERE master = ?" );
            $loncakurmusmu->execute( array(
                 $pfetch[ "id" ] 
            ) );
            if ( $loncakurmusmu->rowCount() ) {
                $lbg = $odb->prepare( "UPDATE player.guild SET master = ? WHERE master = ?" );
                $lbg->execute( array(
                     0,
                    $pfetch[ "id" ] 
                ) );
            }
        }
        $baskanekle = $odb->prepare( "INSERT INTO player.guild_member SET pid = ?, guild_id = ?, grade = ?" );
        $baskanekle->execute( array(
             $lider[ "master" ],
            $gid,
            1 
        ) );
        $lgc = $odb->prepare( "UPDATE player.guild SET master = ? WHERE id = ?" );
        $lgc->execute( array(
             $pfetch[ "id" ],
            $gid 
        ) );
        if ( $lgc ) {
            $WMadmin->log_gonder( $lider[ "name" ] . " adlı loncanın başkanı " . $pfetch[ "name" ] . " olarak değiştirildi" );
            $WMform->basari( "Loncanın başkanını <b>" . $baskan . "</b> olarak başarıyla değiştirdiniz.." );
            $baskanekle = $odb->prepare( "INSERT INTO player.guild_member SET pid = ?, guild_id = ?, grade = ?" );
            $baskanekle->execute( array(
                 $pfetch[ "id" ],
                $gid,
                1 
            ) );
        } else {
            $WMform->hata();
        }
    }
} else {
    $WMform->hata( "<b>" . $baskan . "</b> Adında bir karakter bulunamadı" );
}
?>