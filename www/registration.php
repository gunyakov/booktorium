<?php
//-------------------------------------------------------------------------------------------------------------------------
// Скрипт: регистрация пользователя на сайте.
//-------------------------------------------------------------------------------------------------------------------------
// Version 		  : 2.0 b
// Released		  : 28-feb-2013
// Last Modified  : 30-sep-2013
// Author		  : O.G <http://o-g.promodj.ru>
//-------------------------------------------------------------------------------------------------------------------------
// Лицензия GPL v2
//-------------------------------------------------------------------------------------------------------------------------
// Пример работы скрипта http://demo.dub-project.ru
//-------------------------------------------------------------------------------------------------------------------------
// Для любых пожеланий или баг отчетах пишите мне : og@dub-project.ru
//-------------------------------------------------------------------------------------------------------------------------

//Первоначальная инициализация
require_once "initd.php";
//Сброс отображения некоторых элементов шаблона
$objTheme -> assign(Array("TAG_CLOUD" => "", "SORT_OPTIONS" => "", "TITLE" => "{LANG_TITLE_REGISTRATION_FORM}"));
//--------------------------------------------------------------------------------------------------
//Если сервер получил данные регистрационной формы
if (@$_POST['action'] == "post") {
	//Сброс отображения некоторых элементов шаблона
	$objTheme -> assign(Array("MENU" => "", "PROMO_VIEW" => ""));
	//Если антиБот код введен верно
	if ($objAntiBot -> getCode(readValueNum("antiBot"))) {
		//Инициализация масива
		$data = Array();
		//Чтение полученых данных в масив
		$data['name'] = readValue("name");
		$data['email'] = readValue("email");
		$data['passw'] = md5(readValue("passw"));
		//--------------------------------------------------------------------------------------------------
		//Установка некоторых важных данных по умолчанию
		$data['amount'] = Amount("Reg");
		$data['dateRegistration'] = "NOW()";
		$data['ip'] = $_SERVER["REMOTE_ADDR"];
		//--------------------------------------------------------------------------------------------------
		//Сброс списка ошибок
		$error = '';
		//--------------------------------------------------------------------------------------------------
		//Если имя пользователя пустое
		if (empty($data['name'])) {
			//Сообщаем об ошибке
			$error .= "{LANG_ERROR_READ_FORM}<br>";
		}
		//Если пользователь ввел имя не латиницей
		if (!preg_match(USER_NAME_PREGMATCH, $data['name'])) {
			//Сообщаем об ошибке
			$error .= "{LANG_USE_ONLY_LATIN}<br>";
		}
		//--------------------------------------------------------------------------------------------------
		//Если пользователь не ввел пароль
		if (empty($data['passw'])) {
			//Сообщаем об ошибке
			$error .= "<li>No pass.";
		}
		//Если пользователь ввел пароль
		else {
			//Если введенные пароли не совпадают
			if ($data['passw'] != md5(readValue("passw2"))) {
				//Сообщаем об ошибке
				$error .= "{LANG_ERROR_READ_FORM}<br>";
			}
		}
		//--------------------------------------------------------------------------------------------------
		//Если пользователь ввел е-мейл
		if (!empty($data['email'])) {
			//Если формат введеного е-мейл не совпадает с шаблоном
			if (!preg_match("/[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,3}/i", $data['email'])) {
				//Сообщаем об ошибке
				$error .= "{LANG_USE_FORMAT_EMAIL}<br>";
			}
		}
		//Если пользователь не ввел е-мейл
		else {
			//Сообщаем об ошибке
			$error .= "{LANG_ERROR_READ_FORM}<br>";
		}
		//--------------------------------------------------------------------------------------------------
		//Вырезаем ненужные символы из имени и е-мейл
		$data['name'] = htmlspecialchars(stripslashes($data['name']));
		$data['email'] = htmlspecialchars(stripslashes($data['email']));
		//--------------------------------------------------------------------------------------------------
		//Если список ошибок пуст
		if (empty($error)) {
			//Выбираем из базы информацию об пользователе
			$dataUser = $objDB -> select("SELECT * FROM user WHERE name LIKE '" . $data['name'] . "' OR email LIKE '" . $data['email'] . "';");
			//Если пользователь с таким именем или е-мейл уже есть в базе
			if (!empty($dataUser)) {
				//Сообщаем об ошибке
				$error .= "{LANG_LOGIN_NO_FREE}<br>";
			}
		}
		//--------------------------------------------------------------------------------------------------
		//Если мы прошли все проверки и список ошибок пуст
		if (empty($error)) {
			//Если запись в базу добавленна успешно
			if ($objDB -> insert("user", $data)) {
				//Выводим в браузер сообщение об успехе
				$objTheme -> success("{LANG_ADD_TRUE}");
				//Получаем ID пользователя в базе
				$data = $objDB -> select("SELECT ID, email FROM user WHERE name LIKE '" . $data['name'] . "' AND passw LIKE '" . $data['passw'] . "';");
				//Если ID успешно получен
				if ($data) {
					//Выбираем ID из массива данных
					$userID = $data[0]['ID'];
					//Вставляем в базу начальные счетчики пользователя
					$objDB -> insert("userOptions", Array("userID" => $userID, "value" => 0, "name" => "CurrentCountCommentsPost"));
					$objDB -> insert("userOptions", Array("userID" => $userID, "value" => 0, "name" => "CurrentCountReadImage"));
					$objDB -> insert("userOptions", Array("userID" => $userID, "value" => 0, "name" => "CurrentCountReadText"));
					$objDB -> insert("userOptions", Array("userID" => $userID, "value" => 0, "name" => "CurrentCountGetFiles"));
					$objDB -> insert("userOptions", Array("userID" => $userID, "value" => 0, "name" => "CurrentCountLogin"));
					$objDB -> insert("userOptions", Array("userID" => $userID, "value" => 0, "name" => "CurrentCountGetFullTIFF"));
					$objDB -> insert("userOptions", Array("userID" => $userID, "value" => 0, "name" => "CurrentCountSearch"));
					//Отсылаем письмо на почту пользователя об регистрации
					$hash = md5(time().$data[0]['email']);
					$message = $objTheme -> addDynamic("regEmail.tpl", Array("HASH" => $hash));
					$objDB -> insert("confirmEmail", array("hash" => $hash, "userID" => $userID, "datePut" => "NOW()"));

					require_once "class/class.EMail.php";
					$objEmail = new Email();

					$objEmail -> add_html(Array("EMAIL_TITLE" => $_LANG['REG_EMAIL_TITLE'], "EMAIL_CONTENT" => $message));
					$objEmail -> send(0, $data[0]['email'], $_LANG['REG_EMAIL_SUBJECT']);
				}
			}
			//Если запись в базу не добавленна
			else {
				//Выводим в браузер сообщение об ошибке
				$objTheme -> error("{LANG_ADD_FALSE}");
				echo($objDB->getError());
			}
		}
		//Если мы прошли все проверки и список ошибок не пуст
		else {
			//Выводим в браузер список ошибок
			$objTheme -> error($error);
		}
	}
	//Если антиБот код введен не верно
	else {
		$objTheme -> error("{LANG_ANTI_BOT_NOT_CORRECT}");
	}
}
//--------------------------------------------------------------------------------------------------
//Если сервер не получил данные регистрационной формы
else {
	//Выводим в браузер регистрационную форму и антиБот изображение
	$objTheme -> define(Array("MAIN_CONTENT" => "registrationForm.tpl", "MENU" => "antiBot.tpl"));
}
//--------------------------------------------------------------------------------------------------
//Очистка мусора, памяти и финальная компоновка шаблона
require_once "end.php";
?>
