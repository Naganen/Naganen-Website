                <div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-4">
						
<div class="panel panel-default">
<div class="panel-body">
									
								
<?=$WMform->head("anket_anasayfa");?>
<?=$WMform->veri("konu", false, "text", false, 'value="'.$afetch["konu"].'"', ' Anket Konusu ');?>
<?=$WMform->buton(2, " Anketi Güncelle", "info btn-block pull-right", "save", $islem);?>
									
									
</div>
</div>
						
</div>  

<div class="col-md-4">
						
<div class="panel panel-default">
<div class="panel-body">


<h4 align="center"><i class="fa fa-thumbs-o-up" style="color:green;"></i> OLUMLU OY VERENLER <?php $olumlu = explode(',', $afetch["onay"]); echo ' ('.count($olumlu).')';?></h4>		

<table class="table table-actions table-striped">
<tbody>
<?php 
foreach($olumlu as $begen){ ?>
<tr align="center">
<td><a href="index.php?sayfa=kullanicilar&login=<?=$begen;?>" target="_blank"><?=$begen;?></a></td>
</tr>
<?php } ?>
</tbody>
</table>
							
																	
									
</div>
</div>
						
</div>  

<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-body">


<h4 align="center"><i class="fa fa-thumbs-o-down" style="color:red;"></i> OLUMSUZ OY VERENLER <?php $olumsuz = explode(',', $afetch["red"]); echo ' ('.count($olumsuz).')';?></h4>		

<table class="table table-actions table-striped">
<tbody>
<?php 
foreach($olumsuz as $disslike){ ?>
<tr align="center">
<td><a href="index.php?sayfa=kullanicilar&login=<?=$disslike;?>" target="_blank"><?=$disslike;?></a></td>
</tr>
<?php } ?>
</tbody>
</table>
							
																	
									
</div>
</div>
</div>
						
</div>  


                      
</div>
                    
                    
                    
