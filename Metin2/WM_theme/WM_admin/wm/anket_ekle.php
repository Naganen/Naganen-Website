                <div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-body">
									
<?=$WMform->head("anket_islemleri");?>
<?=$WMform->veri("konu", "Anket Sorusunu Giriniz", "text", false, false);?>
<?=$WMform->veri("cevaplar", "Anket Cevaplarını Giriniz", "text", false, false, 'Anket Cevaplarını Lütfen , ile ayırın Örnek :  cevap1,cevap2,cevap3');?>
<?$WMform->check("tarih_durum", true, " Anketinizin Bitiş Tarihi Olacak mı ? Burayı işaretlemez iseniz aşağıdaki kutucukları doldurmanıza gerek yoktur. ( Girdiğiniz tarihe gelindiğinde anket oylamaları otomatik durdurulur.)", false, 1);?>
<?=$WMform->veri("tarih", false, "date", false, false, 'Anketin Bitiş Tarihini Giriniz ( Bugün bitsin istiyorsanız boş bırakın) Daha detaylı görünüm için en sağdaki aşağı oka basınız.');?>
<?=$WMform->veri("saat", "Anket Bitiş Saati", "text", false, false, 'Anketin Bitiş Saatini Giriniz,  Girdiğiniz saat saniyeye kadar girilmelidir Örnek 13:45:00');?>
<?=$WMform->buton(1, " Duyuru Ekle", "success pull-right", "plus");?>
<?=$WMform->footer();?>
									
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
