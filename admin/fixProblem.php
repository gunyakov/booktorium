<?php
/***************************************************************************************************
 * Скрипт: настройки
 ***************************************************************************************************
 * Version 		  : 1.0 b
 * Released		  : 29-feb-2013
 * Last Modified  : 29-feb-2013
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
//Сброс списка ошибок
$errorList = "";
//Сброс состояния исправления ошибок
$fixProblem = false;
//Переключаем событие
switch(readValue("action")) {
	//-----------------------------------------------------------------------------------------------------------
	//Если событие: "Наличие локальных файлов"
	//-----------------------------------------------------------------------------------------------------------
	case "fixFileInStorage" :
		//Устанавливаем состояние исправления ошибок
		$fixProblem = true;
		//Получаем список файлов из БД
		$data = $objDB -> select("SELECT * FROM booksFileList;");
		//Если список файлов получен
		if ($data) {
			//Проходим по списку
			foreach ($data as $key => $val) {
				//Если файл локальный
				if ($val["storage"] > 0) {
					//Если файл отсутсвует на диске
					if (!is_file(FILES_STORAGE . $val["storage"] . "/" . $val['fileName'])) {
						//Если удалось удалить запись об файле из БД
						if ($objDB -> delete("booksFileList", Array("ID" => $val["ID"]))) {
							//Выводим сообщение об этом
							$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_FILE_NO_PRESENT}, {LANG_FIXED_TRUE}"));
						} 
						//Если не удалось удалить запись об файле из БД
						else {
							//Выводим сообщение об этом
							$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_FILE_NO_PRESENT}, {LANG_FIXED_FALSE}"));
						}
					}
				}
			}
		} 
		//Если список файлов не получен
		else {
			//Выводим сообщение об этом
			$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_LIST_EMPTY}"));
		}
		break;
	//-----------------------------------------------------------------------------------------------------------
	//Если событие: "Наличие книг по ссылкам файлов"
	//-----------------------------------------------------------------------------------------------------------
	case "fixFileLink" :
		//Устанавливаем состояние исправления ошибок
		$fixProblem = true;
		//Получаем список файлов из БД
		$data = $objDB -> select("SELECT * FROM booksFileList;");
		//Если список файлов получен
		if ($data) {
			//Проходим по списку файлов
			foreach ($data as $key => $val) {
				//Получаем информацию об книге, привязаной к файлу
				$arrBook = $objDB -> select("SELECT * FROM booksList WHERE ID = " . $val['bookID'] . ";");
				//Если информация не полученна
				if (!$arrBook) {
					//Если удалось удалить запись из БД
					if ($objDB -> delete("booksFileList", Array("ID" => $val["ID"]))) {
						//Выводим сообщение об этом	
						$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_TRUE}"));
					} 
					//Если не удалось удалить запись из БД
					else {
						//Выводим сообщение об этом
						$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_FALSE}"));
					}
				}
			}
		} 
		//Если список файлов не получен
		else {
			//Выводим сообщение об этом
			$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_LIST_EMPTY}"));
		}
		break;
	//-----------------------------------------------------------------------------------------------------------
	//Если событие: "Локальные файлы в БД"
	//-----------------------------------------------------------------------------------------------------------
	case "fixFileInDB" :
		//Устанавливаем состояние исправления ошибок
		$fixProblem = true;
		//Запускаем цикл по хранилищам файлов
		for ($i = 1; $i <= MAX_FILES_STORAGE_COUNT; $i++) {
			//Если удалось открыть хранилище файлов для чтения
			if ($dir = @opendir(FILES_STORAGE . $i)) {
				//Проходим по списку файлов
				while (($file = readdir($dir)) !== false) {
					//Если возвращенный элемент файл
					if (is_file(FILES_STORAGE . $i . "/" . $file)) {
						//Получаем информацию об файле из БД
						$data = $objDB -> select("SELECT * FROM booksFileList WHERE fileName LIKE '" . $file . "' AND storage = " . $i . ";");
						//Если информации об файле нет в БД
						if (!$data) {
							//Если удалось удалить файл с диска
							if (@unlink(FILES_STORAGE . $i . "/" . $file)) {
								//Формируем список сообщений
								$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_FILE_NO_IN_DB}, {LANG_FIXED_TRUE}"));
							} 
							//Если не удалось удалить файл с диска
							else {
								//Формируем список сообщений
								$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_FILE_NO_IN_DB}, {LANG_FIXED_FALSE}"));

							}
						}
					}
				}
				//Закрываем папку
				closedir($dir);
			} 
			//Если не удалось открыть хранилище файлов для чтения
			else {
				//Формируем список сообщений
				$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_ERROR_OPEN_FILE_STORAGE}" . $i));
			}
		}
		break;
	//-----------------------------------------------------------------------------------------------------------
	//Если событие: "Наличие локальных изображений"
	//-----------------------------------------------------------------------------------------------------------
	case "fixImageInStorage" :
		//Устанавливаем состояние исправления ошибок
		$fixProblem = true;
		//Получаем список изображений из БД
		$data = $objDB -> select("SELECT * FROM booksImageList;");
		//Если список изображений получен
		if ($data) {
			//Проходим по списку
			foreach ($data as $key => $val) {
				//Если изображение локальное
				if ($val["storage"] > 0) {
					//Если изображение отсутствует на диске
					if (!is_file(IMAGES_STORAGE . $val["storage"] . "/" . $val['imageName'])) {
						//Если удалось удалить запись из БД
						if ($objDB -> delete("booksImageList", Array("ID" => $val["ID"]))) {
							//Формируем список сообщений	
							$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_IMAGE_NO_PRESENT}, {LANG_FIXED_TRUE}"));
						} 
						//Если не уддалось удалить запись из БД
						else {
							//Формируем список сообщений
							$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_IMAGE_NO_PRESENT}, {LANG_FIXED_FALSE}"));
						}
					}
				}
			}
		} 
		//Если список изображений не получен
		else {
			//Формируем список сообщений
			$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_LIST_EMPTY}"));
		}
		break;
	//-----------------------------------------------------------------------------------------------------------
	//Если событие: "Наличие книг по ссылкам изображений"
	//-----------------------------------------------------------------------------------------------------------
	case "fixImageLink" :
		$fixProblem = true;
		$data = $objDB -> select("SELECT * FROM booksImageList;");
		if ($data) {
			foreach ($data as $key => $val) {
				$arrBook = $objDB -> select("SELECT * FROM booksList WHERE ID = " . $val['bookID'] . ";");
				if (!$arrBook) {
					if ($objDB -> delete("booksImageList", Array("ID" => $val["ID"]))) {
						$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_TRUE}"));
					} else {
						$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_FALSE}"));
					}
				}
			}
		} else {
			$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_LIST_EMPTY}"));
		}
		break;
	case "fixImageInDB" :
		$fixProblem = true;
		for ($i = 1; $i <= MAX_FILES_STORAGE_COUNT; $i++) {
			//Если удлаось открыть пользовательскую папку для чтения
			if ($dir = @opendir(IMAGES_STORAGE . $i)) {
				//Проходим по списку файлов
				while (($file = readdir($dir)) !== false) {
					//Если возвращенный элемент файл
					if (is_file(IMAGES_STORAGE . $i . "/" . $file)) {
						$data = $objDB -> select("SELECT * FROM booksImageList WHERE imageName LIKE '" . $file . "' AND storage = " . $i . ";");
						if (!$data) {
							if (@unlink(IMAGES_STORAGE . $i . "/" . $file)) {
								$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_IMAGE_NO_IN_DB}, {LANG_FIXED_TRUE}"));
							} else {
								$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_IMAGE_NO_IN_DB}, {LANG_FIXED_FALSE}"));

							}
						}
					}
				}
				//Закрываем папку
				closedir($dir);
			} else {
				$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_ERROR_OPEN_IMAGE_STORAGE}" . $i));
			}
		}
		break;

	case "fixAuthor" :
		$fixProblem = true;
		$data = $objDB -> select("SELECT * FROM booksAuthorList;");
		if ($data) {
			foreach ($data as $key => $val) {
				$delLine = false;
				$arrBook = $objDB -> select("SELECT * FROM booksList WHERE ID = " . $val['bookID'] . ";");
				if (!$arrBook) {
					if ($objDB -> delete("booksAuthorList", Array("ID" => $val["ID"]))) {
						$delLine = true;
						$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_TRUE}"));
					} else {
						$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_FALSE}"));
					}
				}
				$arrAuthor = $objDB -> select("SELECT * FROM authorList WHERE ID = " . $val['authorID'] . ";");
				if (!$arrBook) {
					if (!$objDB -> delete("booksAuthorList", Array("ID" => $val["ID"])) && $delLine === false) {
						$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_AUTHOR_LINK_EMPTY}, {LANG_FIXED_FALSE}"));
					} else {
						$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_AUTHOR_LINK_EMPTY}, {LANG_FIXED_TRUE}"));
					}
				}
			}
		} else {
			$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_LIST_EMPTY}"));
		}
		break;

	case "fixPrint" :
		$data = $objDB -> select("SELECT * FROM booksPrintList;");
		if ($data) {
			foreach ($data as $key => $val) {
				$delLine = false;
				$arrBook = $objDB -> select("SELECT * FROM booksList WHERE ID = " . $val['bookID'] . ";");
				if (!$arrBook) {
					if ($objDB -> delete("booksPrintList", Array("ID" => $val["ID"]))) {
						$delLine = true;
						$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_TRUE}"));
					} else {
						$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_FALSE}"));
					}
				}
				$arrAuthor = $objDB -> select("SELECT * FROM printList WHERE ID = " . $val['printID'] . ";");
				if (!$arrBook) {
					if (!$objDB -> delete("booksPrintList", Array("ID" => $val["ID"])) && $delLine === false) {
						$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_PRINT_LINK_EMPTY}, {LANG_FIXED_FALSE}"));
					} else {
						$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_PRINT_LINK_EMPTY}, {LANG_FIXED_TRUE}"));
					}
				}
			}
		} else {
			$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_LIST_EMPTY}"));
		}
		$fixProblem = true;
		break;
}
if ($fixProblem) {
	if (empty($errorList)) {
		$objTheme -> success("{LANG_ERROR_LINE_EMPTY}");
	} else {
		$objTheme -> warning($errorList);
	}
} else {
	$objTheme -> define(Array("MAIN_CONTENT" => "fixProblem.tpl"));
}
require_once "end.php";
?>