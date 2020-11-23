<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="tablo_wm wm_facebook">Facebookta Biz</div>
<div class="tablo_icerik wm_facebook_icerik">
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/tr_TR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	
<div class="fb-like-box" data-href="<?=$vt->sosyal(0);?>" data-width="410" data-height="500" data-colorscheme="dark" data-show-faces="true" data-header="true" data-stream="true" data-show-border="true"></div>


</div>
