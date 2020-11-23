<?php
session_start();
ob_start();
header( "Content-Type:text/html; Charset=UTF-8" );
date_default_timezone_set( "Europe/Istanbul" );
class WMayar {
    public $anasayfa = "";
    public $index = "";
    public $index_tema = "";
    public $WMindex = "";
    public $sessionid = "";
    public $token_rastgele = "";
    public $WMimg = "";
    public function __construct( $path, $oyunvt = 0 ) {
        global $db, $odb, $WMclass, $WMkontrol, $tema, $WMinf, $vt, $url;
        $this->token_rastgele = md5( uniqid( mt_rand(), true ) );
        $this->sessionid      = session_id();
        define( 'REAL_PATH', realpath( $path ) );
        require_once REAL_PATH . '/fonksiyon.php';
        if ( $path == "." ) {
            $this->WMimg = "WM_global/img/";
            @define( 'WMcaptcha', 'WM_plugins/WM_captcha/WMcaptcha.php' );
        } //$path == "."
        else {
            $this->WMimg = "../WM_global/img/";
            @define( 'WMcaptcha', '../WM_plugins/WM_captcha/WMcaptcha.php' );
        }
        require_once 'WM_database_ayar.php';
        require_once 'WMdatabase.php';
        $this->anasayfa   = $WMclass->ayar( "index" );
        $this->index      = $WMclass->ayar( "index_tema" );
        $this->index_tema = 'WM_theme/WM_index/';
        $this->WMindex    = define( 'WMindex', $this->index_tema . $this->index . '/' );
        if ( $oyunvt != 0 ) {
            $kontrol = $db->prepare( "SELECT * FROM server WHERE id = ?" );
            $kontrol->execute( array(
                 $oyunvt 
            ) );
            if ( $kontrol->rowCount() ) {
                $o = $kontrol->fetch( PDO::FETCH_ASSOC );
                require_once 'WM_oyun_database.php';
                $oyunvt = new WM_oyun_database( $o[ "host" ], $o[ "user" ], $o[ "pass" ], $o[ "sql_port" ] );
            } //$kontrol->rowCount()
            else {
                echo "Server Bulunamadı";
            }
        } //$oyunvt != 0
    }
}
?>