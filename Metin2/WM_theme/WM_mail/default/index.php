<?php
function mail_icerik($icerik){
	
if($icerik[0] == 'item_kilit'){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">İtem Kilitleme Şifreniz Değiştirildi</div>
<div style="word-wrap: break-word;">
<p>Sayın <b>'.$icerik[1].'</b> </p>
<p>Yeni item kilitleme şifreniz : <b>'.$icerik[2].'</b></p>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Hesabınızın güvenliğinden Metinhard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}
	
if($icerik[0] == 'depo_sifre'){
	
if($icerik[1] == 1){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Depo Şifresi Değiştir</div>
<div style="word-wrap: break-word;">
<p>Sayın <b>'.$icerik[2].'</b> </p>
<p>Depo Şifrenizi Değiştirmek için aşağıdaki linke tıklayınız.</p>
<a style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6; cursor:pointer;" href="'.$icerik[3].'">
'.$icerik[3].'</a>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Hesabınızın güvenliğinden MetinHard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';

}
else if($icerik[1] == 2){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Depo Şifreniz Değiştirildi</div>
<div style="word-wrap: break-word;">
<p>Sayın <b>'.$icerik[2].'</b> Karakter Silme Şifreniz değiştirildi. </p>
<div style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6;">
Yeni Depo Şifreniz <b>'.$icerik[3].'</b></div>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Hesabınızın güvenliğinden MetinHard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}
	
}
	
else if($icerik[0] == 'karakter_silme_sifre'){
	
if($icerik[1] == 1){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Kararakter Silme Şifresi Değiştir</div>
<div style="word-wrap: break-word;">
<p>Sayın <b>'.$icerik[2].'</b> </p>
<p>Karakter Silme Şifrenizi Değiştirmek için aşağıdaki linke tıklayınız.</p>
<a style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6; cursor:pointer;" href="'.$icerik[3].'">
'.$icerik[3].'</a>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Hesabınızın güvenliğinden MetinHard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';

}
else if($icerik[1] == 2){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Karakter Silme Şifreniz Değiştirildi</div>
<div style="word-wrap: break-word;">
<p>Sayın <b>'.$icerik[2].'</b> Karakter Silme Şifreniz değiştirildi. </p>
<div style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6;">
Yeni Karakter Silme Şifreniz <b>'.$icerik[3].'</b></div>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Hesabınızın güvenliğinden MetinHard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}
	
}
	
else if($icerik[0] == 'sifre_degistir'){
	
if($icerik[1] == 1){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Şifre Değiştir</div>
<div style="word-wrap: break-word;">
<p>Sayın <b>'.$icerik[2].'</b> </p>
<p>Şifrenizi Değiştirmek için aşağıdaki linke tıklayınız.</p>
<a style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6; cursor:pointer;" href="'.$icerik[3].'">
'.$icerik[3].'</a>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Hesabınızın güvenliğinden MetinHard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';

}
else if($icerik[1] == 2){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Şifreniz Değiştirildi</div>
<div style="word-wrap: break-word;">
<p>Sayın <b>'.$icerik[2].'</b> Şifreniz değiştirildi. </p>
<div style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6;">
Yeni Şifreniz <b>'.$icerik[3].'</b></div>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Hesabınızın güvenliğinden MetinHard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}
	
}
	
	
else if($icerik[0] == 'kullanici_adi_degistir'){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Kullanıcı Adı Değiştir</div>
<div style="word-wrap: break-word;">
<p>Sayın <b>'.$icerik[1].'</b> </p>
<p>Kullanıcı adınız <b>'.$icerik[2].'</b> olarak değiştirilecektir.</p>
<p>Değiştirmek için aşağıdaki linke tıklayınız.</p>
<a style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6; cursor:pointer;" href="'.$icerik[3].'">
'.$icerik[3].'</a>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Hesabınızın güvenliğinden MetinHard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}
	
else if($icerik[0] == 'kullanici_adi_unuttum'){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Kullanıcı Adımı Unuttum</div>
<div style="word-wrap: break-word;">
<p>Email adresinize kayıtlı olan kullanıcılar aşağıda listelenmiştir.</p>
<div style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6;">
'.$icerik[1].'</div>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Hesabınızın güvenliğinden MetinHard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}
	
	
else if($icerik[0] == 'sifremi_unuttum'){
	
if($icerik[1] == 1){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Şifremi Unuttum Talebi</div>
<div style="word-wrap: break-word;"><p>Sayın <b>'.$icerik[2].'</b> Şifremi unuttum talebi gönderdiniz</p>
<p>Şifrenizi değiştirmek için aşağıdaki linke tıklayınız.</p>
<a style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6; cursor:pointer;" href="'.$icerik[3].'">
'.$icerik[3].'</a>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Şifremi unuttum mailini siz göndermediyseniz mail adresinizi değiştirip, kimse ile paylaşmayınız.</p>
<p>Hesabınızın güvenliğinden MetinHard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';

}

else if($icerik[1] == 2){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Şifreniz Değiştirildi</div>
<div style="word-wrap: break-word;"><p>Sayın <b>'.$icerik[2].'</b> Şifreniz Sistem Tarafından Değiştirilmiştir.</p>
<div style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6;">
Yeni Şifreniz : '.$icerik[3].'</div>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Bu işlemi siz yapmadıysanız bilgilerinizi değiştirip, kimse ile paylaşmayınız.</p>
<p>Hesabınızın güvenliğinden MetinHard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';

}


}
else if($icerik[0] == 'ep_transfer_sifre_unuttum'){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Ep Transfer Şifreniz Değiştirildi</div>
<div style="word-wrap: break-word;"><p>Sayın <b>'.$icerik[1].'</b> Ep Transfer Şifreniz Sistem Tarafından Değiştirilmiştir.</p>
<div style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6;">
Yeni Ep Transfer Şifreniz : '.$icerik[2].'</div>

<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>Bu işlemi siz yapmadıysanız bilgilerinizi değiştirip, kimse ile paylaşmayınız.</p>
<p>Hesabınızın güvenliğinden MetinHard2 Ekibi sorumlu değildir</p>
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}
else if($icerik[0] == 'kayit'){
	
if($icerik[1] == 1){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Oyunumuza Hoşgeldiniz</div>
<div style="word-wrap: break-word;"><p>Sayın <b>'.$icerik[2].'</b> Oyunumuza Hoşgeldiniz..</p>
<p>Kullanıcı Adınız : <b>'.$icerik[3].'</b></p>
<p>Karakter Silme Şifreniz : <b>'.$icerik[4].'</b></p>
<p>Telefon Numaranız : <b>'.$icerik[5].'</b></p>

<p> Kaydınızı Onaylamak İçin aşağıdaki linke tıklayınız.</p>

<a style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6; cursor:pointer;" href="'.$icerik[6].'">
'.$icerik[6].'</a>


<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}

else if($icerik[1] == 2){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Oyunumuza Hoşgeldiniz</div>
<div style="word-wrap: break-word;"><p>Sayın <b>'.$icerik[2].'</b> Oyunumuza Hoşgeldiniz..</p>

<p> Kaydınızı Onaylamak İçin aşağıdaki linke tıklayınız.</p>

<a style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6; cursor:pointer;" href="'.$icerik[3].'">
'.$icerik[3].'</a>


<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}

else if($icerik[1] == 3){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Oyunumuza Hoşgeldiniz</div>
<div style="word-wrap: break-word;"><p>Sayın <b>'.$icerik[2].'</b> Oyunumuza Hoşgeldiniz..</p>
<p>Kullanıcı Adınız : <b>'.$icerik[3].'</b></p>
<p>Karakter Silme Şifreniz : <b>'.$icerik[4].'</b></p>
<p>Telefon Numaranız : <b>'.$icerik[5].'</b></p>


<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}
	
}
else if($icerik[0] == 'kayit_onay'){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Oyunumuza Hoşgeldiniz</div>
<div style="word-wrap: break-word;"><p>Sayın <b>'.$icerik[1].'</b> Oyunumuza Hoşgeldiniz..</p>

<p> Kaydınızı Onaylamak İçin aşağıdaki linke tıklayınız.</p>

<a style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6; cursor:pointer;" href="'.$icerik[2].'">
'.$icerik[2].'</a>


<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}
else if($icerik[0] == 'mail_degistir'){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Mail Adresiniz Değiştirilecek</div>
<div style="word-wrap: break-word;"><p>Sayın <b>'.$icerik[1].'</b> Mail Adresiniz Değiştirilecektir.</p>
<p>Hesabınızın güvenliğinden Metinhard2 Ekibi sorumlu değildir.</p>
<p>Yeni Mail Adresiniz : <b>'.$icerik[2].'</b></p>
<p>Mailinizi aşığıdaki linke tıklayarak değiştirebilirsiniz.</p>

<a style="background: #dff0d8; display:block; padding:10px; color: #3c763d; border: 1px solid #d6e9c6; cursor:pointer;" href="'.$icerik[3].'">
'.$icerik[3].'</a>



<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}
else if($icerik[0] == 'ep_token'){
	
if($icerik[1] == 1){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">EP Satın Alındı</div>
<div style="word-wrap: break-word;"><p>Sayın <b>'.$icerik[2].'</b> Almış Olduğunuz Ep Bilgileri Aşağıdaki Gibidir</p>
<p>Token : <b>'.$icerik[3].'</b></p>
<p>Token Şifresi : <b>'.$icerik[4].'</b></p>
<p>Alınan Fiyat : <b>'.$icerik[5].' TL</b></p>
<p>Alınan Ep : <b>'.$icerik[6].' EP</b></p>


<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
}
else if($icerik[1] == 2){
	
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Token Şifresi</div>
<div style="word-wrap: break-word;"><p>Sayın <b>'.$icerik[2].'</b></p>
<p>'.$icerik[3].'</p>
<p>Token Şifresi : <b>'.$icerik[4].'</b></p>


<div style="margin-top:10px; background: #fcf8e3; display:block; padding:10px; color: #8a6d3b; border: 1px solid #faebcc;">
<p>İyi oyunlar dileriz.</p>


</div>

</div>
</div>

</body>

</html>';
	
	
}

}
else if($icerik[0] == 'destek'){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Destek Talebi Yanıtlandı</div>
<div style="word-wrap: break-word;">
<p>Server : <b>'.$icerik[1].'</b></p>
<p>Cevap Gönderen : <b>'.$icerik[2].'</b></p>
<p><b>'.$icerik[3].'</b> Adlı konuya cevap geldi.</p>


</div>
</div>

</body>

</html>';
	
}

else if($icerik[0] == 'admin_destek_cevap'){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Destek Talebi Yanıtlandı</div>
<div style="word-wrap: break-word;">
<p>Sayın : <b>'.$icerik[1].'</b> Açmış olduğunuz <b>'.$icerik[2].'</b> adlı destek talebi cevaplandı.</p>


</div>
</div>

</body>

</html>';
	
}
else if($icerik[0] == 'admin_kullanici_sifre'){
	
return '<html>
<body style="background: #fcf8f8; padding:50px 0; font-family: Verdana, Arial;">
<div style="width:550px; margin: 0 auto; background: #fff; padding:10px; box-shadow: 1px 1px 1px 1px rgba(127,127,127,0.3);">
<img src="http://i.hizliresim.com/GPzrXN.png" style="margin: 0 auto; display:block;">
<div style="background: #81b71a; color: #fff; padding:15px; text-align:center; margin-bottom:20px;">Şifreniz Değiştirildi.</div>
<div style="word-wrap: break-word;">
<p>Sayın : <b>'.$icerik[1].'</b> Şifreniz yönetici tarafından değiştirilmiştir. </p> 
<p>Yeni Şifreniz : <b>'.$icerik[2].'</b> </p>


</div>
</div>

</body>

</html>';
	
}

} 

?>