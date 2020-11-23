<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$arancak = $WMkontrol->WM_get( $WMkontrol->WM_tostring( $_POST[ "karakteradi" ] ) );
$ara     = $odb->prepare( "SELECT player.name, account.login FROM player.player INNER JOIN account.account ON account.id = player.account_id WHERE name = ?" );
$ara->execute( array(
     $arancak 
) );
if ( $ara->rowCount() ) {
    $bul = $ara->fetch( PDO::FETCH_ASSOC );
    $WMform->bilgi( $arancak . " Adlı karakterin sahibi <b>" . $bul[ "login" ] . "</b>" );
    echo '<script>$("input[name=banlancak]").val("' . $bul[ "login" ] . '");</script>';
} else {
    $WMform->hata( " Aradığınız karakter sistemde bulunamadı" );
}
?>