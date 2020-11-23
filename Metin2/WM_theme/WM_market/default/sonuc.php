<?php

class WM_sonuc
{
	
public function __construct($sonuc, $yazi)
{

global $izin_verme, $db;	

require 'header.php';	
?>

<script>
function goBack() {
    window.history.back();
}
</script>

<section class="page container">
<div class="row">
<?php require 'kategoriler.php'; ?>
<div class="span12">
<div class="box pattern pattern-sandstone">
<div class="box-header">
<i class="fa fa-shopping-basket fa-2x"></i>
<h5>
 Satın Alma İşlemi
</h5>
</div>
<div class="box-content box-table">
<?=$this->$sonuc($yazi);?>
</div></div></div></div>

</section>


</div></div>


<?php	
require 'footer.php';	
}
	
public function hata($yazi)
{
	
return '<div class="alert alert-danger"><a onclick="goBack()" class="btn btn-danger btn-xs" href="javascript:;"><i class="fa fa-arrow-left"></i> Geri Git</a> <b><i class="fa fa-warning"></i> HATA </b> '.$yazi.' </div>';
	
}
public function basari($yazi)
{
	
return '<div class="alert alert-success"><a onclick="goBack()" class="btn btn-danger btn-xs" href="javascript:;"><i class="fa fa-arrow-left"></i> Geri Git</a> <b><i class="fa fa-check"></i> BAŞARI </b> '.$yazi.' </div>';
	
}
	
}


?>