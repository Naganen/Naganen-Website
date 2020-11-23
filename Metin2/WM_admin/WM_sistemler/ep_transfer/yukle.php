<?php

function eptransfer_sistem_yukle()
{

global $db, $odb;

@$kontrol = $db->query("SELECT id FROM eptransfer_log LIMIT 1");

@$kontrol2 = $odb->query("SELECT edurum,epass FROM account LIMIT 1");

@$kontrol3 = $odb->query("SELECT eptransfer FROM server LIMIT 1");

if(!$kontrol || !$kontrol2)
{
	
$ekle = $db->query("
CREATE TABLE `eptransfer_log` ( `id` INT NOT NULL AUTO_INCREMENT ,  `sid` INT NOT NULL ,  
`tur` INT NULL DEFAULT '1' ,  
`gonderen` VARCHAR(855) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL ,  
`alan` VARCHAR(855) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL ,  
`ep` INT NOT NULL ,  `tarih` VARCHAR(855) NOT NULL ,   
 PRIMARY KEY  (`id`)) ENGINE = InnoDB;");
 
$ekle = $odb->query("ALTER TABLE `account` ADD `edurum` INT NOT NULL DEFAULT '1', ADD `epass` VARCHAR(855) NOT NULL;");

$ekle = $db->query("ALTER TABLE `server` ADD `eptransfer` VARCHAR(11) NULL DEFAULT '1,1,1,1,1,1'");


return 'Sistem Kuruldu Kontrol Edin';
	
}
else
{
	
return 'Sistem Zaten Var';

}

}

?>
