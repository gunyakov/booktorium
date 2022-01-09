<?php
/***************************************************************************************************
 * Скрипт: манипуляция авторами и привязками к книгам
 ***************************************************************************************************
 * Version 		  : 1.1 stable
 * Released		  : 27-feb-2013
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
//---------------------------------------------------------------------------------------------------------------
//Если пользователю разрешено редактировать авторов
//---------------------------------------------------------------------------------------------------------------
if ($objOptions -> getOption("AuthorEdit") == "yes") {
	//---------------------------------------------------------------------------------------------------------------
	//Если принятый идентификатор автора имееет цифтровой формат
	//---------------------------------------------------------------------------------------------------------------
	if (readValueNum("id")) {
		//Если пользователю разрешено редактировать всех авторов
		if ($objOptions -> getOption("AuthorEditAll") == "yes") {
			//Проверяем наличие автора в БД
			$data = $objDB -> select("SELECT * FROM authorList WHERE ID = " . readValue("id") . ";");
		} 
		//Если пользователю запрещено редактировать всех авторов
		else {
			//Проверяем наличие автора в БД и принадлежность пользователю
			$data = $objDB -> select("SELECT * FROM authorList WHERE ID = " . readValue("id") . " AND userID = " . $objSession -> getUserID() . ";");
		}
		//Если автор прошел проверки
		if ($data) {
			switch(readValue("action")) {
				//---------------------------------------------------------------------------------------------------
				//Если событие: "Удалить автора"
				//---------------------------------------------------------------------------------------------------
				case "delAuthor" :
					$data = $objDB -> select("SELECT COUNT(ID) FROM booksAuthorList WHERE authorID = " . readValue("id") . ";");
					//Если счетчик книг, привязаных к автору равен 0
					if ($data[0]['COUNT(ID)'] == "0") {
						//Если удаление записи из БД прошло успешно
						if ($objDB -> delete("authorList", Array("ID" => readValue("id")))) {
							//Выводим сообщение об этом
							$objTheme -> success("{LANG_DEL_TRUE}");
						}
						//Если удаление записи из бд прошло не успешно
						else {
							//Выводим сообщение об этом
							$objTheme -> error("{LANG_DEL_FALSE}");
						}
					}
					//Если счетчик книг, привязаных к автору не равен 0
					else {
						//Выводим сообщение об этом
						$objTheme -> warning("{LANG_LINE_NO_EMPTY}");
					}
					break;
				//---------------------------------------------------------------------------------------------------
				//Обновление данных об авторе
				//---------------------------------------------------------------------------------------------------
				case "updateAuthor" :
					//Если принятые данные имеют корректный формат
					if (checkValue(readValue("familyName"), "simbols") && checkValue(readValue("name"), "simbols")) {
						//Если обновление данных в БД успешно
						if ($objDB -> update("authorList", Array("familyName" => readValue("familyName"), "name" => readValue("name")), Array("ID" => readValue("id")))) {
							//Выводим сообщение об этом
							$objTheme -> success("{LANG_UPDATE_TRUE}");
						}
						//Если обновление данных в БД не успешно
						else {
							//Выводим сообщение об этом
							$objTheme -> error("{LANG_UPDATE_FALSE}");
						}
					}
					//Если принятые данные имеют не корректный формат
					else {
						//Выводим сообщение об этом
						$objTheme -> warning("{LANG_ERROR_READ_FORM}");
					}
					break;
				//---------------------------------------------------------------------------------------------------
				//Если событие: "Обьеденить авторов"
				//---------------------------------------------------------------------------------------------------
				case "mergeAuthor" :
					//Если полученн автор, с которым будет происходить обьеденение
					if (readValueNum("authorTo")) {
						//Если автор "от" и "в" не совпадают
						if (readValue("id") != readValue("authorTo")) {
							//Проверяем наличие автора, с которым будет происходить обьеденение в БД
							$data = $objDB -> select("SELECT * FROM authorList WHERE ID = " . readValue("authorTo") . ";");
							//Если автор существует
							if ($data) {
								//Получаем счетчик книг автора, с которым будет происходить обьеденение
								$bookCount = $data[0]['bookCount'];
								//Получаем счетчик книг автора, который обьеденяется
								$data = $objDB -> select("SELECT COUNT(ID) FROM booksAuthorList WHERE authorID = " . readValue("id") . ";");
								//Получаем общий счетчик книг двух аторов
								$bookCount += $data[0]['COUNT(ID)'];
								//Если удалось обновить запись в БД
								if ($objDB -> update("booksAuthorList", Array("authorID" => readValue("authorTo"), "bookCount" => $bookCount), Array("authorID" => readValue("id")))) {
									//Если происходит удаление автора, который обьеденяется
									if (readValue("delAuthor") == "yes") {
										//Если удаление выволнено успешно
										if ($objDB -> delete("authorList", array("ID" => readValue("id")))) {
											//Выводим сообщение об этом
											$objTheme -> success("{LANG_MERGE_TRUE}");
										}
										//Если удаление не выволненно
										else {
											//Выводим сообщение об этом
											$objTheme -> warning("{LANG_MERGE_TRUE}, {LANG_DEL_FALSE}");
										}
									}
									//Если не происходит удаление автора, который обьеденяется
									else {
										//Выводим сообщение об успехе обновления данных
										$objTheme -> success("{LANG_MERGE_TRUE}");
									}
								}
								//Если не удалось обновить записи в БД
								else {
									//Выводим сообщение об этом
									$objTheme -> error("{LANG_MERGE_FALSE}");
								}
							}
							//Если автор, с которым обьеденяются записи не существует в БД
							else {
								//Выводим сообщение об этом
								$objTheme -> warning("{LANG_LINE_EMPTY}");
							}
						}
						//Если автор "от" и "в" совпадают
						else {
							//Выводим сообщение об этом
							$objTheme -> warning("{LANG_ENTRY_SAME}");
						}
					}
					//Если не получен автор с которым будет происходить обьеденение записей
					else {
						$objTheme -> warning("{LANG_ERROR_READ_FORM}");
					}
					break;
				//---------------------------------------------------------------------------------------------------
				//Если событие: "Ссылки на книгу"
				//---------------------------------------------------------------------------------------------------
				case "linkAuthor" :
					//Если данные формы полученны
					if (readValueNum("bookID") && readValueNum("authorTo")) {
						//Выбираем наличие записи в БД
						$data = $objDB -> select("SELECT * FROM booksAuthorList WHERE bookID = " . readValue("bookID") . " AND authorID = " . readValue("id") . ";");
						//Если запись об ссылке автора на книгу существует в БД
						if ($data) {
							//Если номер автора, к которому переносится ссылка равен -1
							if (readValue("authorTo") == -1) {
								//Если удаление ссылки на книгу из автора прошло успешно
								if ($objDB -> delete("booksAuthorList", Array("authorID" => readValue("id"), "bookID" => readValue("bookID")))) {
									//Уменьшаем счетчик книг автора на 1
									$objDB -> select("UPDATE authorList SET bookCount = bookCount - 1 WHERE ID = " . readValue("id") . ";");
									//Выводим сообщение об этом
									$objTheme -> success("{LANG_DEL_TRUE}");
								}
								//Если удаление ссылки на книгу из автора прошло не успешно
								else {
									//Выводим сообщение об этом
									$objTheme -> error("{LANG_DEL_FALSE}");
								}
							}
							//Если номер автора, к которому переносится ссылка не равен -1
							else {
								//Проверяем наличие записи об авторе в БД
								$data = $objDB -> select("SELECT * FROM authorList WHERE ID = " . readValue("authorTo"));
								//Если запись сущестыует
								if ($data) {
									//Если обновление записи прошло успешно
									if ($objDB -> update("booksAuthorList", Array("authorID" => readValue("authorTo")), Array("authorID" => readValue("id"), "bookID" => readValue("bookID")))) {
										//Увеличиваем счетчик книг автора на 1
										$objDB -> select("UPDATE authorList SET bookCount = bookCount - 1 WHERE ID = " . readValue("id") . ";");
										$objDB -> select("UPDATE authorList SET bookCount = bookCount + 1 WHERE ID = " . readValue("authorTo") . ";");
										//Выводим сообщение об этом
										$objTheme -> success("{LANG_MERGE_TRUE}");
									}
									//Если обновление записи прошло не успешно
									else {
										//Выводим сообщение об этом
										$objTheme -> error("LANG_MERGE_FALSE");
									}
								}
								//Если записи об авторе в БД не существует
								else {
									//Выводим ссобщение об этом
									$objTheme -> warning("{LANG_LINE_EMPTY}");
								}
							}
						}
						//Если записи об ссылке автора на книгу не существует в БД
						else {
							//Выводим сообщение об этом
							$objTheme -> warning("{LANG_LINE_EMPTY}");
						}
					}
					//Если данные формы не полученны
					else {
						//Выводим сообщение об этом
						$objTheme -> warning("{LANG_ERROR_READ_FORM}");
					}
					break;
				//---------------------------------------------------------------------------------------------------
				//Если событие: "Исправить проблемы"
				//---------------------------------------------------------------------------------------------------
				case "fixProblem" :
					//Получаем текущий счетчик книг автора
					$bookCount = $data[0]['bookCount'];
					//Сбрасываем список ошибок
					$errorList = "";
					//Получаем список привязаных книг к автору
					$data = $objDB -> select("SELECT * FROM booksAuthorList WHERE authorID = " . readValue("id") . ";");
					//Устанавливаем локальный список книг
					$arrBookID = array();
					//Если список книг в БД для данного автора существует
					if ($data) {
						//Проходим по списку книг
						foreach ($data as $key => $val) {
							//Если ссылка на данную книгу уже встречалачь предже
							if (@$arrBookID[$val['bookID']] == "yes") {
								//Если удалось удалить дополнительную ссылку
								if ($objDB -> delete("booksAuthorList", Array("ID" => $val['ID']))) {
									//Формируем список ошибок
									$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_LINE_DOUBLE}, {LANG_FIXED_TRUE}"));
								}
								//Если не удалось удалить дополнительную ссылку
								else {
									//Формируем список ошибок
									$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_LINE_DOUBLE}, {LANG_FIXED_FALSE}"));
								}
							}
							//Если ссылка на данную книгу не встречалась прежде
							else {
								//Выбираем данные об привязаной книге
								$dataBook = $objDB -> select("SELECT * FROM booksList WHERE ID = " . $val['bookID'] . ";");
								//Если данные существуют
								if ($dataBook) {
									//Сохраняем ссылку на книгу в локальном списке
									$arrBookID[$val['bookID']] = "yes";
								}
								//Если данных не существует
								else {
									//Если удалось удалить ссылку на не существующюю книгу
									if ($objDB -> delete("booksAuthorList", Array("ID" => $val['ID']))) {
										//Формируем список ошибок
										$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_TRUE}"));
									}
									//Если не удалось удалить ссылку на не существующюю книгу
									else {
										//Формируем список ошибок
										$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LINK_EMPTY}, {LANG_FIXED_FALSE}"));
									}
								}
							}
						}
					}
					//Если списка книг у автора в БД еще нет
					else {
						//Формируем список ошибок
						$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LIST_EMPTY}, {LANG_FIXED_FALSE}"));
					}

					//Если счетчик книг в БД отличается от текущего счетчика книг
					if (count($arrBookID) != $bookCount) {
						//Получаем текущий счетчик книг
						$bookCount = count($arrBookID);
						//Если удалось обновить данные автора в БД
						if ($objDB -> update("authorList", Array("bookCount" => $bookCount), Array("ID" => readValue("id")))) {
							//Формируем список ошибок
							$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_BOOK_COUNT_NOT_SAME}, {LANG_FIXED_TRUE}"));
						}
						//Если не удалось обновить данные автора в БД
						else {
							//Формируем список ошибок
							$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_BOOK_COUNT_NOT_SAME}, {LANG_FIXED_FALSE}"));
						}
					}

					//Если список ошибок пуст
					if (empty($errorList)) {
						//Выводим сообщение об этом
						$objTheme -> success("{LANG_ERROR_LINE_EMPTY}");
					}
					//Если список ошибок не пуст
					else {
						//Выводим список ошибок
						$objTheme -> warning($errorList);
					}
					break;
				//---------------------------------------------------------------------------------------------------
				//Если событие не определенно
				//---------------------------------------------------------------------------------------------------
				default :
					//Выводим форму
					$objTheme -> define(Array("MAIN_CONTENT" => "authorForm.tpl"));
					//Устанавливаем некоторые данные формы
					$objTheme -> assign($data[0]);
					//-----------------------------------------------------------------------------------------------
					//Создаем полный список авторов для обьеденения
					//-----------------------------------------------------------------------------------------------
					$data = $objDB -> select("SELECT * FROM authorList WHERE ID != " . readValue("id") . " ORDER BY familyName;");
					if ($data) {
						$listA = '';
						foreach ($data as $key => $val) {
							$listA .= $objTheme -> addDynamic("option.tpl", Array("selected" => "", "value" => $val['ID'], "label" => $val['familyName'] . " " . $val['name']));
						}
						$objTheme -> assign(Array("AUTHOR_LIST_CONTENT" => $listA));
					} else {
						$listA = '';
						$objTheme -> define(Array("AUTHOR_LIST_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
					//-----------------------------------------------------------------------------------------------
					//Создаем список привязаных книг
					//-----------------------------------------------------------------------------------------------
					$data = $objDB -> select("SELECT booksList.* FROM booksList, booksAuthorList WHERE booksAuthorList.authorID = " . readValue("id") . " AND booksAuthorList.bookID = booksList.ID;");
					if ($data) {
						$listB = '';
						foreach ($data as $key => $val) {
							$val['THEME_PATH'] = THEME_PATH;
							$val['AUTHOR_ID'] = readValue("id");
							$val["AUTHOR_LIST_CONTENT"] = $listA;
							$listB .= $objTheme -> addDynamic("bookListAuthor.tpl", $val);

						}
						$objTheme -> assign(Array("BOOK_CONTENT" => $listB));
					} else {
						$objTheme -> define(Array("BOOK_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
			}
		}

	}
	//---------------------------------------------------------------------------------------------------------------
	//Если принятый идентификатор автора имеет не цифровой формат либо пуст
	//---------------------------------------------------------------------------------------------------------------
	else {
		//Если пользователю разрешено редактировать всех авторов
		if ($objOptions -> getOption("AuthorEditAll") == "yes") {
			//Выбираем из БД список всех авторов
			$data = $objDB -> select("SELECT * FROM authorList ORDER BY datePut DESC;");
		} 
		//Если пользователю запрещено редактировать всех авторов
		else {
			//Выбираем из БД список авторов, принадлежащий текущему пользователю
			$data = $objDB -> select("SELECT * FROM authorList WHERE userID = " . $objSession -> getUserID() . " ORDER BY datePut DESC;");
		}
		//Если список авторов получен
		if ($data) {
			//Устанавливаем опции шаблона
			$objTheme -> define(Array("MAIN_CONTENT" => "table.tpl", "TH_CONTENT" => "thAuthorList.tpl"));
			//Сбрасываем данные тела таблицы
			$tbodyStr = '';
			//Проходим по списку
			foreach ($data as $key => $val) {
				//Формируем тело таблицы
				$tbodyStr .= $objTheme -> addDynamic("trAuthorList.tpl", $val);
			}
			//Выводим тело таблицы
			$objTheme -> assign(Array("TBODY_CONTENT" => $tbodyStr));
		}
		//Если список авторов не получен
		else {
			//Выводим сообщение об этом
			$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
		}
	}
}
//---------------------------------------------------------------------------------------------------------------
//Если пользователю запрещено редактировать авторов
//---------------------------------------------------------------------------------------------------------------
else {
	//Выводим сообщение об этом
	$objTheme -> warning("{LANG_EDIT_PROHIBITED}");
}
//---------------------------------------------------------------------------------------------------------------
//Очистка памяти и вывод шаблона в браузер
//---------------------------------------------------------------------------------------------------------------
require_once "end.php";
?>