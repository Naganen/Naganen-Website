/*MT2 LookUP*/

$(document).ready(function() {
	
	$('.il1_con').mouseover(function() {
		if($(this).find('img').length != 0) {
			var doc_url = document.URL;
			var player_name = doc_url.match(/sayfa=karakterler&id=(\w*)/i);
			equip_show($(this).attr('id'), 'EQUIPMENT', player_name[1]);
			$('#equip_show').css('display', 'block');
		}
	});
	
	$('.il2_con').mouseover(function() {
		if($(this).find('img').length != 0) {
			var doc_url = document.URL;
			var player_name = doc_url.match(/sayfa=karakterler&id=(\w*)/i);
			equip_show($(this).attr('id'), 'INVENTORY', player_name[1]);
			$('#equip_show').css('display', 'block');
		}
	});
	
	$('.il1_con').mouseout(function() {
		$('#equip_show').html('');
		$('#equip_show').css('display', 'none');
	});
	
	$('.il2_con').mouseout(function() {
		$('#equip_show').html('');
		$('#equip_show').css('display', 'none');
	});
	
	$('body').mousemove(function(e) {
		var div_height = $('#equip_show').css('height');
		div_height = div_height.replace('px', '');
		if(e.pageY<250) {
			var y_wert = e.clientY-150;
		} else { 
			var y_wert = e.clientY-150;
		}
		$('#equip_show').css('margin-top', y_wert);
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

function equip_show(value, art, player_name) {
loadXMLDoc("ajax.php?islem=envanter_goster&id="+value+'&art='+art+'&pid='+player_name, function() {
  if (xmlhttp.readyState==4 && xmlhttp.status==200) {
		$('#equip_show').html(xmlhttp.responseText);
    }
  });
}
