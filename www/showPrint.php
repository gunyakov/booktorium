<?php
//-------------------------------------------------------------------------------------------------------------------------
// Скрипт: вывод списка издательств и привязанных к ним книг.
//-------------------------------------------------------------------------------------------------------------------------
// Version 		  : 2.0 b
// Released		  : 28-feb-2013
// Last Modified  : 23-jun-2013
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

$objTheme -> assign(Array("MENU" => "", "TAG_CLOUD" => "", "SORT_OPTIONS" => ""));

$objTheme -> assign(Array("LINK" => "showPrint.php", "skriptName" => "{LANG_PRINTHOUSE}"));
if (readValueNum("id")) {
	$id = readValue("id");
	$data = $objDB -> select("SELECT * FROM printList WHERE ID = " . $id . ";");
	if ($data) {
		$data[0]['LINK'] = "showPrint.php";
		$objTheme -> define(Array("MAIN_CONTENT" => "showTable.tpl"));
		$objTheme -> assign(Array("TABLE_1_HEAD" => "{LANG_MORE}"));
		$objTheme -> assign(Array("TABLE_1_CONTENT" => $objTheme -> addDynamic("showTableLink1.tpl", $data[0])));
		$objTheme -> assign(Array("name" => $data[0]['name'], "TITLE" => $data[0]['name']));
		$data = $objDB -> select("SELECT booksList.* FROM booksList, booksPrintList WHERE booksPrintList.printID=" . $id . " AND booksPrintList.bookID = booksList.ID ORDER BY booksList.name;");
		$bookList = '';
		foreach ($data as $key => $val) {
			$val['LINK'] = "showBook.php";
			$bookList .= $objTheme -> addDynamic("showTableMore.tpl", $val);
		}
		$objTheme -> assign(Array("TABLE_2_HEAD" => "{LANG_BOOK_LIST}"));
		$objTheme -> assign(Array("TABLE_2_CONTENT" => $bookList));

	} else {
		$objTheme -> define(Array("MAIN_CONTENT" => "messages/warning.tpl"));
		$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
	}
} else {
	$objTheme -> define(Array("MAIN_CONTENT" => "showTable.tpl"));
	$l = readValue("l");
	$l = trim($l);

	if (strlen($l) > 0) {
		$objTheme -> assign(Array("name" => $l, "TITLE" => $l." :: {LANG_TITLE_PRINT_LIST}"));
		$data = $objDB -> select("SELECT *, CONCAT(name, ', ', city) as name FROM printList WHERE name LIKE '" . $l . "%' ORDER BY name DESC, city DESC;");
	} else {
		$objTheme -> assign(Array("name" => "{LANG_SHOW_RAND}", "TITLE" => "{LANG_SHOW_RAND} :: {LANG_TITLE_PRINT_LIST}"));
		$data = $objDB -> select("SELECT *, CONCAT(name, ', ', city) as name FROM printList ORDER BY RAND(), name DESC LIMIT 10;");
	}
	$objTheme -> assign(Array("TABLE_1_HEAD" => "{LANG_SHOW_NAME_Z_A}"));
	if ($data) {
		$authorList = '';
		$i = 1;
		foreach ($data as $key => $val) {
			$val['LINK'] = "showPrint.php";
			$authorList .= $objTheme -> addDynamic("showTableLink" . $i . ".tpl", $val);
			$i++;
			if ($i == 3) {
				$i = 1;
			}
		}
		$objTheme -> assign(Array("TABLE_1_CONTENT" => $authorList));
	} else {
		$objTheme -> define(Array("TABLE_1_CONTENT" => "messages/warning.tpl"));
		$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
	}

	$objTheme -> assign(Array("TABLE_2_HEAD" => "{LANG_SHOW_NAME_A_Z}"));
	if (strlen($l) > 0) {
		$data = $objDB -> select("SELECT *, CONCAT(name, ', ', city) as name FROM printList WHERE name LIKE '" . $l . "%' ORDER BY name ASC, city ASC;");
	} else {
		$data = $objDB -> select("SELECT *, CONCAT(name, ', ', city) as name FROM printList ORDER BY RAND(), name ASC LIMIT 10;");
	}

	if ($data) {
		$authorList = '';
		$i = 1;
		foreach ($data as $key => $val) {
			$val['LINK'] = "showPrint.php";
			$authorList .= $objTheme -> addDynamic("showTableLink" . $i . ".tpl", $val);
			$i++;
			if ($i == 3) {
				$i = 1;
			}
		}
		$objTheme -> assign(Array("TABLE_2_CONTENT" => $authorList));
	} else {
		$objTheme -> define(Array("TABLE_2_CONTENT" => "messages/warning.tpl"));
		$objTheme -> assign(Array("WARNING_CONTENT" => "{LANG_HAVE_NO_ELEMENT}"));
	}
}
require_once "end.php";
?>
