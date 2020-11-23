/*MT2 LookUP*/

$(document).ready(function() {
	
	$('.depoil1_con').mouseover(function() {
		if($(this).find('img').length != 0) {
			var doc_url = document.URL;
			var depo_player_name = doc_url.match(/sayfa=kullanicilar&login=(\w*)/i);
			depo_equip_show($(this).attr('id'), 'EQUIPMENT', depo_player_name[1]);
			$('#depoequip_show').css('display', 'block');
		}
	});
	
	$('.depoil2_con').mouseover(function() {
		if($(this).find('img').length != 0) {
			var doc_url = document.URL;
			var depo_player_name = doc_url.match(/sayfa=kullanicilar&login=(\w*)/i);
			depo_equip_show($(this).attr('id'), 'INVENTORY', depo_player_name[1]);
			$('#depoequip_show').css('display', 'block');
		}
	});
	
	$('.depoil1_con').mouseout(function() {
		$('#depoequip_show').html('');
		$('#depoequip_show').css('display', 'none');
	});
	
	$('.depoil2_con').mouseout(function() {
		$('#depoequip_show').html('');
		$('#depoequip_show').css('display', 'none');
	});
	
	$('body').mousemove(function(e) {
		var div_height = $('#depoequip_show').css('height');
		div_height = div_height.replace('px', '');
		if(e.pageY<250) {
			var y_wert = e.clientY-150;
		} else { 
			var y_wert = e.clientY-150;
		}
		$('#depoequip_show').css('margin-top', y_wert);
	});

});

var xmlhttp;
function loadXMLDoc(url,cfunc)
{
if (window.XMLHttpRequest) {
  xmlhttp=new XMLHttpRequest();
} else {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=cfunc;
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function depo_equip_show(depovalue, depoart, depo_player_name) {
loadXMLDoc("ajax.php?islem=depogoster&id="+depovalue+'&art='+depoart+'&pid='+depo_player_name, function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		$('#depoequip_show').html(xmlhttp.responseText);
    }
  });
}
