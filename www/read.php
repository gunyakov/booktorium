<?php
//-------------------------------------------------------------------------------------------------------------------------
// Скрипт: вывод страниц книги в браузер в зависимости от формата исходного файла.
//-------------------------------------------------------------------------------------------------------------------------
// Version 		  : 2.0 b
// Released		  : 28-feb-2013
// Last Modified          : 09-jun-2014
// Author		  : O.G <http://o-g.promodj.ru>
//-------------------------------------------------------------------------------------------------------------------------
// Лицензия GPL v2
//-------------------------------------------------------------------------------------------------------------------------
// Пример работы скрипта http://demo.dub-project.ru
//-------------------------------------------------------------------------------------------------------------------------
// Для любых пожеланий или баг отчетах пишите мне : og@dub-project.ru
//-------------------------------------------------------------------------------------------------------------------------
//$mode = "image";
require_once "initd.php";

require_once "extra/readValue.php";
require_once "extra/getString.php";
$objTheme -> assign(Array("TAG_CLOUD" => "", "CATEGORY_TREE" => "", "MENU" => "", "SORT_OPTIONS" => "", "TITLE" => "{nameTitle}, {LANG_PAGE} {NUMPAGE_CURRENT} из {pages}"));
//------------------------------------------------------------------------------------------------------------------------
//Если пользователю разрешено читать книгу онлайн
//------------------------------------------------------------------------------------------------------------------------
if ($objOptions -> getOption("BookRead") == "yes") {
	//Если принятый идентефикатор книги имеет цифровой формат
	if (readValueNum("id")) {
		//Сохраняем идентефикатор
		$bookID = readValue("id");
		//Проверяем наличие записи в базе об книге
		$bookData = $objDB -> select("SELECT * FROM booksList WHERE ID = '" . $bookID . "';");
		//Если запись об книге существует
		if ($bookData && @$bookData[0]['approved'] == 'yes') {
			//Получаем данные об книге
			$bookData = $bookData[0];
			//Запрашиваем список файлов к книге
			$fileData = $objDB -> select("SELECT * FROM booksFileList WHERE bookID = '" . $bookID . "' AND storage > 0;");
			//Если список файлов существует
			if ($fileData) {
				//Получаем режим чтения файла
				$mode = readValue("mode");
				if($mode != "image" && $mode != "text") {
					$mode = "image";
				}
				//--------------------------------------------------------------------------------------------------------
				//Файловые манипуляции
				//--------------------------------------------------------------------------------------------------------
				//Создаем переменную для хранения информации об текущем файле
				$currentFile = false;
				//Создаем строку, для создания html списка файлов
				$fileList = "";
				//Проходим по списку файлов
				foreach ($fileData as $key => $val) {
					//Если в списке есть файл, который пользователь пытается прочитать
					if ($val["ID"] == readValue("file")) {
						//Сохраняем информацию об нем.
						$currentFile = $val;
					}
					//Формируем html список файлов
					$fileList .= $objTheme -> addDynamic("option.tpl", Array("value" => $val['ID'], "name" => getString($val['fileName'])));
				}
				//Выводим список файлов в шаблон
				$objTheme -> assign(Array("READ_FILE_CONTENT" => $fileList));
				//Если текущий файл для чтения не установлен
				if (!$currentFile) {
					//Устанавливаем текущий файл по умолчанию
					$currentFile = $fileData[0];
				}
				//Извлекаем из данных полный путь к файлу
				$fileName = FILES_STORAGE . $currentFile['storage'] . "/" . $currentFile['fileName'];
				//--------------------------------------------------------------------------------------------------------
				//Если файл присутсвует на диске
				//--------------------------------------------------------------------------------------------------------
				if (is_file($fileName)) {
					//----------------------------------------------------------------------------------------------------
					//Устанавливаем некоторые опции вывода шаблона
					//----------------------------------------------------------------------------------------------------
					$objTheme -> define(Array("MAIN_CONTENT" => "readItem.tpl"));
					$objTheme -> define(Array("MENU" => "menuRead.tpl"));
					//----------------------------------------------------------------------------------------------------
					//Получение текущего номера страницы и проверка коректности данных
					//----------------------------------------------------------------------------------------------------
					//Если принятый номер текущей страницы цифровой
					if (readValueNum("page")) {
						//Сохраняем его в переменной
						$currentPage = readValue("page");
					}
					//Если принятый номер текущей страницы не цифровой либо отсутсвует
					else {
						//Устанавливаем текущий номер страницы по умолчанию
						$currentPage = 1;
					}
					//Если текущий номер страницы меньше 1
					if ($currentPage < 1) {
						//Устанавливаем текущий номер страницы по умолчанию
						$currentPage = 1;
					}
					//-------------------------------------------------------------------------------------------------------------
					//Если модуль для чтения такого формата существует
					//-------------------------------------------------------------------------------------------------------------
					if (is_file("./formats/" . $currentFile['fileFormat'] . ".php")) {
						//Выполняем код модуля для данного формата
						require_once "./formats/" . $currentFile['fileFormat'] . ".php";
					}
					//Если код модуля для данного формата книги не существует
					else {
						//Выводим сообщение об этом
						$objTheme -> warning("{LANG_FORMAT_NO_READ}");
						$objTheme -> assign(Array("TITLE" => "{LANG_FORMAT_NO_READ}"));
					}
					//----------------------------------------------------------------------------------------------------
					//Проверка текущего номера страницы на вхождение в диапазон общего количества страниц книги
					//----------------------------------------------------------------------------------------------------
					//Если текущий номер страници больше количества страниц в файле
					if ($currentPage > $totalPages) {
						//Устанавливаем текущий номер страницы в максимально возможный
						$currentPage = $totalPages;
					}
					//---------------------------------------------------------------------------------------------------------
					//Формирование списка ссылок на страницы книги
					//---------------------------------------------------------------------------------------------------------
					//Если общее количество страниц больше еденицы
					if ($totalPages > 1) {
						//Выводим шаблон списка страниц
						$objTheme -> define(Array("PAGINATION_CONTENT" => "pagination.tpl"));
						//Сбрасываем список ссылок на страницы
						$pagList = "";
						//Устанавливаем текущюю ссылку на даную страницу
						$pagLink = "read.php?mode={MODE}&id={ID}&file={FILE_ID}&page=";
						//Если текущая страница больше еденицы
						if ($currentPage > 1) {
							//Выводим ссылку на предыдущюю страницу
							$pagList .= $objTheme -> addDynamic("paginationPrev.tpl", Array("link" => $pagLink . ($currentPage - 1)));
						}
						//Проходимся по страница +- 4 страницы
						for ($a = $currentPage - 4; $a <= $currentPage + 4; $a++) {
							if ($a > 0 && $a <= $totalPages) {
								if ($a == $currentPage) {
									$pagList .= $objTheme -> addDynamic("paginationActive.tpl", Array("PAGE_NUMBER" => $a, "link" => $pagLink . $a));
								} else {
									$pagList .= $objTheme -> addDynamic("paginationItem.tpl", Array("PAGE_NUMBER" => $a, "link" => $pagLink . $a));
								}
							}
						}
						//Если текущая страница меньше общего количества страниц
						if ($currentPage < $totalPages) {
							//Выводим ссылку на следующую страницу
							$pagList .= $objTheme -> addDynamic("paginationNext.tpl", Array("link" => $pagLink . ($currentPage + 1)));
						}
						//Выводим список страниц
						$objTheme -> assign(Array("PAGINATION_LIST" => $pagList));
					}
					//Если общее количество страниц книги меньше еденицы
					else {
						//Удаляем список страниц из шаблона
						$objTheme -> assign(Array("PAGINATION_CONTENT" => ""));
					}
					//----------------------------------------------------------------------------------------------------
					//Формирование дополнительного меню
					//----------------------------------------------------------------------------------------------------
					//Устанавливаем начальное значение екстра меню
					$extraMenu = "";
					switch($mode) {
						case "image" :
							//Создаем екстра меню
							if ($objOptions -> getOption("ReadText") == "yes" && !Limits("ReadText")) {
								$extraMenu .= $objTheme -> addDynamic("menuItem.tpl", Array("name" => "{LANG_READ_TEXT}", "link" => "read.php?mode=text&id=" . $bookID . "&page=" . $currentPage . "&file=" . $currentFile["ID"]));
							}
							break;
						case "text" :
							if (!Limits("ReadImage")) {
								$extraMenu .= $objTheme -> addDynamic("menuItem.tpl", Array("name" => "{LANG_READ_IMAGE}", "link" => "read.php?mode=image&id=" . $bookID . "&page=" . $currentPage . "&file=" . $currentFile['ID']));
							}
							break;
					}
					//Если нет ограничения по загрузке TIFF
					if (!Limits("GetFullTIFF")) {
						//Если разрешено получать полноразмерный TIFF
						if ($objOptions -> getOption("GetFullTIFF") == "yes") {
							//Формируем екстра меню
							$extraMenu .= $objTheme -> addDynamic("menuItem.tpl", Array("name" => "{LANG_TIFF_GET}", "link" => "getTiff.php?id=" . $bookID . "&page=" . $currentPage . "&file=" . $currentFile['ID']));
						}
					}
					//Если екстра меню не пусто
					if (!empty($extraMenu)) {
						//Выводим екстра меню в браузер
						$extraMenu = $objTheme -> addDynamic("menu.tpl", Array("MENU_NAME" => "{LANG_MORE}", "MENU_CONTENT" => $extraMenu));
						$objTheme -> assign(Array("TAG_CLOUD" => $extraMenu));
					} else {
						$objTheme -> assign(Array("TAG_CLOUD" => ""));
					}
					//-------------------------------------------------------------------------------------------
					//Формирование меню закладок
					//-------------------------------------------------------------------------------------------
					//Если пользователь авторизирован
					if ($objSession -> getLogin()) {
						$objTheme->define(Array("SORT_OPTIONS" => "menu.tpl"));
						//Создания первоначального пункта для возможности добавить закладку на текущюю страницу
						$links = $objTheme -> addDynamic("menuItem.tpl", Array("link" => "linksAdd.php?id=" . $bookID . "&page=" . $currentPage . "&file=" . $currentFile['ID'], "name" => "{LANG_LINKS_ADD}"));
						//Выбор списка закладок текущей книги и текущего файла
						$data = $objDB -> select("SELECT * FROM userLinks WHERE userID = " . $objSession -> getUserID() . " AND bookID = " . $bookID . " AND fileID = " . $currentFile["ID"] . " ORDER BY pageNum ASC;");
						//Если список закладок существует
						if ($data) {
							//Проходимся по списку закладок
							foreach ($data as $key => $val) {
								//Если закладка ссылается на текущюю страницу
								if ($val['pageNum'] == $currentPage) {
									//Выводим ее как подсвеченную
									$links .= $objTheme -> addDynamic("menuItemActive.tpl", Array("link" => "read.php?mode=" . $mode . "&id=" . $bookID . "&page=" . $val['pageNum'] . "&file=" . $val['fileID'], "name" => "{LANG_PAGE} " . $val['pageNum']));
								}
								//Если закладка ссылается на не текущюю страницу
								else {
									//Выводим обычную ссылку
									$links .= $objTheme -> addDynamic("menuItem.tpl", Array("link" => "read.php?mode=" . $mode . "&id=" . $bookID . "&page=" . $val['pageNum'] . "&file=" . $val['fileID'], "name" => "{LANG_PAGE} " . $val['pageNum']));
								}
							}
						}
						//Выводим список закладок в браузер
						$objTheme -> assign(Array("MENU_CONTENT" => $links, "MENU_NAME" => "{LANG_LINKS}"));
					}
					//Если пользователь не авторизирован
					else {
						//Убираем из вывода шаблона пункт "Закладки"
						$objTheme -> assign(Array("SORT_OPTIONS" => ""));
					}
					//Выводим некоторые данные в шаблон
					$currentFile['fileName'] = getString($currentFile['fileName']);
					$objTheme -> assign($currentFile);
					$objTheme -> assign(Array("MENU_READ_NAME" => "{LANG_GO_TO_FILE}", "NUMPAGE_CURRENT" => $currentPage));
					$objTheme -> assign(Array("ID" => $bookID, "name" => getString($bookData['name'], READ_PAGE_BOOK_NAME_LENGTH), "nameTitle" => $bookData['name'], "FILE_ID" => $currentFile['ID'], "MODE" => $mode, "READ_CONTENT" => $readContent));
				}
				//------------------------------------------------------------------------------------------------
				//Если файл отсутсвует на диске
				//------------------------------------------------------------------------------------------------
				else {
					//Выводим сообщение об этом
					$objTheme -> warning("{LANG_ERROR_READ_FILE}");
					$objTheme -> assign(Array("TITLE" => "{LANG_ERROR_READ_FILE}"));
				}

			}
			//Если списка файлов нет
			else {
				//Выводим сообщение об этом
				$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
				$objTheme -> assign(Array("TITLE" => "{LANG_HAVE_NO_ELEMENT}"));
			}
		}
		//Если запись об книге отсутсвует
		else {
			//Выводим сообщение об этом
			$objTheme -> warning("{LANG_ERROR_READ_CONTENT}");
			$objTheme -> assign(Array("TITLE" => "{LANG_ERROR_READ_CONTENT}"));
		}
	} else {
		$objTheme -> warning("{LANG_ERROR_READ_FORM}");
		$objTheme -> assign(Array("TITLE" => "{LANG_ERROR_READ_FORM}"));
	}
}
//----------------------------------------------------------------------------------------------------------------
//Если пользователю запрещено читать книгу онлайн
//----------------------------------------------------------------------------------------------------------------
else {
	//Выводим сообщение об этом
	$objTheme -> warning("{LANG_PAGE_NO_SHOW}");
	$objTheme -> assign(Array("TITLE" => "{LANG_PAGE_NO_SHOW}"));
}
//----------------------------------------------------------------------------------------------------------------
//Вывод шаблона и очистка памяти
//----------------------------------------------------------------------------------------------------------------
require_once "end.php";
