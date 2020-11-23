/*MT2 LookUP*/

$(document).ready(function() {
	
	$('.nesneil1_con').mouseover(function() {
		if($(this).find('img').length != 0) {
			var doc_url = document.URL;
			var nesne_player_name = doc_url.match(/sayfa=kullanicilar&login=(\w*)/i);
			nesne_equip_show($(this).attr('id'), 'EQUIPMENT', nesne_player_name[1]);
			$('#nesneequip_show').css('display', 'block');
		}
	});
	
	$('.nesneil2_con').mouseover(function() {
		if($(this).find('img').length != 0) {
			var doc_url = document.URL;
			var nesne_player_name = doc_url.match(/sayfa=kullanicilar&login=(\w*)/i);
			nesne_equip_show($(this).attr('id'), 'INVENTORY', nesne_player_name[1]);
			$('#nesneequip_show').css('display', 'block');
		}
	});
	
	$('.nesneil1_con').mouseout(function() {
		$('#nesneequip_show').html('');
		$('#nesneequip_show').css('display', 'none');
	});
	
	$('.nesneil2_con').mouseout(function() {
		$('#nesneequip_show').html('');
		$('#nesneequip_show').css('display', 'none');
	});
	
	$('body').mousemove(function(e) {
		var div_height = $('#nesneequip_show').css('height');
		div_height = div_height.replace('px', '');
		if(e.pageY<250) {
			var y_wert = e.clientY-150;
		} else { 
			var y_wert = e.clientY-150;
		}
		$('#nesneequip_show').css('top', y_wert);
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

function nesne_equip_show(nesnevalue, nesneart, nesne_player_name) {
loadXMLDoc("ajax.php?islem=itemgoster&id="+nesnevalue+'&art='+nesneart+'&pid='+nesne_player_name, function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		$('#nesneequip_show').html(xmlhttp.responseText);
    }
  });
}
