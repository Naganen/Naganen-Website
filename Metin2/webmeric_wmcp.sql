-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 03 Ağu 2016, 20:17:53
-- Sunucu sürümü: 10.1.9-MariaDB
-- PHP Sürümü: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `wmp`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anketler`
--

CREATE TABLE `anketler` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tur` int(11) NOT NULL,
  `konu` varchar(1555) COLLATE utf8_turkish_ci NOT NULL,
  `secenekler` varchar(9999) COLLATE utf8_turkish_ci NOT NULL,
  `onay` mediumtext COLLATE utf8_turkish_ci NOT NULL,
  `red` mediumtext COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `bitis_tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `token` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `seo` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `index` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `index_tema` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `market_tema` varchar(855) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'default',
  `mail_secure` varchar(15) COLLATE utf8_turkish_ci NOT NULL,
  `mail_host` varchar(155) COLLATE utf8_turkish_ci NOT NULL,
  `mail_port` int(11) NOT NULL,
  `mail_user` varchar(155) COLLATE utf8_turkish_ci NOT NULL,
  `mail_pass` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `mail_isim` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `mail_profil` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `admin_mail` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `base` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `index`, `index_tema`, `market_tema`, `mail_secure`, `mail_host`, `mail_port`, `mail_user`, `mail_pass`, `mail_isim`, `mail_profil`, `admin_mail`, `base`) VALUES
(1, '["index_tema","1"]', 'default', 'default', 'ssl', 'smtp.gmail.com', 465, 'mesutmeric61@gmail.com', 'yok', 'Webmeric ', 'mesutmeric61@gmail.com', 'mesutmeric61@gmail.com', 'http://127.0.0.7/wmt22/');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `basvurular`
--

CREATE TABLE `basvurular` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tur` int(11) NOT NULL,
  `lonca_sart` varchar(2555) COLLATE utf8_turkish_ci NOT NULL DEFAULT '[]',
  `konu` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `basvuranlar` varchar(2555) COLLATE utf8_turkish_ci NOT NULL DEFAULT '[]',
  `onaylananlar` varchar(2555) COLLATE utf8_turkish_ci NOT NULL DEFAULT '[]',
  `red_edilenler` varchar(2555) COLLATE utf8_turkish_ci NOT NULL DEFAULT '[]',
  `tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `bitis_tur` int(11) NOT NULL DEFAULT '1',
  `bitis` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `bildirim`
--

CREATE TABLE `bildirim` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `alan` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `tur` int(11) NOT NULL,
  `alici_tur` int(11) NOT NULL DEFAULT '1',
  `bildirim` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `olay_yeri` int(11) NOT NULL,
  `durum` int(11) NOT NULL DEFAULT '1',
  `tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `destek`
--

CREATE TABLE `destek` (
  `id` int(11) NOT NULL,
  `acan` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `sid` int(11) NOT NULL,
  `kid` int(11) NOT NULL,
  `konu` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `yonlenen` varchar(1555) COLLATE utf8_turkish_ci NOT NULL DEFAULT '[]',
  `durum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `destek_cevap`
--

CREATE TABLE `destek_cevap` (
  `id` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `ckisi` int(11) NOT NULL,
  `cevap` text COLLATE utf8_turkish_ci NOT NULL,
  `cevaplayan` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `destek_kategori`
--

CREATE TABLE `destek_kategori` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `isim` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `value` text COLLATE utf8_turkish_ci NOT NULL,
  `yetkililer` varchar(855) COLLATE utf8_turkish_ci NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyurular`
--

CREATE TABLE `duyurular` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `label` varchar(155) COLLATE utf8_turkish_ci NOT NULL,
  `labels` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `konu` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `seo` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `epfiyatlari`
--

CREATE TABLE `epfiyatlari` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `sira` int(11) NOT NULL,
  `ep` int(11) NOT NULL,
  `fiyat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `hatalar`
--

CREATE TABLE `hatalar` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tur` int(11) NOT NULL,
  `kullanici` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(525) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici_log`
--

CREATE TABLE `kullanici_log` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `kullanici` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tur` int(11) NOT NULL,
  `yapan` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `log` text COLLATE utf8_turkish_ci NOT NULL,
  `icerik` varchar(9999) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `market_duyuru`
--

CREATE TABLE `market_duyuru` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `konu` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `seo` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `market_efsun`
--

CREATE TABLE `market_efsun` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tur` int(11) NOT NULL,
  `isim` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `oran` int(11) NOT NULL,
  `efsunid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `market_item`
--

CREATE TABLE `market_item` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `kid` int(11) NOT NULL,
  `vnum` int(11) NOT NULL,
  `resim` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `isim` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  `durum` int(11) NOT NULL,
  `miktar` int(11) NOT NULL,
  `fiyat` int(11) NOT NULL,
  `eskifiyat` int(11) NOT NULL,
  `gerisayim` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `efsun` int(11) NOT NULL,
  `itemtur` int(11) NOT NULL,
  `sure_tur` int(11) NOT NULL,
  `sure` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `market_kategori`
--

CREATE TABLE `market_kategori` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `sira` int(11) NOT NULL,
  `isim` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `seo` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `market_log`
--

CREATE TABLE `market_log` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tur` int(11) NOT NULL,
  `karakter` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `alinan` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `vnum` int(11) NOT NULL,
  `fiyat` int(11) NOT NULL,
  `log` varchar(2000) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `market_tas`
--

CREATE TABLE `market_tas` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `tas` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `tur` int(11) NOT NULL,
  `vnum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `onayli_karakter`
--

CREATE TABLE `onayli_karakter` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `isim` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `packlar`
--

CREATE TABLE `packlar` (
  `id` int(11) NOT NULL,
  `sira` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `pack` varchar(9999) COLLATE utf8_turkish_ci NOT NULL,
  `aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  `boyut` varchar(155) COLLATE utf8_turkish_ci NOT NULL,
  `linkler` varchar(9999) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sayfalar`
--

CREATE TABLE `sayfalar` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `konu` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `seo` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `server`
--

CREATE TABLE `server` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `host` varchar(155) COLLATE utf8_turkish_ci NOT NULL,
  `user` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `pass` varchar(155) COLLATE utf8_turkish_ci NOT NULL,
  `sql_port` int(11) NOT NULL,
  `isim` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `klasor` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `ayar` varchar(15) COLLATE utf8_turkish_ci NOT NULL DEFAULT '[1,1,1,1,1]',
  `tema` varchar(855) COLLATE utf8_turkish_ci NOT NULL DEFAULT '["tema", "default"]',
  `mail_tema` varchar(855) COLLATE utf8_turkish_ci NOT NULL DEFAULT 'default',
  `link` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `linkler` varchar(1996) COLLATE utf8_turkish_ci NOT NULL DEFAULT '["anasayfa","kaydol","oyuncu-siralamasi","oyunu-indir","giris-yap","kullanici","cikis-yap","kullanici\\/teknik-destek","javascript.;","ban-sorgula","oyun-tanitim.html","\\/market"]',
  `tema_a` varchar(855) COLLATE utf8_turkish_ci NOT NULL DEFAULT '["[1,2,2,2,1]","[1,1]","[2,2,2]","[2,1,2]"]',
  `tema_ayar` varchar(855) COLLATE utf8_turkish_ci DEFAULT '[1, 1, 1, 1, 1]',
  `title` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `keywords` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `description` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `drop` varchar(100) COLLATE utf8_turkish_ci NOT NULL DEFAULT ',,',
  `log` int(11) NOT NULL DEFAULT '1',
  `kullanici_log` int(11) NOT NULL DEFAULT '1',
  `pack_aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  `odeme` text COLLATE utf8_turkish_ci NOT NULL,
  `guvenlik` int(11) NOT NULL,
  `kayit` int(11) NOT NULL DEFAULT '1',
  `kayit_onay` int(11) NOT NULL DEFAULT '1',
  `kayit_hosgeldin` int(11) NOT NULL DEFAULT '1',
  `mail_kac` int(11) NOT NULL DEFAULT '1',
  `online_liste` int(11) NOT NULL DEFAULT '1',
  `zenginler` int(11) NOT NULL DEFAULT '1',
  `mail_durum` int(11) NOT NULL DEFAULT '2',
  `envanter` int(11) NOT NULL DEFAULT '2',
  `sifre_unuttum` int(11) NOT NULL DEFAULT '1',
  `hesap_sifre` int(11) NOT NULL DEFAULT '1',
  `depo_sifre` int(11) NOT NULL DEFAULT '1',
  `karakter_silme_sifre` int(11) NOT NULL DEFAULT '1',
  `mail_degistir` int(11) NOT NULL DEFAULT '2',
  `kullanici_degis` int(11) NOT NULL DEFAULT '1',
  `kullanici_unuttum` int(11) NOT NULL DEFAULT '2',
  `breadcumb` int(11) NOT NULL DEFAULT '1',
  `krallar` varchar(955) COLLATE utf8_turkish_ci NOT NULL DEFAULT ',',
  `market_efsun` int(11) NOT NULL DEFAULT '5',
  `destek_mail` int(11) NOT NULL DEFAULT '2',
  `duyuru` varchar(1000) COLLATE utf8_turkish_ci NOT NULL DEFAULT '[1, "Webmeric.com", "Webmeric.com - WMCP PANEL"]',
  `duyuru_2` varchar(1000) COLLATE utf8_turkish_ci NOT NULL DEFAULT '["WMCP Yönetim Paneli. Buraya Yazı Girebilirsiniz", "WMCP Yönetim Paneli. Buraya Yazı Girebilirsiniz"]',
  `sosyal_ag` varchar(2555) COLLATE utf8_turkish_ci NOT NULL DEFAULT '["http://www.facebook.com/webmeric", "", "", ""]',
  `istatistik` varchar(855) COLLATE utf8_turkish_ci NOT NULL DEFAULT '[0, 0, 0, 0, 0]',
  `bakim_yazi` text COLLATE utf8_turkish_ci NOT NULL,
  `logo` varchar(155) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `login` varchar(155) COLLATE utf8_turkish_ci NOT NULL,
  `tur` int(11) NOT NULL,
  `token` varchar(855) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `password` varchar(855) COLLATE utf8_turkish_ci NOT NULL,
  `server` int(11) NOT NULL,
  `tur` enum('1','2') COLLATE utf8_turkish_ci NOT NULL DEFAULT '1',
  `yetki` varchar(1999) COLLATE utf8_turkish_ci NOT NULL,
  `server_yetki` varchar(1999) COLLATE utf8_turkish_ci NOT NULL,
  `gm` varchar(855) COLLATE utf8_turkish_ci NOT NULL DEFAULT '[TL]Webmeric',
  `imza` text COLLATE utf8_turkish_ci NOT NULL,
  `imza_durum` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `server`, `tur`, `yetki`, `server_yetki`, `gm`, `imza`, `imza_durum`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 1, '2', '[]', '[]', '[TL]Webmeric', '&lt;span style=&quot;color:rgb(255,0,0);&quot;&gt;&lt;b style=&quot;color:rgb(255,0,0);&quot;&gt;www.webmeric.com&lt;br&gt;&lt;/span&gt;&lt;p&gt;&lt;font color=&quot;#ff0000&quot;&gt;&lt;b&gt;Teknik Destek Ekibi&lt;/b&gt;&lt;/font&gt;&lt;/p&gt;', 1);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `anketler`
--
ALTER TABLE `anketler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `basvurular`
--
ALTER TABLE `basvurular`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `bildirim`
--
ALTER TABLE `bildirim`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `destek`
--
ALTER TABLE `destek`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `destek_cevap`
--
ALTER TABLE `destek_cevap`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `destek_kategori`
--
ALTER TABLE `destek_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `duyurular`
--
ALTER TABLE `duyurular`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `epfiyatlari`
--
ALTER TABLE `epfiyatlari`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `hatalar`
--
ALTER TABLE `hatalar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanici_log`
--
ALTER TABLE `kullanici_log`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `market_duyuru`
--
ALTER TABLE `market_duyuru`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `market_efsun`
--
ALTER TABLE `market_efsun`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `market_item`
--
ALTER TABLE `market_item`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `market_kategori`
--
ALTER TABLE `market_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `market_log`
--
ALTER TABLE `market_log`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `market_tas`
--
ALTER TABLE `market_tas`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `onayli_karakter`
--
ALTER TABLE `onayli_karakter`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `packlar`
--
ALTER TABLE `packlar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sayfalar`
--
ALTER TABLE `sayfalar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `anketler`
--
ALTER TABLE `anketler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `basvurular`
--
ALTER TABLE `basvurular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `bildirim`
--
ALTER TABLE `bildirim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `destek`
--
ALTER TABLE `destek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `destek_cevap`
--
ALTER TABLE `destek_cevap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `destek_kategori`
--
ALTER TABLE `destek_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `duyurular`
--
ALTER TABLE `duyurular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `epfiyatlari`
--
ALTER TABLE `epfiyatlari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `hatalar`
--
ALTER TABLE `hatalar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `kullanici_log`
--
ALTER TABLE `kullanici_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `market_duyuru`
--
ALTER TABLE `market_duyuru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `market_efsun`
--
ALTER TABLE `market_efsun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `market_item`
--
ALTER TABLE `market_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `market_kategori`
--
ALTER TABLE `market_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `market_log`
--
ALTER TABLE `market_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `market_tas`
--
ALTER TABLE `market_tas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `onayli_karakter`
--
ALTER TABLE `onayli_karakter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `packlar`
--
ALTER TABLE `packlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `sayfalar`
--
ALTER TABLE `sayfalar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `server`
--
ALTER TABLE `server`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
