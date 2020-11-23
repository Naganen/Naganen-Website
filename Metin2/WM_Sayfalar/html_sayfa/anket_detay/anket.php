<?php
if($vt->a("breadcumb") == 1){

?>

<div class="breadcumb">
<li><a href="<?=$vt->url(0);?>"><?=$vt->a("isim");?> </a> > </li>
<li><a href="<?=$vt->url(0);?>">Anketler </a> > </li>
<li><?=$WMinf->kisalt($this->konu, 35);?> </li>
</div>

<br>

<?php } 

?>

<div class="clear"></div>

<div align="left">
