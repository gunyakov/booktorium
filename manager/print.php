<?php
/***************************************************************************************************
 * Скрипт: манипуляция привязками книги к издательствам
 ***************************************************************************************************
 * Version 		  : 1.0 stable
 * Released		  : 28-feb-2013
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
	//Если данные имеют цифровой формат
	if (readValueNum("printID") && readValueNum("bookID")) {
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
			//Получаем привязку из БД
			$data = $objDB -> select("SELECT * FROM booksPrintList WHERE bookID = " . readValue('bookID') . " AND printID = " . readValue("printID") . ";");
			//Переключаем события
			switch(readValue('action')) {
				//Если событие: "Добавить привязку"
				case "addToBook" :
					//Если привязки не существует
					if (!$data) {
						//Проверяем наличие издательства
						$data = $objDB -> select("SELECT * FROM printList WHERE ID = " . readValue('printID') . ";");
						//Если издательство существует
						if ($data) {
							//Получаем счетчик привязаных издательств к книге
							$data = $objDB -> select("SELECT COUNT(ID) from booksPrintList WHERE bookID = " . readValue('bookID') . ";");
							//Если счетчик меньше разрешенного
							if (@$data[0]['COUNT(ID)'] < MAX_PRINT_COUNT) {
								//Если удалось добавить привязку
								if ($objDB -> insert("booksPrintList", Array("bookID" => readValue('bookID'), "printID" => readValue('printID')))) {
									//Увеличиваем счетчик книг издательства на 1
									$objDB -> select("UPDATE printList SET bookCount = bookCount + 1 WHERE ID = " . readValue("printID"));
									//Выводим сообщение о этом
									$objTheme -> success("{LANG_ADD_TRUE}");
								}
								//Если не удалось добавить привязку
								else {
									//Выводим сообщение об этом
									$objTheme -> error("{LANG_ADD_FALSE}");
								}
							}
							//Если счетчик больше либо равен разрешенному
							else {
								//Выводим сообщение об этом
								$objTheme -> error("{LANG_LIMIT_REACHED}");
							}
						}
						//Если издательства не существует
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
					//Если приязка существует
					if ($data) {
						//Если удалось удалить привязку
						if ($objDB -> delete("booksPrintList", Array("bookID" => readValue("bookID"), "printID" => readValue("printID")))) {
							//Уменьшаем счетчик книг издательства на 1
							$objDB -> select("UPDATE printList SET bookCount = bookCount - 1 WHERE ID = " . readValue("printID"));
							//Выводим сообщение об этом
							$objTheme -> success("{LANG_DEL_TRUE}");
						}
						//Если не удалось удалить привязку
						else {
							//Выводим сообщение об этом
							$objTheme -> error("{LANG_DEL_FALSE}");
						}
					}
					//Если привязка не существует
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
		//Если проверки книги прошли не успешно
		else {
			//Выводим сообщение об этом
			$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
		}
	} 
	//Если данные имеют не цифровой формат
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
