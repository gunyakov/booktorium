<?php
/***************************************************************************************************
 * Скрипт: манипуляция книгами и привязками к ним
 ***************************************************************************************************
 * Version 		  : 2.0 b
 * Released		  : 28-feb-2013
 * Last Modified  : 23-jun-2014
 * Author		  : O.G <http://o-g.promodj.ru>
 ***************************************************************************************************
 * Лицензия GPL v2
 ***************************************************************************************************
 * Пример работы скрипта http://t-library.net
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
//Если пользователю разрешено редактировать книги
//---------------------------------------------------------------------------------------------------------------
if ($objOptions -> getOption("BookEdit") == "yes") {
	//Если идентификатор книги цифровой
	if (readValueNum("id")) {
		//Если пользователю разрешено редактировать все книги
		if ($objOptions -> getOption("BookEditAll") == "yes") {
			//Проверяем наличие книги в БД
			$data = $objDB -> select("SELECT * FROM booksList WHERE ID = " . readValue("id") . " AND approved LIKE 'no';");
		}
		//Если пользователю запрещено редактировать все книги
		else {
			//Проверяем наличие книги в БД и что книга принадлежит пользователю
			$data = $objDB -> select("SELECT * FROM booksList WHERE ID = " . readValue("id") . " AND userID = " . $objSession -> getUserID() . " AND approved LIKE 'no';");
		}
		//Если проверки книги прошли успешно
		if ($data) {
			//Переключаем событие
			switch(readValue("action")) {
				//Если событие: "Удалить книгу"
				case "delBook" :
					//Сбрасываем наличие ошибок
					$error = false;
					//Если список привязок авторов к книге не пуст
					if ($objDB -> select("SELECT * FROM booksAuthorList WHERE bookID = " . readValue("id") . ";")) {
						//Считаем, что произошла ошибка
						$error = true;
					}
					//Если список привязок издательств к книге не пуст
					if ($objDB -> select("SELECT * FROM booksPrintList WHERE bookID = " . readValue("id") . ";")) {
						//Считаем что произошла ошибка
						$error = true;
					}
					//Если список привязок файлов к книге не пуст
					if ($objDB -> select("SELECT * FROM booksFileList WHERE bookID = " . readValue("id") . ";")) {
						//Считаем, что произошла ошибка
						$error = true;
					}
					//Если список привязок изображений к книге не пуст
					if ($objDB -> select("SELECT * FROM booksImageList WHERE bookID = " . readValue("id") . ";")) {
						//Считаем, что произошла ошибка
						$error = true;
					}
					//Если ошибок нет
					if (!$error) {
						//Если удалось удалить запись
						if ($objDB -> delete("booksList", Array("ID" => readValue("id")))) {
							//Выводим сообщение об этом
							$objTheme -> success("{LANG_DEL_TRUE}");
						}
						//Если не удалось удалить запись
						else {
							//Выводим сообщение об этом
							$objTheme -> error("{LANG_DEL_FALSE}");
						}
					}
					//Если есть ошибки
					else {
						//Выводим сообщение об ошибке
						$objTheme -> warning("{LANG_LINE_NO_EMPTY}");
					}
					break;
				//Если событие не определенно
				default :
					//-------------------------------------------------------------------------------------------
					//Формируем и выводим форму для редактирования книги
					//-------------------------------------------------------------------------------------------
					$data = $data[0];
					$objTheme -> define(Array("MAIN_CONTENT" => "editBookForm.tpl"));
					$objTheme -> assign($data);
					//-------------------------------------------------------------------------------------------
					//Формируем список опций
					//-------------------------------------------------------------------------------------------
					if (is_array($arrFullOptions)) {
						//Формируем списки опций
						$extraBlocksContent = '';
						foreach ($arrFullOptions as $key => $val) {
							$strOptions = '';
							foreach ($val as $key2 => $val2) {
								if ($data[$key] == $val2) {
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
					//-------------------------------------------------------------------------------------------
					//Создаем список привязаных авторов
					//-------------------------------------------------------------------------------------------
					$data = $objDB -> select("SELECT authorList.* FROM authorList, booksAuthorList WHERE booksAuthorList.bookID = " . $_GET['id'] . " AND booksAuthorList.authorID = authorList.ID;");
					if ($data) {
						$listA = '';
						foreach ($data as $key => $val) {
							$val['THEME_PATH'] = THEME_PATH;
							$val['BOOK_ID'] = readValue("id");
							$listA .= $objTheme -> addDynamic("editBookAuthor.tpl", $val);
						}
						$objTheme -> assign(Array("AUTHOR_CONTENT" => $listA));
					} else {
						$objTheme -> define(Array("AUTHOR_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
					//-------------------------------------------------------------------------------------------------------
					//Создаем полный список авторов для добавления
					//-------------------------------------------------------------------------------------------------------
					$data = $objDB -> select("SELECT * FROM authorList ORDER BY familyName;");
					if ($data) {
						$listA = '';
						foreach ($data as $key => $val) {
							$listA .= $objTheme -> addDynamic("option.tpl", Array("selected" => "", "value" => $val['ID'], "label" => $val['familyName'] . " " . $val['name']));
						}
						$objTheme -> assign(Array("AUTHOR_LIST_CONTENT" => $listA));
					} else {
						$objTheme -> define(Array("AUTHOR_LIST_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
					//-------------------------------------------------------------------------------------------------------
					//Создаем список привязаных категорий
					//-------------------------------------------------------------------------------------------------------
					$data = $objDB -> select("SELECT categoryList.* FROM categoryList, booksCategoryList WHERE booksCategoryList.bookID = " . $_GET['id'] . " AND booksCategoryList.categoryID = categoryList.ID;");
					if ($data) {
						$listA = '';
						foreach ($data as $key => $val) {
							$val['THEME_PATH'] = THEME_PATH;
							$val['BOOK_ID'] = readValue("id");
							$listA .= $objTheme -> addDynamic("editBookCategory.tpl", $val);
						}
						$objTheme -> assign(Array("CATEGORY_CONTENT" => $listA));
					} else {
						$objTheme -> define(Array("CATEGORY_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
					//-------------------------------------------------------------------------------------------------------
					//Создаем полный список категорий для добавления
					//-------------------------------------------------------------------------------------------------------
					require_once "extra/categoryList.php";
					$objTheme -> assign(Array("CATEGORY_LIST_CONTENT" => categoryList()));
					//-------------------------------------------------------------------------------------------------------
					//Создаем список привязаных файлов
					//-------------------------------------------------------------------------------------------------------
					$data = $objDB -> select("SELECT * FROM booksFileList WHERE bookID = " . $_GET['id'] . ";");
					if ($data) {
						require_once "extra/formatFileSize.php";
						$listA = '';
						foreach ($data as $key => $val) {
							$val['THEME_PATH'] = THEME_PATH;
							$val['BOOK_ID'] = readValue("id");
							$val['fileSize'] = formatFileSize($val['fileSize']);
							$listA .= $objTheme -> addDynamic("editBookFile.tpl", $val);
						}
						$objTheme -> assign(Array("FILE_CONTENT" => $listA));
					} else {
						$objTheme -> define(Array("FILE_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
					//-------------------------------------------------------------------------------------------------------
					//Создаем список файлов, доступных для привязки
					//-------------------------------------------------------------------------------------------------------
					//Сбрасываем список фалов
					$listA = "";
					//Сбрасываем список изображений
					$listB = "";
					//Если удлаось открыть пользовательскую папку для чтения
					if ($dir = @opendir(USER_STORAGE . $objSession -> getUserPath())) {
						//Проходим по списку файлов
						while (($file = readdir($dir)) !== false) {
							//Если возвращенный элемент файл
							if (is_file(USER_STORAGE . $objSession -> getUserPath() . "/" . $file)) {
								//Если файл - изображение
								if (preg_match('/.png|.gif|.jpg/i', $file)) {
									//Формируем список изображений
									$listB .= $objTheme -> addDynamic("option.tpl", Array("label" => $file, "value" => $file, "selected" => ""));
								}
								//Если файл имеет разрешенные форматы для книги
								if (preg_match('/.djvu|.pdf|.doc|.rar|.rtf|.zip/i', $file)) {
									//Формируем список файлов
									$listA .= $objTheme -> addDynamic("option.tpl", Array("label" => $file, "value" => $file, "selected" => ""));
								}
							}
						}
						//Закрываем папку
						closedir($dir);
					}
					//Если список файлов не пуст
					if (!empty($listA)) {
						//Выводим его в браузер
						$objTheme -> assign(Array("FILE_LIST_CONTENT" => $listA));
					}
					//Если список файлов пуст
					else {
						//Выводим сообщение об этом
						$objTheme -> define(Array("FILE_LIST_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
					//Если список изображений не пуст
					if (!empty($listB)) {
						//Выводим его в браузер
						$objTheme -> assign(Array("FILE_LIST_CONTENT" => $listA, "IMAGE_LIST_CONTENT" => $listB));
					}
					//Если список изображений пуст
					else {
						//Выводим сообщение об этом
						$objTheme -> define(Array("IMAGE_LIST_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
					//-------------------------------------------------------------------------------------------------------
					//Создаем список привязаных изображений
					//-------------------------------------------------------------------------------------------------------
					$data = $objDB -> select("SELECT * FROM booksImageList WHERE bookID = " . $_GET['id'] . " ORDER BY orderID;");
					if ($data) {
						$listA = '';
						foreach ($data as $key => $val) {
							$val['THEME_PATH'] = THEME_PATH;
							$val['BOOK_ID'] = readValue("id");
							if ($val['storage'] > 0) {
								$val['imageName'] = IMAGES_DOWNLOAD_LINK . $val['storage'] . "/" . $val['imageName'];
							}
							$listA .= $objTheme -> addDynamic("editBookImage.tpl", $val);
						}
						$objTheme -> assign(Array("IMAGE_CONTENT" => $listA));
					} else {
						$objTheme -> define(Array("IMAGE_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
					//-------------------------------------------------------------------------------------------------------
					//Создаем список привязаных издательств
					//-------------------------------------------------------------------------------------------------------
					$data = $objDB -> select("SELECT printList.* FROM printList, booksPrintList WHERE booksPrintList.bookID = " . $_GET['id'] . " AND booksPrintList.printID = printList.ID;");
					if ($data) {
						$listA = '';
						foreach ($data as $key => $val) {
							$val['THEME_PATH'] = THEME_PATH;
							$val['BOOK_ID'] = readValue("id");
							$listA .= $objTheme -> addDynamic("editBookPrint.tpl", $val);
						}
						$objTheme -> assign(Array("PRINT_CONTENT" => $listA));
					} else {
						$objTheme -> define(Array("PRINT_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
					//-------------------------------------------------------------------------------------------------------
					//Создаем полный список издательств, доступных для привязки
					//-------------------------------------------------------------------------------------------------------
					$data = $objDB -> select("SELECT * FROM printList ORDER BY name;");
					if ($data) {
						$listA = '';
						foreach ($data as $key => $val) {
							$listA .= $objTheme -> addDynamic("option.tpl", Array("selected" => "", "value" => $val['ID'], "label" => $val['name'] . ",&nbsp" . $val['city']));
						}
						$objTheme -> assign(Array("PRINT_LIST_CONTENT" => $listA));
					} else {
						$objTheme -> define(Array("PRINT_LIST_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
					break;
			}
		}
		//Если проверка книги не прошла успешно
		else {
			//Выводим сообщение об этом
			$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
		}
	}
	//Если идентификатор книги не цифровой
	else {
		//Если пользователю разрешено редактировать все книги
		if ($objOptions -> getOption("BookEditAll") == "yes") {
			//Выбираем книги, которые не утверждены администратором
			$data = $objDB -> select("SELECT * FROM booksList WHERE approved LIKE 'no';");
		}
		//Если пользователю запрещено редактировать все книги
		else {
			//Выбираем книги, которые не утверждены администратором и принадлежат текужему пользователю
			$data = $objDB -> select("SELECT * FROM booksList WHERE userID = " . $objSession -> getUserID() . " AND approved LIKE 'no';");
		}
		//Если список книг существует
		if ($data) {
			//Определяем параметры шаблона
			$objTheme -> define(Array("MAIN_CONTENT" => "table.tpl", "TH_CONTENT" => "thBookList.tpl"));
			//Сбрасываем содержание тела таблицы
			$tbodyStr = '';
			//Проходим по списку книг
			foreach ($data as $key => $val) {
				//Формируем тело таблицы
				$tbodyStr .= $objTheme -> addDynamic("trBookList.tpl", $val);
			}
			//Выводим тело таблицы в браузер
			$objTheme -> assign(Array("TBODY_CONTENT" => $tbodyStr));
		}
		//Если списка книг не существует
		else {
			//Выводим сообщение об этом
			$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
		}
	}
}
//---------------------------------------------------------------------------------------------------------------
//Если пользователю запрещено редактировать книги
//---------------------------------------------------------------------------------------------------------------
else {
	//Выводим сообщение об этом
	$objTheme -> warning("{LANG_EDIT_PROHIBITED}");
}
//---------------------------------------------------------------------------------------------------------------
//Вывод шаблона в браузер и очистка памяти
//---------------------------------------------------------------------------------------------------------------
require_once "end.php";
?>
