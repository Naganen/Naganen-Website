<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>WMCP - <?=(!@$_GET["sayfa"]) ? "Ana Sayfa" : $WMkontrol->bread($WMkontrol->WM_html($_GET["sayfa"])); $sayfa = $WMkontrol->WM_html($_GET["sayfa"]);?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?=WMadmintema;?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?=WMadmintema;?>dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?=WMadmintema;?>dist/css/editor.css">
    <link rel="stylesheet" href="<?=WMadmintema;?>dist/css/jquery.modal.css">
    <link rel="stylesheet" href="<?=WMadmintema;?>dist/css/skins/_all-skins.css">
	<script src="<?=WMadmintema;?>plugins/jQuery/jquery-2.2.3.min.js"></script>
	<link rel="shortcut icon" type="image/png" href="<?=WMadmintema;?>favicon.png"/>

		<script type="text/javascript">
	    //<![CDATA[
        $(window).load(function () { // makes sure the whole site is loaded
            $('#status').fadeOut(); // will first fade out the loading animation
            $('#preloader').delay(1).fadeOut('slow'); // will fade out the white DIV that covers the website.
            $('body').delay(1).css({'overflow':'visible'});
        })
    //]]>
                                         

	</script>
	
	
	
  </head>
  
	<div id="preloader">
		<div id="status"></div>
	</div>
  
  
  
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>WM</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>WM</b>CP</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("r", $yetkiler))){ ?>
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-ticket"></i>
              <span class="label label-success"><?=destek("bekleyen");?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">Cevap Bekleyen <?=destek("bekleyen");?></li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <?php $cevapbekleyen = $db->query("SELECT * FROM destek 
                      WHERE (durum=0 OR durum=2) && sid = '".$_SESSION["server"]."' ORDER BY id DESC");  ?>
                    <?php foreach($cevapbekleyen as $cevapb){  ?>
                    <li>
                      <!-- start message -->
                      <a href="index.php?sayfa=Teknik_destek&tid=<?=$cevapb["id"];?>">
                        <div class="pull-left">
                          <img src="<?=WMadmintema;?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          <?=$cevapb["acan"];?>
                          <small><i class="fa fa-clock-o"></i> <?=WM_zaman_cevir($cevapb["tarih"]);?></small>
                        </h4>
                        <p><?=$WMinf->kisalt($cevapb["konu"], 80);?></p>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>
                </li>
                <li class="footer"><a href="index.php?sayfa=Teknik_destek">Tüm Talepleri Gör</a></li>
              </ul>
            </li>
            <!-- Notifications: style can be found in dropdown.less -->
            <?php } ?>
            <?php 
              $bildirimler = $db->query("SELECT * FROM bildirim WHERE sid = '".$_SESSION["server"]."' && alan = '".$_SESSION["adminisim"]."' && alici_tur = '2' && durum = '1'");
              
              ?>
            <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning"><?=$bildirimler->rowCount();?></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header"><?=$bildirimler->rowCount();?> bildirim</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <?php foreach($bildirimler as $bildirim){ ?>
                    <li>
                      <a href="javascript:;" onclick="WM_click('bildirim_goruntule&fid=1&olay_yeri=<?=$bildirim["olay_yeri"];?>&tur=<?=$bildirim["tur"];?>&bildirim_id=<?=$bildirim["id"];?>')">
                      <i class="fa fa-bell-o text-aqua"></i> <?=$bildirim["bildirim"];?>
                      </a>
                    </li>
                    <?php } ?>
                  </ul>
                </li>
                <li class="footer"><a href="index.php?sayfa=bildirimler">Tüm Bildirimler</a></li>
              </ul>
            </li>
            <!-- Tasks: style can be found in dropdown.less -->
            <li class="dropdown tasks-menu">
              <a href="index.php?sayfa=hatalar">
              <i class="fa fa-warning"></i>
              <span class="label label-danger"><?=hatalar();?></span>
              </a>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="index.php?sayfa=kullanici_bilgilerini_duzenle">
              <img src="<?=WMadmintema;?>img/logo_155x132.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$_SESSION["adminisim"];?></span>
              </a>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="cikis.php"><i class="fa fa-sign-out"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?=WMadmintema;?>logok.png" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Hoşgeldiniz</p>
            <p><?=$_SESSION["adminisim"];?></p>
          </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">Server İşlemleri <i class="fa fa-wrench pull-right"></i></li>
          <?php if($yonetim_tur == 2){ ?>
          <li class="<?=($sayfa == "server_ekle") ? "active" : ""; ?>">
            <a href="index.php?sayfa=server_ekle">
            <i class="fa fa-plus"></i> <span>Server Ekle</span>
            </a>
          </li>
          <?php } ?>
          <li class="treeview <?=($sayfa == "server_ayarlari" && @$WMkontrol->WM_get($WMkontrol->WM_html($_GET["id"])) != '') ? 'active' : '';?>">
            <a href="#">
            <i class="fa fa-cubes"></i> <span>Serverlar</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <?php
                $query = $db->query("SELECT * FROM server");
                foreach($query as $row){
                	
                	if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array($row["id"], $serverlar))){
                
                	?>
              <li class="treeview  <?=($sayfa == "server_ayarlari" && @$WMkontrol->WM_get($WMkontrol->WM_html($_GET["id"])) == $row["id"]) ? 'active' : '';?>">
                <a href="javascript:;"><span class="fa fa-cube"></span> <span><?=$row["isim"];?></span> <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span></a>
                <ul class="treeview-menu">
                  <li><a href="javascript:;" onclick="WM_click('server_islemleri&formid=1&server_id=<?=$row["id"];?>')"><i class="fa fa-cog"></i> Yönet </a></li>
                  <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("z", $yetkiler))){ ?>
                  <li class="<?=($sayfa == "server_ayarlari" && @$WMkontrol->WM_get($WMkontrol->WM_html($_GET["id"])) == $row["id"]) ? 'active' : '';?>"><a href="index.php?sayfa=server_ayarlari&id=<?=$row["id"];?>"><i class="fa fa-edit"></i> Düzenle </a></li>
                  <?php } ?>
                </ul>
              </li>
              <?php
                }
                
                }
                ?>
            </ul>
          </li>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("y", $yetkiler))){ ?>
          <li class="<?=($sayfa == "server_ayar") ? "active" : ""; ?>">
            <a href="index.php?sayfa=server_ayar">
            <i class="fa fa-empire"></i> <span>Server Ayarları</span>
            </a>
          </li>
          <?php } ?>
          <li>
            <a href="<?=$WMadmin->serverbilgi("link");?>" target="_blank">
            <i class="fa fa-send"></i> <span>Server Sitesine Git</span>
            </a>
          </li>
          <li class="header">Oyun İşlemleri <i class="fa fa-gamepad pull-right"></i></li>
          <li class="<?=(!$sayfa) ? "active" : ""; ?>">
            <a href="index.php" target="_blank">
            <i class="fa fa-dashboard"></i> <span>Ana Sayfa</span>
            </a>
          </li>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("a", $yetkiler)) || ($yonetim_tur == 1 && in_array("b", $yetkiler)) || ($yonetim_tur == 1 && in_array("c", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "ep_olan_hesaplar" OR $sayfa == "bugun_acilan_hesaplar" OR $sayfa == "kullanici_olustur" OR $sayfa == "ban_list" OR $sayfa == "kullanici_ara" OR $sayfa == "kullanicilar" OR $sayfa == "kullaniciban" OR $sayfa == "kullaniciban" OR $sayfa == "banliuyeler" OR  $sayfa =="bankalkicak" OR $sayfa == "epislem") ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-user"></i>
            <span>Kullanıcı İşlemleri</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("a", $yetkiler))){ ?>
              <li class="<?=($sayfa == "kullanicilar") ? "active" : ""; ?>"><a href="index.php?sayfa=kullanicilar"><i class="fa fa-circle-o"></i>Kullanıcıları Gör</a></li>
              <li class="<?=($sayfa == "bugun_acilan_hesaplar") ? "active" : ""; ?>"><a href="index.php?sayfa=bugun_acilan_hesaplar"><i class="fa fa-circle-o"></i>Bugün Kayıt Olanlar</a></li>
              <li class="<?=($sayfa == "ep_olan_hesaplar") ? "active" : ""; ?>"><a href="index.php?sayfa=ep_olan_hesaplar"><i class="fa fa-circle-o"></i>Epi Olan Hesaplar</a></li>
              <li class="<?=($sayfa == "kullanici_ara") ? "active" : ""; ?>"><a href="index.php?sayfa=kullanici_ara"><i class="fa fa-circle-o"></i> Kullanıcı Ara</a></li>
              <li class="<?=($sayfa == "kullanici_olustur") ? "active" : ""; ?>"><a href="index.php?sayfa=kullanici_olustur"><i class="fa fa-circle-o"></i> Kullanıcı Oluştur</a></li>
              <?php } ?>
              <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("b", $yetkiler))){ ?>
              <li class="<?=($sayfa == "kullaniciban") ? "active" : ""; ?>"><a href="index.php?sayfa=kullaniciban"><i class="fa fa-circle-o"></i> Kullanıcı Banla</a></li>
              <li class="<?=($sayfa == "banliuyeler") ? "active" : ""; ?>"><a href="index.php?sayfa=banliuyeler"><i class="fa fa-circle-o"></i> Banlı Kullanıcılar</a></li>
              <li class="<?=($sayfa == "bankalkicak") ? "active" : ""; ?>"><a href="index.php?sayfa=bankalkicak"><i class="fa fa-circle-o"></i> Banı Kalkacak Üyeler</a></li>
              <li class="<?=($sayfa == "ban_list") ? "active" : ""; ?>"><a href="index.php?sayfa=ban_list"><i class="fa fa-circle-o"></i> Ban Logları</a></li>
              <?php } ?>
              <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("c", $yetkiler))){ ?>
              <li class="<?=($sayfa == "epislem") ? "active" : ""; ?>"><a href="index.php?sayfa=epislem"><i class="fa fa-circle-o"></i> Ep Yükle - Sil</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("d", $yetkiler)) || ($yonetim_tur == 1 && in_array("e", $yetkiler)) || ($yonetim_tur == 1 && in_array("f", $yetkiler)) || ($yonetim_tur == 1 && in_array("g", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "lonca_ara" OR $sayfa == "online_karakterler" OR $sayfa == "statu_editler" OR $sayfa == "karakterler" OR $sayfa == "lonca" OR $sayfa == "gm_islemleri" OR $sayfa == "karakter_ara" OR $sayfa == "onayli_karakter") ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-group"></i>
            <span>Karakterler - Loncalar</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("d", $yetkiler))){ ?>
              <li class="<?=($sayfa == "karakterler") ? "active" : ""; ?>"><a href="index.php?sayfa=karakterler"><i class="fa fa-circle-o"></i> Karakterler</a></li>
              <li class="<?=($sayfa == "online_karakterler") ? "active" : ""; ?>"><a href="index.php?sayfa=online_karakterler"><i class="fa fa-circle-o"></i> Online Karakterler</a></li>
              <li class="<?=($sayfa == "karakter_ara") ? "active" : ""; ?>"><a href="index.php?sayfa=karakter_ara"><i class="fa fa-circle-o"></i> Karakter Ara</a></li>
              <li class="<?=($sayfa == "onayli_karakter") ? "active" : ""; ?>"><a href="index.php?sayfa=onayli_karakter"><i class="fa fa-circle-o"></i> Onaylı Karakterler</a></li>
              <?php } ?>
              <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("e", $yetkiler))){ ?>
              <li class="<?=($sayfa == "lonca") ? "active" : ""; ?>"><a href="index.php?sayfa=lonca"><i class="fa fa-circle-o"></i> Loncalar</a></li>
              <li class="<?=($sayfa == "lonca_ara") ? "active" : ""; ?>"><a href="index.php?sayfa=lonca_ara"><i class="fa fa-circle-o"></i> Lonca Ara</a></li>
              <?php } ?>
              <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("f", $yetkiler))){ ?>
              <li class="<?=($sayfa == "gm_islemleri") ? "active" : ""; ?>"><a href="index.php?sayfa=gm_islemleri"><i class="fa fa-circle-o"></i> GM İşlemleri</a></li>
              <?php } ?>
              <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("g", $yetkiler))){ ?>
              <li class="<?=($sayfa == "statu_editler") ? "active" : ""; ?>"><a href="index.php?sayfa=statu_editler"><i class="fa fa-circle-o"></i> Statusu Editli Ara</a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("h", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "Npcshop" OR $sayfa == "Npc_Ekle" OR $sayfa == "Npc_Aktar") ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-shopping-cart"></i>
            <span>NPC İşlemleri</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($sayfa == "Npcshop") ? "active" : ""; ?>"><a href="index.php?sayfa=Npcshop"><i class="fa fa-circle-o"></i> NPC ' LER</a></li>
              <li class="<?=($sayfa == "Npc_Ekle") ? "active" : ""; ?>"><a href="index.php?sayfa=Npc_Ekle"><i class="fa fa-circle-o"></i> NPC Ekle </a></li>
              <li class="<?=($sayfa == "Npc_Aktar") ? "active" : ""; ?>"><a href="index.php?sayfa=Npc_Aktar"><i class="fa fa-circle-o"></i> NPC Aktar </a></li>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("j", $yetkiler)) || ($yonetim_tur == 1 && in_array("g", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "item_islemleri" OR $sayfa == "editli_itemler" OR $sayfa == "İtem_ara" OR $sayfa == "Antiflag_hesapla" OR $sayfa == "İtem_olustur") ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-magic"></i>
            <span>İtem İşlemleri</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("j", $yetkiler))){ ?>
              <li class="<?=($sayfa == "İtem_ara") ? "active" : ""; ?>"><a href="index.php?sayfa=İtem_ara"><i class="fa fa-circle-o"></i> İtem Ara </a></li>
              <li class="<?=($sayfa == "item_islemleri") ? "active" : ""; ?>"><a href="index.php?sayfa=item_islemleri"><i class="fa fa-circle-o"></i> İtem İşlemleri </a></li>
              <li class="<?=($sayfa == "Antiflag_hesapla") ? "active" : ""; ?>"><a href="index.php?sayfa=Antiflag_hesapla"><i class="fa fa-circle-o"></i> Anti Flag Hesapla </a></li>
              <li class="<?=($sayfa == "İtem_olustur") ? "active" : ""; ?>"><a href="index.php?sayfa=İtem_olustur"><i class="fa fa-circle-o"></i> İtem Oluştur </a></li>
              <?php } ?>
              <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("g", $yetkiler))){ ?>
              <li class="<?=($sayfa == "editli_itemler") ? "active" : ""; ?>"><a href="index.php?sayfa=editli_itemler"><i class="fa fa-circle-o"></i> Editli İtemleri Bul </a></li>
              <?php } ?>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("k", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "Server_efsunlari" OR $sayfa == "Server_efsunlari_2") ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-diamond"></i>
            <span>Efsun İşlemleri</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($sayfa == "Server_efsunlari") ? "active" : ""; ?>"><a href="index.php?sayfa=Server_efsunlari"><i class="fa fa-circle-o"></i> Server Efsunları Gör </a></li>
              <li class="<?=($sayfa == "Server_efsunlari_2") ? "active" : ""; ?>"><a href="index.php?sayfa=Server_efsunlari_2"><i class="fa fa-circle-o"></i> Server 2.Efsunları Gör </a></li>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("l", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "Refine_proto" OR $sayfa == "Refine_ayarlari") ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-sort"></i>
            <span>+ Basma İşlemleri</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($sayfa == "Refine_proto") ? "active" : ""; ?>"><a href="index.php?sayfa=Refine_proto"><i class="fa fa-circle-o"></i> + Basma Oranları </a></li>
              <li class="<?=($sayfa == "Refine_ayarlari") ? "active" : ""; ?>"><a href="index.php?sayfa=Refine_ayarlari"><i class="fa fa-circle-o"></i> + Basma Ayarları </a></li>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("m", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "Exp_ayarlari" OR $sayfa == "Mob_ayarlari") ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-crosshairs"></i>
            <span>Mob İşlemleri</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($sayfa == "Mob_ayarlari") ? "active" : ""; ?>"><a href="index.php?sayfa=Mob_ayarlari"><i class="fa fa-circle-o"></i> Mob Ara / Düzenle </a></li>
              <li class="<?=($sayfa == "Exp_ayarlari") ? "active" : ""; ?>"><a href="index.php?sayfa=Exp_ayarlari"><i class="fa fa-circle-o"></i> Exp Ayarları </a></li>
            </ul>
          </li>
          <?php } ?>
          <li class="header">Site İşlemleri <i class="fa fa-globe pull-right"></i></li>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("n", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "site_bakim" OR $sayfa == "tema_ayarlari" OR $sayfa == "domain_ana_sayfa" OR $sayfa == "site_temalari" OR $sayfa == "index_temalari" OR $sayfa == "market_temalari" OR $sayfa == "mail_temalari" ) ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-image"></i>
            <span>Tema Ayarları</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($sayfa == "domain_ana_sayfa") ? "active" : ""; ?>"><a href="index.php?sayfa=domain_ana_sayfa"><i class="fa fa-circle-o"></i> Domain Ana Sayfa Ayarları </a></li>
              <li class="<?=($sayfa == "tema_ayarlari") ? "active" : ""; ?>"><a href="index.php?sayfa=tema_ayarlari"><i class="fa fa-circle-o"></i> Tema Ayarları </a></li>
              <li class="<?=($sayfa == "site_bakim") ? "active" : ""; ?>"><a href="index.php?sayfa=site_bakim"><i class="fa fa-circle-o"></i> Site Bakım Ayarları </a></li>
              <li class="<?=($sayfa == "site_temalari") ? "active" : ""; ?>"><a href="index.php?sayfa=site_temalari"><i class="fa fa-circle-o"></i> Site Temaları</a></li>
              <li class="<?=($sayfa == "index_temalari") ? "active" : ""; ?>"><a href="index.php?sayfa=index_temalari"><i class="fa fa-circle-o"></i> İndex Şablonları</a></li>
              <li class="<?=($sayfa == "market_temalari") ? "active" : ""; ?>"><a href="index.php?sayfa=market_temalari"><i class="fa fa-circle-o"></i> Market Temaları</a></li>
              <li class="<?=($sayfa == "mail_temalari" ) ? "active" : ""; ?>"><a href="index.php?sayfa=mail_temalari"><i class="fa fa-circle-o"></i> Mail Şablonları </a></li>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("o", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "site_banlananlar" OR $sayfa == "istatistik_arttirma" OR $sayfa == "basvurular" OR $sayfa == "basvuru_ekle" OR $sayfa == "server_linkleri" OR $sayfa == "duyuru" OR $sayfa == "anasayfa_ayarlari" OR $sayfa == "site_ayarlari" OR $sayfa == "pack_ayarlari" OR $sayfa == "sistem_kur" OR $sayfa == "anket_ekle" OR $sayfa == "anket"  ) ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-cog"></i>
            <span>Genel Site Ayarları</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($sayfa == "site_ayarlari") ? "active" : ""; ?>"><a href="index.php?sayfa=site_ayarlari"><i class="fa fa-circle-o"></i> Genel Ayarlar </a></li>
              <li class="<?=($sayfa == "server_linkleri") ? "active" : ""; ?>"><a href="index.php?sayfa=server_linkleri"><i class="fa fa-circle-o"></i> Link Ayarları </a></li>
              <li class="<?=($sayfa == "anasayfa_ayarlari") ? "active" : ""; ?>"><a href="index.php?sayfa=anasayfa_ayarlari"><i class="fa fa-circle-o"></i> Krallar - Sosyal Ağ</a></li>
              <li class="<?=($sayfa == "site_banlananlar") ? "active" : ""; ?>"><a href="index.php?sayfa=site_banlananlar"><i class="fa fa-circle-o"></i> Site İP Ban At</a></li>
              <li class="<?=($sayfa == "pack_ayarlari") ? "active" : ""; ?>"><a href="index.php?sayfa=pack_ayarlari"><i class="fa fa-circle-o"></i> Pack Ayarları</a></li>
              <li class="<?=($sayfa == "istatistik_arttirma") ? "active" : ""; ?>"><a href="index.php?sayfa=istatistik_arttirma"><i class="fa fa-circle-o"></i> İstatistik Arttırma</a></li>
              <li class="<?=($sayfa == "sistem_kur") ? "active" : ""; ?>"><a href="index.php?sayfa=sistem_kur"><i class="fa fa-circle-o"></i> Sistem Kur / Ayarlar</a></li>
              <li class="treeview <?=($sayfa == "basvurular" OR $sayfa == "basvuru_ekle") ? "active" : ""; ?>">
                <a href="#"><i class="fa fa-circle-o"></i> Başvuru İşlemleri             <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?=($sayfa == "basvuru_ekle") ? "active" : ""; ?>"><a href="index.php?sayfa=basvuru_ekle"><i class="fa fa-circle-o"></i> Başvuru Formu Ekle </a></li>
                  <li class="<?=($sayfa == "basvurular") ? "active" : ""; ?>"><a href="index.php?sayfa=basvurular"><i class="fa fa-circle-o"></i> Başvuru Görüntüle / Düzenle</a></li>
                </ul>
              </li>
              <li class="treeview <?=($sayfa == "anket" OR $sayfa == "anket_ekle") ? "active" : ""; ?>">
                <a href="#"><i class="fa fa-circle-o"></i> Anket İşlemleri             <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?=($sayfa == "anket_ekle") ? "active" : ""; ?>"><a href="index.php?sayfa=anket_ekle"><i class="fa fa-circle-o"></i> Anket Ekle </a></li>
                  <li class="<?=($sayfa == "anket") ? "active" : ""; ?>"><a href="index.php?sayfa=anket"><i class="fa fa-circle-o"></i> Anket Görüntüle / Düzenle</a></li>
                </ul>
              </li>
              <li class="treeview <?=($sayfa == "duyuru") ? "active" : ""; ?>">
                <a href="#"><i class="fa fa-circle-o"></i> Duyuru İşlemleri             <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                  <li class="<?=($sayfa == "duyuru" && $_GET["islem"] == "ekle") ? "active" : ""; ?>"><a href="index.php?sayfa=duyuru&islem=ekle"><i class="fa fa-circle-o"></i> Duyuru Ekle </a></li>
                  <li class="<?=($sayfa == "duyuru" && !$_GET["islem"]) ? "active" : ""; ?>"><a href="index.php?sayfa=duyuru"><i class="fa fa-circle-o"></i> Duyuru Görüntüle / Düzenle</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("p", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "ep_satin_al_sayfasi" OR $sayfa == "sayfa" OR $sayfa == "sayfa_ekle") ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-file-o"></i>
            <span>Sayfa Ayarları</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($sayfa == "sayfa_ekle") ? "active" : ""; ?>"><a href="index.php?sayfa=sayfa_ekle"><i class="fa fa-circle-o"></i>  Sayfa Ekle </a></li>
              <li class="<?=($sayfa == "sayfa") ? "active" : ""; ?>"><a href="index.php?sayfa=sayfa"><i class="fa fa-circle-o"></i>  Sayfa Gör / Düzenle </a></li>
              <li class="<?=($sayfa == "ep_satin_al_sayfasi") ? "active" : ""; ?>"><a href="index.php?sayfa=ep_satin_al_sayfasi"><i class="fa fa-circle-o"></i>  EP Satın Al Sayfası</a></li>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("r", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "destek_kategori_ekle" OR $sayfa == "Teknik_destek" OR $sayfa == "destek_kategori" OR @$_GET["tur"] == "cevap_bekleyen" OR @$_GET["tur"] == "odeme_onayli" ) ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-support"></i>
            <span>Destek İşlemleri</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <?php if($yonetim_tur == 2){ ?>
              <li class="<?=($sayfa == "destek_kategori_ekle") ? "active" : ""; ?>"><a href="index.php?sayfa=destek_kategori_ekle"><i class="fa fa-circle-o"></i> Destek Kategori Ekle </a></li>
              <li class="<?=($sayfa == "destek_kategori") ? "active" : ""; ?>"><a href="index.php?sayfa=destek_kategori"><i class="fa fa-circle-o"></i> Destek Kategorileri </a></li>
              <?php } ?>
              <li class="<?=($sayfa == "Teknik_destek" && !@$_GET["tur"]) ? "active" : ""; ?>"><a href="index.php?sayfa=Teknik_destek"><i class="fa fa-circle-o"></i> Tüm Talepler </a></li>
              <li class="<?=(@$_GET["tur"] == "cevap_bekleyen") ? "active" : ""; ?>"><a href="index.php?sayfa=Teknik_destek&tur=cevap_bekleyen"><i class="fa fa-circle-o"></i> Cevap Bekleyen Talepler </a></li>
              <li class="<?=(@$_GET["tur"] == "odeme_onayli") ? "active" : ""; ?>"><a href="index.php?sayfa=Teknik_destek&tur=odeme_onayli"><i class="fa fa-circle-o"></i> Ödeme Onaylı Bildirimler </a></li>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("s", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "market_duyurular" OR $sayfa == "market_duyuru_ekle" OR $sayfa == "ep_fiyatlari" OR $sayfa == "market_kategori" OR $sayfa == "market_item_ekle" OR $sayfa == "market_item" OR $sayfa == "market_efsun_ekle" OR $sayfa == "market_efsun"  OR $sayfa == "market_tas" OR $sayfa == "market_log") ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-shopping-basket"></i>
            <span>Market İşlemleri</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($sayfa == "market_kategori") ? "active" : ""; ?>"><a href="index.php?sayfa=market_kategori"><i class="fa fa-circle-o"></i> Market Kategori </a></li>
              <li class="<?=($sayfa == "market_item_ekle") ? "active" : ""; ?>"><a href="index.php?sayfa=market_item_ekle"><i class="fa fa-circle-o"></i> Market İtem Ekle </a></li>
              <li class="<?=($sayfa == "market_item") ? "active" : ""; ?>"><a href="index.php?sayfa=market_item"><i class="fa fa-circle-o"></i> Market İtem Düzenle </a></li>
              <li class="<?=($sayfa == "market_efsun_ekle") ? "active" : ""; ?>"><a href="index.php?sayfa=market_efsun_ekle"><i class="fa fa-circle-o"></i> Market Efsun Ekle </a></li>
              <li class="<?=($sayfa == "market_efsun") ? "active" : ""; ?>"><a href="index.php?sayfa=market_efsun"><i class="fa fa-circle-o"></i> Market Efsun Düzenle </a></li>
              <li class="<?=($sayfa == "market_tas") ? "active" : ""; ?>"><a href="index.php?sayfa=market_tas"><i class="fa fa-circle-o"></i> Market Taş </a></li>
              <li class="<?=($sayfa == "market_log") ? "active" : ""; ?>"><a href="index.php?sayfa=market_log"><i class="fa fa-circle-o"></i> Alınanlar </a></li>
              <li class="<?=($sayfa == "ep_fiyatlari") ? "active" : ""; ?>"><a href="index.php?sayfa=ep_fiyatlari"><i class="fa fa-circle-o"></i> Ep Fiyatları </a></li>
              <li class="treeview <?=($sayfa == "market_duyurular" OR $sayfa == "market_duyuru_ekle") ? "active" : ""; ?>">
                <a href="#"><i class="fa fa-circle-o"></i> Market Duyuru İşlemleri <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span></a>
                <ul class="treeview-menu">
                  <li class="<?=($sayfa == "market_duyuru_ekle") ? "active" : ""; ?>"><a href="index.php?sayfa=market_duyuru_ekle"><i class="fa fa-circle-o"></i> Duyuru Ekle </a></li>
                  <li class="<?=($sayfa == "market_duyurular") ? "active" : ""; ?>"><a href="index.php?sayfa=market_duyurular"><i class="fa fa-circle-o"></i> Duyuru Görüntüle / Düzenle</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("t", $yetkiler))){ ?>
          <li class="<?=($sayfa == "mail_ayarlari") ? "active" : ""; ?>">
            <a href="index.php?sayfa=mail_ayarlari">
            <i class="fa fa-envelope-o"></i> <span>Mail Ayarları</span>
            </a>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("u", $yetkiler))){ ?>
          <li class="treeview <?=($sayfa == "giris_log" OR $sayfa == "hile_loglari" OR $sayfa == "gm_loglari" OR $sayfa == "ch_loglari" OR  $sayfa == "bagirma_loglari" OR $sayfa == "log" OR $sayfa == "kullanici_log") ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-eye"></i>
            <span>Loglar</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($sayfa == "log") ? "active" : ""; ?>"><a href="index.php?sayfa=log"><i class="fa fa-circle-o"></i>  Panel Admin Logları </a></li>
              <li class="<?=($sayfa == "kullanici_log") ? "active" : ""; ?>"><a href="index.php?sayfa=kullanici_log"><i class="fa fa-circle-o"></i>  Kullanıcı Logları </a></li>
              <li class="<?=($sayfa == "giris_log") ? "active" : ""; ?>"><a href="index.php?sayfa=giris_log"><i class="fa fa-circle-o"></i>  Giriş Logları </a></li>
              <li class="<?=($sayfa == "hile_loglari") ? "active" : ""; ?>"><a href="index.php?sayfa=hile_loglari"><i class="fa fa-circle-o"></i>  Hile Logları </a></li>
              <li class="<?=($sayfa == "gm_loglari") ? "active" : ""; ?>"><a href="index.php?sayfa=gm_loglari"><i class="fa fa-circle-o"></i>  GM Logları </a></li>
              <li class="<?=($sayfa == "ch_loglari") ? "active" : ""; ?>"><a href="index.php?sayfa=ch_loglari"><i class="fa fa-circle-o"></i>  CH Logları </a></li>
              <li class="<?=($sayfa == "bagirma_loglari") ? "active" : ""; ?>"><a href="index.php?sayfa=bagirma_loglari"><i class="fa fa-circle-o"></i>  Bağırma Logları </a></li>
            </ul>
          </li>
          <?php } ?>
          <?php  if(($yonetim_tur == 2) || ($yonetim_tur == 1 && in_array("u", $yetkiler))){ ?>
          <li class="<?=($sayfa == "bakim_islemleri") ? "active" : ""; ?>">
            <a href="index.php?sayfa=bakim_islemleri">
            <i class="fa fa-eraser"></i> <span>Bakım Ayarları</span>
            </a>
          </li>
          <?php } ?>
          <?php  if($yonetim_tur == 2){ ?>
          <li class="treeview <?=($sayfa == "alt_kullanici_ekle" OR $sayfa == "alt_kullanicilar") ? "active" : ""; ?>">
            <a href="javascript:;">
            <i class="fa fa-user"></i>
            <span>Alt Kullanıcı Ayarları</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?=($sayfa == "alt_kullanici_ekle") ? "active" : ""; ?>"><a href="index.php?sayfa=alt_kullanici_ekle"><i class="fa fa-circle-o"></i> Alt Kullanıcı Ekle</a></li>
              <li class="<?=($sayfa == "alt_kullanicilar") ? "active" : ""; ?>"><a href="index.php?sayfa=alt_kullanicilar"><i class="fa fa-circle-o"></i> Alt Kullanıcılar </a></li>
            </ul>
          </li>
          <?php } ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
    <section class="content">
	
<div id="sonuc"></div>
<div id="ajax_post"></div>

