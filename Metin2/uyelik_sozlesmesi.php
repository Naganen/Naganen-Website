<?php  
require_once 'WM_settings/WMayar.php';
if(!isset($_SESSION["server_vt"]))
{
echo "Server Belli Değil";
}
else
{
	
define('server', $_SESSION["server_vt"]);

@$ayar = new WMayar(".", server);

$vt = new WM_vt_settings(server);	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="tr">
<head>
<title><? echo $vt->a("isim"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
html, body, a {
	padding:0px;
	margin:0px;
	background-color:#541412;
	color:#FFEACE;
	font-family: tahoma;
	font-size:12px;
}

a {
	text-align:left;
}

a:hover {
	text-decoration:underline;
	color:#FFB45D;
}


h1 {
	font-size:18px;
	color:#FFB45D;
	padding:0px;
	padding-left:8px;
	margin:0px;
}

h2 {
	font-size:13px;
	margin:0px;
	margin-bottom:10px;
	color:#FFB45D;
}

h3 {
	font-size:12px;
	font-weight:bold;
	margin:0px;
	margin-bottom:10px;

}

hr {
	margin:13px 0px;
	padding:0px;
	color:#541412;
	background-color:#541412;
	border:0px;
	border-bottom:1px dashed #FFEACE;
	clear:both;
	width:100%;
}

* html hr {
	margin:5px 0px;
}
-->
</style>
</head>
<body>
<table width="520" align="center" cellspacing="0" cellpadding="0">
	<tr>
		<td>
		<br/><br/>	<b><u>Üyelik ve Hizmet Sözleşmesi</u></b><br/><br/>
			<table>
				<tr>
							<td valign="top"><b>1</b></td>
					<td><b>Yaş Sınırlaması</b></td>
				</tr>
				<tr>
					<td valign="top">1.1.</td>
					<td>18-13 Yaş arasındaki oyuncu adaylarının ebeveyn isteği dışında sisteme kayıt olmaları yasaktır.</td>
				</tr>
				<tr>
					<td valign="top">1.2.</td>
					<td>13 Yaş altındaki oyuncu adaylarının sisteme kayıt olması kesinlikle yasaktır.</td>
				</tr>
				<tr>
					<td valign="top">1.3.</td>
					<td>Oyun içerisinde tespit edilen 13 yaş altı oyuncuların hesapları kişinin belirtilen yaşını doldurana kadar kapatılacaktır.</td>
				</tr>
				<tr>
					
					<td valign="top"><b>2</b></td>
					<td><b>Ücretsiz Oyun</b></td>
				</tr>
				<tr>
					<td valign="top">2.1.</td>
					<td>Oyun tamamen ücretsiz olarak oynanabildiği gibi, yardımcı nesnelerin kullanımı, belirtilen fiyatlarda ödeme yapılarak sağlanabilmektedir.</td>
				</tr>
				<tr>
					<td valign="top">2.2.</td>
					<td>Ödeme yapan kişi herhangi bir sebepten dolayı ceza alırsa veya kapatılırsa hak talebinde bulunamaz.</td>
				</tr>
				<tr>
					<td valign="top">2.3.</td>
					<td>Yardımcı nesneler için kesinlikle değişim ve soyulma olaylarında iade yapılmayacaktır.</td>
				</tr>
				<tr>
			
				<tr>
					<td valign="top"><b>3</b></td>
					<td><b>Engelli Hesaplar</b></td>
				</tr>
				<tr>
					<td valign="top">3.1.</td>
					<td>Kullanıcıların hesapları, süreli veya süresiz kapatılma cezalarını aldıklarında oyun içinde faydalandıkları yardımcı nesnelerin kesinlikle iadeleri yapılmaz.</td>
				</tr>
				<tr>
					<td valign="top">3.2.</td>
					<td>Destek sistemine gönderilen sahte video ve benzeri unsurlar için tarafların başlatacağı hukuki işlemlerde <a href="<?=$vt->url(7);?>" target="_blank"><? echo $vt->a("isim"); ?></a> yönetimi sorumlu değildir.Sorumluluk, öğeyi gönderen oyuncu ve kapatılan oyuncunundur</td>
				</tr>
				<tr>
					<td valign="top">3.3.</td>
					<td>Oyun Yöneticileri uygun görmediği bir oyuncunun hesabını sebep belirtmeksizin kapatabilir.</td>
				</tr>
				
				<tr>
					<td valign="top"><b>4</b></td>
					<td><b>Hile Kullanımı</b></td>
				</tr>
				
				<tr>
					<td valign="top">4.1.</td>
					<td>Hile kullanımı yasaktır.</td>
				</tr>
				
				<tr>
					<td valign="top">4.2.</td>
					<td>Hilenin çeşidine göre cezalandırılma yapılmaktadır.</td>
				</tr>
				
				<tr>
					<td valign="top"><b>5</b></td>
					<td><b>Hakaret / Küfür</b></td>
				</tr>
				
				<tr>
					<td valign="top">5.1.</td>
					<td>Hakaret / küfür yasaktır.</td>
				</tr>
				
				<tr>
					<td valign="top">5.2.</td>
					<td>Yasaklama Süresi hakaretin yaşandığı yer, şikayetçi oyuncu sayısı ve hakaretin boyutuna göre yetkililer tarafından değerlendirilerek verilir.</td>
				</tr>
				
						<tr>
					<td valign="top">5.3.</td>
					<td>Küfür ve hakaret eden oyuncuların gerek hesapları kapatılmaktadır, gerekse süreli veya süresiz konuşma bloklaması (chat ban) atılmaktadır.</td>
				</tr>
				
				<tr>
					<td valign="top"><b>6</b></td>
					<td><b>Bug Kullanımı</b></td>
				</tr>
				
				<tr>
					<td valign="top">6.1.</td>
					<td>Oyun açıklarından yararlanmak yasaktır. </td>
				</tr>
				
				<tr>
					<td valign="top">6.2.</td>
					<td>Eğer herhangi bir oyun açığı tespit eder ve bunu rapor etmek isterseniz : <a href="<?=$vt->url(7);?>" target="_blank"><? echo $vt->a("isim"); ?> - Destek Sistemi</a>ne gönderebilirsiniz.</td>
				</tr>
				
				<tr>
					<td valign="top"><b>7</b></td>
					<td><b>Hesap Paylaşımı</b></td>
				</tr>
				
				<tr>
					<td valign="top">7.1.</td>
					<td>Hesap paylaşımı yasak değildir. Hesap paylaşımı sonucunda oluşacak sorunlardan <? echo $vt->a("isim"); ?> Yönetimi sorumlu değildir.</td>
				</tr>
				
				<tr>
					<td valign="top">7.2.</td>
					<td>Hesabın veya oyun içindeki herhangi bir eşyanın, başka kişi ya da kurumlara Ücret (TL, $, EURO vs) veya Ejder Parası (EP) karşılığında satılması ve alınması kesinlikle yasaktır.</td>
				</tr>
				
				<tr>
					<td valign="top">7.3.</td>
					<td>Hesapların takası durumunda hiçbir Oyun Yetkilisi sorumlu tutulamaz. Tarafların kendi aralarındaki meseledir. Sorumluluk taraflarındır. </td>
				</tr>
						<td valign="top">7.4.</td>
					<td><a href="http://www.<? echo $vt->a("isim"); ?>.org" target="_blank"><? echo $vt->a("isim"); ?></a> dışı hesap ve item satışları, takasları yasaktır.</td>
				</tr>
				
	<tr>
					<td valign="top"><b>8</b></td>
					<td><b>Dosya Paylaşımı / Hesap Soyulmaları / Eşya Çalınması </b></td>
				</tr>
				
				<tr>
					<td valign="top">8.1.</td>
					<td>Oyun içindeki diğer kullanıcılardan veya internet bağlantılarıyla alınan dosyalardan gelebilecek olan ve bilgisayarınızda çalıştırıldığında klavyede basılan her tür harf, sayı vb. karakterlerin kaydedilmesi durumunda hesap soyulmaları meydana gelmektedir. </td>
				</tr>
				
				<tr>
					<td valign="top">8.2.</td>
					<td>Hesap ve item güvenliği tamamen kullanıcıya aittir ve bu gibi durumlarda çalınan hesap, nesne vs. geri iadesi söz konusu değildir.</td>
				</tr>
				
				<tr>
					<td valign="top">8.3.</td>
					<td>Eğer ispat edilirse sadece suçlu hesap süresiz kapatılır. </td>
				</tr>
					
				<tr>
					<td valign="top"><b>9</b></td>
					<td><b>Hesap Güvenliği</b></td>
				</tr>
				
				<tr>
					<td valign="top">9.1.</td>
					<td>Hesap bilgileri oyuncuya özgüdür ve bu bilgiler hiçbir şekilde üçüncü kişilerle paylaşılamaz.</td>
				</tr>
				
				<tr>
					<td valign="top">9.2.</td>
					<td>Hesap ve item güvenliği tamamen kullanıcıya aittir ve bu gibi durumlarda çalınan hesap, nesne vs. geri iadesi söz konusu değildir.</td>
				</tr>
				
					<tr>
					<td valign="top">9.3.</td>
					<td>Kayıt olurken verilen bilgiler oyuncu sorumluluğundadır.</td>
				</tr>
					
				<tr>
					<td valign="top"><b>10</b></td>
					<td><b>Oyuncular Arası İletişim</b></td>
				</tr>
				
				<tr>
					<td valign="top">10.1.</td>
					<td>Oyun içerisinde, oyuncular arası ilişkiler sonucu gerçek hayatta ortaya çıkabilecek hiçbir olaydan <a href="<? echo $vt->a("link"); ?>" target="_blank"><? echo $vt->a("isim"); ?></a> Yönetimi sorumlu tutulamaz. </td>
				</tr>
				
				<tr>
					<td valign="top">10.2.</td>
					<td>Oyun içerisinde gerçek hayata yönelik tehditler tespit edilir veya bildirilirse sorumlu hesaplar için gerekli ceza işlemi uygulanır.</td>
				</tr>
				
				<tr>
					<td valign="top"><b>11</b></td>
					<td><b>Hesaplar</b></td>
				</tr>
				
				<tr>
					<td valign="top">11.1.</td>
					<td>Oyun içerisinde bulunan bütün hesaplar <? echo $vt->a("isim"); ?> yönetimine aittir. Yönetim gerekli gördüğü takdirde hesapları kapatabilir, değişiklik yapabilir.</td>
				</tr>
				
				<tr>
					<td valign="top">11.2.</td>
					<td>Kullanım hakkı oyuncuda bulunsada ; hesaplar veya eşyalar gerçek değerler karşılığı 3. bir kişiye satılamaz.</td>
				</tr>
				
			</table><br><br>
Yukarıda belirtilen maddelerde belirtilen durumlarda oluşabilecek hiçbir sıkıntıdan Oyun Yetkilisi sorumlu tutulamaz.<br />
Kurallara aykırı olan davranış ve tutumlara hiçbir şekilde tolerans gösterilmeyecektir.<br />
Kayıt olan, oyuna giriş yapan ve oyun hizmetlerinden yararlanan tüm kullanıcılar Üyelik ve Hizmet Sözleşmesi kabul etmiş sayılır.<br />
<a href="<? echo $vt->a("link"); ?>" target="_blank"><? echo $vt->a("isim"); ?></a> Yönetimi, Üyelik ve Hizmet Sözleşmesi'nde belirtilen maddeleri değiştirme hakkını gizli tutar.<br />
<br /><br />
	</tr>
		</table>
		<br/>
		<!-- lang: tr | content: tac --></body>
</html>

<?php } ?>