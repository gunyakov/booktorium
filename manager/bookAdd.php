<?php
/***************************************************************************************************
 * Скрипт: добавление книги в БД
 ***************************************************************************************************
 * Version 		  : 1.0 stable
 * Released		  : 28-feb-2013
 * Last Modified  : 28-feb-2013
 * Author		  : O.G <http://vk.com/nu_rave_og>
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
require_once "extra/sortOptions.php";
//---------------------------------------------------------------------------------------------------------------
//Если пользователю разрешено добавлять книги
//---------------------------------------------------------------------------------------------------------------
if ($objOptions -> getOption("BookAdd") == "yes") {
	//Если переданны данные формы
	if (readValue("action") == "addBook") {
		//Получаем данные из формы
		$arrBook = Array();
		$arrBook['name'] = readValue("name");
		$arrBook['descr'] = readValue("descr");
		$arrBook['smallDescr'] = readValue("smallDescr");
		$arrBook['year'] = readValueNum("year");
		if (is_array($arrFullOptions)) {
			foreach ($arrFullOptions as $key => $val) {
				if (readValue($key)) {
					$arrBook[$key] = readValue($key);
				}
			}
		}
		$arrBook['datePut'] = "NOW()";
		$arrBook['userID'] = $objSession -> getUserID();
		//Сбрасываем список ошибок
		$error = "";
		//Проходим по всем данным формы
		foreach ($arrBook as $key => $val) {
			//Если данные не соответсвуют шаблону
			if (!checkValue($val, "simbols")) {
				//Формируем список ошибок
				$error .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_MISSING} " . $key));
			}
		}
		//Если год издания имеет не цифровой формат
		if (!checkValue($arrBook['year'], "numbers")) {
			//Формируем список ошибок
			$error .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_ERROR_READ_FORM}"));
		}
		//Если список ошибок пуст
		if (empty($error)) {
			//Если удалось добавить данные о книге в БД
			if ($objDB -> insert("booksList", $arrBook)) {
				//Выводим сообщение об этом
				$objTheme -> success("{LANG_ADD_TRUE}");
			}
			//Если не удалось добавить данные о книге в БД
			else {
				//Выводим сообщение об этом
				$objTheme -> error("{LANG_ADD_FALSE}");
			}
		}
		//Если список ошибок не пуст
		else {
			//Выводим список ошибок
			$objTheme -> warning($error);
		}
	}
	//Если данные формы не переданны
	else {
		//Выводим форму добавления книги
		$objTheme -> define(Array("MAIN_CONTENT" => "addBookForm.tpl"));
		if (is_array($arrFullOptions)) {
			//Формируем списки опций
			$extraBlocksContent = '';
			foreach ($arrFullOptions as $key => $val) {
				$strOptions = '';
				foreach ($val as $key2 => $val2) {
					if ($val2 == "yes") {
						$strOptions .= $objTheme -> addDynamic("option.tpl", Array("selected" => "selected", "label" => "{TXT_KEY_" . strtoupper($key2) . "}", "value" => $key2));
					} else {
						$strOptions .= $objTheme -> addDynamic("option.tpl", Array("selected" => "", "label" => "{TXT_KEY_" . strtoupper($key2) . "}", "value" => $key2));
					}
				}
				$extraBlocksContent .= $objTheme -> addDynamic("addBookFormBlock.tpl", Array("BLOCK_NAME" => "{TXT_KEY_" . strtoupper($key) . "}", "BLOCK_FIELD" => $key, "BLOCK_CONTENT" => $strOptions));
			}
			$objTheme -> assign(Array("EXTRA_BLOCKS_CONTENT" => $extraBlocksContent));
		} else {
			$objTheme -> assign(Array("EXTRA_BLOCKS_CONTENT" => ""));
		}
	}
}
//----------------------------------------------------------------------------------------------------------------
//Если пользователю запрещено добавлять книги в БД
//---------------------------------------------------------------------------------------------------------------
else {
	//Выводим сообщение об этом
	$objTheme -> warning("{LANG_ADD_PROHIBITED}");
}
//---------------------------------------------------------------------------------------------------------------
//Вывод шаблона в браузер и очистка памяти
//---------------------------------------------------------------------------------------------------------------
require_once "end.php";
?>
