<?php
//-------------------------------------------------------------------------------------------------------------------------
// Скрипт: вывод информации, описания и тд конкретной книги.
//-------------------------------------------------------------------------------------------------------------------------
// Version 		  : 2.0 b
// Released		  : 28-feb-2013
// Last Modified  : 23-jan-2014
// Author		  : O.G <http://o-g.promodj.ru>
//-------------------------------------------------------------------------------------------------------------------------
// Лицензия GPL v2
//-------------------------------------------------------------------------------------------------------------------------
// Пример работы скрипта http://demo.dub-project.ru
//-------------------------------------------------------------------------------------------------------------------------
// Для любых пожеланий или баг отчетах пишите мне : og@dub-project.ru
//-------------------------------------------------------------------------------------------------------------------------
require_once "initd.php";
require_once "extra/readValue.php";
require_once "extra/rating.php";
//$objTheme->defineMain("showBook.php/index.tpl");
//Устанавливаем некоторый параметры шаблона
$objTheme -> assign(Array("SORT_OPTIONS" => "", "MENU" => "", "TAG_CONTENT" => ""));
$objTheme -> define(Array("TAG_CLOUD" => "tagCloud.tpl"));

//Если пользователю разрешено просматривать информацию об книге
if ($objOptions -> getOption("bookShow") == "yes") {
	//Если книга имеет цифровой формат
	if (readValueNum("id")) {
		//Получаем номер выводимой книги
		$bookID = readValueNum("id");
		//Запрос информации об книге
		$objBook = new Book($bookID);
		//Если книга существует
		if ($objBook -> is_book()) {
			//---------------------------------------------------------------------------------------------------
			//Вывод информации об книге
			//---------------------------------------------------------------------------------------------------
			$bookInfo = $objBook -> getInfo();
			$bookInfo['rating'] = getRating($bookInfo['rating']);
			$objTheme -> define(Array("MAIN_CONTENT" => "showBook.php/index.tpl"));
			$objTheme -> assign($bookInfo);
			$title = $bookInfo['name'];
			//---------------------------------------------------------------------------------------------------
			//Создание списка изображений
			//---------------------------------------------------------------------------------------------------
			$someList = '';
			$i = 0;
			foreach ($objBook -> getImages() as $key => $val) {
				$i++;
				if ($i > 2) {
					$val['active'] = "active";
					$i = 0;
				} else {
					$val['active'] = "";
				}
				if ($val['orderID'] != 0) {
					$someList .= $objTheme -> addDynamic("showBook.php/imagePreview.tpl", $val);
				}
			}
			if (empty($someList)) {
				$objTheme -> assign(Array("IMAGE_CONTENT" => $objTheme -> addDynamic("messages/warning.tpl", Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"))));
			} else {
				$objTheme -> assign(Array("IMAGE_CONTENT" => $someList));
			}
			//---------------------------------------------------------------------------------------------------
			//Создание облака тегов
			//---------------------------------------------------------------------------------------------------
			$someList = '';
			$keyWord = '';
			foreach ($objBook->getTags() as $key => $val) {
				$someList .= $objTheme -> addDynamic("tagCloudItem.tpl", $val);
				$keyWord .= $val['name'] . ", ";
			}
			$keyWord .= "техническая библиотека";
			$objTheme -> assign(Array("TAG_CONTENT" => $someList, "KEY_WORD" => $keyWord));
			//---------------------------------------------------------------------------------------------------
			//Создание списка категорий
			//---------------------------------------------------------------------------------------------------
			$someList = '';
			$arrCategory = $objBook -> getCategory();
			if ($arrCategory) {
				foreach ($objBook->getCategory() as $key => $val) {
					$someList .= $objTheme -> addDynamic("showBook.php/item.tpl", Array("name" => $val['name'], "link" => "showCategory.php?id=" . $val['ID']));
				}
				$objTheme -> assign(Array("CATEGORY_CONTENT" => $someList));
			} else {
				$objTheme -> assign(Array("CATEGORY_CONTENT" => $objTheme -> addDynamic("messages/warning.tpl", Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"))));
			}
			//---------------------------------------------------------------------------------------------------
			//Создание списка авторов
			//---------------------------------------------------------------------------------------------------
			$someList = '';
			$arrAuthor = $objBook -> getAuthor();
			if ($arrAuthor) {
				foreach ($arrAuthor as $key => $val) {
					$someList .= $objTheme -> addDynamic("showBook.php/item.tpl", Array("name" => $val['name'], "link" => "showAuthor.php?id=" . $val['ID']));
					$title .= ", " . $val['name'];
				}
				$objTheme -> assign(Array("AUTHOR_CONTENT" => $someList));
			} else {
				$objTheme -> assign(Array("AUTHOR_CONTENT" => $objTheme -> addDynamic("messages/warning.tpl", Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"))));
			}
			//---------------------------------------------------------------------------------------------------
			//Если пользователю разрешено добавлять коментарии
			//---------------------------------------------------------------------------------------------------
			if ($objOptions -> getOption("CommentsPost") == "yes") {
				//Если произошла отправка коментария
				if (readValue('message') && readValueNum("rating") && readValue("userName")) {
					switch($objOptions->getOption("CommentsPostAntiBot")) {
						case "no" :
							if (!$objAntiBot -> getCode(readValue('antiBot'))) {
								$objTheme -> define(Array("COMMENT_FORM" => "messages/error.tpl"));
								$objTheme -> assign(Array("ERROR_CONTENT" => "{LANG_ANTI_BOT_NOT_CORRECT}"));
								break;
							}
						default :
							//Формируем массив данных для добавления в базу
							$data = Array();
							$data['message'] = readValue('message');
							$data['userName'] = readValue("userName");
							$data['bookID'] = $bookID;
							$data['datePut'] = "NOW()";
							$data['rating'] = round(readValueNum("rating"));
							if (!$data['rating']) {
								$data['rating'] = 0;
							}
							if ($data['rating'] > 5) {
								$data['rating'] = 5;
							}
							//Если недостигнуты лимиты
							if (!Limits("CommentsPost")) {
								//Если добавление коментария в базу прошло успешно
								if ($objDB -> insert("booksMessages", $data)) {
									Amount("CommentsPost");
									$data = Array();
									//Устанавливаем рейтинг книги
									$data['ratingCount'] = $bookInfo['ratingCount'] + 1;
									$data['rating'] = ($bookInfo['rating'] * $bookInfo['ratingCount'] + readValue("rating")) / ($bookInfo["ratingCount"] + 1);
									$objDB -> update("booksList", $data, Array("ID" => $bookID));

									$objTheme -> define(Array("COMMENT_FORM" => "messages/success.tpl"));
									$objTheme -> assign(Array("SUCCESS_CONTENT" => "{LANG_ADD_TRUE}"));
								}
								//Если добавление коментария в базу прошло не успешно
								else {
									$objTheme -> define(Array("COMMENT_FORM" => "messages/error.tpl"));
									$objTheme -> assign(Array("ERROR_CONTENT" => "{LANG_ADD_FALSE}" . $objDB -> getError()));
								}
							} else {
								$objTheme -> define(Array("COMMENT_FORM" => "messages/error.tpl"));
								$objTheme -> assign(Array("ERROR_CONTENT" => "{LANG_LIMIT_REACHED}"));

							}
					}
				}
				//Если отправка коментрария не произошла
				else {
					if ($objOptions -> getOption("CommentsPostAntiBot") == "no") {
						$objTheme -> define(Array("COMMENT_FORM" => "showBook.php/reviewFormAntiBot.tpl"));
					} else {
						$objTheme -> define(Array("COMMENT_FORM" => "showBook.php/reviewFormNonAntiBot.tpl"));
					}

				}

			}
			//Если пользователю запрещено добавлять коментарии
			else {
				$objTheme -> assign(Array("COMMENT_FORM" => $objTheme -> addDynamic("messages/warning.tpl", Array("WARNING_CONTENT" => "{LANG_PAGE_NO_SHOW}"))));
			}
			//-----------------------------------------------------------------------------
			//Если пользователю разрешен просмотр коментариев
			if ($objOptions -> getOption("CommentsShow") == "yes") {
				//-------------------------------------------------------------------------------------------------------------
				//Формируем список ссылок на страницы
				//-------------------------------------------------------------------------------------------------------------
				//Запрос общего количества коментариев
				$data = $objDB -> select("SELECT COUNT(*) FROM booksMessages WHERE bookID=" . $bookID . ";");
				$totalPages = ceil($data[0]['COUNT(*)'] / COMMENTS_PER_PAGE);
				//Получаем текущую страницу из данных
				$page = readValueNum('page');
				//Если текущая страница меньше 1цы
				if ($page < 1) {
					$page = 1;
				}
				//Если текущая страница больше общего числа страниц
				if ($page > $totalPages) {
					$page = $totalPages;
				}
				//Если общее количество страниц больше 1цы
				if ($totalPages > 1) {
					//Устанавливаем первоначальный шаблон списка страниц
					$objTheme -> define(Array("PAGINATION_CONTENT" => "pagination.tpl"));
					//Устанавливаем путь к данной странице
					$pagLink = "showBook.php?id={ID}&page=";
					//Сбрасываем список ссылок на страницы
					$pagList = "";
					//Если текущая страница больше еденицы
					if ($page > 1) {
						//Выводим ссылку на предыдущюю страницу
						$pagList .= $objTheme -> addDynamic("paginationPrev.tpl", Array("link" => $pagLink . ($page - 1)));
					}
					for ($a = $page - 4; $a <= $page + 4; $a++) {
						if ($a > 0 && $a <= $totalPages) {
							if ($a == $page) {
								$pagList .= $objTheme -> addDynamic("paginationActive.tpl", Array("PAGE_NUMBER" => $a, "link" => $pagLink . $a));
							} else {
								$pagList .= $objTheme -> addDynamic("paginationItem.tpl", Array("PAGE_NUMBER" => $a, "link" => $pagLink . $a));
							}
						}
					}
					//Если текущая страница меньше общего количества страниц
					if ($page < $totalPages) {
						//Выводим ссылку на следующую страницу
						$pagList .= $objTheme -> addDynamic("paginationNext.tpl", Array("link" => $pagLink . ($page + 1)));
					}
					$objTheme -> assign(Array("PAGINATION_LIST" => $pagList));
				} else {
					$objTheme -> assign(Array("PAGINATION_CONTENT" => ""));
				}
				//Запрос коментариев
				$data = $objDB -> select("SELECT *, DATE_FORMAT(datePut, '%M %e, %Y at %k:%i %p') as datePut FROM booksMessages WHERE bookID=" . $bookID . " ORDER BY datePut " . COMMENTS_SORT_MODE . " LIMIT " . ($page - 1) * COMMENTS_PER_PAGE . "," . COMMENTS_PER_PAGE . ";");
				//Если коментарии существуют
				if ($data) {
					$messages = '';
					foreach ($data as $key => $val) {
						$messages .= $objTheme -> addDynamic("showBook.php/message.tpl", $val);
					}
					$objTheme -> assign(Array("MESSAGE_CONTENT" => $messages));
				}
				//Если коментарии отсутсвуют
				else {
					$nextPage = $page;
					$objTheme -> assign(Array("MESSAGE_CONTENT" => $objTheme -> addDynamic("messages/warning.tpl", Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"))));
				}
			}
			//Если пользователю запрещен просмотр коментариев
			else {
				$objTheme -> define(Array("MESSAGE_CONTENT" => $objTheme -> addDynamic("messages/warning.tpl", Array("WARNING_CONTENT" => "{LANG_PAGE_NO_SHOW}"))));
			}
			//-----------------------------------------------------------------------------
			//Если пользователю разрешено загружать файлы
			if ($objOptions -> getOption("GetFiles") == "yes") {
				//Если требуется антибот код при загрузке файлов
				if ($objOptions -> getOption("GetFilesAntiBot") == "no") {
					$objTheme -> define(Array("GET_FILES_CONTENT" => "showBook.php/getFilesAntiBot.tpl"));
				}
				//Если не требуется антибот код при загрузке файлов
				else {
					$objTheme -> define(Array("GET_FILES_CONTENT" => "showBook.php/getFilesNonAntiBot.tpl"));
				}
			}
			//Если пользователю запрещено загружать файлы
			else {
				$objTheme -> assign(Array("GET_FILES_CONTENT" => $objTheme -> addDynamic("messages/warning.tpl", Array("WARNING_CONTENT" => "{LANG_PAGE_NO_SHOW}"))));
			}
			$objTheme -> assign(Array("TITLE" => $title));
			//-----------------------------------------------------------------------------
		}
		//Если книга не существует
		else {
			$objTheme -> error("{LANG_ERROR_READ_CONTENT}");
			$objTheme -> assign(Array("MENU" => "", "SORT_OPTIONS" => "", "TAG_CLOUD" => ""));
			$objTheme -> assign(Array("TITLE" => "{LANG_ERROR_READ_CONTENT}"));
		}
	}
	//Если книга имеет не цифровой формат
	else {
		$objTheme -> error("{LANG_ERROR_READ_FORM}");
		$objTheme -> assign(Array("MENU" => "", "SORT_OPTIONS" => "", "TAG_CLOUD" => ""));
		$objTheme -> assign(Array("TITLE" => "{LANG_ERROR_READ_FORM}"));
	}
}
//Если пользователю запрещено просматривать информацию об книге
else {
	$objTheme -> warning("{LANG_PAGE_NO_SHOW}");
	$objTheme -> assign(Array("MENU" => "", "SORT_OPTIONS" => "", "TAG_CLOUD" => ""));
	$objTheme -> assign(Array("TITLE" => "{LANG_PAGE_NO_SHOW}"));
}
//Очистка памяти и вывод результата в браузер
require_once "end.php";
?>
