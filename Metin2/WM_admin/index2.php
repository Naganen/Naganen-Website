<?php
ob_start();
session_start();

require_once '../WM_settings/WM_admin_ayar.php';

if (!isset($_SESSION["adminid"]) || !isset($_SESSION["adminisim"]) || !isset($_SESSION["giris"])) {
    
    header('Location: giris.php');
    
} else {
    
    function yonetici($deger)
    {
        global $db;
        
        $query = $db->prepare("SELECT * FROM users WHERE id = ? && username = ?");
        $query->execute(array(
            $_SESSION["adminid"],
            $_SESSION["adminisim"]
        ));
        $fetch = $query->fetch();
        return $fetch[$deger];
        
    }
    
    
    # POST ETMEK İÇİN SAYFANIN YAPISINI ALALIM
    
    $post = @$_GET["post"];
    
    // SAYFA YAPISINI ALDIK POST AYARLARINI GİRELİM.
    
    if ($post == "veritabani_kayit") {
        #POST EDİLMİŞ Mİ ?
        
        if ($_POST) {
            
            $vthost = $WMkontrol->WM_post($WMkontrol->WM_html($WMkontrol->WM_tostring($_POST["vthost"])));
            
            $vtuser = $WMkontrol->WM_post($WMkontrol->WM_html($WMkontrol->WM_tostring($_POST["vtuser"])));
            
            $vtpass = $WMkontrol->WM_post($WMkontrol->WM_html($WMkontrol->WM_tostring($_POST["vtpass"])));
            
            $vtport = $WMkontrol->WM_post($WMkontrol->WM_html($WMkontrol->WM_toint($_POST["vtport"])));
            
            $update = $db->prepare("UPDATE server SET host = ?, user = ?, pass = ?, sql_port = ? WHERE id = ?");
            
            $guncelle = $update->execute(array(
                $vthost,
                $vtuser,
                $vtpass,
                $vtport,
                $_SESSION["server"]
            ));
            
            if ($guncelle) {
                
                header('Location: index.php');
                
            } else {
                
                header('Location: index2.php');
                
            }
            
        }
        
    } else if ($post == "server_sec") {
        
        $secilen = $WMkontrol->WM_post($WMkontrol->WM_html($WMkontrol->WM_toint($_POST["serversec"])));
        
        $guncelle = $db->prepare("UPDATE users SET server = ? WHERE id = ?");
        $guncelle->execute(array(
            $secilen,
            $_SESSION["adminid"]
        ));
        
        if ($guncelle) {
            
            $_SESSION["server"] = $secilen;
            
            header('Location: index.php');
            
        } else {
            
            header('Location: index2.php');
            
        }
        
    } else if ($post == "server_ekle") {
        
        if ($_POST) {
            
            $vthost = $WMkontrol->WM_post($WMkontrol->WM_html($WMkontrol->WM_tostring($_POST["vthost"])));
            
            $vtuser = $WMkontrol->WM_post($WMkontrol->WM_html($WMkontrol->WM_tostring($_POST["vtuser"])));
            
            $vtpass = $WMkontrol->WM_post($WMkontrol->WM_html($WMkontrol->WM_tostring($_POST["vtpass"])));
            
            $vtport = $WMkontrol->WM_post($WMkontrol->WM_html($WMkontrol->WM_toint($_POST["vtport"])));
            
            $servername = $WMkontrol->WM_post($WMkontrol->WM_html($WMkontrol->WM_tostring($_POST["servername"])));
            
            $serverfolder = $WMkontrol->WM_post($WMkontrol->WM_html($WMkontrol->WM_tostring($_POST["serverfolder"])));
            
            $kontrol = $db->prepare("SELECT isim FROM server WHERE isim = ?");
            $kontrol->execute(array(
                $servername
            ));
            
            if (!$vthost || !$vtuser || !$vtport || !$servername) {
                
                echo '<center><font color="red">* İle işaretlenmiş yerleri boş bırakamazsınız.</font></center>';
                
            } else if (file_exists($serverfolder)) {
                
                echo '<center><font color="red">Böyle bir klasör zaten var olduğu için serverı oluşturamadık. ! </font></center>';
                
            } else if ($kontrol->rowCount()) {
                
                echo '<center><font color="red">Böyle bir server ismi zaten var olduğu için serverı oluşturamadık. ! </font></center>';
                
            } else {
                
                $auto = $db->query("SHOW TABLE STATUS LIKE 'server'");
                
                $increment = $auto->fetch(PDO::FETCH_ASSOC);
                
                $insert = $db->prepare("INSERT INTO server SET host = ?, user = ?, klasor = ?, pass = ?, sql_port = ?, isim = ?");
                
                $ekle = $insert->execute(array(
                    $vthost,
                    $vtuser,
                    $serverfolder,
                    $vtpass,
                    $vtport,
                    $servername
                ));
                
                
                if ($ekle) {
                    
                    mkdir("../" . $serverfolder, 0777);
                    
                    $yeni_dosya = "../$serverfolder/index.php";
                    
                    touch($yeni_dosya);
                    
                    @file_put_contents($yeni_dosya, "<?php " . $WMclass->server_yazdir($increment["Auto_increment"]), FILE_APPEND);
                    
                    @copy("../htaccess.txt", "../$serverfolder/.htaccess");
                    
                    sleep(1);
                    
                    header('Location: index2.php');
                    
                } else {
                    
                    echo '<center><font color="red">Bir hata meydana geldi </font></center>';
                    
                }
                
            }
            
        }
        
    }
    
    # KULLANICININ SERVERI VARMI ?
    
    if (!$_SESSION["server"]) {
        
        $yetkiler = json_decode(yonetici("yetki"));
        
        $serverlar = json_decode(yonetici("server_yetki"));
        
        $yonetim_tur = yonetici("tur");
        
        require_once WMadmintema . 'server_sec.php';
        
    } else {
        # KULLANICININ SERVERINI KONTROL ET.
        
        $kontrol = $db->prepare("SELECT id FROM server WHERE id = ?");
        $kontrol->execute(array(
            $_SESSION["server"]
        ));
        
        if ($kontrol->rowCount()) {
            
            $query = $db->prepare("SELECT * FROM server WHERE id = ?");
            $query->execute(array(
                $_SESSION["server"]
            ));
            
            $fetch = $query->fetch(PDO::FETCH_ASSOC);
            
            $isim = $fetch["isim"];
            
            
            $yetkiler = json_decode(yonetici("yetki"));
            
            $serverlar = json_decode(yonetici("server_yetki"));
            
            $yonetim_tur = yonetici("tur");
            
            require_once WMadmintema . 'veritabani_baglanamadi.php';
            
        } else {
            
            $yetkiler = json_decode(yonetici("yetki"));
            
            $serverlar = json_decode(yonetici("server_yetki"));
            
            $yonetim_tur = yonetici("tur");
            
            require_once WMadmintema . 'server_sec.php';
            
        }
        
    }
    
    
}
?>
