<?php
/***************************************************************************************************
 * Скрипт: манипуляция привязками книги к категориям
 ***************************************************************************************************
 * Version 		  : 1.0 stable
 * Released		  : 06-feb-2013
 * Last Modified  : 28-feb-2013
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
//----------------------------------------------------------------------------------------------------------------
//Если пользователю разрешено редактировать книги
//---------------------------------------------------------------------------------------------------------------
if ($objOptions -> getOption("BookEdit") == "yes") {
	if (readValueNum("categoryID") && readValueNum("bookID")) {
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
			//Получаем привязку книги к категории
			$data = $objDB -> select("SELECT * FROM booksCategoryList WHERE bookID = " . readValue('bookID') . " AND categoryID = " . readValue("categoryID") . ";");
			//Переключаем события
			switch(readValue('action')) {
				//Если событие: "Добавить привязку"
				case "addToBook" :
					//Если привязки не существует
					if (!$data) {
						//Проверяем наличие категории
						$data = $objDB -> select("SELECT * FROM categoryList WHERE ID = " . readValue('categoryID') . ";");
						//Если категория существует
						if ($data) {
							//Получаем счетчик категорий, привязанык к книге
							$data = $objDB -> select("SELECT COUNT(ID) from booksCategoryList WHERE bookID = " . readValue('bookID') . ";");
							//Если счетчик меньше разрешенного
							if (@$data[0]['COUNT(ID)'] < MAX_CATEGORY_COUNT) {
								//Если удалось добавить привязку
								if ($objDB -> insert("booksCategoryList", Array("bookID" => readValue('bookID'), "categoryID" => readValue('categoryID')))) {
									//Увеличиваем счетчик книг категории на 1
									$objDB -> select("UPDATE categoryList SET bookCount = bookCount + 1 WHERE ID = " . readValue("categoryID"));
									//Выводим сообщение об этом
									$objTheme -> success("{LANG_ADD_TRUE}");
								} 
								//Если не удалось добавить привязку
								else {
									//Выводим сообщение об этом
									$objTheme -> error("{LANG_ADD_FALSE}");
								}
							} 
							//Если счетчик больше либо равен разрешенного
							else {
								//Выводим сообщение об этом
								$objTheme -> error("{LANG_LIMIT_REACHED}");
							}
						} 
						//Если категории не существует
						else {
							//Выводим сообщение об этом
							$objTheme -> warning("{LANG_LINE_EMPTY}");
						}
					} 
					//Если привязка уже существует
					else {
						//Выводим сообщение об этом
						$objTheme -> warning("{LANG_LINE_HAVE}");
					}
					break;
				//Если событие: "Удалить привязку"
				case "delFromBook" :
					//Если привязка существует
					if ($data) {
						//Если удалось удалить привязку
						if ($objDB -> delete("booksCategoryList", Array("bookID" => readValue("bookID"), "categoryID" => readValue("categoryID")))) {
							//Уменьшаем счетчик книг категории на 1
							$objDB -> select("UPDATE categoryList SET bookCount = bookCount - 1 WHERE ID = " . readValue("categoryID"));
							//Выводим сообщение об этом
							$objTheme -> success("{LANG_DEL_TRUE}");
						} 
						//Если не удалось удалить привязку
						else {
							//Выводим сообщение об этом
							$objTheme -> error("{LANG_DEL_FALSE}");
						}
					} 
					//Если привязки не существует
					else {
						//Выводим сообщение об этом
						$objTheme -> warning("{LANG_LINE_EMPTY}");
					}
					break;
				//Если событие не определенно
				default :
					//Выводим сообщение об этом
					$objTheme -> warning("{LANG_ERROR_READ_FORM}");
					break;
			}
		} 
		//Если проверка книги прошла не успешно
		else {
			//Выводим сообщение об этом
			$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
		}
	} 
	//Если принятые данные имеют не цифровой формат
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
