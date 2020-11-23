<div class="body-content animated fadeIn">

<div class="row">


<div class="col-md-12">
<div class="panel panel-danger">
<div class="panel-heading ui-draggable-handle">
İtem Silme İşlemleri
</div>
<div class="panel-body">

<div class="alert alert-warning"><strong><i class="fa fa-warning"></i> UYARI ! </strong> Oyun içindeki girdiğiniz vnuma ait bütün itemler silinir. Lütfen dikkatli giriniz. !</div>

<?$WMform->head("item_islemleri");?>
<?$WMform->veri("vnum", "Silincek İtem Vnumu Giriniz ", "text", "11", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(1, "Sil", "danger pull-right", "trash", 1);?>
<?$WMform->footer();?>

<div class="col-md-12">


<hr>

<a onclick="WM_sil('item_islemleri&formid=2')" href="javascript:;" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> Oyundaki tüm itemleri sil</a>

</div>

</div>
</div>
</div>  



                      
</div>

</div>
