<?php
/***************************************************************************************************
 * Функция: Преобразование имени файла в удобное для хранения
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
//Базовая функция
//---------------------------------------------------------------------------------------------------------------
function convertFileName($fileName) {
	$fileName = str_replace(" ", "_", $fileName);
	$fileName = str_replace("-", "_", $fileName);
	return $fileName;
}
