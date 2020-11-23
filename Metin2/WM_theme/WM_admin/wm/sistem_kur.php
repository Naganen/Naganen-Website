
 

 <!-- END BREADCRUMB -->                       
                
                <!-- PAGE CONTENT WRAPPER -->
<div class="body-content animated fadeIn">
                    
                    
                    <div class="row">
					
                        <div class="col-md-9">
						
						
									<div class="panel panel-default">
									<div class="panel-body">
                                    <div class="table-responsive push-up-10">
																		
                                        <table class="table table-actions table-striped">
                                            <thead>                                            
                                                <tr>
                                                    <th WIDTH=3%>#</th>
                                                    <th WIDTH=40%>Sistem İsimi</th>
                                                    <th WIDTH=30%>Sistem Durum</th>
                                                    <th WIDTH=110%>İşlemler</th>
                                                </tr>
                                            </thead>
                                            <tbody>
											
<?php 
									
$dir = "WM_sistemler/";
$handle = @opendir($dir);
$say = 0;
while ($file = @readdir ($handle))
{

if($file == "." || $file == "..") continue;

$say++;

$sistem_isim_kontrol = $dir.$file.'/info.txt';

$sistem_fonksiyonlar_kontrol = $dir.$file.'/fonksiyonlar.txt';
										
$sistem_statu_kontrol = $dir.$file.'/statu.php';

$sistem_ayar_kontrol = $dir.$file.'/ayar.php';

if(file_exists($sistem_ayar_kontrol))
{
	
$islem_evet = "index.php?sayfa=sistemler&ayar=".$file;
	
}
else
{
	
$islem_evet = false;
	
}
										
if(file_exists($sistem_isim_kontrol))
{
	
$sistem_isim = file_get_contents($sistem_isim_kontrol);

}
else
{
	
$sistem_isim = "Webmeric Null Sistem";

}
if(file_exists($sistem_fonksiyonlar_kontrol))
{

$sistem_fonksiyon = file_get_contents($sistem_fonksiyonlar_kontrol);


}
else
{

$sistem_fonksiyon = "yok,yok,yok";
	
}

$fonksiyon = explode(',', $sistem_fonksiyon);

if(file_exists($sistem_statu_kontrol))
{
	
require $sistem_statu_kontrol;

if (function_exists($fonksiyon[0]))
{
	
if($fonksiyon[0]() == false){ $sistem_statu = '<font color="red"><b>KURULU DEĞİL</b></font>'; }

else{ $sistem_kurulu[$say] = true; $sistem_statu = '<font color="93e236"><b>KURULU</b></font>'; }

}
else
{
	
$sistem_statu = "Fonksiyon Yok";
	
}

	
}
else
{
	
$sistem_statu = "Dosya Yok";

}

																				
?>
<?=$WMform->head("sistem_ayarlari", $say);?>
<tr>
<td><?=$say;?></td>
<?=$WMform->veri("kurulum_kaldirim-$say", false, "hidden", false, "value='".$dir.$file."/'");?>
<td><a href="#"><?=$sistem_isim;?></a></td>
<td><?=$sistem_statu;?></td>
<td><?(isset($sistem_kurulu[$say])) ? $WMform->buton($say, " Kaldır", "danger", "trash", 1) : $WMform->buton($say, " Kur", "success", "plus", 2);?>
<?php if(isset($sistem_kurulu[$say]) && $islem_evet != false){?>
 <a class="btn btn-default" href="<?=$islem_evet;?>"><i class="fa fa-cog"></i> İşlemler</a>
<?php } ?>
</td>
</tr>
<?=$WMform->footer();?>
										
										<?php
									 
									 }
								 									
									?>
											
                                            </tbody>
                                        </table>
                                    </div>
									</div>
									</div>
                            
                        </div>   
					<div class="col-md-3">
					
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h3>Açıklamalar</h3>
									
									<p>
									Sistemler <b>webmeric</b> tarafından paylaşılmaktadır.
									</p>
									<p>
									Kendi yaptığınız bir sistem kodlamasının doğru çalıştığından emin olun.
									</p>
									<p>
									Sistem kurulum aşamasında eksik bir kodlama paneli geri dönüşü olmayan bir hataya sokabilir.
									</p>
									<p>
									Bu gibi sistem hatalarında <b>webmeric</b> sorumlu tutulamaz.
									</p>
									<p>
									<b>WMCP</b> panelini ücretsiz kullananlara bu gibi kullanıcı hatalı sorunlarda destek verilmez.
									</p>
									
                                </div>
                            </div>
							
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <h3>Sistemlerden Nasıl Haberim Olur ? </h3>
									
									<p>
									Ücretsiz yapılan Sistemler <b>webmeric</b> sitesinde ve bazı forumlarda paylaşılır.
									</p>
									<p>
									Paneli ücretli alan kişilere Skype : <b>webmeric</b> adresinden istedikleri sistem özel olarak kodlanıp. Özel olarak
									skypeden dosyalar atılır.
									</p>
									<p>
									Sistem kurulumunu bilmeyenlere gerekli açıklamalarımız sitemizde yazmaktadır..
									</p>
									
                                </div>
                            </div>
					
					</div>
					
                    </div>
                    
                    
                    
                </div>
