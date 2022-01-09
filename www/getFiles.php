<?php
//Начальная инициализация
require_once "initd.php";
require_once "extra/readValue.php";
$objTheme -> assign(Array("MENU" => "", "TAG_CLOUD" => "", "SORT_OPTIONS" => ""));
//Если пользователю разрешено загружать файлы
if ($objOptions -> getOption("GetFiles") == "yes") {
	switch($objOptions->getOption("GetFilesAntiBot")) {
		case "no" :
			//Если анти бот код не верен
			if (!$objAntiBot -> getCode(readValue('antiBot'))) {
				$objTheme -> error("{LANG_ANTI_BOT_NOT_CORRECT}");
				$objTheme -> assign(Array("TITLE" => "{LANG_ANTI_BOT_NOT_CORRECT}"));
				break;
			}
		default :
			//Если номер книги цифровой
			if (readValueNum("id")) {
				//Выбираем информацию об книге
				$objBook = new Book(readValue("id"));
				//Если книга существует
				if ($objBook -> is_book()) {
					//Получаем информацию об книге
					$bookName = $objBook -> getInfo();
					//Если книга разрешена к скачиванию
					if ($bookName['free'] == "yes") {
						//Получаем название книги
						$bookName = $bookName['name'];
						//Выводим название книги в браузер
						$objTheme -> assign(Array("TITLE" => $bookName));
						//Получаем список файлов
						$data = $objBook -> getFiles();
						//Если список файлов получен
						if ($data) {
							//Обнуляем список файлов, сформированный на базе шаблона
							$linkList = '';
							//Проходим по всему списку файлов
							foreach ($data as $key => $val) {
								//Формируем ссылки к файлам на базе шаблона
								$linkList .= $objTheme -> addDynamic("getFiles.php/tr.tpl", $val);
							}
							//Устанавливаем главный шаблон
							$objTheme -> define(Array("MAIN_CONTENT" => "getFiles.php/index.tpl"));
							//Выводим список файлов в браузер
							if (empty($linkList)) {
								$objTheme -> assign(Array("GET_FILES_CONTENT" => $objTheme -> addDynamic("messages/warning.tpl", Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"))));
							} else {
								$objTheme -> assign(Array("GET_FILES_CONTENT" => $linkList));
							}
						}
						//Если список файлов не получен, значит пользователь достиг лимита
						else {
							$objTheme -> error("{LANG_LIMIT_REACHED}");
						}
					}
					//Если книга запрещена к скачиванию
					else {
						//Выводим сообщение об этом
						$objTheme -> warning("{LANG_BOOK_NO_FREE}");
						$objTheme -> assign(Array("TITLE" => "{LANG_BOOK_NO_FREE}"));
					}
				}
				//Если книга не существует
				else {
					//Выводим сообщение об этом
					$objTheme -> warning("{LANG_ERROR_READ_CONTENT}");
					$objTheme -> assign(Array("TITLE" => "{LANG_ERROR_READ_CONTENT}"));
				}
			}
			//Если книга имеет не цифровой формат
			else {
				$objTheme -> warning("{LANG_ERROR_READ_FORM}");
				$objTheme -> assign(Array("TITLE" => "{LANG_ERROR_READ_FORM}"));
			}
	}
}
//Если пользователю запрещена загрузка файлов
else {
	$objTheme -> warning("{LANG_FILES_NO_SHOW}");
	$objTheme -> assign(Array("TITLE" => "{LANG_FILES_NO_SHOW}"));
}
//Вывод страницы в браузер и очистка памяти
require_once "end.php";
?>