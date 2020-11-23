<?php
if ( !defined( "WM_IZIN_KONTROL" ) ) {
    die( "Buraya giriş izniniz yoktur." );
    exit;
}
$pid               = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pid" ] ) ) );
$rank              = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "rank" ] ) ) );
$type              = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "type" ] ) ) );
$battle_type       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "battle_type" ] ) ) );
$level             = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "level" ] ) ) );
$ai_flag           = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "ai_flag" ] ) ) );
$attack_range      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "attack_range" ] ) ) );
$setRaceFlag       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "setRaceFlag" ] ) ) );
$setImmuneFlag     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_POST[ "setImmuneFlag" ] ) ) );
$empire            = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "empire" ] ) ) );
$folder            = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "folder" ] ) ) );
$on_click          = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "on_click" ] ) ) );
$aggressive_sight  = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "aggressive_sight" ] ) ) );
$damage_min        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "damage_min" ] ) ) );
$damage_max        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "damage_max" ] ) ) );
$max_hp            = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "max_hp" ] ) ) );
$aggressive_hp_pct = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "aggressive_hp_pct" ] ) ) );
$regen_cycle       = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "regen_cycle" ] ) ) );
$regen_percent     = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "regen_percent" ] ) ) );
$gold_min          = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "gold_min" ] ) ) );
$gold_max          = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "gold_max" ] ) ) );
$exp               = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "exp" ] ) ) );
$def               = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "def" ] ) ) );
$attack_speed      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "attack_speed" ] ) ) );
$move_speed        = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "move_speed" ] ) ) );
$st                = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "st" ] ) ) );
$dx                = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "dx" ] ) ) );
$ht                = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "ht" ] ) ) );
$iq                = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "iq" ] ) ) );
$drop_item         = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "drop_item" ] ) ) );
$dam_multiply      = $WMkontrol->WM_post( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_POST[ "dam_multiply" ] ) ) );
$update            = $odb->prepare( "UPDATE player.mob_proto SET rank = ?, type = ?, battle_type = ?, level = ?, ai_flag = ?, attack_range = ?, setRaceFlag = ?, setImmuneFlag = ?, empire = ?, folder = ?, on_click = ?, aggressive_sight = ?, damage_min = ?, damage_max = ?,
max_hp = ?, aggressive_hp_pct = ?, regen_cycle = ?, regen_percent = ?, gold_min = ?, gold_max = ?, exp = ?, def = ?, attack_speed = ?, move_speed = ?, st = ?, dx = ?, ht = ?, iq = ?, drop_item = ?, dam_multiply = ? WHERE vnum = ?
" );
$guncelle          = $update->execute( array(
     $rank,
    $type,
    $battle_type,
    $level,
    $ai_flag,
    $attack_range,
    $setRaceFlag,
    $setImmuneFlag,
    $empire,
    $folder,
    $on_click,
    $aggressive_sight,
    $damage_min,
    $damage_max,
    $max_hp,
    $aggressive_hp_pct,
    $regen_cycle,
    $regen_percent,
    $gold_min,
    $gold_max,
    $exp,
    $def,
    $attack_speed,
    $move_speed,
    $st,
    $dx,
    $ht,
    $iq,
    $drop_item,
    $dam_multiply,
    $pid 
) );
if ( $guncelle ) {
    $WMadmin->log_gonder( $pid . " Vnumlu Mob Düzenlendi" );
    $WMform->basari( "Mob başarıyla güncellendi" );
} else {
    $WMform->hata();
}
?>