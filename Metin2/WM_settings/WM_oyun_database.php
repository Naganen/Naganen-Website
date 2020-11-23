<?php
class WM_oyun_database {
    public function __construct( $host, $user, $pass, $port = 3306 ) {
        global $odb;
        try {
            $odb = new PDO( 'mysql:host=' . $host . ';port=' . $port . ';dbname=account', $user, $pass );
        }
        catch ( PDOexception $a ) {
            echo '<h1 align="center" style="margin-bottom:20px;">HATA !</h1><div style="border:1px solid #f00; padding:10px; margin:30px 0;">Oyun Veritabanına Bağlanılamadı - WMCP</div>';
            exit;
        }
    }
}
?>