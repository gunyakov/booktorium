<?php
/***************************************************************************************************
 * Скрипт: добавление тикета в БД
 ***************************************************************************************************
 * Version 		  : 1.0 stable
 * Released		  : 26-feb-2013
 * Last Modified  : 26-feb-2013
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
//Если событие: "Добавить тикет"
if (readValue("action") == "addTiket") {
	//Если принятые данные соответсвуют шаблону
	if (checkValue(readValue("subject"), "simbols") && checkValue(readValue("message"), "simbols")) {
		//Если удалось добавить тикет в БД
		if ($objDB -> insert("tiket", Array("userID" => $objSession -> getUserID(), "subject" => readValue("subject"), "message" => readValue("message"), "datePut" => "NOW()"))) {
			//Выводим сообщение об этом
			$objTheme -> success("{LANG_ADD_TRUE}");
		}
		//Если не удалось добавить тикет в БД
		else {
			//Выводим сообщение об этом
			$objTheme -> error("{LANG_ADD_FALSE}");
		}
	}
	//Если принятые данные не соответсвуют шаблону
	else {
		//Выводим сообщение об этом
		$objTheme -> warning("{LANG_ERROR_READ_FORM}");
	}
}
//Если событие не определенно
else {
	//Выводим форму добавления тикета
	$objTheme -> define(Array("MAIN_CONTENT" => "tiket.tpl"));
}
//---------------------------------------------------------------------------------------------------------------
//Вывод шаблона в браузер и очистка памяти
//---------------------------------------------------------------------------------------------------------------
require_once "end.php";
?>