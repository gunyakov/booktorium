<?php
/***************************************************************************************************
 * Скрипт: манипуляция сессией пользователя
 ***************************************************************************************************
 * Version 		  : 1.0 stable
 * Released		  : 24-feb-2013
 * Last Modified  : 24-feb-2013
 * Author		  : O.G <oleg_gunyakov@mail.ru>
 ***************************************************************************************************
 * Лицензия GPL v2
 ***************************************************************************************************
 * Пример работы скрипта http://t-library.org.ua
 ***************************************************************************************************
 * Для любых пожеланий или баг отчетах пишите мне : oleg_goodzon@mail.ru
 ***************************************************************************************************/
//---------------------------------------------------------------------------------------------------------------
//Первоначальная инициализация
//---------------------------------------------------------------------------------------------------------------
require_once "initd.php";
//---------------------------------------------------------------------------------------------------------------
//Подключение дополнительных модулей
//---------------------------------------------------------------------------------------------------------------
require_once "extra/readValue.php";
require_once "extra/checkValue.php";
//---------------------------------------------------------------------------------------------------------------
//Проверяем какое наступило событие
//---------------------------------------------------------------------------------------------------------------
switch(readValue("action")) {
	//------------------------------------------------------------------------------------------------------------
	//Если получено событие выхода пользователя
	//------------------------------------------------------------------------------------------------------------
	case "logout" :
		//Сбрасываем сессию
		$objSession -> Logout();
		//Вывод сообщения об выходе
		$objTheme -> success("{LANG_LOGIN_OUT}");
		break;
	//------------------------------------------------------------------------------------------------------------
	//Если получено событие входа пользователя
	//------------------------------------------------------------------------------------------------------------
	case "login" :
		//Читаем данные из формы
		$name = readValue("name");
		$passw = readValue("passw");
		//Если принятые данные соответсвуют заданному формату
		if (checkValue($name, "simbols") && checkValue($passw, "simbols")) {
			//Устанавливаем главный шаблон
			$objTheme -> defineMain("html.tpl");
			//Если сессия пользователя создана
			if ($objSession -> Login($name, $passw)) {
				//Выводим сообщение об этом
				$objTheme -> success("{LANG_LOGIN_TRUE}");
			}
			//Если сессия пользователя не создана
			else {
				//Выводим сообщение об этом
				$objTheme -> error("{LANG_LOGIN_FALSE}");
			}
		}
		//Если принятые данные не соответсвуют заданному формату
		else {
			//Выводим сообщение об этом
			$objTheme -> warning("{LANG_ERROR_READ_FORM}");
		}
		break;
	//---------------------------------------------------------------------------------------------------------------
	//Любое другое событие
	//---------------------------------------------------------------------------------------------------------------
	default :
		//Устанавливаем главный шаблон
		$objTheme -> defineMain("loginForm.tpl");
		break;
}
//---------------------------------------------------------------------------------------------------------------
//Вывод шаблона в браузер и очистка памяти
//---------------------------------------------------------------------------------------------------------------
require_once "end.php";
?>
