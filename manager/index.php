<?php
/***************************************************************************************************
 * Скрипт: страница по умолчанию
 ***************************************************************************************************
 * Version 		  : 1.0 stable
 * Released		  : 20-feb-2013
 * Last Modified  : 20-feb-2013
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
//Вывод шаблона в браузер
$objTheme -> define(Array("MAIN_CONTENT" => "index.tpl"));
//---------------------------------------------------------------------------------------------------------------
//Вывод шаблона в браузер и очистка памяти
//---------------------------------------------------------------------------------------------------------------
require_once "end.php";
?>
