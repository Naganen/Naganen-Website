<?PHP
	// PHP / MySQL Error = NO!
	//error_reporting(0);
		
	// MySQL Bağlantı Ayarları
	$ip		= 'nagasama.ddns.net';			// IP Adresiniz
	$name	= 'root';				// MySQL Giriş Adı / Değiştirmediyseniz root'dur.
	$pass	= '123qweasd';				// MySQL Şifre
	$db		= 'account';			// Account Table / Ellemeyin !
	// Aşağıdaki satırı kesinlikle değiştirmeyin.
	$con = mysqli_connect($ip, $name, $pass, $db);
	
	// Ayarlar
	$servername = 'NaganenMT2';		// Site adı olarak ve footer kısmında gözükecek server adınız.
	$registercoins = 0;			    // Kayıt olan kişilere verilecek hediye EP miktarı.
	$status	= "OK";					// OK = Açık -- BLOCK = Kapalı
	$loeschcode = 1234567;			// Tüm Kullanıcıların karakter silme kodu.
	$url = './layout/bg1.jpg';		// Arka plan resminizin bulunduğu adres.
	
	// Değiştirmeyin !
	$zeit		= date("Y-m-d H:i:s",time());
	$rec		= (60*60*24)*365;
	$time		= time()+$rec;
	$date		= date("Y-m-d H:i:s", $time);
	$frage		= "renk";	
?>