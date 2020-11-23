</section>
</div>
</div>
<script src="<?=WMadmintema;?>plugins/WMajax.js"></script>
<script src="<?=WMadmintema;?>plugins/modal.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?=WMadmintema;?>bootstrap/js/bootstrap.min.js"></script>

<script src="<?=WMadmintema;?>plugins/datatables/jquery.dataTables.js"></script>

<!-- FastClick -->
<script src="<?=WMadmintema;?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=WMadmintema;?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=WMadmintema;?>dist/js/demo.js"></script>
<script src="<?=WMadmintema;?>plugins/editor/editor.js"></script>


		
		



    </body>
</html>

<script>
	$('textarea.icerik').jqte();
	
	// settings of status
	var jqteStatus = true;
	$(".status").click(function()
	{
		jqteStatus = jqteStatus ? false : true;
		$('textarea.icerik').jqte({"status" : jqteStatus})
	});
</script>


<script>
        $('table#karaktersirala').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": false,
		  "iDisplayLength": 20
        });
        $('table#karaktersirala2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": false,
		  "iDisplayLength": 20
        });
</script>
