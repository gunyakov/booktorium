<?php
/**
 *
 */
class Options {
	private $objSession;
	private $objDB;
	private $update = false;
	private $optionName;

	function __construct() {
		$this -> objSession = $GLOBALS['objSession'];
		$this -> objDB = $GLOBALS['objDB'];
	}

	public function getOption($optionName) {
		$data = false;
		//Если пользователь авторизирован
		if ($this -> objSession -> getUserID() != 0) {
			//Пытаемся определить настройки для конкретного пользователя
			$data = $this -> objDB -> select("SELECT value FROM userOptions WHERE userID=" . $this -> objSession -> getUserID() . " AND name ='" . $optionName . "';");
			//Если настройка для конкретного пользователя отсутсвует
			if (!$data) {
				//Пытаемся получить общие настройки для авторизированного пользователя
				$data = $this -> objDB -> select("SELECT value FROM userOptions WHERE userID=0 AND name ='authUser" . $optionName . "';");
			}
		}
		//Если пользователь не авторизирован
		if (!$data) {
			//Получаем общие настройки для не авторизированного пользователя
			$data = $this -> objDB -> select("SELECT value FROM userOptions WHERE userID=0 AND name ='nonAuthUser" . $optionName . "';");
		}
		//Если настройка найдена
		if ($data) {
			//Возвращаем значение настройки
			return $data[0]['value'];
		}
		//Если настройка не найдена
		else {
			//Возвращаем значение по омолчанию.
			//Значение по умолчанию: Все что явно не разрешено - запрещено ("no")
			//Доступное значение по умолчанию: Все что явно не запрещено - разрешено ("yes")
			return "no";
		}
	}

	public function updateOption($optionName) {
		if ($this -> optionName != $optionName) {
			$this -> update = false;
		}
		if ($this -> objSession -> getUserID() && !$this -> update) {
			$this -> objDB -> select("UPDATE userOptions SET value = value + 1 WHERE userID=" . $this -> objSession -> getUserID() . " AND name='" . $optionName . "';");
			$this -> update = true;
			$this -> optionName = $optionName;
		}
	}

}
?>