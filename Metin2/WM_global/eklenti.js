function turkce_kontrol(v) {
	var reg= new RegExp("\[ÜĞŞÇÖğıüşöç]");
    if (reg.test(v.value)) {
			alert("Türkçe karakter girmeyiniz..");
        v.value = v.value.replace(/["ÜĞŞÇÖğıüşöç"]/g,"");
    }
}

function sayi_kontrol(v) {
    var isNum = /^[0-9'.']*$/;
    if (!isNum.test(v.value)) {
		alert("Lütfen sadece sayı giriniz");
        v.value = v.value.replace(/[^0-9'.']/g,"");
    }
}

function yenile(konum = "."){

if(konum == "."){var yer = "";}else{var yer = "../";}

$("#online_oyuncu").load(yer+"bilgiler.php?int=0");
$("#rekor_online").load(yer+"bilgiler.php?int=1");
$("#toplam_kayit").load(yer+"bilgiler.php?int=2");
$("#toplam_karakter").load(yer+"bilgiler.php?int=3");
$("#toplam_lonca").load(yer+"bilgiler.php?int=4");
}



