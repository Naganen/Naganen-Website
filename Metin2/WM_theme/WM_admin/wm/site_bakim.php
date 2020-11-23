<?php 

$tema_ayar = json_decode($WMadmin->serverbilgi("tema"));

?>

<div class="body-content animated fadeIn">
                    
<div class="row">
					
<div class="col-md-12">

<div class="panel panel-default">
<div class="panel-body">

<div class="alert alert-info"><i class="fa fa-info-circle"></i><b> BİLGİ ! </b> Tema ayarları > Domain Ana Sayfalarında  : Anasayfam sadece index olsunu seçer iseniz sitenizde bakım sayfası çıkmaz. ! <font color="red">Bu Panelin bir hatası değil sizin seçiminizdir.</font>  </div>									
<div class="alert alert-warning"><i class="fa fa-warning"></i><b> UYARI ! </b> Tema Olarak kaydet dediğiniz andan itibaren server sitenizde bakım sayfası aktif olur.. ! </div>									
<hr>
<?=$WMform->head("site_bakim");?>
<textarea name="bakim_icerik" class="icerik"><?=$WMadmin->serverbilgi("bakim_yazi");?></textarea>
<?=$WMform->buton(1, " Kayıt Et", "success pull-right", "save");?>
<?=$WMform->footer();?>

									
</div>
</div>
						
<div class="search-results">
						
<?php 
									
$dir = "../WM_theme/WM_bakim/";
$handle = @opendir($dir);
$say = 0;
while ($file = @readdir ($handle))
{
$say++;
										
if($file == "." || $file == ".."  || $file == "Thumbs.db") continue;
if(!is_dir($dir.$file)) continue;
										
?>
<div class="col-md-4 sr-item">
<center><h3 class="sr-item-title" style="color:green;"><?=$file;?></h3></center>
<p><img style="width:100%; height:250px;" src="<?=$dir.$file."/onizleme.jpg";?>"></p>
<?php if($tema_ayar[0] == "bakim" && $tema_ayar[1] == $file){?>
<p class="sr-item-links"><a class="btn btn-danger btn-lg btn-block"><i class="fa fa-check"></i> Varsayılan Tema</a></p>
<?php }else{ ?>
<p class="sr-item-links"><a onclick="WM_click('site_bakim&formid=2&tema=<?=$file;?>')" href="javascript:;" class="btn btn-success btn-lg btn-block"><i class="fa fa-save"></i> Tema Olarak Kaydet</a></p>
<?php } ?>
</div>	
										
<?php
									 
}
								 									
?>
</div>  		
                            
</div>                        
</div>
                    
                    
                    
</div>
