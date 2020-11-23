<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>
                    <ul class="menu-box-menu">
                        <li class="facebook"><b>Sosyal Ağ</b> </td></li>
                        <li class="trans img_li">
						
						<?php if($sosyal[0] != ''){ ?>
						<a href="<?=$sosyal[0];?>" target="_blank"><img src="<?=$ayar->WMimg;?>facebook.png"></a> 
						<?php } ?>
						<?php if($sosyal[1] != ''){ ?>
						<a href="<?=$sosyal[1];?>" target="_blank"><img src="<?=$ayar->WMimg;?>youtube.png"></a> 
						<?php } ?>
						<?php if($sosyal[2] != ''){ ?>
						<a href="<?=$sosyal[2];?>" target="_blank"><img src="<?=$ayar->WMimg;?>instagram.png"></a> 
						<?php } ?>
						
						</li>
                    </ul>
