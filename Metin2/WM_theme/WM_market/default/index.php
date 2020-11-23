<?php 

require 'header.php'; 

$sosyal_ag = json_decode(server_detay("sosyal_ag"));

?>
	
    <section class="page container">
        <div class="row">
				<?php require 'kategoriler.php'; ?>
				<?php if(!$kategori_get || $kategori_get == "" || !isset($kategori_get)){  ?>
							<div class="span12">
								<div class="box pattern pattern-sandstone">
									<div class="box-header">
										<i class="fa fa-home fa-2x"></i>
										<h5>
										  Ana Sayfa  
										</h5>
									</div>
									<div class="box-content box-table">
										<table id="sample-table" class="table">
											<tbody>
                                        <tr>
                                            <td WIDTH=11%><img class="img" src="https://cdn0.iconfinder.com/data/icons/yooicons_set01_socialbookmarks/256/social_facebook_box_blue.png" /></td>
                                            <td WIDTH=70%><i class="fa fa-facebook-square"></i> Bizi Facebookta Takip Edin  <span class="line"></span> 
											Server duyurularından ve gelişmelerinden haberdar olmak için facebook adresimizi takip ediniz. </td>
                                            <td class="td-actions" WIDTH=20%>
							<a href="<?=$sosyal_ag[0];?>" target="_blank" class="btn btn-info"><i class="fa fa-facebook-square"></i> Facebook Git </a>
							
                                            </td>
                                        </tr>
                                        <tr>
                                            <td WIDTH=11%><img class="img" src="http://icons.iconarchive.com/icons/limav/flat-gradient-social/96/Twitter-icon.png" /></td>
                                            <td WIDTH=70%><i class="fa fa-twitter-square"></i> Bizi Twitterda Takip Edin  <span class="line"></span> 
											Server duyurularından ve gelişmelerinden haberdar olmak için twitter adresimizi takip ediniz. </td>
                                            <td class="td-actions" WIDTH=20%>
							<a href="<?=$sosyal_ag[2];?>" target="_blank"  class="btn btn-info"><i class="fa fa-twitter-square"></i> @Twitter Takip Et </a>
							
                                            </td>
                                        </tr>
                                        <tr>
                                            <td WIDTH=11%><img class="img" src="http://amics.covamanresa.cat/wp-content/uploads/2015/03/logo_youtube.png" /></td>
                                            <td WIDTH=70%><i class="fa fa-youtube-square"></i> Bizi Youtubede Takip Edin  <span class="line"></span> 
											Server duyurularından ve gelişmelerinden haberdar olmak için youtube adresimizi takip ediniz. </td>
                                            <td class="td-actions" WIDTH=20%>
							<a href="<?=$sosyal_ag[1];?>" target="_blank"  class="btn btn-danger"><i class="fa fa-youtube-square"></i> Youtube Git </a>
							
                                            </td>
                                        </tr>
									<?php }else
									{
										$kontrol_kategori = $db->prepare("SELECT * FROM market_kategori WHERE sid = ? && 
										seo = ?");
										$kontrol_kategori->execute(array($_SESSION["market_server"], $kategori_get));
										if($kontrol_kategori->rowCount())
										{ $fetch = $kontrol_kategori->fetch(PDO::FETCH_ASSOC);
										?>
										
										
                    <div class="span11">
                        <div class="box pattern pattern-sandstone">
                            <div class="box-header"><i class="fa fa-shopping-cart fa-1x"></i> <?=$fetch["isim"];?> 
                            </div>
                            <div class="box-content box-table itemler" id="ex3">
                                <table class="table">
                                    <tbody>
										<?php
										$itemler = $db->prepare("SELECT * FROM market_item WHERE sid = ? && kid = ?");
										$itemler->execute(array($_SESSION["market_server"], $fetch["id"]));
										foreach($itemler as $item){ 
										
										$sure_parcala = explode(',', $item["sure"]);
										
										
										if($item["sure_tur"] == 2)
										{
										$sure_parcala = explode(',', $item["sure"]);
										
										if($sure_parcala[0] != 0 && $sure_parcala[1] != 0)
										{
											$sure2 = $sure_parcala[0].' gün'.$sure_parcala[1].' Saat';
										}
										
										else if($sure_parcala[0] != 0)
										{
											$sure2 = $sure_parcala[0].' gün';
										}
										else if($sure_parcala[1] != 0)
										{
											$sure2 = $sure_parcala[1].' saat';
										}
										else
										{
											$sure2 = 'Süre bulunamadı';
										}
																					
										$sure = '<div class="itemPrice">
											<p><i class="fa fa-clock-o"></i> <font color="red">'.$sure2.'</font></p>
										</div>';
										}
										else
										{
											$sure = "";
										}
										
										?>
                                        <tr>
										
										<?php if($item["durum"] == 2){ ?>
										
                                        <td WIDTH=11%>
										
									<div class="img">
										<img src="<?=$item["resim"];?>" alt="daha fazla bilgi">
                                    <div class="indirimli"></div>
                                                </div>										
										
										</td>
                                        <td WIDTH=70%><?=$item["isim"];?>  <span class="line"></span> <?=$item["aciklama"];?></td>
										
                                        <td class="td-actions" WIDTH=20%>
										
										
										<div class="itemPrice">
										<p><?=($item["miktar"] == 1) ? 'Fiyat : ' : $item["miktar"].' tanesi :'; ?> <font color="lightgreen"><?=$item["fiyat"];?> EP </font></p>
										<div class="indirim-fiyat"></div>
										</div>

										<div class="itemPrice">
										<p>Eski Fiyatı : <font color="red"><?=$item["eskifiyat"];?> EP </font></p>
										</div>
										
										<?=$sure;?>
																				
										
										<a href="javascript:;" onclick="WM_click('&item=<?=$item["vnum"];?>&id=<?=$item["id"];?>&kategori=<?=$item["kid"];?>')" class="btn btn-success"><i class="fa fa-info-circle"></i> Ayrıntılar</a>
                                        </td>
										
										<?php }else{ ?>
										
                                        <td WIDTH=11%>
										
									<div class="img">
										<img src="<?=$item["resim"];?>" alt="daha fazla bilgi">
                                                </div>										
										
										</td>
                                        <td WIDTH=70%><?=$item["isim"];?>  <span class="line"></span> <?=$item["aciklama"];?></td>
										
                                        <td class="td-actions" WIDTH=20%>
										
										
										<div class="itemPrice">
										<p><?=($item["miktar"] == 1) ? 'Fiyat : ' : $item["miktar"].' tanesi :'; ?> <font color="lightgreen"><?=$item["fiyat"];?> EP </font></p>
										</div>
										
										<?=$sure;?>
										
										
										<a href="javascript:;" onclick="WM_click('&item=<?=$item["vnum"];?>&id=<?=$item["id"];?>&kategori=<?=$item["kid"];?>')" class="btn btn-info"><i class="fa fa-info-circle"></i> Ayrıntılar</a>
                                        </td>
										
										<?php } ?>
										
                                        </tr>
										<?php										
										} }
										else
										{
										header('Location: index.html');
										}
									} ?>
                                    </tbody>
									
                                </table>
                            </div>
									<div class="box-yukari"><i class="fa fa-arrow-up"></i> Yukarı Çık</div>
							
                        </div>
                    </div>
					
					
					
					
					
        </div>
            
        </div>

    </section>
	

<?php require 'footer.php'; ?>