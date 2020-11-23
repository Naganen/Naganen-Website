<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

            <div class="left-container" align="center">
                <div class="karakter detay"> <!-- PROFILE (MIDDLE-CONTAINER) -->
				<center><img class="img" src="<?=$ayar->WMimg.'profil/'.$fetch["job"];?>.png"> </center>
                    <ul class="menu-box-menu">
                        <li class="active"><b><?=$fetch["name"];?><?php if($goz_at->rowCount()){ ?><img title="Onaylı Karakter" src="<?=$ayar->WMimg;?>onaylandi.png"></a></td><?php }?></b>                       
                        </li>
                        <li>Level : <b><?=$fetch["level"];?></b> </li>
                        <li>Exp : <b><?=$fetch["exp"];?></b> </li>
                        <li class="img_li"><?=$vt->online_kontrol($fetch["name"]);?></li>
                    </ul>
					
						<?php 

						@$sosyal_kontrol = $odb->prepare("SELECT imza, sosyal FROM player.player LIMIT 1");
						@$sosyal_kontrol->execute( );

						if($sosyal_kontrol->rowCount())
						{
							
						$sosyal = json_decode(@$fetch["sosyal"]);
							
						if($sosyal[0] != '' || $sosyal[1] != '' || $sosyal[2] != '')
						{
							
						require_once Sayfa_html.'sosyal_left.php';	
						
						
						} } ?>
					
					
                </div>
			
            </div>
			
            <div class="right-container" align="center">
                <div class="karakter">
				<img class="img_li" src="<?=$ayar->WMimg.'bayrak2/'.$fetch["empire"];?>.png" /> 
				<a class="row"><span>Derece:</span> <b><?=$tema->rutbe($fetch["alignment"]);?></b> </a>
				<a class="row"><span>Beceri:</span> <b><?=$tema->skill_group($fetch["job"], $fetch["skill_group"]);?></b></a>
				<a class="row"><span>Oynayış Süresi:</span> <?=$fetch["playtime"];?> dk.</a>
				<a class="row"><span>Son Giriş:</span> <?= $WMinf->tarih_format('j F Y , l,  H:i:s', $fetch["last_play"]);  ?></a>
				
				<div class="statsSec"> 
				 <div class="col"><span>VIT</span> <br><?=$fetch["ht"];?> </div> 
				 <div class="col"><span>INT</span> <br><?=$fetch["iq"];?>  </div> 
				 <div class="col"><span>STR</span> <br><?=$fetch["st"];?> </div> 
				 <div class="col"><span>DEX</span> <br><?=$fetch["dx"];?>  </div>
				</div>		
				
				<div class="char">GENEL BİLGİLER</div> 
				<a class="row"><span>Yang:</span> <b><?=number_format($fetch["gold"]);?></b> </a>
				<a class="row"><span>Suç Sicili:</span> <?=($sicil->rowCount()) ? '<b><font color="red">SUÇLU</font></b>' : '<b style="color:#93e236; font-weight:bold;">TEMİZ</b>';?></a>
				<a class="row"><span>Son Görüldüğü Yer:</span> <?=$tema->konum($fetch["map_index"]);?></a>
				<a class="row"><span>Son Aktivite:</span> Yaklaşık <?=$tema->zaman_cevir($fetch["last_play"]);?></a>
				
				<?php if($fetch["lonca"] != ""){?>
				<div class="char">LONCA BİLGİLERİ</div> 
				<a class="row" href="lonca/<?=$fetch["lonca"];?>"><span>Lonca Adı :</span> <?=$fetch["lonca"];?></a>
				<a class="row"><span>Lonca Seviye :</span> <?=$fetch["lonca_level"];?></a>
				<a class="row"><span>Lonca Puan :</span> <?=$fetch["lonca_puan"];?></a>
				

				<?php } ?>
				
                </div>
				
				
							
            </div>
