
<?php 
function server_listele($secili = 0)
{
global $db;
$query = $db->prepare("SELECT isim,id FROM server ORDER BY id DESC");
$query->execute();

foreach($query as $row)
{
	
?>
<option <?php if($secili == $row["id"] ){ echo "selected"; } ?> value="<?=$row["id"];?>"><?=$row["isim"];?></option>
<?php
	
}

}

$ana_sayfa = json_decode($WMadmin->ayarlar("index"));

?>

<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
<div class="panel panel-default">
<div class="panel-body">

<?=$WMform->head("domain_ana_sayfa");?>
<?=$WMform->veri("base_url", false, "text", false, 'value="'.$WMadmin->ayarlar("base").'"', "Paneli kurulu olduğu yerin linkini giriniz Örnek : http://webmeric.tk/");?>
<div class="col-md-6"><?$WMform->check("secilen", 1, "* Anasayfada sadece index olsun.", ($ana_sayfa[0] == "index") ? 1 : false, 1);?></div>
<div class="col-md-12" style="margin-top:10px;"><hr></div>
<div class="col-md-6"><?$WMform->check("secilen", 2, "Siteye girdiğinde direk yönlendirsin", ($ana_sayfa[0] == "yonlendir") ? 1 : false, 1);?></div>
<div class="col-md-6 form-group">
<select class="form-control" name="server2">
<?php server_listele(($ana_sayfa[0] == "index") ? $ana_sayfa[1] : 0); ?>
</select>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr></div>
<div class="col-md-6"><?$WMform->check("secilen", 3, "Anasayfada serverım olsun", ($ana_sayfa[0] == "direk") ? 1 : false, 1);?></div>
<div class="col-md-6 form-group">
<select class="form-control" name="server3">
<?php server_listele(($ana_sayfa[0] == "direk") ? $ana_sayfa[1] : 0); ?>
</select>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr></div>
<div class="col-md-6"><?$WMform->check("secilen", 4, "Hem Server, Hem de İndex Olsun", ($ana_sayfa[0] == "index_tema") ? 1 : false, 1);?></div>
<div class="col-md-6 form-group">
<select class="form-control" name="server4">
<?php server_listele(($ana_sayfa[0] == "index_tema") ? $ana_sayfa[1] : 0); ?>
</select>
</div>
<div class="col-md-12" style="margin-top:10px;"><hr><?=$WMform->buton(2, " Kayıt Et", "info pull-right", "save");?></div>
<?$WMform->footer();?>
									
</div>
</div>
						
</div>                        
</div>
                    
                    
                    
</div>
