<?php 
/**************************************************************************************************
 * Класс: Ведение лога проэкта для отслеживания багов и неправомерных дейсвиях пользователей. 
 * Часть проекта "Южный город"
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
class Log {
	private $objDB;

	public function __construct($objDB) {
		$this -> objDB = $objDB;
	}

	public function addString($string, $userID, $code = 0) {
		$name = $this -> objDB -> select("SELECT name FROM user WHERE ID=" . $userID . ";");
		
		if ($name) {
			$name = $name[0]['name'];
		} else {
			$name = "UNKNOWN";
		}
		
		$string = str_replace("{USER_NAME}", "<b>" . $name . "</b>", $string);

		$this -> objDB -> insert("logBook", array('code' => $code, 'msg' => $string, "userID" => $userID, "datePut" => "NOW()", "ip" => @$_SERVER["REMOTE_ADDR"], "userAgent" => @$_SERVER["HTTP_USER_AGENT"]));
	}

}
?>