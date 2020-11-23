<?php
class login
{
    public function __construct( $username, $password )
    {
        global $db, $WMkontrol;
        $query = $db->prepare( "SELECT username,password,server,id FROM users WHERE username = ? && password = ?" );
        $query->execute( array(
             $WMkontrol->inj( $username ),
            $WMkontrol->inj( $password ) 
        ) );
        if ( $query->rowCount() ) {
            $fetch = $query->fetch( PDO::FETCH_ASSOC );
            $this->session_olustur( $fetch[ "id" ], $username, $fetch[ "server" ] );
            echo 1;
        } else {
            echo 2;
        }
    }
    public function session_olustur( $userid, $username, $serverid )
    {
        global $WMkontrol, $db;
        session_start();
        $_SESSION[ "adminid" ]   = $WMkontrol->WM_toint( $userid );
        $_SESSION[ "adminisim" ] = $WMkontrol->WM_tostring( $username );
        $_SESSION[ "giris" ]     = "true";
        $_SESSION[ "server" ]    = $serverid;
        $log_gonder              = $db->prepare( "INSERT INTO log (sid, tur, yapan, log, tarih) values (?, ?, ?, ?, ?)" );
        $log_gonder->execute( array(
             $serverid,
            4,
            $username,
            $_SERVER[ 'REMOTE_ADDR' ],
            date( "Y-m-d H:i:s" ) 
        ) );
    }
}
$login = new login( $_POST[ "username" ], md5( $_POST[ "password" ] ) );
?>
