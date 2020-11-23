<div class="body-content animated fadeIn">

<div class="row">

<div class="col-md-12">
<div class="alert alert-warning"><strong><i class="fa fa-warning"></i> UYARI ! </strong> Yapılan işlemler refine_proto tablosundaki bütün verilere uygulanır. Örnek : 30 Arttırma işlemi yaptınız bütün verilerin geçme şansı 30 arttırılır .!</div>
</div>

<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Exp Arttırma İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("mob_proto_ayar");?>
<?$WMform->veri("kac-1", "Exp Kaç Arttırılsın ? ", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(1, false, "success pull-right", "arrow-up", 1);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Exp Azaltma İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("mob_proto_ayar");?>
<?$WMform->veri("kac-2", "Exp Kaç Azaltılsın ? ", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(2, false, "danger pull-right", "arrow-down", 2);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">
Exp Çarpma / Bölme İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("mob_proto_ayar");?>
<?$WMform->veri("kac-3", "Exp kaç katı .. ? ", "text", "8", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(3, false, "danger pull-right", "arrow-down", 3);?>
<?$WMform->buton(4, false, "success pull-right", "arrow-up", 4);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
Düşçek Minumum Altın Arttırma İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("mob_proto_ayar");?>
<?$WMform->veri("kac-10", "Düşçek Minumum Altın Kaç Arttırılsın ? ", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(10, false, "success pull-right", "arrow-up", 10);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
Düşçek Minumum Altın Azaltma İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("mob_proto_ayar");?>
<?$WMform->veri("kac-11", "Düşçek Minumum Altını kaç azaltılsın ? ", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(11, false, "danger pull-right", "arrow-down", 11);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-success">
<div class="panel-heading ui-draggable-handle">
Düşçek Minumum Altın Çarpma / Bölme İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("mob_proto_ayar");?>
<?$WMform->veri("kac-12", "Düşçek Minumum Altın kaç katı .. ? ", "text", "8", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(12, false, "danger pull-right", "arrow-down", 12);?>
<?$WMform->buton(13, false, "success pull-right", "arrow-up", 13);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-danger">
<div class="panel-heading ui-draggable-handle">
Düşçek Maximum Altın Arttırma İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("mob_proto_ayar");?>
<?$WMform->veri("kac-20", "Düşçek Maximum Altın Kaç Arttırılsın ? ", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(20, false, "success pull-right", "arrow-up", 20);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-danger">
<div class="panel-heading ui-draggable-handle">
Düşçek Maximum Altın Azaltma İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("mob_proto_ayar");?>
<?$WMform->veri("kac-21", "Düşçek Maximum Altın kaç azaltılsın ? ", "text", "10", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(21, false, "danger pull-right", "arrow-down", 21);?>
<?$WMform->footer();?>
</div>
</div>
</div>  

<div class="col-md-4">
<div class="panel panel-danger">
<div class="panel-heading ui-draggable-handle">
Düşçek Maximum Altın Çarpma / Bölme İşlemleri
</div>
<div class="panel-body">
<?$WMform->head("mob_proto_ayar");?>
<?$WMform->veri("kac-22", "Düşçek Maximum Altın kaç katı .. ? ", "text", "8", "onkeyup='sayi_kontrol(this)'");?>
<?$WMform->buton(22, false, "danger pull-right", "arrow-down", 22);?>
<?$WMform->buton(23, false, "success pull-right", "arrow-up", 23);?>
<?$WMform->footer();?>
</div>
</div>
</div>  
                      
</div>

</div>
