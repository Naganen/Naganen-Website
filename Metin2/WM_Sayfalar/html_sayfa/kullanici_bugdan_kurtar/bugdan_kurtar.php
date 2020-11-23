<?php if(!defined("WM_HTML_KONTROL")){ die("Buraya giriş izniniz yoktur."); exit;} ?>

<div class="alert alert-info"><b>BİLGİ !</b> Kurtar dedikten sonra , 15 dakka boyunca kurtarma işlemi yaptığınız karaktere giriş yapmayınız.</i></div>

<form action="" method="post">

<input type="hidden" name="kurtar_token" value="<?=$ayar->sessionid;?>">

<table border="0" align="center" width="100%">

<tbody>
<select name="bugdan_kurtarilcak" class="select">

<?php 
$karakterler = $odb->prepare("SELECT name FROM player.player WHERE account_id = ?");
$karakterler->execute(array($_SESSION[$vt->a("isim")."userid"]));
if($karakterler->rowCount()){
foreach($karakterler as $karakter)
{
	
echo '<option value="'.$karakter["name"].'">'.$karakter["name"].'</option>';

}

}
else
{
	
echo '<option value="1"> Karakter Bulunamadı</option>';
	
}
?>
</select>

    <tr>
      <td align="center">
	  <br>
	  <input type="submit" name="bugdan_kurtar" value="Kurtar"></td>
    </tr>

</tbody>
</table>
</form>
