<?php
/***************************************************************************************************
 * Скрипт: создание png изображений из pdf или djvu файлов
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
//---------------------------------------------------------------------------------------------------------------
//Подключение дополнительных модулей
//---------------------------------------------------------------------------------------------------------------
require_once "extra/readValue.php";
//---------------------------------------------------------------------------------------------------------------
//Если пользователю разрешено редактировать книги
//---------------------------------------------------------------------------------------------------------------
if ($objOptions -> getOption("BookEdit") == "yes") {
	//Если идентефикатор книги цифровой
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
			//Если идентефикатор файла цифровой
			if (readValueNum("fileID")) {
				//Получаем данные об файле
				$arrFile = $objDB -> select("SELECT * FROM booksFileList WHERE bookID = " . readValue("id") . " AND ID = " . readValue("fileID") . ";");
				//Если данные полученны
				if ($arrFile) {
					//Извлекаем массив
					$arrFile = $arrFile[0];
					//Если файл физически присутсвует на диске
					if (is_file(FILES_STORAGE . $arrFile['storage'] . "/" . $arrFile['fileName'])) {
						//Получаем список изображений к книге
						$data = $objDB -> select("SELECT * FROM booksImageList WHERE bookID = " . readValue("id") . ";");
						//Сбрасываем наличие ошибок
						$error = false;
						//Если список изображений существует
						if ($data) {
							//Проходим по списку изображений
							foreach ($data as $key => $val) {
								//Если изображение локальное
								if ($val['storage'] > 0) {
									//Если не удалось удалить изображение физически
									if (!unlink(IMAGES_STORAGE . $val['storage'] . "/" . $val['imageName'])) {
										//Считаем что произошла ошибка
										$error = true;
									}
								}
							}
							//Если не удалось удалить запись об изображении в БД
							if (!$objDB -> delete("booksImageList", Array("bookID" => readValue("id")))) {
								//Считаем, что произошла ошибка
								$error = true;
							}
						}
						//Если нет ошибок
						if (!$error) {
							//Получаем шаг, с которым будем из файла создавать изображения
							$stepImage = round($arrFile['pages'] / MAX_IMAGE_COUNT);
							//Проходим по циклу до максимально разрешеного кол-ва изображений к книге
							for ($i = 0; $i < MAX_IMAGE_COUNT; $i++) {
								//Получаем номер страницы
								$pageNum = 1 + $i * $stepImage;
								//Если номер страницы больше чем чтраниц в файле
								if ($pageNum > $arrFile['pages']) {
									//Прерываем выполнение цикла
									break;
								}
								//Получаем имя изображения
								$imageName = md5(time() . $i);
								//Переключаем формат файла
								switch($arrFile['fileFormat']) {
									//Если формат файла PDF
									case "pdf" :
										exec(gs . " -sDEVICE=tiff32nc -q -dBATCH -dNOPAUSE -dFirstPage=" . $pageNum . " -dLastPage=" . $pageNum . " -sOutputFile=" . TEMP_STORAGE . $imageName . ".tiff " . FILES_STORAGE . $arrFile['storage'] . "/" . $arrFile['fileName']);
										break;
									//Если формат djvu
									case "djvu" :
										//Извлечение страницы в TIFF из DJVU документа
										exec(ddjvu . " -format=tiff -aspect=yes -page=" . $pageNum . " " . FILES_STORAGE . $arrFile['storage'] . "/" . $arrFile['fileName'] . " " . TEMP_STORAGE . $imageName . ".tiff");
										break;
								}
								//Устанавливаем размер изображений
								$imageSize = 226;
								//Если это не обложка, увеличиваем размер изображений вдвое
								if ($i != 0) {
									$imageSize = 226 * 2;
								}
								switch(readValueNum("colors")) {
									case 16 :
									case 256 :
										//Конвертируем полученный TIFF в PNG используя заданные параметры
										exec(convert . " -resize " . $imageSize . " -format png " . TEMP_STORAGE . $imageName . ".tiff -colors " . readValueNum("colors") . " " . IMAGES_STORAGE . $arrFile['storage'] . "/" . $imageName . ".png");
										break;
									default :
										//Конвертируем полученный TIFF в PNG используя заданные параметры
										exec(convert . " -resize " . $imageSize . " -format png " . TEMP_STORAGE . $imageName . ".tiff " . IMAGES_STORAGE . $arrFile['storage'] . "/" . $imageName . ".png");
										break;
								}

								//Удаляем TIFF
								@unlink(TEMP_STORAGE . $imageName . ".tiff");
								//Вставляем в БД запись об изображении
								$objDB -> insert("booksImageList", Array("bookID" => readValue("id"), "imageName" => $imageName . ".png", "storage" => $arrFile['storage'], "orderID" => $i));
							}
							//Выводим сообщение об успехе
							$objTheme -> success("{LANG_ADD_TRUE}");
						}
						//Если ошибки присутсвуют
						else {
							//Выводим сообщение об этом
							$objTheme -> error("{LANG_ERROR_READ_CONTENT}");
						}
					}
					//Если файл физически не присутсвует на диске
					else {
						//Выводим сообщение об этом
						$objTheme -> error("{LANG_FILE_NO_PRESENT}");
					}
				}
				//Если данные о файле из БД не полученны
				else {
					//Выводим сообщение об этом
					$objTheme -> error("{LANG_FILE_NO_PRESENT}");
				}
			}
			//Если идентефикатор файла не цифровой
			else {
				//Получаем список файлов к книге
				$data = $objDB -> select("SELECT * FROM booksFileList WHERE bookID = " . readValue("id") . " AND storage > 0;");
				//Если список существует
				if ($data) {
					//Устанавливаем шаблон
					$objTheme -> define(Array("MAIN_CONTENT" => "fileList.tpl"));
					//Сбрасываем список файлов
					$listA = "";
					//Пролходим по списку файлов
					foreach ($data as $key => $val) {
						//Формируем список файлов
						$listA .= $objTheme -> addDynamic("option.tpl", Array("value" => $val['ID'], "label" => $val['fileName'], "selected" => ""));
					}
					//Выводим список файлов
					$objTheme -> assign(Array("FILE_LIST_CONTENT" => $listA, "ID" => readValue("id")));
				}
				//Если списка файлов не существует
				else {
					//Выводим сообщение об этом
					$objTheme -> define(Array("FILE_LIST_CONTENT" => "warning.tpl"));
					$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
				}
			}
		}
		//Если проверки книги прошли не успешно
		else {
			$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
		}
	}
	//Если идентефикатор книги не цифровой
	else {
		//Выводим сообщение об этом
		$objTheme -> warning("{LANG_ERROR_READ_FORM}");
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
