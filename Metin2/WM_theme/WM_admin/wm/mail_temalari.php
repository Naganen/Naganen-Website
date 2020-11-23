<div class="body-content animated fadeIn">
                    
<div class="row">
					
<div class="col-md-12">
						
<div class="search-results">
						
<?php 
									
$dir = "../WM_theme/WM_mail/";
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
<?php if($WMadmin->serverbilgi("mail_tema") == $file){?>
<p class="sr-item-links"><a class="btn btn-danger btn-lg btn-block"><i class="fa fa-check"></i> Varsayılan Tema</a></p>
<?php }else{ ?>
<p class="sr-item-links"><a onclick="WM_click('tema_ayarlari&formid=3&tema=<?=$file;?>')" href="javascript:;" class="btn btn-success btn-lg btn-block"><i class="fa fa-save"></i> Tema Olarak Kaydet</a></p>
<?php } ?>
</div>	
										
<?php
									 
}
								 									
?>
</div>  		
                            
</div>                        
</div>
                    
                    
                    
</div>
