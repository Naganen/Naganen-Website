<?php

function bakiye_sistem_yukle()
{

global $db, $odb;

@$kontrol = $odb->query("SELECT bakiye FROM account LIMIT 1");

if(!$kontrol)
{
	
$ekle = $odb->query("ALTER TABLE `account` ADD `bakiye` INT NOT NULL");

if($ekle)
{
	
return 'Sistem başarıyla eklendi';
	
}
else
{
	
return 'Sistem Eklenemedi';
	
}
	
}
else
{
	
return 'Sistem Zaten Var';

}

}

?>
