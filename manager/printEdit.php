<?php
/***************************************************************************************************
 * Скрипт: манипуляция издательствами и привязками к книгам
 ***************************************************************************************************
 * Version 		  : 1.1 stable
 * Released		  : 27-feb-2013
 * Last Modified  : 29-feb-2013
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
//Если пользователю разрешено редактировать издательства
//---------------------------------------------------------------------------------------------------------------
if ($objOptions -> getOption("PrintEdit") == "yes") {
	//---------------------------------------------------------------------------------------------------------------
	//Если принятый идентификатор издательства имееет цифтровой формат
	//---------------------------------------------------------------------------------------------------------------
	if (readValueNum("id")) {
		//Если пользователю разрешено редактировать все издательства
		if ($objOptions -> getOption("PrintEditAll") == "yes") {
			//Проверяем наличие издательства в БД
			$data = $objDB -> select("SELECT * FROM printList WHERE ID = " . readValue("id") . ";");
		} 
		//Если пользователю запрещено редактировать все издательства
		else {
			//Проверяем наличие издательства в БД и принадлежность пользователю
			$data = $objDB -> select("SELECT * FROM printList WHERE ID = " . readValue("id") . " AND userID = " . $objSession -> getUserID() . ";");
		}
		//Если издательство прошло проверки
		if ($data) {
			switch(readValue("action")) {
				//---------------------------------------------------------------------------------------------------
				//Если событие: "Удалить издательство"
				//---------------------------------------------------------------------------------------------------
				case "delPrint" :
					$data = $objDB -> select("SELECT COUNT(ID) FROM booksPrintList WHERE printID = " . readValue("id") . ";");
					//Если счетчик привязаных книг к издательству равен 0
					if ($data[0]['COUNT(ID)'] == "0") {
						//Если удаление записи из БД прошло успешно
						if ($objDB -> delete("printList", Array("ID" => readValue("id")))) {
							//Выводим сообщение об этом
							$objTheme -> success("{LANG_DEL_TRUE}");
						}
						//Если удаление записи из бд прошло не успешно
						else {
							//Выводим сообщение об этом
							$objTheme -> error("{LANG_DEL_FALSE}");
						}
					}
					//Если счетчик книг, привязаных к издательству не равен 0
					else {
						//Выводим сообщение об этом
						$objTheme -> warning("{LANG_LINE_NO_EMPTY}");
					}
					break;
				//---------------------------------------------------------------------------------------------------
				//Обновление данных об издательстве
				//---------------------------------------------------------------------------------------------------
				case "updatePrint" :
					//Если принятые данные имеют корректный формат
					if (checkValue(readValue("city"), "simbols") && checkValue(readValue("name"), "simbols")) {
						//Если обновление данных в БД успешно
						if ($objDB -> update("printList", Array("city" => readValue("city"), "name" => readValue("name")), Array("ID" => readValue("id")))) {
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
				//Если событие: "Обьеденить издательства"
				//---------------------------------------------------------------------------------------------------
				case "mergePrint" :
					//Если полученно издательство, с которым будет происходить обьеденение
					if (readValueNum("printTo")) {
						//Если издательства "от" и "в" не совпадают
						if (readValue("id") != readValue("printTo")) {
							//Проверяем наличие издательства, с которым будет происходить обьеденение в БД
							$data = $objDB -> select("SELECT * FROM printList WHERE ID = " . readValue("printTo") . ";");
							//Если издательство существует
							if ($data) {
								//Получаем счетчик книг издательства, с которым будет происходить обьеденение
								$bookCount = $data[0]['bookCount'];
								//Получаем счетчик книг издательства, которое обьеденяется
								$data = $objDB -> select("SELECT COUNT(ID) FROM booksPrintList WHERE printID = " . readValue("id") . ";");
								//Получаем общий счетчик книг двух издательств
								$bookCount += $data[0]['COUNT(ID)'];
								//Если удалось обновить запись в БД
								if ($objDB -> update("booksPrintList", Array("printID" => readValue("printTo"), "bookCount" => $bookCount), Array("printID" => readValue("id")))) {
									//Если происходит удаление издательства, которое обьеденяется
									if (readValue("delPrint") == "yes") {
										//Если удаление выволнено успешно
										if ($objDB -> delete("printList", array("ID" => readValue("id")))) {
											//Выводим сообщение об этом
											$objTheme -> success("{LANG_MERGE_TRUE}");
										}
										//Если удаление не выволненно
										else {
											//Выводим сообщение об этом
											$objTheme -> warning("{LANG_MERGE_TRUE}, {LANG_DEL_FALSE}");
										}
									}
									//Если не происходит удаление издательства, который обьеденяется
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
							//Если издательство, с которым обьеденяются записи не существует в БД
							else {
								//Выводим сообщение об этом
								$objTheme -> warning("{LANG_LINE_EMPTY}");
							}
						}
						//Если издательтсва "от" и "в" совпадают
						else {
							//Выводим сообщение об этом
							$objTheme -> warning("{LANG_ENTRY_SAME}");
						}
					}
					//Если не полученно издательство с которым будет происходить обьеденение записей
					else {
						$objTheme -> warning("{LANG_ERROR_READ_FORM}");
					}
					break;
				//---------------------------------------------------------------------------------------------------
				//Если событие: "Ссылки на книгу"
				//---------------------------------------------------------------------------------------------------
				case "linkPrint" :
					//Если данные формы полученны
					if (readValueNum("bookID") && readValueNum("printTo")) {
						//Выбираем наличие записи в БД
						$data = $objDB -> select("SELECT * FROM booksPrintList WHERE bookID = " . readValue("bookID") . " AND printID = " . readValue("id") . ";");
						//Если запись об ссылке издательства на книгу существует в БД
						if ($data) {
							//Если номер издательства, к которому переносится ссылка равен -1
							if (readValue("printTo") == -1) {
								//Если удаление ссылки на книгу из издательства прошло успешно
								if ($objDB -> delete("booksPrintList", Array("printID" => readValue("id"), "bookID" => readValue("bookID")))) {
									//Уменьшаем счетчик книг издательства на 1
									$objDB -> select("UPDATE printList SET bookCount = bookCount - 1 WHERE ID = " . readValue("id") . ";");
									//Выводим сообщение об этом
									$objTheme -> success("{LANG_DEL_TRUE}");
								}
								//Если удаление ссылки на книгу из издательства прошло не успешно
								else {
									//Выводим сообщение об этом
									$objTheme -> error("{LANG_DEL_FALSE}");
								}
							}
							//Если номер издательства, к которому переносится ссылка не равен 0
							else {
								//Проверяем наличие записи об издательстве в БД
								$data = $objDB -> select("SELECT * FROM printList WHERE ID = " . readValue("printTo"));
								//Если запись существует
								if ($data) {
									//Если обновление записи прошло успешно
									if ($objDB -> update("booksPrintList", Array("printID" => readValue("printTo")), Array("printID" => readValue("id"), "bookID" => readValue("bookID")))) {
										//Увеличиваем счетчик книг издательства на 1
										$objDB -> select("UPDATE printList SET bookCount = bookCount - 1 WHERE ID = " . readValue("id") . ";");
										$objDB -> select("UPDATE printList SET bookCount = bookCount + 1 WHERE ID = " . readValue("printTo") . ";");
										//Выводим сообщение об этом
										$objTheme -> success("{LANG_MERGE_TRUE}");
									}
									//Если обновление записи прошло не успешно
									else {
										//Выводим сообщение об этом
										$objTheme -> error("LANG_MERGE_FALSE");
									}
								}
								//Если записи об издательстве в БД не существует
								else {
									//Выводим ссобщение об этом
									$objTheme -> warning("{LANG_LINE_EMPTY}");
								}
							}
						}
						//Если записи об ссылке издательства на книгу не существует в БД
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
					//Получаем текущий счетчик книг издательства
					$bookCount = $data[0]['bookCount'];
					//Сбрасываем список ошибок
					$errorList = "";
					//Получаем список привязаных книг к издательству
					$data = $objDB -> select("SELECT * FROM booksPrintList WHERE printID = " . readValue("id") . ";");
					//Устанавливаем локальный список книг
					$arrBookID = array();
					//Если список книг в БД для данного издательства существует
					if ($data) {
						//Проходим по списку книг
						foreach ($data as $key => $val) {
							//Если ссылка на данную книгу уже встречалачь предже
							if (@$arrBookID[$val['bookID']] == "yes") {
								//Если удалось удалить дополнительную ссылку
								if ($objDB -> delete("booksPrintList", Array("ID" => $val['ID']))) {
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
									if ($objDB -> delete("booksPrintList", Array("ID" => $val['ID']))) {
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
					//Если списка книг у издательства в БД еще нет
					else {
						//Формируем список ошибок
						$errorList .= $objTheme -> addDynamic("liFalse.tpl", Array("LI_CONTENT" => "{LANG_BOOK_LIST_EMPTY}, {LANG_FIXED_FALSE}"));
					}

					//Если счетчик книг в БД отличается от текущего счетчика книг
					if (count($arrBookID) != $bookCount) {
						//Получаем текущий счетчик книг
						$bookCount = count($arrBookID);
						//Если удалось обновить данные издательства в БД
						if ($objDB -> update("printList", Array("bookCount" => $bookCount), Array("ID" => readValue("id")))) {
							//Формируем список ошибок
							$errorList .= $objTheme -> addDynamic("liTrue.tpl", Array("LI_CONTENT" => "{LANG_BOOK_COUNT_NOT_SAME}, {LANG_FIXED_TRUE}"));
						}
						//Если не удалось обновить данные издательства в БД
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
					$objTheme -> define(Array("MAIN_CONTENT" => "printForm.tpl"));
					//Устанавливаем некоторые данные формы
					$objTheme -> assign($data[0]);
					//-----------------------------------------------------------------------------------------------
					//Создаем полный список издательств для обьеденения
					//-----------------------------------------------------------------------------------------------
					$data = $objDB -> select("SELECT * FROM printList WHERE ID != " . readValue("id") . " ORDER BY name;");
					if ($data) {
						$listA = '';
						foreach ($data as $key => $val) {
							$listA .= $objTheme -> addDynamic("option.tpl", Array("selected" => "", "value" => $val['ID'], "label" => $val['name'] . ", " . $val['city']));
						}
						$objTheme -> assign(Array("PRINT_LIST_CONTENT" => $listA));
					} else {
						$listA = '';
						$objTheme -> define(Array("PRINT_LIST_CONTENT" => "warning.tpl"));
						$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
					}
					//-----------------------------------------------------------------------------------------------
					//Создаем список привязаных книг
					//-----------------------------------------------------------------------------------------------
					$data = $objDB -> select("SELECT booksList.* FROM booksList, booksPrintList WHERE booksPrintList.printID = " . readValue("id") . " AND booksPrintList.bookID = booksList.ID;");
					if ($data) {
						$listB = '';
						foreach ($data as $key => $val) {
							$val['THEME_PATH'] = THEME_PATH;
							$val['PRINT_ID'] = readValue("id");
							$val["PRINT_LIST_CONTENT"] = $listA;
							$listB .= $objTheme -> addDynamic("bookListPrint.tpl", $val);

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
	//Если принятый идентификатор издательства имеет не цифровой формат либо пуст
	//---------------------------------------------------------------------------------------------------------------
	else {
		//Если пользователю разрешено редактировать все издательства
		if ($objOptions -> getOption("PrintEditAll") == "yes") {
			//Выбираем из БД список всех издательств
			$data = $objDB -> select("SELECT * FROM printList ORDER BY datePut DESC;");
		} 
		//Если пользователю запрещено редактировать все издательства
		else {
			//Выбираем из БД список издательств, принадлежащий текущему пользователю
			$data = $objDB -> select("SELECT * FROM printList WHERE userID = " . $objSession -> getUserID() . " ORDER BY datePut DESC;");
		}
		//Если список издательств получен
		if ($data) {
			//Устанавливаем опции шаблона
			$objTheme -> define(Array("MAIN_CONTENT" => "table.tpl", "TH_CONTENT" => "thPrintList.tpl"));
			//Сбрасываем данные тела таблицы
			$tbodyStr = '';
			//Проходим по списку
			foreach ($data as $key => $val) {
				//Формируем тело таблицы
				$tbodyStr .= $objTheme -> addDynamic("trPrintList.tpl", $val);
			}
			//Выводим тело таблицы
			$objTheme -> assign(Array("TBODY_CONTENT" => $tbodyStr));
		}
		//Если список издательств не получен
		else {
			//Выводим сообщение об этом
			$objTheme -> warning("{LANG_HAVE_NO_ELEMENT}");
		}
	}
}
//---------------------------------------------------------------------------------------------------------------
//Если пользователю запрещено редактировать издательства
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