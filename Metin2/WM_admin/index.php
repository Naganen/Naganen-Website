<?php
require_once 'header.php';
$yetkiler    = json_decode( $WMadmin->yonetici( "yetki" ) );
$yonetim_tur = $WMadmin->yonetici( "tur" );
@$sayfa = $WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "sayfa" ] ) );
if ( !$sayfa ) {
    require_once WMadmintema . 'index.php';
} else if ( $sayfa == "kullanicilar" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "a", $yetkiler ) ) ) {
        @$login = $WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "login" ] ) );
        $kontrol = $odb->prepare( "SELECT * FROM account WHERE login = ?" );
        $kontrol->execute( array(
             $login 
        ) );
        if ( $kontrol->rowCount() && $login != '' ) {
            $kfetch = $kontrol->fetch( PDO::FETCH_ASSOC );
            if ( @$_REQUEST[ "sutun" ] != "" ) {
                require_once WMadmintema . 'kullanicidetay2.php';
            } else {
                require_once WMadmintema . 'kullanicidetay.php';
            }
        } else {
            require_once WMadmintema . 'kullanicilar.php';
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "online_karakterler" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "d", $yetkiler ) ) ) {
        require_once WMadmintema . 'online_karakterler.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "karakterler" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "d", $yetkiler ) ) ) {
        @$name = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "name" ] ) ) );
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "id" ] ) ) );
        @$gor = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "gor" ] ) ) );
        $veri = array(
             $name 
        );
        if ( $gor == "envanter" ) {
            $ara     = "&& player.id = ?";
            $veri[ ] = $id;
        } else {
            $ara = "";
        }
        $kontrol = $odb->prepare( "SELECT player.*,player_index.empire,guild.name AS guild_name, guild_member.grade, guild_member.guild_id, account.login FROM player.player LEFT JOIN player.player_index ON player_index.id=player.account_id LEFT JOIN player.guild_member ON guild_member.pid=player.id LEFT JOIN player.guild ON guild.id=guild_member.guild_id INNER JOIN account.account ON account.id=player.account_id WHERE player.name = ? $ara" );
        $kontrol->execute( $veri );
        if ( $kontrol->rowCount() ) {
            $pfetch = $kontrol->fetch( PDO::FETCH_ASSOC );
            if ( $gor == "envanter" ) {
                require_once WMadmintema . 'karakterdetay_envanter.php';
            } else {
                require_once WMadmintema . 'karakterdetay.php';
            }
        } else {
            require_once WMadmintema . 'karakterler.php';
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "karakter_ara" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "d", $yetkiler ) ) ) {
        @$tur = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tur" ] ) ) );
        @$deger = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "deger" ] ) ) );
        require_once WMadmintema . 'karakter_ara.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "lonca_ara" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "e", $yetkiler ) ) ) {
        @$tur = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tur" ] ) ) );
        @$deger = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "deger" ] ) ) );
        require_once WMadmintema . 'lonca_ara.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "kullanici_ara" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "a", $yetkiler ) ) ) {
        @$tur = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tur" ] ) ) );
        @$deger = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "deger" ] ) ) );
        require_once WMadmintema . 'kullanici_ara.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "bugun_acilan_hesaplar" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "a", $yetkiler ) ) ) {
        require_once WMadmintema . 'bugun_acilan_hesaplar.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "ep_olan_hesaplar" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "a", $yetkiler ) ) ) {
        require_once WMadmintema . 'ep_olan_hesaplar.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "kullanici_olustur" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "a", $yetkiler ) ) ) {
        require_once WMadmintema . 'kullanici_olustur.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "gm_islemleri" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "f", $yetkiler ) ) ) {
        require_once WMadmintema . 'gm_islemleri.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "kullaniciban" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "b", $yetkiler ) ) ) {
        require_once WMadmintema . 'kullaniciban.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "ban_list" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "b", $yetkiler ) ) ) {
        require_once WMadmintema . 'ban_list.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "banliuyeler" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "b", $yetkiler ) ) ) {
        require_once WMadmintema . 'banliuyeler.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "bankalkicak" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "b", $yetkiler ) ) ) {
        require_once WMadmintema . 'bankalkicak.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "epislem" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "c", $yetkiler ) ) ) {
        require_once WMadmintema . 'epislem.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "lonca" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "e", $yetkiler ) ) ) {
        @$lonca = $WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "name" ] ) );
        $loncabul = $odb->prepare( "SELECT guild.*, player.name AS baskan, player.job FROM player.guild INNER JOIN player.player ON player.id = guild.master WHERE guild.name = ?" );
        $loncabul->execute( array(
             $lonca 
        ) );
        if ( $loncabul->rowCount() ) {
            $lfetch = $loncabul->fetch( PDO::FETCH_ASSOC );
            require_once WMadmintema . 'loncadetay.php';
        } else {
            require_once WMadmintema . 'lonca.php';
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "Npcshop" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "h", $yetkiler ) ) ) {
        @$vnum = $WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "vnum" ] ) );
        $kontrol = $odb->prepare( "SELECT * FROM player.shop WHERE vnum = ?" );
        $kontrol->execute( array(
             $vnum 
        ) );
        if ( $kontrol->rowCount() ) {
            $sfetch   = $kontrol->fetch( PDO::FETCH_ASSOC );
            $shopitem = $odb->prepare( "SELECT shop_item.*, item_proto.gold FROM player.shop_item INNER JOIN player.item_proto ON shop_item.item_vnum = item_proto.vnum WHERE shop_item.shop_vnum = ?" );
            $shopitem->execute( array(
                 $vnum 
            ) );
            require_once WMadmintema . 'Npcshopdetay.php';
        } else {
            require_once WMadmintema . 'Npcshop.php';
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "Npc_Ekle" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "h", $yetkiler ) ) ) {
        require_once WMadmintema . 'Npc_Ekle.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "Npc_Aktar" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "h", $yetkiler ) ) ) {
        require_once WMadmintema . 'Npc_Aktar.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "İtem_ara" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "j", $yetkiler ) ) ) {
        require_once WMadmintema . 'itemara.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "Antiflag_hesapla" ) {
    require_once WMadmintema . 'Antiflag_hesapla.php';
} else if ( $sayfa == "İtem_olustur" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "j", $yetkiler ) ) ) {
        require_once WMadmintema . 'item_olustur.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "item_islemleri" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "j", $yetkiler ) ) ) {
        require_once WMadmintema . 'item_islemleri.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "Server_efsunlari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "k", $yetkiler ) ) ) {
        require_once WMadmintema . 'Server_efsunlari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "Server_efsunlari_2" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "k", $yetkiler ) ) ) {
        require_once WMadmintema . 'Server_efsunlari_2.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "Refine_proto" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "l", $yetkiler ) ) ) {
        require_once WMadmintema . 'Refine_proto.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "Refine_ayarlari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "l", $yetkiler ) ) ) {
        require_once WMadmintema . 'Refine_ayarlari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "Mob_ayarlari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "m", $yetkiler ) ) ) {
        require_once WMadmintema . 'Mob_proto.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "Exp_ayarlari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "m", $yetkiler ) ) ) {
        require_once WMadmintema . 'Exp_ayarlari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "Teknik_destek" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "r", $yetkiler ) ) ) {
        @$tid = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tid" ] ) ) );
        @$tur = $WMkontrol->WM_get( $WMkontrol->WM_html( $_GET[ "tur" ] ) );
        $kontrol = $db->prepare( "SELECT * FROM destek WHERE sid = ? && id = ?" );
        $kontrol->execute( array(
             $_SESSION[ "server" ],
            $tid 
        ) );
        if ( $kontrol->rowCount() ) {
            $tfetch = $kontrol->fetch( PDO::FETCH_ASSOC );
            require_once WMadmintema . 'Teknik_destek_detay.php';
        } else if ( $tur == "odeme_onayli" ) {
            require_once WMadmintema . 'odeme_onayli.php';
        } else if ( $tur == "cevap_bekleyen" ) {
            require_once WMadmintema . 'cevap_bekleyen.php';
        } else {
            require_once WMadmintema . 'Teknik_destek.php';
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "destek_kategori" ) {
    if ( $yonetim_tur == 2 ) {
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
        $kontrol = $db->prepare( "SELECT * FROM destek_kategori WHERE id = ?" );
        $kontrol->execute( array(
             $id 
        ) );
        if ( !$id || $id == "" ) {
            require_once WMadmintema . 'destek_kategori.php';
        } else {
            if ( $kontrol->rowCount() ) {
                $fetch      = $kontrol->fetch( PDO::FETCH_ASSOC );
                $yetkililer = json_decode( $fetch[ "yetkililer" ] );
                require_once WMadmintema . 'destek_kategori_detay.php';
            } else {
                require_once WMadmintema . 'destek_kategori.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "destek_kategori_ekle" ) {
    if ( $yonetim_tur == 2 ) {
        require_once WMadmintema . 'destek_kategori_ekle.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "site_temalari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "n", $yetkiler ) ) ) {
        require_once WMadmintema . 'site_temalari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "market_temalari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "n", $yetkiler ) ) ) {
        require_once WMadmintema . 'market_temalari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "site_bakim" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "n", $yetkiler ) ) ) {
        require_once WMadmintema . 'site_bakim.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "mail_temalari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "n", $yetkiler ) ) ) {
        require_once WMadmintema . 'mail_temalari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "index_temalari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "n", $yetkiler ) ) ) {
        require_once WMadmintema . 'index_temalari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "domain_ana_sayfa" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "n", $yetkiler ) ) ) {
        require_once WMadmintema . 'domain_ana_sayfa.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "site_ayarlari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        require_once WMadmintema . 'site_ayarlari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "site_banlananlar" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        require_once WMadmintema . 'site_banlananlar.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "istatistik_arttirma" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        require_once WMadmintema . 'istatistik_arttirma.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "basvuru_ekle" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        require_once WMadmintema . 'basvuru_ekle.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "basvurular" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
        if ( !$id || $id == "" ) {
            require_once WMadmintema . 'basvurular.php';
        } else {
            $kontrol = $db->prepare( "SELECT * FROM basvurular WHERE sid = ? && id = ?" );
            $kontrol->execute( array(
                 $_SESSION[ "server" ],
                $id 
            ) );
            if ( $kontrol->rowCount() ) {
                $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                if ( $fetch[ "tur" ] == 1 ) {
                    require_once WMadmintema . 'basvuru_detay.php';
                } else {
                    require_once WMadmintema . 'basvuru_detay_2.php';
                }
            } else {
                require_once WMadmintema . 'basvurular.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "server_ayarlari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "z", $yetkiler ) ) ) {
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
        if ( !$id || $id == "" ) {
            require_once WMadmintema . 'index.php';
        } else {
            $kontrol = $db->prepare( "SELECT * FROM server WHERE id = ?" );
            $kontrol->execute( array(
                 $id 
            ) );
            if ( $kontrol->rowCount() ) {
                $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                require_once WMadmintema . 'server_detay.php';
            } else {
                require_once WMadmintema . 'index.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "server_ayar" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "y", $yetkiler ) ) ) {
        require_once WMadmintema . 'server_ayar.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "onayli_karakter" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "d", $yetkiler ) ) ) {
        require_once WMadmintema . 'onayli_karakter.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "pack_ayarlari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        @$pack = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "pack" ] ) ) );
        $kontrol_pack = $db->prepare( "SELECT * FROM packlar WHERE sid = ? && id = ?" );
        $kontrol_pack->execute( array(
             $_SESSION[ "server" ],
            $pack 
        ) );
        if ( $kontrol_pack->rowCount() ) {
            $pack_yes   = true;
            $pack_fetch = $kontrol_pack->fetch( PDO::FETCH_ASSOC );
        }
        require_once WMadmintema . 'pack_ayarlari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "ep_satin_al_sayfasi" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "p", $yetkiler ) ) ) {
        require_once WMadmintema . 'ep_satin_al_sayfasi.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "sistem_kur" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        require_once WMadmintema . 'sistem_kur.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "sistemler" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        @$ayar = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "ayar" ] ) ) );
        if ( !$ayar ) {
            require_once WMadmintema . 'sistem_kur.php';
        } else {
            $sistem_dosya = 'WM_sistemler/' . $ayar . '/ayar.php';
            if ( file_exists( $sistem_dosya ) ) {
                require_once $sistem_dosya;
            } else {
                require_once WMadmintema . 'sistem_kur.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "anasayfa_ayarlari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        require_once WMadmintema . 'anasayfa_ayarlari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "duyuru" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        @$islem = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "islem" ] ) ) );
        if ( !$islem ) {
            require_once WMadmintema . 'duyurular.php';
        } else if ( $islem == "ekle" ) {
            require_once WMadmintema . 'duyuru_ekle.php';
        } else {
            $kontrol = $db->prepare( "SELECT * FROM duyurular WHERE id = ? && sid = ?" );
            $kontrol->execute( array(
                 $islem,
                $_SESSION[ "server" ] 
            ) );
            if ( $kontrol->rowCount() ) {
                $dfetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                require_once WMadmintema . 'duyuru_detay.php';
            } else {
                require_once WMadmintema . 'duyurular.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "mail_ayarlari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "t", $yetkiler ) ) ) {
        require_once WMadmintema . 'mail_ayarlari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "anket" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        @$islem = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "islem" ] ) ) );
        if ( !$islem ) {
            require_once WMadmintema . 'anketler.php';
        } else {
            $kontrol = $db->prepare( "SELECT * FROM anketler WHERE id = ? && sid = ?" );
            $kontrol->execute( array(
                 $islem,
                $_SESSION[ "server" ] 
            ) );
            if ( $kontrol->rowCount() ) {
                $afetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                if ( $afetch[ "tur" ] == 2 ) {
                    require_once WMadmintema . 'anket_detay.php';
                } else {
                    require_once WMadmintema . 'anket_detay_anasayfa.php';
                }
            } else {
                require_once WMadmintema . 'anketler.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "anket_ekle" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        require_once WMadmintema . 'anket_ekle.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "market_kategori" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "s", $yetkiler ) ) ) {
        require_once WMadmintema . 'market_kategori.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "market_duyuru_ekle" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "s", $yetkiler ) ) ) {
        require_once WMadmintema . 'market_duyuru_ekle.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "market_duyurular" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "s", $yetkiler ) ) ) {
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
        $kontrol = $db->prepare( "SELECT * FROM market_duyuru WHERE sid = ? && id = ?" );
        $kontrol->execute( array(
             $_SESSION[ "server" ],
            $id 
        ) );
        if ( !$id || $id == "" ) {
            require_once WMadmintema . 'market_duyurular.php';
        } else {
            if ( $kontrol->rowCount() ) {
                $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                require_once WMadmintema . 'market_duyuru_detay.php';
            } else {
                require_once WMadmintema . 'market_duyurular.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "market_item_ekle" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "s", $yetkiler ) ) ) {
        require_once WMadmintema . 'market_item_ekle.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "market_item" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "s", $yetkiler ) ) ) {
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "id" ] ) ) );
        if ( !$id || !isset( $id ) ) {
            require_once WMadmintema . 'market_item.php';
        } else {
            $kontrol = $db->prepare( "SELECT * FROM market_item WHERE sid = ? && id = ?" );
            $kontrol->execute( array(
                 $_SESSION[ "server" ],
                $id 
            ) );
            if ( $kontrol->rowCount() ) {
                $mfetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                require_once WMadmintema . 'market_item_detay.php';
            } else {
                require_once WMadmintema . 'market_item.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "market_tas" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "s", $yetkiler ) ) ) {
        require_once WMadmintema . 'market_tas.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "market_efsun_ekle" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "s", $yetkiler ) ) ) {
        require_once WMadmintema . 'market_efsun_ekle.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "market_efsun" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "s", $yetkiler ) ) ) {
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_tostring( $_GET[ "id" ] ) ) );
        if ( !$id || !isset( $id ) ) {
            require_once WMadmintema . 'market_efsun.php';
        } else {
            $kontrol = $db->prepare( "SELECT * FROM market_efsun WHERE sid = ? && id = ?" );
            $kontrol->execute( array(
                 $_SESSION[ "server" ],
                $id 
            ) );
            if ( $kontrol->rowCount() ) {
                $efetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                require_once WMadmintema . 'market_efsun_detay.php';
            } else {
                require_once WMadmintema . 'market_efsun.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "market_log" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "s", $yetkiler ) ) ) {
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
        if ( !$id || $id == "" ) {
            require_once WMadmintema . 'market_log.php';
        } else {
            $kontrol = $db->prepare( "SELECT * FROM market_log WHERE sid = ? && id = ? && tur = ?" );
            $kontrol->execute( array(
                 $_SESSION[ "server" ],
                $id,
                2 
            ) );
            if ( $kontrol->rowCount() ) {
                $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                require_once WMadmintema . 'market_log_detay.php';
            } else {
                require_once WMadmintema . 'market_log.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "gm_listesi" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "f", $yetkiler ) ) ) {
        require_once WMadmintema . 'gm_listesi.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "statu_editler" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "g", $yetkiler ) ) ) {
        require_once WMadmintema . 'statu_editler.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "editli_itemler" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "g", $yetkiler ) ) ) {
        require_once WMadmintema . 'editli_itemler.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "log" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "u", $yetkiler ) ) ) {
        @$tur = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "tur" ] ) ) );
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
        if ( !$tur || $tur == "" || !$id || $id == "" ) {
            require_once WMadmintema . 'log.php';
        } else {
            $kontrol = $db->prepare( "SELECT * FROM log WHERE tur != ? && sid = ? && tur = ? && id = ? ORDER BY id DESC" );
            $kontrol->execute( array(
                 4,
                $_SESSION[ "server" ],
                $tur,
                $id 
            ) );
            if ( $kontrol->rowCount() ) {
                $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                if ( $fetch[ "tur" ] == 2 ) {
                    require_once WMadmintema . 'log_detay.php';
                } else if ( $fetch[ "tur" ] == 3 ) {
                    require_once WMadmintema . 'log_detay_2.php';
                }
            } else {
                require_once WMadmintema . 'log.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "giris_log" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "u", $yetkiler ) ) ) {
        require_once WMadmintema . 'giris_log.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "kullanici_log" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "u", $yetkiler ) ) ) {
        require_once WMadmintema . 'kullanici_log.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "ep_fiyatlari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "s", $yetkiler ) ) ) {
        require_once WMadmintema . 'market_ep_fiyatlari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "bakim_islemleri" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "v", $yetkiler ) ) ) {
        require_once WMadmintema . 'bakim_islemleri.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "gm_loglari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "u", $yetkiler ) ) ) {
        require_once WMadmintema . 'gm_loglari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "ch_loglari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "u", $yetkiler ) ) ) {
        require_once WMadmintema . 'ch_loglari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "hile_loglari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "u", $yetkiler ) ) ) {
        require_once WMadmintema . 'hile_loglari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "bagirma_loglari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "u", $yetkiler ) ) ) {
        require_once WMadmintema . 'bagirma_loglari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "item_detay" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "j", $yetkiler ) ) ) {
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
        $kontrol = $odb->prepare( "SELECT * FROM player.item WHERE id = ?" );
        $kontrol->execute( array(
             $id 
        ) );
        if ( $kontrol->rowCount() ) {
            $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
            require_once WMadmintema . 'item_detay.php';
        } else {
            require_once WMadmintema . 'index.php';
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "sayfa_ekle" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "p", $yetkiler ) ) ) {
        require_once WMadmintema . 'sayfa_ekle.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "sayfa" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "p", $yetkiler ) ) ) {
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
        $kontrol = $db->prepare( "SELECT * FROM sayfalar WHERE id = ? && sid = ?" );
        $kontrol->execute( array(
             $id,
            $_SESSION[ "server" ] 
        ) );
        if ( $kontrol->rowCount() ) {
            $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
            require_once WMadmintema . 'sayfa_detay.php';
        } else {
            require_once WMadmintema . 'sayfalar.php';
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "hatalar" ) {
    require_once WMadmintema . 'hatalar.php';
} else if ( $sayfa == "bildirimler" ) {
    require_once WMadmintema . 'bildirimler.php';
} else if ( $sayfa == "alt_kullanici_ekle" ) {
    if ( $yonetim_tur == 2 ) {
        require_once WMadmintema . 'alt_kullanici_ekle.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "alt_kullanicilar" ) {
    if ( $yonetim_tur == 2 ) {
        @$id = $WMkontrol->WM_get( $WMkontrol->WM_html( $WMkontrol->WM_toint( $_GET[ "id" ] ) ) );
        if ( !$id || $id == "" ) {
            require_once WMadmintema . 'alt_kullanicilar.php';
        } else {
            $kontrol = $db->prepare( "SELECT * FROM users WHERE id = ? && tur = ?" );
            $kontrol->execute( array(
                 $id,
                1 
            ) );
            if ( $kontrol->rowCount() ) {
                $fetch = $kontrol->fetch( PDO::FETCH_ASSOC );
                require_once WMadmintema . 'alt_kullanici_detay.php';
            } else {
                require_once WMadmintema . 'alt_kullanicilar.php';
            }
        }
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "server_ekle" ) {
    if ( $yonetim_tur == 2 ) {
        require_once WMadmintema . 'server_ekle.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "kullanici_bilgilerini_duzenle" ) {
    require_once WMadmintema . 'kullanici_bilgilerini_duzenle.php';
} else if ( $sayfa == "server_linkleri" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "o", $yetkiler ) ) ) {
        $link = json_decode( $WMadmin->serverbilgi( "linkler" ) );
        require_once WMadmintema . 'server_linkleri.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
} else if ( $sayfa == "tema_ayarlari" ) {
    if ( ( $yonetim_tur == 2 ) || ( $yonetim_tur == 1 && in_array( "n", $yetkiler ) ) ) {
        $tema_ayarlari = json_decode( $WMadmin->serverbilgi( "tema_a" ) );
        $istatistikler = json_decode( $tema_ayarlari[ 0 ] );
        $siralama      = json_decode( $tema_ayarlari[ 1 ] );
        $drop          = json_decode( $tema_ayarlari[ 2 ] );
        $genel         = json_decode( $tema_ayarlari[ 3 ] );
        $tema_ayar     = json_decode( $WMadmin->serverbilgi( "tema_ayar" ) );
        $duyuru        = json_decode( $WMadmin->serverbilgi( "duyuru" ) );
        require_once WMadmintema . 'tema_ayarlari.php';
    } else {
        require_once WMadmintema . 'yetki_yok.php';
    }
}
require_once 'footer.php';
?>