<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

  <div class="chat">
    <ul>
	
	<?php if($sayfa == 1 || !$sayfa){ ?>
	
      <li class="other">
        <a class="user"><p>Siz</p></a>
        <a class="user"><img alt="" src="<?=$ayar->WMimg;?>user.png" /></a>
        <div class="date">
          <?=$tema->zaman_cevir($fetch["tarih"]);?>
        </div>
        <div class="message">
          <p>
            <?=$this->icerik;?>
          </p>
        </div>
      </li>
	  
	<?php } ?>
	
	<?php
	
	$sayfada = 5; // sayfada gösterilecek içerik miktarını belirtiyoruz.


	$toplam_cevap = $db->query("SELECT * FROM destek_cevap WHERE tid = '".$fetch["id"]."'")->rowCount();
	
	$toplam_sayfa = ceil($toplam_cevap / $sayfada);
		
	if($toplam_cevap != 0)
	{
		
	$sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;
	 
	if($sayfa < 1){ $sayfa = 1; } 
	 
	if($sayfa > $toplam_sayfa){ $sayfa = $toplam_sayfa; }

	$limit = ($sayfa - 1) * $sayfada;
	 
	$cevaplar = $db->query("SELECT * FROM destek_cevap WHERE tid = '".$fetch["id"]."'
	LIMIT $limit, $sayfada");
	
	
	foreach($cevaplar as $cevap)
	{
		
	if($cevap["ckisi"] == 2){ $p = $cevap["cevaplayan"];  $img = "admin"; $c = "you";}
	else{ $p = "Siz";  $img = "user"; $c = "other";}
	
	?>
	
      <li class="<?=$c;?>">
        <a class="user"><p><?=$p;?></p></a>
        <a class="user"><img alt="" src="<?=$ayar->WMimg.$img;?>.png" /></a>
        <div class="date">
          <?=$tema->zaman_cevir($cevap["tarih"]);?>
        </div>
        <div class="message">
          <p>
           <?=html_entity_decode($cevap["cevap"]);?>
          </p>
        </div>
      </li>
	  
	<?php } } ?>
	  
	  
    </ul>
  </div>
  <br><br>
  <?=($toplam_sayfa != 1) ? $tema->sayfala("kullanici/teknik-destek-detay?id=".$id."&sayfa=", $sayfa, $sayfada, $toplam_sayfa) : '';?> 
