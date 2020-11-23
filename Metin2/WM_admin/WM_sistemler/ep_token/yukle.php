<?php

function eptoken_sistem_yukle()
{

global $db;

@$kontrol = $db->query("SELECT token FROM eptoken LIMIT 1");

@$kontrol2 = $db->query("SELECT eptoken FROM server LIMIT 1");

if(!$kontrol || !$kontrol2)
{
	
$ekle = $db->query("CREATE TABLE `eptoken` ( `id` INT NOT NULL AUTO_INCREMENT ,  `sid` INT NOT NULL ,  `token` VARCHAR(855) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL ,
 `tokenpass` VARCHAR(855) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL ,  
 `olusturan` VARCHAR(855) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL ,  
 `ep` INT NOT NULL  ,  
 `kullanan` VARCHAR(855) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL ,  
 `olusturma_tarih` VARCHAR(855) NOT NULL ,  `kullanma_tarih` VARCHAR(855) NOT NULL ,    
 PRIMARY KEY  (`id`)) ENGINE = InnoDB;");
 
$ekle = $db->query("ALTER TABLE `server` ADD `eptoken` VARCHAR(11) NULL DEFAULT '1,2,2'");


return 'Sistem Kuruldu Kontrol Edin';
	
}
else
{
	
return 'Sistem Zaten Var';

}

}

?>
