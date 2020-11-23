<div class="body-content animated fadeIn">
                    
                    
<div class="row">
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Site İP Banlama Bölümündesiniz
</div>
<div class="panel-body">
<table class="table" id="karaktersirala">
<thead>
<tr>
<th>Engellenen İP </th>
<th>İşlem </th>
</tr>
</thead>
<tbody>
<?php

$file = file_get_contents("../.htaccess");

$parcala = explode("order allow,deny", $file);

$parcala2 = explode("deny from ", $parcala[1]);

function degistir($s, $tur = 1) 
{
	
global $WMclass;
	
$d = array('allow from all', ' ', '  ', '\n', '
 ');
$f = array('', '', '', '', '');
$s = str_replace($d,$f,$s);

return $WMclass->bosluk_sil($s);

}

unset($parcala2[0]);

?>

<tr>
<?=$WMform->head("site_ban_islem");?>
<td><?=$WMform->veri("ip", false, "text", false, "onkeyup='sayi_kontrol(this)'");?></td>
<td><?=$WMform->buton(2, " Engelle", "danger", "ban");?></td>

</tr>

<?php
$i = 0;

foreach($parcala2 as $row)
{ $i++;
	
	
?>
<tr id="banli-<?=$i;?>">
<td><?=degistir($row);?></td>
<td><a onclick="WM_sil('site_ban_islem&formid=1&ip=<?=degistir($row);?>&ban_id=<?=$i;?>')" href="javascript:;" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>

</div>                        
</div>
                    
                    
                    
</div>
