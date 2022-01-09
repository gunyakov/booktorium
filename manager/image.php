<?php
/***************************************************************************************************
 * Скрипт: работа с изображениями и записями об изображениях в БД
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
require_once "extra/selectStorage.php";
//----------------------------------------------------------------------------------------------------------------
//Если пользователю разрешено редактировать книги
//---------------------------------------------------------------------------------------------------------------
if ($objOptions -> getOption("BookEdit") == "yes") {
	//Если переданные данные имеют цифровой формат
	if (readValueNum("bookID")) {
		//Если пользователю разрешено редактировать все книги
		if ($objOptions -> getOption("BookEditAll") == "yes") {
			//Проверяем наличие книги в БД
			$data = $objDB -> select("SELECT * FROM booksList WHERE ID = " . readValue("bookID") . " AND approved LIKE 'no';");
		}
		//Если пользователю запрещено редактировать все книги
		else {
			//Проверяем наличие книги в БД и что книга принадлежит пользователю
			$data = $objDB -> select("SELECT * FROM booksList WHERE ID = " . readValue("bookID") . " AND userID = " . $objSession -> getUserID() . " AND approved LIKE 'no';");
		}
		//Если проверки книги прошли успешно
		if ($data) {
			switch(readValue("action")) {
				//-----------------------------------------------------------------------------------------------------------
				//Если событие "Привязать изображение к книге"
				//-----------------------------------------------------------------------------------------------------------
				case "addToBook" :
					//Получаем данные
					$imageName = readValue("localImageName");
					$storage = selectStorage();

					if (empty($imageName)) {
						$imageName = readValue("remoteImageName");
						$storage = 0;
					}
					//-------------------------------------------------------------------------------------------------------
					//Создаем массив с информацией об изображении
					//-------------------------------------------------------------------------------------------------------
					$arrImage = Array();
					$arrImage['imageName'] = $imageName;
					$arrImage['bookID'] = readValueNum("bookID");
					//-------------------------------------------------------------------------------------------------------
					//Если формат принятых данных верен
					//-------------------------------------------------------------------------------------------------------
					if ($arrImage['imageName'] && $arrImage['bookID']) {
						$data = $objDB -> select("SELECT COUNT(ID) FROM booksImageList WHERE bookID = " . $arrImage["bookID"] . ";");
						//Если кол-во изображений привязанык к книге не превышает лимит
						if (@$data[0]['COUNT(ID)'] < MAX_IMAGE_COUNT) {
							//-----------------------------------------------------------------------------------------------
							//Если изображение локально
							//-----------------------------------------------------------------------------------------------
							if ($storage > 0) {
								//Если файл присутсвует в папке пользователя
								if (is_file(USER_STORAGE . $objSession -> getUserPath() . "/" . $imageName)) {
									//Если в папке хранения не существует изображения с таким же именем
									if (!is_file(IMAGES_STORAGE . $storage . "/" . $imageName)) {
										//Если удалось скопировать файл из папки пользователя в папку хранения
										if (copy(USER_STORAGE . $objSession -> getUserPath() . "/" . $imageName, IMAGES_STORAGE . $storage . "/" . $imageName)) {
											//Удаляем файл из папки пользователя
											unlink(USER_STORAGE . $objSession -> getUserPath() . "/" . $imageName);
											//Получаем дополнительную информацию об изображении
											$arrImage['storage'] = $storage;
											//Если удалось добавить запись в базу
											if ($objDB -> insert("booksImageList", $arrImage)) {
												//Выводим об этом сообщение
												$objTheme -> success("{LANG_ADD_TRUE}");
											}
											//Если не удалось добавить запись в базу
											else {
												//Выводим сообщение об этом
												$objTheme -> error("{LANG_ADD_FALSE}");
											}
										}
										//Если не удалось скопировать изображение из папки пользователя в папку хранения
										else {
											//Выводим сообщение об этом
											$objTheme -> error("{LANG_FILE_FALSE}");
										}
									}
									//Если в папке хранения существует изображение с таким же именем
									else {
										//Выводим сообщение об этом
										$objSession -> warning("{LANG_FILE_SAME_NAME}");
									}
								}
								//Если изображение отсутсвует в папке пользователя
								else {
									//Выводим сообщение об этом
									$objTheme -> error("{LANG_FILE_NO_PRESENT}");
								}
							}
							//-----------------------------------------------------------------------------------------------
							//Если изображение удаленное(добавляется только ссылка в базу)
							//-----------------------------------------------------------------------------------------------
							else {
								//Если удалось добавить запись в базу
								if ($objDB -> insert("booksFileList", $arrFile)) {
									//Выводим об этом сообщение
									$objTheme -> success("{LANG_ADD_TRUE}");
								}
								//Если не удалось добавить запись в базу
								else {
									//Выводим сообщение об этом
									$objTheme -> error("{LANG_ADD_FALSE}");
								}
							}
						}
						//Если кол-во изображений привязанык к книге превышает лимит
						else {
							//Выводим сообщение об этом
							$objTheme -> error("{LANG_LIMIT_REACHED}");
						}
					}
					//-------------------------------------------------------------------------------------------------------
					//Если формат принятых данных не верен
					//-------------------------------------------------------------------------------------------------------
					else {
						//Выводим сообщение об этом
						$objTheme -> warning("{LANG_ERROR_READ_FORM}");
					}
					break;
				//-----------------------------------------------------------------------------------------------------------
				//Если событие "Удалить привязку изображения к книге"
				//-----------------------------------------------------------------------------------------------------------
				case "delFromBook" :
					//Если формат принятых данных верен
					if (readValueNum("bookID") && readValueNum("imageID")) {
						//Получаем информацию об записи
						$data = $objDB -> select("SELECT * FROM booksImageList WHERE bookID = " . readValue("bookID") . " AND ID = " . readValue("imageID") . ";");
						//Если запись присутсвует в базе
						if ($data) {
							//Получаем массив с данными
							$data = $data[0];
							//Если изображение локально
							if ($data['storage'] > 0) {
								//Если удалось удалить изображение из папки хранения либо идет принудительное удаление
								if (@unlink(IMAGES_STORAGE . $data['storage'] . "/" . $data['imageName']) || readValue("forceDel") == "yes") {
									//Если удалось удалить запись из базы
									if ($objDB -> delete("booksImageList", Array("bookID" => readValue("bookID"), "ID" => readValue("imageID")))) {
										//Выводим сообщение об этом
										$objTheme -> success("{LANG_DEL_TRUE}");
									}
									//Если не удалось удалить запись из базы
									else {
										//Выводим сообщение об этом
										$objTheme -> error("{LANG_DEL_FALSE}");
									}
								}
								//Если не удалось удалить файл из папки хранения
								else {
									//Выводим сообщение об этом
									$objTheme -> error("{LANG_FILE_UNLINK_ERROR}");
								}
							}
							//Если изображение удаленное
							else {
								//Если удалось удалить запись из базы
								if ($objDB -> delete("booksImageList", Array("bookID" => readValue("bookID"), "ID" => readValue("imageID")))) {
									//Выводим сообщение об этом
									$objTheme -> success("{LANG_DEL_TRUE}");
								}
								//Если не удалось удалить запись из базы
								else {
									//Выводим сообщение об этом
									$objTheme -> error("{LANG_DEL_FALSE}");
								}
							}
						}
						//Если запись отсутствует в базе
						else {
							//Выводим сообщение об этом
							$objTheme -> warning("{LANG_LINE_EMPTY}");
						}
					}
					//Если формат принятых данных не верен
					else {
						//Выводим сообщение об этом
						$objTheme -> warning("{LANG_ERROR_READ_FORM}");
					}
					break;
				//-----------------------------------------------------------------------------------------------------------
				//Если событие не определенно
				//-----------------------------------------------------------------------------------------------------------
				default :
					//Выводим сообщение об этом
					$objTheme -> warning("{LANG_ERROR_READ_FORM}");
					break;
			}
		}
		//Если проверки книг прошли не успешно
		else {
			//Выводим сообщение об этом
			$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
		}
	}
	//Если идентефикатор книги не цифровой
	else {
		//Выводим сообщение об этом
		$objTheme -> warning("{LANG_ERROR_READ_FORM}");
	}
}
//----------------------------------------------------------------------------------------------------------------
//Если пользователю запрещено редактировать книги
//----------------------------------------------------------------------------------------------------------------
else {
	//Выводим сообщение об этом
	$objTheme -> warning("{LANG_EDIT_PROHIBITED}");
}
//---------------------------------------------------------------------------------------------------------------
//Вывод шаблона в браузер и очистка памяти
//---------------------------------------------------------------------------------------------------------------
require_once "end.php";
?>