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

	public function getOptionByUser($optionName, $userID = 0) {
		$data = false;
		//Если пользователь авторизирован
		if ($userID != 0) {
			//Пытаемся определить настройки для конкретного пользователя
			$data = $this -> objDB -> select("SELECT value FROM userOptions WHERE userID = " . $userID . " AND name LIKE '" . $optionName . "';");
			//Если настройка для конкретного пользователя отсутсвует
			if (!$data) {
				//Пытаемся получить общие настройки для авторизированного пользователя
				$data = $this -> objDB -> select("SELECT value FROM userOptions WHERE userID = 0 AND name LIKE 'authUser" . $optionName . "';");
			}
		}
		//Если пользователь не авторизирован
		if (!$data) {
			//Получаем общие настройки для не авторизированного пользователя
			$data = $this -> objDB -> select("SELECT value FROM userOptions WHERE userID = 0 AND name LIKE 'nonAuthUser" . $optionName . "';");
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

	public function getOption($optionName) {
		return $this -> getOptionByUser($optioName, $this -> objSession -> getUserID());

	}

	public function updateOption($name, $value = 0, $userID = 0) {
		$update = false;
		if ($userID > 0) {
			$data = $this -> objDB -> select("SELECT ID FROM user WHERE ID=" . $userID . ";");
			if ($data) {
				$data = $this -> objDB -> select("SELECT * FROM userOptions WHERE name LIKE '" . $name . "' AND userID = " . $userID . ";");
				if ($data) {
					//if ($data[0]['value'] == $value) {
					//	$this -> $objDB -> delete("userOptions", Array("userID" => $userID, "name" => $name));
					//} else {
						if($this -> objDB -> update("userOptions", Array("value" => $value), Array("userID" => $userID, "name" => $name))) {
							$update = true;
						}
					//}
				} else {
					if($this -> objDB -> insert("userOptions", Array("value" => $value, "userID" => $userID, "name" => $name))) {
						$update = true;
					}
				}
			}
		}
		return $update;

	}
}
?>