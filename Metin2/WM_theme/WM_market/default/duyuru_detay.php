<?php 

require 'header.php'; 

@$seo = $WMkontrol->WM_get($WMkontrol->WM_html($_GET["seo"]));

$kontrol = $db->prepare("SELECT * FROM market_duyuru WHERE seo = ? && sid = ?");
$kontrol->execute(array($seo, $_SESSION["market_server"]));

if($kontrol->rowCount())
{
	
$fetch = $kontrol->fetch(PDO::FETCH_ASSOC);

?>
	
<section class="page container">
<div class="row">

<?php 



?>

<div class="span15">
<div class="box pattern pattern-sandstone">
<div class="box-header">
<h5>
<?=$fetch["konu"];?>
</h5>
</div>
<div class="box-content box-table">
<table class="table">
<tbody>
<p style="color :#fff;">
<?=html_entity_decode($fetch["icerik"]);?>
</p>								
</tbody>
									
</table>
</div>

					
					
</div>
            
</div>



</div>

</section>

<?php } ?>
	

<?php require 'footer.php'; ?>