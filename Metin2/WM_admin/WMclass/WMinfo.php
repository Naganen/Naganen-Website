<?php
class WMinfo {
    public function WM_konum( $mapindex ) {
        if ( $mapindex == "1" ) {
            return "Yongan";
        } else if ( $mapindex == "3" ) {
            return "Jayang";
        } else if ( $mapindex == "4" ) {
            return "Jungrang";
        } else if ( $mapindex == "5" ) {
            return "Shinsoo - Hasun Dong";
        } else if ( $mapindex == "21" ) {
            return "Joan";
        } else if ( $mapindex == "23" ) {
            return "Bokjung";
        } else if ( $mapindex == "24" ) {
            return "Waryong";
        } else if ( $mapindex == "25" ) {
            return "Chunjo - Hasun Dong";
        } else if ( $mapindex == "41" ) {
            return "Pyungmo";
        } else if ( $mapindex == "43" ) {
            return "Bakra";
        } else if ( $mapindex == "44" ) {
            return "İmha";
        } else if ( $mapindex == "45" ) {
            return "Jinno - Hasun Dong";
        } else if ( $mapindex == "61" ) {
            return "Sohan Dağı";
        } else if ( $mapindex == "62" ) {
            return "Doyum Paper";
        } else if ( $mapindex == "63" ) {
            return "Yongbi Çölü";
        } else if ( $mapindex == "64" ) {
            return "Seuyong Vadisi";
        } else if ( $mapindex == "65" ) {
            return "Hwang Tapınağı";
        } else if ( $mapindex == "66" ) {
            return "Gumsan Kulesi";
        } else if ( $mapindex == "67" ) {
            return "Lungsam - Hayalet Orman";
        } else if ( $mapindex == "68" ) {
            return "Lungsam - Kızıl Orman";
        } else if ( $mapindex == "69" ) {
            return "Yılan Vadisi";
        } else if ( $mapindex == "70" ) {
            return "Devler Diyarı";
        } else if ( $mapindex == "71" ) {
            return "Kuahklo Dong";
        } else if ( $mapindex == "72" ) {
            return "Sürgün Mağarası";
        } else if ( $mapindex == "73" ) {
            return "Sürgün Mağarası";
        } else if ( $mapindex == "74" ) {
            return "Sohan Dağı";
        } else if ( $mapindex == "75" ) {
            return "Hwang Tapınağı";
        } else if ( $mapindex == "77" ) {
            return "Doyum Paper";
        } else if ( $mapindex == "78" ) {
            return "Seuyong Vadisi";
        } else if ( $mapindex == "79" ) {
            return "Sürgün Mağarası";
        } else if ( $mapindex == "81" ) {
            return "Nihah Salonu";
        } else if ( $mapindex == "100" ) {
            return "Alan";
        } else if ( $mapindex == "103" ) {
            return "T 01";
        } else if ( $mapindex == "104" ) {
            return "Örümcek Zindanı";
        } else if ( $mapindex == "105" ) {
            return "T 02";
        } else if ( $mapindex == "107" ) {
            return "Örümcek Zindanı";
        } else if ( $mapindex == "108" ) {
            return "Örümcek Zindanı";
        } else if ( $mapindex == "109" ) {
            return "Örümcek Zindanı";
        } else if ( $mapindex == "110" ) {
            return "T 03";
        } else if ( $mapindex == "111" ) {
            return "T 04";
        } else if ( $mapindex == "112" ) {
            return "Düello Haritası";
        } else if ( $mapindex == "113" ) {
            return "Ox Haritası";
        } else if ( $mapindex == "114" ) {
            return "Sungzi";
        } else if ( $mapindex == "118" ) {
            return "Sungzi";
        } else if ( $mapindex == "119" ) {
            return "Sungzi";
        } else if ( $mapindex == "120" ) {
            return "Sungzi";
        } else if ( $mapindex == "121" ) {
            return "Sungzi";
        } else if ( $mapindex == "122" ) {
            return "Sungzi";
        } else if ( $mapindex == "123" ) {
            return "Sungzi";
        } else if ( $mapindex == "124" ) {
            return "Sungzi";
        } else if ( $mapindex == "125" ) {
            return "Sungzi";
        } else if ( $mapindex == "126" ) {
            return "Sungzi";
        } else if ( $mapindex == "127" ) {
            return "Sungzi";
        } else if ( $mapindex == "128" ) {
            return "Sungzi";
        } else if ( $mapindex == "181" ) {
            return "3 Yol";
        } else if ( $mapindex == "182" ) {
            return "3 Yol";
        } else if ( $mapindex == "183" ) {
            return "3 Yol";
        } else if ( $mapindex == "184" ) {
            return "Sürgün Mağarası";
        } else if ( $mapindex == "185" ) {
            return "Sürgün Mağarası";
        } else if ( $mapindex == "186" ) {
            return "Sürgün Mağarası";
        } else if ( $mapindex == "187" ) {
            return "Sürgün Mağarası";
        } else if ( $mapindex == "188" ) {
            return "Sürgün Mağarası";
        } else if ( $mapindex == "189" ) {
            return "Sürgün Mağarası";
        } else if ( $mapindex == "206" ) {
            return "Devils Catacomb";
        } else if ( $mapindex == "207" ) {
            return "Nefrit Körfezi";
        } else if ( $mapindex == "208" ) {
            return "Ejderha Ateşi Burnu";
        } else if ( $mapindex == "209" ) {
            return "Guatama Uçurumu";
        } else if ( $mapindex == "210" ) {
            return "Yıldırım Dağları";
        } else if ( $mapindex == "211" ) {
            return "Örümcek Zindanı";
        } else {
            return "Belli Değil";
        }
    }
    public function WM_rutbe( $rutbe ) {
        if ( $rutbe > 11999 ) {
            return "<font color='#59ABE3'><b>Kahraman</b></font>";
        } elseif ( $rutbe > 7999 ) {
            return "<font color='#3498db'><b>Soylu</b></font>";
        } elseif ( $rutbe > 3999 ) {
            return "<font color='darkblue'><b>İyi</b></font>";
        } elseif ( $rutbe > 1999 ) {
            return "<font color='#2980b9'><b>Arkadaşça</b></font>";
        } elseif ( $rutbe > -3999 ) {
            return "Tarafsız";
        } elseif ( $rutbe > -7999 ) {
            return "<font color='#EB974E'>Agresif</font>";
        } elseif ( $rutbe > -11999 ) {
            return "<font color='#EB974E'><b>Hileli</b></font>";
        } elseif ( $rutbe < -20000 ) {
            return "<font color='#e74c3c'>Kötü Niyetli</font>";
        } elseif ( $rutbe >= -20000 ) {
            return "<font color='red'><b>Zalim</b></font>";
        }
    }
    public function grade( $pid, $gid, $grade ) {
        global $odb;
        $baskanmi = $odb->prepare( "SELECT master FROM player.guild WHERE id = ? && master = ?" );
        $baskanmi->execute( array(
             $gid,
            $pid 
        ) );
        if ( $baskanmi->rowCount() ) {
            return " Lonca Kurucusu";
        } else {
            $ney = $odb->prepare( "SELECT name FROM player.guild_grade WHERE guild_id = ? && grade = ?" );
            $ney->execute( array(
                 $gid,
                $grade 
            ) );
            $ney = $ney->fetch( PDO::FETCH_ASSOC );
            return $ney[ "name" ];
        }
    }
    public function skill_group( $job, $i ) {
        if ( $job == 0 || $job == 4 ) {
            if ( $i == 1 ) {
                $d = "Bedensel";
            } else if ( $i == 2 ) {
                $d = "Zihinsel";
            }
        } else if ( $job == 1 || $job == 5 ) {
            if ( $i == 1 ) {
                $d = "Yakın Dövüş";
            } else if ( $i == 2 ) {
                $d = "Uzak Dövüş";
            }
        } else if ( $job == 2 || $job == 6 ) {
            if ( $i == 1 ) {
                $d = "Kara Büyü";
            } else if ( $i == 2 ) {
                $d = "Büyülü Silah";
            }
        } else if ( $job == 3 || $job == 7 ) {
            if ( $i == 1 ) {
                $d = "asd";
            } else if ( $i == 2 ) {
                $d = "asd";
            }
        }
        return $d;
    }
    public function yang_cevir( $yang ) {
        $cevir = strlen( $yang );
        if ( ( $cevir == 1 || $cevir == 2 || $cevir == 3 ) ) {
            return $yang . " Yang";
        } else if ( $cevir == 4 ) {
            return substr( $yang, 0, -3 ) . " K";
        } else if ( $cevir == 5 ) {
            return substr( $yang, 0, -3 ) . " K";
        } else if ( $cevir == 6 ) {
            return substr( $yang, 0, -3 ) . " K";
        } else if ( $cevir == 7 ) {
            return substr( $yang, 0, -6 ) . " M";
        } else if ( $cevir == 8 ) {
            return substr( $yang, 0, -6 ) . " M";
        } else if ( $cevir == 9 ) {
            return substr( $yang, 0, -6 ) . " M";
        } else if ( $cevir == 10 ) {
            if ( substr( $yang, 1, -6 ) == 000 ) {
                $m = "";
            } else {
                $m = substr( $yang, 1, -6 ) . " M";
            }
            return substr( $yang, 0, -9 ) . " T " . $m;
        } else {
            return $yang;
        }
    }
    public function shops( ) {
        global $odb;
        $query = $odb->prepare( "SELECT * FROM player.shop ORDER BY vnum" );
        $query->execute();
        foreach ( $query as $row ) {
?>
		<option value="<?= $row[ "vnum" ]; ?>"><?= $row[ "name" ]; ?></option>
		<?php
        }
    }
    public function guild_grade( $gid, $playerid ) {
        global $odb;
        $query = $odb->prepare( "SELECT * FROM player.guild_grade WHERE guild_id = ? GROUP BY name" );
        $query->execute( array(
             $gid 
        ) );
        foreach ( $query as $row ) {
?>
		 <li><a onclick="WM_click('lonca_yetki_degis&pid=<?= $playerid; ?>&gid=<?= $gid; ?>&grade=<?= $row[ "grade" ]; ?>')" href="javascript:;"><i class="fa fa-bookmark"></i><?= $row[ "name" ]; ?> </a></li>
		 <?php
        }
    }
    public function item_resim( $id, $type = 0, $width = "", $height = "" ) {
        global $WMadmin;
        if ( $width != "" && $height != "" ) {
            $style = 'style="width:' . $width . 'px;height: ' . $height . 'px"';
        } else {
            $style = "";
        }
        return '<img ' . $style . ' src="' . $WMadmin->ayarlar( "base" ) . 'WM_global/img/item/' . $this->item_vnum( $id, $type ) . '.png">';
    }
    public function item_vnum( $id, $type = 0 ) {
        if ( strlen( $id ) == 1 ) {
            $bilgi  = "0000" . $id;
            $bilgi2 = substr( $bilgi, 0, -1 ) . "0";
        } else if ( strlen( $id ) == 2 ) {
            $bilgi  = "000" . $id;
            $bilgi2 = substr( $bilgi, 0, -1 ) . "0";
        } else if ( strlen( $id ) == 3 ) {
            $bilgi  = "00" . $id;
            $bilgi2 = substr( $bilgi, 0, -1 ) . "0";
        } else if ( strlen( $id ) == 4 ) {
            $bilgi  = "0" . $id;
            $bilgi2 = substr( $bilgi, 0, -1 ) . "0";
        } else if ( strlen( $id ) == 5 ) {
            $bilgi  = $id;
            $bilgi2 = substr( $bilgi, 0, -1 ) . "0";
        }
        if ( $type == 1 || $type == 2 ) {
            return $bilgi2;
        } else {
            return $bilgi;
        }
    }
}
?>

