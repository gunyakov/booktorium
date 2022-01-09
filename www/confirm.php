<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<?php
/**************************************************************************************************
* Скрипт: добавление обьявления в базу. Часть проекта "Южный город"
***************************************************************************************************
* Version 		: 1.0alpha
* Released		: 11-feb-2012
* Last Modified : 28-feb-2012
* Author		: O.G <oleg_gunyakov@mail.ru>
*
***************************************************************************************************
* Лицензия
***************************************************************************************************
* Все права защищены законом Украины и России об авторских правах.
* Организациям/лицам которые на базе данного скрипта будут предоставлять
* в небольших городах/селах/поселках услуги на некомерческой основе
* лицензия выдается бесплатно
* 
***************************************************************************************************
* Пример работы скрипта http://south-city.com.ua
***************************************************************************************************
* Для любых пожеланий или баг отчетах пишите мне : oleg_goodzon@mail.ru
***************************************************************************************************/
require_once "config.php";
require_once "class/class.DB.php";
$objDB = new DB();
$hash = @$_GET['hash_str'];
if($hash) {
	$hash = trim($hash);
	$hash = str_replace(" ", "", $hash);

	$data = $objDB->select("SELECT * FROM confirmEmail WHERE hash LIKE '".$hash."';");
	if($data) {		$data = $data[0];
		$objDB->update("user", array("emailConfirm" => "yes"), array("ID" => $data['userID']));
		$objDB->select("DELETE FROM confirmEmail WHERE ID=".$data['ID'].";");
		echo("<h2>Ваш e-mail успешно подтвержден.</h2>");
	}
	else {		echo("Ошибка хеш-строки");
	}
}
else {	echo("Ошибка хеш строки");
}
?>