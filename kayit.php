<?PHP
	require ('config/config.inc.php');
	
	if(isset($_POST['register'])) {	
		
		if(empty($_POST['benutzername']) && empty($_POST['passwort']) && empty($_POST['email']) && empty($_POST['renk'])) {
			echo '<p>Tüm alanların doldurulması zorunludur!</p>';
		}
		elseif(preg_match('/^a-zA-Z0-9@-._ÖöÄäÜüÇç/', $_POST['benutzername']) && preg_match('/^a-zA-Z0-9@-._ÖöÄäÜüÇç/', $_POST['passwort']) &&
				preg_match('/^a-zA-Z0-9@-._ÖöÄäÜüÇç/', $_POST['email']) && preg_match('/^a-zA-Z0-9@-._ÖöÄäÜüÇç/', $_POST['renk'])) {
			echo '<p>Yanlızca bu karakterlere: a-Z,0-9,@,.,_,- izin vardır!</p>';
		}
		else {
			$benutzername = mysqli_real_escape_string($con, $_POST['benutzername']);
			$passwort = mysqli_real_escape_string($con, $_POST['passwort']);
			$email = mysqli_real_escape_string($con, $_POST['email']);
			$antwort = mysqli_real_escape_string($con, $_POST['renk']);
		}
		
		$sql = "INSERT INTO account.account
				(login, password, social_id, email, create_time, question1, answer1, status, safebox_expire, autoloot_expire, coins)
				VALUES
				('" . $benutzername . "', PASSWORD('" . $passwort . "'), '" . $loeschcode . "', '" . $email . "', '" . $zeit . "', '" . $frage . "',
				'" . $antwort . "', '" . $status . "', '" . $date . "', '" . $date . "', '" . $registercoins . "')";
		$qry = mysqli_query($con, $sql);
	
		if($qry) {
			echo '<p id="nachricht" style="color:green;">Hesap Başarıyla Oluşturuldu!</p>';
		}
		else {
			echo '<p id="nachricht" style="color:red;">Kayıt Başarısız!Eksiksiz bir şekilde tekrar deneyiniz..</p>';
		}
	}
?>
<html>
		<head>
			<title><?PHP echo $servername ?></title>
			<meta http-equiv="content-type" content="text/html; charset=utf-8">
			<link rel="stylesheet" href="layout/design.css" type="text/css" />
		</head>
	<body>
	<style type="text/css">
		body { background: url('<?php echo $url ?>') center fixed;	background-size: cover;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover; }
	</style>
		<div id="logo"></div>
			<div id="box">
			<form action="index.php" method="post" id="login">
				<center>
					<p>Kullanıcı Adı</p>
					<input type="text" name="benutzername" maxlength="16" />

					<p>Şifre</p>
					<input type="password" name="passwort" maxlength="16" />

					<p>Email</p>
					<input type="text" name="email" maxlength="20" />

					<p>Güvenlik Sorusu: Favori Renk</p>
					<input type="text" name="renk" maxlength="8" />
					
					<input type="submit" name="register" value="" />
				</center>
			</form>
		</div>
		<div id="footer">
			<p>© Copyright <?PHP echo $servername ?>. Tum hakları saklıdır.</p>
			<p>Coded by: Fydes</a>
		</div>
	</body>
</html>