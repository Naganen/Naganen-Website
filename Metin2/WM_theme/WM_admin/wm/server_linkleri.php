<div class="body-content animated fadeIn">
                    
                    
<div class="row">
					
<div class="col-md-12">
						
						
<div class="panel panel-default">
<div class="panel-heading ui-draggable-handle">

<?=$WMadmin->serverbilgi("isim");?> - Link Ayarları
												
</div>
<div class="panel-body">

			
<?=$WMform->head("link_ayarlari");?>
<?=$WMform->veri("anasayfa", false, "text", false, 'value="'.$link[0].'"', " Ana Sayfa Linki");?>
<?=$WMform->veri("kaydol", false, "text", false, 'value="'.$link[1].'"', " Kayıt Ol Linki");?>
<?=$WMform->veri("siralama", false, "text", false, 'value="'.$link[2].'"', " Sıralama Linki");?>
<?=$WMform->veri("indir", false, "text", false, 'value="'.$link[3].'"', " İndirme Linki");?>
<?=$WMform->veri("giris", false, "text", false, 'value="'.$link[4].'"', " Giriş Yapma Linki");?>
<?=$WMform->veri("hesap", false, "text", false, 'value="'.$link[5].'"', " Kullanıcı Profil Linki");?>
<hr>
<?=$WMform->veri("market", false, "text", false, 'value="'.$link[11].'"', " Market Linki");?>
<?=$WMform->veri("cikis", false, "text", false, 'value="'.$link[6].'"', " Çıkış Yapma Linki");?>
<?=$WMform->veri("destek", false, "text", false, 'value="'.$link[7].'"', " Teknik Destek Linki");?>
<?=$WMform->veri("forum", false, "text", false, 'value="'.$link[8].'"', " Forum Linki");?>
<?=$WMform->veri("bansorgula", false, "text", false, 'value="'.$link[9].'"', " Ban Sorgulama Linki");?>
<?=$WMform->veri("tanitim", false, "text", false, 'value="'.$link[10].'"', " Oyun Tanıtım Linki");?>
<?=$WMform->buton(1, " Ayarları Kaydet", "success pull-right", "save");?>
<?=$WMform->footer();?>
	
</div>
</div>
                            
</div>                        
</div>
                    
                    
                    
</div>
