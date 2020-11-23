<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$fid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "formid" ] ) ) );
if ( $fid == 1 ) {
    $ip     = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "ip" ] ) ) );
    $ban_id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "ban_id" ] ) ) );
    $file   = file( "../.htaccess" );
    function degistir( $s, $tur = 1 )
    {
        $d = array(
             'allow from all',
            ' ',
            '  ',
            '\n',
            '
' 
        );
        $f = array(
             '',
            '',
            '',
            '',
            '' 
        );
        $s = str_replace( $d, $f, $s );
        return $s;
    }
    $i = 0;
    foreach ( $file as $row ) {
        $i++;
        if ( strpos( $row, $ip ) == TRUE ) {
            $silsatir = $i - 1;
            unset( $file[ $silsatir ] );
            file_put_contents( "../.htaccess", implode( "", $file ) );
        }
    }
    $WMadmin->log_gonder( $ip . " numaralı ip engellenenler listesinden kalktı" );
    $WMform->jquery_sil( 'tr#banli-' . $ban_id . '' );
} else if ( $fid == 2 ) {
    $ip = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "ip" ] ) ) );
    if ( !$ip ) {
        $WMform->hata( "İP Adresini boş bırakamazsınız" );
    } else if ( !$WMclass->ip_kontrol( $ip ) ) {
        $WMform->hata( "Uygun olmayan ip adresi" );
    } else {
        $dosya    = "../.htaccess";
        $handle   = fopen( $dosya, "r" );
        $contents = fread( $handle, filesize( $dosya ) );
        $deny     = "order allow,deny";
        $str      = str_replace( $deny, $deny . "\n" . "deny from " . $ip, $contents );
        $yaz_ac   = fopen( $dosya, "w" );
        $yaz      = fwrite( $yaz_ac, $str );
        fclose( $handle );
        fclose( $yaz_ac );
        $WMform->uyari( "İP nin engellenip engellenmediğini sayfayı yenileyerek kontrol edebilirsiniz" );
        $WMadmin->log_gonder( $ip . " numaralı ip engellenmiştir." );
    }
}
?>