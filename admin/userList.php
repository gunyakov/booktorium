<?php
//Первоначальная инициализация
require_once "initd.php";
//Подключение дополнительных модулей
require_once "extra/readValue.php";
//Если получен идентефикатор пользователя
if (readValueNum("id")) {
	//Проверяем наличие записи в БД
	$data = $objDB -> select("SELECT * FROM user WHERE ID=" . readValue("id") . ";");
	//Если пользователь есть в БД
	if ($data) {
		//Переключаем события
		switch(readValue("action")) {
			//----------------------------------------------------------------------------------------------------
			//Если событие: "Обновить данные об пользователе"
			//----------------------------------------------------------------------------------------------------
			case "updateUserInfo" :
				$arrUser = Array();
				$error = "";
				foreach ($data[0] as $key => $val) {
					if ($key != "ID" && $key != "passw" && $key != "ip") {
						if (readValue($key)) {
							$arrUser[$key] = readValue($key);
						} else {
							$error .= "<li>You no enter " . $key;
						}
					}
				}

				if (readValue("passw")) {
					$arrUser['passw'] = md5(readValue("passw"));
				}

				if (empty($error)) {
					if ($objDB -> update("user", $arrUser, Array("ID" => readValue("id")))) {
						$objTheme -> success("{LANG_UPDATE_TRUE}");
					} else {
						$objTheme -> error("{LANG_UPDATE_FALSE}");
					}
				} else {
					$objTheme -> error($error);
				}
				break;
			//----------------------------------------------------------------------------------------------------
			//Если событие: "Удалить пользователя"
			//----------------------------------------------------------------------------------------------------
			case "delUser" :
				if ($handle = @opendir($objUser -> getFolder(readValue("id")))) {
					while (false !== ($file = readdir($handle))) {
						if ($file != "." && $file != "..") {
							@unlink($objUser -> getFolder(readValue("id")) . $file);
						}
					}
					@rmdir($objUser -> getFolder(readValue("id")) . "trumbnail");
					closedir($handle);
					@rmdir($objUser -> getFolder(readValue("id")));
				}
				if ($objDB -> delete("user", Array("ID" => readValue("id")))) {
					$objDB -> delete("userLinks", Array("userID" => readValue("id")));
					$objDB -> delete("userOptions", Array("userID" => readValue('id')));
					$objDB -> delete("userSession", Array("userID" => readValue("id")));
					$objTheme -> success("{LANG_DEL_TRUE}");
				} else {
					$objTheme -> error("{LANG_DEL_FALSE}");
				}
				break;
			//----------------------------------------------------------------------------------------------------
			//Если событие не определенно
			//----------------------------------------------------------------------------------------------------
			default :
				//Выводим форму для редактирования данных пользователя
				$objTheme -> define(Array("MAIN_CONTENT" => "userList.tpl"));
				$objTheme -> assign($data[0]);
		}
	} else {
		$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
	}

} else {
	$data = $objDB -> select("SELECT * FROM user ORDER BY dateRegistration DESC;");
	if ($data) {
		$objTheme -> define(Array("MAIN_CONTENT" => "table.tpl", "TH_CONTENT" => "thUserList.tpl"));
		$tbodyStr = '';
		foreach ($data as $key => $val) {
			$tbodyStr .= $objTheme -> addDynamic("trUserList.tpl", $val);
		}
		$objTheme -> assign(Array("TABLE_TITLE" => "{LANG_USER_LIST_TITLE}", "TBODY_CONTENT" => $tbodyStr));
	} else {
		$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
	}
}

require_once "end.php";
?>
