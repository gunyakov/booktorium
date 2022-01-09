<?php
//-------------------------------------------------------------------------------------------------------------------------
// Скрипт: вывод списка подкатегории и списка книг в них. Создание меню сортировок и тд.
//-------------------------------------------------------------------------------------------------------------------------
// Version 		  : 2.0 b
// Released		  : 28-feb-2013
// Last Modified  : 23-jun-2014
// Author		  : O.G <http://o-g.promodj.ru>
//-------------------------------------------------------------------------------------------------------------------------
// Лицензия GPL v2
//-------------------------------------------------------------------------------------------------------------------------
// Пример работы скрипта http://demo.dub-project.ru
//-------------------------------------------------------------------------------------------------------------------------
// Для любых пожеланий или баг отчетах пишите мне : og@dub-project.ru
//-------------------------------------------------------------------------------------------------------------------------
//Первоначальная инициализация
require_once "initd.php";
//Подключение дополнительных модулей
require_once "extra/readValue.php";
require_once "extra/sortOptions.php";
require_once "extra/rating.php";
//Определяем, как отображаются книги, в виде сетки или списка
if (readValue("view") == "grid") {
	$view = "grid";
} else {
	$view = "list";
}

$objTheme -> define(Array("TAG_CLOUD" => "menuSearch.tpl"));
$objTheme -> assign(Array("MENU_NAME" => "{LANG_CATEGORY}", "KEY_WORD" => "{LANG_CATEGORY}, {TITLE}, техническая библиотека"));
//Если номер категории имеет цифровой формат
if (readValueNum("id")) {
	//Проверяем наличие записи об категории в БД
	$data = $objDB -> select("SELECT * FROM categoryList WHERE ID = " . readValue("id") . ";");
	if ($data) {
		//Получение массива данных об категории
		$data = $data[0];
		//Устанавливаем главный шаблон, в зависимости от типа отображения данных, в виде сетки или списка
		if ($view == "grid") {
			$objTheme -> define(Array("MAIN_CONTENT" => "showCategory.php/grid.tpl"));
		} else {
			$objTheme -> define(Array("MAIN_CONTENT" => "showCategory.php/list.tpl"));
		}
		$objTheme -> assign(Array("CATEGORY_ID" => readValue("id")));
		//Устанавливаем заголовок страницы
		$objTheme -> assign(Array("TITLE" => $data['name'], "VIEW" => $view));

		//Создание бокового меню
		$data = $objDB -> select("SELECT * FROM categoryList WHERE parentID = " . readValue("id") . " ORDER By name;");

		if ($data) {
			//Вызываем доп модуль для формирование списка категорий
			require_once THEME_PATH . "/php/include.CategoryList.php";
		} else {
			$objTheme -> assign(Array("MENU" => "", "CATEGORY_TREE" => ""));
		}
		//Вывод списка книг текущей страницы
		$totalPagesSQL = "SELECT COUNT(booksCategoryList.ID) as countID FROM booksCategoryList, booksList WHERE booksCategoryList.categoryID = " . readValue("id") . " AND booksList.ID = booksCategoryList.bookID AND booksList.approved = 'yes' ";
		$sql = "SELECT booksCategoryList.* FROM booksCategoryList, booksList WHERE booksCategoryList.categoryID = " . readValue("id") . " AND booksCategoryList.bookID = booksList.ID AND booksList.approved = 'yes' ";
		if (@is_array($arrSort)) {
			foreach ($arrSort as $key => $val) {
				$sql .= "AND booksList." . $key . " = '" . $val . "' ";
				$totalPagesSQL .= "AND booksList." . $key . " = '" . $val . "' ";
			}
		}
		switch(readValue("sort")) {
			case "rating" :
			case "datePut" :
			case "year" :
				$sql .= "ORDER BY " . readValue("sort") . " DESC ";
				break;
			case "name" :
				$sql .= "ORDER BY " . readValue("sort") . " ASC ";
				break;
			case "download" :
				$sql .= "ORDER BY downloadCount DESC ";
				break;
			case "date" :
				$sql .= "ORDER BY datePut DESC ";
				break;
		}
		//---------------------------------------------------------------------------------------------------------------------
		//Создание списка ссылок на страницы
		//---------------------------------------------------------------------------------------------------------------------
		//Получаем текущюю страницу
		$page = readValueNum("page");
		//Получаем общее количество страниц
		$totalPages = $objDB -> select($totalPagesSQL . ";");
		//$totalPages = ceil($data['bookCount'] / BOOKS_PER_PAGE);
		$data['bookCount'] = $totalPages[0]['countID'];
		$totalPages = ceil($totalPages[0]['countID'] / BOOKS_PER_PAGE);

		//Если страница дальше, чем есть книг в списке
		if ($page > $totalPages) {
			$page = $totalPages;
		}
		//Если страница меньше еденицы
		if ($page < 1) {
			$page = 1;
		}
		$arrItems = Array();
		//Если страниц больше, чем одна
		if ($totalPages > 1) {
			//Сбрасываем список ссылок на страницы
			$pagList = "";
			$pagLink = "showCategory.php?id={CATEGORY_ID}&view={VIEW}&sort={SORT}&page=";
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
			//Формируем счетчики
			$arrItems['itemsStart'] = ($page - 1) * BOOKS_PER_PAGE + 1;
			$arrItems['itemsEnd'] = $arrItems['itemsStart'] + BOOKS_PER_PAGE - 1;
			if ($arrItems['itemsEnd'] > $data['bookCount']) {
				$arrItems['itemsEnd'] = $data['bookCount'];
			}
			$arrItems['itemsTotal'] = $data['bookCount'];
		}
		//Если страниц одна, либо в разделе нет книг вообще
		else {
			//Удалаем список страниц из шаблона
			$objTheme -> assign(Array("PAGINATION_CONTENT" => ""));
			//Если счетчик книг не равен 0
			if ($data['bookCount'] > 0) {
				//Формируем счетчики
				$arrItems['itemsStart'] = 1;
				$arrItems['itemsEnd'] = $data['bookCount'];
				$arrItems['itemsTotal'] = $data['bookCount'];
			}
			//Если счетчик книг равен 0
			else {
				//Формируем счетчики
				$arrItems['itemsStart'] = 0;
				$arrItems['itemsEnd'] = 0;
				$arrItems['itemsTotal'] = 0;
			}
		}
		//Выводим счетчики в шаблон
		$objTheme -> assign($arrItems);
		$sql .= "LIMIT " . (($page - 1) * BOOKS_PER_PAGE) . ", " . BOOKS_PER_PAGE . ";";
		//echo($sql);
		$data = $objDB -> select($sql);
		//Если в категории есть привязаные книги
		if ($data) {
			//Добавляем вывод списка книг в шаблон
			if ($view == "grid") {
				$objTheme -> define(Array("BOOKS_LIST" => "showCategory.php/gridBooks.tpl"));
			} else {
				$objTheme -> define(Array("BOOKS_LIST" => "showCategory.php/listBooks.tpl"));
			}
			if ($totalPages > 1) {
				//Устанавливаем первоначальный шаблон списка страниц
				$objTheme -> define(Array("PAGINATION_CONTENT" => "pagination.tpl"));
			}
			$strMainContent = '';
			$itemCount = 0;
			$totalItemCount = 0;
			$rowContent = "";
			foreach ($data as $key => $val) {
				$itemCount++;
				$totalItemCount++;
				$objBook = new Book($val['bookID']);
				$bookInfo = $objBook -> getInfo();
				if ($bookInfo) {
					$bookInfo['rating'] = getRating($bookInfo['rating']);
					if (readValue("view") == "grid") {
						$rowContent .= $objTheme -> addDynamic("showCategory.php/gridItem.tpl", $bookInfo);
						if ($itemCount == GRID_ITEM_COUNTER ) {//}&& $totalItemCount != BOOKS_PER_PAGE) {
							$strMainContent .= $objTheme -> addDynamic("showCategory.php/row.tpl", Array("ROW_CONTENT" => $rowContent));
							$itemCount = 0;
							$rowContent = '';
						}
					} else {
						$strMainContent .= $objTheme -> addDynamic("showCategory.php/listItem.tpl", $bookInfo);
					}

				}
			}
			if ($itemCount < GRID_ITEM_COUNTER && $itemCount > 0) {
				$strMainContent .= $objTheme -> addDynamic("hr.tpl", $bookInfo);
			}
			$objTheme -> assign(Array("VIEW_ITEM" => $strMainContent));
		}
		//Если в категории нет привязаных книг
		else {
			//Удаляем вывод списка книг из шаблона
			$objTheme -> assign(Array("BOOKS_LIST" => ""));
		}
		//---------------------------------------------------------------------------------------------------------------------
		//Создание bread crumbs
		//---------------------------------------------------------------------------------------------------------------------
		require_once "extra/breadCrumbs.php";
		$objTheme -> assign(Array("BREAD_CRUMBS_CONTENT" => createBreadCrumbs(readValue("id")), "NUMPAGE_CURRENT" => $page, "SORT" => readValue("sort")));
	} else {
		$objTheme -> warning("{LANG_ERROR_READ_CONTENT}");
		$objTheme -> assign(Array("MENU" => "", "TITLE" => "{LANG_ERROR_READ_FORM}"));
	}
} else {
	$objTheme -> error("{LANG_ERROR_READ_FORM}");
	$objTheme -> assign(Array("MENU" => "", "TITLE" => "{LANG_ERROR_READ_FORM}"));
}
require_once "end.php";
?>
