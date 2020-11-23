            </div>
        </div>

        <div id="spinner" class="spinner" style="display:none;">
            Loading&hellip;
        </div>
		
				
        <script src="<?=WM_market;?>jquery/login.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/news.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-transition.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-alert.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-modal.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-dropdown.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-scrollspy.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-tab.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-tooltip.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-popover.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-button.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-collapse.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-carousel.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-typeahead.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-affix.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/bootstrap/bootstrap-datepicker.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/jquery-tablesorter.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/jquery-chosen.js" type="text/javascript" ></script>
        <script src="<?=WM_market;?>jquery/virtual-tour.js" type="text/javascript" ></script>
		
		<script>
		
		$('#ex3').scroll(function(){
    if ($(this).scrollTop() > 300)    // Sayfa ne kadar aşağı kayarsa buton görünsün. 100 sayısı = Kaydırma çubuğunun piksel konumu. Bu sayı değiştirilebilir.
        $("div.box-yukari").fadeIn(500);    // Yukarı çık butonu ne kadar hızla ortaya çıksın. 500 milisaniye = 0,5 saniye. Bu sayı değiştirilebilir.
    else 
        $("div.box-yukari").fadeOut(500);    // Yukarı çık butonu ne kadar hızla ortadan kaybolsun. 500 milisaniye = 0,5 saniye. Bu sayı değiştirilebilir.
});
$(document).ready(function(){
    $("div.box-yukari").click(function(){    // Yukarı çık butonuna tıklanıldığında aşağıdaki satır çalışır.
        $("#ex3").animate({ scrollTop: "0" }, 500);    // Sayfa ne kadar hızla en yukarı çıksın.
        // 0 sayısı sayfanın en üstüne çıkılacağını belirtir.
        // 500 sayısı ne kadar hızla çıkılacağını belirtir. 500 milisaniye = 0,5 saniye. Bu sayı değiştirilebilir.
        return false;
    });
});
		
		</script>
		
		
			<script type="text/javascript">
			

function WM_click(yonlendir){
	$("div#sonuc").load("index.php?sayfa=lightbox"+yonlendir);
}	

	
	
</script>
	
	
<script>
	$(window).load(function(e) {
        $("#bn1").breakingNews({
			effect		:"slide-h",
			autoplay	:true,
			timer		:3000
		});
		
		
    });
 </script>

	

    </body>
</html>
<div id="sonuc"></div>