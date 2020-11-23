$(function(){
					
			$("#yukle").submit(function(){//eğer form gönderilirse.
				$("#i[name=sonuc]").html(' <img style="display:block;width:50px;height:50px;margin:auto;" src="loading.gif" alt="loading" /> ').show();
				//loading gifini göster
				$("#iframe").load(function(){//eğer iframe yüklendiyse
					var veri=$(this).contents().find("body").html();//iframenin içeriğini al
					$("#i[name=sonuc]").html(veri);//sonuşları ekrana bas
					//ve sayfadaki fileleri silip yerin 1 tane yeni file koy
				})
			});
			
});

function sayi_kontrol(v) {
    var isNum = /^[0-9'.'-]*$/;
    if (!isNum.test(v.value)) {
			notify({type: "error", title: "Hata ! ", position: {x: "right", y: "top" }, icon: '<i class="fa fa-close fa-2x"></i>', message: " Lütfen sadece sayı giriniz..", autoHide: true });
        v.value = v.value.replace(/[^0-9'.'-]/g,"");
    }
}

function turkce_kontrol(v) {
	var reg= new RegExp("\[ÜĞŞÇÖğıüşöç]");
    if (reg.test(v.value)) {
			notify({type: "error", title: "Hata ! ", position: {x: "right", y: "top" }, icon: '<i class="fa fa-close fa-2x"></i>', message: " Lütfen türkçe karakter girmeyiniz", autoHide: true });
        v.value = v.value.replace(/["ÜĞŞÇÖğıüşöç"]/g,"");
    }
}

function WM_post_et(formid){
		$('div#ajax_post').fadeIn(10);
		setTimeout(function(){
		var pid = $('button[name=gonder-'+formid+']').attr('pid');
		var formum = $('button[name=gonder-'+formid+']').attr('formid');
		var href2 = $('button[name=gonder-'+formid+']').attr('id');
		if(!formum){
		var href = 'form#'+href2;
		}else{
		var href = 'form.form'+formum;
		}
		$.ajax({ 
					type: "POST",
					url: "ajax.php?islem="+href2+"&pid="+pid+"&formid="+formid,
					data: $(href).serialize(),
					success: function(veri) {
						$('div#ajax_post').fadeOut(10);
						$('div#sonuc').html(veri);
					}
					
				});
		}, 500);

}

function giris_yap(){
		$('div#ajax_post').fadeIn(10);
		setTimeout(function(){
		$.ajax({ 
					type: "POST",
					url: "ajax.php?islem=giris_yap",
					data: $("form#giris_yap").serialize(),
					success: function(veri) {
						$('div#ajax_post').fadeOut(10);
			if(veri == 1){
			$('div#girisyapildimi').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><strong>Başarı ! </strong> Başarıyla giriş yaptınız 3 saniye içinde yönlendiriliyorsunuz.. </div><meta http-equiv="refresh" content="2;URL=index.php">');
			}
			else if(veri == 2){
			$('div#girisyapildimi').html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><strong>Uyarı ! </strong> Kullanıcı Adınızı veya Şifreniz Yanlış </div>');
			}
			else{
			$('div#girisyapildimi').html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>Sistem Hatası </div><meta http-equiv="refresh" content="1;URL=index2.php">');
			}
					}
					
				});
		}, 500);

}

function WM_click(yonlendir){
	$("div#sonuc").load("ajax.php?islem="+yonlendir);
}

function WM_sil(yonlendir){
	
	
			modal({
				type: 'confirm',
				title: '<i class="fa fa-warning"></i> Bu İşlemi Onaylıyormusunuz ? ',
				text: 'Silindikten sonra tekrar geri alınamaz.! Silmek istediğinize Eminmisiniz ? ',
				buttonText: {
					ok: 'Evet',
					yes: 'Evet',
					cancel: 'Hayır'
				},
				buttons: [{
					text: 'OK', //Button Text
					val: 'ok', //Button Value
					eKey: true, //Enter Keypress
					addClass: 'btn-red', //Button Classes (btn-large | btn-small | btn-green | btn-light-green | btn-purple | btn-orange | btn-pink | btn-turquoise | btn-blue | btn-light-blue | btn-light-red | btn-red | btn-yellow | btn-white | btn-black | btn-rounded | btn-circle | btn-square | btn-disabled)
					onClick: function(argument) {
						console.log(argument);
						alert('Look in console!');
					}
				}, ],


				callback: function(result) {
					
					if(result == true){
						$("div#sonuc").load("ajax.php?islem="+yonlendir);
					}
					
				}
			});
}   

