<?php
$get       = $_GET[ 'id' ];
$player_id = $_GET[ 'pid' ];
$art       = $_GET[ 'art' ];
if ( strlen( $get ) == 6 ) {
    $value = substr( $get, -2 );
} else if ( strlen( $get ) == 7 ) {
    $value = substr( $get, -3 );
} else {
    $value = substr( $get, -1 );
}
$sql2 = $odb->prepare( "SELECT `vnum`, `socket0`, `socket1`, `socket2`, `socket3`, `socket4`, `socket5`, `attrtype0`, `attrvalue0`, `attrtype1`, `attrvalue1`, `attrtype2`, `attrvalue2`, `attrtype3`, `attrvalue3`, `attrtype4`, `attrvalue4`, `attrtype5`, `attrvalue5`, `attrtype6`, `attrvalue6` FROM `player`.`item` WHERE pos = ? && window = ? && owner_id = ?" );
$sql2->execute( array(
     $value,
    $art,
    $player_id 
) );
if ( $sql2 ) {
    $res2 = $sql2->fetch( PDO::FETCH_ASSOC );
    include_once( 'itemgoster/items.inc.php' );
    include_once( 'itemgoster/boni.inc.php' );
    $result = '
			   <div id="equip_conn">
			   <div id="eqc_name">' . $WMadmin->item_bul( $res2[ "vnum" ] ) . '</div>
			   <div id="eqc_boni">';
    for ( $i = 0; $i <= 6; $i++ ) {
        if ( isset( $boniListNr[ $res2[ 'attrtype' . $i ] ] ) ) {
            if ( substr( $boniListNr[ $res2[ 'attrtype' . $i ] ], -1 ) == '%' ) {
                $boni_desc  = substr( $boniListNr[ $res2[ 'attrtype' . $i ] ], 0, -1 );
                $boni_value = $res2[ 'attrvalue' . $i ] . '%';
            } else {
                $boni_desc  = $boniListNr[ $res2[ 'attrtype' . $i ] ];
                $boni_value = $res2[ 'attrvalue' . $i ];
            }
            $result .= '<p>' . htmlentities( $boni_desc ) . $boni_value . '</p>';
        }
    }
    $result .= '
		</div>
		<div id="eqc_steine">';
    for ( $k = 0; $k <= 5; $k++ ) {
        if ( strlen( $res2[ 'socket' . $k ] ) > 3 ) {
            if ( 1 == 1 ) {
                $result .= '<p><img src="' . $WMadmin->ayarlar( "base" ) . 'WM_global/img/item/' . $res2[ 'socket' . $k ] . '.png"></p>';
            }
        }
    }
    $result .= '</div></div><div id="eqc_foot"></div>';
    echo $result;
}
?>