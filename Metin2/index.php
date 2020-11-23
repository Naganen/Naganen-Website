<?php
$konum = ".";
require_once 'WM_settings/WMayar.php';
define('Sayfa_html', 'WM_Sayfalar/html_sayfa/'.@$_GET["islem"].'/');
@$ayar = new WMayar( "." );
$ana_sayfa = json_decode( $ayar->anasayfa );
if ( $ana_sayfa[ 0 ] == "index" ) {
    $index_tur = 1;
    if ( !$WMclass->ayar( "index_tema" ) ) {
        echo "İndex Seçilmemiş";
    } else if ( is_dir( $ayar->index_tema . $WMclass->ayar( "index_tema" ) ) ) {
        $cek = $ayar->index_tema . $ayar->index . "/index.php";
        require_once $cek;
    } else {
        echo "İndex bulunamadı";
		exit;
    }
} else if ( $ana_sayfa[ 0 ] == "yonlendir" ) {
    $server_bak = $db->query( "SELECT id,link FROM server WHERE id = '" . $ana_sayfa[ 1 ] . "'" );
    if ( $server_bak->rowCount() ) {
        $fetch = $server_bak->fetch( PDO::FETCH_ASSOC );
        header( 'Location: ' . $fetch[ "link" ] );
    } else {
        echo '<h1 align="center" style="margin-bottom:20px;">HATA !</h1><div style="border:1px solid #f00; padding:10px; margin:30px 0;">Böyle bir server bulunamadı</div>';
		exit;
    }
} else if ( $ana_sayfa[ 0 ] == "direk" ) {
    define( 'server', $ana_sayfa[ 1 ] );
    if ( !isset( $_SESSION[ "server_vt" ] ) || $_SESSION[ "server_vt" ] != server ) {
        $_SESSION[ "server_vt" ] = server;
    }
    @$ayar = new WMayar( ".", server );
    $ana_sayfa_tema = json_decode( $WMclass->tema( server ) );
    $vt             = new WM_vt_settings( server );
    if ( $ana_sayfa_tema[ 0 ] == "tema" ) {
        define( 'WM_tema', 'WM_theme/WM_tema/' . $ana_sayfa_tema[ 1 ] . '/' );
        $page = $WMkontrol->WM_get( $WMkontrol->WM_eng( @$_GET[ "islem" ] ) );
        if ( is_dir( WM_tema ) && $ana_sayfa_tema[ 1 ] != '' ) {
            if ( !$page ) {
                $wmcp = new index;
            } else {
                $wmcp = new $page;
            }
            require_once WM_tema . 'index.php';
        } else {
            echo '<h1 align="center" style="margin-bottom:20px;">HATA !</h1><div style="border:1px solid #f00; padding:10px; margin:30px 0;"> dizin bulunamadı </div>';
			exit;
        }
    } else {
        define( 'WM_bakim', 'WM_theme/WM_bakim/' . $ana_sayfa_tema[ 1 ] . '/' );
        if ( is_dir( WM_bakim ) ) {
            require WM_bakim . 'index.php';
        } else {
            echo '<h1 align="center" style="margin-bottom:20px;">HATA !</h1><div style="border:1px solid #f00; padding:10px; margin:30px 0;"> Bakım dizini bulunamadı </div>';
        }
    }
} else if ( $ana_sayfa[ 0 ] == "index_tema" ) {
    $index_tur = 2;
    define( 'server', $ana_sayfa[ 1 ] );
    $vt = new WM_vt_settings( server );
    if ( !isset( $_SESSION[ "server_vt" ] ) || $_SESSION[ "server_vt" ] != server ) {
        $_SESSION[ "server_vt" ] = server;
    }
    $ana_sayfa_tema = json_decode( $WMclass->tema( server ) );
    if ( $ana_sayfa_tema[ 0 ] == "tema" ) {
        if ( !$WMclass->ayar( "index_tema" ) ) {
            echo "İndex Seçilmemiş";
        } else if ( is_dir( $ayar->index_tema . $WMclass->ayar( "index_tema" ) ) ) {
            define( 'WM_tema', 'WM_theme/WM_tema/' . $ana_sayfa_tema[ 1 ] . '/' );
            $page = $WMkontrol->WM_get( $WMkontrol->WM_eng( @$_GET[ "islem" ] ) );
            if ( ( $page == "" || !$page ) && ( strpos( $_SERVER[ 'REQUEST_URI' ], "anasayfa" ) === FALSE ) ) {
                $cek = $ayar->index_tema . $ayar->index . "/index.php";
                require_once $cek;
            } else {
                @$ayar = new WMayar( ".", server );
                if ( is_dir( WM_tema ) && $ana_sayfa_tema[ 1 ] != '' ) {
                    $vt = new WM_vt_settings( server );
                    if ( !$page ) {
                        $wmcp = new index;
                    } else {
                        $wmcp = new $page;
                    }
                    require_once WM_tema . 'index.php';
                } else {
                    echo '<h1 align="center" style="margin-bottom:20px;">HATA !</h1><div style="border:1px solid #f00; padding:10px; margin:30px 0;"> dizin bulunamadı</div>';
					exit;
                }
            }
        } else {
            echo '<h1 align="center" style="margin-bottom:20px;">HATA !</h1><div style="border:1px solid #f00; padding:10px; margin:30px 0;">İndex bulunamadı</div>';
			exit;
        }
    } else {
        define( 'WM_bakim', 'WM_theme/WM_bakim/' . $ana_sayfa_tema[ 1 ] . '/' );
        if ( is_dir( WM_bakim ) && $ana_sayfa_tema[ 1 ] != '' ) {
            require WM_bakim . 'index.php';
        } else {
            echo '<h1 align="center" style="margin-bottom:20px;">HATA !</h1><div style="border:1px solid #f00; padding:10px; margin:30px 0;"> Bakım dizini bulunamadı </div>';
			exit;
        }
    }
}
?>