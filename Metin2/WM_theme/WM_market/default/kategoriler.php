                <div class="span4">
                        <ul id="person-list" class="nav nav-list">
                            <li class="nav-header"><i class="fa fa-shopping-cart"></i> Kategoriler</li>
                            <li class="<?=(!$kategori_get || $kategori_get == "" || !isset($kategori_get)) ? 'active' : '';?>">
                                <a id="view-all" href="#">
                                    <i class="icon-chevron-right pull-right"></i>
                                    <b>Ana Sayfa</b>
                                </a>
                            </li>
								<?php
								$kategoriler = $db->prepare("SELECT id,seo,isim FROM market_kategori WHERE sid = ? ORDER BY sira");
								$kategoriler->execute(array($_SESSION["market_server"]));
								foreach($kategoriler as $kategori){
								?>
                                <li class="<?=($kategori["seo"] == $kategori_get) ? 'active' : '';?>">
								<a href="kategori/<?=$kategori["seo"];?>"><i class="icon-chevron-right pull-right"></i><?=$kategori["isim"];?></a></li>
								<?php  } ?>
                            
                            
                        </ul>
                </div>
