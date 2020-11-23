<div class="body-content animated fadeIn">

<div class="row">

<div class="col-md-12">
<div class="alert alert-warning"><strong><i class="fa fa-warning"></i> UYARI ! </strong> Yapılan işlemler refine_proto tablosundaki bütün verilere uygulanır. Örnek : 30 Arttırma işlemi yaptınız bütün verilerin geçme şansı 30 arttırılır .!</div>
</div>

<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Geçme Şansı Arttırma İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("refine_proto_ayar");?>
<?$WMform->veri("kac-1", "Geçme şansı kaç arttırılsın ? ", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(1, false, "success pull-right", "arrow-up", 1);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Geçme Şansı Azaltma İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("refine_proto_ayar");?>
<?$WMform->veri("kac-2", "Geçme şansı kaç azaltılsın ? ", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(2, false, "danger pull-right", "arrow-down", 2);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Geçme Şansı Çarpma / Bölme İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("refine_proto_ayar");?>
<?$WMform->veri("kac-3", "Geçme şansı kaç katı .. ? ", "text", "8", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(3, false, "danger pull-right", "arrow-down", 3);?>
<?$WMform->buton(4, false, "success pull-right", "arrow-up", 4);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
İstenilcek Altın Arttırma İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("refine_proto_ayar");?>
<?$WMform->veri("kac-10", "Kaç altın arttırılsın ", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(10, false, "success pull-right", "arrow-up", 10);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
İstenilcek Altın Azaltma İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("refine_proto_ayar");?>
<?$WMform->veri("kac-11", "Kaç altın  azaltılsın ? ", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(11, false, "danger pull-right", "arrow-down", 11);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
İstenilcek Altın Çarpma / Bölme İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("refine_proto_ayar");?>
<?$WMform->veri("kac-12", "Altın kaç katı .. ? ", "text", "8", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(12, false, "danger pull-right", "arrow-down", 12);?>
<?$WMform->buton(13, false, "success pull-right", "arrow-up", 13);?>
<?$WMform->footer();?>
</div>
</div>
</div>  
                      
</div>

</div>
